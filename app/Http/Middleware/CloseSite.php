<?php

namespace App\Http\Middleware;

use Closure;

class CloseSite
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


        if (conf('is_close_site') == 'on') {
            $closeCanVisitUserIds = explode(',', conf('close_can_visit_users'));

            if ($request->route()->getName() == 'user.login' && in_array($request->username, $closeCanVisitUserIds)) {
                return $next($request);
            } else {

                if ($request->user() && in_array($request->user()->username, $closeCanVisitUserIds)) {
                    return $next($request);
                }
            }
            
            new_api_exception(conf('close_site_reason') ? conf('close_site_reason') : '系统维护中,请稍后访问', 408);
        }//
        return $next($request);
    }
}
