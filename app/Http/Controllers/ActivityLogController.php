<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class ActivityLogController extends Controller
{
    /**
     * View Firebase logs (Development only)
     */
    public function viewFirebaseLogs()
    {
        try {
            $firestore = new FirestoreClient([
                'projectId' => config('firebase.project_id'),
                'keyFile' => json_decode(
                    file_get_contents(storage_path('firebase-keys/firebase-credentials.json')),
                    true
                )
            ]);

            $database = $firestore->database();
            
            // Fetch all activity logs from Firestore
            $query = $database->collection('activity_logs')
                ->orderBy('timestamp', 'DESCENDING')
                ->limit(50);

            $documents = $query->documents();

            $activities = [];
            foreach ($documents as $doc) {
                if ($doc->exists()) {
                    $data = $doc->data();
                    $activities[] = [
                        'id' => $doc->id(),
                        'data' => $data,
                    ];
                }
            }

            return response()->json($activities);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display activities from Firebase Firestore
     */
    public function index(Request $request)
    {
        try {
            $firestore = new FirestoreClient([
                'projectId' => config('firebase.project_id'),
                'keyFile' => json_decode(
                    file_get_contents(storage_path('firebase-keys/firebase-credentials.json')),
                    true
                )
            ]);

            $database = $firestore->database();
            
            // Fetch all activity logs from Firestore, ordered by timestamp (newest first)
            $query = $database->collection('activity_logs')
                ->orderBy('timestamp', 'DESCENDING')
                ->limit(100);

            $documents = $query->documents();

            $activities = [];
            foreach ($documents as $doc) {
                if ($doc->exists()) {
                    $data = $doc->data();
                    $activities[] = [
                        'id' => $doc->id(),
                        'type' => $data['type'] ?? '',
                        'action' => $data['action'] ?? '',
                        'message' => $data['message'] ?? '',
                        'description' => $data['description'] ?? $this->generateDescription($data),
                        'timestamp' => $data['timestamp'] ?? '',
                        'ip_address' => $data['ip_address'] ?? '',
                        'user_name' => $data['user_name'] ?? 'System',
                        'user_email' => $data['user_email'] ?? '',
                        'url' => $data['url'] ?? '',
                        'method' => $data['method'] ?? '',
                        'data' => $data['data'] ?? [],
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $activities,
                'total' => count($activities)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate human-readable description from log data
     */
    private function generateDescription($data): string
    {
        $action = $data['action'] ?? 'unknown';
        $type = $data['type'] ?? 'general';

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
            ],
            'form' => [
                'submit' => 'Mengirim form',
                'update' => 'Mengubah form',
            ],
            'user' => [
                'create' => 'Membuat user baru',
                'update' => 'Mengubah data user',
                'delete' => 'Menghapus user',
            ],
            'authentication' => [
                'login' => 'Login ke sistem',
                'logout' => 'Logout dari sistem',
                'register' => 'Mendaftar akun baru',
            ],
        ];

        if (isset($descriptions[$type][$action])) {
            return $descriptions[$type][$action];
        }

        // Default description
        return ucfirst($action) . ' - ' . ucfirst($type);
    }
}
