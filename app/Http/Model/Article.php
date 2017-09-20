<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const CREATED_AT = 'article_at';
    const UPDATED_AT = 'article_up';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'article_users';

    /**
     * 主键
     *
     * @var string
     */
    public $primaryKey = 'article_id';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['category_id', 'user_id', 'article_author', 'article_name', 'article_cont' ,'article_status', 'article_open', 'article_at', 'article_up', 'article_view'];

    // 关联分类表.
    public function Cate()
    {
        return $this->belongsTo('App\Http\Model\Cate', 'category_id', 'cate_id');
    }

    // 关联用户信息表.
    public function userInfo()
    {
        return $this->belongsTo('App\Http\Model\Users_info', 'user_id', 'user_id');
    }

}
