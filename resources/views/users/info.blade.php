@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>用户信息</span>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">会员名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="用户名"
                                           value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                           value="{{  $user->password  }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">邮箱地址</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="邮箱 "
                                           value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">会员头像</label>
                                <div class="col-sm-5">
                                    <img class="img-circle" width="100px" height="100px;" src="{{ $user->avatar }}"
                                         alt="会员头像">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">会员激活状态</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" placeholder="会员激活状态"
                                           value="{{ $user->is_active==1 ? '是': '否' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updated_at" class="col-sm-2 control-label">会员激活时间</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="updated_at" placeholder="会员激活时间"
                                           value="{{ $user->updated_at }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created_at" class="col-sm-2 control-label">会员注册时间</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="created_at" placeholder="会员注册时间"
                                           value="{{ $user->created_at}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" disabled>更新信息</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
