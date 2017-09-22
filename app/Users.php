<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users_info';
    public $primaryKey = 'user_id';
    protected $fillable = [
        'nickname','sex','picture','birthday','email','update_time','reg_time',
    ];
    protected $hidden = [
      'remember_token',
    ];
    public $timestamps = false;

}
