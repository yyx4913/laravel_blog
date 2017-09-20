<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    public function index()  //首页
    {

        //点击量最高的6篇文章
        $hot = Article::orderBy('art_view','desc')->take(6)->get();
        //带有分页的推荐文章5篇
        $data = Article::join('category','article.cate_id','=','category.cate_id')->orderBy('art_time','desc')->paginate(5);
        //最新文章推荐7篇
        $new = Article::orderBy('art_time','desc')->take(6)->get();
        //友情链接
        $links = Links::all();
        return view('home.index',compact('hot','data','new','links'));
    }

    public function cate($cate_id)  //分类列表
    {
        //浏览数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');
        //新闻列表
        $data = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
        //最热的同类文章
        $hot = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->take(7)->get();
        $cate = Category::find($cate_id);

        //新闻子类型
        $kind =Category::where('cate_pid',$cate_id)->orderBy('cate_id','asc')->get();
        return view('home.list',compact('cate','data','hot','kind'));
    }

    public function news($art_id) //具体新闻
    {
        //浏览数自增
        Article::where('art_id',$art_id)->increment('art_view');

        $cate_id = Article::where('art_id',$art_id)->pluck('cate_id');
        //最新的同类文章
        $cate = Category::find($cate_id);
        $new = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->take(7)->get();
        $art = Article::find($art_id);
       //上一篇文章
        $pre_text = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        //下一篇文章
        $next_text = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        //点击排行
        $hot = Article::where('cate_id',$cate_id)->orderBy('art_view','desc')->take(6)->get();
        return view('home.news',compact('art','new','hot','pre_text','next_text','hot','cate'));
    }
}
