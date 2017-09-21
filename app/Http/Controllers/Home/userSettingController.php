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
        // dd($user['user_id']);
        $user_info = Users_info::where('user_id',$user['user_id'])->first();
        // dd($user_info->sex);
        // if($user_info->sex == 'x'){
        //     echo 'ddd';
        // }
        // die;
        // dd($info->email);
        return view('home.user.profile', compact('user_info'));
    }
}
