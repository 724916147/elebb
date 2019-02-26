@extends('layout/app')
@section('contents')
    {{--主体部分--}}
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">商品状态：
                {{$Menu->status?'启用':'停用'}}
            </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">菜品名称:{{$Menu->goods_name}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">评分:{{ $Menu->rating}}</label>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">所属分类:{{ $Menu->category->name}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">商品图片</label>
            <img src="{{ $Menu->goods_img}} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">价格:{{ $Menu->goods_price}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">描述:{{ $Menu->description}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">月销量:{{ $Menu->month_sales}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">评分数量:{{ $Menu->rating_count}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">提示信息:{{ $Menu->tips}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">满意度数量:{{ $Menu->satisfy_count}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">满意度评分:{{ $Menu->satisfy_rate}}</label>
        </div>
    </div>
    {{--主体结束--}}
@stop