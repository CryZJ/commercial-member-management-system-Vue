<?php
require("../../../AHeader.php");
require("../../../conn.php");	


$flag = $_REQUEST["flag"];


if($flag == "Get_sqr_msg"){//获取委托人/受托人（申请人）的地址、国籍
	$sqr_id = $_GET["sqr_id"];
	
	$result_flag = "";
	$addr = "";//地址
	$nationality = "";//国籍 
	$sql = "SELECT 地址,国籍  FROM 申请人 WHERE id='".$sqr_id."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$result_flag = TRUE;
		while($row = $result->fetch_assoc()){
			$addr = '"'.$row["地址"].'"';
			$nationality = $row["国籍"];
		}
	}else{
		$result_flag = FALSE;
	}
	
	$sql = "SELECT 地址 FROM 申请人地址 WHERE 申请人id='".$sqr_id."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$addr .= ','.'"'.$row["地址"].'"'; 
		}
	}
	$addr = str_replace(" ", "", $addr);
	$json = '{"address":['.$addr.'],"nationality":"'.$nationality.'","result":"'.$result_flag.'"}';
	echo $json;
}

if($flag == "Save_data"){//保存进数据库
	$data_str = str_replace(" ", '', $_GET['data_str']);
	$checkbox_str = str_replace(" ", '', $_GET['checkbox_str']);
	
	$data_arr = explode("#$#", $data_str);
	$pssy_check_str = substr($checkbox_str, 0,strlen($checkbox_str)-6);//0,0,0,0,0 ,0,0,0
	$qx_check_str = substr($checkbox_str, 10);
	
	$ret_result = "";
	
	//委托人,委托人id,国籍,委托人地址,联系人,电话,修改时间,创建人,商标名,代理人   受托人地址,法定人,职务,类号码,第几号,评审事宜,权限,委托书日期
	
	$sql = "INSERT INTO 商标_委托书(委托人,委托人id,委托人地址,法定人,职务,代理人,受托人地址,联系人,电话,国籍,类号码,第几号,商标名,评审事宜,权限,委托书日期,委托书类型) VALUES(";
	$sql .= "'".$data_arr[0]."','".$data_arr[count($data_arr)-2]."','".$data_arr[1]."','".$data_arr[2]."','".$data_arr[3]."','".$data_arr[4]."','".$data_arr[5]."','".$data_arr[6]."','".$data_arr[7]."','".$data_arr[8]."','".$data_arr[9]."','".$data_arr[10]."','".$data_arr[11]."','".$pssy_check_str."','".$qx_check_str."','".end($data_arr)."','评审类')";
	
	if($conn->query($sql)){
		$ret_result = TRUE;
	}else{
		$ret_result = FALSE;
	}
	
	$json = '{"result":"'.$ret_result.'","sql":"'.$sql.'"}';
	echo $json;
}


if($flag == "Save_data_keep"){//保存进数据库
	$id=$_GET['id'];
	$data_str = str_replace(" ", '', $_GET['data_str']);
	$checkbox_str = str_replace(" ", '', $_GET['checkbox_str']);
	
	$data_arr = explode("#$#", $data_str);
	$pssy_check_str = substr($checkbox_str, 0,strlen($checkbox_str)-6);//0,0,0,0,0 ,0,0,0
	$qx_check_str = substr($checkbox_str, 10);
	
	$ret_result = "";
	
	//委托人,委托人id,国籍,委托人地址,联系人,电话,修改时间,创建人,商标名,代理人   受托人地址,法定人,职务,类号码,第几号,评审事宜,权限,委托书日期
	
//	$sql = "INSERT INTO 商标_委托书(委托人,委托人id,委托人地址,法定人,职务,代理人,受托人地址,联系人,电话,国籍,类号码,第几号,商标名,评审事宜,权限,委托书日期,委托书类型) VALUES(";
//	$sql .= "'".$data_arr[0]."','".$data_arr[count($data_arr)-2]."','".$data_arr[1]."','".$data_arr[2]."','".$data_arr[3]."','".$data_arr[4]."','".$data_arr[5]."','".$data_arr[6]."','".$data_arr[7]."','".$data_arr[8]."','".$data_arr[9]."','".$data_arr[10]."','".$data_arr[11]."','".$pssy_check_str."','".$qx_check_str."','".end($data_arr)."','评审类')";
	
	$sql="UPDATE `商标_委托书` SET `委托人`='{$data_arr[0]}' ,委托人id='{$data_arr[count($data_arr)-2]}',委托人地址='{$data_arr[1]}',法定人='{$data_arr[2]}',职务='{$data_arr[3]}',代理人='{$data_arr[4]}',受托人地址='{$data_arr[5]}',联系人='{$data_arr[6]}',
	电话='{$data_arr[7]}',国籍='{$data_arr[8]}',类号码='{$data_arr[9]}',第几号='{$data_arr[10]}',商标名='{$data_arr[11]}',评审事宜='{$pssy_check_str}',权限='{$qx_check_str}',委托书日期='{end($data_arr)}',委托书类型='评审类'
	 WHERE `id`='{$id}';";
//	
//	$row=mysqli_query($conn,$sql);
//	
//	$affected_rows=mysqli_affected_rows($conn);
//	if($affected_rows>0){
//		$ret_result = TRUE;
//	}else {
//		$ret_result = FALSE;
//	}
	
	if($conn->query($sql)){
		$ret_result = TRUE;
	}else{
		$ret_result = FALSE;
	}
//	
	$json = '{"result":"'.$ret_result.'","sql":"'.$sql.'"}';
	echo $json;
}



$conn->close();
?>