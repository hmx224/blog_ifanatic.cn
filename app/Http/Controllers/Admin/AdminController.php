<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;

class AdminController extends Controller
{
    //后台首页
    public function index()
    {
        return view('admin.admin');
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login()
    {
        $data = Request::all();

//        $data =[
//            'name' => $data['name'],
//            'password' =>$data['password'],
//            'captcha' =>$data['captcha'],
//        ];

        $name = 'humengxu';
        $password = '123456';

        if($name == $data['name'] && $password == $data['password']){

            flash('登录成功', 'success');
            return redirect('/admin');
        }



    }
}
