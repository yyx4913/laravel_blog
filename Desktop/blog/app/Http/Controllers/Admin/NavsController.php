<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Link;

class NavsController extends Controller
{

    public function index()  //自定义菜单列表
    {
        $data= Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.list',compact('data'));
    }

    public function changeOrder() //自定义菜单修改排序
    {
        $input = Input::all();


        if(!is_array($input['nav_order']))
        {
            $data = [
                'status' => 0,
                'msg' => '输入数字不合法'
            ];
            return $data;
        }

        else{
            foreach($input['nav_order'] as $k =>$v)
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
                $nav = Navs::find($k);
                $nav->nav_order = $v;
                $res = $nav->update();
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
                    'url'=>'navs'
                ];
            }
            return $data;
        }

    }

    public function create()//创建自定义菜单
    {

        return view('admin.navs.add');
    }

    public function store()//上传自定义菜单信息
    {
        $data = Input::except('_token');
        $rules =[
            'nav_name'=>'required|between:1,6',
            'nav_url'=>'required',
        ];
        $message =[
            'nav_name.required'=>'菜单名不能为空',
            'nav_url.required'=>'菜单链接URL不能为空',
            'nav_name.between'=>'不能超过6个字',
        ];

        $validate = Validator::make($data,$rules,$message);
        if($validate->passes())
        {
            $re = Navs::create($data);
            if($re){
                return back()->with('errors','添加成功');
            }else{
                return back()->with('errors','添加失败');
            }
        }else{
            return back()->withErrors($validate);
        }
    }

    public function show(){  ////显示自定义菜单

    }



    public function edit($nav_id) ////编辑自定义菜单
    {
        if(!is_numeric($nav_id))
        {
            return back()->with('errors','id值输入不合法');
        }
        $data = Navs::find($nav_id);
        return view('admin.navs.edit',compact('data'));


    }

    public function update($nav_id)  //更新自定义菜单
    {
        $data = Input::except('_token','_method');
        $re= Navs::where('nav_id',$nav_id)->update($data);
        if($re){
            $data = [
                'status' => 1,
                'msg' => '数据更新成功！',
                'url' =>'/admin/navs'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '数据更新失败，请稍后重试！',
            ];
        }
        return $data;

    }

    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '菜单信息删除成功！',
                'url' =>'/admin/navs'
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
