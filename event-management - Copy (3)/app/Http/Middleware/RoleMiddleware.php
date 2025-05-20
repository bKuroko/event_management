<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        
        // Logic to check if the user has the given role
        if (auth()->user() && auth()->user()->role == $role) {
            return $next($request);
        }
        // Add this temporarily in your RoleMiddleware to see what user roles are being passed



        return redirect('/home');  // Or wherever you want to redirect unauthorized users
    }
}