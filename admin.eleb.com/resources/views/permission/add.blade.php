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
    @foreach(['success','info','warning','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{$status}}  alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>{{session($status)}}
            </div>
        @endif
    @endforeach
    <form method="post" action="{{route('permission.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">权限名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="权限名称" value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">已有路由</label>
                <select class="form-control " name="url">
                    <option value="0">||选择路由||</option>
                    @foreach($path as $pa)
                        <option value="{{$pa}}">{{$pa}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop