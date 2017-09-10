@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($questions_count !=0)
                            @foreach($questions as $question)
                                <div class="media question_page">
                                    <div class="media-left">
                                        <a href="">
                                            <img class="img-circle" width="50px" height="50px"
                                                 src="{{ isset($question->user->avatar) ? $question->user->avatar: ''}}"
                                                 alt="{{ isset($question->user->name) ? $question->user->name: '' }}">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="/questions/{{ $question->id }}">
                                                {{ isset($question->title)?$question->title:"" }}
                                            </a>
                                        </h4>

                                        <h5 class="">
                                            <span>{{ isset($question->updated_at)?$question->updated_at:"" }}</span>
                                            <span class="pull-right">{{  isset($question->user->name)?$question->user->name:"" }}</span>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="font-size: large; color: deeppink;">暂时没有文章记录</div>
                        @endif
                    </div>
                </div>
            </div>

            @if(Auth::check() && \App\Model\User::find(Auth::user()->id)->is_active == \App\Model\User::STATUS_ACTIVE)
                <div class="col-md-4">
                    <a href="questions/create" class="btn btn-primary btn-block btn-lg">写文章</a>
                    <div class="panel-heading"></div>
                </div>
            @endif

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h2>
                            {{ config('app.name', 'ifanatic.cn') }}
                        </h2>
                        <span>欢迎来到爱狂热的博客，分享你的所见所闻，让我们开怀聊天。</span>
                    </div>
                </div>
            </div>

            <!--友情链接-->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h3>友情链接</h3>
                        <span><a href="http://www.humengxu.com">小胡发掘网</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h4>
                            会员总数<span style="color: deeppink; font-size: x-large">{{$users_count}} </span>人
                        </h4>
                    </div>
                    <div class="panel-heading question-follow">
                        <h3>
                            激活会员列表
                        </h3>
                    </div>

                    <div class="panel-body">
                        <ul style="list-style: none;font-size:14px; margin:0;padding:0;">
                            @foreach($users_active as $user)
                                <li>
                                    <a href="#" style="">{{ $user->name }}</a>
                                    <span class="pull-right">{{ $user->created_at }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="panel-heading question-follow">
                        <h3>
                            未激活会员列表
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul style="list-style: none;font-size:14px; margin:0;padding:0;">
                            @foreach($users_not_active as $user)
                                <li>
                                    <a href="#" style="">{{ $user->name }}</a>
                                    <span class="pull-right">{{ $user->created_at }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <!--支付宝打赏二维码-->
            {{--<div class="col-md-4">--}}
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading question-follow">--}}
            {{--<span>欢迎支付宝打赏</span>--}}
            {{--<h2>--}}
            {{--<img   width="240px" height="240px" src="/images/zhifu/xiaohu-alipay.png" alt="小胡支付宝">--}}
            {{--</h2>--}}

            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

        </div>

        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">--}}
        {{--<legend>显示完整功能</legend>--}}
        {{--</fieldset>--}}

        {{--<div id="question_page"></div>--}}

        {{--<ul id="question_page_list"></ul>--}}

        {{--<passport-clients></passport-clients>--}}
        {{--<passport-authorized-clients></passport-authorized-clients>--}}
        {{--<passport-personal-access-tokens></passport-personal-access-tokens>--}}
    </div>


@endsection

<link rel="stylesheet" href="/layui/css/layui.css" media="all">
<script src="/layui/layui.js" charset="utf-8"></script>

{{--<script>--}}
    {{--var page_num = 10;--}}
    {{--var curr_page = 1;--}}
    {{--var total_page;--}}
    {{--layui.use(['laypage', 'layer'], function () {--}}
        {{--var laypage = layui.laypage, layer = layui.layer;--}}

        {{--$.ajax({--}}
            {{--type: 'post',--}}
            {{--cache: false,--}}
            {{--dataType: 'json',--}}
            {{--async: false, //同步ajax--}}
            {{--data: {--}}
                {{--'_token': '{{ csrf_token() }}',--}}
                {{--'curr_page': curr_page,--}}
            {{--},--}}
            {{--url: 'questions/page_ajax',--}}
            {{--success: function (data) {--}}
{{--//                if (data != "") {--}}
{{--//                    $("#pager").pager({--}}
{{--//                        pagenumber: pagenumber,--}}
{{--//                        pagecount: data.split("$$")[1],--}}
{{--//                        buttonClickCallback: PageClick--}}
{{--//                    });--}}
{{--//                    $("#anhtml").html(data.split("$$")[0]);--}}
{{--//--}}
{{--//                }--}}
            {{--}--}}
        {{--});--}}

        {{--//完整功能--}}
        {{--laypage.render({--}}
            {{--elem: 'question_page',--}}
            {{--count: page_num,--}}
            {{--layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],--}}
            {{--jump: function (obj) {--}}
                {{--console.log(obj)--}}
            {{--}--}}
        {{--});--}}

        {{--//调用分页--}}
        {{--laypage.render({--}}
            {{--elem: 'question_page_list',--}}
            {{--count: page_num,--}}
            {{--curr: curr || 1, //当前页--}}
            {{--jump: function (obj) {--}}
                {{--//模拟渲染--}}
                {{--document.getElementById('biuuu_city_list').innerHTML = function () {--}}
                    {{--var arr = [],--}}
                        {{--thisData = data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);--}}
                    {{--layui.each(thisData, function (index, item) {--}}
                        {{--arr.push('<li>' + item + '</li>');--}}
                    {{--});--}}
                    {{--return arr.join('');--}}
                {{--}();--}}
            {{--}--}}
        {{--});--}}

    {{--});--}}
{{--</script>--}}
