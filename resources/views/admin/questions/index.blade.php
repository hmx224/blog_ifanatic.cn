@extends('admin.layouts.frame')

@section('body')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理
        <span class="c-gray en">&gt;</span> 文章列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);"
           title="刷新"><i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <div class="page-container">
        <div class="text-c">
            <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
            <span class="select-box inline">
		<select name="" class="select">
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin"
                   class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })"
                   id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder=" 文章名称" style="width:250px" class="input-text">
            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜文章
            </button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i
                            class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
                <a class="btn btn-primary radius" data-title="添加文章" data-href="article-add.html"
                   onclick="Hui_admin_tab(this)" href="javascript:;">
                    <i class="Hui-iconfont">&#xe600;</i> 添加文章</a>
            </span>
            {{--<span class="r">共有数据：<strong>54</strong> 条</span>--}}
        </div>
        <div class="mt-20">
            {{--<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive"--}}
                   {{--id="example">--}}
                {{--<thead>--}}
                {{--<tr class="text-c">--}}
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    {{--<th width="80">ID</th>--}}
                    {{--<th>标题</th>--}}
                    {{--<th width="80">分类</th>--}}
                    {{--<th width="80">来源</th>--}}
                    {{--<th width="120">更新时间</th>--}}
                    {{--<th width="75">浏览次数</th>--}}
                    {{--<th width="60">发布状态</th>--}}
                    {{--<th width="120">操作</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}

                {{--<tbody>--}}
                {{--<tr class="text-c">--}}
                    {{--<td><input type="checkbox" value="" name=""></td>--}}
                    {{--<td>10001</td>--}}
                    {{--<td class="text-l"><u style="cursor:pointer" class="text-primary"--}}
                                          {{--onClick="article_edit('查看','article-zhang.html','10001')" title="查看">文章标题</u>--}}
                    {{--</td>--}}
                    {{--<td>行业动态</td>--}}
                    {{--<td>H-ui</td>--}}
                    {{--<td>2014-6-11 11:11:42</td>--}}
                    {{--<td>21212</td>--}}
                    {{--<td class="td-status"><span class="label label-success radius">已发布</span></td>--}}
                    {{--<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')"--}}
                                                  {{--href="javascript:;" title="下架"><i--}}
                                    {{--class="Hui-iconfont">&#xe6de;</i></a> <a style="text-decoration:none" class="ml-5"--}}
                                                                             {{--onClick="article_edit('文章编辑','article-add.html','10001')"--}}
                                                                             {{--href="javascript:;" title="编辑"><i--}}
                                    {{--class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5"--}}
                                                                             {{--onClick="article_del(this,'10001')"--}}
                                                                             {{--href="javascript:;" title="删除"><i--}}
                                    {{--class="Hui-iconfont">&#xe6e2;</i></a></td>--}}
                {{--</tr>--}}
                {{--<tr class="text-c">--}}
                    {{--<td><input type="checkbox" value="" name=""></td>--}}
                    {{--<td>10002</td>--}}
                    {{--<td class="text-l"><u style="cursor:pointer" class="text-primary"--}}
                                          {{--onClick="article_edit('查看','article-zhang.html','10002')" title="查看">文章标题</u>--}}
                    {{--</td>--}}
                    {{--<td>行业动态</td>--}}
                    {{--<td>H-ui</td>--}}
                    {{--<td>2014-6-11 11:11:42</td>--}}
                    {{--<td>21212</td>--}}
                    {{--<td class="td-status"><span class="label label-success radius">草稿</span></td>--}}
                    {{--<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'10001')"--}}
                                                  {{--href="javascript:;" title="审核">审核</a> <a style="text-decoration:none"--}}
                                                                                           {{--class="ml-5"--}}
                                                                                           {{--onClick="article_edit('文章编辑','article-add.html','10001')"--}}
                                                                                           {{--href="javascript:;"--}}
                                                                                           {{--title="编辑"><i--}}
                                    {{--class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5"--}}
                                                                             {{--onClick="article_del(this,'10001')"--}}
                                                                             {{--href="javascript:;" title="删除"><i--}}
                                    {{--class="Hui-iconfont">&#xe6e2;</i></a></td>--}}
                {{--</tr>--}}
                {{--</tbody>--}}
            {{--</table>--}}


            <table class="layui-table" lay-data="{height:640, url:'/admin/questions/list', page:true, id:'table'}"  lay-filter="table">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true}">ID</th>
                    <th lay-data="{field:'title', width:240}">标题</th>
                    <th lay-data="{field:'body', width:450}">内容</th>
                    <th lay-data="{field:'user_name', width:120}">会员名</th>
                    <th lay-data="{field:'comments_count', width:80}">评论数</th>
                    <th lay-data="{field:'followers_count', width:80, sort: true}">关注数</th>
                    <th lay-data="{field:'answers_count', width:80, sort: true}">评论数</th>
                    <th lay-data="{field:'close_comment', width:120}">是否关闭评论</th>
                    <th lay-data="{field:'is_hidden', width:100}">是否隐藏</th>
                    <th lay-data="{field:'created_at', width:135, sort: true}">创建时间</th>
                    <th lay-data="{field:'updated_at', width:135, sort: true}">更新时间</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/jquery/1.9.1/jquery.min.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript"
        src="/plugins/H-ui.admin/3.1.3.1/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/plugins/H-ui.admin/3.1.3.1/lib/laypage/1.2/laypage.js"></script>

<!--layui-->
<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">
<script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>
<!--layui-->


<script>
    layui.use('table', function(){
        var table = layui.table;

//        table.render({ //其它参数在此省略
//            elem: '#table' //指定原始表格元素选择器（推荐id选择器）
//            ,height: 600 //容器高度
//            ,skin: 'line' //行边框风格
//            ,even: true //开启隔行背景
//            ,size: 'sm' //小尺寸的表格
//            ,page: true
//            ,url: '/admin/questions/list'
//        });


    });
</script>

<script type="text/javascript">

    $('#example').DataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading": false,
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0, 8]}// 不参与排序的列
        ],
        'ajax': {
            "url": "/admin/questions/list",
            //默认为data，这里定义为demo
            "dataSrc": "data"
        }
    });

    /*文章-添加*/
    function article_add(title, url, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*文章-编辑*/
    function article_edit(title, url, id, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*文章-删除*/
    function article_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function (data) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*文章-审核*/
    function article_shenhe(obj, id) {
        layer.confirm('审核文章？', {
                btn: ['通过', '不通过', '取消'],
                shade: false,
                closeBtn: 0
            },
            function () {
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon: 6, time: 1000});
            },
            function () {
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon: 5, time: 1000});
            });
    }
    /*文章-下架*/
    function article_stop(obj, id) {
        layer.confirm('确认要下架吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!', {icon: 5, time: 1000});
        });
    }

    /*文章-发布*/
    function article_start(obj, id) {
        layer.confirm('确认要发布吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!', {icon: 6, time: 1000});
        });
    }
    /*文章-申请上线*/
    function article_shenqing(obj, id) {
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1, time: 2000});
    }

</script>