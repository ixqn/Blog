<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfController extends Controller
{
    //

    //举报文章页
    public function index()
    {
        $datas = \DB::table('inf_tables')->join('article_users', 'inf_tables.article_id', '=', 'article_users.article_id')->orderBy('id','desc')->paginate(10);


//

        return view('admin.inform.infarticle',['title'=>'举报文章','datas'=>$datas]);

    }


    //举报文章处理
    public function dis($id)
    {
        $data = \DB::table('inf_tables')
                ->where('id', $id)
                ->update(['status' => 1]);


    }









    //举报评论页
    public function show()
    {
        $datas = \DB::table('inf_comment')->join('article_users_comment','inf_comment.comm_id','=','article_users_comment.comm_id')->orderBy('id','desc')->paginate(10);


        return view('admin.inform.infcomment',['title'=>'举报评论','datas'=>$datas]);

    }

    //举报评论处理
    public function discom($id)
    {
        $data = \DB::table('inf_comment')->where('id',$id)->update(['status'=> 1 ]);

    }

}
