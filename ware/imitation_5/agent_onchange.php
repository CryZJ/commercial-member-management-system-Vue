<?php
	require'../../conn.php';
	$falg = $_POST['falg'];
	//判断编号是否可用
	if($falg == 'bh'){
		$value = $_POST['value'];
		$sql="select * from 用户 where 代理人编号='".$value."'";
		$result = $conn->query($sql);
		if($result -> num_rows>0){
			$return = '1';
			$ok = 1;
		}else{
			$return = '0';
			$ok = 1;
		}
	}
	//判断名称是否可用
	else if($falg == 'mc'){
		$value = $_POST['value'];
		$sql="select * from 用户 where 名称='".$value."'";
		$result = $conn->query($sql);
		if($result -> num_rows>0){
			$return = '1';
			$ok = 1;
		}else{
			$return = '0';
			$ok = 1;
		}
	}
	//判断账号是否可用
	else if($falg == 'zh'){
		$value = $_POST['value'];
		$sql="select * from 用户 where 账号='".$value."'";
		$result = $conn->query($sql);
		if($result -> num_rows>0){
			$return = '1';
			$ok = 1;
		}else{
			$return = '0';
			$ok = 1;
		}
	}
	$conn->close();
	//返回‘1’即不可用，返回‘0’即可用
	if($ok = 1){
		echo $return;
	}else{
		echo 'fail';
	}
	
?>