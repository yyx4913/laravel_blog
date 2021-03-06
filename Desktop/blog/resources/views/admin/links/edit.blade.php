@extends('layouts/admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/links')}}">链接列表</a> &raquo; 添加链接
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
        <form id="add_table_info" method="post">

            <table class="add_tab">
                <tbody>

                <tr>
                    <th><i class="require">*</i>链接类别：</th>
                    <td>
                        <input type="text" class="lg" name="link_name" style="width:10em;" value="{{$data->link_name}}" >
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于10个字</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>链接标题：</th>
                    <td>
                        <input type="text" class="lg" name="link_title" style="width:15em;" value="{{$data->link_title}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于15个字</span>
                    </td>
                </tr>
                <tr>
                    <th>链接URL：</th>
                    <td>
                        <input type="text" class="lg" name="link_url" value="{{$data->link_url}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能为空</span>
                    </td>
                </tr>

                <tr>
                    <th>链接排序：</th>
                    <td>
                        <input type="text" class="lg" name="link_order" style="width:5em;" value="{{$data->link_order}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>必须位数字</span>
                    </td>
                </tr>

                    <th></th>
                    <td>
                        <input type="button" value="提交" onclick="add_info('{{url('admin/links').'/'.$data->link_id}}','{{csrf_token()}}')">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    @endsection
