<?php

namespace App\Http\Controllers\home;

use App\Model\Users_login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
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

    // 单击返回更新的验证码图片
    public function code()
    {
        header('Content-type: image/jpeg');
        // 验证码
        $builder = new CaptchaBuilder();
        $builder->build();
        // 将随机数保持到session里
        session(['code' => $builder->getPhrase()]);
        return $builder->output($quality = 80);
    }

    public function getCode()
    {
        $builder = new CaptchaBuilder();
        $builder->build();
        // 将随机数保持到session里
        session(['code' => $builder->getPhrase()]);
    }

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


    // 登出
    public function signOut(Request $request)
    {
        //销毁session
        $request->session()->flush();
        // 返回首页
        return redirect('/');
    }


    // 发送短信
    public function sms()
    {

        // 生成验证码,保存在session里
        $this->getCode();

        header('Content-Type: text/plain; charset=utf-8');

        $demo = new smsController();

        // echo "smsController::sendSms\n";
        $response = $demo->sendSms(
            "15816346090", // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>session('code'),
            )
            // "123"
        );
        // print_r($response);

        // echo "smsController::queryDetails\n";
        // $response = $demo->queryDetails(
        //     "12345678901",  // phoneNumbers 电话号码
        //     "20170718", // sendDate 发送时间
        //     10, // pageSize 分页大小
        //     1 // currentPage 当前页码
        //     // "abcd" // bizId 短信发送流水号，选填
        // );

        var_dump($response);
        // echo $response->Code;
        // object(stdClass)#1425 (3) { ["Message"]=> string(30) "触发小时级流控Permits:5" ["RequestId"]=> string(36) "CF75772C-1F58-4CDE-8DA1-EE9718B21EB9" ["Code"]=> string(26) "isv.BUSINESS_LIMIT_CONTROL" }

    }

    public function mobile_reset()
    {
        return view('home.sign.mobile_reset');
    }
    public function email_reset()
    {
        return view('home.sign.email_reset');
    }
    // 判断手机号是否已经注册过
    public function existTel(Request $request)
    {
        // dd('sss');
        $tel = $request->input('tel');
        // dd($tel);


        $user = Users_login::where('tel', '11')->get();
        // $user = Users_login::where('tel', '12345678901')->first();
        dd($user);
        if($user)
        {
            echo '111';
        }else {
            echo '222';
        }
        // dd($user);
        // return response()->json([
        //     'existTel' => 'YS',
        //     'state' => 'CA'
        // ]);
    }


}
