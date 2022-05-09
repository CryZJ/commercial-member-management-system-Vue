<?php
		require("../../../AHeader.php");
	
//	print_r($_FILES);
	
	    $ajh = $_POST['ajh'];//获取案卷号	
	    $time = date("Y-m-d");//获取当前时间
		require'../../../conn.php';
		$sql = "select id from 商标_案件 where 案卷号='".$ajh."'";
//		echo $sql;
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$blogo_id= $row['id'];
			}
		}else{
//			exit('<script type="text/javascript">alert("文件保存失败！");location.href="new_case.php";</script>');
			exit('<script type="text/javascript">alert("文件保存失败！");</script>');
		}
		
		require("../../../upload.func1.php");
		$fileinfo =  getFiles($_FILES);
//			print_r($fileinfo);
//			$path_upload ="../../../filesave";//测试
		$path_upload = "../../../filesave"."/".$ajh; //最后要写的
		$ret_path ='';
		foreach ($fileinfo as $doc) {
			$ret_path[] = myfile5($doc,$path_upload);
		}
		
		$sql6  ="UPDATE 商标_文件 SET  商标黑白 ='".$ret_path[0]."',商标彩色 ='".$ret_path[1]."',身份证原 = '".$ret_path[2]."',身份证翻 = '".$ret_path[3]."',营业执照原='".$ret_path[4]."',营业执照翻 ='".$ret_path[5]."'WHERE 案件id = '".$blogo_id."'";
		$result6 = $conn->query($sql6);
		if($result6){
//			echo "文件保存成功";
				$num = count($ret_path);
				for($i=6;$i<$num;$i++){
					$file_name = basename($ret_path[$i]);//获取文件名字
					$sql7 = "INSERT INTO 商标_其他文件  (案件id,文件地址,状态,文件名,创建时间,创建人)values(";
					$sql7.="'".$blogo_id."','".$ret_path[$i]."','0','".$file_name."','".$time."','".$userid."' )";
					$result7 = $conn->query($sql7);	
				}
				if($result7){
					echo "文件保存成功";
					}
				else{
					echo "文件保存失败";
				}	
		}
?>