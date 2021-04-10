<?php

namespace App\Service;


use App\ApiException;
use App\Model\Message;
use App\Model\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserService
{


    public function create(array $data, $login = false)
    {

        form_validate($data, [
            'username'              => 'required|unique:users|max:20',
            'mobile'                => 'required|regex:/^1[34578][0-9]{9}$/',
            'code'                  => 'required|auth_code:' . $data['mobile'] . ',' . Message::Type['REGISTER_CODE'],
            'password'              => 'required|min:6',
            'password_confirmation' => 'required',
            'invite_code'           => ['exists:users']
        ]);

        $data['password'] = Hash::make($data['password']);

        db_start_trans();

        $parent = User::newModelInstance(['id' => 0]);

        if (isset($data['invite_code'])) {
            $parent = User::where('invite_code', $data['invite_code'])->first();
        }
        $registerData = collect($data)
            ->only(['username', 'mobile', 'password'])
            ->toArray();

        $registerData['parent_id']   = $parent->id;
        $registerData['invite_code'] = Str::uuid()->getHex();
        $user                        = User::create($registerData);
        $user->createRelation($parent);
        app('SmsService')->useAuthCode($data['mobile'], $data['code']);

        $user->update([
            'parent_id' => $parent->id
        ]);
        db_commit();


        return $user;
    }


    public function login(array $data)
    {
        form_validate($data, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $token = Auth::attempt($data);

        if (!$token) {
            new_api_exception('general.username or password error');
        }

        $user = Auth::user();

        if ($user->last_token) {
            //让上一个token失效
            try {
                Auth::setToken($user->last_token)->invalidate();
            } catch (TokenExpiredException $e) {
                echo $e->getMessage();
                //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
            }
        }
        $user->last_token = $token;

        $user->save();

        return $token;
    }


}
