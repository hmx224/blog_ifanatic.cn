<?php

namespace App\Http\Controllers;

//记录日志方法
class LogController extends Controller
{
    //  bug更新日志
    public function logBug()
    {
        $data ='hmx123456';
        $pass = bcrypt($data);
//        dd($pass);
        return view('log.log_bug');
    }

    // 业务逻辑更新日志
    public function logBusinessLogic()
    {
        return view('log.log_logic');
    }

    //扩展开发更新日志
    public function logExtensionDevelopment()
    {
        return view('log.log_ex_dev');
    }


}
