<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Users_login;
use App\Http\Model\Users_info;
use App\Http\Controllers\Home\sendMailController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis; 



class resetPasswordController extends Controller
{
    // 通过手机重置密码
    public function resetPasswordByTel(Request $request)
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

        // 判断是否是获取验证码的手机号
        if(session('tel') != $input['tel']){
            return back()->with('errors','不要攻击我');
        }


        // 构建需要的数据
        $data = [
            'password' => Hash::make($input['password']),
        ];

        // 更新密码
        $Users_login = Users_login::where('tel',$input['tel'])->update($data); // 成功后,会返回对象
        // dd($res->id);

        if($Users_login){
                return redirect('/'); // 重置密码成功返回首页
                
        } else {
            return back()->with('errors','重置密码失败'); // 重置密码失败返回提示信息
        }

    }




    // 通过邮箱找回密码
    public function resetPasswordByEmail(Request $request)
    {

        $input = $request->only(['email','code']);
        // dd($input);
        // 设置验证规则
        $rule = [
           'email' => 'required|email',
           'code' => 'required',
        ];

        // 错误提示信息
        $msg = [
            'email.required' => '请输入邮箱地址',
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
        // 判断邮箱地址是否存在
        $email = Users_info::where(['email'=>$input['email'], 'email_active'=>'1'])->first();

        if(!$email)
        {
            $msg =  "此邮箱未激活或不存在";
            return back()->with('errors','此邮箱未激活或不存在')
                         ->withInput();
        } 

        // 发送邮件
        
        // sendMailController::sendMail($setToAddress, $setSubject, $setHtmlBody)
        // 检验是否发送过
        $flag = Redis::exists($input['email']);
        if(!$flag){
            return back()->with('errors','已经发送过了,一小时有效,去邮箱查看吧')
                         ->withInput();
        }

        
        $value = $this->saveRedis($input['email']);

        $url = config('app.url').'/password/'.$input['email'].'/'.$value;
// http://www.blog.com/password/xqn@xqn.me/$2y$10$JPgjFC/gvGbS13ooNllS1.ymnP0JjOk6.pzU9vak768ohVu6XRGeu
        $setSubject = '竹文安全中心-重置用户密码密码';
        $setHtmlBody = '您好,你在执行重置密码操作,<a href='.$url.'>请点击这里</a>,进行下一步操作,链接有效时间一小时<br>
                        点击无反应,请将以下链接地址复制到浏览器打开<br>'.$url;

        $sendMailObj = new sendMailController();
        $sendMailObj->sendMail($input['email'], $setSubject, $setHtmlBody);;

        return back()->with('errors','发送成功,去邮箱查看吧')
                     ->withInput();

    }



    public function saveRedis($key)
    {
        $value = Hash::make($key);
        $value = str_replace('/', '', $value); // 为了路由正确替换掉斜杠
        Redis::setex($key, '3600', $value); // 3600秒(1小时)有效
        return $value;
    }




    public function doRestpasswordByEmailView(Request $request, $key, $value)
    {
       
       // dd(Redis::exists($key));
       // 判断是否存在$key
        if(!Redis::exists($key)){
            // 不存在,返回错误页面
            return view('home.sign.urlError')->with('errors','链接已经失效,请重新操作');
        }
        // 判断对应的value是否相等
        if(Redis::get($key) != $value){
            // 不相等,返回错误页面
            return view('home.sign.urlError')->with('errors','链接有误');
        }

        // 返回重置密码页面
        return view('home.sign.resetPasswordByEmail', compact('key','value'));
    }



    public function doRestpasswordByEmail(Request $request)
    {
       // 判断是否存在$key
        if(!Redis::exists($key)){
            // 不存在,返回错误页面
            return view('home.sign.noResetPassword')->with('errors','链接已经失效,请重新操作');
        }
        // 判断对应的value是否相等
        if(Redis::get($key) != $value){
            // 不相等,返回错误页面
            return view('home.sign.noResetPassword')->with('errors','链接有误');
        }

        $input = $request->only(['password','password_r']);
        // dd($input);
        // 设置验证规则
        $rule = [
           'password' =>'required|alpha_dash',
           'password_r' =>'same:password',
        ];

        // 错误提示信息
        $msg = [
            'password.required' => '密码不能为空',
            'password.alpha_dash' => '密码含字母、数字、破折号以及下划线',
            'password_r.same' => '两次密码不一致',
        ];
        // 验证规则
        $this->validate($request, $rule, $msg);

        $user = Users_info::where('email','=',$key)->first()->userLogin;
        $user->password = Hash::make($input['password']);
        // dd($user->password);
        $flag = $user->save();
        // dd($user->password);
        if($flag){
            return view('home.sign.okResetPassword')->with('errors','修改成功,去首页登录看看吧');
        } else {
            return view('home.sign.noResetPassword')->with('errors','链接已经失效,请重新操作');
        }
        

    }


    public function test()
    {

    }

}
