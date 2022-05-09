<?php
//header('Content-Type:text/html;charset=utf-8');
//字符串编码互换utf-8转gbk或gbk转utf-8
function change_encode($str){
	$ret_str = $str;
	$encode = mb_detect_encoding($str);//获取字符串的编码格式
	if($encode == "UTF-8"){
		$ret_str = iconv("UTF-8", "GBK", $str);
	}
	if($encode == "GBK"){
		$ret_str = iconv("GBK","UTF-8",  $str);
	}
	
	return $ret_str;
}
$filename=$_GET['filename'];
$name_arr = explode("/", $filename);
$name = $name_arr[count($name_arr)-1];
$filename = change_encode($filename);
if(file_exists($filename)){
	header('content-disposition:attachment;filename='.$name);
	header('content-length:'.filesize($filename));
	readfile($filename);
}else{
	echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
}

?>