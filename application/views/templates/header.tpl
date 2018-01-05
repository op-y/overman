{* Smarty Header *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/application/views/image/icon-hualala.png">

<title>SRE</title>

<!-- Bootstrap core CSS -->
<link href="/application/views/css/bootstrap.min.css" rel="stylesheet">
<!-- bootstrap dataTables -->
<link href="/application/views/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- bootstrap calendar -->
<link href="/application/views/css/calendar.min.css" rel="stylesheet">
<!-- timeline -->
<link href="/application/views/css/timeline.css" rel="stylesheet">
<!-- zTree -->
<link href="/application/views/css/ztree/metroStyle/metroStyle.css" rel="stylesheet">
<!-- My Style -->
<link href="/application/views/css/app.css" rel="stylesheet">

<!-- Bootstrap core JavaScript -->
<script src="/application/views/js/jquery.min.js"></script>
<script src="/application/views/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/application/views/js/ie10-viewport-bug-workaround.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/application/views/js/app/menu.js"></script>
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
                 <li><a href="/index.php/app123">App123</a></li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="ABTest">小流量<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="/index.php/ab">小流量信息</a></li>
                         <li role="presentation"><a href="/index.php/abOp">小流量操作</a></li>
                     </ul>
                 </li>
                 <li><a href="/index.php/logfile">日志文件</a></li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="rms">资产管理<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="/index.php/idc">IDC信息</a></li>
                         <li role="presentation"><a href="/index.php/host">机器信息</a></li>
                     </ul>
                 </li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="noah">服务管理<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="/index.php/service">服务管理(试用)</a></li>
                         <li class="divider"></li>
                         <li role="presentation"><a href="/index.php/deployment">服务上线(试用)</a></li>
                         <li role="presentation"><a href="/index.php/status">服务状态(试用)</a></li>
                         <!--<li role="presentation"><a href="/index.php/serviceDeployment">上线模板</a></li>-->
                     </ul>
                 </li>
                 <li class="dropdown"><a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="info">运维信息<b class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                         <li role="presentation"><a href="/index.php/event">计划任务</a></li>
                         <li role="presentation"><a href="/index.php/team">团队&轮值</a></li>
                     </ul>
                 </li>
            </ul>
            <div id="userMenu" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                       <a href="" data-toggle="dropdown" class="dropdown-toggle" role="button" id="aboutMe">
                           <span><img alt="image" class="img-circle" src="/application/views/image/icon-hualala.png"><span>
                       </a>
                       <ul class="dropdown-menu" role="menu" aria-labelledby="about">
                           <li role="presentation"><a href="/index.php/profile">我的信息</a></li>
                           <li role="presentation"><a href="/index.php/mine">我的权限</a></li>
                           <li class="divider"></li>
                           <li role="presentation"><a href="/index.php/logout">退出登录</a></li>
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

