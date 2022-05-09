<?php
	$flag = $_GET['flag'];
	$date = date('Y-m-d');
	require'../../conn.php';
	if($flag == 'save'){
		$fzrid=$_GET['fzr'];
		$ajh=$_GET['ajh'];
		$czy=$_GET['czy'];
//		$sql = "insert into 专案_可见(可见id,案卷号,创建时间,创建人)  values('".$fzrid."','".$ajh."','".$date."','".$czy."')";
//		$result = $conn->query($sql);
//		$sql_Sid = "select id from 专案_可见 where 案卷号= '".$ajh."' and 可见id = '".$fzrid."'"; 
//		$result_Sid = $conn->query($sql_Sid);
//		if($result_Sid -> num_rows>0){
//			while($row_Sid = $result_Sid->fetch_assoc()){
//				$id = $row_Sid['id'];
//			}
//		}
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$fzrid."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$sqrid = $row_sqrid['id'];
				$sqrsonid = $row_sqrid['sonid'];
			}
		}
		
		//保存专案_可见表，确定谁可见
		$sql_view = "insert into `专案_可见`(案卷号,可见id,创建时间,创建人,用户可见id,可见人)  values('".$ajh."','".$sqrid."','".$date."','".$czy."','".$sqrsonid."','".$fzrid."')";
		$result_view = $conn->query($sql_view);
		
		echo $date;
	}else if($flag == 'del'){
		$fzrid = $_GET['id'];
		$sql = "update 专案_可见 set 状态 = 1 where id = '".$fzrid."'";
		$result = $conn->query($sql);
	}else{
		echo "<script language='javascript'>alert('非法操作！');self.location='../../login.php';</script>;";
	}
	$conn->close();
?>