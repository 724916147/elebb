@extends('layout/app')
@section('contents')
{{--主体部分--}}
<h1>订单列表</h1>
@foreach(['success','info','warning','danger'] as $status)
@if(session()->has($status))
<div class="alert alert-{{$status}}  alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>{{session($status)}}
</div>
@endif
@endforeach

<table class="table table-hover">
    <tr>
        <th>序号</th>
        <th>订单编号</th>
        <th>状态</th>
        <th>收货人名称</th>
        <th>收货人电话</th>
        <th>操作</th>
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->sn}}</td>
        <td>@if($order->status==-1)取消
            @elseif($order->status==0)待支付
            @elseif($order->status==1)待发货
            @elseif($order->status==2)待确认
            @elseif($order->status==3)完成
            @endif
        </td>
        <td>{{$order->name}} </td>
        <td>{{$order->tel}} </td>
        <td>
            <a href="{{route('order.show',[$order])}}" class="btn btn-info" >查看</a>
            <a href="{{route('order.cancel',[$order])}}" class="btn btn-danger" >取消</a>
        </td>
    </tr>
    @endforeach
</table>
{{--主体结束--}}
@stop

