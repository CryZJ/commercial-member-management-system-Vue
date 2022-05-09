<?php
	require("../../../AHeader.php");


	$flag = $_REQUEST["flag"];
require("../../../conn.php");
	if($flag == "upfile_rj"){
		require_once "../../../upload_func.php"; //使用函数uploadFile_rj
		$ajh = $_POST['ajh'];
//		echo $ajh."\n".$name."\n";
//		print_r($_FILES);
		$ret_mag = "";
		
		if(isset($ajh)){
			$sql_s = "SELECT id FROM 软件_信息 WHERE 案卷号='".$ajh."'";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows>0){
				$save_path = "../../../filesave_rj"."/".$ajh;
				foreach($_FILES as $num =>$fileinfo){
					$ret_path = uploadFile_rj($fileinfo,$save_path);
					$filename_arr = explode("/", $ret_path['dest']);//basename()
					$file_name = $filename_arr[count($filename_arr)-1];
					$sql_savepath = "filesave_rj/".$ajh."/".$file_name;
					$sql_i = "INSERT INTO 软件_文件(案卷号,处理人,时间,路径) VALUES(";
					$sql_i .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$sql_savepath."')";
					if($conn->query($sql_i)){
						$ret_mag .= $file_name."保存成功！\n";
					}else{
						$ret_mag .= $file_name."保存失败！\n";
					}
				}
				
			}else{
				$ret_mag .= "“软件_信息”中没有案卷号为".$ajh."的案件！\n";
			}
		}
		
		echo $ret_mag;
	}




$conn->close();

		    
?>