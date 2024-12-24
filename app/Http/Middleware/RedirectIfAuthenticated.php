<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        $authenticated = false;

        // Periksa autentikasi pada setiap guard
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $authenticated = true;
                break; // Hentikan pengecekan jika sudah ada yang terautentikasi
            }
        }

        // Jika tidak ada guard yang terautentikasi, arahkan ke halaman error
        if (!$authenticated) {
            return redirect()->route('pages.500'); // Ganti dengan route yang sesuai
        }


        return $next($request);
    }
}
