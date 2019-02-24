@extends('layout/app')
@section('contents')
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">店铺状态：
                @if($Shop->status==1)正常
                @elseif($Shop->status==0)待审核
                @elseif($Shop->status==-1)禁用
                @endif
            </label>
        </div>
    </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺名称:{{$Shop->shop_name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">所属商户:{{ $Shop->user->name??'无'}}</label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺分类:{{ $Shop->ShopCategory->name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺图片</label>
                <img src="{{ $Shop->shop_img}} ">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">评分:{{ $Shop->ShopCategory->name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否品牌:{{ $Shop->brand?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准时送达:{{ $Shop->on_time?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否蜂鸟配送:{{ $Shop->fengniao?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否保标记:{{ $Shop->bao?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否票标记:{{ $Shop->piao?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准标记:{{ $Shop->zhun?'是':'否'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">起送金额:{{ $Shop->start_send}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">配送费:{{ $Shop->send_cost}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店公告</label>
                <P>{{ $Shop->notice}}</P>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">优惠信息</label>
                    <P>{{ $Shop->discount}}</P>
            </div>
        </div>


    {{--主体结束--}}
@stop