<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Link;

class ConfigController extends Controller
{

    public function index()  //自定义配置列表
    {
        $data= Config::orderBy('conf_order')->get();
        foreach ($data as $k=> $v) {
            switch ($v->conf_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea name="conf_content[]" >'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    if($v->conf_value==1){
                        $r1= '<input type="radio" name="conf_content[]" value="1" checked> 开启　　';
                        $r2= '<input type="radio" name="conf_content[]" value="0"> 关闭';
                    }else{
                        $r1= '<input type="radio" name="conf_content[]" value="1" > 开启　　';
                        $r2= '<input type="radio" name="conf_content[]" value="0" checked> 关闭';
                    }
                    $data[$k]->_html =$r1.$r2;
                    break;
            }
        }
        //dd($data);
        return view('admin.config.list',compact('data'));
    }

    public function putFile()  //将生产的config写入到文件中
    {
        $conf = Config::pluck('conf_content','conf_name')->all();
        $str =  '<?php return '.var_export($conf,true).';'; //转化为字符串
        $path = base_path().'/config/web.php';
        file_put_contents($path,$str);
    }

    public function changeOrder() //自定义配置修改排序
    {
        $input = Input::all();


        if(!is_array($input['conf_order']))
        {
            $data = [
                'status' => 0,
                'msg' => '输入数字不合法'
            ];
            return $data;
        }

        else{
            foreach($input['conf_order'] as $k =>$v)
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
                $nav = Config::find($k);
                $nav->conf_order = $v;
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
                    'url'=>'config'
                ];
            }
            return $data;
        }

    }

    public function create()//创建自定义配置
    {

        return view('admin.config.add');
    }

    public function store()//上传自定义配置信息
    {
        $data = Input::except('_token');
        if($data['conf_type']=='radio' && $data['conf_value']==1){
            $data['conf_content']='开启';
        }elseif($data['conf_type']=='radio' && $data['conf_value']==0){
            $data['conf_content']='关闭';
        }
        $rules =[
            'conf_title'=>'required|between:1,10',
            'conf_name'=>'required',
            //'conf_type'=>'required',
            //'conf_value'=>'required',

        ];
        $message =[
            'conf_title.required'=>'配置标题不能为空',
            'conf_name.required'=>'配置名称不能为空',

            'conf_title.between'=>'不能超过10个字',
            //'conf_type.required'=>'配置类型不能为空',
            //'conf_value.required'=>'配置名不能为空',

        ];

        $validate = Validator::make($data,$rules,$message);
        if($validate->passes())
        {
            $re = Config::create($data);
            if($re){
                $this->putFile(); //添加数据到文件
                return back()->with('errors','添加成功');
            }else{
                return back()->with('errors','添加失败');
            }
        }else{
            return back()->withErrors($validate);
        }
    }

    public function show(){  ////显示自定义配置

    }



    public function edit($conf_id) ////编辑自定义配置
    {
        if(!is_numeric($conf_id))
        {
            return back()->with('errors','id值输入不合法');
        }
        $data = Config::find($conf_id);
        return view('admin.config.edit',compact('data'));


    }

    public function update($conf_id)  //更新自定义配置
    {
        $data = Input::except('_token','_method');
        if($data['conf_type']=='radio'&& $data['conf_value']==1){
            $data['conf_content']='开启';
        }elseif($data['conf_type']=='radio'&& $data['conf_value']==0){
            $data['conf_content']='关闭';
        }
        $re= Config::where('conf_id',$conf_id)->update($data);
        if($re){
            $this->putFile();
            $data = [
                'status' => 1,
                'msg' => '数据更新成功！',
                'url' =>'/admin/config'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '数据更新失败，请稍后重试！',
            ];
        }
        return $data;

    }

    public function destroy($conf_id)
    {
        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile();
            $data = [
                'status' => 0,
                'msg' => '配置信息删除成功！',
                'url' =>'/admin/config'
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
