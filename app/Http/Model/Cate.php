<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'article_category';

    public $primaryKey = 'cate_id';

    public $guarded = [];

    public $timestamps = false;


    //获取所有的分类数据,然后格式化
    public function tree()
    {
        //获取所有的分类数据
        $cate = $this->orderBy('cate_order','asc')->get();

        //自定义一个格式化数据的方法,返回排好序而且有缩进的数据
        return $this->getTree($cate);
    }

//    排好序
    public function getTree($cate)
    {
        //定义一个空数组,接受格式化后的数据
        $arr = array();
        //先找到一级类,然后找到对应一级类下二级类
        foreach ($cate as $k=>$v)
        {
            //判断一级类 pid= 0
            if($v['cate_pid'] == 0){
                //将当前遍历的这条一级类放入返回的数组中
                $cate[$k]['cate_names'] = '|----'.$cate[$k]['cate_name'];
                $arr[] = $cate[$k];
                //当前一级类下的二级类
                foreach($cate as $m=>$n)
                {
//                如果当前一级类的id等于 这次正在遍历的二级类的pid,说明这个二级类是当前类的二级类,将这个二级类
                    if($v['cate_id'] == $n['cate_pid']){
                        $cate[$m]['cate_names'] = '|------'.$cate[$m]['cate_name'];
                        $arr[] = $cate[$m];

                    }

                }

            }

        }
        return $arr;
    }

}
