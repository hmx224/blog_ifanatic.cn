@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">控制面板</div>

                    <div class="panel-body">
                        @if($user->is_active == 0)
                            <span>尊敬的用户您需要去注册的邮箱<span style="color: deeppink; font-size: x-large">
                                    {{ $user->email }}</span>激活方可尽情的玩耍!</span>
                        @else
                            <span>已经成功登录!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
