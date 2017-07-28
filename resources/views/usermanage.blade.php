@extends('comment.layout')
@section('content')
    <div class="content"style="color:white;">
        <div style="padding-top: 6%;padding-left: 20%">
            <table border="1"style="width: 60%;">
                <th>工号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>部门</th>
                <th>电话</th>
                <th>入职时间</th>
                <th>管理</th>
                <th>重置密码</th>
                @foreach($user as $item)
                    <tr><td align="center">{{$item['id']}}</td>
                        <td  align="center">{{$item['username']}}</td>
                        <td  align="center">@if($item['sex']==10)
                                男
                            @else
                                女
                            @endif</td>
                        <td  align="center">{{$item['team']}}</td>
                        <td  align="center">{{$item['phone']}}</td>
                        <td  align="center">{{$item['created_at']}}</td>
                        <td  align="center"><a href="deleteuser?id={{$item['id']}}&&name={{$item['username']}}" class="btn btn-primary">删除</a></td>
                        <td  align="center" ><a href="resetpass?id={{$item['id']}}" class="btn btn-primary">重置密码</a></td></tr>

                @endforeach
            </table>
        </div>

    </div>
@stop