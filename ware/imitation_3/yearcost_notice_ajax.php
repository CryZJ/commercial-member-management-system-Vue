<?php
//	header("Content-Type:application/json");
	require'../../AHeader.php';
	require"../../conn.php";
	require_once "../../classes/GetAnnualFeeList.php";//获取年费+案件数据
	
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
			$id_str = $_GET["costid"];
			$ret_arr = array(
				"state"=>"0",
				"message"=>"服务器错误",
				"data"=>array()
			);
			
			$sql = "SELECT id,案卷号,年度,金额 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$id_str."') ORDER BY 案卷号";
			$getannualfeedata = new GetAnnualFeeList($conn,$sql);
			$getannualfeedata->UseClass();
			if(!empty($getannualfeedata->sqldata_annualfee)){
				$i = 0;
				foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
					$ret_arr["data"][$i] = $row;
					$i++;
				}
				
				$ret_arr["state"] = "1";
				$ret_arr["message"] = "获取成功";
			}else{
				$ret_arr["message"] = "没有数据";
			}
			$json = json_encode($ret_arr);
			echo $json;
			
			break;
		
		
		default:
			echo '{"state":"0","message":"没有对应的标志"}';
			
	}
	
	$conn->close();
?>