<?php
	require'../../AHeader.php';
	$falg = $_GET['falg'];
	if($falg == 'save'){
		$OriName = $_GET['OriName'];
		$Conter = $_GET['Conter'];
		$Phone = $_GET['Phone'];
		$Fax = $_GET['Fax'];
		$Code = $_GET['Code'];
		$date = date('Y-m-d');
		require '../../conn.php';
		$sql = "insert into 商标_代理设置(代理人名,联系人,电话,传真,邮编,创建时间,创建人) values('".$OriName."','".$Conter."','".$Phone."','".$Fax."','".$Code."','".$date."','".$name."')";
		$result = $conn->query($sql);
		if($result){
			echo '操作成功';
		}else{
			echo '出现错误，请重新尝试并联系管理员';
		}
	}else if($falg == 'delet'){
		$id = $_GET['id'];
		$date = date('Y-m-d');
		require '../../conn.php';
		$sql = "update 商标_代理设置 set 状态  = 1,创建时间  = '".$date."',创建人  = '".$name."' where id = '".$id."'";
		$result = $conn->query($sql);
		if($result){
			echo '操作成功';
		}else{
			echo $sql;
		}
	}
?>