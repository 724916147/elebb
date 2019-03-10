@extends('layout/app')
@section('contents')
{{--主体部分--}}
<h1>订单列表</h1>
@foreach(['success','info','warning','danger'] as $status)
@if(session()->has($status))
<div class="alert alert-{{$status}}  alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>{{session($status)}}
</div>
@endif
@endforeach
<form action="{{route('order.goods')}}"  method="get">
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="exampleInputEmail1">查看最近销售商品</label>
            <select class="form-control " name="goods">
                <option value="day">近一周</option>
                <option value="month">近三月</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-default">提交</button>
</form>

<p></p>
<p></p>
<table class="table table-hover">
    <tr>
        <th>菜名</th>
        @foreach($days as $day)
        <td>{{$day}}</td>
        @endforeach
    </tr>
    @foreach($app as $good=>$k)
        <tr>
            <td>{{$good}}</td>
            @foreach($k as $day)
                <td>{{ $day }}</td>
            @endforeach
        </tr>
    @endforeach

</table>

<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 1000px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    option = {
        title: {
            text: '折线图堆叠'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: {!! json_encode(array_values($days)) !!}
        },
        yAxis: {
            type: 'value'
        },
        series: {!! json_encode($s) !!}
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
{{--主体结束--}}
@stop

