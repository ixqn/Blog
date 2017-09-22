<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;
use App\Http\Model\Comment;

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
        // 文章评论数.
        $article['comm'] = Comment::where('article_id',$id)->count();

        // 评论啊.
        $comment = Article::find($article['article_id'])->Comment;
        foreach($comment as $k => $v){
            $comment[$k]['user'] = Comment::find($v['comm_id'])->userInfo;
        }
        // 输出页面.
        $title = '《'.$article['article_name'].'》';
        return view('home.article.index', compact('title', 'article', 'comment'));
    }
}
