<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public function EventPrize(){
        return $this->belongsTo(EventPrize::class,'id','events_id');
    }
}
