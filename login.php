<!--
<?php
	/*每次登录更新数据库的剩余天数*/
	require_once 'update_remind_day.php';
?>
-->
<!--检测GitHubtest  123-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <meta name="renderer" content="webkit">
    <title>用户登陆</title>
    <link rel="shortcut icon" href="#" type="image/png">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>

	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">
	<div class="container">
	    <form class="form-signin" action="handle_login.php" method="post">
	        <div class="form-signin-heading text-center">
	            <h1 class="sign-title">登录</h1>
	        </div>
	        <div class="login-wrap">
	            <input type="text" class="form-control" placeholder="请输入账号" autofocus name="username">
	            <input type="password" class="form-control" placeholder="请输入密码" name="password">
	            <button id="my_login" class="btn btn-lg btn-login btn-block" type="submit">
	                <i class="fa fa-check"></i>
	            </button>
	            <p id="tip" style="color: red;"></p>
			</div>
	    </form>
	</div>	
<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

<script type="text/javascript">
	//检测是否为极速模式登录  
	function whatBrowser() { 
		if(window.navigator.userAgent.indexOf('AppleWebKit') != -1) {
//			alert('360极速模式');
		}else{
			alert('请设置为“极速”浏览模式后再登录');
			var my_login = document.getElementById("my_login");
			my_login.style.display = "none";
			var tip = document.getElementById("tip");
			tip.innerHTML = "请设置为“极速”浏览模式后再登录";
		}
	}
	whatBrowser();
</script>
</body>
</html>
