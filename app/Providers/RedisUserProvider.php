<?php

namespace App\Providers;

use App\Model\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Support\Facades\Auth;

class RedisUserProvider extends EloquentUserProvider
{
    /**
     * @var $redis  \redis
     */
    protected $redis;

    protected $prefix;

    protected $userIDKey;

    protected $tokenKey;

    protected $keyExpire;

    public function __construct(HasherContract $hasher, $model, $configs)
    {
        parent::__construct($hasher, $model);

        $this->redis = app("redis");

        $this->tokenKey = $configs['user_token_key'] ?? 'user_token:';

        $this->userIDKey = $configs['user_id_key'] ?? 'user_id:';

        $this->keyExpire = $configs['expire'] ?? 7 * 24 * 60 * 60;
    }


    public function retrieveById($identifier)
    {
        $user = $this->redis->hGetAll($identifier);

        if ($user) {
            $userModel = new User();

            return $userModel->newFromBuilder($user);
        }

        return null;

    }

    public function retrieveByCredentials(array $credentials)
    {


        if (!isset($credentials['api_token'])) {
            return null;
        }

        $key = $this->tokenKey . $credentials['api_token'];


        return $this->retrieveById($key);
    }


    public function getTokenKey()
    {
        return $this->tokenKey;
    }


    /**
     * author: mtg
     * time: 2021/3/6   9:59
     * function description: 保存用户到redis
     * @param string $apiToken
     * @param $user
     */
    public function saveTokenToRedis(string $apiToken, $user)
    {
        if (is_object($user)) {
            $user = $user->toArray();
        }
        $tokenKey = $this->tokenKey . $apiToken;

        $this->redis->hMSet($tokenKey, $user);

        /*用户id对应的token*/

        /*移除掉上一次登录时token对应的用户信息,否则会有冗余数据*/
        if ($lastApiToken = $this->redis->get($this->userIDKey . $user['id'])) {
            $this->redis->del($this->tokenKey . $lastApiToken);
        }

        $this->redis->set($this->userIDKey . $user['id'], $apiToken);

        $this->redis->expire($tokenKey, $this->keyExpire);

        $this->redis->expire($this->userIDKey . $user['id'], $this->keyExpire);

    }


    /**
     * author: mtg
     * time: 2021/3/6   9:59
     * function description:刷新token的有效期
     * @param string $apiToken
     */
    public function updateTokenToRedis(string $apiToken)
    {
        $tokenKey = $this->tokenKey . $apiToken;

        $this->redis->expire($tokenKey, $this->keyExpire);

        $user = $this->redis->hGetAll($tokenKey);

        $this->redis->expire($this->userIDKey . $user['id'], $this->keyExpire);
    }

    /**
     * author: mtg
     * time: 2021/3/6   9:59
     * function description:更新redis中的用户信息
     * @param  $user
     */
    public function updateUserInfo($user)
    {
        if (is_object($user)) {
            $user = $user->toArray();
        }

        $userIDKey = $this->userIDKey . data_get($user, 'id');

        $token = $this->redis->get($userIDKey);

        $tokenKey = $this->tokenKey . $token;

        $this->redis->hMSet($tokenKey, $user);
    }


    public function destroyUser($user)
    {
        if (is_object($user)) {
            $user = $user->toArray();
        }

        $userIDKey = $this->userIDKey . data_get($user, 'id');

        $token = $this->redis->get($userIDKey);

        $tokenKey = $this->tokenKey . $token;


        $this->redis->del($userIDKey, $tokenKey);
    }


    /**
     * author: mtg
     * time: 2021/3/6   10:10
     * function description: 用户所属token是否存在
     * @param string $apiToken
     * @return bool
     */
    public function redisExistToken(string $apiToken)
    {
        $tokenKey = $this->tokenKey . $apiToken;

        return !!$this->redis->hget($tokenKey, 'id');
    }


    /**
     * author: mtg
     * time: 2021/2/22   10:42
     * function description: 判断用户是否登录过
     * @param string $apiToken
     * @return bool
     */
    public function judgeLoginUser($apiToken, $newUserID)
    {
        if (!$apiToken) {
            return true;
        }
        if (!$this->redisExistToken($apiToken)) {
            return true;
        }

        $tokenKey = $this->tokenKey . $apiToken;

        $oldUserID = $this->redis->hget($tokenKey, 'id');

        if ($oldUserID != $newUserID) {
            return true;
        }
        $userKey = $this->userIDKey . $oldUserID;

        $currentApiToken = $this->redis->get($userKey);

        if ($apiToken == $currentApiToken) {
            new_api_exception(ll('user has login'));
        }

        //当$apiToken , $currentApiToken 不一致时,说明两个设备在登录,后一个覆盖前一个

    }

    public function logout()
    {
        $apiToken = $this->redis->get($this->userIDKey . Auth::id());
        if (!$apiToken) {
            new_api_exception(ll('user not exist'));
        }
        $this->redis->del([
            $this->userIDKey . Auth::id(),
            $this->tokenKey . $apiToken
        ]);
        return true;
    }

}
