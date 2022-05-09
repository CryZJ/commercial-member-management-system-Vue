<?php
	/*
	 * 先获取下载的文件路径，再创建临时zip文件，把下载文件写入临时zip文件，最后下载临时zip文件并删除
	 * */
		require('conn.php');
		$sql = "SELECT a.案卷号,a.专利名称,a.类型,a.案源人,a.代理人,b.文件路径,b.时间 AS 上传时间 FROM 专利信息 a, 案卷流程及文档 b WHERE a.案卷号=b.案卷号 AND a.状态='待提交' AND b.流程='待提交' AND (SELECT SUBSTRING_INDEX(b.文件路径,'.',-1))='zip'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$path[] = $row['文件路径'];
				$sql2 = "update 专利信息  set 状态='申请中' where 案卷号='".$row['案卷号']."'";
				$result2 = $conn->query($sql2);
			}
		}
	//	print_r($path);
		$tmp_filename = "tmp.zip";
		$zip = new ZipArchive();
		$zip->open($tmp_filename,ZipArchive::OVERWRITE);
		foreach($path as $key => $value){
			$filedata = file_get_contents($value);
			if($filedata){
				$zip ->addFromString(basename($value),$filedata);
			}
		}
		$zip->close();
		
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
		
		$conn->close();
	
?>