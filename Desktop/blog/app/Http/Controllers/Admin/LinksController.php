<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Link;

class LinksController extends Controller
{

    public function index()  //友情链接列表
    {
        $data= Links::orderBy('link_order','asc')->get();
        return view('admin.links.list',compact('data'));
    }

    public function changeOrder() //友情链接修改排序
    {
        $input = Input::all();


        if(!is_array($input['link_order']))
        {
            $data = [
                'status' => 0,
                'msg' => '输入数字不合法'
            ];
            return $data;
        }

        else{
            foreach($input['link_order'] as $k =>$v)
            {
                $errors[]='';
                if(!is_numeric($v))
                {
                    $data = [
                        'status' => 0,
                        'msg' => '输入值必须为数字'
                    ];
                    return $data;
                }
                $link = Links::find($k);
                $link->link_order = $v;
                $res = $link->update();
                if($res ==0)
                {
                    $errors[]=$k;
                }
            }
            if(!$errors){
                $info ='ID号为'.implode(',',$errors).'更新失败';
                $data = [
                    'status' => 0,
                    'msg' => $info
                ];
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '更新排序成功',
                    'url'=>'links'
                ];
            }
            return $data;
        }

    }

    public function create()//创建友情链接
    {

        return view('admin.links.add');
    }

    public function store()//上传友情链接信息
    {
        $data = Input::except('_token');
        $rules =[
            'link_title'=>'required|between:1,10',
            'link_name'=>'required|between:1,15',
            'link_url'=>'required',
        ];
        $message =[
            'link_title.required'=>'类别不能为空',
            'link_name.required'=>'类别不能为空',
            'link_url.required'=>'类别不能为空',
            'link_title.between'=>'不能超过10个字',
            'link_name.between'=>'不能超过15个字',
        ];

        $validate = Validator::make($data,$rules,$message);
        if($validate->passes())
        {
            $re = Links::create($data);
            if($re){
                return back()->with('errors','添加成功');
            }else{
                return back()->with('errors','添加失败');
            }
        }else{
            return back()->withErrors($validate);
        }
    }

    public function show(){  ////显示友情链接

    }



    public function edit($link_id) ////编辑友情链接
    {
        if(!is_numeric($link_id))
        {
            return back()->with('errors','id值输入不合法');
        }
        $data = Links::find($link_id);
        return view('admin.links.edit',compact('data'));


    }

    public function update($link_id)  //更新友情链接
    {
        $data = Input::except('_token','_method');
        $re= Links::where('link_id',$link_id)->update($data);
        if($re){
            $data = [
                'status' => 1,
                'msg' => '数据更新成功！',
                'url' =>'/admin/links'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '数据更新失败，请稍后重试！',
            ];
        }
        return $data;

    }

    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
                'url' =>'/admin/links'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}
