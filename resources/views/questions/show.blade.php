@extends('layouts.app')

@include('vendor.ueditor.assets')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img class="img-circle" width="50px" height="50px"
                             src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                        <a href="">{{ $question->user->name }}</a>

                        @foreach($question->topics as $topic)
                            <a class="topic pull-right" href="/topic/{{ $topic->id }}">{{ $topic->name }}</a>
                        @endforeach
                    </div>

                    <div class="panel-heading">
                        {{ $question->title }}

                    </div>

                    <div class="panel-body content">
                        {!! $question->body !!}
                    </div>

                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="/questions/{{ $question->id }}/edit">编辑</a></span>
                            <form action="/questions/{{ $question->id }}" method="POST" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button is-naked delete-button">删除</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="question-follow">
                        <h2>
                            {{ $question->followers_count }}
                        </h2>
                        <span>关注者</span>
                    </div>

                    <div class="panel-body">
                        @if(Auth::check())

                            {{--@if(Auth::check())--}}
                            {{--<a href="/question/{{$question->id}}/follow"--}}
                            {{--class="btn btn-default {{ Auth::user()->followed($question->id) ?'btn-success':''}}">--}}
                            {{--{{ Auth::user()->followed($question->id) ?'已关注':'关注该问题'}}--}}
                            {{--</a>--}}
                            {{--@else--}}
                            {{--<a href="/login" class="btn btn-default">关注问题</a>--}}
                            {{--@endif--}}

                            <question-follow-button question="{{$question->id}}"
                                                    user="{{ Auth::id() }}"></question-follow-button>
                            <a href="#editor" class="btn btn-primary pull-right">撰写答案</a>

                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-block">登录关注问题，并撰写答案</a>
                        @endif
                    </div>

                </div>
            </div>
            {{--<div class="col-md-8 col-md-offset-1">--}}
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->answers_count }} 个答案
                    </div>
                    <div class="panel-body">

                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img class="img-circle" width="36px" height="36px"
                                             src="{{ $answer->user->avatar }}"
                                             alt="{{ $answer->user->name }}">
                                    </a>
                                </div>

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{ $answer->user->name }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>

                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach

                        @if(Auth::check())
                            <form action="/questions/{{ $question->id }}/answer" method="POST">
                                {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <!-- 编辑器容器 -->
                                    <script id="container" name="body" type="text/plain">
                                        {!! old('body') !!}
                                    </script>
                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <button class="btn btn-success pull-right" type="submit">提交答案</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-block">登录提交答案</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading question-follow">
                        <h5>
                            关于作者
                        </h5>
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                    <img class="img-circle" width="36px" height="36px"
                                         src="{{ $question->user->avatar }}"
                                         alt="{{ $question->user->name }}">
                                </a>
                            </div>

                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="">
                                        {{ $question->user->name }}
                                    </a>
                                </h4>
                            </div>

                            <div class="user-statics">
                                <div class="statics-item text-center">
                                    <div class="statics-text">问题</div>
                                    <div class="statics-count">{{ $question->user->questions_count }}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">回答</div>
                                    <div class="statics-count">{{ $question->user->answers_count }}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">关注者</div>
                                    <div class="followers_count">{{ $question->user->followers_count }}</div>
                                </div>
                            </div>
                        </div>


                        <div class="panel-body">
                            @if(Auth::check())
                                <user-follow-button
                                        user="{{$question->user_id}}" user_api="{{ Auth::id()}}"></user-follow-button>
                                <a href="#editor" class="btn btn-default pull-right">发送私信</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success btn-block">登录关注他,并发送私信</a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@section('js')
    @if(Auth::check())
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container', {
                toolbars: [
                    ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
                ],
                elementPathEnabled: false,
                enableContextMenu: false,
                autoClearEmptyNode: true,
                wordCount: false,
                imagePopup: false,
                autotypeset: {indent: true, imageBlockLine: 'center'}
            });
            ue.ready(function () {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
    @endif

    {{--<script>--}}
        {{--$.ajax({--}}
            {{--type: 'post',--}}
            {{--cache: false,--}}
            {{--dataType: 'json',--}}
            {{--async: false, //同步ajax--}}
            {{--data: {--}}
                {{--'_token': '{{ csrf_token() }}',--}}
                {{--'user': '{{ $question->user_id }}',--}}
                {{--'user_api': '{{ Auth::id() }}'--}}
            {{--},--}}
            {{--url: '{{ url('api/user/followers_count') }}',--}}
            {{--success: function (data) {--}}
                {{--console.log(data);--}}

                {{--var followers_count = data.followers_count;--}}
                {{--console.log(followers_count)--}}

                {{--$('.followers_count').text(followers_count);--}}
                {{--if (data != "") {--}}
                    {{--$("#pager").pager({--}}
                        {{--pagenumber: pagenumber,--}}
                        {{--pagecount: data.split("$$")[1],--}}
                        {{--buttonClickCallback: PageClick--}}
                    {{--});--}}
                    {{--$("#anhtml").html(data.split("$$")[0]);--}}

                {{--}--}}
            {{--}--}}
        {{--})--}}
    {{--</script>--}}

@endsection
@endsection
