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

    public function changeAvatarForm()
    {
        $user = $this->userRepository->byId(Auth::id());

        return view('users.avatar', compact('user'));
    }

    public function changeAvatar(Request $request, $id)
    {
        $user = $this->userRepository->byId($id);

        $avatar = $request->get('avatar');

        if ($avatar == null) {
            flash('更新头像失败', 'danger');
            return redirect()->route('users.change_avatar_form', compact('user'));
        }

        $data = ['avatar' => $avatar];

        $user->update($data);

        flash('更新头像成功', 'success');

        return redirect()->route('users.change_avatar_form', compact('user'));
    }

    public function changePasswordForm()
    {
        $user = $this->userRepository->byId(Auth::id());

        return view('users.change_password', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->userRepository->byId(Auth::id());
        if ($user == null) {
            \Session::flash('flash_warning', '无此记录');
            return redirect('/user/change_password_form');
        }

        $input = $request->all();
        if ($input['name'] == null) {
            \Session::flash('flash_warning', '姓名不能为空!');
            return redirect('/users/change_password_form');
        }

        if ($input['new'] != $input['pwdConfirm']) {
            \Session::flash('flash_warning', '两次输入的密码不一致!');
            return redirect('/users/change_password_form');
        }

        if ($input['new'] != null && $input['pwdConfirm'] != null) {
            $user->password = bcrypt($input['new']);
        }

        $user->update($input);

        \Session::flash('flash_success', '保存成功!');
        return redirect('/users/change_password_form');

    }

}
