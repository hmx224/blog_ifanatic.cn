<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;

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

    public function edit()
    {
        $user = $this->userRepository->byId(Auth::id());

        return view('users.avatar', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->byId($id);

        $avatar = $request->get('avatar');

        if ($avatar == null){
            flash('更新头像失败', 'danger');
            return redirect()->route('users.edit', compact('user'));
        }

        $data = ['avatar' => $avatar];

        $user->update($data);

        flash('更新头像成功', 'success');

        return redirect()->route('users.edit', compact('user'));
    }

}
