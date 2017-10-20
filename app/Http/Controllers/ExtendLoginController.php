<?php

namespace App\Http\Controllers;

use App\Models\User;
use Overtrue\Socialite\SocialiteManager;


class ExtendLoginController extends Controller
{

    protected $config = [
        'github' => [
            'client_id' => '77b7e13b20562605d670',
            'client_secret' => '2a735dc2ae3cf8d53ba58e1298ae2bcebbc57d50',
            'redirect' => 'https://www.ifanatic.cn/githubLogin',  //local
        ],
    ];

    public function github()
    {

        $socialite = new SocialiteManager($this->config);

        return $socialite->driver('github')->redirect();

    }

    public function githubLogin()
    {
        $socialite = new SocialiteManager($this->config);

        $githubUser = $socialite->driver('github')->user();

        dd($githubUser);

        User::create([
            'name' => $githubUser->getUsername(),
            'nick_name' => $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'avatar' => $githubUser->getAvatar(),
            'password' => bcrypt(str_random(64)),
            'is_active' => User::STATUS_ACTIVE,
            'remember_token' => bcrypt(str_random(64)),
            'confirmation_token' => bcrypt(str_random(64)),
            'api_token' => bcrypt(str_random(120)),
        ]);

        return redirect('/');
    }


}
