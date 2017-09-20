<?php

namespace App\Http\Controllers\Admin;



use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //
    public function index() //get 分类列表
    {

        $data = (new Category)->Tree();
        //$data = (new Category)->where('cate_id','<',2)->get();
        //$data = $data->paginate(8);
        return view('admin.category.list',compact('data'));
    }

    public function changeOrder() //修改排序
    {
        $input = Input::all();

        if(!is_array($input['cate_order']))
        {
            $data = [
                'status' => 0,
                'msg' => '输入数字不合法'
            ];
            return $data;
        }

        else{
            foreach($input['cate_order'] as $k =>$v)
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
                $cate = Category::find($k);
                $cate->cate_order = $v;
                $res = $cate->update();
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
                    'url'=>'category'
                ];
            }
            return $data;
        }

    }

    public function store()//post   admin.category.store //上传新添加的分类信息
    {
        $input =Input::except('_token');
//        dd($input);exit;
        $rules=[
            'cate_title' => 'required|between:1,15',
            'cate_keywords' =>'between:0,15',
            'cate_description'=>'required',
        ];

        $message=[
            'cate_title.required'=>'分类名称不能为空',
            'cate_title.between'=>'分类名称不能超过15个字',
            'cate_keywords.between'=>'不能超过15个字',
            'cate_description.required'=>'内容不能为空',
        ];

        $validate =Validator::make($input,$rules,$message);
        if($validate->passes()){
            $re= Category::create($input);
            if($re){
                return back()->with('errors','添加成功');
            }else{
                return back()->with('errors','添加失败');
            }
        }else{
            return back()->withErrors($validate);
        }
    }

    public function create() //get admin/category/create创建
    {
        $cate = Category::where('cate_pid', 0)->get();
        return view('admin/category/add',compact('cate'));
    }

    public function show()  //get
    {

    }

    public function edit($cate_id) //get  admin/category/{category}/edit编辑
    {
        if(!is_numeric($cate_id))
        {
            return back()->with('errors','id值输入不合法');
        }
        $cate = Category::where('cate_pid', 0)->get();
        $data = Category::find($cate_id);
        return view('admin.category.edit',compact('cate','data'));
    }

    public function update($cate_id) //put  //更新数据
    {
        $input = Input::except('_token','_method');
        $re= Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','更新失败');
        }
    }

    public function destroy($cate_id) //删除
    {
       $re = Category::where('cate_id',$cate_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
                'url' =>'category'
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
