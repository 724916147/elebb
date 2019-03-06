<?php

namespace App\Http\Controllers\api;

use App\Model\Cart;
use App\Model\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //

    public function cart(){

       $goods_list= DB::table('carts')->leftjoin('menus','carts.goods_id','=','menus.id')
               ->select('carts.goods_id','menus.goods_name','menus.goods_img','carts.amount','menus.goods_price')
                ->where('carts.user_id',Auth::user()->id)
                ->get();
           $money=0;
           foreach ($goods_list as $goods){
               $money+=$goods->goods_price*$goods->amount;
           }
    return ['goods_list'=>$goods_list,'totalCost'=>$money];
    }
    public function addCart(Request $request){
        if (!$request->goodsList){
            return    ["status"=> "false",
                         "message"=> "请先选择商品"];
                 }
        for ($i=0;$i<count($request->goodsList);$i++){
            Cart::create([
                'user_id'=>Auth::user()->id,
                'goods_id'=>$request->goodsList[$i],
                'amount'=>$request->goodsCount[$i],
            ]);
        }
        return    ["status"=> "true",
                    "message"=> "添加成功"];
    }
}
