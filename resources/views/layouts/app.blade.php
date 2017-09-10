<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- API Token -->
    <meta name="apiToken" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('widgets.header')

    <div class="container">
        @include('flash::message')

        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! session('flash_notification.message') !!}
            </div>
        @endif
    </div>

    @yield('content')

    @include('widgets.footer')
</div>



<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('js')

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="/css/style.css">

<link rel="stylesheet" href="/select2/css/select2.min.css">
<script type="text/javascript" src="/select2/js/select2.full.js"></script>
<script type="text/javascript" src="/select2/js/zh-CN.js"></script>

<script>
//    $('#flash-overlay-modal').modal();
</script>


</body>
</html>
