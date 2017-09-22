<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->input('keywords')?$request->input('keywords'):'';
        $admin = Admin::orderBy('admin_id','asc')->where('nickname','like','%'.$input.'%')->paginate(5);
        return view('admin/admin/details',['title'=>'管理员列表'],compact('admin','input') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //添加管理员
            return view('admin/admin/create',['title'=>'添加管理员']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //表单验证
        $this->validate($request,[
            'nickname' => 'required|min:5|max:18',
            'password' => 'required|min:6|max:18',
            'Cm_password' => 'same:password',
            'picture' => 'image',
        ],[
            'nickname.required' => '用户名不能为空',
            'nickname.min' => '用户名不能小于5位',
            'nickname.max' => '用户名不能大于18位',
            'password.required' => '密码不能为空',
            'Cm_password.same' => '两次密码必须一直',
            'picture.image' => '请上传一张图片',
        ]);
        //接收数据
        $data = $request->except('_token','Cm_password');
        //加密密码
        $data['password'] = encrypt($data['password']);
        //上传照片
        if($request->hasFile('picture'))
        {
            if($request->file('picture')->isValid())
            {
                //移动文件 随机文件名称 移动
                $ext = $request->file('picture')->getClientOriginalExtension();
                $filename = time().mt_rand(1000000,9999999).'.'.$ext;
                $request->file('picture')->move('admin/uploads',$filename);
                $data['picture'] = $filename;
            }
        }
        $time = date('Y-m-d H:i:s', time());
        $data['last_login_at'] = $time;

        $re = Admin::create($data);
        if($re){
            return redirect('admin/admin') -> with('errors','添加成功');
        }else{
            return back() -> with('errors','添加失败');
        }
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
        //
        $admin = Admin::find($id);

//        dd($admin);
        return view('admin/admin/edit',compact('admin'));

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

        $admin = Admin::find($id);

        $admin->nickname = $input['nickname'];
        $admin->status = $input['status'];


        $re = $admin->save();
        if($re){
            return redirect('admin/admin')->with('errors','修改成功');
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
        //
        $admin = Admin::find($id);
        $re = $admin->delete();
        if($re){
           $data = [
               'state'=>0,
               'msg'=>'删除成功'
           ];
        }else{
            $data = [
                'state'=>1,
                'msg'=>'删除失败 '
            ];
        }
        return $data;
    }
}

