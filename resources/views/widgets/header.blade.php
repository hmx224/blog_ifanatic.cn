<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="{{ url('questions/create') }}" >写文章</a>
                </li>
                <li class="dropdown">
                    <a href="{{ url('messages/create') }}">写留言</a>
                </li>

                <li class="dropdown">
                    <a href="{{ url('messages') }}">留言列表</a>
                </li>

                @if(Auth::check())
                    <li class="dropdown">
                        <a href="{{ url('notifications') }}">通知</a>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        日志
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('log_bug') }}">BUG更新日志</a></li>

                        <li><a href="{{ url('log_logic') }}">业务更新日志</a></li>

                        <li><a href="{{ url('log_ex_dev') }}">扩展开发更新日志</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest() || App\Models\User::find(Auth::id())->is_active == App\Models\User::STATUS_NORMAL)
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> 注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <a href="/users/info">个人资料</a>

                                <a href="/users/change_avatar_form">修改头像</a>

                                <a href="/users/change_password_form">修改密码</a>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>

</script>