<?php
header('content-type:text/html;charset=utf-8');

require("../../AHeader.php");
require("../../conn.php");
require_once "../../upload_func.php";//连接下载函数文件
$flag = $_POST['flag'];
	
	//专利案件详情的文件上传的保存
	if($flag == "uploadfile_za"){
		$ajh = $_POST['ajh'];
		$clr = $_POST['clr'];
		$lc = $_POST['lc'];
	//	echo $ajh."???".$clr."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		
		foreach($_FILES as $ky => $fileinfo){
			$up_path = "../../filesave"."/".$ajh;
			$ret_path =  ajjlc_upfile($fileinfo,$up_path);
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径) VALUES(";
			$sql .= "'".$ajh."','".$lc."','".$clr."','".date("Y-m-d H:i:s")."','".$ret_path."')";
			if($conn->query($sql)){
				$newrow_id = $conn->insert_id;
				$ret_data .= basename($ret_path)."上传成功\n";
				$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','上传文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($ret_path,PATHINFO_BASENAME)."”文件')";
				$conn->query($sql);
				//读取通知书名称
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
					//只读取通知书名称
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$tzhmc = Get_TONGZHISMC($path_gbk);
						if($tzhmc != ""){
							$sql = "UPDATE 案卷流程及文档 SET 通知书名称='".$tzhmc."' WHERE id='".$newrow_id."'";
							$conn->query($sql);
						}
					}
				}
				
			}else{
				$ret_data .= basename($ret_path)."上传失败\n";
			}
		}
		echo $ret_data;//返回的信息
	}
	
	//无效案件详情的文件上传的保存
	if($flag == "uploadfile_wx"){
		$ajh = $_POST['ajh'];
	//	echo $ajh."???".$clr."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
	
		for($i=0;$i<count($_FILES);$i++){
			$up_path = "../../filesave"."/".$ajh;
			$ret_path =  ajjlc_upfile($_FILES[$i],$up_path);
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径) VALUES(";
			$sql .= "'".$ajh."','上传文件','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."')";
			if($conn->query($sql)){
				$newrow_id = $conn->insert_id;
				$ret_data .= basename($ret_path)."上传成功\n";
				//读取通知书名称
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
					//只读取通知书名称
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$tzhmc = Get_TONGZHISMC($path_gbk);
						if($tzhmc != ""){
							$sql = "UPDATE 案卷流程及文档 SET 通知书名称='".$tzhmc."' WHERE id='".$newrow_id."'";
							$conn->query($sql);
						}
					}
				}
				
			}else{
				$ret_data .= basename($ret_path)."上传失败\n";
			}
			
			
		}
		echo $ret_data;//返回的信息
	}
	
	//专案其他案件详情的文件上传的保存
	if($flag == "uploadfile_fs"){
		$ajh = $_POST['ajh'];
	//	echo $ajh."???".$clr."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		$i = 0;
		foreach($_FILES as $ky => $fileinfo){
			$up_path = "../../filesave_ZLElse"."/".$ajh;
			$ret_path =  ajjlc_upfile($fileinfo,$up_path);
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径) VALUES(";
			$sql .= "'".$ajh."','上传文件','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."')";
			if($conn->query($sql)){
				$newrow_id = $conn->insert_id;
				$ret_data .= basename($ret_path)."上传成功\n";
				
				$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','文件上传','".$name."','".date("Y-m-d H:i:s")."','".basename($ret_path)."')";
				$result_his = $conn->query($sql_his);
				//读取通知书名称
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
					//只读取通知书名称
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$tzhmc = Get_TONGZHISMC($path_gbk);
						if($tzhmc != ""){
							$sql = "UPDATE 案卷流程及文档 SET 通知书名称='".$tzhmc."' WHERE id='".$newrow_id."'";
							$conn->query($sql);
						}
					}
				}
				
			}else{
				$ret_data .= basename($ret_path)."上传失败\n";
			}
			
			$i++;
		}
		if($i == 0){
			$ret_data = "无文件上传或本次文件上传失败，请重新上传！";
		}
		echo $ret_data;//返回的信息
	}
	
		
	//软件的详情的文件上传的保存
	if($flag == "uploadfile_rj"){
		$ajh = $_POST['ajh'];
	//	echo $ajh."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		if(count($_FILES)>0){
			foreach($_FILES as $ky => $fileinfo){
				$up_path = "../../filesave_rj"."/".$ajh;
				$ret_msg =  uploadFile_rj($fileinfo,$up_path);
				$ret_path = $ret_msg['dest'];
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$sql = "";
				$sql = "INSERT INTO 软件_文件(案卷号,处理人,时间,路径) VALUES(";
				$sql .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."')";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."上传成功\n";
				}else{
					$ret_data .= basename($ret_path)."上传失败\n";
				}
			}
		}else{
			$ret_data .= "无文件上传";
		}
		echo $ret_data;//返回的信息
	}
	
	//著作的详情的文件上传的保存
	if($flag == "uploadfile_zz"){
		$ajh = $_POST['ajh'];
		$dest = $_POST['dest'];
		$dest_arr = explode(",", $dest);
	//	echo $ajh."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		if(count($_FILES)>0){
			$i = 0;
			foreach($_FILES as $ky => $fileinfo){
				$up_path = "../../filesave_zz"."/".$ajh;
				$ret_msg =  uploadFile_rj($fileinfo,$up_path);
				$ret_path = $ret_msg['dest'];
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$sql = "";
				$sql = "INSERT INTO 著作_文件(案卷号,处理人,时间,路径,描述) VALUES(";
				$sql .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."','".$dest_arr[$i]."')";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."上传成功\n";
				}else{
					$ret_data .= basename($ret_path)."上传失败\n";
				}
				$i++;
			}
		}
		echo $ret_data;//返回的信息
	}
	
	//商标的详情的其他文件上传的保存
	if($flag == "uploadfile_sb_other"){
		$ajh = $_POST['ajh'];
		$dest = $_POST['dest'];
		$dest_arr = explode(",", $dest);
	//	echo $ajh."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		$up_path = "../../filesave_sb"."/".$ajh;
		$i = 0;
		foreach($_FILES as $index => $fileinfo){
			$ret_msg =  uploadFile_rj($fileinfo,$up_path);
			$ret_path = $ret_msg['dest'];
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$file_arr = explode("/", $ret_path);
			$file_name = $file_arr[count($file_arr)-1];
			$sql = "INSERT INTO 商标_文件(案卷号,创建人,创建时间,文件路径,描述) VALUES(";
			$sql .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."','".$dest_arr[$i]."')";
			if($conn->query($sql)){
				$ret_data .= $file_name."上传成功\n";
			}else{
				$ret_data .= $file_name."上传失败\n";
			}
			$i++;
		}
		echo $ret_data;//返回的信息
	}

		//海关的详情的文件上传的保存
	if($flag == "uploadfile_hg"){
		$ajh = $_POST['ajh'];
	//	echo $ajh."\n<br/>";
	//	print_r($_FILES);
		$ret_data = "";
		if(count($_FILES)>0){
			foreach($_FILES as $ky => $fileinfo){
				$up_path = "../../filesave_hg"."/".$ajh;
				$ret_msg =  uploadFile_rj($fileinfo,$up_path);
				$ret_path = $ret_msg['dest'];
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "";
				$sql = "INSERT INTO 海关_文件(案卷号,操作人,操作时间,文件路径,文件名) VALUES(";
				$sql .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."','".$file_name."')";
				if($conn->query($sql)){
					$ret_data .= $file_name."上传成功\n";
				}else{
					$ret_data .= $file_name."上传失败\n";
				}
			}
		}else{
			$ret_data .= "无文件上传";
		}
		echo $ret_data;//返回的信息
	}

	//年费的文件上传
	if($flag == "uploadfile_nf"){
		$ajh = $_POST['ajh'];
		
		$ret_data = "";
		
		foreach($_FILES as $ky =>$fileinfo){
			$up_path = "../../filesave_nf"."/".$ajh;
			$ret_msg =  uploadFile_rj($fileinfo,$up_path);
			$ret_path = $ret_msg['dest'];
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
			$sql = "";
			$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径) VALUES(";
			$sql .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."')";
			if($conn->query($sql)){
				$ret_data .= $file_name."上传成功\n";
			}else{
				$ret_data .= $file_name."上传失败\n";
			}
		}
		echo $ret_data;//返回的信息
	}

	//项目申报文件上传
	if($flag == "uploadfile_pr"){
		$self_id = $_POST['ajh'];
		
		$ret_data = "";
		
		foreach($_FILES as $ky =>$fileinfo){
			$up_path = "../../filesave_xm"."/".$self_id;
			$ret_msg =  uploadFile_rj($fileinfo,$up_path);
			$ret_path = $ret_msg['dest'];
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
			$sql = "";
			$sql = "INSERT INTO 专案_项目申报文件(对应id,创建人,创建时间,文件路径) VALUES(";
			$sql .= "'".$self_id."','".$name."','".date("Y-m-d H:i:s")."','".$ret_path."')";
			$sql2 = "INSERT INTO 专案_项目申报文件操作记录(Caseid,文件路径,操作员,操作名,记录时间) VALUES(";
			$sql2 .= "'".$self_id."','".$ret_path."','".$name."','1','".date("Y-m-d H:i:s")."')";
			$conn->query($sql2);
			if($conn->query($sql)){
				$ret_data .= $file_name."上传成功\n";
			}else{
				$ret_data .= $file_name."上传失败\n";
			}
		}
		echo $ret_data;//返回的信息
	}
	
	
	//企业信息的详情的文件上传的保存
	if($flag == "uploadfile_cms"){
		$data_0 = $_POST['data_0'];//企业id
		$ret_data = "";
		if(count($_FILES)>0){
			foreach($_FILES as $index_val =>$fileinfo){
				$path = "../../filesave_qy/".$data_0;
				$ret_msg =  uploadFile_rj($fileinfo,$path);
				$ret_path = $ret_msg['dest'];
				$ret_path = substr($ret_path, 6);
				$ret_path_arr = explode("/", $ret_path);
				$file_basename = end($ret_path_arr);
				$sql = "INSERT INTO 企业文件(企业id,文件路径,上传时间,上传人) VALUES(";
				$sql .= "'".$data_0."','".$ret_path."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret_data .= $file_basename."保存成功\n";
				}else{
					$ret_data .= $file_basename."保存失败\n";
				}
			}
		}else{
				$ret_data .= "无文件上传";
		}
		echo $ret_data;//返回的信息
	}
	

$conn->close();
?>