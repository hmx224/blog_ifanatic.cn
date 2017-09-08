<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class FollowersController extends Controller
{
    protected $user;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    // 被关注用户  vue中默认查看谁关注了我，默认走index方法。
    public function index()
    {
        //某个文章的用户信息
        $userToFollow = $this->user->byId(request('user'));
        //当前登录用户的信息
        $userApi = $this->user->byId(request('user_api'));
        //取出当前文章所有关注者id
        $followers = $userToFollow->followersUser()->pluck('follower_id')->toArray();

//        dump(Auth::guard('api')->user()); //TODO 前后端暂时没分离

        //当前用户是否在当前文章用户关系表中，在的话就true
        if (in_array($userApi->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    //关注用户
    public function follow()
    {
        //某个文章的用户信息
        $userToFollow = $this->user->byId(request('user'));
        //当前登录用户的信息
        $userApi = $this->user->byId(request('user_api'));
        //关注
        $followed = $userApi->followThisUser($userToFollow->id);

        //用户发起一个attach请求
        if (count($followed['attached']) > 0) {
//            $userToFollow->notify(new NewUserFollowNotification());
            //文章的用户的关注数+1
            $userToFollow->increment('followers_count');

            //当前登录用户跟随者+1
            $userApi->increment('followings_count');

            return response()->json(['followed' => true]);
        } else {
            $userToFollow->decrement('followers_count');

            $userApi->decrement('followings_count');

            return response()->json(['followed' => false]);
        }
    }

    //用户关注数
    public function followersCount()
    {
        //某个文章的用户信息
        $userToFollow = $this->user->byId(request('user'));

        return response()->json(['followers_count' => $userToFollow->followers_count]);
    }
}
