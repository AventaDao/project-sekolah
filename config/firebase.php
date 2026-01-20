<?php

$credentialsPath = storage_path('firebase-keys/firebase-credentials.json');
$credentials = [];

if (file_exists($credentialsPath)) {
    $credentials = json_decode(file_get_contents($credentialsPath), true);
}

return [
    'project_id' => env('FIREBASE_PROJECT_ID') ?? $credentials['project_id'] ?? null,
    'private_key' => $credentials['private_key'] ?? null,
    'private_key_id' => $credentials['private_key_id'] ?? null,
    'client_email' => env('FIREBASE_CLIENT_EMAIL') ?? $credentials['client_email'] ?? null,
    'client_id' => env('FIREBASE_CLIENT_ID') ?? $credentials['client_id'] ?? null,
    'auth_uri' => env('FIREBASE_AUTH_URI') ?? $credentials['auth_uri'] ?? null,
    'token_uri' => env('FIREBASE_TOKEN_URI') ?? $credentials['token_uri'] ?? null,
    'auth_provider_cert_url' => env('FIREBASE_AUTH_PROVIDER_CERT_URL') ?? $credentials['auth_provider_x509_cert_url'] ?? null,
    'client_cert_url' => env('FIREBASE_CLIENT_CERT_URL') ?? $credentials['client_x509_cert_url'] ?? null,
];
