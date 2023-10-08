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
        $user = Auth::user();
       
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                if ($user->role->name=="ADMIN") { // Example: Check if the user is an admin
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role->name=="COMPANY") { // Example: Check if the user is a company admin
                    return redirect()->route('company.dashboard');
                } 
            }
        }

        return $next($request);
    }
}
