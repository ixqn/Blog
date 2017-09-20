<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
require_once app_path()."/Org/code/Code.class.php";
use App\Http\Org\code\Code;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //登录
    public function login()
    {
        return view('admin/login');

//        $a = encrypt('111111');
//        echo $a;
    }
    //验证码
    public function captcha()
    {
        $code = new Code();
        return $code->make();
    }
    //逻辑处理
    public function doLogin(Request $request)
    {
        //接受数据
        $input = $request->except('_token');
        //表单验证 被验证的数据  规则  错误提示

       $rule = [
            'nickname' => 'required|min:5|max:18',
            'password' => 'required|min:6|max:18',
            'captcha' => 'required|min:4|max:4',

        ];
        $msg = [
            'nickname.required' => '请输入您的用户名',
            'nickname.min' => '用户名不能小于5位',
            'nickname.max' => '用户名不能大于18位',
            'password.required' => '请输入您的密码',
            'password.min' => '密码不能小于6位',
            'password.max' => '密码不能大于18位',
            'captcha.required' => '验证码不能为空',
            'captcha.min' => '请输入四位验证码',
        ];


        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        //逻辑验证
        $admin = Admin::where('nickname',$input['nickname'])->first();
        if(!$admin){
            return back() -> with('errors','无此管理员用户');
        }
        //判断密码
        if(Crypt::decrypt($admin->password) != $input['password']){
            return back() -> with('errors','密码错误');
        }
        //验证码
        if(session('code') != $input['captcha']){
            return back() -> with('errors','验证码错误');
        }
        //写入session
        session(['admin'=>$admin]);
        //跳转到首页
        return redirect('admin/index');
    }



}
