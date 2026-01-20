<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class FirebaseTestController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Test Firebase logging
     */
    public function testLog(Request $request)
    {
        try {
            // Test berbagai jenis logging
            
            // 1. Test Authentication Log
            $this->activityLogger->logAuthentication('test_login', [
                'method' => 'manual_test',
                'timestamp' => now()
            ]);

            // 2. Test Document Log
            $this->activityLogger->logDocument('test_create', 123, [
                'document_type' => 'surat_pengantar',
                'status' => 'draft'
            ]);

            // 3. Test Approval Log
            $this->activityLogger->logApproval('test_approve', 456, 'approved', [
                'approver_notes' => 'Test approval'
            ]);

            // 4. Test User Log
            $this->activityLogger->logUser('test_create', 789, [
                'role' => 'admin',
                'status' => 'active'
            ]);

            // 5. Test Form Log
            $this->activityLogger->logForm('test_submit', [
                'form_name' => 'test_form',
                'fields_count' => 5
            ]);

            // 6. Test General Log
            $this->activityLogger->logGeneral('test_action', 'system_test', [
                'message' => 'Firebase logging test successful'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Firebase logging tests sent successfully!',
                'note' => 'Check Firebase Console > Firestore Database > activity_logs collection'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simple test page
     */
    public function testPage()
    {
        return view('firebase-test');
    }

    /**
     * Test logging untuk Pengajuan Surat
     */
    public function testPengajuanLog($pengajuanSuratId)
    {
        try {
            $pengajuanSurat = \App\Models\PengajuanSurat::findOrFail($pengajuanSuratId);

            // Simulasi pengajuan surat baru
            $this->activityLogger->logDocument('create', $pengajuanSurat->id, [
                'jenis_surat' => $pengajuanSurat->jenis_surat,
                'status' => $pengajuanSurat->status,
                'keperluan' => substr($pengajuanSurat->keperluan, 0, 50) . '...',
                'user_id' => $pengajuanSurat->user_id
            ]);

            // Log form submission
            $this->activityLogger->logForm('submit_pengajuan', [
                'form_name' => 'pengajuan_surat_' . $pengajuanSurat->jenis_surat,
                'pengajuan_id' => $pengajuanSurat->id,
                'fields_submitted' => ['jenis_surat', 'keperluan', 'surat_pengantar_rw']
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan logging test sent!',
                'pengajuan_id' => $pengajuanSurat->id,
                'jenis_surat' => $pengajuanSurat->jenis_surat
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test logging untuk approval/persetujuan
     */
    public function testApprovalLog($pengajuanSuratId)
    {
        try {
            $pengajuanSurat = \App\Models\PengajuanSurat::findOrFail($pengajuanSuratId);

            // Simulasi approval
            $this->activityLogger->logApproval('approve', $pengajuanSurat->id, 'approved', [
                'pengajuan_id' => $pengajuanSurat->id,
                'jenis_surat' => $pengajuanSurat->jenis_surat,
                'previous_status' => 'pending',
                'new_status' => 'approved',
                'approved_by' => Auth::user()->name,
                'approved_at' => now()
            ]);

            // Log user action (approval action)
            $this->activityLogger->logUser('approve_pengajuan', Auth::id(), [
                'action' => 'approve',
                'target_pengajuan_id' => $pengajuanSurat->id,
                'role' => Auth::user()->roles->first()?->name ?? 'unknown'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Approval logging test sent!',
                'pengajuan_id' => $pengajuanSurat->id,
                'approved_by' => Auth::user()->name
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
