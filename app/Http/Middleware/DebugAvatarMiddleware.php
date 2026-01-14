<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugAvatarMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('test-avatar*') || $request->is('dashboard*')) {
            \Log::info('Avatar Debug:', [
                'user' => auth()->user() ? [
                    'id' => auth()->user()->id,
                    'avatar_field' => auth()->user()->avatar,
                ] : null,
                'url_path' => $request->path(),
            ]);
        }
        
        return $next($request);
    }
}
