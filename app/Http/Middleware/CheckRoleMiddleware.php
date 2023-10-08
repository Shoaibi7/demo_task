<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = Auth::user();

        // dd($roles);
        // die;
        if ($user->role->name==$roles) { // Example: Check if the user is an admin
            return redirect()->route('admin.dashboard');
        } elseif ($user->role->name==$roles) { // Example: Check if the user is a company admin
            return redirect()->route('company.dashboard');
        } 

        // Redirect unauthorized users to a default route (e.g., 'home')
        // return redirect('/home');
        return $next($request);
    }
}
