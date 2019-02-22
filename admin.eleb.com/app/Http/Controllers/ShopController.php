<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index(){
        $shops=Shop::all();
        return view('shop.index',compact('shops'));
    }
    public function create(){
        return view('shop.add');
    }
}
