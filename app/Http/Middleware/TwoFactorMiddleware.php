<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorMiddleware
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        
        // Skip if user doesn't have 2FA enabled
        if (!$user->hasTwoFactorEnabled()) {
            return $next($request);
        }

        // Skip if 2FA is already verified for this session
        if (Session::get('2fa_verified_' . $user->id)) {
            return $next($request);
        }

        // Skip 2FA verification routes to avoid infinite redirect
        $skipRoutes = [
            '2fa.verify',
            '2fa.verify.post',
            'logout',
            'login'
        ];

        if (in_array($request->route()->getName(), $skipRoutes)) {
            return $next($request);
        }

        // Redirect to 2FA verification page
        return redirect()->route('2fa.verify');
    }
}
