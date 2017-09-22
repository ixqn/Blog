<?php

namespace App\Http\Controllers\Home;

use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttentionController extends Controller
{
//insert插入到数据库
        public function insert($user_id)
        {
            //提取要关注作者的数据
            $data = \DB::table('users_info')->where('user_id', $user_id)->first();

            $users_id = $data->user_id;
            $nickname = $data->nickname;
            $sex = $data->sex;
            $birthday = $data->birthday;
            $email = $data->email;
            $pic = $data->pic;

            $dat['user_id'] = 1;
            $dat['attension_user_id'] = $users_id;
            $dat['nickname'] = $nickname;
            $dat['birthday'] = $birthday;
            $dat['email'] = $email;
            $dat['pic'] = $pic;

            //添加关注
            $str = \DB::table('users_attention')->where('attension_user_id', $dat['attension_user_id'])->first();
            if ($str) {
                $data = [
                    'state' => 2,
                    'msg' => '你应经关注过这个人了'
                ];
            } else {
                $res = \DB::table('users_attention')->insert($dat);
                if ($res) {
                    $data = [
                        'state' => 0,
                        'msg' => '添加关注成功'
                    ];
                } else {
                    $data = [
                        'state' => 1,
                        'msg' => '添加关注失败'
                    ];
                }
                return $data;
            }
        }


        //显示我的关注的人的文章
        public function attention()
        {
            $data = \DB::table('users_attention')->where('user_id' , 1)->get();

            $wz = \DB::table('article_users')->get();
            return view('home.attention' , ['data'=>$data , 'wz'=>$wz  , 'title'=>'关注文章']);
        }



         //取消关注
          public function delete($attension_user_id)
          {

            $res = \DB::table('users_attention')->where('attension_user_id' , $attension_user_id)->delete();
            if($res){
                $data = [
                    'state'=>0,
                    'msg'=>'取消关注成功'
                ];
            }else{
                $data = [
                    'state'=>1,
                    'msg'=>'取消关注失败 '
                ];
            }
            return $data;
          }


}



