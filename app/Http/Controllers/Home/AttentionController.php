<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttentionController extends Controller
{
//insert插入到数据库
        public function insert(Request $request,$user_id)
        {
            //提取要关注作者的数据
            $data = \DB::table('users_info')->where('user_id', $user_id)->first();

            $id = $data->id;
            $users_id = $data->user_id;
            $nickname = $data->nickname;
            $sex = $data->sex;
            $birthday = $data->birthday;
            $email = $data->email;


            $dat['user_id'] = 1;
            $dat['attension_user_id'] = $users_id;
            $dat['nickname'] = $nickname;
            $dat['birthday'] = $birthday;
            $dat['email'] = $email;

//            dd($dat);
            //        将提取出来的额数据插入数据

            //判断是否重复关注
            $str = \DB::table('users_attention')->where('attension_user_id', $dat['attension_user_id'])->first();
            if ($str) {
                die('这个作者你已经关注过了，快去我的关注页面查看把');
            } else {

            $res = \DB::table('users_attention')->insert($dat);

            if ($res) {
                return redirect('/home/attention')->with(['info' => '添加关注成功']);
            } else {
                return back()->with(['info' => '添加关注失败']);
            }
        }
        }

//attention 显示我的关注在页面上
        public function attention(Request $request)
        {
              $data = \DB::table('users_attention')->where('user_id' , 1)->get();

//              $db['user_id'] = $data->attension_user_id;
//              dd($db);
            foreach($data as $k=>$v)
            {

              $db[$k] =  ($v->attension_user_id);

            }
//            foreach($db as $k=>$v)
//            {
//                dd($v->attension_user_id);
//
//            }

            $wz = \DB::table('article_users')->where('user_id' ,  1)->get();


//            dd($db);


              return view('home.attention' , ['data'=>$data , 'wz'=>$wz]);
        }



        public function delete($id)
        {
            $res = \DB::table('users_attention')->where('attension_user_id' , $id)->delete();
    //        dd($res);

            if($res)
            {
                return redirect('/home/attention')->with(['info'=>'删除成功']);
            }else
            {
                return back()->with(['info' => '删除失败']);
            }
        }
}
