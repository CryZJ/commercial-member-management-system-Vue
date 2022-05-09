<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
require("../../conn.php");
require_once "../../upload_func.php";//连接函数文件
$flag = $_POST['flag'];
	
	//申请人替换的文件替换保存
	if($flag == "changefile"){
		$id = $_POST['self_id'];
		$des_str = $_POST['des'];
		$ret_data = "";
		$sql_s = "SELECT 申请人id,文件路径 FROM 申请人文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$djid = $row_s['申请人id'];
				$former_path = $row_s['文件路径'];
			}
			if($djid != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk","../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				
				//保存新的文件
				$up_path = "../../client_file"."/".$djid;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$fileinfo_arr = explode("/", $ret_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$sql = "";
				$sql = "UPDATE 申请人文件 SET 文件路径='".$ret_path."',描述='".$des_str."',上传时间='".date("Y-m-d H:i:s")."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= $fileinfo_arr[count($fileinfo_arr)-1]."替换成功\n";
				}else{
					$ret_data .= $fileinfo_arr[count($fileinfo_arr)-1]."替换失败\n";
				}
			}else{
				$ret_data .= "“申请人文件”中id为".$id."的申请人id为空！\n";
			}
		}else{
			$ret_data .= "“申请人文件”中id没有".$id."\n";
		}

		echo $ret_data;//返回的信息
	}

	//申请人身份文件替换的文件替换保存
	if($flag == "changefile_2"){
		$id = $_POST['self_id'];
		$fileflag = $_POST['fileflag'];
		$ret_data = "";
		$sql_s = "SELECT ".$fileflag." FROM 申请人 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$former_path = $row_s[$fileflag];
			}
			//删除旧的文件
			if($former_path != ""){
				$del_path = iconv("utf-8", "gbk","../../".$former_path);
				if(file_exists($del_path)){
					unlink($del_path);
				}
			}
			//保存新的文件
			$up_path = "../../client_file"."/".$id;
			$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
			$fileinfo_arr = explode("/", $ret_path);
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$sql = "";
			$sql = "UPDATE 申请人 SET ".$fileflag."='".$ret_path."' WHERE id = '".$id."'";
			if($conn->query($sql)){
				$ret_data .= $fileinfo_arr[count($fileinfo_arr)-1]."替换成功\n";
			}else{
				$ret_data .= $fileinfo_arr[count($fileinfo_arr)-1]."替换失败\n";
			}
		}else{
			$ret_data .= "“申请人”中id没有".$id."\n";
		}

		echo $ret_data;//返回的信息
	}

$conn->close();
?>