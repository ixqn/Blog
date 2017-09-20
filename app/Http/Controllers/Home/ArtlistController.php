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
        // 用户信息.
        $article['user'] = Article::find($article['article_id'])->userInfo;
        // 获取分类名称.
        $article['article_cate'] = Article::find($article['article_id'])->Cate['cate_name'];
        // 计算字数.
        $cont = strip_tags($article['article_cont']);
        $article['length'] = mb_strlen($cont,'utf-8');
        // 计算文章总数.
        $article['number'] = Article::where('user_id',$article['user_id'])->count();
        // 输出页面.
        $title = '《'.$article['article_name'].'》';
        return view('home.article.index', compact('title', 'article'));
    }
}
