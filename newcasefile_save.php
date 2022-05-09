<?php
require("AHeader.php");




	header('content-type:text/html;charset=utf-8');
	$flag = $_REQUEST['flag'];
//	echo $flag."\n";
	
	//专利案件新建时的异步文件保存
	if($flag == "upfile_za"){
		require_once 'upload_func.php';//保存文件的函数
		require('conn.php');//连接数据库
		$ajh_str = $_POST['ajh'];
		$ret_msg = "";
//		echo $ajh_str."\n";
//		print_r($_FILES);
		if(isset($ajh_str)){
			//获取案卷号
			if(strpos($ajh_str, ",")){
				$ajh_arr = explode(",", $ajh_str);
			}else{
				$ajh_arr[0] = $ajh_str;
			}
			foreach($ajh_arr as $ky => $ajh){
				if($ajh != ''){
					//判断专利信息的是否有对应的案件存在
					$sql = "SELECT id FROM 专利信息  WHERE 案卷号='".$ajh."'";
					@$result = $conn->query($sql);
					if(@$result->num_rows >0){
						//获取对应案卷号的文件对应的键值
						$file_num = $_POST[$ajh];
						if(strpos($file_num, ",")){
							$file_num_arr = explode(",", $file_num);
						}else{
							$file_num_arr[0] = $file_num;
						}
						//判断是否有上传文件
						if($file_num_arr[0] != "nofile"){
							foreach($file_num_arr as $ky_2 => $index_file){
								$up_path = "filesave/".$ajh;
								$ret_path = uploadFile_za($_FILES[$index_file],$up_path);//保存文件并返回保存路径
//								$ret_path['dest']//保存路径
								$sql_file = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径) VALUES(";
								$sql_file .= "'".$ajh."','待提交','".$name."','".date("Y-m-d H:i:s")."','".$ret_path['dest']."')";
								if($conn->query($sql_file)){
									$ret_msg .= basename($ret_path['dest'])."保存成功！\n";
								}else{
									$ret_msg .= basename($ret_path['dest'])."保存失败！\n";
								}
							}
						}else{
							$ret_msg .= $ajh."案件无文件上传！\n";
						}
					}else{
						$ret_msg .= $ajh."案件没有保存到专利信息中！\n".$sql;
					}
				}else{
					$ret_msg .= "案卷号为空\n";
				}
			}
		}else{
			$ret_msg .= "案卷号传输失败！\n";
		}
		
		echo $ret_msg;
		$conn->close();
	}
	
?>