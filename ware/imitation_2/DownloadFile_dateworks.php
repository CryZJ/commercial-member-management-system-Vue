<?php
require("../../conn.php");

$cid = $_GET["id"];

$sql = "SELECT 事件时间 FROM 日程设置 WHERE id='".$cid."'";
$result = $conn->query($sql);
$casetime = "";
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$casetime = $row["事件时间"];
	}
}

//创建zip包
$tmp_filename = "tmp.zip";
if(file_exists($tmp_filename)){
	unlink($tmp_filename);
}
$zip = new ZipArchive();
$zip->open($tmp_filename,ZipArchive::OVERWRITE);
//装载文件
$sql = "SELECT 文件路径 FROM 日程文件 WHERE 日程id='".$cid."'";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$path = iconv("utf-8", "gbk", "../../".$row["文件路径"]);
		if(file_exists($path)){
			$filedata = file_get_contents($path);
			if($filedata){
				$zip ->addFromString(pathinfo($path,PATHINFO_BASENAME),$filedata);
			}
		}
	}
}

$zip->close();

if(file_exists($tmp_filename)){
	header('content-disposition:attachment;filename='.$casetime."日文件.zip");
	header('content-length:'.filesize($tmp_filename));
	readfile($tmp_filename);
}

?>