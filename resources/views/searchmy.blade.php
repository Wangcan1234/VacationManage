@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
       <h1 align="center" style="color: white">您在{{$month}}月的请假记录如下</h1>
        <br><br>
        <table style="font-size: 25px">
            <th>开始时间</th>
            <th>结束时间</th>
            <th>请假天数</th>
            <th>请假类型</th>
            <th>审批人</th>
            @foreach($leavearr1 as $item)
                <tr>
                    <td align="center" height="35px">{{$item['start']}}</td>
                    <td align="center"  height="35px">{{$item['end']}}</td>
                    <td align="center"  height="35px">{{$item['days']}}天</td>
                    <td align="center"  height="35px">{{$item['leavestyle']}}</td>
                    <td align="center"  height="35px">{{$item['user2name']}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>

                <td align="right"style="height: 35px;font-size: 30px"><b>合计</b>:</td>
                <td align="center" style="height: 35px;font-size: 30px"><b>{{$leaveday}}天</b></td>
                <td></td>
            </tr>
        </table>
    </div>
@stop