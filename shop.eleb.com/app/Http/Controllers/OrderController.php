<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function orderList()
    {
        $orders = Order::where('shop_id', Auth::user()->shop_id)->get();

        return view('Order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order = Order::find($order->id);
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        return view('Order.show', compact('order', 'orderDetails'));
    }

    public function cancel(Order $order)
    {
        $order->update([
            'status' => -1,
        ]);
        return redirect()->route('order.list')->with('warning', '已取消');
    }


    public function count(Request $request)
    {
        $count = $request->count ?? 'day';
        if ($count == 'day') {
            $day = date("Y-m-d H:i:s", strtotime(-6 . " day"));
            $shop_id = Auth::user()->shop_id;
            $sql = "select date(created_at) as days,count(*) as aount  from orders where created_at>'{$day}' and shop_id='$shop_id' group by days ";
            $counts = DB::select($sql);
            for ($i = 6; $i >= 0; $i--) {
                $daa = date("Y-m-d", strtotime(-$i . " day"));
                $orders[$daa] = 0;
            }
            foreach ($counts as $b) {
                $orders[$b->days] = $b->aount;
            }
        }
        if ($count == 'month') {

            $day = date("Y-m-1 0:0:0", strtotime(-2 . " month"));
            $shop_id = Auth::user()->shop_id;
            $sql = "select date_format(created_at,'%Y-%m') as days,count(*) as aount  from orders where created_at>'{$day}' and shop_id='$shop_id' group by days ";

            $counts = DB::select($sql);
            for ($i = 2; $i >= 0; $i--) {
                $daa = date("Y-m", strtotime(-$i . " month"));
                $orders[$daa] = 0;
            }
            foreach ($counts as $b) {
                $orders[$b->days] = $b->aount;
            }
        }
        return view('count.count', compact('orders'));
    }

    public function goods(Request $request)
    {
        $app=[];
        $count = $request->goods ?? 'day';
        if ($count == 'day') {
            $day = date("Y-m-d 0:0:0", strtotime(-6 . " day"));
            $shop_id = Auth::user()->shop_id;
            $sql = "select a.goods_name,sum(a.amount) as amount ,date(b.created_at) as `time` from order_details a join orders b  on a.order_id=b.id
          where b.shop_id='{$shop_id}' and  b.created_at>'{$day}'group by date(b.created_at),a.goods_name";
            $orders = DB::select($sql);
            foreach ($orders as $order) {
                for ($i = 6; $i >= 0; $i--) {
                    $daa = date("Y-m-d", strtotime(-$i . " day"));
                    $app[$order->goods_name][$daa] = 0;
                }
            }
            foreach ($orders as $order) {
                $app[$order->goods_name][$order->time] = $order->amount;
            }

            for ($i = 6; $i >= 0; $i--) {
                $dd = date("Y-m-d", strtotime(-$i . " day"));
                $days[] = $dd;
            }
        }

        if ($count == 'month') {
            $day = date("Y-m-1 0:0:0", strtotime(-2 . " month"));
            $shop_id = Auth::user()->shop_id;
            $sql = "select a.goods_name,sum(a.amount) as amount ,date_format(b.created_at,'%Y-%m') as `time` from order_details a join orders b  on a.order_id=b.id
            where b.shop_id='{$shop_id}' and  b.created_at>'{$day}'group by date_format(b.created_at,'%Y-%m'),a.goods_name";
            $orders = DB::select($sql);
            foreach ($orders as $order) {
                for ($i = 2; $i >= 0; $i--) {
                    $daa = date("Y-m", strtotime(-$i . " month"));
                    $app[$order->goods_name][$daa] = 0;
                }
            }
           // dd($app);
            foreach ($orders as $order) {
                $app[$order->goods_name][$order->time] = $order->amount;
            }
            for($i = 2; $i >= 0; $i--) {
                $dd = date("Y-m", strtotime(-$i . " month"));
                $days[] = $dd;
            }

        }
            return view('count.goods', compact('app', 'days'));
    }
}
//    public function goods(Request $request){
//        $count= $request->goods?? 'day';
//        $goods=[];
//        if ($count == 'day') {
//
//            for ($i = 6; $i >= 0; $i--) {
//                $day = date("Y-m-d", strtotime(-$i . " day"));
//                //$order = OrderDetail::where('created_at', 'like', "$day%")->where('shop_id', Auth::user()->shop_id)->count();
//                $order = DB::table('orders')->leftjoin('order_details', 'orders.id', '=', 'order_details.order_id')
//                    ->where('orders.created_at', 'like', "$day%")
//                    ->where('orders.shop_id', Auth::user()->shop_id)
//                    ->select('order_details.goods_name', 'order_details.amount', 'orders.shop_id')
//                    ->get();
//
//                $days[]=$day;
//                foreach ($order as $or) {
//
//                    if (isset($goods[$or->goods_name][$day])) {
//                        $goods[$or->goods_name][$day] += $or->amount;
//                    } else {
//                        $goods[$or->goods_name][$day] = $or->amount;
//                    }
//                }
//            }
//        }
//        foreach ($goods as $good=>$k){
//            foreach ($days as $day){
//               if(!isset( $goods[$good][$day])) {
//                   $goods[$good][$day]=0;
//               }
//            }
//        }
//
//        if ($count == 'month') {
//
//            for ($i = 2; $i >= 0; $i--) {
//                $day = date("Y-m", strtotime(-$i . " month"));
//                //$order = OrderDetail::where('created_at', 'like', "$day%")->where('shop_id', Auth::user()->shop_id)->count();
//                $order = DB::table('orders')->leftjoin('order_details', 'orders.id', '=', 'order_details.order_id')
//                    ->where('orders.created_at', 'like', "$day%")
//                    ->where('orders.shop_id', Auth::user()->shop_id)
//                    ->select('order_details.goods_name', 'order_details.amount', 'orders.shop_id')
//                    ->get();
//
//                $days[]=$day;
//                foreach ($order as $or) {
//
//                    if (isset($goods[$or->goods_name][$day])) {
//                        $goods[$or->goods_name][$day] += $or->amount;
//                    } else {
//                        $goods[$or->goods_name][$day] = $or->amount;
//                    }
//                }
//            }
//        }
//        foreach ($goods as $good=>$k){
//            foreach ($days as $day){
//                if(!isset( $goods[$good][$day])) {
//                    $goods[$good][$day]=0;
//                }
//            }
//        }
//        //dd($days);
//       dd($goods) ;
//       return view('count.goods', compact('goods', 'days'));
//    }
//}
