<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_info extends Model
{
    protected $table = 'users_info';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = ['user_id', 'tel', 'nickname', 'sex', 'birthday', 'email', 'email_active', 'pic', 'desc'];

    // 关联用户登录表.
    public function userLogin()
    {
        return $this->belongsTo('App\Http\Model\Users_login', 'user_id', 'user_id');
    }

}
