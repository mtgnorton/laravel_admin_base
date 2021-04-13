<?php

namespace App;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

trait ApiResponse
{
    /**
     * @var int
     */


    /**
     * author: mtg
     * time: 2020/9/19   17:18
     * function description:
     * @param array $data
     * @param int $code 200:响应正常,400 错误
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfer($data = [], $msg = null, $code = 200)
    {
        if (is_string($data)) {
            $msg  = $data;
            $data = [];
        }
        if (!$msg) {
            $msg = "获取成功";
        }

        return response()->json([
            'message' => $msg,
            'data'    => $data,
        ], $code);
    }


}
