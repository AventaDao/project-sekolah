<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities for the authenticated user.
     */
    public function index()
    {
        try {
            $userId = Auth::id();
            
            // Fetch activities from Firebase using REST API
            $activities = $this->fetchActivitiesFromFirebase('user_id', $userId);
            
            return view('user.activities.index', compact('activities'));

        } catch (\Exception $e) {
            return view('user.activities.index', ['activities' => [], 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of all activities for admin.
     */
    public function adminIndex()
    {
        try {
            // Fetch all activities from Firebase
            $activities = $this->fetchAllActivitiesFromFirebase();
            
            return view('admin.activities.index', compact('activities'));

        } catch (\Exception $e) {
            return view('admin.activities.index', ['activities' => [], 'error' => $e->getMessage()]);
        }
    }

    /**
     * Show a single activity detail.
     */
    public function show($activityId)
    {
        try {
            $userId = Auth::id();
            
            // Get activity from Firebase
            $activity = $this->getActivityFromFirebase($activityId);

            if (!$activity) {
                abort(404, 'Activity not found');
            }
            
            // Check authorization
            if (($activity['user_id'] ?? null) !== $userId) {
                abort(403, 'Unauthorized action.');
            }

            return view('user.activities.show', compact('activity'));

        } catch (\Exception $e) {
            abort(500, 'Error fetching activity: ' . $e->getMessage());
        }
    }

    /**
     * Show a single activity detail for admin.
     */
    public function adminShow($activityId)
    {
        try {
            $activity = $this->getActivityFromFirebase($activityId);

            if (!$activity) {
                abort(404, 'Activity not found');
            }

            return view('admin.activities.show', compact('activity'));

        } catch (\Exception $e) {
            abort(500, 'Error fetching activity: ' . $e->getMessage());
        }
    }

    /**
     * Clear all activity logs (Admin only)
     */
    public function clearLogs(Request $request)
    {
        try {
            $this->deleteAllActivitiesFromFirebase();

            return redirect()->route('admin.activities.index')
                ->with('success', 'Semua activity logs dari Firebase berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('admin.activities.index')
                ->with('error', 'Gagal menghapus logs: ' . $e->getMessage());
        }
    }

    /**
     * Fetch all activities from Firebase REST API
     * Termasuk aktivitas dari admin dan user
     */
    private function fetchAllActivitiesFromFirebase()
    {
        $projectId = config('firebase.project_id');
        $accessToken = $this->getFirebaseAccessToken();
        
        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/activity_logs";
        
        $response = Http::withToken($accessToken)->get($url);
        
        $activities = [];
        
        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['documents'])) {
                foreach ($data['documents'] as $doc) {
                    $activity = $this->parseFirestoreDocument($doc);
                    if ($activity) {
                        // Pastikan setiap aktivitas memiliki informasi user yang lengkap
                        // Bahkan jika user_id kosong, tetap tampilkan berdasarkan user_name atau email
                        if (empty($activity['user_id']) && empty($activity['user_name']) && empty($activity['user_email'])) {
                            // Skip aktivitas yang tidak memiliki info user sama sekali
                            continue;
                        }
                        $activities[] = $activity;
                    }
                }
            }
        }
        
        // Sort by timestamp descending (terbaru di atas)
        usort($activities, function($a, $b) {
            $aTime = $this->parseTimestamp($a['timestamp'] ?? 0);
            $bTime = $this->parseTimestamp($b['timestamp'] ?? 0);
            return $bTime <=> $aTime;  // Terbaru di atas (descending)
        });
        
        return array_slice($activities, 0, 200); // Tingkatkan dari 100 menjadi 200 untuk mencakup user activities
    }

    /**
     * Fetch activities for specific user from Firebase
     */
    private function fetchActivitiesFromFirebase($field, $value)
    {
        $projectId = config('firebase.project_id');
        $accessToken = $this->getFirebaseAccessToken();
        
        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/activity_logs";
        
        $response = Http::withToken($accessToken)->get($url);
        
        $activities = [];
        
        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['documents'])) {
                foreach ($data['documents'] as $doc) {
                    $activity = $this->parseFirestoreDocument($doc);
                    
                    if ($activity && ($activity[$field] ?? null) === $value) {
                        $activities[] = $activity;
                    }
                }
            }
        }
        
        // Sort by timestamp descending (terbaru di atas)
        usort($activities, function($a, $b) {
            $aTime = $this->parseTimestamp($a['timestamp'] ?? 0);
            $bTime = $this->parseTimestamp($b['timestamp'] ?? 0);
            return $bTime <=> $aTime;  // Terbaru di atas (descending)
        });
        
        return array_slice($activities, 0, 50);
    }

    /**
     * Get single activity from Firebase
     */
    private function getActivityFromFirebase($activityId)
    {
        $projectId = config('firebase.project_id');
        $accessToken = $this->getFirebaseAccessToken();
        
        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/activity_logs/{$activityId}";
        
        $response = Http::withToken($accessToken)->get($url);
        
        if ($response->successful()) {
            return $this->parseFirestoreDocument($response->json());
        }
        
        return null;
    }

    /**
     * Delete all activities from Firebase
     */
    private function deleteAllActivitiesFromFirebase()
    {
        $projectId = config('firebase.project_id');
        $accessToken = $this->getFirebaseAccessToken();
        
        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/activity_logs";
        
        $totalDeleted = 0;
        $totalFailed = 0;
        $iterations = 0;
        $maxIterations = 100; // Safety limit to prevent infinite loops
        
        // Keep deleting until no more documents exist
        do {
            $iterations++;
            
            if ($iterations > $maxIterations) {
                throw new \Exception("Batas maksimum iterasi tercapai. Total dihapus: {$totalDeleted}, gagal: {$totalFailed}");
            }
            
            // Configure HTTP client with extended timeout and SSL options
            $response = Http::timeout(60)
                ->connectTimeout(30)
                ->withOptions([
                    'verify' => false, // Disable SSL verification for local development
                ])
                ->retry(3, 1000) // Retry 3 times with 1 second delay
                ->withToken($accessToken)
                ->get($url);
            
            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil daftar activity logs dari Firebase: ' . $response->body());
            }
            
            $data = $response->json();
            
            // If no documents found, we're done
            if (!isset($data['documents']) || empty($data['documents'])) {
                break;
            }
            
            $documentsInBatch = count($data['documents']);
            $deletedInBatch = 0;
            $failedInBatch = 0;
            
            foreach ($data['documents'] as $doc) {
                $docId = basename($doc['name']);
                $deleteUrl = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/activity_logs/{$docId}";
                
                try {
                    $deleteResponse = Http::timeout(60)
                        ->connectTimeout(30)
                        ->withOptions([
                            'verify' => false,
                        ])
                        ->retry(3, 1000)
                        ->withToken($accessToken)
                        ->delete($deleteUrl);
                    
                    if ($deleteResponse->successful()) {
                        $deletedInBatch++;
                        $totalDeleted++;
                    } else {
                        $failedInBatch++;
                        $totalFailed++;
                        \Log::warning("Failed to delete document {$docId}: " . $deleteResponse->body());
                    }
                } catch (\Exception $e) {
                    $failedInBatch++;
                    $totalFailed++;
                    \Log::error("Error deleting document {$docId}: " . $e->getMessage());
                }
            }
            
            \Log::info("Batch {$iterations}: Found {$documentsInBatch} docs, deleted {$deletedInBatch}, failed {$failedInBatch}. Total so far: {$totalDeleted} deleted, {$totalFailed} failed");
            
            // If we failed to delete any in this batch, but there are still documents, 
            // we might be in an infinite loop
            if ($deletedInBatch === 0 && $documentsInBatch > 0) {
                throw new \Exception("Tidak dapat menghapus dokumen yang tersisa. Total berhasil: {$totalDeleted}, gagal: {$totalFailed}");
            }
            
            // Small delay between batches to avoid rate limiting
            if ($documentsInBatch > 0) {
                usleep(100000); // 100ms delay
            }
            
        } while (true); // Loop until break condition (no more documents)
        
        \Log::info("All deletion complete. Total deleted: {$totalDeleted}, failed: {$totalFailed} in {$iterations} iterations");
        
        if ($totalFailed > 0) {
            throw new \Exception("Berhasil menghapus {$totalDeleted} logs, gagal {$totalFailed} logs");
        }
    }

    /**
     * Parse Firestore document to array
     */
    private function parseFirestoreDocument($doc): ?array
    {
        if (!isset($doc['fields'])) {
            return null;
        }
        
        $fields = $doc['fields'];
        $result = [
            'id' => basename($doc['name'] ?? ''),
        ];
        
        foreach ($fields as $key => $field) {
            $result[$key] = $this->getFirestoreValue($field);
        }
        
        // Jika action adalah 'login' dan tidak ada user_name, coba ambil dari user_email
        if (($result['action'] ?? null) === 'login' && (empty($result['user_name']) || $result['user_name'] === null)) {
            if (!empty($result['user_email'])) {
                $result['user_name'] = explode('@', $result['user_email'])[0];
            }
        }
        
        $result['description'] = $this->generateDescription($result);
        
        return $result;
    }

    /**
     * Extract value from Firestore field
     */
    private function getFirestoreValue($field)
    {
        if (isset($field['stringValue'])) {
            return $field['stringValue'];
        } elseif (isset($field['integerValue'])) {
            return (int)$field['integerValue'];
        } elseif (isset($field['doubleValue'])) {
            return (double)$field['doubleValue'];
        } elseif (isset($field['booleanValue'])) {
            return $field['booleanValue'];
        } elseif (isset($field['timestampValue'])) {
            return $field['timestampValue'];
        } elseif (isset($field['arrayValue'])) {
            return $field['arrayValue']['values'] ?? [];
        } elseif (isset($field['mapValue'])) {
            return $field['mapValue']['fields'] ?? [];
        } elseif (isset($field['nullValue'])) {
            return null;
        }
        
        return null;
    }

    /**
     * Parse timestamp string to Unix timestamp for comparison
     * Handles various formats: ISO8601, "YYYY-MM-DD HH:mm:ss", etc.
     */
    private function parseTimestamp($timestamp)
    {
        if (!$timestamp) {
            return 0;
        }

        // If already numeric, return it
        if (is_numeric($timestamp)) {
            return (int)$timestamp;
        }

        // Handle ISO8601 format (2026-01-19T12:17:28.000Z)
        if (strpos($timestamp, 'T') !== false) {
            return strtotime($timestamp);
        }

        // Handle "YYYY-MM-DD HH:mm:ss" format
        if (strlen($timestamp) === 19 && strpos($timestamp, ' ') !== false) {
            return strtotime($timestamp);
        }

        // Fallback to strtotime
        $time = strtotime($timestamp);
        return $time !== false ? $time : 0;
    }

    /**
     * Generate human-readable description from log data
     */
    private function generateDescription($data): string
    {
        $action = $data['action'] ?? 'unknown';
        $type = $data['type'] ?? 'general';
        $userName = $data['user_name'] ?? null;

        $descriptions = [
            'document' => [
                'create' => 'Membuat pengajuan surat baru',
                'update' => 'Mengubah pengajuan surat',
                'delete' => 'Menghapus pengajuan surat',
            ],
            'approval' => [
                'approve' => 'Menyetujui pengajuan surat',
                'reject' => 'Menolak pengajuan surat',
                'pending' => 'Menandai pengajuan sebagai pending',
                'update_status' => 'Memperbarui status pengajuan',
            ],
            'form' => [
                'submit' => 'Mengirim form',
                'update' => 'Mengubah form',
                'submit_pengajuan' => 'Mengirim form pengajuan',
            ],
            'user' => [
                'create' => 'Membuat user baru',
                'update' => 'Mengubah data user',
                'delete' => 'Menghapus user',
                'approve_pengajuan' => 'Menyetujui pengajuan surat',
            ],
            'authentication' => [
                'login' => 'Login ke sistem',
                'logout' => 'Logout dari sistem',
                'register' => 'Mendaftar akun baru',
            ],
            'pengaduan' => [
                'create' => 'Membuat pengaduan baru',
                'update_status' => 'Memperbarui status pengaduan',
            ],
            'support' => [
                'submit_contact' => 'Mengirim pesan support',
                'reply_contact' => 'Membalas pesan support',
            ],
            'penduduk' => [
                'create' => 'Menambahkan data penduduk',
                'update' => 'Mengubah data penduduk',
                'delete' => 'Menghapus data penduduk',
            ],
            'profile' => [
                'edit' => 'Mengubah profil',
                'change_password' => 'Mengubah password',
            ],
        ];

        $description = $descriptions[$type][$action] ?? ucfirst($action) . ' - ' . ucfirst($type);

        // Tambahkan login_method jika ada (untuk authentication/login)
        if ($type === 'authentication' && $action === 'login' && !empty($data['login_method'])) {
            $description .= ' (' . ucfirst(str_replace('_', ' ', $data['login_method'])) . ')';
        }

        // Tambahkan user_name ke description jika tersedia
        if ($userName && in_array($type, ['authentication', 'user', 'pengaduan', 'support', 'penduduk', 'profile'])) {
            $description .= ' - ' . $userName;
        }

        return $description;
    }

    /**
     * Get Firebase access token
     */
    private function getFirebaseAccessToken()
    {
        // Check if cached token exists and is still valid
        $cache = \Cache::get('firebase_access_token');
        if ($cache) {
            return $cache;
        }

        try {
            $credentialsPath = storage_path('firebase-keys/firebase-credentials.json');
            $credentials = json_decode(file_get_contents($credentialsPath), true);

            $now = time();
            $expiry = $now + 3600;

            $claim = [
                'iss' => $credentials['client_email'],
                'scope' => 'https://www.googleapis.com/auth/cloud-platform',
                'aud' => 'https://oauth2.googleapis.com/token',
                'exp' => $expiry,
                'iat' => $now
            ];

            $jwt = $this->createJWT($claim, $credentials['private_key']);

            // Add timeout and SSL configuration for token request
            $response = Http::timeout(60)
                ->connectTimeout(30)
                ->withOptions([
                    'verify' => false, // Disable SSL verification for local development
                ])
                ->retry(3, 1000)
                ->asForm()
                ->post('https://oauth2.googleapis.com/token', [
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion' => $jwt
                ]);

            if ($response->successful()) {
                $token = $response->json()['access_token'];
                \Cache::put('firebase_access_token', $token, 3500); // Cache for ~1 hour
                return $token;
            }

            throw new \Exception('Failed to get Firebase access token: ' . $response->body());

        } catch (\Exception $e) {
            throw new \Exception('Firebase authentication error: ' . $e->getMessage());
        }
    }

    /**
     * Create JWT token for Firebase authentication
     */
    private function createJWT($claim, $privateKey)
    {
        $header = ['typ' => 'JWT', 'alg' => 'RS256'];

        $headerEncoded = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
        $claimEncoded = rtrim(strtr(base64_encode(json_encode($claim)), '+/', '-_'), '=');
        $signatureInput = "{$headerEncoded}.{$claimEncoded}";

        $privateKey = str_replace('\\n', "\n", $privateKey);
        
        $keyResource = openssl_pkey_get_private($privateKey);
        if (!$keyResource) {
            throw new \Exception('Invalid private key');
        }

        openssl_sign($signatureInput, $signature, $keyResource, 'sha256');
        $signatureEncoded = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return "{$signatureInput}.{$signatureEncoded}";
    }
}
