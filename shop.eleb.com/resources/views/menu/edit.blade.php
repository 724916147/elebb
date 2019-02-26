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
    <form method="post" action="{{route('Menus.update',[$Menu])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">名称</label>
                <input name="goods_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="名称" value="{{$Menu->goods_name}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">评分</label>
                <input name="rating" type="text" class="form-control" id="exampleInputEmail1" placeholder="评分" value="{{$Menu->rating}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">所属分类</label>
                <select class="form-control " name="category_id">
                    @foreach($menu_categories as $menu_category)
                        <option value="{{$menu_category->id}}" @if($menu_category->id==$Menu->menu_category)selected @endif>{{$menu_category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">价格</label>
                <input name="goods_price" type="text" class="form-control" id="exampleInputEmail1" placeholder="价格" value="{{$Menu->goods_price}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">描述</label>
                <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="描述" value="{{$Menu->description}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">提示信息</label>
                <input name="tips" type="text" class="form-control" id="exampleInputEmail1" placeholder="提示信息" value="{{$Menu->tips}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">商品图片</label>
                <input type="file" id="exampleInputFile" name="goods_img">
                <p class="help-block"><img src="{{$Menu->goods_img}} " width="100px"></p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">状态</label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio2" value="1" checked> 启用
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio3" value="0"> 停用
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="exampleInputEmail1">验证码</label>
                <input id="captcha" class="form-control" name="captcha"  >
            </div>
        </div>
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>



    {{--主体结束--}}
@stop