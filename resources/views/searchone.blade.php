@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
        <br><br><br>
        <h1 align="center">这是{{$user['id']}}{{$user['username']}}在{{$month}}月的请假记录</h1>
        @if(count($leavearr1)!=0)
        <div>
            <table style="font-size: 25px;">
                <th>开始时间</th>
                <th>结束时间</th>
                <th>请假天数</th>
                <th>请假类型</th>
                <th>审批人</th>
                @foreach($leavearr1 as $item)
                <tr>
                        <td align="center" height="35px">{{$item['start']}}</td>
                        <td align="center">{{$item['end']}}</td>
                        <td align="center">{{$item['days']}}</td>
                        <td align="center">{{$item['leavestyle']}}</td>
                        <td align="center">{{$item['user2name']}}</td>

                </tr>
                @endforeach
            </table>
        </div>
        <h1>总计</h1>
        <div>
            <table style="font-size: 25px;">
                <th>假期类型</th><th>本月请假天数</th>
                @foreach($leavetypes as $itim)
                    <tr>
                        <td align="center" height="35px">{{$itim['leaveType']}}</td> <td align="center" height="35px">{{$arrdays[$itim['leaveType']]}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
            @else
            <br><br><br>
           <h1 align="center"style="color: #00b3ee">在{{$month}}月他没有请假。</h1>
            @endif

    </div>
@stop