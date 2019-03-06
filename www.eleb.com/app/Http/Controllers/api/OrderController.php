<?php

namespace App\Http\Controllers\api;

use App\Model\Addresse;
use App\Model\Cart;
use App\Model\Menu;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function addOrder(Request $request)
    {
            $addres = Addresse::find($request->address_id);
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            $shop = Menu::find($cart->goods_id);
            $goods_list = DB::table('carts')->leftjoin('menus', 'carts.goods_id', '=', 'menus.id')
                ->select('carts.goods_id', 'menus.goods_name', 'menus.goods_img', 'carts.amount', 'menus.goods_price')
                ->where('carts.user_id',Auth::user()->id)
                ->get();
            $money = 0;
            foreach ($goods_list as $goods) {
                $money += $goods->goods_price * $goods->amount;
            }
            $data = [
                'user_id' => Auth::user()->id,
                'shop_id' => $shop->shop_id,
                'sn' => uniqid(),
                'province' => $addres->provence,
                'city' => $addres->city,
                'area' => $addres->area,
                'address' => $addres->detail_address,
                'tel' => $addres->tel,
                'name' => $addres->name,
                'total' => $money,
                'status' => 0,
                'out_trade_no' => uniqid(),

            ];
        DB::beginTransaction();
        try {
            $order = Order::create($data);
            foreach ($goods_list as $goods) {
                $data1 = [
                    'order_id' => $order->id,
                    'goods_id' => $goods->goods_id,
                    'amount' => $goods->amount,
                    'goods_name' => $goods->goods_name,
                    'goods_img' => $goods->goods_img,
                    'goods_price' => $goods->goods_price,
                ];
                OrderDetail::create($data1);
                DB::table('carts')->where('user_id',Auth::user()->id)->delete();
            }
            DB::commit();
            return ['status' => 'true', 'message' => '添加成功', 'order_id' => $order->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'false', 'message' => '添加失败'];
        }
    }

    public function orderList(){

       $orders= Order::where('user_id',Auth::user()->id)->get()->toArray();
        $orderss=[];
        $ordersss=[];
       foreach ($orders as $order){

           $shop=Shop::find($order['shop_id']);
           $orderss['id']=$order['id'];
           $orderss['shop_name']=$shop->shop_name;
           $orderss['order_code']=$order['sn'];
           $orderss['order_birth_time']=$order['created_at'];
           if($order['status']==0) $orderss['order_status']='待支付';//-1:已取消,0:待支付,1:待发货,2:待确认,3:完成
           if($order['status']==1) $orderss['order_status']='待发货';
           if($order['status']==2) $orderss['order_status']='待确认';
           if($order['status']==3) $orderss['order_status']='完成';
           if($order['status']==-1) $orderss['order_status']='已取消';
           $orderss['shop_id']=$order['shop_id'];
           $orderss['shop_img']=$shop->shop_img;
           $orderss['order_price']=$order['total'];
           $orderss['order_address']=$order['address'];
           $orderss['goods_list'] = OrderDetail::where('order_id',$order['id'])->get();
           $ordersss[]=$orderss;
       }
       return $ordersss;
    }
    public function order(Request $request){
        $order=Order::find($request->id)->toArray();
        $shop=Shop::find($order['shop_id']);
        $orders=[];
        $OrderDetail=OrderDetail::where('order_id',$order['id'])->get();
        $orders['order_code']=$order['sn'];
        $orders['order_birth_time']=$order['created_at'];
        if($order['status']==0) $orders['order_status']='待支付';//-1:已取消,0:待支付,1:待发货,2:待确认,3:完成
        if($order['status']==1) $orders['order_status']='待发货';
        if($order['status']==2) $orders['order_status']='待确认';
        if($order['status']==3) $orders['order_status']='完成';
        if($order['status']==-1) $orders['order_status']='已取消';
        $orders['shop_id']=$shop->id;
        $orders['shop_name']=$shop->shop_name;
        $orders['shop_img']=$shop->shop_img;
        $orders['order_address']=$order['address'];
        $orders['order_price']=$order['total'];
        foreach ($OrderDetail as $aa){
            $orders['goods_list'][]=$aa;
        }
            return $orders;
    }
}


