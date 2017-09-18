<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;

class ArtlistController extends Controller
{
    // 文章详细页.
    public function index()
    {
        // 输出页面.
        $title = '文章详情';
        return view('Home.article.index', compact('title'));
    }
}
