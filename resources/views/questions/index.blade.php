@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @foreach($questions as $question)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img width="50px" src="{{ $question->user->avatar }}"
                                             alt="{{ $question->user->name }}">
                                    </a>
                                </div>

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/questions/{{ $question->id }}">
                                            {{ $question->title }}
                                        </a>
                                    </h4>

                                    <h5 class="">
                                        <span>{{ $question->updated_at }}</span>
                                        <span class="pull-right">{{ $question->user->name }}</span>
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h2>
                            {{ config('app.name', 'ifanatic.cn') }}
                        </h2>
                        <span>欢迎来到爱狂热的博客，分享你的所见所闻，让我们开怀聊天。</span>
                    </div>

                    <div class="panel-body">
                        <a href="" class="btn btn-default pull-left">关于我</a>
                        <a href="questions/create" class="btn btn-primary pull-right">写文章</a>
                    </div>

                </div>
            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h2>
                            公告栏
                        </h2>
                        <span>亲爱的会员信息列表</span>

                        <ul>
                            <li>
                                @foreach($question->user as $user)
                                    <a href="">{{ $user }}</a>
                                @endforeach
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <a href="" class="btn btn-default pull-left">关于我</a>
                        <a href="questions/create" class="btn btn-primary pull-right">写文章</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
