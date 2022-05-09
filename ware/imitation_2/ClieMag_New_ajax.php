<?php
require("../../AHeader.php");
require("../../conn.php");

$my_flag = $_REQUEST['my_flag'];
	
	
	//判断手机号是否存在
	if($my_flag == "Judge_phone"){
		$phone_num = $_GET['phone_num'];
		
		$ret = "";
		$sql = "SELECT 客户 FROM 客户管理 WHERE 手机='".$phone_num."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$kh = $row['客户'];
			}
			$ret['result'] = "success";
			$ret['kh'] = $kh;
		}else{
			$ret['result'] = "failure";
		}
		//返回数据
		if($ret != ""){
			$json = json_encode($ret);
			echo $json;
		}
	}
	
	//保存表“客户管理”信息
	if($my_flag == "Savedata_khjb"){
		$data_kh = $_GET['data_kh'];
		$data_lxr = $_GET['data_lxr'];
		
		$arr_kh = explode("#$#", $data_kh);
		$arr_lxr = explode("#$#", $data_lxr);
		
		$ret = "";
		$sql = "INSERT INTO 客户管理(客户,客户类型,备注,联系人,手机,固话,邮箱,微信,QQ) VALUES(";
		$sql .= "'".$arr_kh[0]."','".$arr_kh[1]."','".$arr_kh[2]."','".$arr_lxr[0]."','".$arr_lxr[1]."','".$arr_lxr[2]."','".$arr_lxr[3]."','".$arr_lxr[4]."','".$arr_lxr[5]."')";
		if($conn->query($sql)){
			$ret['result'] = "success";
			$ret['id'] = $conn->insert_id;
		}else{
			$ret['result'] = "failure";
			$ret['sql'] = $sql;
		}
		//返回数据
		if($ret != ""){
			$json = json_encode($ret);
			echo $json;
		}
	}
	//更新客户的信息
	if($my_flag == "Update_khjb"){
		$id = $_GET['id'];
		$data_kh = $_GET['data_kh'];
		$data_lxr = $_GET['data_lxr'];
		
		$arr_kh = explode("#$#", $data_kh);
		$arr_lxr = explode("#$#", $data_lxr);
		
		$ret = "";
		$sql = "UPDATE 客户管理 SET 客户='".$arr_kh[0]."',客户类型='".$arr_kh[1]."',备注='".$arr_kh[2]."',联系人='".$arr_lxr[0]."',手机='".$arr_lxr[1]."',固话='".$arr_lxr[2]."',邮箱='".$arr_lxr[3]."',微信='".$arr_lxr[4]."',QQ='".$arr_lxr[5]."' WHERE id='".$id."'";
		if($conn->query($sql)){
			$ret['result'] = "success";
		}else{
			$ret['result'] = "failure";
			$ret['sql'] = $sql;
		}
		//返回数据
		if($ret != ""){
			$json = json_encode($ret);
			echo $json;
		}
	}

	//保存会谈信息
	if($my_flag == "Savedata_info"){
		$id = $_GET['id'];
		$str_data = $_GET['str_data'];
		
		$arr_data = explode("#$#", $str_data);
		
		$ret="";
		$sql = "INSERT INTO 会谈信息(客户id,本次联系时间,会谈详情,下次联系时间,备注) VALUES(";
		$sql .= "'".$id."','".$arr_data[0]."','".$arr_data[1]."','".$arr_data[2]."','".$arr_data[3]."')";
		if($conn->query($sql)){
			$ret['result'] = "success";
			//与日程管理关联起来
			$sql = "SELECT 客户 FROM 客户管理 WHERE id='".$id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				$kh_name ="";
				while($row = $result->fetch_assoc()){
					$kh_name = $row["客户"];
				}
				$sql = "INSERT INTO 日程设置(用户id,事件名,事件时间,创建时间,备注) VALUES(";
				$sql .= "'".$userid."','联系客户：".$kh_name."','".$arr_data[2]."','".date("Y-m-d H:i:s")."','来自“客户管理”')";
				$conn->query($sql);
			}
		}else{
			$ret['result'] = "failure";
			$ret['sql'] = $sql;
		}
		//返回数据
		if($ret != ""){
			$json = json_encode($ret);
			echo $json;
		}
	}
	
	//获取填充信息
	if($my_flag == "GetData"){
		$id = $_GET['id'];
		
		$ret = "";
		$sql = "SELECT 客户,客户类型,备注,联系人,手机,固话,邮箱,微信,QQ FROM 客户管理 WHERE id='".$id."'";
		$result = $conn->query($sql);
		$ret["kh"] = "";
		if($result->num_rows>0){
			$ret["result"] = "success";
			while($row = $result->fetch_assoc()){
				$ret["kh"][0] = $row["客户"];
				$ret["kh"][1] = $row["客户类型"];
				$ret["kh"][2] = $row["备注"];
				$ret["kh"][3] = $row["联系人"];
				$ret["kh"][4] = $row["手机"];
				$ret["kh"][5] = $row["固话"];
				$ret["kh"][6] = $row["邮箱"];
				$ret["kh"][7] = $row["微信"];
				$ret["kh"][8] = $row["QQ"];
			}
			$sql = "SELECT 本次联系时间,下次联系时间,会谈详情,备注 FROM 会谈信息 WHERE 客户id='".$id."'";
			$result = $conn->query($sql);
			$ret['info'] = "";
			$ret["info_num"] = "0";
			if($result->num_rows>0){
				$i=0;
				while($row = $result->fetch_assoc()){
					$ret['info'][$i]["本次联系时间"] = $row["本次联系时间"];
					$ret['info'][$i]["会谈详情"] = $row["会谈详情"];
					$ret['info'][$i]["下次联系时间"] = $row["下次联系时间"];
					$ret['info'][$i]["备注"] = $row["备注"];
					$i++;
				}
				$ret["info_num"] = $i;
			}
		}else{
			$ret["result"] = "failure";
		}
		//返回数据
		if($ret != ""){
			$json = json_encode($ret);
			echo $json;
		}
	}
	
$conn->close();
?>