@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>
                    <div class="panel-body">


                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">邮箱:</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码:</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="captcha" class="col-md-4 control-label">验证码:</label>
                                <div class="col-md-3">
                                    <input type="text" name="captcha" class="form-control">

                                </div>
                                <div class="col-md-3" style="cursor:pointer;">
                                    <a id="refresh-captcha">
                                        <img src="{{ captcha_src() }}"
                                             alt="验证码"
                                             title="刷新图片"
                                             width="160"
                                             height="36"
                                             id="captcha"
                                             border="0"
                                             data-captcha-config="default"
                                        >
                                        @if ($errors->has('captcha'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                        @endif
                                    </a>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        登录
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        忘记密码?
                                    </a>
                                </div>

                                <div class="col-md-8 col-md-offset-4">
                                    第三方登录方式:
                                    <strong><a href="{{ url('github/login') }}" target="_blank" title="GitHub授权登录"><i
                                                    class="fa fa-github fa-2x" aria-hidden="true"></i> </a></strong>
                                    <strong><a href="{{url('weibo/login')}}"
                                               target="_blank" title="微博授权登录"><i class="fa fa-weibo fa-2x"
                                                                                     aria-hidden="true"></i></a></strong>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
