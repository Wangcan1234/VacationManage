
<?php
header("Content-type: text/html; charset=utf-8");
$con="";
$str="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
for($i=0;$i<4;$i++){
    $v=$str{rand(0,strlen($str)-1)};
    $con.='<span style="color:rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')">'.$v.'</span>';//rgb(rand(0,255))
}

?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>

</head>
<body>
<h1>注册</h1>
<form action="confirm.php" method="post">
    <table width="80%" border="1" bgcolor="ABCDEF">
        <tr>
            <td align="right">用户名</td>
            <td><input type="text" placeholder="请输入用户名" name="username">用户名不得小于六位 </td>
        </tr>
        <tr>
            <td align="right">密码</td>
            <td><input type="password" placeholder="请输入密码" name="password">密码必须包含数字和字母</td>
        </tr>
        <tr>
            <td align="right">确认密码</td>
            <td><input type="password" name="password1" placeholder="请再次输入密码"></td>
        </tr>
        <tr>
            <td align="right">兴趣爱好</td>
            <td><input name="interest[]" type="checkbox" value="sport" />运动
                <input name="interest[]" type="checkbox" value="music" />音乐
                <input name="interest[]" type="checkbox" value="book" />看书
                <input name="interest[]" type="checkbox" value="tv" />刷剧
            </td>
        </tr>
        <tr>
            <td align="right">邮箱</td>
            <td><input type="email" placeholder="请输入您的邮箱" name="email">请按邮箱的正确格式输入，例如QQ邮箱</td>
        </tr>
        <tr>
            <td align="right">验证码</td>
            <td><input type="text" placeholder="输入验证码" name="verify"> <?php
                echo $con;
                ?><input type="hidden" name="verify1"  value='<?php echo $con ?>'></td>
        </tr>
        <tr>
            <td align="right"><input type="submit" value="注册"></td>
        </tr>
    </table>
</form>

</body>
</html>