<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");


require("../../conn.php");
require_once "../../upload_func.php";//连接函数文件
$flag = $_POST['flag'];
	
	//案件登记详情的文件替换保存
	if($flag == "Upfiles"){
		$zc_id = $_POST['self_id'];
//		$des_str = $_POST['des'];
		$ret_data = "";
		if(count($_FILES)!=0){
			$dir = "../../filesave_zcjl/".$zc_id;
			foreach($_FILES as $ky => $fileinfo){
				$ret_path =  ajjlc_upfile($fileinfo,$dir);
				$path_sql = "filesave_zcjl/".$zc_id."/".pathinfo($ret_path,PATHINFO_BASENAME);
//				$sql = "INSERT INTO 支出记录文件(支出id,文件路径,上传时间,上传人) VALUES('".$zc_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				$sql = "INSERT INTO ".$expend_file_record."(支出id,文件路径,上传时间,上传人) VALUES('".$zc_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret_data .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
				}else{
					$ret_data .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
				}
			}
		}else{
			$ret_data .= "无文件上传！";
		}
		echo $ret_data;//返回的信息
	}


$conn->close();
?>