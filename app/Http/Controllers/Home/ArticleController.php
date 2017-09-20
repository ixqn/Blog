<?php
namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;
use App\Http\Model\Cate;
use App\Http\Model\Users_login;
class ArticleController extends Controller
{
    // 显示编辑器.
    public function writer()
    {
        // 获取分类数据.
        $cates = (new Cate)->tree();
        // 获取文章.
        $data = Article::orderby('article_at', 'desc')->paginate(5);


        foreach($data as $k => $v){
            // 计算字数.
            $cont = strip_tags($v['article_cont']);
            $data[$k]['length'] = mb_strlen($cont,'utf-8');
        }


        // 输出页面.
        $title = '写文章';
        return view('home.article.writer', compact('cates','title','data'));
    }
    // 执行保存.
    public function dowriter(Request $request)
    {
        // 表单验证.
        $this->validate($request, [
            'article_name' => 'required|min:1|max:100',
            'category_id' => 'required',
            'article_cont' => 'required',
        ], [
            'article_name.required' => '文章标题不能为空',
            'article_name.max' => '文章标题不能大于100字符',
            'category_id.required' => '分类不能为空',
            'article_cont.required' => '文章内容不能为空',
        ]);
        // 获取提交数据.
        $data = $request->all();
        $data['user_id'] = session('user')['user_id'];
        $data['article_author'] = Users_login::find($data['user_id'])->userInfo->nickname;
        // 执行添加.
        $res = Article::create($data);
        // 判断.
        if($res){
            $data = '0';
        } else {
            $data = '1';
        }
        return $data;
    }
    // 删除.
    public function delete($id)
    {
        $article  =  Article::find($id);
        $res = $article->delete();
        if($res){
            $data = [
                'state'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'state'=>1,
                'msg'=>'删除异常'
            ];
        }
        return $data;
    }
    // 编辑更新.
    public function doedit(Request $request, $id)
    {
        // 表单验证.
        $this->validate($request, [
            'article_name' => 'required|min:1|max:100',
            'article_cont' => 'required',
        ], [
            'article_name.required' => '文章标题不能为空',
            'article_name.max' => '文章标题不能大于100字符',
            'article_cont.required' => '内容不能为空',
        ]);
        // 获取提交数据.
        $data = $request->all();
        // 执行更改.
        $res = Article::where('article_id', $id) -> update($data);
        // 判断.
        if($res){
            $data = '0';
        } else {
            $data = '1';
        }
        return $data;
    }
    // 发布.
    public function print($id)
    {
        $find = Article::find($id);
        // 判断是否为公开.
        if($find ->article_open == 2 ){
            $data = [
                'state'=>4,
                'msg'=>'文章未公开,不能发布,请修改是否公开.'
            ];
        }else{
            if($find -> article_status == 1){
                $res = $find -> update(['article_status' => '2']);
                if($res){
                    $data = [
                        'state'=>0,
                        'msg'=>'发布成功,快去个人中心看看吧'
                    ];
                }else{
                    $data = [
                        'state'=>1,
                        'msg'=>'发布异常'
                    ];
                }
            }else{
                $data = [
                    'state'=>3,
                    'msg'=>'文章已经发布过了,快去个人中心看看吧'
                ];
            };
        }
        return $data;
    }
    // 取消发布.
    public function noprint($id)
    {
        $find = Article::find($id);
        if($find -> article_status == 2){
            $res = $find -> update(['article_status' => '1']);
            if($res){
                $data = [
                    'state'=>0,
                    'msg'=>'文章已经取消发布'
                ];
            }else{
                $data = [
                    'state'=>1,
                    'msg'=>'取消发布异常'
                ];
            }
        }else{
            $data = [
                'state'=>3,
                'msg'=>'文章还未发布呢,快去发布吧'
            ];
        };
        return $data;
    }
}