<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * UserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function info()
    {
        $user = $this->userRepository->byId(Auth::id());

        return view('users.info', compact('user'));
    }
}
