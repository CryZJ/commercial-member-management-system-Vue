<?php
	
	
//	$servername = "localhost:3306";
//	$username = "root";
//	$password = "123456";
//	$dbname ="zlxt";	
//	$conn = new mysqli($servername, $username, $password, $dbname);	
//	if ($conn->connect_error) {
//		die("Connection failed: " . $conn->connect_error);
//	}else{
//		//echo "Connected successfully";
//	}
	
	session_start();
		//接受提交过来的用户名及密码
	$user = $_REQUEST['username'];//用户名
	$pass =  $_REQUEST['password'];//密码
	
	require('conn.php');
	$sql="select * from 用户  where 账号='$user' ";	
	$result=$conn->query($sql);
//	echo gettype($result).$user.$password;
	if($result->num_rows > 0){
		while($rows=$result->fetch_assoc()){
			if($rows['状态']=="0"){
				if($rows['密码']==$pass){
					$time = date('y-m-d h:i:s',time());
					$mysql = "insert into 用户登录记录表(名称,账号,时间) values('".$rows['名称']."','".$rows['账号']."','".$time."')";
					$res = $conn->query($mysql);
					$_SESSION['id'] = $rows['id'];
					$_SESSION['user'] = $rows['账号'];
					$_SESSION['name'] = $rows['名称'];
					$_SESSION['dlr'] = $rows['代理人编号'];
					$_SESSION['ayr'] = $rows['案源人编号'];
					$_SESSION['lcczy'] = $rows['流程操作员'];
					$_SESSION['swgly'] = $rows['事务管理员'];
					$_SESSION['admin'] = $rows['最高权限者'];
					$_SESSION['normal'] = 'about-1';
					
					header("Location:./remindT.php");
					
			    }else{
					echo "<script language='javascript'>alert('密码错误');self.location='login.php';</script>";
				 }
			}else{
				echo "<script language='javascript'>alert('账号已被注销');self.location='login.php';</script>";
			}
			
		}
		
	}else{
			  echo "<script language='javascript'>alert('用户名错误');self.location='login.php';</script>";
	 }
	$conn->close();
	

?>