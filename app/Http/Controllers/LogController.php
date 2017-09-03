<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//记录日志方法
class LogController extends Controller
{
    //  bug更新日志
    public function logBug()
    {
        return view('layouts.log_bug');
    }

    // 业务逻辑更新日志
    public function businessLogic()
    {
        return view('layouts.log_logic');
    }


}
