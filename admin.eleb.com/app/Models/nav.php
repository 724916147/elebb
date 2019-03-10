<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nav extends Model
{
    //
    public function permission(){
      return  $this->belongsTo(Permission::class,'permission_id','id');
    }
    protected  $fillable=['name','url','permission_id','pid'];
}
