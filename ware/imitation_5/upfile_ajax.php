<?php
header('content-type:text/html;charset=utf-8');

	require("../../AHeader.php");

require("../../conn.php");
require_once "../../upload_func.php";//连接下载函数文件
$flag = $_POST['flag'];
//$id=$_GET['id'];
//$id=$_POST['id'];
//$conn1=mysqli_connect('localhost','root','123456','zlxt');
//	$query=mysqli_query($conn1,"UPDATE `申请人文件` SET `上传人`='".$user."' WHERE `申请人id`='".$id."';");
//	$query=mysql_query("UPDATE `申请人文件` SET `上传人`='{$user}' WHERE `申请人id`='{$ssid}';");
	//申请人详情的文件上传保存
	if($flag == 'uploadfile'){
		$conn1=mysqli_connect('localhost','root','123456','zlxt');
	$query=mysqli_query($conn1,"UPDATE `申请人文件` SET `上传人`='".$user."' WHERE `申请人id`='".$id."';");
		$djid = $_POST['djid'];
//		echo $djid;
		$des_str = $_POST['des'];
		
		$des = "";
		if(strpos($des_str, ",")){
			$des = explode(",", $des_str);
		}else{
			$des[0] = $des_str;
		}
//		print_r($des);
//		print_r($_FILES);
		$ret = '';
		
//		print_r($_FILES);
		
		$i = 0;
		foreach($_FILES as $ky => $fileinfo){
			$uppath = "../../client_file"."/".$djid;
			$ret_path = casemark_upload($fileinfo,$uppath);
			$file_arr = explode("/", $ret_path);
			$ret_path = "client_file"."/".$djid."/".$file_arr[count($file_arr)-1];
			$sql = "INSERT INTO 申请人文件(申请人id,文件路径,描述,上传时间,上传人) VALUES('".$djid."','".$ret_path."','".$des[$i]."','".date("Y-m-d H:i:s")."','".$user."') ";
			if($conn->query($sql)){
				$ret .= $file_arr[count($file_arr)-1]."保存成功\n";
			}else{
				$ret .= $file_arr[count($file_arr)-1]."保存失败\n";
				exit;
			}
			$i++;
		}
		
//		for($i=0;$i<count($des);$i++){
//			$uppath = "../../client_file"."/".$djid;
//			$ret_path = casemark_upload($_FILES[$i],$uppath);
//			$file_arr = explode("/", $ret_path);
//			$ret_path = "client_file"."/".$djid."/".$file_arr[count($file_arr)-1];
//			$sql = "INSERT INTO 申请人文件(申请人id,文件路径,描述,上传时间) VALUES('".$djid."','".$ret_path."','".$des[$i]."','".date("Y-m-d H:i:s")."') ";
//			if($conn->query($sql)){
//				$ret .= $file_arr[count($file_arr)-1]."保存成功\n";
//			}else{
//				$ret .= $file_arr[count($file_arr)-1]."保存失败\n";
//				exit;
//			}
//		}
//		$json = json_encode($ret);
		echo $ret;
	}
	


$conn->close();
?>