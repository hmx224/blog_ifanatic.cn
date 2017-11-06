@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>修改密码</span>
                    </div>
                    <div class="panel-body">

                        {!! Form::model($user,['method' => 'PATCH', 'class' => 'form-horizontal','action' => ['UserController@update', $user->id]]) !!}

                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('name', '姓名:',['class' => 'control-label col-sm-2']) !!}--}}
                        {{--<div class="col-sm-6">--}}
                        {{--{!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            {!! Form::label('old_password', '原始密码:',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-6">
                                {!! Form::password('old_password', ['class' => 'form-control','placeholder'=>'原始密码']) !!}
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('password', '输入新密码:',['class' => 'control-label col-sm-2']) !!}--}}
                        {{--<div class="col-sm-6">--}}
                        {{--{!! Form::password('password', ['class' => 'form-control' ,'placeholder'=>'输入新密码']) !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">输入新密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"
                                       placeholder="输入新密码" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('password_confirm', '确认新密码:',['class' => 'control-label col-sm-2']) !!}--}}
                        {{--<div class="col-sm-6">--}}
                        {{--{!! Form::password('password_confirm', ['class' => 'form-control' ,'placeholder'=>'确认新密码']) !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">确认新密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" placeholder="确认新密码" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    更改密码
                                </button>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div><!-- /.panel -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </div>

@endsection