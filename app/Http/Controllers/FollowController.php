<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;

class FollowController extends Controller
{
    protected $user;

    /**
     * FollowController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    // 被关注用户
    public function index($id)
    {
        $user = $this->user->byId($id);


        $followers = $user->followers()->pluck('follower_id')->toArray();

//        dd($followers);
//        dump(Auth::guard('api')->user());

        if (in_array(Auth::guard('api')->user()->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    //关注用户
    public function follow()
    {

    }
}
