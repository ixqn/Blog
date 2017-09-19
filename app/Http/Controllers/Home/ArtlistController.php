<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;

class ArtlistController extends Controller
{
    // 文章详细页.
    public function index($id)
    {
        $article = Article::find($id);
        // 计算阅读数量.
        $view = ['article_view'=>$article['article_view']+1];
        $article->update($view);
        // 获取分类名称.
        $article['article_cate'] = Article::find($article['article_id'])->Cate->cate_name;
        // 计算字数.
        $cont = strip_tags($article['article_cont']);
        $article['length'] = mb_strlen($cont,'utf-8');
        // 输出页面.
        $title = '《'.$article['article_name'].'》';
        return view('home.article.index', compact('title', 'article'));
    }
}
