<?php
    header('content-type:text/html;charset=utf-8');
	require("../../../conn.php");
	$ajh     = $_POST["ajh"];
	$sqday   = $_POST["sqr_zz"];
	$jkxx    =$_POST["sj"];   //监控信息
	$kj      = explode('|',$jkxx);//控件名、金额、提醒日期、截止日期、备注
	$sql = "UPDATE `著作_监控` SET `金额` = '".$kj[1]."', `提醒日期` = '".$kj[2]."',
	        `截止日期` = '".$kj[3]."',`备注` = '".$kj[4]."',`申请日期` = '".$sqday."' WHERE `案卷号` = '".$ajh."' and `费用名称` = '".$kj[0]."'"; 
	$result = $conn->query($sql);
	$conn->close();
	if($result == 1){
		echo '修改成功';
	}else{
		echo '修改失败';
	}
?>