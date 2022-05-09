<?php
	require'../../AHeader.php';
	require("../../conn.php");
	
	//验证身份是否是“流程操作员”
	if(!$lcczy == "1"){
		echo '{"state":"0","message":"您没有权限操作"}';
		exit();
	}
	
	$my_flag = $_REQUEST['my_flag'];


switch($my_flag){
	case "data_update";
		$str2 = $_POST['str2'];//id,专利号，专利名，申请日，年度，年费，代理费，滞纳金，小计。。。总计
	
		$arr_str2 = explode(',', $str2);
	//	print_r($arr_str2);
		$arr_length = count($arr_str2);
		for($i=0;$i<($arr_length-1)/9;$i++){
			$id[] = $arr_str2[$i*9];
		}
		
		//获取毫秒级时间戳
		list($msec, $sec) = explode(' ', microtime());
	   	$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
	   	//文件名
	   	$FileName = $msectime.$userid.'.docx';
		
	//	print_r($id);
		
		$nowdate = date("Y-m-d");
		for($i=0;$i<count($id);$i++){
			$sql = "SELECT 处理状态  FROM 专案_年费记录   WHERE id=".$id[$i]."";
			$result = $conn->query($sql);
			if($result->num_rows){
				while($row = $result->fetch_assoc()){
					$sql2 = "UPDATE 专案_年费记录   SET 通知书生成日期='".$nowdate."',通知书名='".$FileName."',处理状态='".$row['处理状态']."1"."',`状态`='4' WHERE id='".$id[$i]."'";
					$result2 = $conn->query($sql2);
				}
			}
		}
		if($result2){
			echo $FileName;
		}
		break;
		
	case "savefare";
		
	
		$mass 	= $_POST['mas'];
	//	$fid 	= $_POST['fid'];
		$cpeo 	= $_POST['cpeo'];
	//	$array 	= explode('/',$mass);
		$len 	= count($mass);
		
		//获取毫秒级时间戳
		list($msec, $sec) = explode(' ', microtime());
	   	$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
	   	//文件名
	   	$FileName = $msectime.$userid.'.xls';
		
		for($i=0;$i<$len;$i++){
			$arr= explode('/',$mass[$i]);
	//ffid+'/'+fname+'/'+ ffnum +'/'+ fsnum +'/'+ fjefy +'/'+ fdlfy +'/'+ fznjy;
			//更新专案_年费
			$sql = "UPDATE `专案_年费记录` SET `缴费处理人`='".$cpeo."',缴费文件名='".$FileName."',`系统确认时间`='".$date."',`缴费时间`='".$date."',`代理费`='".$arr[1]."',`滞纳金`='".$arr[2]."' ,`状态`='2' WHERE id='".$arr[0]."'";
			$result = $conn->query($sql);
			//更新处理状态
			$sql_c = "SELECT 处理状态  FROM 专案_年费记录   WHERE id=".$arr[0]."";
			$result_c = $conn->query($sql_c);
			if($result_c->num_rows>0){
				while($rowc = $result_c->fetch_assoc()){
					$ThisStatu = $rowc['处理状态'];
					$ThisStatu = $ThisStatu.'2';
					$sql2 = "UPDATE `专案_年费记录` SET 处理状态 = '".$ThisStatu."' WHERE id='".$arr[0]."'";
					$result2 = $conn->query($sql2);
				}
			}
		}
		if($result){
			echo $FileName;
	//		echo $mass;
		}else{
	//		echo $sql;
			echo 0;
		}
		break;
	
	case "Charge":
		$costid = $_GET["costid"];
		
		$ret_arr = array(
			"state"=>"0",
			"message"=>"服务器错误",
			"data"=>array()
		);
		
		if(strlen($costid)>0){
			$sql = "UPDATE 专案_年费记录 SET 状态='1' WHERE FIND_IN_SET(id,'".$costid."')";
			if($conn->query($sql)){
				$ret_arr["state"] = "1";
				$ret_arr["message"] = "更改成功";
			}else{
				$ret_arr["message"] = "更改失败";
			}
		}else{
			$ret_arr["message"] = "更改失败";
		}
		$json = json_encode($ret_arr);
		echo $json;
		
		break;
		
	default:
		$ret_arr = array(
			"state"=>FALSE,
			"message"=>"没有对应的标志"
		);
		$json = json_encode($ret_arr);
		echo $json;
}

?>