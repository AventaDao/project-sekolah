# Firebase Logging & Activity Tracking - Complete Guide

## 2E - Test Firebase Logging & Integrasi ke Key Actions

### Overview
Firebase Logging sudah diintegrasikan ke key actions dalam aplikasi:
- ✅ Pengajuan Surat (CREATE & UPDATE)
- ✅ Approval/Persetujuan Surat
- ✅ User Authentication
- ✅ Form Submissions
- ✅ Admin Actions

---

## 🧪 Test Routes (Development Only)

### 1. Simple Firebase Test
```
POST /firebase-test/log
```
Mengirim test logs untuk semua tipe activities.

**Response:**
```json
{
  "status": "success",
  "message": "Firebase logging tests sent successfully!",
  "note": "Check Firebase Console > Firestore Database > activity_logs collection"
}
```

### 2. Test Pengajuan Surat Logging
```
POST /firebase-test/log-pengajuan/{pengajuanSuratId}
```
Mengirim logs untuk pengajuan surat (simulasi create).

**Example:**
```
POST /firebase-test/log-pengajuan/123
```

**Response:**
```json
{
  "status": "success",
  "message": "Pengajuan logging test sent!",
  "pengajuan_id": 123,
  "jenis_surat": "Surat Keterangan Usaha"
}
```

### 3. Test Approval Logging
```
POST /firebase-test/log-approval/{pengajuanSuratId}
```
Mengirim logs untuk approval/persetujuan surat.

**Example:**
```
POST /firebase-test/log-approval/123
```

**Response:**
```json
{
  "status": "success",
  "message": "Approval logging test sent!",
  "pengajuan_id": 123,
  "approved_by": "Admin Name"
}
```

---

## 📊 Integration Points

### 1. Pengajuan Surat Creation (`PengajuanSuratController@store`)

**What gets logged:**
- Document creation event
- Form submission event
- User who submitted
- Jenis surat
- Status (Draft)

**Firebase Collections:**
- `activity_logs` → `document` type
- `activity_logs` → `form` type

**Code:**
```php
// Di PengajuanSuratController@store
$this->activityLogger->logDocument('create', $pengajuanSurat->id, [
    'nomor_pengajuan' => $nomorPengajuan,
    'jenis_surat' => $validated['jenis_surat'],
    'status' => $pengajuanSurat->status,
    'user_id' => Auth::id()
]);

$this->activityLogger->logForm('submit_pengajuan', [
    'form_name' => 'pengajuan_surat_' . $validated['jenis_surat'],
    'nomor_pengajuan' => $nomorPengajuan,
    'pengajuan_id' => $pengajuanSurat->id
]);
```

### 2. Pengajuan Status Update (`PengajuanSuratController@updateStatus`)

**What gets logged:**
- Approval/status change event
- Previous & new status
- Admin notes
- Who approved (admin)
- Approval status (processing, completed, rejected)

**Firebase Collections:**
- `activity_logs` → `approval` type
- `activity_logs` → `user` type

**Code:**
```php
// Di PengajuanSuratController@updateStatus
$this->activityLogger->logApproval('update_status', $pengajuanSurat->id, $approvalStatus, [
    'nomor_pengajuan' => $pengajuanSurat->nomor_pengajuan,
    'previous_status' => $pengajuanSurat->getOriginal('status'),
    'new_status' => $validated['status'],
    'catatan_admin' => $validated['catatan_admin'] ?? null,
    'approved_by' => Auth::user()->name,
    'approved_by_id' => Auth::id()
]);

$this->activityLogger->logUser('approve_pengajuan', Auth::id(), [
    'action' => 'update_status',
    'target_pengajuan_id' => $pengajuanSurat->id,
    'role' => Auth::user()->role
]);
```

---

## 🔍 Firebase Data Structure

### Document Type Log
```json
{
  "type": "document",
  "action": "create",
  "timestamp": "2026-01-19T10:30:00Z",
  "ip_address": "192.168.1.1",
  "user_agent": "Mozilla/5.0...",
  "url": "http://localhost:8000/pengajuan-surat",
  "method": "POST",
  "user_id": 1,
  "user_email": "user@example.com",
  "user_name": "John Doe",
  "data": {
    "document_id": 123,
    "resource_type": "document",
    "nomor_pengajuan": "PS-001-2026",
    "jenis_surat": "Surat Keterangan Usaha",
    "status": "Menunggu",
    "user_id": 1
  }
}
```

### Approval Type Log
```json
{
  "type": "approval",
  "action": "update_status",
  "timestamp": "2026-01-19T11:00:00Z",
  "ip_address": "192.168.1.1",
  "user_agent": "Mozilla/5.0...",
  "url": "http://localhost:8000/admin/pengajuan-surat/123",
  "method": "POST",
  "user_id": 2,
  "user_email": "admin@example.com",
  "user_name": "Admin",
  "data": {
    "approval_id": 123,
    "approval_status": "completed",
    "resource_type": "approval",
    "nomor_pengajuan": "PS-001-2026",
    "previous_status": "Diproses",
    "new_status": "Selesai",
    "catatan_admin": "Dokumen sudah selesai diproses",
    "approved_by": "Admin",
    "approved_by_id": 2
  }
}
```

### Form Type Log
```json
{
  "type": "form",
  "action": "submit_pengajuan",
  "timestamp": "2026-01-19T10:30:00Z",
  "user_id": 1,
  "user_email": "user@example.com",
  "user_name": "John Doe",
  "data": {
    "resource_type": "form",
    "form_name": "pengajuan_surat_Surat Keterangan Usaha",
    "nomor_pengajuan": "PS-001-2026",
    "pengajuan_id": 123
  }
}
```

### User Action Type Log
```json
{
  "type": "user",
  "action": "approve_pengajuan",
  "timestamp": "2026-01-19T11:00:00Z",
  "user_id": 2,
  "user_email": "admin@example.com",
  "user_name": "Admin",
  "data": {
    "target_user_id": 2,
    "resource_type": "user",
    "action": "update_status",
    "target_pengajuan_id": 123,
    "role": "admin"
  }
}
```

---

## 🎯 How to Use ActivityLogger in Other Controllers

### Import ActivityLogger
```php
use App\Services\ActivityLogger;

class YourController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }
}
```

### Log Authentication
```php
$this->activityLogger->logAuthentication('login', [
    'method' => 'manual',
    'timestamp' => now(),
    'social_provider' => 'google' // optional
]);
```

### Log Document
```php
$this->activityLogger->logDocument('update', $documentId, [
    'document_type' => 'surat_pengantar',
    'status' => 'published',
    'changes' => ['title' => 'Old Title → New Title']
]);
```

### Log Approval
```php
$this->activityLogger->logApproval('reject', $approvalId, 'rejected', [
    'reason' => 'Invalid document',
    'feedback' => 'Please resubmit with correct format'
]);
```

### Log User
```php
$this->activityLogger->logUser('delete', $userId, [
    'reason' => 'Account deactivation request',
    'deleted_by' => Auth::user()->name
]);
```

### Log Form
```php
$this->activityLogger->logForm('submit_contact_form', [
    'form_name' => 'contact_us',
    'fields_submitted' => ['name', 'email', 'message'],
    'response_type' => 'inquiry'
]);
```

### Log General
```php
$this->activityLogger->logGeneral('backup_run', 'system_maintenance', [
    'backup_size' => '2.5GB',
    'duration_seconds' => 1234
]);
```

---

## 📋 Activity Type Reference

| Type | Action | Use Case |
|------|--------|----------|
| `authentication` | `login`, `logout`, `register` | User auth events |
| `document` | `create`, `update`, `delete`, `publish` | Document CRUD |
| `approval` | `approve`, `reject`, `review`, `update_status` | Approval workflows |
| `user` | `create`, `update`, `delete`, `ban`, `approve` | User management |
| `form` | `submit_*`, `validate`, `incomplete` | Form submissions |
| `general` | Any action | System events, maintenance |

---

## 🧪 Testing Checklist

### Manual Testing Steps:

1. **Start the application**
   ```bash
   php artisan serve
   ```

2. **Test Simple Firebase Log**
   - Open: `http://localhost:8000/firebase-test`
   - Click: "Send Test Logs"
   - Check Firebase Console for `activity_logs` collection

3. **Test Pengajuan Surat**
   - Create a new pengajuan surat
   - Check Firebase Console → `activity_logs` for "document" & "form" types
   - Verify user info is captured correctly

4. **Test Approval**
   - Go to Admin Dashboard → Pengajuan Surat
   - Update status to "Diproses" or "Selesai"
   - Check Firebase Console for "approval" & "user" types
   - Verify admin info and status change details

5. **Verify Data Integrity**
   - Check timestamp accuracy
   - Verify IP address capture
   - Confirm user info (id, email, name)
   - Check status transitions are logged

---

## 🔒 Security & Best Practices

### ✅ Do's:
- Always sanitize sensitive data before logging
- Include user context for audit trails
- Log both before and after states
- Use appropriate log levels

### ❌ Don'ts:
- Don't log passwords or sensitive credentials
- Don't log full request/response bodies if too large
- Don't log in tight loops (performance)
- Don't expose Firebase keys in logs

---

## 🚀 Future Enhancements

### Planned Features:
1. Real-time activity dashboard
2. Advanced filtering & search
3. Activity reports & analytics
4. Automated alerts for suspicious activities
5. Activity retention policies
6. Export logs to BigQuery

---

## 📞 Troubleshooting

### Logs not appearing in Firebase?
1. Check Firebase connection in `config/firebase.php`
2. Verify Firestore database is active
3. Check Laravel logs: `storage/logs/laravel.log`
4. Ensure `.env` has `FIREBASE_*` variables

### Missing user information?
1. Ensure user is authenticated (`Auth::check()`)
2. Verify user model has `email`, `name` fields
3. Check for custom user implementations

### Performance issues?
1. Consider async logging with queues
2. Implement log batching
3. Archive old logs in Firestore

---

## 📚 Related Files

- [ActivityLogger Service](../app/Services/ActivityLogger.php)
- [FirebaseTestController](../app/Http/Controllers/FirebaseTestController.php)
- [PengajuanSuratController](../app/Http/Controllers/PengajuanSuratController.php)
- [Firebase Config](../config/firebase.php)
- [Logging Config](../config/logging.php)

---

**Last Updated:** January 19, 2026  
**Status:** ✅ Complete & Integrated
