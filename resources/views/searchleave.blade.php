@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
        <div style="font-size: 35px;padding-top:10%;padding-left:10%;width: 35%;float: left">
            <form action="getdays"method="post">
                {{csrf_field()}}
                <b style="color: #c7ddef">查询个人假期信息</b><br><br>
                <table border="0">
                    <tr><td style="font-size: 30px">请选择要查询的类型</td></tr>
                    @foreach($leavetype as $item)
                        <tr><td></td><td><input type="radio" name="style" value="{{$item['leaveType']}}"style="width:35px;height: 35px;margin-top: 20px">{{$item['leaveType']}}</td></tr>
                    @endforeach
                    <tr><td></td><td align="right"><input type="submit" value="查询" class="btn btn-primary" style="width: 80px;height: 40px;border-radius: 10px;" ></td></tr>
                </table>
            </form>
        </div>
        @if(\Illuminate\Support\Facades\Session::get('level')>7)
        <div style="font-size: 35px;padding-top:10%;padding-right:10%;width: 35%;float: right">
            <form action="getleaveday"method="post" name="form1">
                {{csrf_field()}}
                <b style="color: #c7ddef">输入要查询的信息</b><br><br>
                <table border="0">
                    <tr><td>  </td></tr>
                    <tr><td align="right">请输入工号:</td><td><input type="text" placeholder="请输入要查询人的工号" name="id1" required></td></tr>
                    <tr><td></td><td><input type="radio" name="style" value="年假"style="width:35px;height: 35px;margin-top: 20px">年假</td></tr>
                    @foreach($leavetype as $item)
                       <tr><td></td><td><input type="radio" name="style" value="{{$item['leaveType']}}"style="width:35px;height: 35px;margin-top: 20px">{{$item['leaveType']}}</td></tr>
                    @endforeach
                    <tr><td></td><td align="right"><input type="submit" value="查询" class="btn btn-primary" style="width: 80px;height: 40px;border-radius: 10px;" ></td></tr>
                </table>
            </form>
        </div>
            @endif
    </div>
@stop