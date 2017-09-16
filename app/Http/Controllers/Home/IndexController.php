<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // 显示主页
    public function index()
    {
        $title = '简单你的创作';
        return view('Home.index',compact('title'));
    }
}
