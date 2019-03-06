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

    <h1 class="" style="color: cornflowerblue">会员信息</h1>
    <form action="{{route('member.list')}}"  method="get">
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="exampleInputEmail1">输入会员名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="会员名称" >
            </div>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>会员名称</th>
            <th>会员电话</th>
            <th>会员状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>@if($member->status==1)<a href="{{route('member.stop',[$member])}}" class="btn btn-info"> 启用</a>
                    @elseif($member->status==0)<a href="{{route('member.up',[$member])}}" class="btn btn-danger"> 停用</a>
                    @endif
                </td>
                <td>
                    <a href="{{route('member.show',[$member])}}" class="btn btn-info"> 查看</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{--主体结束--}}
@stop