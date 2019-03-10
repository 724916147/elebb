@extends('layout/app')
@section('contents')
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">活动:{{$event->title}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">活动详情:{!! $event->content !!}</label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">报名开始时间:{{ date('Y-m-d',$event->signup_start)}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">报名结束时间:{{ date('Y-m-d',$event->signup_end)}}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">开奖时间:{{ $event->prize_date}}</label>
            </div>
        </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">参与人数:{{ $event->signup_num}}</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            @foreach($prizes as $price)
            <label for="exampleInputEmail1">活动奖品:{{ $price->name }}</label>
                @endforeach
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label for="exampleInputEmail1">中奖商家:@if ()$event->EventPrize->member_id</label>
        </div>
    </div>

        @if(date('Y-m-d',$event->signup_end) <= date('Y-m-d'))
            @if($Members)
                <a href="" class="btn btn-warning" >已报名</a>
            @else <a href="{{route('event.edit',[$event])}}" class="btn btn-warning" >报名</a>
            @endif
            @else
            @if($Members)
                <a href="" class="btn btn-warning" >已报名</a>
            @else <a  class="btn btn-warning" >活动停止报名</a>
            @endif
        @endif

    {{--主体结束--}}
@stop