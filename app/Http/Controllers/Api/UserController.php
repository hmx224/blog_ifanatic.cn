<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Auth;
use Facades\App\Services\Api\ApiService;

class UserController extends Controller
{

    protected $user;

    /**
     * UserController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

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


    public function info()
    {
        $user = $this->user->byId(Auth::user()->id);

        return view('users.info', compact('user'));
    }
}
