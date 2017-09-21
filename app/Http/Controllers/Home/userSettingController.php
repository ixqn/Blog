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


        // $input = $request->only(['nickname', 'sex', 'birthday', 'email', 'desc']);
        $input = $request->only('nickname', 'sex', 'birthday', 'email', 'desc');
        

        // $flag = Users_info::where('user_id', 21)->update($input); // 成功返回 1, 失败返回 0        
        $flag = Users_info::where('user_id', session('user')['user_id'])->update($input);

        if($flag){
            // 更新session中用户的信息
            $user = Users_info::where('user_id', session('user')['user_id'])->get()->toArray();
            $user = $user[0];
            session(['user' => $user]);
            // 返回提示信息
            $status = true; 
            $msg =  "保存成功";
        } else {
            // 返回提示信息
            $status = false; 
            $msg =  "保存失败";
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);
    }


    // 测试的
    public function test(Request $request)
    {


        return view('home.sign.test');
        

    }
}
