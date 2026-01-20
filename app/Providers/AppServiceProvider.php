<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use App\Services\ActivityLogger;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register Activity Logger
        $this->app->singleton('activity_logger', function () {
            return new ActivityLogger();
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $name = $user->nama_lengkap;
                $role = $user->role;
                
                // Handle avatar
                if ($user->avatar) {
                    // Check if avatar is in storage format (avatars/ folder)
                    if (strpos($user->avatar, 'avatars/') === 0) {
                        // Use Storage::url() untuk file di public storage
                        $avatar = Storage::disk('public')->url($user->avatar);
                    } elseif (strpos($user->avatar, 'http') === 0) {
                        // Already a full URL (from provider)
                        $avatar = $user->avatar;
                    } else {
                        // Old avatar format in public/assets/images/user/
                        $avatar = asset('assets/images/user/' . $user->avatar);
                    }
                } else {
                    // No avatar: use default
                    $avatar = asset('assets/images/avatar-default.png');
                }

                $view->with(compact('user', 'name', 'role', 'avatar'));
            } else {
                $view->with([
                    'avatar' => asset('assets/images/avatar-default.png'),
                    'name' => 'Guest',
                    'role' => null,
                    'user' => null
                ]);
            }
        });
    }

    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });

        // for Ngrok used, delete if not
//         if ($this->app->environment('local')) {
//         URL::forceRootUrl(config('app.url'));
//         URL::forceScheme('https');
// }

    }
}
