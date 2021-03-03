<?php

namespace App\Http\Controllers;


use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
}

