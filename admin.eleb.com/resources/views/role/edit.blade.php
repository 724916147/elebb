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

    <form method="post" action="{{route('role.update',[$role])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">角色名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="角色名称" value="{{$role->name}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">权限选择</label>
                @foreach($permission as $per)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="per[]" value="{{$per->id}}"
                        @if($role->hasPermissionTo($per->id))checked  @endif >
                        {{$per->name}}
                    </label>
                @endforeach
            </div>
        </div>
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop