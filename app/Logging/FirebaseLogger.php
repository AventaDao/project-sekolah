<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class FirebaseLogger extends AbstractProcessingHandler
{
    protected $projectId;
    protected $privateKey;
    protected $clientEmail;
    protected $accessToken;
    protected $tokenExpiry;

    public function __construct()
    {
        parent::__construct(Logger::DEBUG);
        
        $this->projectId = config('firebase.project_id');
        $this->privateKey = config('firebase.private_key');
        $this->clientEmail = config('firebase.client_email');
    }

    protected function write(\Monolog\LogRecord $record): void
    {
        try {
            // Dapatkan access token Firebase
            $token = $this->getAccessToken();

            // Ekstrak context dari record (berisi data aktivitas)
            $context = $record['context'] ?? [];
            
            // Buat field structure untuk Firestore
            $fields = [
                'message' => ['stringValue' => $record['message']],
                'level' => ['stringValue' => $record['level_name']],
                'channel' => ['stringValue' => $record['channel']],
                'timestamp' => ['timestampValue' => now()->toIso8601String()],
            ];

            // Tambahkan context fields dengan proper formatting
            if (!empty($context)) {
                foreach ($context as $key => $value) {
                    if (is_array($value)) {
                        $fields[$key] = ['stringValue' => json_encode($value)];
                    } elseif (is_numeric($value)) {
                        $fields[$key] = ['integerValue' => (int)$value];
                    } else {
                        $fields[$key] = ['stringValue' => (string)$value];
                    }
                }
            }

            // Tambahkan extra fields
            if (!empty($record['extra'])) {
                $extra = $record['extra'];
                foreach ($extra as $key => $value) {
                    if (!isset($fields[$key])) {
                        if (is_array($value)) {
                            $fields[$key] = ['stringValue' => json_encode($value)];
                        } elseif (is_numeric($value)) {
                            $fields[$key] = ['integerValue' => (int)$value];
                        } else {
                            $fields[$key] = ['stringValue' => (string)$value];
                        }
                    }
                }
            }

            // Persiapkan data untuk Firestore
            $data = ['fields' => $fields];

            // Kirim ke Firestore
            $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/activity_logs";

            $response = Http::withToken($token)
                ->timeout(10)
                ->post($url, $data);

            // Log ke local jika response tidak successful (untuk debugging)
            if (!$response->successful()) {
                \Log::channel('single')->warning('Firebase API response not successful', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'request_data' => $data
                ]);
            }

        } catch (\Exception $e) {
            // Fallback: log ke local jika Firebase gagal
            \Log::channel('single')->error('Firebase logging failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'record' => $record
            ]);
        }
    }

    private function getAccessToken()
    {
        // Cache token selama 1 jam
        if ($this->accessToken && $this->tokenExpiry > time()) {
            return $this->accessToken;
        }

        try {
            $now = time();
            $expiry = $now + 3600; // 1 jam

            // Buat JWT claim
            $claim = [
                'iss' => $this->clientEmail,
                'scope' => 'https://www.googleapis.com/auth/cloud-platform',
                'aud' => 'https://oauth2.googleapis.com/token',
                'exp' => $expiry,
                'iat' => $now
            ];

            // Buat JWT token
            $jwt = $this->createJWT($claim);

            // Tukar JWT dengan access token
            $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ]);

            if ($response->successful()) {
                $this->accessToken = $response->json()['access_token'];
                $this->tokenExpiry = $expiry;
                return $this->accessToken;
            }

        } catch (\Exception $e) {
            \Log::channel('single')->error('Failed to get Firebase access token: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createJWT($claim)
    {
        $header = ['typ' => 'JWT', 'alg' => 'RS256'];

        $headerEncoded = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
        $claimEncoded = rtrim(strtr(base64_encode(json_encode($claim)), '+/', '-_'), '=');
        $signatureInput = "{$headerEncoded}.{$claimEncoded}";

        // Sign dengan private key
        $privateKey = $this->privateKey;
        
        // Handle escaped newlines dari JSON
        $privateKey = str_replace('\\n', "\n", $privateKey);
        
        $keyResource = openssl_pkey_get_private($privateKey);
        if (!$keyResource) {
            throw new \Exception('Invalid private key: ' . openssl_error_string());
        }

        openssl_sign($signatureInput, $signature, $keyResource, 'sha256');
        $signatureEncoded = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return "{$signatureInput}.{$signatureEncoded}";
    }
}
