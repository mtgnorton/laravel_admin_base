<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class JudgeUserDisabled
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (!Auth::user()){
            return $next($request);
        }
        if (Auth::user()->isDisabled()) {
            new_api_exception(ll('the account has been disabled'));
        }
        return $next($request);
    }
}
