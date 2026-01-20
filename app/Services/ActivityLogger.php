<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log user authentication activities
     */
    public function logAuthentication($action, $data = [])
    {
        return $this->log('authentication', $action, $data);
    }

    /**
     * Log document/surat activities
     */
    public function logDocument($action, $documentId, $data = [])
    {
        $logData = array_merge($data, [
            'document_id' => $documentId,
            'resource_type' => 'document'
        ]);
        return $this->log('document', $action, $logData);
    }

    /**
     * Log approval activities
     */
    public function logApproval($action, $approvalId, $status, $data = [])
    {
        $logData = array_merge($data, [
            'approval_id' => $approvalId,
            'approval_status' => $status,
            'resource_type' => 'approval'
        ]);
        return $this->log('approval', $action, $logData);
    }

    /**
     * Log user/admin activities
     */
    public function logUser($action, $userId, $data = [])
    {
        $logData = array_merge($data, [
            'target_user_id' => $userId,
            'resource_type' => 'user'
        ]);
        return $this->log('user', $action, $logData);
    }

    /**
     * Log form activities
     */
    public function logForm($action, $formData = [])
    {
        $logData = array_merge($formData, [
            'resource_type' => 'form'
        ]);
        return $this->log('form', $action, $logData);
    }

    /**
     * Log general activities
     */
    public function logGeneral($action, $category, $data = [])
    {
        $logData = array_merge($data, [
            'category' => $category
        ]);
        return $this->log('general', $action, $logData);
    }

    /**
     * Log pengaduan activities (create, update status)
     */
    public function logPengaduan($action, $pengaduanId, $data = [])
    {
        $logData = array_merge($data, [
            'pengaduan_id' => $pengaduanId,
            'resource_type' => 'pengaduan'
        ]);
        return $this->log('pengaduan', $action, $logData);
    }

    /**
     * Log contact/support messages
     */
    public function logSupport($action, $messageId, $data = [])
    {
        $logData = array_merge($data, [
            'support_id' => $messageId,
            'resource_type' => 'support'
        ]);
        return $this->log('support', $action, $logData);
    }

    /**
     * Log profile activities (edit, change password, etc)
     */
    public function logProfile($action, $userId, $data = [])
    {
        $logData = array_merge($data, [
            'target_user_id' => $userId,
            'resource_type' => 'profile'
        ]);
        return $this->log('profile', $action, $logData);
    }

    /**
     * Log penduduk activities (create, update, delete)
     */
    public function logPenduduk($action, $pendudukId, $data = [])
    {
        $logData = array_merge($data, [
            'penduduk_id' => $pendudukId,
            'resource_type' => 'penduduk'
        ]);
        return $this->log('penduduk', $action, $logData);
    }

    /**
     * Core logging method
     */
    private function log($type, $action, $data = [])
    {
        try {
            $logEntry = [
                'type' => $type,
                'action' => $action,
                'timestamp' => now(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'url' => Request::url(),
                'method' => Request::method(),
                'data' => $data
            ];

            // Tambah user info jika authenticated
            if (Auth::check()) {
                $user = Auth::user();
                $logEntry['user_id'] = $user->id;
                $logEntry['user_email'] = $user->email;
                $logEntry['user_name'] = $user->name ?? $user->username;
            }
            
            // Ambil user_name dari data parameter (untuk saat login ketika Auth belum fully established)
            if (!empty($data['user_name'])) {
                $logEntry['user_name'] = $data['user_name'];
            }
            
            // Ambil data lainnya yang dikirim (seperti login_method)
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    // Jangan override keys yang sudah ada, kecuali user_name
                    if ($key === 'user_name' || !isset($logEntry[$key])) {
                        $logEntry[$key] = $value;
                    }
                }
            }

            // Kirim HANYA ke Firebase (tidak ke local database)
            Log::channel('firebase')->info(
                "Activity: {$type} - {$action}",
                $logEntry
            );

            return true;

        } catch (\Exception $e) {
            // Log error ke console/stderr untuk debugging
            error_log('Activity logging failed: ' . $e->getMessage());
            return false;
        }
    }
}
