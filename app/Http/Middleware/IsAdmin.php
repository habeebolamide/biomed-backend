<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         // Check if the user is authenticated and is an admin
         if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }
        // Redirect or return an error response if the user is not an admin
        return redirect()->route('/')->with('error', 'You are not authorized to access this page.');
    }
}
