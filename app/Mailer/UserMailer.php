<?php


namespace App\Mailer;

use App\Models\User;
use Auth;

class UserMailer extends Mailer
{
    //用户关注发邮件
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => 'http://blog.ifanatic.cn',
            'name' => Auth::guard('api')->user()->name
        ];

        $this->sendTo('ifanatic_app_new_user_follow', $data, $email);
    }

    //用户注册发邮件
    public function userRegister(User $user)
    {
        $data = [
            'url' => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name
        ];

        $this->sendTo('ifanatic_app_register', $data, $user->email);

    }

    //用户忘记密码发邮件
    public function passwordReset($token, $email)
    {
        $data = ['url' => url('password/reset', $token)];

        $this->sendTo('ifanatic_app_password_reset', $data, $email);
    }

}