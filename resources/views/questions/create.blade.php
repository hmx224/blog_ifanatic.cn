@extends('layouts.app')

@include('vendor.ueditor.assets')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">发布文章</div>
                    <div class="panel-body">
                        <form action="/questions" method="POST">

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

                            <div class="form-group">
                                <label for="select2">标签:</label>
                                <select class="select2 form-control" multiple="multiple"
                                        id="topics" name="topics[]">
                                </select>
                            </div>


                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">内容:<span style="color:hotpink;">(图片上传最大上传大小:10M)</span></label>
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" type="text/plain" >
                                    {!! old('body') !!}
                                </script>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">发布文章</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--<link rel="stylesheet" href="/plugins/layui/2.1.2/css/layui.css" media="all">--}}
    <script src="/plugins/layui/2.1.2/layui.js" charset="utf-8"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'},

        });

        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

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
                placeholder: '搜索选择或自定义相关话题,最大10个字符，回车键或者下拉框选中话题',
                minimumInputLength: 2,
                maximumInputLength: 10,
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
    </script>
@endsection

