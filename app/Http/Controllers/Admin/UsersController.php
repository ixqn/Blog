<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->input('keywords')?$request->input('keywords'):'';
        $users = Users::orderBy('user_id','asc')->where('nickname','like','%'.$input.'%')->paginate(5);
        return view('admin/users/details' ,compact('users','input'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加管理员

//        return view('admin/users/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Users::find($id);
        return view('admin/users/edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','_method');
        $rule = [
            'nickname' => 'required|min:5|max:18',
        ];
        $msg = [
            'nickname.required' => '请输入您的用户名',
            'nickname.min' => '用户名不能小于5位',
            'nickname.max' => '用户名不能大于18位',
        ];

        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/admin')
                ->withErrors($validator)
                ->withInput();
        }

        $users = Users::find($id);

        $users->nickname = $input['nickname'];
        $re = $users->save();
        if($re){
            return redirect('admin/users')->with('errors','修改成功');
        }else{
            return back()->with('errors','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

