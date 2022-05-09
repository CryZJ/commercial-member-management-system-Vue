<?php
/*
 * 说明：本页成功执行后会产生一个tmp.zip的文件
 * 
 * */
header("content-type:text/html;charset:utf-8");
$flag = $_REQUEST['flag'];
require("../../AHeader.php");
require("../../conn.php");

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

//未下载申请文件的批量下载
if($flag == "wxzsqwj_downfile"){
	
	$send_id = $_POST['send_id'];
	$arr_id = "";
	if(strpos($send_id, ",")){//是否有多过id
		$arr_id = explode(",", $send_id);
	}else{
		$arr_id[0] = $send_id;
	}
	$get_ajh = "";
	$staue_file_success = "";
	$down_num_success = 0;
	$staue_file_error = "";
	$down_num_error = 0;
	//创建一个临时的zip文件
	$tmp_filename = "tmp.zip";
	if(file_exists($tmp_filename)){
		unlink($tmp_filename);
	}
	$zip = new ZipArchive();
	$zip->open($tmp_filename,ZipArchive::OVERWRITE);
	//将要下载的问价放进压缩包里，并获取案卷号
	for($i=0;$i<count($arr_id);$i++){
		$sql = "SELECT 案卷号,文件路径  FROM 案卷流程及文档   WHERE id='".$arr_id[$i]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$sql_path = $row['文件路径'];
				$tmp_ajh = $row['案卷号'];
			}
			$real_path = "../../".$sql_path;
			$real_path = change_encode($real_path);
			if(file_exists($real_path)){
				$filedata = file_get_contents($real_path);
				if($filedata){
					//更新下载时间
					$sql_u = "UPDATE 案卷流程及文档  SET 下载时间='".date("Y-m-d H:i:s")."',下载人='".$name."'  WHERE id='".$arr_id[$i]."'";
					$conn->query($sql_u);
					
					$zip->addFromString(basename($real_path),$filedata);
					$sql_filename_arr = explode("/", $sql_path); 
					$staue_file_success .= $sql_filename_arr[count($sql_filename_arr)-1]."\n<br/>";
					$down_num_success++;
					$get_ajh[] = $tmp_ajh;
				}
			}else{
				$sql_u = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='".$arr_id[$i]."'";
				$conn->query($sql_u);
				$staue_file_error .= $sql_filename_arr[count($sql_filename_arr)-1]."\n <br/>";
				$down_num_error++;
			}
		}
	}
	$zip->close();
	if($get_ajh != ""){
		//更改“专利信息”的状态
		$ret = '';
		$get_ajh = array_values($get_ajh);
		if(is_array($get_ajh)){
			foreach($get_ajh as $ky => $v){
				$sql_u = "UPDATE 专利信息  SET 状态='待受理' WHERE 案卷号='".$v."'";
				if($conn->query($sql_u)){
	//				$ret .= '案卷号为'.$v."已更改专利信息状态\n";
				}else{
					$ret .= "案卷号为".$v."未更改专利信息状态\n</br>";
				}
			}
		}
	}
	
	//下载zip文件并删除它
	/*第一种下载方法：测试本机可以，远程失败的
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
	unlink($tmp_filename);
	*/
	//尝试另一种方法下载，通过打开另一个窗口进行下载，本页输出相关的信息
	echo '	<script type="text/javascript" >
				window.open("dow_file_one.php?flag=wxasqwj_zipdown&filename='.$tmp_filename.'","_blank");
			</script>';
	//输出本次结果
	echo '<div algin="center"><button onclick="window.close();" >点击关闭本页</button></div>';
	echo "<h2>本次成功下载<b>".$down_num_success."</b>个文件</h2>".$staue_file_success;
	echo "<br/><br/><hr/><hr/>";
	echo "<h2>本次下载失败<b>".$down_num_error."</b>个文件</h2><br/>".$staue_file_error;
	echo "<hr/><br/>";
	echo "<h3>下载失败的案件：<h3><em>可以到“已下载申请文件”重新下载或到相关的案件详情中查看文件是否还在</em><br/>".	$ret;
	
}

if($flag == "yxzsqwj_noneshow"){
	$send_id = $_POST['send_id'];
	$arr_id = "";
	if(strpos($send_id, ",")){//是否有多过id
		$arr_id = explode(",", $send_id);
	}else{
		$arr_id[0] = $send_id;
	}
	$len = count($arr_id);
	for($i=0;$i<$len;$i++){
		$sql = "SELECT id  FROM 案卷流程及文档   WHERE id='".$arr_id[$i]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			$sql_u = "UPDATE 案卷流程及文档  SET 显示状态='1' WHERE id='".$arr_id[$i]."'";
			$conn->query($sql_u);
		}
	}
	echo "删除完成";
}


