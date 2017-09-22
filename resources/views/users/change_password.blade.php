@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>修改头像</span>
                    </div>
                    <div class="panel-body">

                        @include('layouts.flash')

                        {!! Form::model($user,['method' => 'PATCH', 'class' => 'form-horizontal','action' => ['UserController@update', $user->id]]) !!}

                        <div class="form-group">
                            {!! Form::label('name', '姓名:',['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('new', '密码:',['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::password('new', ['class' => 'form-control' ,'placeholder'=>'若不修改请留空']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('pwdConfirm', '确认密码:',['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::password('pwdConfirm', ['class' => 'form-control' ,'placeholder'=>'若不修改请留空']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    保　存
                                </button>
                            </div>
                        </div>

                        @include('errors.list')

                        {!! Form::close() !!}

                    </div>
                </div><!-- /.panel -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </div>

@endsection