<?php

namespace App\Http\Controllers\home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Model\Users_login;

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
        
        // 判断是否已存在
        $user = Users_login::where('tel', $input['tel'])->get()->toArray();
        if(!$user){
            // 如果用户不存在,则返回
            return back()->with('errors','用户不存在');
        } 


        $user = $user[0];
        // 验证登录密码是否正确
        if(!Hash::check($input['password'], $user['password'])) {
            return back()->with('errors','密码有误');
        }
        // 登录成功

        switch ($user['status']) {
            case '0':
                # code...
                break;
            case '1':
                return back()->with('errors','此账号限制登录');
                break;
            case '2':
                return back()->with('errors','此账号已被封');
                break;
        }
        // 将用户登录信息保存
        session(['user' => $user]);
        return redirect('/');
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
        // 判断是否已存在,如果是存在的用户则返回
        $user = Users_login::where('tel', $input['tel'])->get();
        if($user){
           return back()->with('errors','添加失败');
        }
        // dd($res);

        // 构建需要的数据
        $data = [
            'tel' => $input['tel'],
            'password' => Hash::make($input['password']),
            'last_login' => time(),
        ];

        $res = Users_login::create($data);
        if($res){
            return redirect('/'); // 注册成功返回首页
        }else{
            return back()->with('errors','添加失败'); // 注册失败返回提示信息
        }

    }



    // signController的测试函数
    public function test()
    {

       // echo session('user')['user_id'];

    }




}
