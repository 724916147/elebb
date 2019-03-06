@extends('layout/app')
@section('contents')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>请修正以下信息</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('Shops.update',[$Shop])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺分类</label>
                <select class="form-control " name="shop_category_id">
                    @foreach($ShopCategories as $ShopCategory)
                    <option value="{{$ShopCategory->id}}">{{$ShopCategory->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店铺名称</label>
                <input name="shop_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="店铺名称" value="{{$Shop->shop_name}}">
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
                <input name="shop_rating" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称" value="{{$Shop->shop_rating}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否品牌</label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio2" value="1" {{$Shop->radio?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio3" value="0" {{$Shop->radio?'':'checked'}}> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准时送达</label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio2" value="1" {{$Shop->on_time?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio3" value="0" {{$Shop->on_time?'':'checked'}}>  否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否蜂鸟配送</label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio2" value="1" {{$Shop->fengniao?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio3" value="0" {{$Shop->fengniao?'':'checked'}}> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否保标记</label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio2" value="1" {{$Shop->bao?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio3" value="0" {{$Shop->bao?'':'checked'}}> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否票标记</label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio2" value="1" {{$Shop->piao?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio3" value="0" {{$Shop->piao?'':'checked'}}> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">是否准标记</label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio2" value="1" {{$Shop->zhun?'checked':''}}> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio3" value="0" {{$Shop->zhun?'':'checked'}}> 否
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">起送金额</label>
                <input name="start_send" type="text" class="form-control" id="exampleInputEmail1" placeholder="起送金额" value="{{$Shop->start_send}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">配送费</label>
                <input name="send_cost" type="text" class="form-control" id="exampleInputEmail1" placeholder="配送费" value="{{$Shop->send_cost}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">店公告</label>
                <input name="notice" type="text" class="form-control" id="exampleInputEmail1" placeholder="店公告" value="{{$Shop->notice}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">优惠信息</label>
                <input name="discount" type="text" class="form-control" id="exampleInputEmail1" placeholder="优惠信息" value="{{$Shop->discount}}">
            </div>
        </div>
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop