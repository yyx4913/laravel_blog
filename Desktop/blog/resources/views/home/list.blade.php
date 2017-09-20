@extends('layouts/home')
@section('meta')
    <title>{{$cate->cate_name.'--'.$cate->cate_title}}</title>
    <meta name="keywords" content="{{$cate->cate_keywords}}" />
    <meta name="description" content="{{$cate->cate_description}}" />
@endsection
@section('content')
<body>
<header>
  <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $nav)
            <a href="{{$nav->nav_url}}"><span>{{$nav->nav_name}}</span><span class="en">{{$nav->nav_alias}}</span></a>
        @endforeach
    </nav>
</header>

<article class="blogs">
    @if($data->all())
<h1 class="t_nav"><span>{{$cate->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('home/cate/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a></h1>
<div class="newblog left">
    @foreach($data as $v)
   <h2>{{$v->art_title}}</h2>
   <p class="dateview"><span>　发布时间：{{date('Y-m-d',$v->art_time)}}</span>　<span>{{$v->art_editor}}</span><span>分类：[<a href="{{url('home/cate/'.$cate->cate_id)}}">{{$cate->cate_name}}</a>]</span></p>
    <figure><img src="{{$v->art_thumb}}"></figure>
    <ul class="nlist">
      <p>{{$v->art_description}}</p>
      <a href="{{url('home/news/'.$v->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul><div class="line"></div>
    @endforeach
    <div class="blank"></div>
    <div class="ad">
    </div>
    <div class="page">
        {{$data->links()}}
    </div>
</div>
<aside class="right">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END --><br/>
    <div class="rnav">
        @if($kind->all())
      <ul>
          @foreach($kind as $k=>$v)
       <li class="rnav{{$k+1}}"><a href="{{url('home/cate/'.$v->cate_id)}}" target="_blank">{{$v->cate_name}}</a></li>
          @endforeach
     </ul>
      @endif
    </div><br/>
<div class="news">

    <h3 class="ph">
      <p>点击<span>排行</span>
    </h3>
    <ul class="paih">
        @foreach($hot as $v)
            <li><a href="{{url('home/news/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
        @endforeach
    </ul>
    </div>
    <div class="visitors">
      <h3><p>最近访客</p></h3>
      <ul>

      </ul>
    </div>

</aside>
    @else
        <h1 style="color:red;text-align:center;margin:5em auto 5em auto; font-size:3em;">暂时没有内容！！</h1>
    @endif
</article>

@endsection