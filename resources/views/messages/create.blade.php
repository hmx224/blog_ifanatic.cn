@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">发布留言</div>
                    <div class="panel-body">
                        <form action="/messages" method="POST">

                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题:</label>
                                <input type="text" value="{{ old('title') }}" name="title" id="title"
                                       class="form-control" placeholder="标题">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content">内容:<span
                                            style="color:hotpink;">(移动端会员,建议横屏编辑体验更好！图片最大2M)</span></label>
                                <!-- LayUi -->
                                <textarea class="layui-textarea" id="content" name="content"
                                          style="display: none">
                                      {!! old('content') !!}
                                </textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('file_url') ? ' has-error' : '' }}">
                                <button type="button" class="layui-btn" id="file_url" name="file_url">
                                    <i class="layui-icon">&#xe67c;</i>上传文件
                                </button>

                                <span id="file_url_item"></span>
                                @if ($errors->has('file_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file_url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">发布留言</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">

@section('js')
    <script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        $(document).ready(function () {
            function formatTopic(topic) {
                return "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" +
                topic.name ? topic.name : "ifanatic.cn" +
                    "</div></div></div>";
            }

            function formatTopicSelection(topic) {
                return topic.name || topic.text;
            }

            $(".select2").select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: '/api/topics',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatTopic,
                templateSelection: formatTopicSelection,
                escapeMarkup: function (markup) {
                    return markup;
                },
                language: "zh-CN",
            });
        });

        layui.use('layedit', function () {
            var layedit = layui.layedit
                , $ = layui.jquery;

            //向服务端提交请求  后台回调格式有问题，修复
            layedit.set({
                uploadImage: {
                    url: "{{ url('api/files/upload') }}", //接口url
                    type: "post"//默认post
                }
            });

            //构建一个默认的编辑器
            layedit.build('content', {
                height: 240, //设置编辑器高度
                tool: [
                    'strong' //加粗
                    , 'italic' //斜体
                    , 'underline' //下划线
                    , 'del' //删除线
                    , '|' //分割线
                    , 'left' //左对齐
                    , 'center' //居中对齐
                    , 'right' //右对齐
                    , 'link' //超链接
                    , 'unlink' //清除链接
                    , 'face' //表情
                    , 'image' //插入图片
//                    , 'help' //帮助
                ]
            });
        });
    </script>


    <!-- 上传文件 -->
    <script>
        layui.use('upload', function () {
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({

                elem: '#file_url', //绑定元素,
                url: '/files/upload', //上传接口,
                accept: 'file', //普通文件
                data: {_token: '{{ csrf_token() }}'},
                method: 'post',
                // before: function (obj) { //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                //     layer.load(); //上传loading
                // },
                choose: function (obj) {
                    //将每次选择的文件追加到文件队列
                    var files = obj.pushFile();

                    //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                    obj.preview(function (index, file, result) {
                        console.log(index); //得到文件索引
                        console.log(file); //得到文件对象
                        console.log(result); //得到文件base64编码，比如图片

                        //这里还可以做一些 append 文件列表 DOM 的操作

                        //obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
                        //delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
                    });
                },
                done: function (res) {
                    console.log(res);
                    //上传完毕回调
                    $('#file_url_item').html(res.data);
                }
                , error: function () {
                    //请求异常回调
                    console.log('error');
                }
            });
        });
    </script>
@endsection
