@extends('comment.layout')
@section('content')
    <div class="content"style="color:darkorange;">
        @if(Session::get('name')==null)
            没有登录
        @else
        <h1 align="center"style="color:yellow;">年假信息显示</h1>
        <table border="1" style="width:50%;font-size: 25px"align="center">
            <th style="height: 30px">工号</th>
            <th style="height: 30px">姓名</th>
            <th style="height: 30px">剩余天数</th>
            <th style="height: 30px">拥有年假总天数</th>
            <tr>
                <td align="center" style="height: 30px">{{Session::get('id')}}</td>
                <td align="center" style="height: 30px">{{Session::get('name')}}</td>
                <td align="center" style="height: 30px">{{$odddays}}天</td>
                <td align="center" style="height: 30px">{{$days}}天</td>
            </tr>
        </table>
            <br> <br> <br> <br> <hr>
            <h2 align="center">所请年假详细显示</h2>
            <table border="1"align="center"style="width:70%;font-size: 25px">
                <th align="center"style="height: 30px">单号</th>
                <th style="height: 30px"align="center">开始时间</th>
                <th style="height: 30px"align="center">结束时间</th>
                <th style="height: 30px"align="center">请假天数</th>
                <th style="height: 30px"align="center">假期类型</th>
                @foreach($leaveyaer as $item)
                    <tr>
                    <td align="center"style="height: 30px" >{{$item['id']}}</td>
                    <td align="center"style="height: 30px" >{{$item['start']}}</td>
                    <td align="center"style="height: 30px" >{{$item['end']}}</td>
                    <td align="center"style="height: 30px" >{{$item['days']}}</td>
                    <td align="center"style="height: 30px" >{{$item['leavestyle']}}</td>
                </tr>
                    @endforeach
            </table>
         @endif
    </div>
@stop