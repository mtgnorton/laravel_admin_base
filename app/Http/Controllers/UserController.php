<?php

namespace App\Http\Controllers;


use App\Model\Message;
use App\Model\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function register(Request $request)
    {
        return $this->transfer([
            'token' => app('UserService')->create($request->all()),
        ], ll('register success'));

    }


    public function login(Request $request)
    {
        return $this->transfer([
            'token' => app('UserService')->login($request->all())
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return $this->transfer(ll('logout success'));
    }


    public function info()
    {
        return $this->transfer(Auth::user());
    }

    /**
     * author: mtg
     * time: 2021/3/4   9:39
     * function description:忘记密码
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword()
    {
        $data = request()->all();
        form_validate($data, [
            'mobile'                => ['required', 'exists:users'],
            'code'                  => ['required', 'auth_code:' . $data['mobile'] . ',' . Message::Type['FORGET_PASSWORD_CODE']],
            'password'              => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
        User::where('mobile', $data['mobile'])->update([
            'password' => Hash::make($data['password'])
        ]);
        return $this->transfer(ll('Modify success'));
    }
    /**
     * author: mtg
     * time: 2021/2/27   16:26
     * function description:设置支付密码
     */
    public function setPayPassword()
    {
        $data = request()->all();


        form_validate($data, [
            'password'              => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required'],
            'code'                  => ['required', 'auth_code:' . Auth::user()->mobile . ',' . Message::Type['SET_PAY_PASSWORD']]
        ]);

        Auth::user()->update([
            'pay_password' => \Hash::make($data['password'])
        ]);

        list($provider) = app('UserService')->getAuthProviderAndToken();

        $provider->updateUserInfo(User::find(Auth::id()));

        return $this->transfer(ll('Modify success'));

    }

}

