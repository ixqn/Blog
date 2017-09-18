<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admin_admin';
    public $primaryKey = 'admin_id';
    protected $fillable = [
        'nickname', 'password','sex','picture','last_login_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;
}
