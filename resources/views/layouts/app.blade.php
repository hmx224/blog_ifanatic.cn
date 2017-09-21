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

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" href="/css/style.css">

    <!--layui-->

    <!--Bootstrap-->
{{--<link href="/plugins/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="/plugins/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

<!--X-editable-->
{{--<link href="/plugins/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">--}}
{{--<script src="/plugins/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}

<!--Moment.js-->
    <script src="/plugins/moment.js/2.15.1/moment.min.js"></script>
    <script src="/plugins/moment.js/2.15.1/moment-with-locales.min.js"></script>
    <script src="/plugins/moment.js/2.15.1/locales.js"></script>

    <!--Bootstrap-DatetimePicker-->
    <link href="/plugins/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="/plugins/bootstrap-datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>

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

@yield('js')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<script type="text/javascript" src="/plugins/select2/js/select2.full.js"></script>
<script type="text/javascript" src="/plugins/select2/js/zh-CN.js"></script>

<script>
    $('#flash-overlay-modal').modal();
</script>

<script>
    $('#captcha').on('click', function () {
        let captcha = $(this);
        let url = '/captcha/' + captcha.attr('data-captcha-config') + '/?' + Math.random();
        captcha.attr('src', url);
    })

</script>
</body>
</html>
