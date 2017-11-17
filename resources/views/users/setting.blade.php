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
                                    <input type="text" class="form-control" id="name" placeholder="用户名"
                                           value="{{ $user->name }}" disabled="disabled">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">会员昵称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="会员昵称用于用户展示"
                                           value="{{ $user->nick_name }}">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                            {{--<label for="password" class="col-sm-2 control-label">密码</label>--}}
                            {{--<div class="col-sm-4">--}}
                            {{--<input type="password" class="form-control" id="password" placeholder="Password"--}}
                            {{--value="{{  $user->password  }}" disabled="disabled">--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">邮箱地址</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="邮箱 "
                                           value="{{ $user->email }}" disabled="disabled">
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
                                           value="{{ $user->is_active==1 ? '是': '否' }}" disabled="disabled">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updated_at" class="col-sm-2 control-label">会员激活时间</label>
                                <div class="col-sm-5">
                                    <div class='input-group' id='updated_at'>
                                        <input type="text" class="form-control" placeholder="会员激活时间"
                                               value="{{ $user->updated_at }}" disabled="disabled">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created_at" class="col-sm-2 control-label">会员注册时间</label>
                                <div class="col-sm-5">
                                    <div class='input-group' id='created_at'>
                                        <input type="text" class="form-control" placeholder="会员注册时间"
                                               value="{{ $user->created_at}}" disabled="disabled">
                                    </div>
                                </div>
                            </div>


                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('coordinate', '地理坐标 :', ['class' => 'control-label col-sm-2']) !!}--}}
                            {{--<div class="col-sm-6">--}}
                            {{--{!! Form::text('coordinate', null, ['class' => 'form-control']) !!}--}}
                            {{--</div>--}}


                            {{--<button type="button" class="btn btn-info pull-left btn-flat" data-toggle="modal"--}}
                            {{--data-target="#modal_map">--}}
                            {{--显示地图--}}
                            {{--</button>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('address', '地理地址:', ['class' => 'control-label col-sm-2']) !!}--}}
                            {{--<div class="col-sm-6">--}}
                            {{--{!! Form::text('address', null, ['class' => 'form-control','placeholder'=>'地址显示 ']) !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="modal fade" id="modal_map" tabindex="-1" role="dialog">--}}
                            {{--<div class="modal-dialog" style="width:640px;">--}}
                            {{--<div class="modal-content">--}}
                            {{--<div class="modal-header">--}}
                            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>--}}
                            {{--<h4 class="modal-title">地图坐标</h4>--}}
                            {{--</div>--}}
                            {{--<div class="modal-body">--}}
                            {{--<div class="row">--}}
                            {{--<div class="col-xs-12">--}}
                            {{--<div class="box box-info">--}}

                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('coordinate_inner', '坐标 :', ['class' => 'control-label col-sm-2']) !!}--}}
                            {{--<div class="col-sm-10">--}}
                            {{--{!! Form::text('coordinate_inner', null, ['class' => 'form-control']) !!}--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('address_inner', '地址:', ['class' => 'control-label col-sm-2']) !!}--}}
                            {{--<div class="col-sm-10">--}}
                            {{--{!! Form::text('address_inner', null, ['class' => 'form-control','placeholder'=>'地址显示 ']) !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            {{--{!! Form::label('search', '搜索 :', ['class' => 'control-label col-sm-2']) !!}--}}
                            {{--<div class="col-sm-7">--}}
                            {{--{!! Form::text('search', null, ['class' => 'form-control','placeholder'=>'请输入关键词']) !!}--}}
                            {{--</div>--}}
                            {{--<input type="button" onclick="addrSearch()" class="btn btn-primary btn-flat"--}}
                            {{--value="搜索"--}}
                            {{--style="width: 150px;height: 35px">--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            {{--<div class="col-sm-12">--}}
                            {{--<div id="allmap" style="height:400px; width: 100%;overflow:hidden; margin:0;"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="box-footer">--}}
                            {{--<button class="btn btn-default" data-dismiss="modal">取消</button>--}}
                            {{--<button class="btn btn-info pull-right" id="btn_search" data-dismiss="modal">确认--}}
                            {{--</button>--}}
                            {{--<button type="reset" class="btn btn-default pull-right margin-r-5">清除--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                {!! Form::label('coordinate', '地理坐标:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        {!! Form::text('coordinate', null, ['class' => 'form-control coordinate', 'id' => 'coordinate']) !!}
                                        <span class="input-group-addon">
                        <i class="fa fa-location-arrow" style="cursor:pointer" data-toggle="modal"
                           data-target="#modal_coordinate"></i>
                    </span>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal_coordinate" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" style="width:800px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"> &times;
                                                </button>
                                                <h4 class="modal-title">地图</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="box box-info">
                                                            <div class="box-body">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            {!! Form::text('search_coordinate', null, ['class' => 'form-control', 'placeholder' => '搜索地址', 'id' => 'search_coordinate']) !!}
                                                                            <span class="input-group-addon">
                                                            <i class="fa fa-search" style="cursor:pointer"
                                                               onclick="search()"></i>
                                                        </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="map_coordinate"
                                                                     style="height: 400px; width: 100%; overflow: hidden; margin: 0;">
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <button class="btn btn-default" data-dismiss="modal">
                                                                    取消
                                                                </button>
                                                                <button class="btn btn-info pull-right"
                                                                        id="btn_submit_coordinate"
                                                                        data-dismiss="modal">确认
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">更新信息</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <style>
        .tangram-suggestion-main {
            z-index: 1060;
        }
    </style>
@endsection


<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">
<script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>


<!--使用layer-->
<link rel="stylesheet" href="/plugins/layer/3.0.3/layer/skin/default/layer.css" media="all">
<script src="/plugins/layer/3.0.3/layer/layer.js"></script>


@section('js')
    <script type="text/javascript" src="{{ config("site.baidu.map_url") }}"></script>

    <script>
        var coordinate_map = new BMap.Map('map_coordinate');
        var coordinate_location = new BMap.Geolocation();
        var coordinate_zoom = 15;
        var coordinate_point = new BMap.Point(116.404, 39.915);

        var coordinate_values = $('#coordinate').val().split(',');
        if (coordinate_values.length == 2) {
            coordinate_point = new BMap.Point(parseFloat(coordinate_values[0]), parseFloat(coordinate_values[1]));
        }
        else {
            //选取当前位置
            coordinate_location.getCurrentPosition(function (r) {
                if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                    coordinate_point = r.point;
                }
            });
        }
        coordinate_map.centerAndZoom(coordinate_point, coordinate_zoom);
        coordinate_map.enableScrollWheelZoom();

        //地图上标注
        function mark(point) {
            var marker = new BMap.Marker(point);
            marker.enableDragging();
            marker.addEventListener('dragend', function (e) {
                coordinate_point = e.point;
            });
            coordinate_map.clearOverlays();
            coordinate_map.addOverlay(marker);
            coordinate_map.centerAndZoom(coordinate_point, coordinate_zoom);
        }

        $('#modal_coordinate').on('shown.bs.modal', function () {
            $('#search_coordinate').val('');
            mark(coordinate_point);
        });

        //建立一个自动完成的对象
        var coordinate_ac = new BMap.Autocomplete({'input': 'search_coordinate', 'location': coordinate_map});

        //鼠标点击下拉列表后的事件
        coordinate_ac.addEventListener("onconfirm", function (e) {
            var value = e.item.value;
            var address = value.province + value.city + value.district + value.street + value.business;

            var local = new BMap.LocalSearch(coordinate_map, {
                onSearchComplete: function () {
                    //获取第一个智能搜索的结果
                    coordinate_point = local.getResults().getPoi(0).point;
                    mark(coordinate_point);
                }
            });
            local.search(address);
        });

        $('#btn_submit_coordinate').click(function () {
            $('#coordinate').val(coordinate_point.lng + ',' + coordinate_point.lat);
        });


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

        //    var map = new BMap.Map("mapall");
        //    var geoc = new BMap.Geocoder();   //地址解析对象
        //    var markersArray = [];
        //    var geolocation = new BMap.Geolocation();
        //    var zoomSize = 12;
        //    var point = new BMap.Point(116.331398, 39.897445);
        //
        //    map.centerAndZoom(point, zoomSize); // 中心点
        //    //选取当前位置
        //    geolocation.getCurrentPosition(function (r) {
        //        var mk = new BMap.Marker(r.point);
        //        map.addOverlay(mk);
        //        map.panTo(r.point);
        //        map.enableScrollWheelZoom(true);
        //    }, {enableHighAccuracy: true})
        //
        //    map.addEventListener("click", showInfo);
        //
        //    //清除标识
        //    function clearOverlays() {
        //        if (markersArray) {
        //            for (i in markersArray) {
        //                map.removeOverlay(markersArray[i])
        //            }
        //        }
        //    }
        //    //地图上标注
        //    function addMarker(point) {
        //        var marker = new BMap.Marker(point);
        //        markersArray.push(marker);
        //        clearOverlays();
        //        map.addOverlay(marker);
        //    }
        //    //点击地图事件处理
        //    function showInfo(e) {
        //        geoc.getLocation(e.point, function (rs) {
        //            var addComp = rs.addressComponents;
        //            var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
        //
        //
        //            document.getElementById('address_inner').value = address;
        //            document.getElementById('coordinate_inner').value = e.point.lng + "," + e.point.lat;
        //
        //            $('#btn_search').click(function () {
        //                document.getElementById('address').value = address;
        //                document.getElementById('coordinate').value = e.point.lng + "," + e.point.lat;
        //            })
        //        });
        //
        //        addMarker(e.point);
        //    }
        //
        //    //搜索
        //    function addrSearch(serachAddr) {
        //        // 将地址解析结果显示在地图上,并调整地图视野
        //        if (!serachAddr) {
        //            serachAddr = $("#search").val();
        //        }
        //
        //        var map = new BMap.Map("allmap");
        //        map.centerAndZoom(point, zoomSize);
        //
        //        geolocation.getCurrentPosition(function (r) {
        //            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
        //                var mk = new BMap.Marker(r.point);
        //                map.addOverlay(mk);
        //                map.panTo(r.point);
        //                map.enableScrollWheelZoom(true);
        //            }
        //            else {
        //                alert('failed' + this.getStatus());
        //            }
        //        }, {enableHighAccuracy: true})
        //
        //        var local = new BMap.LocalSearch(map, {
        //            renderOptions: {map: map}
        //        });
        //        local.search(serachAddr);
        //
        //        map.addEventListener("click", showInfo);
        //    }
    </script>
@endsection




