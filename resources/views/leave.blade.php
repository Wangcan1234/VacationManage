@extends('comment.layout')
@section('content')
    <div class="content"style="color:white;font-size: 30px">

        <div style="padding-left: 30%;padding-top: 10%">
            <p style="color:red;">请假时长为最少0.5天!!!<br><br>请假区间如需改变月份请分开填写!!!</p>
            <form action="checkLevel" method="post">
                {{csrf_field()}}
                请  &nbsp;&nbsp; 假 &nbsp;&nbsp; 人：<input type="text" value="{{ Session::get('name') }}" name="username" required><br><br>
                请假人工号：&nbsp;<input type="text"value="{{ Session::get('id') }}" name="id1" required><br><br>
                请 假 类 型:&nbsp;
                <input type="radio"value="年假" name="holiday">年假
                @foreach($leavetypes as $itim)<input type="radio" value="{{$itim['leaveType']}}"name="holiday" checked>{{$itim['leaveType']}}
                @endforeach
                <br><br>
                请假起始时间:<input type="datetime-local" name="start" required><br><br>
                请假结束时间:<input type="datetime-local" name="end" required><br><br>
                输入请假时长:<input type="text"name="days" required><br><br>
                选择&nbsp;转 交 人:@foreach($charge as $item)<input type="radio" value="{{$item['id']}}"name="id2"style="width: 25px;height: 25px"checked>{{$item['username']}}
                           @endforeach
                <br><br><input  type="submit" value="提交" class="btn btn-primary" style="margin-left: 30%;width: 80px;height: 40px;border-radius: 10px">
            </form>
        </div>
    </div>
@stop