@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
        <div style="width: 80%">
            <br><br><br>
           <h2 align="center"> 当前为{{$monthnow}}月,到目前您本月一共请假{{$leaveday}}天</h2>
            <table style="font-size: 25px">
                <th>请假开始时间</th>
                <th>请假结束时间</th>
                <th>请假类型</th>
                <th>请假天数</th>
                @foreach($leavearr1 as $item)
                    <tr><td align="center" height="30px">{{$item['start']}}</td>
                        <td align="center"  height="30px">{{$item['end']}}</td>
                        <td align="center"  height="30px">{{$item['leavestyle']}}</td>
                        <td align="center"  height="30px">{{$item['days']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
@stop