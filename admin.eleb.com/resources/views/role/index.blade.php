@extends('layout.app');
@section('contents')
    @foreach(['success','info','warning','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{$status}}  alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>{{session($status)}}
            </div>
        @endif
    @endforeach
    {{--主体部分--}}

    <h1 class="" style="color: cornflowerblue">权限信息</h1>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>角色名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{route('role.show',[$role])}}" class="btn btn-info"> 查看</a>
                    <a href="{{route('role.edit',[$role])}}" class="btn btn-warning"> 修改</a>
                    <form action="{{route('role.destroy',[$role])}}" method="post" style="display: inline">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button  type="submit" class="btn btn-danger" >删除</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    {{--主体结束--}}
@stop