@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
        <div style="width:40%;padding: 10%;float: left;border-right: dotted">
            <h1 style="color: #00b3ee;"> 修改密码和电话</h1>
            <form action="changepassword" method="post">
                {{csrf_field()}}
                <label>工号 </label>
                <input type="text"  name="usid" value="{{Session::get('id')}}"disabled >
                <label>姓名</label>
                <input type="text"  name="name" value="{{Session::get('name')}}"disabled>
                <label>密码 </label>
                <input type="password" name="oldpass"placeholder="请输入旧密码" required>
                <label>确认密码</label>
                <input type="password" placeholder="请输入新密码"name="newpass" required>
                <label>电话</label>
                <input type="text" name="phone"placeholder="输入您的电话" required><br>
                <input type="submit" class="btn btn-primary" value="提交"style="margin-left:160px">
                <div class="clearfix"></div>
            </form></div>
                <div style="width: 38%;float: right;padding-top: 10%;font-size: 25px;height:600px;">
                    <h1 align="center" style="color: #00b3ee"> 基本信息显示</h1>
                    <table style="width: 90%;">
                        <tr><td height="30px" align="right">工号</td><td align="center">----------></td><td>{{$user['id']}}</td></tr>
                        <tr><td height="30px" align="right">姓名</td><td align="center">----------></td><td>{{$user['username']}}</td></tr>
                        <tr><td height="30px" align="right">性别</td><td align="center">----------></td><td>@if($user['sex']==10)男 @else 女 @endif</td></tr>
                        <tr><td height="30px" align="right">电话</td><td align="center">----------></td><td>{{$user['phone']}}</td></tr>
                        <tr><td height="30px" align="right">部门</td><td align="center">----------></td><td>{{$user['team']}}</td></tr>
                        <tr><td height="30px" align="right">入职时间</td><td align="center">----------></td><td>{{$user['created_at']}}</td></tr>

                    </table>
                </div>
    </div>
@stop