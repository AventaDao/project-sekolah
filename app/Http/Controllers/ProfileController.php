<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
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
            // Determine avatar URL - use same logic as AppServiceProvider for consistency
            $avatarUrl = null;
            
            // Check if user has a valid avatar (not null, not empty, not whitespace)
            if ($user->avatar && trim($user->avatar) !== '') {
                // Check if avatar is in storage format (avatars/ folder)
                if (strpos($user->avatar, 'avatars/') === 0) {
                    // Use Storage::url() untuk file di public storage
                    $avatarUrl = \Storage::disk('public')->url($user->avatar);
                } elseif (strpos($user->avatar, 'http') === 0) {
                    // Already a full URL (from social auth provider)
                    $avatarUrl = $user->avatar;
                } else {
                    // Old avatar format in public/assets/images/user/
                    $avatarUrl = asset('assets/images/user/' . $user->avatar);
                }
            }

            // If no avatar, assign a default avatar from template (1-10) based on user ID
            if (!$avatarUrl) {
                // Use modulo to get a number between 1-10 based on user ID for consistency
                $avatarNumber = ($user->id % 10) + 1;
                $avatarUrl = asset("assets/images/user/avatar-{$avatarNumber}.jpg");
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

