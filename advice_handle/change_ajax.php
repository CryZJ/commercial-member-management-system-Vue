<?php
$my_flag = $_POST['my_flag'];

if($my_flag == "save"){
	$sqh = $_POST['sqh'];
	$change = $_POST['change'];
	$ajfl = $_POST["ajfl"];
	$return = "";
//	echo $sqh.$change;
	if($change=="待提交" || $change=="待受理" || $change=="待申请费" || $change=="申请中" || $change=="待登记费" || $change=="待证书" || $change=="年费中" || $change=="答辩补正"  || $change=="驳回复审" ){
		require("../conn.php");
		$sql_judge = "SELECT id FROM ".$ajfl."  WHERE 申请号='".$sqh."'";
		$result_judge = $conn->query($sql_judge);
		if($result_judge->num_rows>0){
			$sql = "UPDATE ".$ajfl."  SET 状态='".$change."' WHERE 申请号='".$sqh."'";
			$result = $conn->query($sql);
			if($result){
				$return = "更改成功!";
			}else{
				$return = "更改失败！";
			}
		}else{
			$return = "“".$ajfl."”中没有申请号为".$sqh."的案件";
		}
		
		echo $return;
		$conn->close();
	}
	if($change=="结案"){
		require("../conn.php");
		$sql_judge = "SELECT id FROM ".$ajfl."  WHERE 申请号='".$sqh."'";
		$result_judge = $conn->query($sql_judge);
		if($result_judge->num_rows>0){
			$sql = "UPDATE ".$ajfl."  SET 冻结状态='1'  WHERE 申请号='".$sqh."'";
			$result = $conn->query($sql);
			if($result){
				$return = "更改成功!";
			}else{
				$return = "更改失败！";
			}
		}else{
			$return = "“".$ajfl."”中没有申请号为".$sqh."的案件";
		}
		echo $return;
		$conn->close();
	}
	if($change=="结案恢复"){
		require("../conn.php");
		$sql_judge = "SELECT id FROM ".$ajfl."  WHERE 申请号='".$sqh."'";
		$result_judge = $conn->query($sql_judge);
		if($result_judge->num_rows>0){
			$sql = "UPDATE ".$ajfl."  SET 冻结状态='0' WHERE 申请号='".$sqh."'";
			$result = $conn->query($sql);
			if($result){
				$return = "更改成功!";
			}else{
				$return = "更改失败！";
			}
		}else{
			$return = "“".$ajfl."”中没有申请号为".$sqh."的案件";
		}
		
		echo $return;	
		$conn->close();
	}
}

?>