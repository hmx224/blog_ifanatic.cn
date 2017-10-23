@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">私信列表</div>

                    <div class="panel-body">
                        @foreach($letters as $letterGroup)

                            <div class="media {{ $letterGroup->first()->shouldAddUnReadClass() ? 'unread': '' }}">
                                <div class="media-left">
                                    <a href="">
                                        @if(Auth::id() == $letterGroup->last()->from_user_id)
                                            <img class="img-circle" width="50px" height="50px"
                                                 src="{{ $letterGroup->last()->toUser->avatar }}" alt="">
                                        @else
                                            <img class="img-circle" width="50px" height="50px"
                                                 src="{{ $letterGroup->last()->fromUser->avatar }}" alt="">
                                        @endif
                                    </a>
                                </div>

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="">
                                            @if(Auth::id() == $letterGroup->last()->from_user_id)
                                                {{$letterGroup->last()->toUser->name}}
                                            @else
                                                {{$letterGroup->last()->fromUser->name}}
                                            @endif
                                        </a>
                                    </h4>
                                    <p>
                                        <a href="/inbox/{{$letterGroup->first()->dialog_id}}">
                                            {{$letterGroup->first()->body}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
