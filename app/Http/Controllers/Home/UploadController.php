<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use App\Org\fileupload;

class UploadController extends Controller
{
    // 文件上传.
    public function upload(Request $request)
    {
        $d ='uploads/articles/'.date('Ymd');
        if (!is_dir($d))
        {
            mkdir($d); // 如果不存在则创建
        }

        $up = new FileUpload;
        //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)

        if($d){
            $up -> set("path", $d);
            $up -> set("maxsize", 1000000);
            $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
            $up -> set("israndname", true);
        }
        $f = $_FILES['file'];
        if($up -> upload("file")) {
            $info=$up->getFileName();
            $src=$d.'/'.$info;
            $res=array(
                'code' => 0,
                'msg' => '上传成功！',
                'data' => array(
                    'src'=>asset($src),
                    'title'=>$info
                )
            );
            echo json_encode($res);
            exit;
        } else {
            //获取上传失败以后的错误提示
            $info=$up->getErrorMsg();
            $res=array(
                'code' => 1,
                'msg' => $info,
                'data' => array(
                    'src'=>'',
                    'title'=>$info
                )
            );
            echo json_encode($res);
        }
    }
}
