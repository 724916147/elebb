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

    <form method="post" action="{{route('ShopCategories.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">分类名称</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">是否显示</label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio2" value="1" checked> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio3" value="0"> 隐藏
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">分类图片</label>
            <div class="form-group">
                <input type="hidden" name="img" id="img_val">
            </div>
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                <img src="" id="img"  width="150px"/>
            </div>

        </div>
            <p class="help-block">图片不能为空</p>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}

@stop