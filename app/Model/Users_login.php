<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users_login extends Model
{
    //
    protected $table = 'users_login';
    public $primaryKey = 'tel';
    public $timestamps = false;
    protected $fillable = ['tel', 'password', 'last_login', 'reg_time'];
}
