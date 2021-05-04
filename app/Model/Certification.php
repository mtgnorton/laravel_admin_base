<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Certification
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $name 姓名
 * @property string $id_card 身份证
 * @property string $card_image_front 身份证正面
 * @property string $card_image_behind 身份证反面
 * @property int $type 认证类型 1 kyc1 ,2 kyc2
 * @property int $status 状态 0未审核 1已审核 -1已拒绝
 * @property int $remark 备注,审核失败原因
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Certification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Certification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Certification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereCardImageBehind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereCardImageFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereUserId($value)
 * @mixin \Eloquent
 * @property string $username 用户名
 * @method static \Illuminate\Database\Eloquent\Builder|Certification whereUsername($value)
 */
class Certification extends Base
{

    const  TYPE = [
        'NO'   => 0, //验证
        'KYC1' => 1, // kyc1
        'KYC2' => 2, // kyc2
    ];

    const STATUS = [
        'REFUSE'     => -1,
        'NO AUDIT'   => 0,
        'PASS AUDIT' => 1,
    ];


}
