<?php
header('Content-Type:text/html;charset=utf-8');

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

$flag = $_REQUEST['flag'];
require("../../AHeader.php");
require("../../conn.php");
//未下载申请文件
if($flag == "wxsqwj"){
	$id = $_GET['id'];
	$ajh = $_GET['ajh'];
	$filename=$_GET['filename'];
	$tmppath_arr = explode("/", $filename);
	$filename = change_encode($filename);
	if(file_exists($filename)){
		$sql2 = "update 专利信息  set 状态='待受理' where 案卷号='".$ajh."'";
		if($conn->query($sql2)){
			//更新下载时间
			$sql3 = "UPDATE 案卷流程及文档  SET 下载时间='".date("Y-m-d H:i:s")."',下载人='".$name."'   WHERE id='" . $id . "'";
			$conn->query($sql3);
			
			header('content-disposition:attachment;filename='.array_pop($tmppath_arr));
			header('content-length:'.filesize($filename));
			readfile($filename);
		}
	}else{
		$sql3 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
		if($conn->query($sql3)){
			echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
		}else{
			echo '<script type="text/javascript">alert("数据库无此记录与文件已被删除或移动了！");window.close();</script>';
		}
		
	}
	
}
//未下载申请文件：下载选中的文件
if($flag == "wxasqwj_zipdown"){
	$filename=$_GET['filename'];
	$filename = change_encode($filename);
	if(file_exists($filename)){
		header('content-disposition:attachment;filename='.date("Ymd-His").'.zip');
		header('content-length:'.filesize($filename));
		readfile($filename);
	}
}
//已下载的申请文件
if($flag == "yxsqwj"){
	$id = $_GET['id'];
	$ajh = $_GET['ajh'];
	$filename=$_GET['filename'];
	$filename = change_encode($filename);
	if(file_exists($filename)){
		header('content-disposition:attachment;filename='.basename($filename));
		header('content-length:'.filesize($filename));
		readfile($filename);
	}else{
		$sql3 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
		if($conn->query($sql3)){
			echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
		}else{
			echo '<script type="text/javascript">alert("数据库无此记录与文件已被删除或移动了！");window.close();</script>';
		}
		
	}
}

//共享文件：下载选中的文件
if($flag == "sharefile_zipdown"){
	$filename=$_GET['filename'];
	$filename = change_encode($filename);
	if(file_exists($filename)){
		header('content-disposition:attachment;filename='.date("Ymd-His").'.zip');
		header('content-length:'.filesize($filename));
		readfile($filename);
	}
}


$conn->close();
?>