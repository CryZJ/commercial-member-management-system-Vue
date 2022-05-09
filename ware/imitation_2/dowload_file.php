<?php
$str_id = $_POST['xtid'];

require("../../conn.php");

$tmp_filename = "tmp2.zip";
if(file_exists($tmp_filename)){
	unlink($tmp_filename);
}
$zip = new ZipArchive();
$zip->open($tmp_filename,ZipArchive::OVERWRITE);

$sql = "SELECT id,文件路径 FROM 接收文件 WHERE FIND_IN_SET(id,'".$str_id."')";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$tmp_path = "";
		$tmp_path_gbk = "";
		$tmp_path_arr = "";
		
		$tmp_path = "../../".$row['文件路径'];
		$tmp_path_gbk = iconv("utf-8", "gbk", $tmp_path);
		$tmp_path_arr = explode("/", $tmp_path);
		
		if(file_exists($tmp_path_gbk)){
			$filedata = file_get_contents($tmp_path_gbk);
			if($filedata){
				$zip ->addFromString(end($tmp_path_arr),$filedata);
				//更新数据库状态
				$sql = "UPDATE 接收文件 SET 接收状态='1',接收时间='".date("Y-m-d H:i:s")."' WHERE id='".$row['id']."'";
				$conn->query($sql);
			}
		}
	}
}


$zip->close();

$nowtime = date("Y-m-d");
if(file_exists($tmp_filename)){
	header('content-disposition:attachment;filename='.$nowtime.'.zip');
	header('content-length:'.filesize($tmp_filename));
	readfile($tmp_filename);
}

/*
$nowtime = date("Y-m-d");
$file = fopen($tmp_filename, "r");
header("Content-type: application/octet-stream");
header("Accept-Ranges: bytes");
header("Accept-Length: ". filesize($tmp_filename));
header("Content-Disposition: attachment; filename=$nowtime.zip");
//一次只传输1024个字节的数据给客户端
$buffer = 1024;
while(!feof($file)){
	//将文件读入内存
	$file_data = fread($file, $buffer);
	//每次向客户端回送1024个字节的数据
	echo $file_data;
}
fclose($file);
*/
$conn->close();

?>