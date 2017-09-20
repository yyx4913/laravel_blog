@extends('layouts/admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/config')}}">配置列表</a> &raquo; 添加配置
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            {{--<h3>快捷操作</h3>--}}
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
    <div class="result_wrap" >
        <form action="{{url('admin/config')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>配置标题：</th>
                    <td>
                        <input type="text" class="lg" name="conf_title" style="width:15em;">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于10个字</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置名称：</th>
                    <td>
                        <input type="text" class="lg" name="conf_name" style="width:15em;">

                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置类型：</th>
                    <td>
                        <input type="radio" class="lg" name="conf_type" value="input" checked onclick="showTr()">input　　
                        <input type="radio" class="lg" name="conf_type" value="textarea" onclick="showTr()" >textarea　　
                        <input type="radio" class="lg" name="conf_type" value="radio" onclick="showTr()">radio　　

                    </td>
                </tr>
                <tr class="type_value">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg" name="conf_value" style="width:6em;">
                        <span><i class="fa fa-exclamation-circle yellow"></i>1表示开启，0表示关闭 </span>
                    </td>
                </tr>
                <tr>
                    <th>配置说明：</th>
                    <td>
                        <textarea name="conf_tips"> </textarea>

                    </td>
                </tr>
                <tr class="content">
                    <th>配置内容：</th>
                    <td>
                        <textarea name="conf_content"> </textarea>

                    </td>
                </tr>

                <tr>
                    <th>配置排序：</th>
                    <td>
                        <input type="text" class="lg" name="conf_order" style="width:5em;">
                        <span><i class="fa fa-exclamation-circle yellow"></i>必须位数字</span>
                    </td>
                </tr>

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
    <script>
        showTr();
        function showTr(){  //显示隐藏类型值的输入框  类型值只有在radio标签下有用
            var type = $('input[name=conf_type]:checked').val();
            if(type == 'radio'){
                $('.type_value').show();
                $('.content').hide();
            }else{
                $('.type_value').hide();
                $('.content').show();
            }
        }
    </script>
    @endsection

