<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    //站内行信提示
    public function messages()
    {
        $data = \DB::table('messages')->where('user_id' , session('user')['user_id'])->get();

        return view('home.messages' , ['data'=>$data , 'title'=>'站内信']);

    }

}
