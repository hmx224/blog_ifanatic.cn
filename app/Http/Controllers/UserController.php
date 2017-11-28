<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{

    protected $user;

    /**
     * UserController constructor.
     * @param $userRepository
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

    public function setting()
    {
        $user = $this->user->byId(Auth::id());

        return view('users.setting', compact('user'));
    }

    public function store(Request $request)
    {
        $request = $request->all();
        dd($request);
    }

    public function changeAvatarForm()
    {
        $user = $this->user->byId(Auth::id());

        return view('users.avatar', compact('user'));
    }

    public function changeAvatar(Request $request, $id)
    {
        $user = $this->user->byId($id);

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
        $user = $this->user->byId(Auth::id());

        return view('users.change_password', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = $this->user->byId(Auth::id());
        if ($user == null) {
            \Session::flash('flash_warning', '无此记录');
            return redirect('/user/change_password_form');
        }
        $input = $request->all();

        //判断提交的旧密码是否正确
        if (\Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);
            $user->save();

            flash('密码修改成功', 'success');

            return redirect('/');
        }

        flash('密码修改失败', 'danger');
        return redirect()->to($this->getRedirectUrl())->withInput();
    }

    public function about()
    {
        return view('users.about');
    }

    public function show()
    {

    }
}
