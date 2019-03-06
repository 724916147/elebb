@extends('layout/app')
@section('contents')
    {{--主体部分--}}
    <h1>订单详情</h1>
    <table class="table table-hover">
       <tr>
           <th>商品名称</th>
           <th>商品图片</th>
           <th>商品价格</th>
           <th>商品数量</th>
       </tr>
        @foreach($orderDetails as $orderDetail)
        <tr>
            <td>{{$orderDetail->goods_name}}</td>
            <td><img src="{{$orderDetail->goods_img}}" width="80"></td>
            <td>{{$orderDetail->goods_price}}</td>
            <td>{{$orderDetail->amount}}</td>
        </tr>
        @endforeach

    </table>
    <address>
        <strong>订单状态</strong><br>
        @if($order->status==-1)取消
        @elseif($order->status==0)待支付
        @elseif($order->status==1)待发货
        @elseif($order->status==2)待确认
        @elseif($order->status==3)完成
        @endif
    </address>
    <address>
        <strong>配送地址</strong><br>
        {{$order->province}}
        {{$order->city}}
        {{$order->city}} <br>
        {{$order->area}} <br>

        <abbr title="Phone">联系电话</abbr> {{$order->tel}}
    </address>

    <address>
        <strong>订单总金额</strong><br>
        <a >{{$order->total}}</a>
    </address>
    {{--主体结束--}}
@stop