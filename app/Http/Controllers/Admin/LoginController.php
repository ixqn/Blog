<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
require_once  app_path()."/Org/code/Code.class.php";
use App\Http\Org\code\Code;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function  login()
    {
        //后台登录
        return view('admin.login');
    }
    //生成验证码
    public function captcha()
    {
        $code = new Code();
        return $code->make();
    }
    //表单验证
    public function doLogin(Request $request)
    {

        //接收表单数据
        $input = $request->except('_token');
        //规则验证 被验证的数据 设置验证规则 错误提示信息
        $rule = [
            'nickname'=>'required|between:5,18',
            'password'=>'required|between:5,18',
            'captcha'=>'required|between:4,4',
        ];
        $msg = [
            'nickname.required'=>'请输入用户名!',
            'nickname.between'=>'请输入5-18位用户名!!',
            'password.required'=>'请输入密码!',
            'password.between'=>'请输入5-18位密码!!',
            'captcha.required'=>'请输入验证码!',
            'captcha.between'=>'请输入4位验证码!!',
        ];
        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        //逻辑判断
        $user = User::where('nickname',$input['nickname'])->first();
        if(!$user){
            return back()->with('errors','警告:无此管理员!!!');
        }

        if(Crypt::decrypt($user->password) != $input['password']){
            return back()->with('errors','警告:密码错误!!!');
        }
        if(session('code') != $input['captcha']){
            return back()->with('errors','警告:验证码错误!!!');
        }
        //写入session做登录标志
        session(['user'=>$user]);
        //跳转后台首页
        return redirect('admin/index');


    }
    //密码
//    public function crypt()
//    {
//    }

}
