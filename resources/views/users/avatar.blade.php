@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">修改头像</div>
                    <div class="panel-body">
                            <form action="/users/change_avatar/{{ $user->id }}" method="POST">

                            {!! csrf_field() !!}

                            <input type="hidden" value="" id="avatar" name="avatar"
                                   class="form-control" placeholder="会员头像">

                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">会员头像<br/><span style="color:deeppink;">(注:图片大小不超过2M)</span></label>
                                <div class="col-sm-2">
                                    <img class="img-circle" id="avatar_url" width="100px" height="100px;"
                                         src="{{ $user->avatar }}"
                                         alt="会员头像">
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="upload_avatar"><i
                                                class="layui-icon"></i>上传图片
                                    </button>
                                    <img class="layui-upload-img img-circle" id="avatar_img">
                                    <span id="demoText"></span>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">更新头像</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">
    <script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>


    <!--使用layer-->
    <link rel="stylesheet" href="/plugins/layer/3.0.3/layer/skin/default/layer.css" media="all">
    <script src="/plugins/layer/3.0.3/layer/layer.js"></script>

    <script>


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
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    $('#avatar').val(res.data.src);

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
    </script>

@endsection


