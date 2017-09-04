@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">BUG日志更新时间表</div>
                    <div class="panel-body">
                        <div>
                            <ul style="list-style: none;font-size:16px;">
                                <li style="font-size: x-large; color: deeppink;">20170902</li>
                                <li>1.用户发布文章的过程中图片过大(超过2M)就会上传不了的问题<br>&nbsp;&nbsp;&nbsp;&nbsp;
                                    图片上传默认最大值是2M的图片大小做处理最大值上限到10M，并给友好的提示。
                                </li>
                                <li>2.用户注册后,需要邮箱验证激活,当前用户处于登录状态的问题.<br>&nbsp;&nbsp;&nbsp;&nbsp;
                                    用户注册完成会给出提示去邮箱激活说明，并且页面用户是未登录状态，在邮箱激活完成点击跳转到网站首页会展示用户登录状态。
                                </li>
                                <li style="font-size: x-large; color: deeppink;">20170904</li>
                                <li>1.解决发布文章页面，选择标签时英文的提示的问题<br>&nbsp;&nbsp;&nbsp;&nbsp;
                                    用户发布文章选标签已经改为中文提示.
                                </li>
                                <li>2.解决会员没有激活就能发文章的bug。</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection