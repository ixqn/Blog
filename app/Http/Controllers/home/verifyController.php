<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use App\Model\Users_login;

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


    // 判断手机号是否已经注册过
    public function is_telReg(Request $request)
    {

        $tel = $request->input('tel');
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


        $email = Users_login::where(['email'=>$email, 'emailActive'=>'1'])->get();
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



}
