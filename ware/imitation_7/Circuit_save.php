<?php
	require'../../AHeader.php';
	$falg = $_GET['falg'];
	if($falg == 'save'){
		$Name = $_GET['Name'];
		$Day = $_GET['Day'];
		$Count = $_GET['Count'];
		$CaseType = $_GET['CaseType'];
		$date = date('Y-m-d');
		require '../../conn.php';
		
		$sql = "insert into 案件流程设置(流程,监控天数,金额,创建时间,创建人,案件类型) values('".$Name."','".$Day."','".$Count."','".$date."','".$name."','".$CaseType."')";
		$result = $conn->query($sql);
		if($result){
			echo '操作成功';
		}else{
//			echo $sql;
			echo '出现错误，请重新尝试并联系管理员';
		}
	}else if($falg == 'delet'){
		$id = $_GET['id'];
		$date = date('Y-m-d');
		require '../../conn.php';
		$sql = "update 案件流程设置 set 状态  = 1,创建时间  = '".$date."',创建人  = '".$name."' where id = '".$id."'";
		$result = $conn->query($sql);
		if($result){
			echo '操作成功';
		}else{
			echo $sql;
		}
	}
?>