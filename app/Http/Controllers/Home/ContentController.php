<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;


class ContentController extends Controller
{
    public function content(Request $request,$article_id)
    {

        $data = \DB::table('article_users')->where('article_id' , $article_id)->get();
//          dd($data);

        return view('home.content', ['data' => $data]);

    }



}
