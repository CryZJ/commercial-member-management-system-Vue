<?php
require("../../AHeader.php");
require("../../conn.php");

$my_flag = $_REQUEST['my_flag'];
//$my_flag = $_POST['my_flag'];

/*
 * 获取文件路径的文件名称(包含后缀)
 * */
function Getbasename($path){
	$path_arr = explode("/", $path);
	$file_basename = end($path_arr);
	return $file_basename;
}

//上传文件删除
if($my_flag == "del_send"){
	$str_id = $_POST['rowid_str'];
	@$arr_id = explode(",", $str_id);
//	print_r($arr_id);
	$return = "";
	foreach($arr_id as $key_0 => $value_0){
		$file_name='';
		$sql = "SELECT 文件路径  FROM 发送文件 WHERE id='".$value_0."'";
		$result = $conn->query($sql);
		if($result->num_rows >0 ){
			while($row = $result->fetch_assoc()){
				$file_name = $row['文件路径'];
			}
			if($file_name != ''){
				$upload_path = "../../".$file_name;
				$upload_path = iconv("utf-8", "gbk", $upload_path);
				if(file_exists($upload_path)){
					if(unlink($upload_path)){
						$sql = "UPDATE 发送文件 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$value_0."'";
						if($conn->query($sql)){
							$return .= Getbasename($file_name)."删除成功，\n";
						}else{
							$return .= Getbasename($file_name)."删除失败，\n";
						}
					}
				}else{
					$sql = "UPDATE 发送文件 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$value_0."'";
					if($conn->query($sql)){
						$return .= Getbasename($file_name)."删除成功，\n";
					}else{
						$return .= Getbasename($file_name)."删除失败，\n";
					}
				}
			}
		}else{
			$return .= "删除失败";
		}
	}
	echo $return;	
}

//删除“已发送文件”
if($my_flag == "delete_After_send"){
	$str_id = $_POST['rowid_str'];
	@$arr_id = explode(",", $str_id);
//	print_r($arr_id);
	$return = "";
	foreach($arr_id as $key_0 => $value_0){
		$file_name='';
		$sql = "SELECT 文件路径  FROM 发送文件 WHERE id='".$value_0."'";
		$result = $conn->query($sql);
		if($result->num_rows >0 ){
			while($row = $result->fetch_assoc()){
				$file_name = $row['文件路径'];
			}
			if($file_name != ''){
				$sql = "UPDATE 发送文件 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$value_0."'";
				if($conn->query($sql)){
					$return .= Getbasename($file_name)."删除成功，\n";
				}else{
					$return .= Getbasename($file_name)."删除失败，\n";
				}
			}
		}else{
			$return .= "删除失败";
		}
	}
	echo $return;
}
//删除“已接收文件”
if($my_flag == "delete_After_accept"){
	$str_id = $_POST['rowid_str'];
	@$arr_id = explode(",", $str_id);
//	print_r($arr_id);
	$return = "";
	foreach($arr_id as $key_0 => $value_0){
		$file_name='';
		$sql = "SELECT 文件路径  FROM 接收文件 WHERE id='".$value_0."'";
		$result = $conn->query($sql);
		if($result->num_rows >0 ){
			while($row = $result->fetch_assoc()){
				$file_name = $row['文件路径'];
			}
			if($file_name != ''){
				$sql = "UPDATE 接收文件 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$value_0."'";
				if($conn->query($sql)){
					$return .= Getbasename($file_name)."删除成功，\n";
				}else{
					$return .= Getbasename($file_name)."删除失败，\n";
				}
			}
		}else{
			$return .= "删除失败";
		}
	}
	echo $return;
}

//删除单个分享文件
if($my_flag == 'delshare_one'){
	$id = $_POST['id'];
	$file_name = '';
	$return = '';
	
	
	$sql = "UPDATE 共享文件 SET 删除状态='1' WHERE id='".$id."'";
	if($conn->query($sql)){
		$return .= "删除记录成功";
		if($admin){
			//获取文件名称
			$sql = "SELECT 文件路径  FROM 共享文件  WHERE id='".$id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				$file_name = "";
				while($row = $result->fetch_assoc()){
					$file_name = $row['文件路径'];
				}
				if($file_name != ''){
					$path = "../../".$file_name;
					$path = iconv("utf-8", "gbk", $path);
					if(file_exists($path)){
						$return .= ";\n".pathinfo($file_name,PATHINFO_BASENAME)."删除成功";
					}
				}
			}
		}
	}else{
		$return .= "删除记录失败";
	}
	echo $return;
}

