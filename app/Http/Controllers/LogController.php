<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    //记录日志方法
    public function index()
    {
        return view('layouts.log');
    }
}
