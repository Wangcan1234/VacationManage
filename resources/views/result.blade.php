@extends('comment.layout')
@section('content')
    <div class="content">
        <div id="container">
            <table class="zebra">
                @if(count($leave)==0)

                    <tr ><td>没有新的结果。</td></tr>
                @else
                    <caption style="color: white"><h2>审批结果列表</h2></caption>
                    <thead>
                    <tr>

                        <th>单号</th>
                        <th>工号</th>
                        <th>姓名</th>
                        <th>审批人</th>
                        <th>请假开始时间</th>
                        <th>请假结束时间</th>
                        <th>请假天数</th>
                        <th>审批结果</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leave as $itm)
                        <tr>
                            <td>{{$itm['id']}}</td>
                            <td>{{$itm['user1id']}}</td>
                            <td>{{$itm['user1name']}}</td>
                            <td>{{$itm['user2name']}}</td>
                            <td>{{$itm['start']}}</td>
                            <td>{{$itm['end']}}</td>
                            <td>{{$itm['days']}}天</td>
                            <td>@if($itm['status']==1)
                                    批准
                                    @else
                                   不允许
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
            </table>
            <table class="zebra">
                <caption style="color: white"><h2><i>历史记录</i></h2></caption>
                @if(count($leave1)==0)

                @else
                    <thead>
                    <tr>

                        <th>单号</th>
                        <th>工号</th>
                        <th>姓名</th>
                        <th>审批人</th>
                        <th>请假开始时间</th>
                        <th>请假结束时间</th>
                        <th>请假天数</th>
                        <th>审批结果</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leave1 as $itm)
                        <tr>
                            <td>{{$itm['id']}}</td>
                            <td>{{$itm['user1id']}}</td>
                            <td>{{$itm['user1name']}}</td>
                            <td>{{$itm['user2name']}}</td>
                            <td>{{$itm['start']}}</td>
                            <td>{{$itm['end']}}</td>
                            <td>{{$itm['days']}}天</td>
                            <td>@if($itm['status']==1)
                                    批准
                                @else
                                    不允许
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
            </table>
            <div id="page">
                {{$leave1->render()}}
            </div>

        </div>
    </div>
@stop