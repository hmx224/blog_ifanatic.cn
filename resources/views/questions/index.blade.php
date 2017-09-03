@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
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

                                    <h5>{{ $question->updated_at }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
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
        </div>
    </div>
@endsection
