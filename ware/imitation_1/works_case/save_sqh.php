<?php
	$ajh = $_POST['ajh'];//获取案卷号	
	    $time = date("Y-m-d");//获取当前时间
	    $zzsqh = $_POST['sqh_zz'];//获取申请号
	    $zzsqr = $_POST['sqr_zz'];//获取申请时间
		require'../../../conn.php';
		$sql1 = "UPDATE `著作_信息` SET `申请号` = '".$zzsqh."', `申请日期` = '".$zzsqr."' WHERE `案卷号` = '".$ajh."'";
           $result1 = $conn->query($sql1);
           $conn->close();
?>