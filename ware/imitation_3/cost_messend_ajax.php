<?php
	require'../../AHeader.php';
$my_flag = $_POST['my_flag'];

if($my_flag == "data_update"){
	$sqh = $_POST['sqh'];
	
	$arr_str2 = explode(',', $sqh);
	$len = count($arr_str2);
//	print_r($arr_str2);

	require("../../conn.php");
	$nowdate = date("Y-m-d");
	$sql = "SELECT a.id,a.处理状态  FROM 专案需交费用 a ,专利信息 b WHERE a.案卷号=b.案卷号 ";
	if($len == 1){
		$sql .= "AND b.申请号='".$arr_str2[0]."'";
	}else{
		$sql .= " AND ("; 
		foreach($arr_str2 as $key_0 => $value_0){
			$sql .= " b.申请号='".$value_0."' OR";
		}
		$sql = substr($sql,0,(count($sql)-3));
		$sql .= ")";
	}
//	echo $sql;
	//获取毫秒级时间戳
	list($msec, $sec) = explode(' ', microtime());
   	$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
   	//文件名
   	$FileName = $msectime.$userid.'.docx';
   	
	$result = $conn->query($sql);
	
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$sql2 = "UPDATE 专案需交费用   SET 通知书生成日期='".$nowdate."',处理状态='".$row['处理状态']."1"."',通知书名='".$FileName."' WHERE id='".$row['id']."'";
			$result2 = $conn->query($sql2);
			
			
		}
		
	}
	$SQRId = $_POST['SQRId'];
	$ajh = $_POST['ajh'];
	//保存通知书信息
		$SQL_His = "insert into 授权通知书信息(创建人,创建时间,案卷号,申请人id,文件路径)  values('".$name."','".date("Y-m-d H:i:s")."','".$ajh."','".$SQRId."','".$FileName."') ";
		$conn->query($SQL_His);
	$sqr_len = count($arr_str2);
	for($y = 0;$y<$sqr_len;$y++){
		$sql_CS = "update 专利信息 set 通知书状态 = 1 where 申请号='".$arr_str2[$y]."'";
		$result_CS = $conn->query($sql_CS);
	}
	if($result_CS){
		echo $FileName;
	}else{
		echo '$sql_CS';
	}
	
}	
	
?>