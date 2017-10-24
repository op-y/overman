<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>登录</title>

    <!-- Bootstrap core CSS -->
    <link href="/application/views/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS for login template -->
    <link href="/application/views/css/login.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <form class="form-signin" role="form" action="/index.php/loginCommit" method="post">
            <h2 class="form-signin-heading text-center">请登录</h2>
            <input type="text" class="hide" name="from" value="{$from}">
            <input type="text" class="form-control" name="username" placeholder="username" required="用户名不能为空" autofocus>
            <input type="password" class="form-control" name="password" placeholder="password" required="密码不能为空">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="ldap-way">LDAP登录
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
        </form>
    </div>
    <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/application/views/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
