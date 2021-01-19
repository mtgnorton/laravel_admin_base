<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PreventRepeat
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $preventTime = 3)
    {

        $identifier = Auth::id() ?? $request->ip();

        $params = $request->all();

        $params['url'] = $request->getBaseUrl();

        $key = "preventRepeat:" . md5($identifier . json_encode($params));

        if (Redis::incr($key) == 1) {
            Redis::expire($key, $preventTime);
        } else {
            if (Redis::ttl($key) == -1) { //避免发生死锁

                Redis::expire($key, $preventTime);
            }
            new_api_exception(ll('please repeat submit'));
        }

        return $next($request);
    }
}
