<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $name = $user->nama_lengkap;
                $role = $user->role;
                
                // Handle avatar: check if user has avatar in storage, fallback to default or provider avatar
                if ($user->provider == null) {
                    // Local user: check if avatar exists in storage
                    if ($user->avatar && strpos($user->avatar, 'avatars/') === 0) {
                        $avatar = asset('storage/' . $user->avatar);
                    } else if ($user->avatar) {
                        // Fallback for old avatar format
                        $avatar = url('assets/images/user/' . $user->avatar);
                    } else {
                        // No avatar: use default
                        $avatar = url('assets/images/avatar-default.png');
                    }
                } else {
                    // Social provider user: use provider avatar
                    $avatar = $user->avatar;
                }

                $view->with(compact('user', 'name', 'role', 'avatar'));
            } else {
                $view->with([
                    'avatar' => url('assets/images/avatar-default.png'),
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
