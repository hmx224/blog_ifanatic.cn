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

        if (count($github_user_list) > 0) {
            $data = [
                'confirmation_token' => $github_user->getAccessToken(),
                'api_token' => bcrypt(str_random(120))
            ];

            $github_user_list->update($data);

            \Auth::login($github_user_list);

        } else {
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

            $github_user = $this->user->create($data);

            \Auth::login($github_user);
        }


        return redirect('/');
    }

    public function weibo()
    {
        $socialite = new SocialiteManager(config('services'));

        return $socialite->driver('weibo')->redirect();

    }

    public function weiboLogin()
    {
        $socialite = new SocialiteManager(config('services'));

        $weibo_user = $socialite->driver('weibo')->user();

        \Log::info('weibo授权信息:', [$weibo_user]);

        $weibo_user_list = $this->user->getUserInfoBy($weibo_user->getName());

        if (count($weibo_user_list) > 0) {
            $data = [
                'confirmation_token' => $weibo_user->getAccessToken(),
                'api_token' => bcrypt(str_random(120))
            ];

            $weibo_user_list->update($data);
            \Auth::login($weibo_user_list);

        } else {
            $data = [
                'name' => $weibo_user->getName(),
                'nick_name' => $weibo_user->getNickname(),
                'email' => !empty($weibo_user->getEmail()) ? $weibo_user->getEmail() : "",
                'avatar' => $weibo_user->getAvatar(),
                'password' => bcrypt('123456'),
                'is_active' => User::STATUS_ACTIVE,
                'remember_token' => bcrypt(str_random(64)),
                'confirmation_token' => $weibo_user->getAccessToken(),
                'api_token' => bcrypt(str_random(120)),
                'source' => User::SOURCE_SINA_WEIBO
            ];

            $weibo_user = $this->user->create($data);

            \Auth::login($weibo_user);
        }

        return redirect('/');
    }
}
