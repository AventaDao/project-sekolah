# Firebase Logging - Practical Examples

## Quick Start: Implementasi Activity Logging

### Example 1: Di AuthController (Login)

```php
<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Log authentication event
            $this->activityLogger->logAuthentication('login', [
                'method' => 'email_password',
                'email' => $request->email,
                'timestamp' => now()
            ]);

            return redirect()->intended('dashboard');
        }

        // Log failed login
        $this->activityLogger->logAuthentication('login_failed', [
            'email' => $request->email,
            'reason' => 'invalid_credentials'
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Log before logout
        $this->activityLogger->logAuthentication('logout', [
            'user_id' => Auth::id(),
            'timestamp' => now()
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
```

---

### Example 2: Di PengaduanController

```php
<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Store pengaduan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'deskripsi' => 'required|string|min:20',
            'lampiran' => 'nullable|file|max:5120'
        ]);

        // Simpan pengaduan
        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(),
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'status' => 'open'
        ]);

        // Log document creation
        $this->activityLogger->logDocument('create', $pengaduan->id, [
            'document_type' => 'pengaduan',
            'kategori' => $validated['kategori'],
            'status' => 'open'
        ]);

        // Log form submission
        $this->activityLogger->logForm('submit_pengaduan', [
            'form_name' => 'pengaduan_' . $validated['kategori'],
            'pengaduan_id' => $pengaduan->id,
            'kategori' => $validated['kategori']
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim');
    }

    /**
     * Update pengaduan status (admin only)
     */
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed,rejected',
            'respons' => 'required_if:status,closed|string'
        ]);

        $oldStatus = $pengaduan->status;
        $pengaduan->update($validated);

        // Log approval (status change)
        $this->activityLogger->logApproval('update_status', $pengaduan->id, $validated['status'], [
            'document_type' => 'pengaduan',
            'previous_status' => $oldStatus,
            'new_status' => $validated['status'],
            'respons_summary' => substr($validated['respons'] ?? '', 0, 100),
            'approved_by' => Auth::user()->name
        ]);

        // Log user action (who did the approval)
        $this->activityLogger->logUser('approve_pengaduan', Auth::id(), [
            'target_pengaduan_id' => $pengaduan->id,
            'action' => 'update_status',
            'new_status' => $validated['status']
        ]);

        return redirect()->back()
            ->with('success', 'Status pengaduan berhasil diperbarui');
    }
}
```

---

