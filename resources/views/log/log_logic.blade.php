@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">业务日志更新时间表</div>
                    <div class="panel-body">
                        <ul style="list-style: none;font-size:16px;">
                            <li style="font-size: x-large; color: deeppink;">20170902</li>
                            <li>1.文章首页面增加更新时间标识</li>
                            <li style="font-size: x-large; color: deeppink;">20170904</li>
                            <li>1.文章首页面增加会员名称标识</li>
                            <li style="font-size: x-large; color: deeppink;">20170905</li>
                            <li>1.增加留言板模块，留言板模块支持表情发送，暂时不支持传图片，和对留言的回复</li>
                            <li style="font-size: x-large; color: deeppink;">20170908</li>
                            <li>1.增加用户之间的互相关注，关注数</li>

                            <li style="font-size: x-large; color: deeppink;">20170919</li>
                            <li>1.首页面和留言板页面做大的更改,增加了分页效果</li>
                            <li style="font-size: x-large; color: deeppink;">20170921</li>
                            <li>1.用户登录,注册增加验证码</li>
                            <li style="font-size: x-large; color: deeppink;">20170922</li>
                            <li>1.用户修改密码,提示框优化</li>
                            <li style="font-size: x-large; color: deeppink;">20170928</li>
                            <li>1.增加页面中回到顶部的按钮</li>
                            <li style="font-size: x-large; color: deeppink;">20171023</li>
                            <li>1.私信通知功能</li>
                            <li>2.评论组件实现</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
