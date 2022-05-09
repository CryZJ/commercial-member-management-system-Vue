<?php
require("../../AHeader.php");
require("../../conn.php");

$my_flag = $_REQUEST['my_flag'];

if($my_flag == "send_make"){
	$ajax_flag = $_POST['ajax_flag'];
	$userid_str = $_POST['userid_str'];
	$rowid_str = $_POST['rowid_str'];
	
	$userid_arr = explode(",", $userid_str);
	$rowid_arr = explode(",", $rowid_str);
	
	//待发送或已发送的再发送
	if($ajax_flag == "SendSoSend"){
		$ret = "";
		foreach($rowid_arr as $ky => $filerow_id){
			$file_path = "";
			$userid_send = "";
			$send_counter = "";
			$sql = "SELECT 文件路径,发送人用户id,发送状态 FROM 发送文件 WHERE id='".$filerow_id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$file_path = $row["文件路径"];
					$userid_send = $row["发送人用户id"];
					$send_counter = intval($row["发送状态"]);
				}
			}
			if((!empty($file_path)) && (!empty($userid_send))){
				$tmpname_arr = explode("/", $file_path);
				foreach($userid_arr as $ky_2 => $userid_accept){
					$sql_i = "INSERT INTO 接收文件(文件路径,发送人用户id,接收人用户id,发送时间) VALUES(";
					$sql_i .= "'".$file_path."','".$userid_send."','".$userid_accept."','".date("Y-m-d H:i:s")."')";
					$conn->query($sql_i);
				}
				$sql_u = "UPDATE 发送文件 SET 发送时间='".date("Y-m-d H:i:s")."',发送状态='".($send_counter+1)."' WHERE id='".$filerow_id."'";
				if($conn->query($sql_u)){
					$ret .= end($tmpname_arr)."发送成功\n";
				}else{
					$ret .= end($tmpname_arr)."发送失败\n";
				}
			}
		}
		echo $ret;
	}
	
	//接收后发送
	if($ajax_flag == "AcceptSoSend"){
		$ret = "";
		foreach($rowid_arr as $ky => $filerow_id){
			$file_path = "";
			$userid_send = "";
			$sql = "SELECT 文件路径,接收人用户id FROM 接收文件 WHERE id='".$filerow_id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$file_path = $row["文件路径"];
					$userid_send = $row["接收人用户id"];
				}
			}
			if((!empty($file_path)) && (!empty($userid_send))){
				$tmpname_arr = explode("/", $file_path);
				foreach($userid_arr as $ky_2 => $userid_accept){
					$sql_i = "INSERT INTO 接收文件(文件路径,发送人用户id,接收人用户id,发送时间) VALUES(";
					$sql_i .= "'".$file_path."','".$userid_send."','".$userid_accept."','".date("Y-m-d H:i:s")."')";
					if($conn->query($sql_i)){
						$ret .= end($tmpname_arr)."发送成功\n";
					}else{
						$ret .= end($tmpname_arr)."发送失败\n";
					}
				}
			}
		}
		echo $ret;
	}
}

$conn->close();
?>