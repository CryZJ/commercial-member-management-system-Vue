<?php
header('content-type:text/html;charset=utf-8');

	require'../../../AHeader.php';

require("../../../conn.php");
require_once "../../../upload_func.php";
	$flag = $_REQUEST['flag'];
	
	//新增海关监控的信息保存
	if($flag == "new_monitor_hg"){
		$ajh = $_GET['ajh'];
		$send_str = $_GET['send_str'];//格式:监控名|金额|提醒日期|截止日期|备注
//		echo $ajh ."/" .$send_str;
		$ret_mag = "";
		//检测案件是否存在
		if(isset($ajh)){
			$sql_s = "SELECT id FROM 海关_案件 WHERE 案卷号='".$ajh."'";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows>0){
				$send_arr = explode("|", $send_str);
				$sql_i = "INSERT INTO 海关_监控(案卷号,监控名,金额,提醒日期,截止日期,备注) VALUES(";
				$sql_i .= "'".$ajh."','".$send_arr[0]."','".$send_arr[1]."','".$send_arr[2]."','".$send_arr[3]."','".$send_arr[4]."')";
				if($conn->query($sql_i)){
					$ret_mag = "保存成功";
				}else{
					$ret_mag = "保存失败";
				}
				
			}else{
				$ret_mag = "“海关_案件”中没有案卷号为".$ajh."的案件";
			}
		}else{
			$ret_mag = "案卷号为空！";
		}
		
		echo $ret_mag;
		
	}
	
	//保存新建软件监控的文件
	if($flag == "new_monitor_upfile_hg"){
		$ajh = $_POST['ajh'];
//		echo $ajh."\n";
//		print_r($_FILES);
		$ret_mag = "";
		//检测案件是否存在
		if(isset($ajh)){
			$sql_s = "SELECT id FROM 海关_案件 WHERE 案卷号='".$ajh."'";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows>0){
				$save_path = "../../../filesave_hg/".$ajh;
				$ret_mag = uploadFile_rj($_FILES['myfile'],$save_path);
				$filename_arr = explode("/", $ret_mag['dest']);
				$file_name = $filename_arr[count($filename_arr)-1];
				$save_sqlpath = "filesave_hg/".$ajh."/".$file_name;
				$sql_i = "INSERT INTO 海关_文件(案卷号,操作人,操作时间,文件路径,文件名) VALUES(";
				$sql_i .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$save_sqlpath."','".$file_name."')";
				if($conn->query($sql_i)){
					$sql_s = "SELECT id FROM 海关_文件  WHERE 案卷号='".$ajh."' ORDER BY id DESC LIMIT 1";
					$result_s = $conn->query($sql_s);
					if($result_s->num_rows>0){
						while($row_s = $result_s->fetch_assoc()){
							$file_id = $row_s['id'];
						}
						$sql_s2 = "SELECT id FROM 海关_监控  WHERE 案卷号='".$ajh."' ORDER BY id DESC LIMIT 1";
						$result_s2 = $conn->query($sql_s2);
						if($result_s2->num_rows>0){
							while($row_s2 = $result_s2->fetch_assoc()){
								$monitor_id = $row_s2['id'];
							}
							$sql_u = "UPDATE 海关_监控  SET 文件id = '".$file_id."' WHERE id='".$monitor_id."'";
							if($conn->query($sql_u)){
								$ret_mag = "保存成功";
							}else{
								$ret_mag = "保存失败";
							}
						}else{
							$ret_mag = "“海关_监控”没有相应的监控";
						}
					}else{
						$ret_mag = "“海关_案件”中没有案卷号为".$ajh."的监控";
					}
				}else{
					$ret_mag = "海关_文件保存失败";
				}
			}else{
				$ret_mag = "“海关_案件”中没有案卷号为".$ajh."的案件";
			}
		}else{
			$ret_mag = "案卷号为空！";
		}
		
		echo $ret_mag;
	}
	
	if($flag == 'ChangeSitu'){
		$MesId = $_GET['id'];
		$sql_C = "update 海关_监控  set 状态=1 where id = '".$MesId."' ";
		if($conn->query($sql_C)){
			$ret_mag = "操作成功";
		}else{
			$ret_mag = "操作失败,请联系管理员";
		}
		echo $ret_mag;
	}
	if($flag == 'selectMes'){
		$Name = $_GET['Name'];
		$sql = "SELECT 流程,金额,监控天数 FROM `案件流程设置` where 流程='".$Name ."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$fare = $row['金额'];
				$day  = $row['监控天数'];
			}
		}
		echo $fare.','.$day;
	}
	if($flag == 'DJId'){
		$mes = $_GET['mes'];
		$ajh = $_GET['ajh'];
		$Save_DJ = "update `海关_案件` set `备案号`='".$mes."' where 案卷号='".$ajh."'";
		$result_Save = $conn->query($Save_DJ);
		if($result_Save){
			echo 1;
		}else{
			echo 0;
		}
	}


$conn->close();



?>