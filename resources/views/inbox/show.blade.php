@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">对话列表</div>

                    <form action="/inbox/{{$dialogId}}/store" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" class="form-control"></textarea>
                        </div>
                        <div class="form-group pull-right">
                            <button class="btn btn-success">发送私信</button>
                        </div>
                    </form>

                    <div class="letters-list">
                        <div class="panel-body">
                            @foreach($letters as  $letter)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <img class="img-circle" width="50px" height="50px"
                                                 src="{{ $letter->fromUser->avatar }}" alt="">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="">
                                                {{$letter->fromUser->name}}
                                            </a>
                                        </h4>
                                        <p>
                                            {{$letter->body}}
                                            <span class="pull-right">{{$letter->created_at}}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
