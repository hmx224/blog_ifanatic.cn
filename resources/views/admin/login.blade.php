<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/respond.min.js"></script>
    <![endif]-->
    <link href="/plugins/H-ui.admin/3.1.3.1/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="/plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/plugins/H-ui.admin/3.1.3.1/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>爱狂热后台管理系统</title>
    <meta name="keywords" content="ifanatic.cn v1.0,爱狂热后台管理系统">
    <meta name="description" content="ifanatic.cn v1.0,是一块后台管理系统,对爱狂热博客系统进行管理维护.">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value=""/>
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="/admin/login" method="post">

            {!! csrf_field() !!}

            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="name" name="name" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input class="input-text size-L" type="text" name="captcha" placeholder="验证码"
                           style="width:150px;">
                    <span class="" style="cursor:pointer;">
                        <a id="refresh-captcha">
                            <img src="{{ captcha_src() }}"
                                 alt="验证码"
                                 title="刷新图片"
                                 width="200"
                                 height="40"
                                 id="captcha"
                                 border="0"
                                 data-captcha-config="default"
                            ></a></span>
                </div>
            </div>


            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright 爱狂热 ifanatic.cn v1.0</div>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/static/h-ui/js/H-ui.min.js"></script>

<script>
    //验证码
    $('#captcha').on('click', function () {
        let captcha = $(this);
        let url = '/admin/captcha/' + captcha.attr('data-captcha-config') + '/?' + Math.random();
        captcha.attr('src', url);
    })
</script>
</body>
</html>