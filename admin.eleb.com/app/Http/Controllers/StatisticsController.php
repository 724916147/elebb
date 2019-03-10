<?php

namespace App\Http\Controllers;

use App\Models\nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $navs=nav::all();
    }
    //
    public function order(Request $request)
    {
        $count = $request->count ?? 'day';
        if ($count == 'day') {
            $day = date("Y-m-d 0:0:0", strtotime("-6 day"));
            $sql = "select date(created_at) as `time`,count(*) as `count` from orders where created_at>'{$day}' group by date(created_at)";
            $orders = DB::select($sql);
            for ($i = 6; $i >= 0; $i--) {
                $day = date("Y-m-d", strtotime(-$i . "day"));
                $days[$day] = 0;
            }



            foreach ($orders as $order) {
                $days[$order->time] = $order->count;
            }
            return view('count.count', compact('days'));
        }
        if ($count == 'month') {
            $day = date("Y-m-d 0:0:0", strtotime("-6 day"));
            $sql = "select date(o.created_at) as `time`,count(*) as `count` ,s.shop_name as shop_name, s.id as id  from orders o join shops s  on o.shop_id=s.id where o.created_at>'{$day}' group by `time`,shop_name ,id  ";
            $orders = DB::select($sql);

            foreach ($orders as $order) {
                for ($i = 6; $i >= 0; $i--) {
                    $day = date("Y-m-d", strtotime(-$i . "day"));
                    $app[$order->id . $order->shop_name][$day] = 0;
                }
            }


            foreach ($orders as $order) {
                $app[$order->id . $order->shop_name][$order->time] = $order->count;
            }
            for ($i = 6; $i >= 0; $i--) {
                $dd = date("Y-m-d", strtotime(-$i . " day"));
                $days[] = $dd;
            }
            return view('count.goods', compact('days','app'));
        }
    }
}
