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
            <th>权限名称</th>
            <th>操作</th>
        </tr>
        @foreach($permission as $per)
            <tr>
                <td>{{$per->id}}</td>
                <td>{{ $per->name }}</td>
                <td>
                    <a href="{{route('permission.show',[$per])}}" class="btn btn-info"> 查看</a>
                    <a href="{{route('permission.edit',[$per])}}" class="btn btn-warning"> 修改</a>
                    <form action="{{route('permission.destroy',[$per])}}" method="post" style="display: inline">
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