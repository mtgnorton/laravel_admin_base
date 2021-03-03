<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id 用户id
 * @property int $target 发送地址
 * @property string $content 发送内容
 * @property string $code 验证码
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
class Message extends Base
{

    // 值为20以下的为验证码类型
    const Type = [
        'REGISTER_CODE'        => 1,
        'FORGET_PASSWORD_CODE' => 5,
        'SET_PAY_PASSWORD'     => 10,
    ];


    public function isUsed()
    {
        return !!$this->is_use;
    }

    public function validateCode($code)
    {
        return $this->code == $code;
    }
}
