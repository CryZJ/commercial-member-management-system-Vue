<?php
require("../AHeader.php");


$my_flag = $_POST['my_flag'];

if($my_flag == "send_make"){
	$str_neme = $_POST['member_name'];
	$str_id = $_POST['accept_id'];
	//判断是否为多人
	if(strpos($str_neme, ",")===FALSE){
		$arr_name[0] = $str_neme;//单人
	}else{
		$arr_name = explode(",", $str_neme);//多人
	}
	
	
//	echo $str_id. $str_neme;
	require("../conn.php");
	$sql = "SELECT id,文件名称  FROM 临时文件  WHERE id='".$str_id."'";
	$result = $conn->query($sql);
	$ret_data = "";
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$path = "../tmp_fileupload/".$row['文件名称'];
			$path = iconv("UTF-8","gb2312",$path);//改变编码使之能用中文路径
			$file_name = time()."_".$row['文件名称'];
			$mial_path = "../mail_file/".$file_name;
			$mial_path = iconv("UTF-8","gb2312",$mial_path);//改变编码使之能用中文路径
			if(!copy($path,$mial_path)){
				$ret_data .= '文件上传失败';
			}else{
				foreach($arr_name as $key_1 => $value_1){
					$send_name_id = "";
					$sql ="SELECT id FROM 用户 WHERE 名称='".$value_1."'";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
							$send_name_id = $row['id'];
						}
					}
					if(!empty($send_name_id)){
						$sql = "INSERT INTO 发送文件(文件路径,上传时间,发送人用户id,发送状态,发送时间) VALUES(";
						$sql .= "'".$file_name."','".date("Y-m-d H:i:s")."','".$userid."','1','".date("Y-m-d H:i:s")."')";
						if($conn->query($sql)){
							$sql = "INSERT INTO 接收文件(文件路径,发送人用户id,发送时间,接收人用户id) VALUES(";
							$sql .= "'".$file_name."','".$userid."','".date("Y-m-d H:i:s")."','".$send_name_id."')";
							if(!$conn->query($sql)){
								$ret_data .= $value_1."“发送失败3\n";
							}
						}else{
							$ret_data .= $value_1."“发送失败2\n";
						}
					}else{
						$ret_data .= $value_1."“发送失败1\n";
					}
				}
			}
		}
	}else{
		$ret_data .=  "发送失败！";
	}
	echo $ret_data;
	 
	$conn->close();
}
?>