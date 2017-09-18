@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($count != 0)
                            @foreach($messages as $message)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <img class="img-circle" width="50px" height="50px"
                                                 src="{{ $message->user->avatar }}"
                                                 alt="{{ $message->user->name }}">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="/messages/{{ $message->id }}">
                                                {{ $message->title }}
                                            </a>
                                        </h4>

                                        <h5 class="">
                                            <span>{{ $message->updated_at }}</span>
                                            <span class="pull-right">{{ $message->user->name }}</span>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="font-size: large; color: deeppink;">暂时没有留言记录</div>
                        @endif
                    </div>
                    <div class='pull-right'>{!! $messages->links() !!}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    {{--@if(Auth::guest())--}}
                    {{--<div style="text-align:center; font-size: large;color: deeppink;">温馨提示,请先登录发布留言！</div>--}}
                    {{--@endif--}}
                    <div class="panel-heading question-follow">
                        <h2>
                            {{ config('app.name', 'ifanatic.cn') }}
                        </h2>
                        <span>欢迎来到爱狂热的博客,留下你的提议,<span
                                    style="font-size: 18px; color: deeppink;">好留言</span>被站长收录有奖励哦!</span>
                    </div>

                    @if(Auth::check())
                        <div class="panel-body">
                            <a href="" class="btn btn-default pull-left">关于作者</a>
                            <a href="messages/create" class="btn btn-primary pull-right">写留言</a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success btn-block">登录写留言</a>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
