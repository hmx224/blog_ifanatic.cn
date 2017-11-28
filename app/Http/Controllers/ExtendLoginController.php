<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Overtrue\Socialite\SocialiteManager;


class ExtendLoginController extends Controller
{
    protected $user;

    /**
     * ExtendLoginController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function github()
    {
        $socialite = new SocialiteManager(config('services'));

        return $socialite->driver('github')->redirect();

    }

    public function githubLogin()
    {
        $socialite = new SocialiteManager(config('services'));

        $github_user = $socialite->driver('github')->user();

        \Log::info('github授权信息:', [$github_user]);

        $github_user_list = $this->user->getUserInfoBy($github_user->getUsername());

        $data = [
            'name' => $github_user->getUsername(),
            'nick_name' => $github_user->getNickname(),
            'email' => $github_user->getEmail(),
            'avatar' => $github_user->getAvatar(),
            'password' => bcrypt('123456'),
            'is_active' => User::STATUS_ACTIVE,
            'remember_token' => bcrypt(str_random(64)),
            'confirmation_token' => $github_user->getAccessToken(),
            'api_token' => bcrypt(str_random(120)),
            'source' => User::SOURCE_GITHUB
        ];

        if (count($github_user_list) > 0) {
            $data = [
                'confirmation_token' => $github_user->getAccessToken(),
                'api_token' => bcrypt(str_random(120))
            ];

            $github_user_list->update($data);
            \Auth::login($github_user_list);

        } else {
            $github_user = $this->user->create($data);

            \Auth::login($github_user);
        }


        return redirect('/');
    }

    public function weibo()
    {
        $socialite = new SocialiteManager(config('services'));

        return $socialite->driver('github')->redirect();

    }

    public function weiboLogin()
    {

    }

    public function weixinLogin()
    {

    }

    public function qqLogin()
    {

    }


}
