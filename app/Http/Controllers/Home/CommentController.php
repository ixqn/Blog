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
        $comment['comm_floor'] = Comment::where('article_id',$id)->max('comm_floor')+1;

        // 执行添加.
        $res = Comment::create($comment);

        // 拼装返回数据.
        $res['user'] = Comment::find($res['comm_id'])->userInfo;

        return json_encode($res);
    }

    // 回复评论.
    public function hf(Request $request, $id)
    {
        // 表单验证.
        $this->validate($request, [
            'comm_cont' => 'required|max:255',
        ], [
            'comm_cont.required' => '评论还是空的呢',
            'comm_cont.max' => '评论不能大于255个字符',
        ]);

        // 拼装数据.
        $hf = $request->all();
        $hf['parent_id'] = $id;
        $hf['user_id'] = session('user')['user_id'];
        $hf['article_id'] = Comment::find($id)->article_id;
        $hf['comm_floor'] = Comment::find($id)->comm_floor;

        // 执行添加.
        $re = Comment::create($hf);

        // 拼装返回数据.
        $re['user'] = Comment::find($re['comm_id'])->userInfo;

        return json_encode($re);
    }

    // 删除评论.
    public function dl($id)
    {
        $user_id = session('user')['user_id'];
        $me = Comment::find($id)->user_id;
        // 判断要删除文章是否是自己的.
        if($me == $user_id ){
            $sub = Comment::where('parent_id', $id)->get();
            // 判断是否有子评论.
            if(count($sub)){
                $arr = [];
                foreach($sub as $k => $v){
                    $arr[$k] = $v['comm_id'];
                }
                $res = Comment::destroy($arr);
                $re = Comment::find($id)->delete();
                if($res && $re){
                    $data = [
                        'state'=>1,
                        'msg'=>'删除成功'
                    ];
                } else {
                    $data = [
                        'state'=>2,
                        'msg'=>'删除失败'
                    ];
                }
            } else {
                $re1 = Comment::find($id)->delete();
                if($re1){
                    $data = [
                        'state'=>1,
                        'msg'=>'删除成功'
                    ];
                } else {
                    $data = [
                        'state'=>2,
                        'msg'=>'删除失败'
                    ];
                }
            }
        } else {
            $data = [
                'state'=>0,
                'msg'=>'不是你的评论,不能删除'
            ];
        }

        return $data;
    }
}
