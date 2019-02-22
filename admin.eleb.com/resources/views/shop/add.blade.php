@extends('layout/app')
@section('contents')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('Shops.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">商户分类</label>
                <select class="form-control " name="shop_category_id">
                    <option>1</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">商户名称</label>
                <input name="shop_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称" value="{{old('shop_name')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺图片</label>
                <input type="file" id="exampleInputFile" name="shop_img">
                <p class="help-block">图片不能为空</p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">评分</label>
                <input name="shop_rating" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称" value="{{old('shop_rating')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否品牌</label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准时送达</label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否蜂鸟配送</label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否保标记</label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否票标记</label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准标记</label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio2" value="1" checked> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio3" value="0"> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">起送金额</label>
                <input name="start_send" type="text" class="form-control" id="exampleInputEmail1" placeholder="起送金额" value="{{old('start_send')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">配送费</label>
                <input name="send_cost" type="text" class="form-control" id="exampleInputEmail1" placeholder="配送费" value="{{old('send_cost')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店公告</label>
                <input name="notice" type="text" class="form-control" id="exampleInputEmail1" placeholder="店公告" value="{{old('notice')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">优惠信息</label>
                <input name="discount" type="text" class="form-control" id="exampleInputEmail1" placeholder="优惠信息" value="{{old('discount')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否保标记</label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio2" value="1" checked> 正常
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio3" value="0"> 待审核
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio3" value="-1"> 禁用
                </label>
            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop