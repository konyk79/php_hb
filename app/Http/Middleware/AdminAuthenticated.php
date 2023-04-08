<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if user is not logged in or if has not admin role return page could not be found
        $user = Auth::user();
        if (is_null($user))   return abort(404);
        if ($request->user() && !$request->user()->isAdmin())
        {
            return abort(404);
        }
        return $next($request);
    }
}
