@extends('admin.layouts.frame')

@section('body')
    <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        @include('admin.widgets.header')

        @include('admin.widgets.menu')

        @yield('css')

        @yield('content')

        {{--        @include('admin.widgets.footer')--}}

        {{--        @include('admin.widgets.sidebar')--}}

        @yield('js')

    </div>
    <!-- ./wrapper -->
    </body>
@endsection
