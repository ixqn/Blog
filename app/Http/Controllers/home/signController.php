<?php

namespace App\Http\Controllers\home;

use App\Model\Users_login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;

class signController extends Controller
{
    // 登录页面
    public function signIn()
    {
        return view('home.sign.sign_in');
    }

    // 注册页面
    public function signUp()
    {
        return view('home.sign.sign_up');
    }

   // 登出
    public function signOut(Request $request)
    {
        //销毁session
        $request->session()->flush();
        // 返回首页
        return redirect('/');
    }

    // 通过手机重置密码页面
    public function mobile_reset()
    {
        return view('home.sign.mobile_reset');
    }
    
    // 通过邮箱找回密码页面
    public function email_reset()
    {
        return view('home.sign.email_reset');
    }


    // 处理登录
    public function doSignIn(Request $request)
    {
        // echo 'doSignIn';
        // 获取需要的数据
        $input = $request->only(['tel','password','code']);
        // dd($input);

        // 设置验证规则
        $rule = [
            'tel' => 'required|digits:11',
            'password' =>'required',
            // 'password' =>'required|alpha_dash',
            'code' => 'required',

        ];

        // 错误提示信息
        $msg = [
            'tel.required' => '手机号不能为空',
            'tel.digits' => '手机号为11位数字',
            'password.required' => '密码不能为空',
            // 'password.alpha_dash' => '密码含字母、数字、破折号以及下划线',
            'code.required' => '请输入验证码',
        ];

        // 验证规则
        $this->validate($request, $rule, $msg);

        // 验证码对比
        if(session('code') != $input['code']) {
            return back()->with('errors','验证码错误')
                         ->withInput();
        }
        
    }

    // 处理注册
    public function doSignUp(Request $request)
    {
        // echo 'doSignUp';
        // 获取需要的数据
        $input = $request->only(['tel','password','password_r','code']);
        // dd($input);
        // 设置验证规则
        $rule = [
           'tel' => 'required|digits:11',
           'password' =>'required|alpha_dash',
           'password_r' =>'same:password',
           'code' => 'required',
        ];

        // 错误提示信息
        $msg = [
            'tel.required' => '手机号不能为空',
            'tel.digits' => '手机号为11位数字',
            'password.required' => '密码不能为空',
            'password.alpha_dash' => '密码含字母、数字、破折号以及下划线',
            'password_r.same' => '两次密码不一致',
            'code.required' => '请输入验证码',
        ];
        // 验证规则
        $this->validate($request, $rule, $msg);
        // 对比验证码
        if(session('code') != $input['code']) {
            return back()->with('errors','验证码错误')
                         ->withInput();
        }
        // dd($input);
        $res = Users_login::find($input['tel']);
        // dd($res);
        $user = [
            'tel' => $input['tel'],
            'password' => $input['password'],
            'last_login' => time(),
            'reg_time' => time(),
        ];

        $res = Users_login::create($user);
        if($res){
            return redirect('/');
        }else{
            return back()->with('errors','添加失败');
        }

    }




}
