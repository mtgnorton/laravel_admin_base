<?php

namespace App\Http\Middleware;

use Encore\Admin\Auth\Database\OperationLog as OperationLogModel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Middleware\LogOperation;
use Illuminate\Http\Request;

use App\Model\FrontOperationLog as LogModel;
use Illuminate\Support\Facades\Auth;

class FrontOperationLog extends LogOperation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {

        if ($this->shouldLogOperation($request)) {


            $userID   = 0;
            $username = '';
            if (Auth::user()) {
                $userID   = Auth::user()->id;
                $username = Auth::user()->username;
            }

            $log = [
                'user_id'  => $userID,
                'username' => $username,
                'path'     => substr($request->path(), 0, 255),
                'method'   => $request->method(),
                'ip'       => $request->getClientIp(),
                'input'    => json_encode($request->input()),
            ];

            LogModel::create($log);

        }

        return $next($request);
    }


    protected function shouldLogOperation(Request $request)
    {
        return !!conf('open_front_log');
    }
}
