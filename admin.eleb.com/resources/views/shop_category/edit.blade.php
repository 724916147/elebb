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

    <form method="post" action="{{route('ShopCategories.update',[$ShopCategory])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">分类名称</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称" value="{{$ShopCategory->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">是否显示</label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio2" value="1" {{$ShopCategory->status?'checked':''}}> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio3" value="0" {{$ShopCategory->status? '':'checked'}}> 隐藏
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">分类图片</label>
            <input type="file" id="exampleInputFile" name="img">
            <p class="help-block">图片不能为空</p>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop