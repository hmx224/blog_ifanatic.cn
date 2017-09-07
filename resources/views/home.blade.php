@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">欢迎来到爱狂热</div>

                    @if(Auth::guest())
                        <div class="panel-heading" style="color: deeppink; font-size: large;">注: 没有收到邮件，可以去垃圾邮件查看下。
                        </div>
                    @endif

                    <div class="panel-body">
                        @if($user->is_active == 0)
                            @if($mark_email == App\Model\User::EMAIL_TYPE['qq'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                <a style="color: deeppink; font-size: x-large"
                                   href="{{ App\Model\User::EMAIL_TYPE_URL['qq'] }}">{{ $user->email }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @elseif($mark_email == App\Model\User::EMAIL_TYPE['126'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                <a style="color: deeppink; font-size: x-large"
                                   href="{{ App\Model\User::EMAIL_TYPE_URL['126'] }}">{{ $user->email  }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @elseif($mark_email == App\Model\User::EMAIL_TYPE['163'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                     <a style="color: deeppink; font-size: x-large"
                                        href="{{ App\Model\User::EMAIL_TYPE_URL['163'] }}">{{ $user->email }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @elseif($mark_email == App\Model\User::EMAIL_TYPE['sina'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                     <a style="color: deeppink; font-size: x-large"
                                        href="{{ App\Model\User::EMAIL_TYPE_URL['sina'] }}">{{ $user->email }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @elseif($mark_email == App\Model\User::EMAIL_TYPE['hotmail'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                     <a style="color: deeppink; font-size: x-large"
                                        href="{{ App\Model\User::EMAIL_TYPE_URL['hotmail'] }}">{{ $user->email }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @elseif($mark_email == App\Model\User::EMAIL_TYPE['gmail'])
                                <span>尊敬的用户您需要去注册的邮箱<span>
                                     <a style="color: deeppink; font-size: x-large"
                                        href="{{ App\Model\User::EMAIL_TYPE_URL['gmail'] }}">{{ $user->email }}</a>
                                </span>激活方可尽情的玩耍!</span>

                            @endif
                        @else
                            <span>已经成功登录!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
