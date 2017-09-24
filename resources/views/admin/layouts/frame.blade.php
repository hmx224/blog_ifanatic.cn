<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/plugins/H-ui.admin/3.1.3.1/favicon.ico">
    <link rel="Shortcut Icon" href="/plugins/H-ui.admin/3.1.3.1/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('plugins/H-ui.admin/3.1.3.1/static/h-ui/css/H-ui.min.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/css/H-ui.admin.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('plugins/H-ui.admin/3.1.3.1/lib/Hui-iconfont/1.0.8/iconfont.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/skin/default/skin.css')}}" id="skin"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/css/style.css')}}"/>

    <!--[if IE 6]>
    <script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>爱狂热后台管理系统</title>
    <meta name="keywords" content="ifanatic.cn v1.0,爱狂热后台管理系统">
    <meta name="description" content="ifanatic.cn v1.0,是一块后台管理系统,对爱狂热博客系统进行管理维护.">
</head>

@yield('body')




<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript"
        src="/plugins/H-ui.admin/3.1.3.1/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
    $(function () {
        /*$("#min_title_list li").contextMenu('Huiadminmenu', {
         bindings: {
         'closethis': function(t) {
         console.log(t);
         if(t.find("i")){
         t.find("i").trigger("click");
         }
         },
         'closeall': function(t) {
         alert('Trigger was '+t.id+'\nAction was Email');
         },
         }
         });*/
    });
    /*个人信息*/
    function myselfinfo() {
        layer.open({
            type: 1,
            area: ['300px', '200px'],
            fix: false, //不固定
            maxmin: true,
            shade: 0.4,
            title: '查看信息',
            content: '<div>管理员信息</div>'
        });
    }

    /*资讯-添加*/
    function article_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-添加*/
    function picture_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-添加*/
    function product_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }


</script>

</html>