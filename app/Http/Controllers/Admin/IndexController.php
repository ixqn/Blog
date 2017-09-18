<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('admin/index');
    }
    public function amend()
    {
        return view('admin/amend');
    }
    public function doAmend(Request $request)
    {
        //接受数据
        $input = $request->except('_token');
        //表单验证 被验证的数据  规则  错误提示

        $rule = [
            'password_o' => 'required|min:6|max:18',
            'password' => 'required|min:6|max:18',
            'password_c' => 'required|same:password',

        ];
        $msg = [
            'password_o.required' => '旧密码必须输入',
            'password_o.min' => '旧密码不能小于6位',
            'password_o.max' => '旧密码不能大于18位',
            'password.required' => '请输入您的新密码',
            'password.min' => '新密码不能小于6位',
            'password.max' => '新密码不能大于18位',
            'password_c.required' => '请在此输入你的确认密码',
            'password_c.same' => '确认密码必须跟新密码一致',

        ];


        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/amend')
                ->withErrors($validator)
                ->withInput();
        }
        //旧密码是否正确
        $admin = Admin::find(session('admin')->admin_id);
        //判断密码
        if($input['password_o'] != Crypt::decrypt($admin->password)){
            return back() -> with('errors','原密码错误');
        }
        //保存修改
        $admin->password = Crypt::encrypt($input['password_c']);
        $re = $admin->save();
        //修改成功跳转页面
        if($re){
            return back()->with('errors','修改成功');
        }else{
            return back()->with('errors','修改失败');
        }

    }
    public function logout()
    {
        session()->flush();
        return redirect('admin/login');
    }

}
