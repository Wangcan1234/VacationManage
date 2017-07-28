@extends('comment.layout')

@section('content')
    <div class="content" style="color:white;height:850px;">
        <div style=" height:600px; width: 49%;float:left;border-color:darkslategrey;border-right-style:dotted;">

            <h4 style="padding-left: 30%;color:white;">假期设置</h4>
            <form action="setuptypes" method="post">
                {{csrf_field()}}
                <table >
                    <tr>
                        <td align="right">输入假期类型</td>
                        <td><input type="text" placeholder="请输入假期类型" name="leaveType" required></td>
                    </tr>
                    <tr>
                        <td align="right">请输入假期天数</td>
                        <td><input type="number" placeholder="请输入假期天数" name="leaveDays" required></td>
                    </tr>
                    <tr><td></td><td align="center"><input type="submit" value="提交" class="btn btn-primary" style="width: 80px;height: 40px;border-radius: 10px"></td></tr>
                </table>
            </form>

            <h4 style="padding-left: 30%;color:white;">取消假期</h4>
            <form action="deleteleave">
                <table>
                    <tr><td align="right">输入要取消的假期类型:</td>
                        <td><input type="text"name="deleteleave"placeholder="请输入要取消的假期类型"style="width: 90%" required></td>
                        <td align="left"><input type="submit"value="删除"class="btn btn-primary" style="width: 60px;height: 30px;border-radius: 10px"></td></tr>

                </table>
            </form>

            <p style="color:red;font-size: 20px"><b>因年假天数和在公司的工作年限有关需要另外设置。</b></p>
            @if(count($yearleave)==0)
            <h4 style="padding-left: 30%;color:white;">设置年假天数</h4>
            <form action="yearleave" method="post"style="font-size: 20px">
                {{csrf_field()}}
                <table >
                    <tr>
                        <td align="right" height="40px">1年以下</td>
                        <td align="left" height="40px"><input type="number" name="onelow"placeholder="请输入对应的天数"required></td>
                    </tr>
                    <tr>
                        <td align="right" height="40px">第2年到4年</td>
                        <td align="left" height="40px"><input type="number" name="fourlow"placeholder="请输入对应的天数" required></td>
                    </tr>
                    <tr>
                        <td align="right" height="40px">第5年到9年</td>
                        <td align="left" height="40px"><input type="number" name="ninelow"placeholder="请输入对应的天数" required></td>
                    </tr>
                    <tr>
                        <td align="right" height="40px">第10到15年</td>
                        <td align="left" height="40px"><input type="number" name="fifteenlow"placeholder="请输入对应的天数" required></td>
                    </tr>
                    <tr>
                        <td align="right" height="40px">第16年以上</td>
                        <td align="left" height="40px"><input type="number" name="sixteenup"placeholder="请输入对应的天数" required></td>
                    </tr>
                    <tr><td></td><td align="center"><input type="submit" value="提交" class="btn btn-primary" style="width: 80px;height: 40px;border-radius: 10px"></td></tr>
                </table>
            </form>
            @else
                <br>
            <h4 style="padding-left: 30%;color:white;">修改年假天数</h4>
            <h5 style="padding-left: 30%;color:mediumvioletred;">默认选中的是一年以内</h5>
            <form action="changeyear" method="post"style="font-size: 20px">
                {{csrf_field()}}
                <table >
                    <tr>
                        <td align="right" height="40px">请选择工作区间:</td>
                        <td><input type="radio" name="leaveType" value="onelow"style="width:25px;height:25px "checked>1年以下
                            <input type="radio" name="leaveType" value="fourlow"style="width:25px;height:25px ">2年到4年
                            <input type="radio" name="leaveType" value="ninelow"style="width:25px;height:25px ">5年到9年
                            <input type="radio" name="leaveType" value="fifteenlow"style="width:25px;height:25px ">10到15年
                            <input type="radio" name="leaveType" value="sixteenup"style="width:25px;height:25px ">16年以上</td>
                    </tr>
                    <tr>
                        <td align="right">输入修改后的天数</td>
                        <td><input type="number" placeholder="输入修改后的天数" name="leaveDays" required></td>
                    </tr>
                    <tr><td></td><td align="center"><input type="submit" value="提交"class="btn btn-primary" style="width: 80px;height: 40px;border-radius: 10px"></td></tr>
                </table>
            </form>
                @endif
        </div>


        {{--假期天数显示--}}
        <div style=" height:600px; width: 50%;float: right;">
            <h2 style="padding-left: 30%;color:white;">假期信息列表</h2>
            <table  style="font-size: 25px">
                <tr>
                    <td align="right"height="30px"><b>假期类型</b></td><td></td>
                    <td align="left"><b>假期天数</b></td>
                </tr>
                @foreach($leavetypes as $itim)
                    <tr>
                        <td align="right"height="40px">{{$itim['leaveType']}}</td><td align="center">--------------></td>
                        <td align="left">{{$itim['leaveDays']}}天</td>
                    </tr>
                    @endforeach
            </table>
            <h2 style="padding-left: 30%;color:white;">年假信息列表</h2>
            <table style="font-size: 25px">
                @if(count($yearleave)!=0)
                <tr>
                    <td align="right"height="30px"><b>工作区间</b></td> <td></td>
                    <td align="left"><b>拥有年假天数</b></td>
                </tr>

                @foreach($yearleave as $itim)
                <tr>
                    <td align="right"height="30px">1年以下</td> <td align="center">--------------></td>
                    <td align="left">{{$itim['onelow']}}天</td>
                </tr>
                <tr>
                    <td align="right"height="30px">2年到4年</td> <td align="center">--------------></td>
                    <td align="left">{{$itim['fourlow']}}天</td>
                </tr>
                <tr>
                    <td align="right"height="30px">5年到9年</td><td align="center">--------------></td>
                    <td align="left">{{$itim['ninelow']}}天</td>
                </tr>
                <tr>
                    <td align="right"height="30px">10到15年</td> <td align="center">--------------></td>
                    <td align="left">{{$itim['fifteenlow']}}天</td>
                </tr>
                <tr>
                    <td align="right"height="30px">16年以上</td> <td align="center">--------------></td>
                    <td align="left">{{$itim['sixteenup']}}天</td>
                </tr>
                    @endforeach
                    @else
                   <p style="color:red">年假信息还没有设置。。。</p>
                    @endif
            </table>
        </div>
    </div>

@stop