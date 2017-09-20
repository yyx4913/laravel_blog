<form action="" name="myform" method="post">
   {{csrf_field()}}
    用户名：<input type="text" name="username" value="">
    密码：<input type="password" name="pass" value="">
    <input type="submit" value="提交">
</form>