<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
require("../../conn.php");
require_once "../../upload_func.php";//连接函数文件
$flag = $_POST['flag'];
	
	//案件登记详情的文件替换保存
	if($flag == "changefile"){
		$id = $_POST['self_id'];
		$des_str = $_POST['des'];
		$ret_data = "";
		$sql_s = "SELECT 基本登记id,文件路径 FROM 办公_案件基本登记文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$djid = $row_s['基本登记id'];
				$former_path = $row_s['文件路径'];
			}
			if($djid != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk",$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				
				//保存新的文件
				$up_path = "../../casemark_file"."/".$djid;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
//				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$sql = "";
				$sql = "UPDATE 办公_案件基本登记文件 SET 文件路径='".$ret_path."',描述='".$des_str."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."替换成功\n";
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“办公_案件基本登记文件”中id为".$id."的基本登记id为空！\n";
			}
		}else{
			$ret_data .= "“办公_案件基本登记文件”中id没有".$id."\n";
		}

		echo $ret_data;//返回的信息
	}


$conn->close();
?>