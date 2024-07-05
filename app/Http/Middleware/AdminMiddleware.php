<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, log out and redirect
            Auth::logout();
            return redirect(''); // Replace with your actual login URL
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user type is 1
        if ($user->user_type == 1) {
            // Proceed with the request
            return $next($request);
        }

        // If user type is not 1, log out and redirect
        Auth::logout();
        return redirect(''); // Replace with your actual login URL
    }

}
