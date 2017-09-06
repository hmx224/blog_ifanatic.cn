<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;

class UserController extends Controller
{

    protected $user;

    /**
     * UserController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function info()
    {
        $user = $this->user->byId(Auth::id());

        return view('users.info', compact('user'));
    }
}