//共享文件的批量下载
if($flag == "share_downfile"){
	
	$send_id = $_POST['send_id'];
	$arr_id = "";
	if(strpos($send_id, ",")){//是否有多过id
		$arr_id = explode(",", $send_id);
	}else{
		$arr_id[0] = $send_id;
	}
	
	$staue_file_success = "";
	$down_num_success = 0;
	$staue_file_error = "";
	$down_num_error = 0;
	//创建一个临时的zip文件
	$tmp_filename = "tmp2.zip";
	if(file_exists($tmp_filename)){
		unlink($tmp_filename);
	}
	$zip = new ZipArchive();
	$zip->open($tmp_filename,ZipArchive::OVERWRITE);
	//将要下载的问价放进压缩包里，并获取案卷号
	for($i=0;$i<count($arr_id);$i++){
		$sql = "SELECT 文件路径  FROM 共享文件 WHERE id='".$arr_id[$i]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$sql_path = $row['文件路径'];
			}
			$real_path = "../../".$sql_path;
			$real_path = change_encode($real_path);
			if(file_exists($real_path)){
				$filedata = file_get_contents($real_path);
				if($filedata){
					$zip->addFromString(basename($real_path),$filedata);
					$sql_filename_arr = explode("/", $sql_path); 
					$staue_file_success .= $sql_filename_arr[count($sql_filename_arr)-1]."\n<br/>";
					$down_num_success++;
					
				}
			}else{
				$sql_u = "UPDATE 共享文件  SET 删除状态='1' WHERE id='".$arr_id[$i]."'";
				$conn->query($sql_u);
				$staue_file_error .= $sql_filename_arr[count($sql_filename_arr)-1]."\n <br/>";
				$down_num_error++;
			}
		}
	}
	$zip->close();
	
	//下载zip文件并删除它
	/*第一种下载方法：测试本机可以，远程失败的
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
	unlink($tmp_filename);
	*/
	//尝试另一种方法下载，通过打开另一个窗口进行下载，本页输出相关的信息
	echo '	<script type="text/javascript" >
				window.open("dow_file_one.php?flag=sharefile_zipdown&filename='.$tmp_filename.'","_blank");
			</script>';
	//输出本次结果
	echo '<div algin="center"><button onclick="window.close();" >点击关闭本页</button></div>';
	echo "<h2>本次成功下载<b>".$down_num_success."</b>个文件</h2>".$staue_file_success;
	echo "<br/><br/><hr/><hr/>";
	echo "<h2>本次下载失败<b>".$down_num_error."</b>个文件</h2><br/>".$staue_file_error;
	
}


//单个文件的批量下载
if($flag == "self_downfile"){
	
	$send_id = $_POST['send_id'];
	$arr_id = "";
	if(strpos($send_id, ",")){//是否有多过id
		$arr_id = explode(",", $send_id);
	}else{
		$arr_id[0] = $send_id;
	}
	
	$staue_file_success = "";
	$down_num_success = 0;
	$staue_file_error = "";
	$down_num_error = 0;
	//创建一个临时的zip文件
	$tmp_filename = "tmp3.zip";
	if(file_exists($tmp_filename)){
		unlink($tmp_filename);
	}
	$zip = new ZipArchive();
	$zip->open($tmp_filename,ZipArchive::OVERWRITE);
	//将要下载的问价放进压缩包里，并获取案卷号
	for($i=0;$i<count($arr_id);$i++){
		$sql = "SELECT 文件路径  FROM 个人文件 WHERE id='".$arr_id[$i]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$sql_path = $row['文件路径'];
			}
			$real_path = "../../".$sql_path;
			$real_path = change_encode($real_path);
			if(file_exists($real_path)){
				$filedata = file_get_contents($real_path);
				if($filedata){
					$zip->addFromString(basename($real_path),$filedata);
					$sql_filename_arr = explode("/", $sql_path); 
					$staue_file_success .= $sql_filename_arr[count($sql_filename_arr)-1]."\n<br/>";
					$down_num_success++;
					
				}
			}else{
				$sql_u = "UPDATE 个人文件  SET 删除状态='1' WHERE id='".$arr_id[$i]."'";
				$conn->query($sql_u);
				$staue_file_error .= $sql_filename_arr[count($sql_filename_arr)-1]."\n <br/>";
				$down_num_error++;
			}
		}
	}
	$zip->close();
	
	//下载zip文件并删除它
	/*第一种下载方法：测试本机可以，远程失败的
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
	unlink($tmp_filename);
	*/
	//尝试另一种方法下载，通过打开另一个窗口进行下载，本页输出相关的信息
	echo '	<script type="text/javascript" >
				window.open("dow_file_one.php?flag=sharefile_zipdown&filename='.$tmp_filename.'","_blank");
			</script>';
	//输出本次结果
	echo '<div algin="center"><button onclick="window.close();" >点击关闭本页</button></div>';
	echo "<h2>本次成功下载<b>".$down_num_success."</b>个文件</h2>".$staue_file_success;
	echo "<br/><br/><hr/><hr/>";
	echo "<h2>本次下载失败<b>".$down_num_error."</b>个文件</h2><br/>".$staue_file_error;
	
}




$conn->close();
?>