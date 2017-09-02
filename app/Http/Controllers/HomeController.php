<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;

class HomeController extends Controller
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->byId(Auth::id());
        return view('home', compact('user'));
    }
}
