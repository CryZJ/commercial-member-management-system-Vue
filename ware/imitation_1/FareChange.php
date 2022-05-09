<?php
	require'../../AHeader.php';
	require'../../conn.php';
	$flag = isset($_REQUEST["flag"]) ? $_REQUEST["flag"] : "";
	
	switch($flag){
		case"change":
			$messc = $_POST['MessC'];
			$ajh = $_POST['ajh'];
			$FId = $_POST['FId'];
			$useid = $_POST['useid'];
			$sql1 = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限 FROM 专案需交费用 WHERE 案卷号 = '".$ajh."' and 费用名称 = '".$FId."'";
			$result1 = $conn->query($sql1);
			if($result1->num_rows>0){
				while($row1 = $result1->fetch_assoc()){
					$fareid = $row1['id'];
					$FareName = $row1['费用名称'];
					$Fare = $row1['金额'];
				}
				$sql2 = "update 专案需交费用 set 金额='".$messc."' where id='".$fareid."' ";
				$result2 = $conn->query($sql2);
			}
			$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 WHERE 案卷号 = '".$ajh."' and 年度 = '".$FId."'";
			$result3 = $conn->query($sql3);
			if($result3->num_rows>0){
				while($row3 = $result3->fetch_assoc()){
					$fareid = $row3['id'];
					$FareName = $row3['费用名称'];
					$Fare = $row3['金额'];
				}
				$sql2 = "update 专案_年费记录 set 金额='".$messc."' where id='".$fareid."' ";
				$result2 = $conn->query($sql2);
			}
			if($result2){
				$FareMes = $FareName.'('.$Fare.'->'.$messc.')';
				$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
				$conn->query($AddHis);
				echo '操作成功';
			}else{
	//			echo '出现未知错误，请联系管理员';
				echo $sql2;
				echo $sql1;
			}
			break;
			
		case"del":
			$ajh = $_POST['ajh'];
			$FTab = $_POST['fareF'];
			$id = $_POST['id'];
			require'../../conn.php';
			switch($FTab){
				case 0:
					$sql4 = " update 专案需交费用 set 状态 = 9 where id = '".$id."' ";
					$result4 = $conn->query($sql4);
					$sql1 = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限 FROM 专案需交费用  where id = '".$id."'";
					$result1 = $conn->query($sql1);
					if($result1->num_rows>0){
						while($row1 = $result1->fetch_assoc()){
							$fareid = $row1['id'];
							$FareName = $row1['费用名称'];
							$Fare = $row1['金额'];
						}
					}
					echo 1;
					break;
				case 1:
					$sql4 = " update 专案_年费记录 set 状态 = 9 where id = '".$id."' ";
					$result4 = $conn->query($sql4);
					$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$id."'";
					$result3 = $conn->query($sql3);
					if($result3->num_rows>0){
						while($row3 = $result3->fetch_assoc()){
							$fareid = $row3['id'];
							$FareName = $row3['费用名称'];
							$Fare = $row3['金额'];
						}
					}
					echo 1;
					break;
				default:
					echo '非法操作,请联系管理员';
			}
			if($result4){
				$FareMes = $FareName.'('.$Fare.')';
				$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','删除费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
				$conn->query($AddHis);
			}
			break;
			
		case "FeeChanged":
			$costid = $_POST["costid"];
			$feeval = $_POST["feevalue"];
			$source = $_POST["source"];
			
			$ret_data = array(
				"state"=>"0",
				"message"=>"服务器错误"
			);
			if($source == "0"){//“专案需交费用”
				$sql = "UPDATE 专案需交费用 SET 金额='".$feeval."' WHERE id='".$costid."'";
				if($conn->query($sql)){
					$ret_data["state"] = "1";
					$ret_data["message"] = "修改成功";
				}else{
					$ret_data["message"] = "修改失败";
				}
			}else{//专案_年费记录
				$sql = "UPDATE 专案_年费记录 SET 金额='".$feeval."' WHERE id='".$costid."'";
				if($conn->query($sql)){
					$ret_data["state"] = "1";
					$ret_data["message"] = "修改成功";
				}else{
					$ret_data["message"] = "修改失败";
				}
			}
			$json = json_encode($ret_data);
			echo $json;
			break;	
		
		case "FeeDEL":
			$costid = $_POST["costid"];
			$source = $_POST["source"];
			
			$ret_data = array(
				"state"=>"0",
				"message"=>"服务器错误"
			);
			if($source == "0"){//“专案需交费用”
				$sql = "UPDATE 专案需交费用 SET 状态='9' WHERE id='".$costid."'";
				if($conn->query($sql)){
					$ret_data["state"] = "1";
					$ret_data["message"] = "修改成功";
				}else{
					$ret_data["message"] = "修改失败";
				}
			}else{//专案_年费记录
				$sql = "UPDATE 专案_年费记录 SET 状态='9' WHERE id='".$costid."'";
				if($conn->query($sql)){
					$ret_data["state"] = "1";
					$ret_data["message"] = "修改成功";
				}else{
					$ret_data["message"] = "修改失败";
				}
			}
			$json = json_encode($ret_data);
			echo $json;
			break;
			
		default :
			echo '{"state":"0","message":"没有对应的标志"}';
	}
	
	$conn->close();
?>