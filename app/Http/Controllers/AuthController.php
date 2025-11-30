<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Mail\ResetPasswordMail;
use App\Mail\SendOtpMail;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16',
            'password' => 'required|min:6',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berupa angka (tidak boleh ada huruf atau karakter)',
            'nik.digits' => 'NIK harus tepat 16 digit',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $credentials = [
            'nik' => $request->nik,
            'password' => $request->password
        ];
        
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            Activity::log('login', 'Login berhasil');
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'nik' => 'NIK atau password yang Anda masukkan salah.',
        ])->withInput($request->only('nik'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:users,nik|unique:penduduks,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|size:5',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berupa angka (tidak boleh ada huruf atau karakter)',
            'nik.digits' => 'NIK harus tepat 16 digit',
            'nik.unique' => 'NIK sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Gunakan DB Transaction untuk memastikan data tersimpan di kedua tabel
        DB::beginTransaction();
        
        try {
            // Simpan data ke tabel users
            $user = User::create([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'kewarganegaraan' => $request->kewarganegaraan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
            ]);

            // Simpan data ke tabel penduduks (otomatis)
            Penduduk::create([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'kewarganegaraan' => $request->kewarganegaraan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_telepon' => $request->no_telepon,
                'status_hidup' => 'Hidup', // Default status
                'source_type' => 'registrasi', // User registration, bukan data kelahiran
            ]);

            DB::commit();

            $request->session()->flash('registered_nik', $request->nik);

            // Log activity - login sebagai user baru (auth belum dilakukan, jadi manual set user)
            Activity::log('register', 'Pendaftaran akun baru', $user->id, 'User');

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Data Anda telah tercatat sebagai penduduk desa. Silakan login menggunakan NIK dan password Anda.');
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ])->withInput();
        }
    }
    
    public function sendOtp($user = null, $fromRegister = false)
    {
        if (!$user) {
            if (Auth::check()) {
                $user = Auth::user();
            } elseif (session('verify_email')) {
                $user = User::where('email', session('verify_email'))->firstOrFail();
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Email tidak ditemukan.']);
            }
        }

        $setResendOtp = 60;

        if (session('last_otp_sent') && abs((int)now()->diffInSeconds(session('last_otp_sent'))) < $setResendOtp) {
            return back()->withErrors(['otp' => 'Tunggu ' . $setResendOtp . ' detik sebelum mengirim ulang OTP.']);
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->otp_code = bcrypt($otp);
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        $subject = 'OTP Verifikasi Email';
        Mail::to($user->email)->send(new SendOtpMail(
            $subject,
            $user->nama_lengkap,
            $otp,
            $user->otp_expires_at->format('d M Y H:i:s')
        ));

        session([
            'verify_email' => $user->email,
            'last_otp_sent' => now(),
        ]);

        if ($fromRegister) {
            return redirect()->route('verify.form')->with('success', 'Kode OTP telah dikirim ke ' . $user->email);
        }
        return back()->with('success', 'Kode OTP baru telah dikirim ke ' . $user->email);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = null;
        if (session('verify_email')) {
            $user = User::where('email', session('verify_email'))->first();
        }

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Data verifikasi tidak ditemukan.']);
        }

        if (!Hash::check($request->otp, $user->otp_code)) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }
        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Log activity
        Activity::log('email_verify', 'Verifikasi email berhasil', $user->id, 'User');

        session()->forget(['verify_email', 'last_otp_sent']);

        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi!');
    }

    public function showVerifyForm()
    {
        if (!session('verify_email') || !Auth::check()) {
            if (Auth::check()) {
                $user = Auth::user();
                return $this->sendOtp($user, true);
            }
            return redirect()->route('login');
        }

        $cooldown = 0;
        $setResendOtp = 60;
        if (session('last_otp_sent')) {
            $diff = (int)now()->diffInSeconds(session('last_otp_sent'));
            $cooldown = abs($diff);
        }

        return view('auth.verify-email', [
            'cooldown' => $cooldown,
            'timeResendOtp' => $setResendOtp
        ]);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $currentUrl = request()->fullUrl();

        if (str_contains($currentUrl, 'localhost')) {
            $newUrl = str_replace('localhost', '127.0.0.1', $currentUrl);
            return redirect()->to($newUrl);
        }
        
        $socialUser = Socialite::driver($provider)->user();
        $email = $socialUser->getEmail();

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'nama_lengkap' => $socialUser->name ?? $socialUser->getNickname(),
                'email' => $email,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'is_verified' => true
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function showRequestForm()
    {
        return view('auth.forgot-password.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem kami']);
        }

        // Generate token menggunakan format: numeric_id + hash (lebih aman dari hexadecimal)
        // Format: 16 random hex chars - ini lebih robust daripada yang sebelumnya
        $token = strtolower(substr(hash('sha256', random_bytes(32)), 0, 32));

        // Delete old token first to avoid conflicts
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Insert new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Generate reset link menggunakan PATH-based token bukan query parameter (lebih aman dari email rewriting)
        $resetLink = 'http://localhost:8000/password-reset/' . $token;

        \Log::info('Reset link generated', [
            'email' => $request->email,
            'token_length' => strlen($token),
            'token_first_16' => substr($token, 0, 16),
            'reset_link' => $resetLink
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail(
            $user->nama_lengkap,
            $resetLink,
            now()->addMinutes(30)->format('d M Y H:i:s')
        ));

        return redirect()->route('login')->with('success', 'Silahkan cek email Anda untuk link reset password.');
    }

    public function showResetForm($token = null)
    {
        try {
            // Token sekarang dari path parameter (lebih aman dari email rewriting)
            \Log::info('========== RESET FORM ACCESSED ==========');
            \Log::info('Token from path parameter', ['token' => $token, 'length' => strlen($token ?? '')]);
            
            // Jika token tidak ada atau kosong, redirect ke forgot password form
            if (!$token || empty(trim($token))) {
                \Log::warning('No token provided - redirecting to forgot password form');
                return redirect()->route('forgot_password.email_form');
            }
            
            // Step 1: Query database
            $getEmail = DB::table('password_reset_tokens')
                ->where('token', $token)
                ->first();

            \Log::info('Step 1: Query for token', ['found' => $getEmail ? 'YES' : 'NO', 'query_token' => $token]);
            
            if ($getEmail) {
                \Log::info('Token found in DB', ['email' => $getEmail->email, 'db_token' => $getEmail->token, 'match' => $getEmail->token === $token]);
            } else {
                \Log::warning('Token NOT found. Checking all tokens in DB:');
                $allTokens = DB::table('password_reset_tokens')->get();
                foreach ($allTokens as $t) {
                    \Log::info('DB token', ['token' => $t->token, 'email' => $t->email, 'matches_param' => $t->token === $token]);
                }
            }

            if (!$getEmail) {
                \Log::warning('Token not found - redirecting to request new one');
                // Redirect tanpa error message jika langsung diakses, dengan error message jika dari invalid token
                return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa. Silakan request ulang reset password.']);
            }

            // Check if token is expired (more than 30 minutes)
            $createdAt = \Carbon\Carbon::parse($getEmail->created_at);
            $minutesPassed = abs(now()->diffInMinutes($createdAt));
            
            \Log::info('Step 2: Expiry check', ['created_at' => $getEmail->created_at, 'now' => now()->toDateTimeString(), 'minutes_passed' => $minutesPassed]);
            
            if ($minutesPassed > 30) {
                \Log::warning('Token expired', ['minutes_passed' => $minutesPassed]);
                DB::table('password_reset_tokens')->where('token', $token)->delete();
                return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token sudah kadaluarsa, silakan request ulang.']);
            }

            $user = User::whereEmail($getEmail->email)->first();
            
            \Log::info('Step 3: User lookup', ['email' => $getEmail->email, 'user_found' => $user ? 'YES' : 'NO']);
            
            if (!$user) {
                \Log::warning('User not found', ['email' => $getEmail->email]);
                return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'User tidak ditemukan.']);
            }

            \Log::info('========== ALL CHECKS PASSED - SHOWING FORM ==========');
            \Log::info('Passing to view', ['user_email' => $user->email, 'token' => substr($token, 0, 20)]);

            $credensial = [
                'token' => $token,
                'user' =>$user
            ];
            
            return view('auth.forgot-password.reset', compact('credensial'));
            
        } catch (\Exception $e) {
            \Log::error('showResetForm exception', ['error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
            return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token tidak valid.']);
        }

        // Check if token is expired (more than 30 minutes)
        $createdAt = \Carbon\Carbon::parse($reset->created_at);
        $minutesPassed = abs(now()->diffInMinutes($createdAt));

        if ($minutesPassed > 30) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token sudah kadaluarsa, silakan request ulang.']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        // Log activity untuk user yang reset password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            Activity::log('password_change', 'Reset password berhasil', $user->id, 'User');
        }
        
        $request->session()->flash('registered_email', $request->email);
        return redirect('/login')->with('success', 'Password berhasil direset! Silahkan Login menggunakan password baru Anda');
    }

    public function logout(Request $request)
    {
        // Log activity sebelum logout
        Activity::log('logout', 'Logout berhasil');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Show edit profile form
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    /**
     * Update user profile with avatar upload
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:15',
            'pekerjaan' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'avatar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'pekerjaan' => $request->pekerjaan,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                \Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $file = $request->file('avatar');
            $filename = 'avatars/' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $filename, 'public');
            $data['avatar'] = $filename;
        }

        $user->update($data);

        // Log activity
        Activity::log('profile_update', 'Update profil berhasil', $user->id, 'User');

        return redirect()->route('myprofile')->with('success', 'Profil berhasil diperbarui!');
    }
}