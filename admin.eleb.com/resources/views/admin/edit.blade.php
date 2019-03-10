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

    <form method="post" action="{{route('Admins.update',[$Admin])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">角色账号</label>
                {{$Admin->name}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">角色选择</label>
                @foreach($roles as $role)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="role[]" value="{{$role->name}}"
                        @if($Admin->hasRole($role->name))checked  @endif
                        > {{$role->name}}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">权限选择</label>
                @foreach($permission as $per)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="per[]" value="{{$per->id}}"
                               @if($Admin->hasPermissionTo($per->name))checked  @endif
                        > {{$per->name}}
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