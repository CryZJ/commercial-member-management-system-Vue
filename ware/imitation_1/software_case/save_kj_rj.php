<?php
    header('content-type:text/html;charset=utf-8');
	require("../../../conn.php");
	$ajh  = $_POST["ajh"];
	$kjxx = $_POST["kjxx"];
	$kj   = explode("|", $kjxx);//分割字符串：申请号、申请日、序号、控件名、金额、提醒、截止日期
//	保存信息
    $sql  = "insert into 软件_监控(案卷号,费用名称,金额,提醒日期,截止日期,备注,状态)  values(";
    $sql .= "'".$ajh."','".$kj[0]."','".$kj[1]."','".$kj[2]."','".$kj[3]."','".$kj[4]."','0')";
    $result = $conn->query($sql);
    $conn->close();
    if($result1 == 1){
    	echo "1";
    }else{
    	echo "0";
    }
?>