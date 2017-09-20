@extends('layouts/admin')
@section('content')
    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
    </style>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/article')}}">文章列表</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach( $errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        {{$errors}}
                    @endif
                </div>
            @endif
        </div>
        {{--<div class="result_content">--}}
            {{--<div class="short_wrap">--}}
                {{--<a href="#"><i class="fa fa-plus"></i>新增文章</a>--}}
                {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>分类：</th>
                    <td>
                        <select name="cate_id">

                            @foreach($cate as $v)
                            <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                           @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于25个字</span>
                    </td>
                </tr>
                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" name="art_editor">
                    </td>
                </tr>
                <tr>
                    <th>关键字：</th>
                    <td>
                        <input type="text" name="art_tag">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于15个字</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章缩略图：</th>
                    <td>
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <input type="hidden" name="art_thumb" id="upload_img" value="">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText': '上传图片',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : "{{csrf_token()}}"
                                    },
                                    'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                    'uploader' : "{{url('admin/upload')}}",
                                    'onUploadSuccess' : function(file, data, response) {
                                        if(response){
                                            $('#' + file.id).find('.data').html(' 上传完毕');
                                            $("#upload_img").attr('value','/'+data);
                                            $("#thumb_upload").attr('src','/'+data);
                                        }

                                    }
                                });
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" id="thumb_upload"  style="max-width:200px;max-height:100px;">
                    </td>
                </tr>
                <tr>
                    <th>描述信息：</th>
                    <td>
                        <textarea class="lg" name="art_description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>详细内容：</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" type="text/plain" name="art_content" style="width:720px;height:300px;"></script>
                        <script>var ue = UE.getEditor('editor',{
                                toolbars: [
                                    ['fullscreen', 'undo', 'redo',
                                    'bold', 'italic',  'indent','underline',
                                        'fontsize', 'fontfamily', '|', 'forecolor', 'simpleupload', 'emotion','backcolor', ]
                                ]
                            });</script>

                    </td>
                </tr>
                {{--<tr>--}}
                    {{--<th>排序：</th>--}}
                    {{--<td>--}}
                        {{--<input type="text" name="cate_order">--}}
                        {{--<span><i class="fa fa-exclamation-circle yellow"></i>输入值为数字</span>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection
