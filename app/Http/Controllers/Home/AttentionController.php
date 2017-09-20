<?php

namespace App\Http\Controllers\Home;

use App\Users;
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



            //添加关注
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
              $data = \DB::table('users_attention')->where('user_id' , 15)->get();

//                 $res = 16;
//                 $wz = \DB::table('article_users')->where('user_id' , $res)->get();




              return view('home.layout1' , ['data'=>$data , 'title'=>'关注用户']);
            }

 //取消关注
        public function delete($attension_user_id)
        {
            $res = \DB::table('users_attention')->where('attension_user_id' , $attension_user_id)->delete();
            if($res){
                $data = [
                    'msg'=>'取消关注成功'
                ];
            }else{
                $data = [
                    'msg'=>'取消关注失败 '
                ];
            }
            return $data;
        }
//   //显示我的关注的人的文章
       public function index()
       {
//           if($src)
//           {
//               $attension_user_id = $id;

//               $src = \DB::table('article_users')->where('user_id' , $attension_user_id)->get();
//           }else{
               $wz = \DB::table('article_users')->where('user_id' , 16)->get();
//               dd($wz);
//           }

//           dd($src);
//           return $src;
           return view('home.attention' , ['wz'=>$wz , 'title'=>'关注文章']);
       }



}



