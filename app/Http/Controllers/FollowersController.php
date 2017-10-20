<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Auth;

class FollowersController extends Controller
{
    protected $userRepository;

    /**
     * FollowersController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // 被关注用户  vue中默认查看谁关注了我，默认走index方法。
    public function index()
    {
        //某个文章的用户信息
        $userToFollow = $this->userRepository->byId(request('user'));
        //当前登录用户的信息 .用api_token替换掉
//        $userApi = $this->user->byId(request('user_api'));
        $user = Auth::guard('api')->user();
        //取出当前文章所有关注者id
        $followers = $userToFollow->followersUser()->pluck('follower_id')->toArray();

        //当前用户是否在当前文章用户关系表中，在的话就true
        if (in_array($user->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    //关注用户
    public function follow()
    {
        //某个文章的用户信息
        $userToFollow = $this->userRepository->byId(request('user'));
        //当前登录用户的信息 用api_token替换掉
//        $userApi = $this->user->byId(request('user_api'));
        //关注
        $user_api = user('api');
        \Log::debug('当前用户信息', [$user_api]);

        $followed = $user_api->followThisUser($userToFollow->id);

        //用户发起一个attach请求
        if (count($followed['attached']) > 0) {
            //发送站内信和发邮件
            $userToFollow->notify(new NewUserFollowNotification());

            //文章的用户的关注数+1
            $userToFollow->increment('followers_count');

            //当前登录用户跟随者+1
            $user_api->increment('followings_count');

            return response()->json(['followed' => true]);
        } else {
            $userToFollow->decrement('followers_count');

            $user_api->decrement('followings_count');

            return response()->json(['followed' => false]);
        }
    }

    //用户关注数
    public function followersCount()
    {
        //某个文章的用户信息
        $userToFollow = $this->userRepository->byId(request('user'));

        return response()->json(['followers_count' => $userToFollow->followers_count]);
    }
}
