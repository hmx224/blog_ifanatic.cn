<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Facades\App\Services\Api\ApiService;
use Auth;

class UserController extends Controller
{
    //模拟测试 passport

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();

            $data = $user->createToken('Pizza App')->accessToken;

            return ApiService::run(200, ['token' => $data]);//自己封装的数据统一返回格式

        } else {

            return ApiService::run(401);//自己封装的数据统一返回格式
        }
    }
}
