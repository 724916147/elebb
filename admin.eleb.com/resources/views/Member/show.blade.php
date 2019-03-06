@extends('layout/app')
@section('contents')
    <h1>会员信息</h1>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">会员状态：
                @if($member->status==1)<a href="{{route('member.up',[$member])}}" class="btn btn-info"> 启用</a>
                @elseif($member->status==0)<a href="{{route('member.stop',[$member])}}" class="btn btn-danger"> 停用</a>
                @endif
            </label>
        </div>
    </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">会员名称:{{$member->username}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">会员电话:{{$member->tel}}</label>
            </div>
        </div>

    {{--主体结束--}}
@stop