{* Smarty Header *}
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/application/views/image/icon-dotA2.png">

<title>SRE</title>

<!-- Bootstrap core CSS -->
<link href="/application/views/css/bootstrap.min.css" rel="stylesheet">
<!-- My Style -->
<link href="/application/views/css/app.css" rel="stylesheet">

<!-- Bootstrap core JavaScript -->
<script src="/application/views/js/jquery.min.js"></script>
<script src="/application/views/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/application/views/js/ie10-viewport-bug-workaround.js"></script>
</head>

<body>
<!-- Top Menu -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">SRE</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                 <li><a href="/index.php/billboard">Billboard</a></li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="about">运维信息<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="">值班人</a></li>
                         <li role="presentation"><a href="">运维组</a></li>
                     </ul>
                 </li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="about">资产管理<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="/index.php/idc">IDC信息</a></li>
                         <li role="presentation"><a href="/index.php/host">机器信息</a></li>
                     </ul>
                 </li>
            </ul>
            <div id="userMenu" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                       <a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="about">
                           <span><img alt="image" class="img-circle" src="/application/views/image/icon-dotA2.png"><span>
                       </a>
                       <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                           <li role="presentation"><a href="">我的权限</a></li>
                           <li role="presentation"><a href="">退出登录</a></li>
                       </ul>
                    </li>
                </ul>
            </div>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div><!--/.nav-collapse -->
    </div>
</div>
<!-- End of Top Menu -->

<div class="container-fluid">
<div class="row">

