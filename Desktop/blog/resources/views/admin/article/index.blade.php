@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;文章列表
    </div>
    <!--面包屑导航 结束-->

    <!--结果页快捷搜索框 开始-->
    <div class="search_wrap">
        <form method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="">百度</option>
                            <option value="">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form id="form_list">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    {{--<a href="javascript:;" onclick="update('{{url('admin/cate/changeOrder')}}','{{csrf_token()}}')">--}}
                        {{--<i class="fa fa-recycle"></i>刷新排序</a>--}}
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>

                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>关键词</th>
                        <th>查看量</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value=""></td>

                        <td class="tc">{{$v->art_id}}</td>
                        <td>
                            <a href="{{url('')}}">{{$v->art_title}}</a>
                        </td>
                        <td>{{$v->art_tag}}</td>
                        <td>{{$v->art_view}}</td>
                        <td>{{date('Y-m-d H:i:s',$v->art_time)}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="del('{{url('admin/article/'.$v->art_id)}}','{{csrf_token()}}','该文章信息')">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list" style="padding:6px 12px;">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        $("#change").click(function(){
            var postData = {};
            postData['_token'] = "{{csrf_token()}}";
            var data = $('#form_list').serializeArray();
            $(data).each(function (i) {
                postData[this.name] = this.value;
            });
            //console.log(postData);

            $.post("{{url('admin/cate/changeOrder')}}", postData, function (data) {
                if(data.status==1){
                     return layer.alert(data.message, {icon: 6});
                     var url ="location.replace(location.href)";
                    setTimeout(url,1000);
                }else{
                   layer.alert(data.message, {icon: 5});
                }
            });
        });

        function change1(obj,cate_id)
        {
            var cate_order =$(obj).val();
            postData = {};
            postData['cate_id'] =cate_id;
            postData['_token'] ="{{csrf_token()}}";
            postData['cate_order'] = cate_order;
            $.post("{{url('admin/cate/changeOrder')}}", postData, function (data) {

            });
        }

        {{--}--}}


    function change2() {
            alert('a');
        }

    </script>

@endsection