### Example 3: Di AdminController (User Management)

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Create new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:user,admin,operator'
        ]);

        $user = User::create($validated);

        // Log user creation
        $this->activityLogger->logUser('create', $user->id, [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $validated['role'],
            'created_by' => Auth::user()->name
        ]);

        return redirect()->back()
            ->with('success', 'User berhasil dibuat');
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:user,admin,operator'
        ]);

        $oldRole = $user->role;
        $user->update(['role' => $validated['role']]);

        // Log user update
        $this->activityLogger->logUser('update_role', $user->id, [
            'old_role' => $oldRole,
            'new_role' => $validated['role'],
            'changed_by' => Auth::user()->name
        ]);

        return redirect()->back()
            ->with('success', 'Role user berhasil diperbarui');
    }

    /**
     * Deactivate user
     */
    public function deactivate(User $user)
    {
        $user->update(['is_active' => false]);

        // Log user deactivation
        $this->activityLogger->logUser('deactivate', $user->id, [
            'email' => $user->email,
            'name' => $user->name,
            'reason' => 'admin_request',
            'deactivated_by' => Auth::user()->name,
            'deactivated_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'User berhasil dinonaktifkan');
    }
}
```

---

### Example 4: Di BeritaDesaController

```php
<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaDesaController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Create berita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|min:10',
            'konten' => 'required|string|min:50',
            'kategori' => 'required|string'
        ]);

        $berita = Berita::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'kategori' => $validated['kategori'],
            'status' => 'draft'
        ]);

        // Log document creation
        $this->activityLogger->logDocument('create', $berita->id, [
            'document_type' => 'berita',
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'status' => 'draft',
            'created_by' => Auth::user()->name
        ]);

        // Log form submission
        $this->activityLogger->logForm('submit_berita', [
            'form_name' => 'create_berita_' . $validated['kategori'],
            'berita_id' => $berita->id,
            'word_count' => str_word_count($validated['konten'])
        ]);

        return redirect()->route('admin.berita.show', $berita)
            ->with('success', 'Berita berhasil dibuat');
    }

    /**
     * Publish berita
     */
    public function publish(Berita $berita)
    {
        $berita->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        // Log document publication
        $this->activityLogger->logDocument('publish', $berita->id, [
            'document_type' => 'berita',
            'judul' => $berita->judul,
            'previous_status' => 'draft',
            'new_status' => 'published',
            'published_by' => Auth::user()->name
        ]);

        // Log approval (publication is like approval)
        $this->activityLogger->logApproval('publish', $berita->id, 'published', [
            'document_type' => 'berita',
            'judul' => $berita->judul,
            'published_by' => Auth::user()->name,
            'published_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Berita berhasil dipublikasikan');
    }

    /**
     * Delete berita
     */
    public function destroy(Berita $berita)
    {
        // Log before deletion
        $this->activityLogger->logDocument('delete', $berita->id, [
            'document_type' => 'berita',
            'judul' => $berita->judul,
            'status' => $berita->status,
            'deleted_by' => Auth::user()->name,
            'deleted_at' => now()
        ]);

        $berita->delete();

        return redirect()->back()
            ->with('success', 'Berita berhasil dihapus');
    }
}
```

---

## Middleware untuk Auto-Logging

Anda bisa membuat middleware untuk auto-log semua requests:

```php
<?php

namespace App\Http\Middleware;

use App\Services\ActivityLogger;
use Closure;
use Illuminate\Http\Request;

class LogActivity
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Log only specific routes
        if ($this->shouldLog($request)) {
            $this->activityLogger->logGeneral(
                strtolower($request->method()),
                'route_access',
                [
                    'route' => $request->route()?->getName(),
                    'path' => $request->path(),
                    'status_code' => $response->getStatusCode()
                ]
            );
        }

        return $response;
    }

    private function shouldLog(Request $request)
    {
        $loggedRoutes = [
            'pengajuan-surat.store',
            'pengajuan-surat.destroy',
            'pengaduan.store',
            'berita.store',
            'berita.publish'
        ];

        return in_array($request->route()?->getName(), $loggedRoutes);
    }
}
```

Register di `app/Http/Kernel.php`:
```php
protected $routeMiddleware = [
    // ...
    'log-activity' => \App\Http\Middleware\LogActivity::class,
];
```

---

## Testing Activity Logging

### Unit Test Example

```php
<?php

namespace Tests\Unit;

use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ActivityLoggerTest extends TestCase
{
    protected $activityLogger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->activityLogger = app(ActivityLogger::class);
    }

    public function test_log_authentication()
    {
        Log::fake();

        $this->activityLogger->logAuthentication('login', [
            'method' => 'email_password'
        ]);

        Log::assertLogged('firebase', function ($level, $message, $context) {
            return $context['type'] === 'authentication' &&
                   $context['action'] === 'login';
        });
    }

    public function test_log_document_with_user_context()
    {
        Log::fake();
        $user = $this->createUser();
        $this->actingAs($user);

        $this->activityLogger->logDocument('create', 123, [
            'title' => 'Test Document'
        ]);

        Log::assertLogged('firebase', function ($level, $message, $context) {
            return $context['data']['document_id'] === 123 &&
                   $context['user_id'] === Auth::id();
        });
    }
}
```

---

## Best Practices

### ✅ Do's:
1. Always include relevant context
2. Use consistent naming conventions
3. Log before & after for updates
4. Include user identification
5. Sanitize sensitive data

### ❌ Don'ts:
1. Don't log passwords or tokens
2. Don't log entire request bodies
3. Don't log in tight loops
4. Don't ignore logging errors
5. Don't forget to handle exceptions

---

**Last Updated:** January 19, 2026
