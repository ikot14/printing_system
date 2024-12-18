<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserDeleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();  // Get the current authenticated user

        // Check if the user exists in the database (they might be soft deleted)
        if ($user && !$user->exists) {
            Auth::logout();  // Log the user out if they do not exist (soft deleted or deleted)
            return redirect()->route('login')->with('error', 'Your account has been deleted.');
        }

        return $next($request);  // Continue processing the request
    }
}

