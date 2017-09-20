<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller{

    public function upload()  //处理uploadify上传的文件
    {
        $file =Input::file('Filedata'); //获取缩略图信息
        if($file->isValid()){
            //$realPath = $file->getRealPath(); //获取文件的绝对路径
            $extend =$file->getClientOriginalExtension(); //获取文件后缀名
            $newName = date('Ymd').mt_rand(1000,9999).'.'.$extend;//文件新名称
            $path = $file->move(base_path().'/uploads',$newName); //上传文件成功后的绝对路径
            return 'uploads/'.$newName;
        }
    }
}