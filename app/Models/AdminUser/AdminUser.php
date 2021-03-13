<?php

namespace App\Models\AdminUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;


class AdminUser extends Auth
{
    protected $gaurded='admin';
    protected $fillable=['name','username','email','password','image','status','admin_type'];
}
