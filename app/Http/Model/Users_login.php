<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_login extends Model
{
    // 用户登录表
    protected $table = 'users_login';
    public $primaryKey = 'user_id';
    protected $fillable = ['tel', 'password','status', 'last_login'];

    // 关联用户信息表.
    public function userInfo()
    {
        return $this->hasOne('App\Http\Model\Users_info', 'user_id', 'user_id');
    }
}