//删除多个分享文件
if($my_flag == "DeleteAll_share"){
	$str_id = $_GET['str_id'];
	$arr_id = "";
	$ret="";
	if(strpos($str_id, ",")){
		$arr_id = explode(",", $str_id);
	}else{
		$arr_id[0] = $str_id;
	}
	if($arr_id != ""){
		foreach($arr_id as $ky => $id){
			$sql = "UPDATE 共享文件 SET 删除状态='1' WHERE id='".$id."'";
			if($conn->query($sql)){
				$ret .= "删除记录成功，";
				if($admin){
					$sql = "SELECT 文件路径 FROM 共享文件 WHERE id='".$id."'";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
							if($row['文件路径'] != ""){
								$path = "../../".$row['文件路径'];
								$path_gbk = iconv("utf-8", "gbk", $path);
								if(file_exists($path_gbk)){
									if(unlink($path_gbk)){
										$ret .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
									}
								}
							}
						}
					}
				}
			}else{
				$ret .= "删除记录失败，";
			}
		}
	}else{
		$ret .= "无数据传来!";
	}
	echo $ret;
}

//删除单个 个人文件
if($my_flag == 'delself_one'){
	$id = $_POST['id'];
	$file_name = '';
	$return = '';
	
	//获取文件名称
	$sql = "SELECT 文件路径  FROM 个人文件  WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$file_name = $row['文件路径'];
		}
	}
	if($file_name != ''){
		$path = "../../".$file_name;
		$path = iconv("utf-8", "gbk", $path);
		if(file_exists($path)){
			if(unlink($path)){
				$sql = "UPDATE 个人文件 SET 删除状态='1' WHERE id='".$id."'";
				if($conn->query($sql)){
					$return .= pathinfo($file_name,PATHINFO_BASENAME)."删除成功";
				}else{
					$return .= pathinfo($file_name,PATHINFO_BASENAME)."删除失败";
				}
			}
		}else{
			$sql = "UPDATE 个人文件 SET 删除状态='1' WHERE id='".$id."'";
			if($conn->query($sql)){
				$return .= pathinfo($file_name,PATHINFO_BASENAME)."删除成功";
			}else{
				$return .= pathinfo($file_name,PATHINFO_BASENAME)."删除失败";
			}
		}
	}
	echo $return;
}

//删除多个个人文件
if($my_flag == "DeleteAll_self"){
	$str_id = $_GET['str_id'];
	$arr_id = "";
	$ret="";
	if(strpos($str_id, ",")){
		$arr_id = explode(",", $str_id);
	}else{
		$arr_id[0] = $str_id;
	}
	if($arr_id != ""){
		foreach($arr_id as $ky => $id){
			$sql = "SELECT 文件路径 FROM 个人文件 WHERE id='".$id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$path = "../../".$row['文件路径'];
					$path = iconv("utf-8", "gbk", $path);
					if(file_exists($path)){
						if(unlink($path)){
							$sql = "UPDATE 个人文件 SET 删除状态='1' WHERE id='".$id."'";
							if($conn->query($sql)){
								$ret .= pathinfo($row['文件路径'],PATHINFO_BASENAME)."删除成功"."\n";
							}else{
								$ret .= pathinfo($row['文件路径'],PATHINFO_BASENAME)."删除失败"."\n";
							}
						}
					}else{
						$sql = "UPDATE 个人文件 SET 删除状态='1' WHERE id='".$id."'";
						if($conn->query($sql)){
							$ret .= pathinfo($row['文件路径'],PATHINFO_BASENAME)."删除成功"."\n";
						}else{
							$ret .= pathinfo($row['文件路径'],PATHINFO_BASENAME)."删除失败"."\n";
						}
					}
				}
			}
		}
	}else{
		$ret .= "无数据传来!";
	}
	
	echo $ret;
}


$conn->close();	
?>