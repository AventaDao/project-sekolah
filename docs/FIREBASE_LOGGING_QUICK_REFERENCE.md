# 🚀 Firebase Logging - Quick Reference Card

## Test Routes (Development Only)

### Available Routes
```
GET  /firebase-test              → Test page
POST /firebase-test/log          → All log types
POST /firebase-test/log-pengajuan/{id}   → Document + Form logs
POST /firebase-test/log-approval/{id}    → Approval + User logs
```

---

## ActivityLogger Methods

### 1. Authentication
```php
$this->activityLogger->logAuthentication('login', [
    'method' => 'email_password',
    'timestamp' => now()
]);
```

### 2. Document
```php
$this->activityLogger->logDocument('create', $documentId, [
    'document_type' => 'surat_pengantar',
    'status' => 'draft'
]);
```

### 3. Approval
```php
$this->activityLogger->logApproval('approve', $approvalId, 'approved', [
    'approver_notes' => 'Approved'
]);
```

### 4. User
```php
$this->activityLogger->logUser('create', $userId, [
    'role' => 'admin',
    'status' => 'active'
]);
```

### 5. Form
```php
$this->activityLogger->logForm('submit_form', [
    'form_name' => 'contact_us',
    'fields_count' => 5
]);
```

### 6. General
```php
$this->activityLogger->logGeneral('backup_run', 'system', [
    'backup_size' => '2.5GB'
]);
```

---

## Setup in Controller

```php
use App\Services\ActivityLogger;

class MyController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public function myMethod()
    {
        // Use $this->activityLogger->log...()
    }
}
```

---

## Firebase Data Structure

**Collection:** `activity_logs`  
**Auto-captured fields:**
- `type` - Log type (document, approval, etc)
- `action` - Specific action (create, approve, etc)
- `timestamp` - ISO 8601 datetime
- `user_id` - Authenticated user ID
- `user_email` - User email
- `user_name` - User name
- `ip_address` - Request IP
- `user_agent` - Browser/client info
- `url` - Request URL
- `method` - HTTP method
- `data` - Custom data (varies by type)

---

## Activity Types & Actions

| Type | Actions | Use Case |
|------|---------|----------|
| **authentication** | login, logout, register | Auth events |
| **document** | create, update, delete, publish | Doc CRUD |
| **approval** | approve, reject, review, update_status | Workflows |
| **user** | create, update, delete, ban | User mgmt |
| **form** | submit_*, validate | Form events |
| **general** | any | System events |

---

## Pengajuan Surat Integration

### On Create (store method)
```php
// Auto-logged:
$this->activityLogger->logDocument('create', $id, [...]);
$this->activityLogger->logForm('submit_pengajuan', [...]);
```

**What's captured:**
- Nomor pengajuan
- Jenis surat
- Status
- User ID

### On Update (updateStatus method)
```php
// Auto-logged:
$this->activityLogger->logApproval('update_status', $id, [...]);
$this->activityLogger->logUser('approve_pengajuan', $userId, [...]);
```

**What's captured:**
- Status transitions
- Admin notes
- Approver info
- Timestamp

---

## Common Patterns

### Log Before Delete
```php
$this->activityLogger->logDocument('delete', $id, [
    'title' => $document->title,
    'status' => $document->status
]);

$document->delete();
```

### Log Status Change
```php
$this->activityLogger->logApproval('update_status', $id, $newStatus, [
    'previous_status' => $oldStatus,
    'new_status' => $newStatus,
    'reason' => $request->reason
]);
```

### Log User Action
```php
$this->activityLogger->logUser('update_role', $targetUserId, [
    'old_role' => $oldRole,
    'new_role' => $newRole,
    'changed_by' => Auth::user()->name
]);
```

---

## Testing

### Manual Test
```bash
# Test all log types
curl -X POST http://localhost:8000/firebase-test/log

# Test pengajuan
curl -X POST http://localhost:8000/firebase-test/log-pengajuan/1

# Test approval
curl -X POST http://localhost:8000/firebase-test/log-approval/1
```

### Check Firebase Console
1. Go to Firebase Console
2. Select your project
3. Navigate to Firestore Database
4. Open `activity_logs` collection
5. View recent logs

---

## Error Handling

```php
try {
    $this->activityLogger->logDocument('create', $id, $data);
} catch (\Exception $e) {
    Log::error('Logging failed: ' . $e->getMessage());
    // App continues - logging is non-blocking
}
```

The service gracefully fails - even if Firebase is down, your app keeps working!

---

## Security Notes

✅ **Safe to log:**
- User IDs & names
- Document IDs & statuses
- Actions & timestamps
- Request URLs & methods

❌ **Never log:**
- Passwords
- API keys/tokens
- Credit cards
- Personal IDs
- Full request bodies

---

## Files Reference

- **Service:** `app/Services/ActivityLogger.php`
- **Test Controller:** `app/Http/Controllers/FirebaseTestController.php`
- **Routes:** `routes/web.php` (lines 261-266)
- **Integration:** `app/Http/Controllers/PengajuanSuratController.php`
- **Config:** `config/firebase.php`, `config/logging.php`

---

## Full Documentation

- **[FIREBASE_LOGGING_USAGE.md](FIREBASE_LOGGING_USAGE.md)** - Complete reference
- **[FIREBASE_LOGGING_EXAMPLES.md](FIREBASE_LOGGING_EXAMPLES.md)** - Code examples
- **[LANGKAH_2E_COMPLETION.md](LANGKAH_2E_COMPLETION.md)** - Implementation details

---

## Version Info

- **Implemented:** January 19, 2026
- **Status:** ✅ Production Ready
- **Last Updated:** January 19, 2026

---

### Quick Copy-Paste Template

```php
// Import at top of controller
use App\Services\ActivityLogger;

// In constructor
public function __construct(ActivityLogger $activityLogger)
{
    $this->activityLogger = $activityLogger;
}

// In methods
$this->activityLogger->log[Type]('action', [...data...]);
```

---

**Print this for quick reference!** 📋
