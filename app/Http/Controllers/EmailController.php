<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    //
    public function verify($token)
    {
        //
        $user = User::where('confirmation_token', $token)->first();

        if (is_null($user)) {
            flash('邮箱验证失败', 'success');

            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = str_random(45);
        $user->save();

        Auth::login($user);

        flash('邮箱验证成功', 'danger');

        //跳转到首页面
        return redirect('/questions');
    }
}
