@extends('layouts.frame')

@section('body')
    <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        @include('widgets.header')

        @include('admin.widgets.menu')

        @yield('css')

        @yield('content')

        @include('widgets.footer')

        @include('widgets.sidebar')

        @yield('js')
    </div><!-- ./wrapper -->
    </body>

@endsection
