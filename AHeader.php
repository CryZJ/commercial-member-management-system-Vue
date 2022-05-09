<?php 
	ob_start();
	session_start();
	error_reporting(E_ALL || ~E_NOTICE);
	$userid =  $_SESSION['id'];
 	$user   =  $_SESSION['user'];
	$name   =  $_SESSION['name'];
	$dlrbh  =  $_SESSION['dlr']; 
	$ayrbh  =  $_SESSION['ayr']; 
	$lcczy  =  $_SESSION['lcczy'];
	$swgly  =  $_SESSION['swgly'];
	$admin  =  $_SESSION['admin'];
	$normal =  $_SESSION['normal'];
	$admin = intval($admin);
	$lcczy = intval($lcczy);
	if($name == null){
		$server_host = "http://".$_SERVER["HTTP_HOST"]."/zlxt/login.php";
		echo "<script language='javascript'>alert('请登录后再进行操作！');window.open('".$server_host."','_self');</script>;";
	}
?>