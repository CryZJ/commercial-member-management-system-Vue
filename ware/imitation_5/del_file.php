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
require("../../AHeader.php");
$flag = $_REQUEST['flag'];
require ("../../conn.php");
		
//删除专案件的文件
if ($flag == "ajdj") {
	$id = $_GET['id'];
	
	$ret_mag = "";
	
	$sql2 = "UPDATE 申请人文件  SET 删除状态='1' WHERE id='" . $id . "'";
	if ($conn -> query($sql2)) {
		$ret_mag .= "删除记录成功";
		if($admin){
			$sql = "SELECT 文件路径  FROM 申请人文件  WHERE id='" . $id . "'";
			$result = $conn -> query($sql);
			if ($result -> num_rows > 0){
				$path = "";
				while ($row = $result -> fetch_assoc()) {
					$path = $row['文件路径'];
				}
				if($path != ""){
					$path = "../../" . $path;
					$path_gbk = change_encode($path);
					if(file_exists($path_gbk)){
						if(unlink($path_gbk)) {
							$ret_mag .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
						}
					}
				}
			}
		}
	} else {
		$ret_mag .= "删除记录失败";
	}
	echo $ret_mag;
}



$conn -> close();
?>