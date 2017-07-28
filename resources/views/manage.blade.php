@extends('comment.layout')
@section('content')
    <div class="content" >
        <div class="content" style="margin-left: 0px">
            <div id="container">
                <table class="zebra">
                    <caption style="color: forestgreen"><h2><i>请假申请列表</i></h2></caption>
                    @if(count($user2leave)==0)
                        <tr ><td>没有要处理的请加申请</td></tr>
                    @else
                        <thead>
                        <tr id="tr1">
                            <th>申请表单号</th>
                            <th>申请人</th>
                            <th>审批人</th>
                            <th>请假开始时间</th>
                            <th>请假结束时间</th>
                            <th>请假时长</th>
                            <th>是否同意</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user2leave as $itm)
                            <tr>
                                <td>{{$itm['id']}}</td>
                                <td>{{$itm['user1name']}}</td>
                                <td>{{ Session::get('name') }}</td>
                                <td>{{$itm['start']}}</td>
                                <td>{{$itm['end']}}</td>
                                <td>{{$itm['days']}}天</td>
                                <td>
                                    <a href="shenqing?numb=1&&leaveid={{$itm['id']}}">同意</a>|<a href="shenqing?numb=2&&leaveid={{$itm['id']}}">不同意</a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@stop