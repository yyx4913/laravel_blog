<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/code.class.php';

class LoginController extends CommonController
{

    public function login()
    {
        //echo  Crypt::encrypt('admin');
        if($res = Input::all())
        {
            $code = new \Code();
            $getCode =  $code->get();
            if(strtoupper($res['code'])!=$getCode)
            {
                return back()->with('msg','验证码错误');
            }
            $user = User::first(); //获得超级管理员的信息
            if(trim($res['user_name'])!=$user->user_name || trim($res['user_pass'])!=Crypt::decrypt($user->user_pass))
            {

                return back()->with('msg','用户名或密码错误!');
            }else{
                session(['user'=>$user]);
                return redirect('admin');
            }
        }

        return view('admin.login');
    }

    public function code(){  //生成验证码
        $code = new \Code;
         $code->make();
    }

    public function logout()  //退出登录
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    // public function test()
    // {
        
    //     if($res = Input::all())
    //     {
    //          dd($res);
    //         // echo '<br/>';
            
    //     }
        
    //     return view('test');
    // }


}
