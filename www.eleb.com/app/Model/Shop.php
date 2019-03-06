<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    public function menu(){
        return  $this->belongsTo(Menu::class,'shop_id','id');
    }
}
