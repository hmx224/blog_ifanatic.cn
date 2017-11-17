@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>用户信息</span>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="/users/store" method="POST">

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-10">
                                    <span class="form-control" >{{ $user->name }}</span>

                                    {{--<span id="name"></span>--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">会员昵称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="会员昵称用于用户展示"
                                           value="{{ $user->nick_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">邮箱地址</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="邮箱 "
                                           value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">会员头像</label>
                                <div class="col-sm-3">
                                    <img class="img-circle" id="avatar" width="100px" height="100px;"
                                         src="{{ $user->avatar }}"
                                         alt="会员头像">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">会员激活状态</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" placeholder="会员激活状态"
                                           value="{{ $user->is_active==1 ? '是': '否' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updated_at" class="col-sm-2 control-label">会员激活时间</label>
                                <div class="col-sm-5">
                                    <div class='input-group' id='updated_at'>
                                        <input type="text" class="form-control" placeholder="会员激活时间"
                                               value="{{ $user->updated_at }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created_at" class="col-sm-2 control-label">会员注册时间</label>
                                <div class="col-sm-5">
                                    <div class='input-group' id='created_at'>
                                        <input type="text" class="form-control" placeholder="会员注册时间"
                                               value="{{ $user->created_at}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created_at" class="col-sm-2 control-label">日期时间选择器</label>
                                <div class="col-sm-5">
                                    <div class="layui-inline">
                                        <div class="layui-input-inline" style='width:320px;'>
                                            <input type="text" class="layui-input" id="full_time"
                                                   placeholder="yyyy-MM-dd HH:mm:ss">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 layui-form-label">自定义重要日</label>
                                <div class="layui-input-inline">
                                    <div class="col-sm-5">
                                        <div class="layui-inline" style='width:320px;'>
                                            <input type="text" class="layui-input" id="middle_time" placeholder="yyyy-MM-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="/users/setting" class="btn btn-primary disabled">编辑信息</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

{{--<script src="/js/baidu_map.js"></script>--}}
<script type="text/javascript" src="{{ config("site.baidu.map_url") }}"></script>

<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">
<script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>


<!--使用layer-->
<link rel="stylesheet" href="/plugins/layer/3.0.3/layer/skin/default/layer.css" media="all">
<script src="/plugins/layer/3.0.3/layer/layer.js"></script>


<script>
    layui.use('laydate', function () {
        var laydate = layui.laydate;

        //时间选择器 开启公历节日
        laydate.render({
            elem: '#full_time'
            , type: 'datetime'
            , calendar: true
        });

        //自定义重要日
        laydate.render({
            elem: '#middle_time'
            , mark: {
                '0-10-14': '生日'
                , '0-12-31': '跨年' //每年的日期
                , '0-0-10': '工资' //每月某天
                , '0-0-15': '月中'
                , '2017-8-15': '' //如果为空字符，则默认显示数字+徽章
                , '2099-10-14': '呵呵'
            }
            , done: function (value, date) {
                if (date.year === 2017 && date.month === 8 && date.date === 15) { //点击2017年8月15日，弹出提示语
                    layer.msg('这一天是：中国人民抗日战争胜利72周年');
                }
            }
        });


    });

    layui.use('upload', function () {
        var $ = layui.jquery
            , upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload_avatar'
            , url: '/api/files/upload'
            , before: function (obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#avatar_img').attr('src', result); //图片链接（base64）
                    $('#avatar_img').css('width', '100'); //图片链接（base64）
                    $('#avatar_img').css('height', '100'); //图片链接（base64）
                });
            }
            , done: function (res) {
                console.log(res)
                console.log(res.data)
                //如果上传失败
                if (res.code > 0) {
                    return layer.msg('上传失败');
                }
                //上传成功

//                $('#avatar').attr('src',res.data.src);

            }
            , error: function () {
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function () {
                    uploadInst.upload();
                });
            }
        });


    });

    var map = new BMap.Map("allmap");
    var geoc = new BMap.Geocoder();   //地址解析对象
    var markersArray = [];
    var geolocation = new BMap.Geolocation();
    var zoomSize = 12;
    var point = new BMap.Point(116.331398, 39.897445);

    map.centerAndZoom(point, zoomSize); // 中心点
    //选取当前位置
    geolocation.getCurrentPosition(function (r) {
        var mk = new BMap.Marker(r.point);
        map.addOverlay(mk);
        map.panTo(r.point);
        map.enableScrollWheelZoom(true);
    }, {enableHighAccuracy: true})

    map.addEventListener("click", showInfo);

    //清除标识
    function clearOverlays() {
        if (markersArray) {
            for (i in markersArray) {
                map.removeOverlay(markersArray[i])
            }
        }
    }
    //地图上标注
    function addMarker(point) {
        var marker = new BMap.Marker(point);
        markersArray.push(marker);
        clearOverlays();
        map.addOverlay(marker);
    }
    //点击地图事件处理
    function showInfo(e) {
        geoc.getLocation(e.point, function (rs) {
            var addComp = rs.addressComponents;
            var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;


            document.getElementById('address_inner').value = address;
            document.getElementById('coordinate_inner').value = e.point.lng + "," + e.point.lat;

            $('#btn_search').click(function () {
                document.getElementById('address').value = address;
                document.getElementById('coordinate').value = e.point.lng + "," + e.point.lat;
            })
        });

        addMarker(e.point);
    }

    //搜索
    function addrSearch(serachAddr) {
        // 将地址解析结果显示在地图上,并调整地图视野
        if (!serachAddr) {
            serachAddr = $("#search").val();
        }

        var map = new BMap.Map("allmap");
        map.centerAndZoom(point, zoomSize);

        geolocation.getCurrentPosition(function (r) {
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                var mk = new BMap.Marker(r.point);
                map.addOverlay(mk);
                map.panTo(r.point);
                map.enableScrollWheelZoom(true);
            }
            else {
                alert('failed' + this.getStatus());
            }
        }, {enableHighAccuracy: true})

        var local = new BMap.LocalSearch(map, {
            renderOptions: {map: map}
        });
        local.search(serachAddr);

        map.addEventListener("click", showInfo);
    }
</script>



