<?php

namespace App\Model;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\OperationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FrontOperationLog extends Base
{
    protected $table = "front_operation_log";

    public static $methodColors = [
        'GET'    => 'green',
        'POST'   => 'yellow',
        'PUT'    => 'blue',
        'DELETE' => 'red',
    ];

    public static $methods = [
        'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
        'LINK', 'UNLINK', 'COPY', 'HEAD', 'PURGE',
    ];

    /**
     * Log belongs to users.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
