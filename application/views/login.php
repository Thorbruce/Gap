<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(function () {
       $('#submit').click(function () {
           var url='<?php echo base_url()?>login/qcord';
           window.location.href=url;
       });
    });
</script>
<body>
    用户名<input type="text" name="username"><br>
    密码<input type="password" name="password"></br>
        <input type="submit" value="登录" id="submit">

</body>
</html>