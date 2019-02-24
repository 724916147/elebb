<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShopCategory extends Model
{

    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/hend.jpg';
    }
}