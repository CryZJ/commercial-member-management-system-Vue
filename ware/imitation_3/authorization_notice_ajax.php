<?php
//	header("Content-Type:application/json");
	require'../../AHeader.php';
	require"../../conn.php";
	require_once "../../classes/CheckCostOther.php";
	
	$flag = isset($_REQUEST["flag"])? $_REQUEST["flag"] : "";
	
	switch($flag){
		case "GetContacts":
			$applicant_id = $_GET["applicant_id"];
			
			$ret_arr = array(
				"state"=>"0",
				"message"=>"服务器错误",
				"data"=>array()
			);
			
			$sql = "SELECT 姓名,固话,手机,邮箱 FROM 联系人 WHERE FIND_IN_SET(申请人id,'".$applicant_id."') LIMIT 1";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$ret_arr["data"] = $row;
				}
				$ret_arr["state"]="1";
				$ret_arr["message"]="获取成功";
			}else{
				$ret_arr["message"]="无数据";
			}
			
			$json = json_encode($ret_arr);
			echo $json;
			
			break;
		
		case "GetCostData":
			$costid = $_GET["costid"];
			
			$ret_arr = array(
				"state"=>"0",
				"message"=>"服务器错误",
				"data"=>array()
			);
			
			$sql = "SELECT id,案卷号,费用名称,年度,金额 FROM 专案需交费用 WHERE FIND_IN_SET(id,'".$costid."')";
			$getdata = new CheckCostOther($conn,$sql);
			$getdata->UsingClass();
			if($getdata->sqldata_count > 0){
				$application_code = array();//申请号
				foreach($getdata->sqldata_return as $index => $datainfo){
					if(!array_key_exists($datainfo["申请号"], $application_code)){
						$application_code[$datainfo["申请号"]]["申请号"] = $datainfo["申请号"];
						$application_code[$datainfo["申请号"]]["申请日"] = $datainfo["申请日"];
						$application_code[$datainfo["申请号"]]["专利名称"] = $datainfo["专利名称"];
						$application_code[$datainfo["申请号"]]["年费"] = 0;
						$application_code[$datainfo["申请号"]]["年度"] = 0;
						$application_code[$datainfo["申请号"]]["登记费"] = 0;
					}
				}
				foreach($getdata->sqldata_return as $index => $datainfo){
					if($datainfo["费用名称"] == "年费"){
						$application_code[$datainfo["申请号"]]["年费"] = $datainfo["金额"];
						$application_code[$datainfo["申请号"]]["年度"] = $datainfo["年度"];
					}else{
						$application_code[$datainfo["申请号"]]["登记费"] = floatval($application_code[$datainfo["申请号"]]["登记费"]) + floatval($datainfo["金额"]);
					}
				}
				foreach($application_code as $index => $datainfo){
					$ret_arr["data"][] = $datainfo;
				}
				$ret_arr["state"] = "1";
				$ret_arr["message"] = "获取成功";
			}else{
				$ret_arr["message"] = "没有数据";
			}
			$json = json_encode($ret_arr);
			echo $json;
			
			break;
		
		case "UpdateCostState";
			$costid = $_GET["costid"];
			$application_number = $_GET["application_number"];
			
			$ret_arr = array(
				"state"=>"0",
				"message"=>"服务器错误",
				"data"=>array()
			);
			//更新费用状态及文件名称
			//获取毫秒级时间戳
			list($msec, $sec) = explode(' ', microtime());
		   	$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
		   	$FileName = $msectime.$userid.'.docx';//文件名
			$sql = "UPDATE 专案需交费用 SET 状态='4',通知书生成日期='".date("Y-m-d")."',通知书名='".$FileName."' WHERE FIND_IN_SET(id,'".$costid."')";
			if($conn->query($sql)){
				$ret_arr["state"] = "1";
				$ret_arr["message"] = "更新费用状态成功，";
				$ret_arr["data"]["文件名称"] = $FileName;
				$ret_arr["data"]["sql1"] = $sql;
				//更新案件状态
				$sql = "UPDATE 专利信息 set 通知书状态 = '1' WHERE FIND_IN_SET(申请号,'".$application_number."') ";
				if($conn->query($sql)){
					$ret_arr["message"] .= "相应案件通知书状态更新成功";
				}else{
					$ret_arr["message"] .= "相应案件通知书状态更新失败";
				}
				$ret_arr["data"]["sql2"] = $sql;
			}else{
				$ret_arr["message"] = "更新费用状态失败";
			}
			$json = json_encode($ret_arr);
			echo $json;
			
			break;
		default:
			echo '{"state":"0","message":"没有对应的标志"}';
			
	}
	
	$conn->close();
?>