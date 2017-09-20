@extends('layouts/home')
@section('meta')
  <title>{{$art->art_title}}</title>
  <meta name="keywords" content="{{$art->tag}}" />
  <meta name="description" content="{{$art->description}}" />
@endsection
@section('content')
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav">
    @foreach($navs as $nav)
      <a href="{{$nav->nav_url}}"><span>{{$nav->nav_name}}</span><span class="en">{{$nav->nav_alias}}</span></a>
    @endforeach
  </nav>
</header>
<article class="blogs">
    <h1 class="t_nav"><span>{{$cate->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('home/cate/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$art->art_title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$art->art_time)}}</span><span>编辑：{{$art->art_editor}}</span><span>查看次数：{{$art->art_view}}</span></p>
    <ul class="infos">
      {!! $art->art_content !!}
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{$art->art_tag}}</p>
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
        @if($pre_text)<p>上一篇：<a href="{{url('home/news/').'/'.$pre_text->art_id}}">{{$pre_text->art_title}}</a></p>@endif
       <p>下一篇： @if($next_text)
           <a href="{{url('home/news/').'/'.$next_text->art_id}}">{{$next_text->art_title}}</a></p>
            @else
              暂时没有下一篇啦..
          @endif
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @foreach($new as $v)
          <li><a href="{{url('home/news/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
        @endforeach
      </ul>
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
    <!-- Baidu Button END -->
    <div class="blank"></div>
      @if($hot->all())
    <div class="news"><br/>
      <h3>
        <p>栏目<span>最新</span></p>
      </h3>
      <ul class="rank">
        @foreach($new as $v)
          <li><a href="{{url('home/news/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
        @endforeach
      </ul>
      <h3 class="ph">
        <p>点击<span>排行</span></p>
      </h3>
      <ul class="paih">
        @foreach($hot as $v)
          <li><a href="{{url('home/news'.$v->art_id)}}" title="{{$v->art_title}}">{{$v->art_title}}</a></li>
        @endforeach
      </ul>
    </div>
      @endif
    <div class="visitors">
      <h3>
        <p>最近访客</p>
      </h3>
      <ul>
      </ul>
    </div>
  </aside>
</article>

@endsection