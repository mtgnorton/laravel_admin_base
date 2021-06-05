<?php

namespace App\Exceptions;

use App\ApiException;
use App\ApiResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        if ($exception instanceof ApiException) {
            return;
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {

        $prefix = $request->route()->getPrefix();

        $isBackend = $prefix == 'admin';

        // 将方法拦截到自己的ExceptionReport
        if ($exception instanceof ApiException) {

            if (!$isBackend || ($isBackend && is_admin_ajax())) {

                return $this->transfer($exception->getMessage(), null, $exception->getCode());
            }


        }
        return parent::render($request, $exception);
    }
}
