<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use App\Models\User;

class KaryawanAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.karyawan-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password = $request->input('password');

        // Try find by email first
        $user = User::where('email', $identifier)->first();

        // If not found, assume identifier might be NIK and search karyawan
        if (!$user) {
            $karyawan = Karyawan::where('nik', $identifier)->first();
            if ($karyawan && $karyawan->user_id) {
                $user = User::find($karyawan->user_id);
            }
        }

        if (!$user) {
            return back()->withErrors(['identifier' => 'Akun tidak ditemukan'])->withInput();
        }

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['password' => 'Kredensial salah'])->withInput();
        }

        // Optional: ensure role is karyawan
        if ($user->role && $user->role !== 'karyawan') {
            // allow admin or user logins via other forms — but block here
            return back()->withErrors(['identifier' => 'Akun ini bukan akun karyawan'])->withInput();
        }

        Auth::login($user, $request->filled('remember'));

        return redirect()->route('karyawan.absensi.dashboard');
    }
}
