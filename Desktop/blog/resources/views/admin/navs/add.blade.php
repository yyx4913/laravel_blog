@extends('layouts/admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/navs')}}">菜单列表</a> &raquo; 添加菜单
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
        <form action="{{url('admin/navs')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>菜单标题：</th>
                    <td>
                        <input type="text" class="lg" name="nav_name" style="width:15em;">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于6个字</span>
                    </td>
                </tr>
                <tr>
                    <th>菜单别名：</th>
                    <td>
                        <input type="text" class="lg" name="nav_alias" style="width:15em;">

                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>菜单URL：</th>
                    <td>
                        <input type="text" class="lg" name="nav_url">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能为空</span>
                    </td>
                </tr>

                <tr>
                    <th>菜单排序：</th>
                    <td>
                        <input type="text" class="lg" name="nav_order" style="width:5em;">
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
    @endsection
