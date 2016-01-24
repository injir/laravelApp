<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\UserController;
class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (UserController::getAuthStatus() && UserController::getUserStatus()) {
            return $next($request);
        }
        else{
            return redirect('/');
        }

    }
}
