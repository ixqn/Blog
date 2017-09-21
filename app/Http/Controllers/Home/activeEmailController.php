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

        // 这个变量作为常量使用
        $active_email_user_id = 'active_email_user_id_';

        // 从session中获取user_id
        $user_id = session('user')['user_id'];

        // 从数据库获取用户资料
        $user = Users_info::where('user_id', $user_id) ->first();
        $user_id = $user->user_id;
        $email = $user->email;


        if(!$email){
            // 数据库中邮箱地址不存在的时候
            $status = false; 
            $msg =  "输入邮箱地址后,请先保存";
            return view('home.sign.msgActvieEmailResult')->with('errors',$msg);
        }

        // 判断此邮箱是否被其它手机号码激活过
        $flag = Users_info::where( 'email', $user->email )->where('email_active', '1')->get()->toArray();
        if($flag){
            // 此邮箱已被其它用户激活了
            $status = false; 
            $msg =  "此邮箱已被其它用户激活了";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        } 





        // 判断是否重复点击 激活按钮
        $key = $active_email_user_id.$user->user_id;
        $flag = Redis::exists($key);
        if($flag){
            $status = false; 
            $msg =  "一小时只能发送一封邮件";// 手机号不存在
            return response()->json(['status'=>$status,'msg'=>$msg]);
        }
        

        // 开始

        // 保存redis
        // 保存key为user_id的记录
        $key = $active_email_user_id.$user_id;
        $this->saveRedis($key); // 记录此用户已经发送过邮件
        // 
        // 
        // 保存 key为email地址 的记录 
        // key:xqn@xqn.me 
        // value:$2y$10$JPgjFC/gvGbS13ooNllS1.ymnP0JjOk6.pzU9vak768ohVu6XRGeu
        $rand = rand(1000,9999);
        $key = $user_id.'_'.$email.'_'.$rand; // 22_xqn@xqn.me_8989;
        $value = $this->saveRedis($key);
        $url = config('app.url').'/active_email/'.$user_id.'/'.$email.'/'.$rand.'/'.$value;
        // http://www.blog.com/password/xqn@xqn.me/$2y$10$JPgjFC/gvGbS13ooNllS1.ymnP0JjOk6.pzU9vak768ohVu6XRGeu
        $setSubject = '竹文安全中心-邮箱验证';
        $setHtmlBody = '您好,你在验证此邮箱,<a href='.$url.'>请点击这里</a>,进行下一步操作,链接有效时间一小时<br>
                        点击无反应,请将以下链接地址复制到浏览器打开<br>'.$url.'<br>如不是本人操作,请忽略本邮件';

        $sendMailObj = new sendMailController();
        $sendMailObj->sendMail($email, $setSubject, $setHtmlBody);;

        $status = true; 
        $msg =  "发送激活邮件成功";

        return response()->json(['status'=>$status,'msg'=>$msg]);



    }



    public function saveRedis($key)
    {
        $value = Hash::make($key);   // 使用加密方法生成字符串;
        $value = str_replace('/', '', $value); // 为了路由正确替换掉斜杠
        Redis::setex($key, '3600', $value); // 3600秒(1小时)有效
        return $value;
    }




    public function doActiveEmail(Request $request, $user_id, $email, $rand, $value)
    {
        // http://www.blog.com/active_email/22/xqn@xqn.me/8117/$2y$10$rSZ5Hi3.GUbw6QuVh1WJKOF7eZFzAejR3CM7SqwosC.GKsVgAOeTq
         // dd('wwww');
        $key = $user_id.'_'.$email.'_'.$rand; // 22_xqn@xqn.me_8989;
        // dd($key);
        // dd(Redis::exists($key));
        // 判断是否存在$key
        if(!Redis::exists($key)){
            // 不存在,返回错误页面
            return view('home.sign.msgActiveEmailResult')->with('errors','链接已经失效,请重新操作');
        }
        // 判断对应的value是否相等
        if(Redis::get($key) != $value){
            // 不相等,返回错误页面
            return view('home.sign.msgActiveEmailResult')->with('errors','链接有误');
        }

        // 找到对象
        $user = Users_info::where('user_id',$user_id)->first();
        $user->email_active = '1'; // 将邮箱设为激活状态;
        // dd($user->password);
        $flag = $user->save(); // 保存修改
        // dd($flag);
        
        if($flag){
            $msg = '邮箱激活成功';
            Redis::del($key); // 删除对应的键值对
        } else {
            $msg = '邮箱激活失败,请重新操作';
        }
        
        return view('home.sign.msgActiveEmailResult')->with('errors',$msg);
       
    }


    public function test()
    {
        $user_id = 22;
        $email = 'xqn@xqn.me';
        $rand = rand(1000,9999);
        $key = $user_id.'_'.$email.'_'.$rand; // 22_xqn@xqn.me_8989;
        $this->saveRedis($key);
        

    }

}
