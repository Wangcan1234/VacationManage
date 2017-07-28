
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>考勤管理系统 @yield('tittle')</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->
    @section('style')
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }

    </style>
    @show

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->


    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body class="">
<!--<![endif]-->
@section('navbar')
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">

            <li><a  class="hidden-phone visible-tablet visible-desktop" >@if(Session::get('name'))
                        当前登录人:
                    @else
                        未登录
                    @endif</a ></li>
            <li id="fat-menu" class="dropdown">
                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user"></i>{{ Session::get('name') }}
                    <i class="icon-caret-down"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="out">退出登录</a></li>
                </ul>
            </li>

        </ul>
        <a class="brand" href="goods"><span class="first">青岛</span> <span class="second">白泽亚华</span></a>
    </div>
</div>
@show



@section('sidebar')
<div class="sidebar-nav">
    <form class="search form-inline" action="search"  method="post">
        <input type="text" placeholder="输入要查找的人员姓名..."name="name" style="height:30px" required>
        <br/><br/>
        {{csrf_field()}}
        <input type="submit" value="查询" style="width:106%;height:40px" >
    </form>
    <a href="#dashboard" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>个人请假记录查询</a>
    <ul id="dashboard" class="nav nav-list collapse">
    <form action="seachmy" method="post">
        {{csrf_field()}}
            <li><input type="number" name="month" style="border-color:red;width: 100%"placeholder="请输入要查询的月份" ></li>
            <li><input class="btn btn-primary" type="submit" value="查询"style="width:108%;height:40px"></li>
    </form>
    </ul>
    <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>个人请假记录</a>
    <ul id="dashboard-menu" class="nav nav-list collapse">
        <li><a href="annualLeave">年假信息查询</a></li>
        <li ><a href="month">月度请假记录</a></li>
        <li ><a href="personalInfo">修改信息</a></li>
        <li ><a href="searchleave">假期余额查询</a></li>


    </ul>

    <a href="#account-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>登录模块</a>
    <ul id="account-menu" class="nav nav-list collapse">
        @if(Session::get('id')==null)
        <li ><a href="login">登录</a></li>
        @else
        <li style="color: #d62728">您已登录</li>
        @endif
    </ul>

    <a href="leave?level={{ Session::get('level') }}" class="nav-header" ><i class="icon-legal"></i>请假申请</a>
    <a href="result" class="nav-header" ><i class="icon-comment"></i>审批结果<span class="label label-info">{{ Session::get('resultnum') }}</span></a>
    <a href="manage" class="nav-header" ><i class="icon-comment"></i>消息<span class="label label-info">{{ Session::get('num') }}</span></a>
    @if(Session::get('level')>7)
        <a href="#dashboard-men" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>管理模块</a>
        <ul id="dashboard-men" class="nav nav-list collapse">
            <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>每月请假信息查询</a>
            <ul id="accounts-menu" class="nav nav-list collapse">
                <form action="searchone"><li ><input type="text"placeholder="请输入要查询人的工号"name="id" required></li>
                    <li ><input type="number"placeholder="请输入要查询的月份" name="month" required></li>
                    <li><input type="submit"value="提交" class="btn btn-primary"></li></form>
            </ul>
            <li><a href="setUp"  ><i class="icon-legal"></i>假期设置</a></li>
            <li ><a href="usermanage"  ><i class="icon-legal"></i>人员管理</a></li>
            <li ><a href="resit"><i class="icon-legal"></i>注册</a></li>

        </ul>
    @endif
</div>
@show

@section('content')

@show


<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>

</body>
</html>


