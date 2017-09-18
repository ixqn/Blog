<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    //改变分类排序字段的操作
    public function changeOrder()
    {

        $input = Input::except('_token');
//        input['cate_id'] 要修改的那条记录的id input['cate_order'] 要修改成的排序值
        $cate = Cate::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->save();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '修改成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '修改失败'
            ];
        }
        return $data;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $cates = (new Cate)->tree();
        return view('admin.category.index',['title'=>'分类列表'],compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类添加
        $cates = (new Cate)->tree();
//        $cates = $this->getCate();


        return view('admin.category.add',['title'=> '分类添加'],compact('cates'));

    }

    public function getCate()
    {
        $cates = Cate::get();
        return $cates;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证.
        $this->validate($request, [
            'cate_name' => 'required|max:8',
            'cate_title' => 'required',
            'cate_keywords' => 'required',
            'cate_description' => 'required',
            'cate_pic' => 'image',
            'cate_order' => 'required',
        ], [
            'cate_name.required' => '分类名不能为空.',
            'cate_name.max' => '分类名不能大于8位.',
            'cate_title.required' => '标题不能为空',
            'cate_keywords.required' => '关键词不能为空.',
            'cate_description.required' => '描述不能为空',
            'cate_pic.image' => '请上传正确的图片.',
            'cate_order.required' => '排序不能为空.',
        ]);


        $input = $request->except('_token');
        // 上传图片.
        if($request -> hasfile('cate_pic')){
            if($request->file('cate_pic') -> isValid()){
                // 移动文件.
                $ext = $request -> file('cate_pic') -> getClientOriginalExtension();
                // 文件名称.
                $filename = time().mt_rand(1000000, 9999999).'.'.$ext;
                // 移动.
                $request -> file('cate_pic') -> move('./uploads', $filename);
                // 修改 pic 数据.
                $input['cate_pic'] = $filename;
            }
        }


//        dd($input);
        //create 是模型的一种保存到数据库的方法,返回是一条数据
        $cate = Cate::create($input);
        if($cate){
            return redirect('admin/category');
        }else{
            return back()->with('error','添加失败');
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
        //把分类列表放入data中传过去
        $data = (new Cate)->tree();

        $cates = Cate::find($id);
//        $cates = (new Cate)->tree();
        return view('admin.category.edit',['title'=>'分类编辑','data'=>$data],compact('cates'));
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
        //更新
        $input = $request->except('_method','_token');
//        dd($input);
       $cate =  Cate::find($id);
//       dd($cate);
       $cate->cate_name = $input['cate_name'];
       $cate->cate_title = $input['cate_title'];
       $cate->cate_keywords = $input['cate_keywords'];
       $cate->cate_description = $input['cate_description'];
       $cate->cate_order = $input['cate_order'];

        if($request -> hasfile('cate_pic')){
            if($request->file('cate_pic') -> isValid()){
                // 移动文件.
                $ext = $request -> file('cate_pic') -> getClientOriginalExtension();
                // 文件名称.
                $filename = time().mt_rand(1000000, 9999999).'.'.$ext;
                // 移动.
                $request -> file('cate_pic') -> move('./uploads', $filename);
                // 修改 pic 数据.
                $cate->cate_pic = $input['cate_pic'] = $filename;
            }
        }

       $re = $cate->save();
//        dd($input);
//        如果修改成功
        if($re){
//            跳转到列表页
            return redirect('admin/category');
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
        //分类删除
        //找到要删除的那条数据
        $cate  =  Cate::find($id);


        $re = $cate->delete();
//        删除


            if($re){
                $data = [
                    'state'=>0,
                    'msg'=>'删除成功'
                ];
            }else{
                $data = [
                    'state'=>1,
                    'msg'=>'删除失败'
                ];
            }
//        return json_encode($data);
            return $data;



    }
}
