<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireDiscordAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->discord_id) {
            return redirect()->route('login.discord');
        }

        return $next($request);
    }
}
