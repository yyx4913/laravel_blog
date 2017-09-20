@extends('layouts/admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/category')}}">分类管理</a> &raquo; 添加分类
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

    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父分类：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==全部分类==</option>
                            @foreach($cate as $v)
                            <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                           @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>类别名称：</th>
                    <td>
                        <input type="text" class="lg" name="cate_name">
                        <p>不能多于15个字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>类别标题：</th>
                    <td>
                        <input type="text" class="lg" name="cate_title">
                        <p>不能多于15个字</p>
                    </td>
                </tr>
                <tr>
                    <th>关键字：</th>
                    <td>
                        <input type="text" name="cate_keywords">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于15个字</span>
                    </td>
                </tr>

                <tr>
                    <th>详细内容：</th>
                    <td>
                        <textarea class="lg" name="cate_description"></textarea>
                        <p>标题可以写30个字</p>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" name="cate_order">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不能多于15个字</span>
                    </td>
                </tr>
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
