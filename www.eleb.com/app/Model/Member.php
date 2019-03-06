<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Member extends \Illuminate\Foundation\Auth\User
{
    //
    protected $fillable=['username','password','tel','remember_token'];
}
