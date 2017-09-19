<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_login extends Model
{
    // 用户登录表
    protected $table = 'users_login';
    public $primaryKey = 'user_id';
    protected $fillable = ['tel', 'password','status', 'last_login'];
}
