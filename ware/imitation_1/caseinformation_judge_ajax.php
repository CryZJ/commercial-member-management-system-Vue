<?php
/*
 * 判断受理书，授权书，证书，是否导入
 * */
 $my_flag = $_POST['my_flag'];
 
 //受理导入
 if($my_flag == "sqing" ){
 	$ajh = $_POST['ajh'];
	$ret_str = ""; 
	$ret_str2 = ""; 
//	echo $ajh; 
	require('../../conn.php');
	//流程判断
	$sql = "SELECT id FROM 案卷流程及文档  WHERE 案卷号='".$ajh."' AND 流程='受理导入' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_str = "申请文件已导入。\n";
	}else{
		$ret_str = "申请文件未导入！\n";
	}
	
	//费用判断
	$sql2 = "SELECT id FROM 专案需交费用  WHERE 案卷号='".$ajh."' AND 费用名称='申请费'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		$ret_str2 = "申请费已生成。\n\n";
	}else{
		$ret_str2 = "申请费未生成！\n\n";
	}
	
	echo $ret_str.$ret_str2;
	$conn->close(); 
 }
 
 //授权导入1
  if($my_flag == "squan" ){
 	$ajh = $_POST['ajh'];
	$ret_str = ""; 
	$ret_str2 = ""; 
//	echo $ajh; 
	require('../../conn.php');
	//流程判断
	$sql = "SELECT id FROM 案卷流程及文档  WHERE 案卷号='".$ajh."' AND 流程='授权通知' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_str = "授权文件已导入。\n";
	}else{
		$ret_str = "授权文件未导入！\n";
	}
	
	//费用判断
	$sql2 = "SELECT 费用名称  FROM 专案需交费用  WHERE 案卷号='".$ajh."' AND 费用名称<>'申请费'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		while($row2 = $result2->fetch_assoc()){
			if($row2['费用名称'] == "年费"){
				$ret_str2 = $ret_str2 . "首期" . $row2['费用名称'].",";
			}else{
				$ret_str2 = $ret_str2 . $row2['费用名称'].",";
			}
		}
		$ret_str2 = $ret_str2 . " 等费用已生成。\n\n";
	}else{
		$ret_str2 = "授权文件导入相关费用未生成！\n\n";
	}
	
	echo $ret_str.$ret_str2;
	$conn->close(); 
 }

 //授权导入2
  if($my_flag == "squan2" ){
 	$ajh = $_POST['ajh'];
	$ret_str = ""; 
//	echo $ajh; 
	require('../../conn.php');
	//流程判断
	$sql = "SELECT id FROM 案卷流程及文档  WHERE 案卷号='".$ajh."' AND 流程='授权通知' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_str[0] = "1";
	}else{
		$ret_str[0] = "0";
	}
	 
	//费用判断
	$sql2 = "SELECT 费用名称  FROM 专案需交费用  WHERE 案卷号='".$ajh."' AND (费用名称='印花费' OR 费用名称='年费') AND 状态<>9";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		$ret_str[1] = "1";
	}else{
		$ret_str[1] = "0";
	}
	$json = json_encode($ret_str);
	echo $json;
	$conn->close(); 
 }   
 
 //证书
  if($my_flag == "zs" ){
 	$ajh = $_POST['ajh'];
	$ret_str = ""; 
//	echo $ajh; 
	require('../../conn.php');
	//流程判断
	$sql = "SELECT id FROM 案卷流程及文档  WHERE 案卷号='".$ajh."' AND 流程='证书导入' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_str[0] = "1";
	}else{
		$ret_str[0] = "0";
	}
	
	//费用判断
	$sql2 = "SELECT id  FROM 专案_年费记录  WHERE 案卷号='".$ajh."'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		$ret_str[1] = "1";
	}else{
		$ret_str[1] = "0";
	}
	$json = json_encode($ret_str);
	echo $json;
	$conn->close(); 
 }  
  
?>