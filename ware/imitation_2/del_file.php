<?php
//字符串编码互换utf-8转gbk或gbk转utf-8
function change_encode($str) {
	$ret_str = $str;
	$encode = mb_detect_encoding($str);
	//获取字符串的编码格式
	if ($encode == "UTF-8") {
		$ret_str = iconv("UTF-8", "GBK", $str);
	}
	if ($encode == "GBK") {
		$ret_str = iconv("GBK", "UTF-8", $str);
	}
	return $ret_str;
}

//获取做什么的标志
$flag = $_REQUEST['flag'];
require ("../../conn.php");
require("../../AHeader.php");		
		//删除办公_案件基本登记的文件
		if ($flag == "ajdj") {
			$id = $_GET['id'];
			
			$ret_msg = "";
			
			$sql2 = "UPDATE 办公_案件基本登记文件  SET 删除状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 文件路径  FROM 办公_案件基本登记文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if($result -> num_rows > 0){
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['文件路径'];
						}
						if($path != ""){
							$path_gbk = change_encode($path);
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}
		
		//删除申请文件
		if ($flag == "sqwj") {
			$id = $_GET['id'];
			$sql = "SELECT 文件路径  FROM 案卷流程及文档  WHERE id='" . $id . "'";
			$result = $conn -> query($sql);
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$path = $row['文件路径'];
				}
				$path = "../../" . $path;
				$path = change_encode($path);
				if (file_exists($path)) {
					if (unlink($path)) {
						$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
						if ($conn -> query($sql2)) {
							echo "3";
							//文件删除成功
						} else {
							echo "2";
							//文件已删除状态未改
						}
					} else {
						echo "1";
						//删除文件失败
					}
				} else {
					$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
					if ($conn -> query($sql2)) {
						echo "3";
						//文件删除成功
					} else {
						echo "2";
						//文件已删除状态未改
					}
				}
			} else {
				echo "0";
				//数据库无这条记录
			}
		}


$conn -> close();
?>