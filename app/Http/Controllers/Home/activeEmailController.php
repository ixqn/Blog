<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Model\Users_login;
use App\Http\Model\Users_info;
use App\Http\Controllers\Home\sendMailController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


class activeEmailController extends Controller
{
    
    // 激活邮箱地址
    public function activeEmail()
    {


        $active_email_user_id = 'active_email_user_id_';

        $user_id = session('user')['user_id'];
        // $user_id = 16;
        $user = Users_info::where('user_id', $user_id) ->first();
        // dd($user->email);
        // dd($user->email);
        

        $key = $active_email_user_id.$user->user_id;
        $flag = Redis::exists($key);
        if($flag){
            $status = false; 
            $msg =  "一小时只能发送一封邮件";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }
        

        $email = $user->email;
        if($email){
            // 保存redis
            // 保存key为user_id的记录
            $key = $active_email_user_id.$user->user_id;
            $this->saveRedis($key); // 记录此用户已经发送过邮件
            // 
            // 
            // 保存 key为email地址 的记录 
            // key:xqn@xqn.me 
            // value:$2y$10$JPgjFC/gvGbS13ooNllS1.ymnP0JjOk6.pzU9vak768ohVu6XRGeu
            $value = $this->saveRedis($email);
            $url = config('app.url').'/active_email/'.$email.'/'.$value;
            // http://www.blog.com/password/xqn@xqn.me/$2y$10$JPgjFC/gvGbS13ooNllS1.ymnP0JjOk6.pzU9vak768ohVu6XRGeu
            $setSubject = '竹文安全中心-邮箱验证';
            $setHtmlBody = '您好,你在验证此邮箱,<a href='.$url.'>请点击这里</a>,进行下一步操作,链接有效时间一小时<br>
                            点击无反应,请将以下链接地址复制到浏览器打开<br>'.$url.'<br>如不是本人操作,请忽略本邮件';

            $sendMailObj = new sendMailController();
            $sendMailObj->sendMail($email, $setSubject, $setHtmlBody);;

            $status = true; 
            $msg =  "发送激活邮件成功";

        } else {
            // 数据库中邮箱地址不存在的时候
            $status = false; 
            $msg =  "输入邮箱地址后,请先保存";
        }

        return response()->json(['status'=>$status,'msg'=>$msg]);



    }


    public function saveRedis($key)
    {
        $value = Hash::make($key);
        $value = str_replace('/', '', $value); // 为了路由正确替换掉斜杠
        Redis::setex($key, '3600', $value); // 3600秒(1小时)有效
        return $value;
    }




    public function doActiveEmail(Request $request, $key, $value)
    {
       
       // dd(Redis::exists($key));
       // 判断是否存在$key
        if(!Redis::exists($key)){
            // 不存在,返回错误页面
            return view('home.sign.msgResetPasswordResult')->with('errors','链接已经失效,请重新操作');
        }
        // 判断对应的value是否相等
        if(Redis::get($key) != $value){
            // 不相等,返回错误页面
            return view('home.sign.msgResetPasswordResult')->with('errors','链接有误');
        }





        // 修改密码
        $user = Users_info::where('email','=',$key)->first()->userLogin;
        $user->password = Hash::make($input['password']);
        // dd($user->password);
        $flag = $user->save(); // 保存修改
        // dd($user->password);
        
        if($flag){
            Redis::del($key); // 删除对应的键值对
            return view('home.sign.msgResetPasswordResult')->with('errors','修改成功,去首页登录看看吧');
        } else {
            return view('home.sign.msgResetPasswordResult')->with('errors','修改失败,请重新操作');
        }
        




        // 返回重置密码页面
        return view('home.sign.resetPasswordByEmail', compact('key','value'));
    }


}
