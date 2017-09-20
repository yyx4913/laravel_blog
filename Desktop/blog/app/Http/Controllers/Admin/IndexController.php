<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        //dd($_SERVER);
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }

    public function update_pass()  //修改密码
    {

        if($input= Input::all())
        {
            $rules =[
                'password_o'=>'required',
                'password'=>'required|between:5,20|confirmed',
                'password_confirmation'=>'required',
            ];

            $message = [
                'password_o.required'=>'原始密码不能为空',
                'password.required'=>'新密码不能为空',
                'password.confirmed' =>'两次输入的密码不相同',
                'password_confirmation.required'=>'确认密码不能为空',
                'password.between'=>'密码长度在5-20之间',
            ];

            $validate = Validator::make($input,$rules,$message);
            if($validate->passes())
            {
                $user = User::first();
                if($input['password_o']==Crypt::decrypt($user->user_pass))
                {
                    $user->user_pass=Crypt::encrypt($input['password']);
                    $user->save();
                    return back()->with('errors','修改密码成功');
                }else{
                    return back()->with('errors','原始密码不正确');
                }
            }else{
                 return back()->withErrors($validate);

            }
        }

        return view('admin.pass');
    }
}
