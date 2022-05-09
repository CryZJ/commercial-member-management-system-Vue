<?php
$my_flag = $_POST['my_flag'];

if($my_flag == "save_cost"){
	$arr_acc = $_POST['arr_send'];
	$return = '';
//	print_r($arr_acc);
	require("../../conn.php");
	$sql = "SELECT id FROM 专利信息 WHERE 案卷号='".$arr_acc[0]."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限)  VALUES(";
		$sql .= "'".$arr_acc[0]."','".$arr_acc[1]."','".$arr_acc[2]."','".date("Y-m-d")."','".$arr_acc[3]."','".$arr_acc[4]."')"; 
		if($conn->query($sql)){
			$return['result'] = "保存成功！";
		}else{
			$return['result'] = "保存失败！";
		}
	}else{
		$return['result'] = "案卷号对应的案件不存在！";
	}
	
	$json = json_encode($return);
	echo $json;
	$conn->close();
}
?>