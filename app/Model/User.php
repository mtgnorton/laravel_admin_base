<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

/**
 * App\Model\User
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $pay_password 支付密码
 * @property string $email 电子邮箱
 * @property string $mobile 手机号
 * @property int $is_disabled 是否禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePayPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $last_token 最后一次登录的token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastToken($value)
 */
class User extends Authenticatable implements JWTSubject
{

    protected $guarded = [];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * author: mtg
     * time: 2021/4/2   18:17
     * function description:所有上级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parents()
    {
        return $this->belongsToMany(User::class, 'user_recommend_relation', 'user_id', 'parent_id')->withPivot('layer')->orderBy('layer', 'asc')->withTimestamps();
    }

    /**
     * author: mtg
     * time: 2021/4/2   18:17
     * function description:所有下级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany(User::class, 'user_recommend_relation', 'parent_id', 'user_id')->withPivot('layer')->orderBy('layer', 'asc');
    }


    public function createRelation(User $parent)
    {
        if ($parent->id == 0) {
            return;
        }
        $parents = $parent->parents->prepend($parent);

        $userLayers = $parents->mapWithKeys(function ($parent) {
            $layer = data_get($parent, 'pivot') ? $parent->pivot->layer + 1 : 1;
            return [
                $parent->id => [
                    'layer' => $layer
                ]
            ];
        });
        $this->parents()->attach($userLayers);
    }


    /**
     * author: mtg
     * time: 2021/3/25   16:50
     * function description:是否设置支付密码
     */
    public function hasPayPassword()
    {
        return !!$this->pay_password;
    }

    /**
     * author: mtg
     * time: 2021/3/25   16:48
     * function description:验证支付密码
     * @param $inputPayPassword
     * @return bool
     */
    public function validatePayPassword($inputPayPassword)
    {
        return Hash::check($inputPayPassword, $this->pay_password);

    }


    /**
     * author: mtg
     * time: 2021/4/2   17:51 用户是否禁用
     * function description:
     * @return bool
     */
    public function isDisabled()
    {
        return !!$this->is_disabled;
    }

}
