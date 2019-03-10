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

    <form method="post" action="{{route('nav.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">菜单名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="菜单名称" value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">上级菜单</label>
                <label class="checkbox-inline">
                    <select class="form-control " name="pid">
                        <option value="0">||顶级菜单||</option>
                        @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">选择路由</label>
                <label class="checkbox-inline">
                    <select class="form-control " name="permission_id">
                        <option value="0">||选择权限||</option>
                        @foreach($path as $pa)
                        <option value="{{$pa->id}}">{{$pa->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">路由</label>
                <input name="url" type="text" class="form-control" id="exampleInputEmail1" placeholder="路由地址" value="">
            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop
