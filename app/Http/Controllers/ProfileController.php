<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Services\ActivityLogger;
use Carbon\Carbon;

class ProfileController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }
    /**
     * Generate initials from name
     */
    private function getInitials($name)
    {
        $parts = explode(' ', trim($name));
        $initials = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        return $initials ?: '?';
    }

    /**
     * Generate SVG placeholder avatar
     */
    private function generatePlaceholderAvatar($name, $size = 180)
    {
        $initials = $this->getInitials($name);
        $colors = ['4680ff', '2ca87f', 'ff5370', 'ffc107', '17a2b8', '6f42c1'];
        $hash = crc32($name);
        $color = $colors[abs($hash) % count($colors)];

        // Calculate positions outside string interpolation
        $halfSize = $size / 2;
        $fontSize = $size / 2.5;

        $svg = "
        <svg width='{$size}' height='{$size}' xmlns='http://www.w3.org/2000/svg'>
            <rect width='{$size}' height='{$size}' fill='#{$color}' rx='20'/>
            <text x='{$halfSize}' y='{$halfSize}' font-size='{$fontSize}' fill='white' text-anchor='middle' dy='.3em' font-family='Arial, sans-serif' font-weight='bold'>
                {$initials}
            </text>
        </svg>
        ";

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Show user profile
     */
    public function show()
    {
        $user = Auth::user();

        // Cache user profile data untuk 1 jam
        $cacheKey = 'user_profile_' . $user->id;

        $profileData = Cache::remember($cacheKey, 300, function () use ($user) {
            // Determine avatar URL
            $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : null;

            // If no avatar, generate SVG placeholder with initials
            if (!$avatarUrl) {
                $avatarUrl = $this->generatePlaceholderAvatar($user->nama_lengkap);
            }

            return [
                'user' => $user,
                'tanggalLahir' => $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir) : null,
                'umur' => $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->age : null,
                'formatTanggal' => $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->format('d-m-Y') : 'N/A',
                'avatarUrl' => $avatarUrl,
            ];
        });

        return view('myprofile', $profileData);
    }

    /**
     * Clear profile cache (call this after profile update)
     */
    public static function clearCache($userId)
    {
        Cache::forget('user_profile_' . $userId);
    }
}

