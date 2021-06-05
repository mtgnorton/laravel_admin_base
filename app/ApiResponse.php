<?php

namespace App;

use Illuminate\Pagination\LengthAwarePaginator;
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
     * @param int $code 200:响应正常,202=业务逻辑错误如参数错误,203=登录错误
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfer($data = [], $msg = null, $code = 200)
    {

        if ($data instanceof LengthAwarePaginator) {
            $rs['total'] = $data->total();
            $rs['page']  = $data->currentPage();
            $rs['limit'] = (int)$data->perPage();
            $rs['list']  = $data->items();

            $data = $rs;
        }

        if (is_string($data)) {
            $msg  = $data;
            $data = [];
        }
        if (!$msg) {
            $msg = ll('request success');
        }

        return response()->json([
            'code'    => $code,
            'message' => $msg,
            'data'    => $data == [] ? (object)[] : $data,
        ]);
    }



}
