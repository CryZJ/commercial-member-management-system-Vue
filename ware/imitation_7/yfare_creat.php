<?php
$my_flag = $_POST['my_flag'];

if($my_flag == "get_data"){
	$ret_data = '';
	
	require("../../conn.php");
	$sql = "SELECT 金额 FROM 年费设置 WHERE 专利类型='发明专利' AND 年费费减比例='100%' GROUP BY 金额  ORDER BY 年度";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$ret_data['发明专利']['100'][] = $row['金额'];
		}
	}
	$sql = "SELECT 金额 FROM 年费设置 WHERE 专利类型='发明专利' AND 年费费减比例='85%' GROUP BY 金额  ORDER BY 年度";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$ret_data['发明专利']['85'][] = $row['金额'];
		}
	}	 
	$sql = "SELECT 金额 FROM 年费设置 WHERE 专利类型='发明专利' AND 年费费减比例='70%' GROUP BY 金额  ORDER BY 年度";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$ret_data['发明专利']['70'][] = $row['金额'];
		}
	}
	
	$sql2 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='实用新型' AND 年费费减比例='100%' GROUP BY 金额  ORDER BY 年度";
	$result2 = $conn->query($sql2);
	if($result2->num_rows >0){
		while($row2 = $result2->fetch_assoc()){
			$ret_data['实用新型']['100'][] = $row2['金额'];
		}
	}	
	$sql2 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='实用新型' AND 年费费减比例='85%' GROUP BY 金额  ORDER BY 年度";
	$result2 = $conn->query($sql2);
	if($result2->num_rows >0){
		while($row2 = $result2->fetch_assoc()){
			$ret_data['实用新型']['85'][] = $row2['金额'];
		}
	}	
	$sql2 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='实用新型' AND 年费费减比例='70%' GROUP BY 金额  ORDER BY 年度";
	$result2 = $conn->query($sql2);
	if($result2->num_rows >0){
		while($row2 = $result2->fetch_assoc()){
			$ret_data['实用新型']['70'][] = $row2['金额'];
		}
	}	

	$sql3 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='外观设计' AND 年费费减比例='100%' GROUP BY 金额  ORDER BY 年度";
	$result3 = $conn->query($sql3);
	if($result3->num_rows >0){
		while($row3 = $result3->fetch_assoc()){
			$ret_data['外观设计']['100'][] = $row3['金额'];
		}
	}	
	$sql3 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='外观设计' AND 年费费减比例='85%' GROUP BY 金额  ORDER BY 年度";
	$result3 = $conn->query($sql3);
	if($result3->num_rows >0){
		while($row3 = $result3->fetch_assoc()){
			$ret_data['外观设计']['85'][] = $row3['金额'];
		}
	}	
	$sql3 = "SELECT 金额 FROM 年费设置 WHERE 专利类型='外观设计' AND 年费费减比例='70%' GROUP BY 金额  ORDER BY 年度";
	$result3 = $conn->query($sql3);
	if($result3->num_rows >0){
		while($row3 = $result3->fetch_assoc()){
			$ret_data['外观设计']['70'][] = $row3['金额'];
		}
	}	
	
	$json = json_encode($ret_data);
	echo $json;	
	$conn->close();
	
}else if($my_flag == "save_1"){
	$str_data = $_POST['str_data'];
	$arr_1 = explode("/,", $str_data);
	$data_save['100'] = explode(",", $arr_1[0]);
	$data_save['85'] = explode(",", $arr_1[1]);
	$data_save['70'] = explode(",", $arr_1[2]);
//	print_r($data_save);
	$return_result = array();
	require("../../conn.php");
	$n = 1;
	foreach($data_save['100'] as $key_1 => $val_1){
		if($key_1 != 5){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='100%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+3;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='100%' AND (年度='16' OR 年度='17' OR 年度='18' OR 年度='19' OR 年度='20') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
//			echo $sql."\n";
		}
	}
	$n = 1;
	foreach($data_save['85'] as $key_1 => $val_1){
		if($key_1 != 5){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='85%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+3;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='85%' AND (年度='16' OR 年度='17' OR 年度='18' OR 年度='19' OR 年度='20') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
//			echo $sql."\n";
		}
	}
	$n = 1;
	foreach($data_save['70'] as $key_1 => $val_1){
		if($key_1 != 5){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='70%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+3;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='发明专利' AND 年费费减比例='70%' AND (年度='16' OR 年度='17' OR 年度='18' OR 年度='19' OR 年度='20') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
//			echo $sql."\n";
		}
	}	
	if(!in_array("defeated", $return_result)){
		$return['result'] = "保存成功";
		$json = json_encode($return);
		echo $json;
	}else{
		$return['result'] = "defeated";
		$json = json_encode($return);
		echo $json;		
	}
	
	$conn->close();
	
}else if($my_flag == "save_2"){
	$str_data = $_POST['str_data'];
	$arr_1 = explode("/,", $str_data);
	$data_save['100'] = explode(",", $arr_1[0]);
	$data_save['85'] = explode(",", $arr_1[1]);
	$data_save['70'] = explode(",", $arr_1[2]);
//	print_r($data_save);
	$return_result = array();
	require("../../conn.php");
	$n = 1;
	$j = 4;
	foreach($data_save['100'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='100%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='100%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}
	$n = 1;
	$j = 4;
	foreach($data_save['85'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='85%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='85%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}
	$n = 1;
	$j = 4;
	foreach($data_save['70'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='70%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='实用新型' AND 年费费减比例='70%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}	
	
	if(!in_array("defeated", $return_result)){
		$return['result'] = "保存成功";
		$json = json_encode($return);
		echo $json;
	}else{
		$return['result'] = "defeated";
		$json = json_encode($return);
		echo $json;		
	}
	
	$conn->close();
	
	
}else if($my_flag == "save_3"){ 
	$str_data = $_POST['str_data'];
	$arr_1 = explode("/,", $str_data);
	$data_save['100'] = explode(",", $arr_1[0]);
	$data_save['85'] = explode(",", $arr_1[1]);
	$data_save['70'] = explode(",", $arr_1[2]);
//	print_r($data_save);
	$return_result = array();
	require("../../conn.php");
	$n = 1;
	$j = 4;
	foreach($data_save['100'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='100%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='100%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}
	$n = 1;
	$j = 4;
	foreach($data_save['85'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='85%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='85%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}
	$n = 1;
	$j = 4;
	foreach($data_save['70'] as $key_1 => $val_1){
		if($key_1 != 1 && $key_1 != 3){
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='70%' AND (年度='".$n."' OR 年度='".($n+1)."' OR 年度='".($n+2)."') ";
//			echo $sql."\n";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$n = $n+5;
		}else{
			$sql = "UPDATE 年费设置 SET 金额='".$val_1."' WHERE 专利类型='外观设计' AND 年费费减比例='70%' AND (年度='".$j."' OR 年度='".($j+1)."') ";
			$result = $conn->query($sql);
			if(!$result){
				$return_result[] = "defeated";
			}
			$j=$j+5;
//			echo $sql."\n";
		}
	}	
	
	if(!in_array("defeated", $return_result)){
		$return['result'] = "保存成功";
		$json = json_encode($return);
		echo $json;
	}else{
		$return['result'] = "defeated";
		$json = json_encode($return);
		echo $json;		
	}
	
	$conn->close();
}





	
	
	
?>