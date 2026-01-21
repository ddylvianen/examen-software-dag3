<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $now = now()->timestamp;
            $timeout = config('session.lifetime') * 60; // Convert to seconds

            if ($lastActivity && ($now - $lastActivity) > $timeout) {
                Auth::logout();
                session()->flush();
                return redirect('/login')->with('message', 'Your session has expired due to inactivity.');
            }

            session(['last_activity' => $now]);
        }

        return $next($request);
    }
}
