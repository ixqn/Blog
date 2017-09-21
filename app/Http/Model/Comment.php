<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const CREATED_AT = 'comm_at';
    const UPDATED_AT = 'comm_dl';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'article_users_comment';

    /**
     * 主键
     *
     * @var string
     */
    public $primaryKey = 'comm_id';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['user_id', 'parent_id', 'article_id', 'comm_cont'];

    // 关联用户信息表.
    public function userInfo()
    {
        return $this->belongsTo('App\Http\Model\Users_info', 'user_id', 'user_id');
    }

}
