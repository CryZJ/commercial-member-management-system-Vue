<?php
$my_flag = $_POST['my_flag'];

//受理书费用保存
if($my_flag == 'advice'){
	$data_acc = $_POST['data_send'];
//	print_r($data_acc);
	$return = '';
	require("../conn.php");
	foreach($data_acc as $key_0 => $value_0){
		$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源,状态)  VALUES(";
		$sql .= "'".$value_0[0]."','".$value_0[1]."','".$value_0[2]."','".$value_0[3]."','".$value_0[4]."','".$value_0[5]."','1','4')";
		$result = $conn->query($sql);
	}
	if($result){
		$return['result'] = "保存成功！";
	}else{
		$return['result'] = "保存失败！";
	}
	$json = json_encode($return);
	echo $json;
	$conn->close();
}

//授权书费用保存
if($my_flag == 'impower'){
	$nd = $_POST['nd'];
	$data_acc = $_POST['data_send'];
//	print_r($data_acc);
	$return = '';
	require("../conn.php");
	foreach($data_acc as $key_0 => $value_0){
		if($value_0[1] == "年费"){
			$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,年度,费用来源)  VALUES(";
			$sql .= "'".$value_0[0]."','".$value_0[1]."','".$value_0[2]."','".$value_0[3]."','".$value_0[4]."','".$value_0[5]."','".$nd."','2')";
			$result = $conn->query($sql);			
		}else{
			$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源)  VALUES(";
			$sql .= "'".$value_0[0]."','".$value_0[1]."','".$value_0[2]."','".$value_0[3]."','".$value_0[4]."','".$value_0[5]."','2')";
			$result = $conn->query($sql);			
		}
	}
	if($result){
		$return['result'] = "保存成功！";
	}else{
		$return['result'] = "保存失败！";
	}
	$json = json_encode($return);
	echo $json;
	$conn->close();
}

//缴费通知
if($my_flag == "overdue"){
	$data_acc = $_POST['data_send'];
//	print_r($data_acc);
	$return = '';
	require("../conn.php");
	foreach($data_acc as $key_0 => $value_0){
		$sql = "UPDATE 滞纳金列表  SET 滞纳金='".$value_0[5]."',开始时间='".$value_0[6]."',截止时间='".$value_0[7]."' WHERE 案卷号='".$value_0[0]."' AND 年度='".$value_0[3]."' AND 期数='".$value_0[2]."'";
		$result = $conn->query($sql);
	}
	
	if($result){
		$return['result'] = "保存成功！";
	}else{
		$return['result'] = "保存失败！";
	}
	$json = json_encode($return);
	echo $json;
	$conn->close();	
}


?>