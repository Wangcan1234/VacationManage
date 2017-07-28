@extends('comment.layout')
@section('content')
    <div class="content" style="background-color: silver;">
        <div id="container">
            <table class="zebra">
                <caption style="color: whitesmoke"><h2>同事信息列表</h2></caption>
                @if(count($user)==0)
                    <tr ><td>没有找到这个同事请重新查找...</td></tr>
                @else
                <thead>
                <tr>
                    <th>工号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>电话</th>
                    <th>部门</th>
                    <th>入职时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $itm)
                <tr>
                    <td>{{$itm['id']}}</td>
                    <td>@if($itm['sex']==10)男@else女@endif</td>
                    <td>{{$itm['username']}}</td>
                    <td>{{$itm['phone']}}</td>
                    <td>{{$itm['team']}}</td>
                    <td>{{$itm['created_at']}}</td>

                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop