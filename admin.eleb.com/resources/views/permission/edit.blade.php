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

    <form method="post" action="{{route('permission.update',[$permission])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">权限名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="优惠信息" value="{{$permission->name}}">
            </div>
        </div>
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop