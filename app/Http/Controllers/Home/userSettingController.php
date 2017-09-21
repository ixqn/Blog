<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Model\Users_login;
use App\Http\Model\Users_info;


class userSettingController extends Controller
{
    public function index()
    {
        // dd('1111');
        $user = session('user');
        // dd($user);
        return view('home.user.profile', compact('user'));
    }

    public function save(Request $request)
    {

        // $input = $request->input('nickname');
        // $input = $request->only(['nickname', 'sex', 'birthday', 'email', 'desc']);
        $input = $request->only('nickname', 'sex', 'birthday', 'email', 'desc');
        
        // dd($input);
        // $input = 'www';
        // dd($input);
        // $flag = Users_info::where('user_id', 21)->update($input); // 成功返回 1, 失败返回 0        
        $flag = Users_info::where('user_id', session('user')['user_id'])->update($input);

        if($flag){
            // 更新session中用户的信息
            $user = Users_info::where('user_id', session('user')['user_id'])->get()->toArray();
            $user = $user[0];
            session(['user' => $user]);
            $status = true; 
            $msg =  "保存成功";// 手机号不存在
        } else {
            $status = false; 
            $msg =  "保存失败";// 手机号不存在
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);
    }


    // 测试的
    public function test(Request $request)
    {


        return view('home.sign.test');
        

    }
}
