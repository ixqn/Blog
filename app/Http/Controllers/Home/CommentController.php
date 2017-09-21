<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Comment;

class CommentController extends Controller
{
    // 新建评论.
    public function new(Request $request, $id)
    {
        // 表单验证.
        $this->validate($request, [
            'comm_cont' => 'required|max:255',
        ], [
            'comm_cont.required' => '评论还是空的呢',
            'comm_cont.max' => '评论不能大于255个字符',
        ]);

        // 拼装添加数据.
        $comment = $request->all();
        $comment['user_id'] = session('user')['user_id'];
        $comment['article_id'] = $id;

        // 执行添加.
        $res = Comment::create($comment);

        // 拼装返回数据.
        $res['user'] = Comment::find($res['comm_id'])->userInfo;
        $res['floor'] = Comment::where('article_id',$id)->count();

        return json_encode($res);
    }
}
