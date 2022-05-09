<?php
header('content-type:text/html;charset=utf-8');

require("../../AHeader.php");
require("../../conn.php");
require_once "../../upload_func.php";//连接下载函数文件

/*
 * 获取文件路径的文件名称(包含后缀)
 * */
function Getbasename($path){
	$path_arr = explode("/", $path);
	$file_basename = end($path_arr);
	return $file_basename;
}

$flag = $_POST['flag'];
	
	//案件登记详情的文件上传保存
	if($flag == 'uploadfile'){
		$djid = $_POST['djid'];
//		echo $djid;
		$des_str = $_POST['des'];
		$des = "";
		if(strpos($des_str, ",")){
			$des = explode(",", $des_str);
		}else{
			$des[0] = $des_str;
		}
//		print_r($_FILES);
		$ret = '';
		if(count($_FILES)>0){
			$i=0;
			foreach($_FILES as $ky => $fileinfo){
				$uppath = "../../casemark_file"."/".$djid;
				$ret_path = casemark_upload($fileinfo,$uppath);
				$sql = "INSERT INTO 办公_案件基本登记文件(基本登记id,文件路径,描述) VALUES('".$djid."','".$ret_path."','".$des[$i]."') ";
				if($conn->query($sql)){
					$ret .= basename($ret_path)."保存成功\n";
				}else{
					$ret .= basename($ret_path)."保存失败\n";
				}
				$i++;
			}
		}
//		$json = json_encode($ret);
		echo $ret;
	}
	
	//上传分享文件
	if($flag == 'uploadfile_share'){
		$ret = '';
		foreach($_FILES as $ky => $fileinfo){
			$uppath = "../../filesave_share";
			$ret_path = File_share($fileinfo,$uppath);
			$save_path = "filesave_share/".pathinfo($ret_path,PATHINFO_BASENAME);
			$sql = "INSERT INTO 共享文件(上传人,上传时间,文件路径) VALUES(";
			$sql .= "'".$name."','".date("Y-m-d H:s:i")."','".$save_path."')";
			if($conn->query($sql)){
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
			}else{
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
			}
		}
		echo $ret;
	}
	
	//上传个人文件
	if($flag == "upfile_self"){
		$ret = '';
		foreach($_FILES as $ky => $fileinfo){
			$uppath = "../../filesave_self/".$userid;
			$ret_path = File_share($fileinfo,$uppath);
			$save_path = "filesave_self/".$userid."/".pathinfo($ret_path,PATHINFO_BASENAME);
			$sql = "INSERT INTO 个人文件(上传用户id,上传人,上传时间,文件路径) VALUES(";
			$sql .= "'".$userid."','".$name."','".date("Y-m-d H:s:i")."','".$save_path."')";
			if($conn->query($sql)){
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
			}else{
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
			}
		}
		echo $ret;
	}
	
	//发送文件保存
	if($flag == "send_file"){
		$ret = '';
		foreach($_FILES as $ky => $fileinfo){
			$uppath = "../../filesave_send";
			$ret_path = File_share($fileinfo,$uppath);
			$save_path = "filesave_send/".Getbasename($ret_path);
			$sql = "INSERT INTO 发送文件(发送人用户id,文件路径,上传时间) VALUES(";
			$sql .= "'".$userid."','".$save_path."','".date("Y-m-d H:s:i")."')";
			if($conn->query($sql)){
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
			}else{
				$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
			}
		}
		echo $ret;
	}
	
	//日程管理上传文件
	if($flag == "uploadfile_dateworks"){
		$cid = $_POST["djid"];
		
		$ret = "";
		if(count($_FILES)>0){
			$dir = "../../filesave_datework/".$cid;
			foreach($_FILES as $ky => $fileinfo){
				$ret_path = File_share($fileinfo,$dir);
				$savesql_path = "filesave_datework/".$cid."/".pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "INSERT INTO 日程文件(日程id,文件路径,上传时间,上传人) VALUES(";
				$sql .= "'".$cid."','".$savesql_path."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
				}else{
					$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
				}
			}
		}
		echo $ret;
	}

$conn->close();
?>