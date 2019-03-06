<?php

namespace App\Http\Controllers\api;

use App\Model\Menu;
use App\Model\MenuCategory;
use App\Model\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //
    public function index(Request $request){
        if($request->keyword){
            $shops=Shop::where('status',1)->where('shop_name','like',"%$request->keyword%")->get();
        } else {
            $shops=Shop::all()->where('status',1);
        }
        return $shops;
    }
    public function One(Request $request){
        $shop=Shop::find($request->id);
        $menu_cate=MenuCategory::where('shop_id',$request->id)->get();
        foreach ($menu_cate as $a){
           $menus=Menu::where('category_id',$a->id)->get();
           foreach ($menus as $menu){
               $menu['goods_id']=$menu->id;
           }
            $a['goods_list']=$menus;
        }
         $shop['commodity']=$menu_cate;

       return $shop;
    }

}
