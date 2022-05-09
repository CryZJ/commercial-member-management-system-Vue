<?php
header('Content-Type:text/html;charset=utf-8');
$filename=$_GET['filename'];
$name_arr = explode("/", $filename);
$file_name = $name_arr[count($name_arr)-1];
$filename = iconv("utf-8", "gbk", $filename);
if(file_exists($filename)){
	header('content-disposition:attachment;filename='.$file_name);
	header('content-length:'.filesize($filename));
	readfile($filename);
}else{
	echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
}
?>