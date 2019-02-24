<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    //
    protected $fillable=['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao'
        ,'bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    public function ShopCategory(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'id','shop_id');
    }
    public function image()
    {
        return $this->img?$this->img:'/image/hend.jpg';
        }
}