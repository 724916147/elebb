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

    <form method="post" action="{{route('role.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">角色名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="角色名称" value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">角色选择</label>
                @foreach($roles as $role)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="per[]" value="{{$role->id}}"> {{$role->name}}
                    </label>
                @endforeach
            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop