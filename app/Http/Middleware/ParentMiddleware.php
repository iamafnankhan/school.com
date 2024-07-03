<?php
// app/Http/Middleware/ParentMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ParentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 4) {
            return $next($request);
        }
        return redirect('/'); // or an error page
    }
}
