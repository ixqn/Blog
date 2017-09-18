<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users_info extends Model
{
    protected $table = 'users_info';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = ['user_id', 'nickname', 'sex', 'birthday', 'email', 'email_active', 'pic', 'desc'];

}
