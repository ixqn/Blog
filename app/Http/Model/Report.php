<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    const CREATED_AT = 'report_at';
    const UPDATED_AT = 'report_up';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'inf_tables';

    /**
     * 主键
     *
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['article_id', 'inf_cause', 'inf_content'];

}
