@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default ">
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
                                        <h4 class="media-heading" style="font-family: 华文中宋">
                                            <span style="font-weight: 500; font-size: 1.3em;">
                                                {{ isset($question->title)?$question->title:"" }}
                                                <span class="pull-right"
                                                      style="font-size: 20px;">发布于{{ $question->created_at->diffForHumans() }}</span>
                                            </span>
                                            <hr>
                                            <span style="display: block">{{ trim(mb_substr(preg_replace("/<[^>]+>/", '', $question->body),0,64,'utf-8')) }}
                                                <a href="/questions/{{ $question->id }}">...阅读全文</a>
                                            </span>
                                        </h4>
                                        <h5 class="" style="max-width: 600px">
                                            <span>{{ isset($question->updated_at)?$question->updated_at:"" }}</span>
                                            {{--<span>点击量</span>--}}
                                            <span class="pull-right">{{  isset($question->user->name)?$question->user->name:"" }}</span>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach

                            <div style="height: 60px;">
                                <span class='pull-right'>{!! $questions->links() !!}</span>
                            </div>

                        @else
                            <div style="font-size: large; color: deeppink;">暂时没有文章记录</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">

                @if(Auth::check() && \App\Models\User::find(Auth::user()->id)->is_active == \App\Models\User::STATUS_ACTIVE)
                    <a href="questions/create" class="btn btn-primary btn-block btn-lg">写文章</a>
                    <div class="panel-heading"></div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h2>
                            {{ config('app.name', 'ifanatic.cn') }}
                        </h2>
                        <span>欢迎来到爱狂热的博客，分享你的所见所闻，让我们开怀聊天。</span>
                    </div>
                </div>

                <!--友情链接-->
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h3>友情链接</h3>
                        <div style="text-align: left;">
                            <p><a href="http://www.humengxu.com">小胡发掘网</a></p>
                            <p><a href="http://lib.csdn.net/">csdn知识库</a></p>
                            <p><a href="http://phpxiong.cn/">phpxiong</a></p>
                            <p>
                                <a href="http://www.cnblogs.com/landeanfen/p/5005367.html">bootstrap功能-导出excel,行内编辑...</a>
                            </p>
                            <p><a href="http://www.cnblogs.com/landeanfen/p/5821192.html">JS组件系列——BootstrapTable
                                    行内编辑解决方案：x-editable</a></p>
                            <p>
                                <a href="http://blog.csdn.net/jingtianyiyi/article/details/76208880">bootstrap合并单元格</a>
                            </p>
                            <p><a href="http://www.cnblogs.com/evilliu/articles/6424237.html">bootstrap数据导出</a></p>
                            <p><a href="https://www.liaoxuefeng.com">廖雪峰</a></p>
                        </div>

                    </div>
                </div>

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

                <!--支付宝打赏二维码-->
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <span>欢迎支付宝打赏</span>
                        <h2>
                            <img width="240px" height="240px" src="/images/zhifu/xiaohu-alipay.png" alt="小胡支付宝">
                        </h2>

                    </div>
                </div>

            </div>
        </div>
    </div>



    {{--<div class="scroll-back-to-top-wrapper">--}}
    {{--<span class="scroll-back-to-top-inner">--}}
    {{--<i class="fa fa-2x fa-arrow-up"></i>--}}
    {{--</span>--}}
    {{--</div>--}}

    {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">--}}
    {{--<legend>显示完整功能</legend>--}}
    {{--</fieldset>--}}

    {{--<div id="question_page"></div>--}}

    {{--<ul id="question_page_list"></ul>--}}

    <!--测试passport的vue组件-->
    {{--<passport-clients></passport-clients>--}}
    {{--<passport-authorized-clients></passport-authorized-clients>--}}
    {{--<passport-personal-access-tokens></passport-personal-access-tokens>--}}

@endsection


<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">
<script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['carousel', 'form'], function () {
        var carousel = layui.carousel
                , form = layui.form;

        //常规轮播
        carousel.render({
            elem: '#test1'
            , arrow: 'always'
        });

        //改变下时间间隔、动画类型、高度
        carousel.render({
            elem: '#test2'
            , interval: 1800
            , anim: 'fade'
            , height: '120px'
        });

        //设定各种参数
        var ins3 = carousel.render({
            elem: '#test3'
        });
        //图片轮播
        carousel.render({
            elem: '#test10'
            , width: '100%'
            , height: '440px'
            , interval: 3000
        });

        //事件
        carousel.on('change(test4)', function (res) {
            console.log(res)
        });

        var $ = layui.$, active = {
            set: function (othis) {
                var THIS = 'layui-bg-normal'
                        , key = othis.data('key')
                        , options = {};

                othis.css('background-color', '#5FB878').siblings().removeAttr('style');
                options[key] = othis.data('value');
                ins3.reload(options);
            }
        };

        //监听开关
        form.on('switch(autoplay)', function () {
            ins3.reload({
                autoplay: this.checked
            });
        });

        $('.demoSet').on('keyup', function () {
            var value = this.value
                    , options = {};
            if (!/^\d+$/.test(value)) return;

            options[this.name] = value;
            ins3.reload(options);
        });

        //其它示例
        $('.demoTest .layui-btn').on('click', function () {
            var othis = $(this), type = othis.data('type');
            active[type] ? active[type].call(this, othis) : '';
        });
    });
</script>

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
