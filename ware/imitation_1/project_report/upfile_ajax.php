<?php
header('content-type:text/html;charset=utf-8');

require("../../../AHeader.php");
require("../../../conn.php");
require_once "../../../upload_func.php";//连接下载函数文件
$flag = $_REQUEST['flag'];

/*
 * 获取文件路径的文件名称(包含后缀)
 * */
function Getbasename($path){
	$path_arr = explode("/", $path);
	$file_basename = end($path_arr);
	return $file_basename;
}
	
	//日程管理上传文件
	if($flag == "uploadfile_dateworks"){
		$cid = $_POST["djid"];
		
		$ret = "";
		if(count($_FILES)>0){
			$dir = "../../../filesave_ProFile/".$cid;
			foreach($_FILES as $ky => $fileinfo){
				$ret_path = File_share($fileinfo,$dir);
				$savesql_path = "filesave_ProFile/".$cid."/".pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "INSERT INTO 项目日程文件(日程id,文件路径,上传时间,上传人) VALUES(";
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
	
	if($flag == "Upfile_gl"){
		$ret = "";
		if(count($_FILES) > 0){
			$dir = "../../../filesave_xmgl";
			foreach($_FILES as $ky => $fileinfo){
				$ret_path = File_share($fileinfo,$dir);
				$file_basename = Getbasename($ret_path);
				$savesql_path = "filesave_xmgl/".$file_basename;
				$sql = "INSERT INTO 项目文件管理(文件路径,上传时间,上传者) VALUES(";
				$sql .= "'".$savesql_path."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret .= $file_basename."保存成功\n";
				}else{
					$ret .= $file_basename."保存失败\n";
				}
			}
		}
		echo $ret;
		
	}

$conn->close();
?>