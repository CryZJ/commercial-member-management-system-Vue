<?php
	$data = $_POST['data_send'];
//	print_r($data);
	require('conn.php');
	foreach($data as $key => $value){
		$sql = "insert into 专案需交费用(案卷号,费用名称,金额,提醒时间,剩余天数,缴费期限) values(";
		$sql .= "'$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$value[5]')";
		$result = $conn->query($sql);
	}
	if($result){
		$return['结果']="保存成功！";
	}else{
		$return['结果']="保存失败00！";
	}
	$json = json_encode($return);
	echo $json;
?>