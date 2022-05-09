<!DOCTYPE html>
<head>
	<meta charset="utf-8">		
</head>
<body>
	<?php
		$uname = $user = $pass = $sample = "";		
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$uname = $_REQUEST["uname"];
			$user = $_REQUEST["user"];
			$pass = $_REQUEST["pass"];
			$sample = $_REQUEST["sample-radio"];
		}
		//echo $uname ."&nbsp;". $user ."&nbsp;". $pass ."&nbsp;". $sample ."<br/>";
		require("conn.php");
		
		
		$sql = " insert into 登录人员(username,user,pass,sample) values('".$uname."','".$user."','".$pass."','".$sample."' ) ";
		
		//echo $sql ;
		$result = $conn->query($sql);
		$conn->close();
		echo "<script type='text/javascript'>alert('注册成功！');location.href='login.php';</script>";
		
		

	?>
</body>
</html>
