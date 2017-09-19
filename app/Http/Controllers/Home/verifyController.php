<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Model\Users_login;
use App\Http\Model\Users_info;

class verifyController extends Controller
{
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

    // 获取验证码字符
    public function getCode()
    {
        $builder = new CaptchaBuilder();
        $builder->build();
        // 将随机数保持到session里
        session(['code' => $builder->getPhrase()]);
    }



    // 判断手机号是否已经注册过
    public function is_telReg(Request $request)
    {

        // 获取手机号码
        $tel = $request->input('tel');
        // $tel = '15816346090';
        // 获取用户信息
        $user = Users_login::where('tel', $tel)->first();
        // dd($user);
        if($user)
        {
            $is_telReg = true; // 手机号已经注册过
        }else {
            $is_telReg = false;
        }
        // dd($user);
        return response()->json($is_telReg);

    }






    // 通过邮箱重置密码,判断邮箱是否已经激活
    public function is_emailActive(Request $request)
    {
        // dd('sss');
        $email = $request->input('email');
        // dd($tel);


        $email = Users_info::where(['email'=>$email, 'email_active'=>'1'])->first();
        // $user = Users_login::where('tel', '12345678901')->first();
        // dd($email);
        if(!$email)
        {
            $status = false; 
            $msg =  "此邮箱未激活或不存在";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        } else {
            $status = true; 
            $msg =  "此邮箱存在";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }

    }

    // 查询验证码是否正确
    public function is_codeRight(Request $request)
    {
        $code = $request->input('code');
        // echo $code;
        if(session('code') == $code)
        {
            $is_codeRight = true; // 手机号已经注册过
        }else {
            $is_codeRight = false;
        }
        // dd($user);
        return response()->json($is_codeRight);
    }


    // 注册 // 发送短信 注册
    public function sendRegCode(Request $request)
    {

        // 接收手机号码
        $tel = $request->input('tel');

        $times = 10; // 设置可以点击的最大次数
        $hits =  session('hits') ? session('hits') : 0; // 已经点击次数
        if( $times == $hits ){
            $status = false; // 超过次数
            $msg = "超过次数";
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }
        


        // 检查手机号码是否存在
        $user = Users_login::where('tel', $tel)->first();
        // dd($user);
        if($user)
        {
            $status = false; 
            $msg =  "手机号已存在";// 手机号已存在,不可注册
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }

        // echo $code;
        // 生成验证码,保存在session里
        $this->getCode();
        session(['tel'=>$tel]);

        header('Content-Type: text/plain; charset=utf-8');

        $demo = new smsController();

        // echo "smsController::sendSms\n";
        $response = $demo->sendRegCode(
            // "15816346090", // 短信接收者
            $tel, // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>session('code'),
            )
            // "123"
        );
        // print_r($response);
        
        // stdClass Object ( [Message] => OK [RequestId] => 4C89B901-C934-4546-B18E-C66A693C5747 [BizId] => 592703905555910724^0 [Code] => OK )
        $status = ($response->Code) ? true : false;
        if($status){
            $msg = "发送成功";
            session(['hits' => $hits+1]);
        } else {
            $msg = "发送失败";
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);

        // echo "smsController::queryDetails\n";
        // $response = $demo->queryDetails(
        //     "12345678901",  // phoneNumbers 电话号码
        //     "20170718", // sendDate 发送时间
        //     10, // pageSize 分页大小
        //     1 // currentPage 当前页码
        //     // "abcd" // bizId 短信发送流水号，选填
        // );

        // var_dump($response);
        // echo $response->Code;
        // object(stdClass)#1425 (3) { ["Message"]=> string(30) "触发小时级流控Permits:5" ["RequestId"]=> string(36) "CF75772C-1F58-4CDE-8DA1-EE9718B21EB9" ["Code"]=> string(26) "isv.BUSINESS_LIMIT_CONTROL" }
    }



    // 重置密码 // 发送短信
    public function sendResetPasswordCode(Request $request)
    {
        // 接收手机号码
        $tel = $request->input('tel');


        $times = 10; // 设置可以点击的最大次数
        $hits =  session('hits') ? session('hits') : 0; // 已经点击次数
        if( $times == $hits ){
            $status = false; // 超过次数
            $msg = "超过次数";
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }

        // 检查手机号码是否存在
        $user = Users_login::where('tel', $tel)->first();
        // dd($user);
        if(!$user)
        {
            $status = false; 
            $msg =  "手机号不存在";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }


        

        
        $this->getCode(); // 生成验证码,保存在session里
        session(['tel'=>$tel]); // 保存手机号

        header('Content-Type: text/plain; charset=utf-8');

        $demo = new smsController();

        $response = $demo->sendResetPasswordCode(
            $tel, // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>session('code'),
            )
            // "123"
        );

        $status = ($response->Code) ? true : false;
        if($status){
            $msg = "发送成功";
            session(['hits' => $hits+1]);
        } else {
            $msg = "发送失败";
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);

    }





    public function test()
    {
        

    }
}
