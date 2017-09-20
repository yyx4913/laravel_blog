<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //
    public function index() //文章列表首页面 admin.article
    {
        //$data= (new Category)->Tree();
        $data = Article::paginate(5);
        return view('admin.article.index',compact('data'));
    }

    public function store()//post   admin.article.store 上传文章
    {
        $input = Input::except('_token');

        $rules =[
            'art_title'=>'required|between:1,25',
            'art_tag'=>'between:1,20',
            'art_content'=>'required',
        ];

        $message = [
            'art_title.required'=>'标题不能为空',
            'art_content.required'=>'内容不能为空',
            'art_title.between'=>'字数不能超过25',
            'art_tag.between'=>'字数不能超过20'
        ];

        $valid =Validator::make($input,$rules,$message);
        if($valid->passes())
        {
            $input['art_time']=time();
            $re= Article::create($input);
            if($re){
                return back()->with('errors','添加成功');
            }else{
                return back()->with('errors','添加失败');
            }
        }else{
            return back()->withErrors($valid);
        }
    }

    public function create()  //get admin.article.create 添加文章
    {
        $cate = (new Category)->Tree();
        return view('admin.article.add',compact('cate'));
    }

    public function edit($art_id)  //编辑文章
    {
        $data =Article::find($art_id);
        $cate = (new Category)->Tree();

        return view('admin.article.edit',compact('cate','data'));
    }

    public function update($art_id)  //put ,更新数据
    {
        $input = Input::except('_token','_method');
        $re= Article::where('art_id',$art_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','添加失败');
        }
    }

    public function destroy($art_id) //删除信息
    {
        $re = Article::where('art_id',$art_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '文章删除成功！',
                'url' =>'article'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    public function show($art_id)//查看信息
    {

    }
}
