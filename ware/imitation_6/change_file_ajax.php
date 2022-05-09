<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");

require("../../conn.php");
require_once "../../upload_func.php";//连接函数文件
$flag = $_POST['flag'];
	
	//支出记录详情的文件替换保存
	if($flag == "changefile"){
		$id = $_POST['self_id'];
//		$des_str = $_POST['des'];
		$ret_data = "";
//		$sql_s = "SELECT 支出id,文件路径 FROM 支出记录文件 WHERE id = '".$id."'";
		$sql_s = "SELECT 支出id,文件路径 FROM ".$expend_file_record." WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$zc_id = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$zc_id = $row_s['支出id'];
				$former_path = $row_s['文件路径'];
			}
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
			if(!empty($zc_id)){
				$up_path = "../../filesave_zcjl/".$zc_id;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
	//				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$path_sql = "filesave_zcjl/".$zc_id."/".pathinfo($ret_path,PATHINFO_BASENAME);
//				$sql = "UPDATE 支出记录文件 SET 文件路径='".$path_sql."',上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id = '".$id."'";
				$sql = "UPDATE ".$expend_file_record." SET 文件路径='".$path_sql."',上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= pathinfo($ret_path,PATHINFO_BASENAME)."替换成功\n";
				}else{
					$ret_data .= pathinfo($ret_path,PATHINFO_BASENAME)."替换失败\n";
				}
			}else{
				$ret_data .= "“支出id”为空!\n";
			}
		}else{
			$ret_data .= "“支出记录文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息
	}


$conn->close();
?>