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

    <script>
        <!--定义全局的变量-->
        @if(Auth::check())
            window.Ifanatic = {
            name: "{{ Auth::user()->name }}",
            avatar: "{{ Auth::user()->avatar }}"
        }
        @endif
    </script>


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" href="/css/style.css">
    <!--scroll-back-to-top.css-->
    <link rel="stylesheet" href="/css/scroll-back-to-top.css">
    <!--scroll-back-to-top.js-->
    <script type="text/javascript" src="/js/scroll-back-to-top.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/font-awesome/4.7.0/css/font-awesome.css">
    <!--layui-->

{{--<link href="/plugins/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="/plugins/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

<!--X-editable-->
{{--<link href="/plugins/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">--}}
{{--<script src="/plugins/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}

<!--Moment.js-->
    {{--<script src="/plugins/moment.js/2.15.1/moment.min.js"></script>--}}
    {{--<script src="/plugins/moment.js/2.15.1/moment-with-locales.min.js"></script>--}}
    {{--<script src="/plugins/moment.js/2.15.1/locales.js"></script>--}}

    {{--<!--Bootstrap-DatetimePicker-->--}}
    {{--<link href="/plugins/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css" rel="stylesheet">--}}
    {{--<script src="/plugins/bootstrap-datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>--}}

</head>
<body style="padding:60px 0 60px 0">
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
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

<script>
    $('#flash-overlay-modal').modal();
</script>

<script>
    //验证码
    $('#captcha').on('click', function () {
        let captcha = $(this);
        let url = '/captcha/' + captcha.attr('data-captcha-config') + '/?' + Math.random();
        captcha.attr('src', url);
    })

</script>
</body>
</html>
