@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img class="img-circle" width="50px" height="50px"
                             src="{{ $message->user->avatar }}" alt="{{ $message->user->name }}">
                        <a href="">{{ $message->user->name }}</a>
                    </div>

                    <div class="panel-heading">
                        {{ $message->title }}
                    </div>

                    <div class="panel-body content">
                        {{--<textarea class="layui-textarea" id="content" name="content" style="display: none">--}}
                        {!! $message->content !!}
                        {{--</textarea>--}}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($message))
                            <span class="edit"><a href="/messages/{{ $message->id }}/edit">编辑</a></span>
                            <form action="/messages/{{ $message->id }}" method="POST" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button is-naked delete-button">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{--<div class="col-md-3">--}}
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading question-follow">--}}
            {{--<h2>--}}
            {{--{{ $message->comments_count }}--}}
            {{--</h2>--}}
            {{--<span>评论数</span>--}}
            {{--</div>--}}

            {{--<div class="panel-body">--}}
            {{--<question-follow-button question="{{$message->id}}"--}}
            {{--user="{{ Auth::id() }}"></question-follow-button>--}}
            {{--<a href="#editor" class="btn btn-primary pull-right">撰写答案</a>--}}
            {{--</div>--}}

            {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>


@section('js')
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    <script src="/layui/layui.js" charset="utf-8"></script>
    @if(Auth::check())
        <script>
            layui.use('layedit', function () {
                var layedit = layui.layedit
                    , $ = layui.jquery;

                //构建一个默认的编辑器
                layedit.build('content', {
                    height: 300, //设置编辑器高度
                    hideTool: [
                        'strong' //加粗
                        , 'italic' //斜体
                        , 'underline' //下划线
                        , 'del' //删除线
                        , '|' //分割线
                        , 'left' //左对齐
                        , 'center' //居中对齐
                        , 'right' //右对齐
                        , 'link' //超链接
                        , 'unlink' //清除链接
                        , 'face' //表情
                        , 'image' //插入图片
                        , 'help' //帮助
                    ]
                });
            });
        </script>
    @endif
@endsection
@endsection
