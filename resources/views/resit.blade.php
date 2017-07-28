<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>注册</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

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

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>

    <![endif]-->

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


<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">

        </ul>
        <a class="brand" href="goods"><span class="first">青岛</span> <span class="second">白泽亚华</span></a>
    </div>
</div>






<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">注册</p>
            <div class="block-body">
                @if(old('member')['id'])
                    <h3 style="color:red;">{{$error}}</h3>
                @endif
                <form action="firstResit" method="post" action="{{url('resit')}}">
                    {{csrf_field()}}
                    <label>工号 <span style="color:fuchsia;font-size: 5px;">四位的纯数字</span></label>
                    <input type="text" class="span12" name="member[id]" placeholder="请输入四位的工号" value="{{old('member')['id']}}" required onchange="change(this)">
                    <label>姓名</label>
                    <input type="text" class="span12" name="member[username]"placeholder="输入新员工姓名" value="{{old('member')['username']}}" required>
                    <label>密码 </label>
                    <input type="password" class="span12" name="member[password]"placeholder="请输入初始密码" value="{{old('member')['password']}}" required>
                    <label>确认密码</label>
                    <input type="password" class="span12"placeholder="请再次输入密码"name="member[password1]" value="{{old('member')['password1']}}"  required>
                    <label>性别</label>

                    <input type="radio"  name="member[sex]" value=10 style="margin-left: 20%;" checked>男
                    <input type="radio"  name="member[sex]" value=20 style="margin-left: 20%">女
                    <label>电话</label>
                    <input type="" class="span12" name="member[phone]"placeholder="输入新员工电话" value="{{old('member')['phone']}}" required>
                    <label>部门</label>
                    <input type="text" class="span12" name="member[team]"placeholder="输入新员工部门" value="{{old('member')['team']}}" required>
                    <label>权限等级</label>
                    <input type="number" class="span12" name="member[level]"placeholder="输入0--9 十个数字，数值越大权限越高" value="{{old('member')['level']}}" >

                    <input type="submit" class="btn btn-primary pull-right" value="注册">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>

    </div>
</div>





<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>
<script type="text/javascript">
  function change(obj){
      var id=$(obj).val();
      $.post("checkid",{'_token':'{{csrf_token()}}','id':id},function(data){
          if(data==1){
              alert("此id已经存在,请更换");
          }

      })
  }
</script>
</body>
</html>


