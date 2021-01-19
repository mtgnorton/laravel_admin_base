<?php

namespace App\Service;


use App\ApiException;
use App\Model\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserService
{


    public function create(array $data, $login = false)
    {

        form_validate($data, [
            'username' => 'required|unique:users|max:20',
            'mobile'   => 'required|regex:/^1[34578][0-9]{9}$/',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        $token = "";
        DB::transaction(function () use ($data, &$token, $login) {

            $user = User::create($data);

            if ($login) {
                $token = Auth::login($user);
            }

        });

        return $token;
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
