<?php
	require'../../../AHeader.php';
	require'../../../conn.php';
	$falg = $_POST['falg'];
	switch($falg){
		case 'savefile':
			//保存【案卷流程及文档】&&【专案_复审等】	
			$ajh = $_POST['ajh'];
//			print_r($_FILES);
			//1.通过$_FILES文件上传变量接收上传文件信息
			$fileInfo=$_FILES['upfile'];
			$filename=$fileInfo['name'];
			$type=$fileInfo['type'];
			$tmp_name=$fileInfo['tmp_name'];
			$size=$fileInfo['size'];
			$error=$fileInfo['error'];
			
			//2.保存文件到指定文件夹
			$path='../../../filesave_ZSDJ'; //中文拼音：证书登记【不客气】
			if(!file_exists($path)){
				mkdir($path,0777,true);
				chmod($path,0777);
			}
			$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
			//确保文件名唯一，防止重名产生覆盖
			list($t1, $t2) = explode(' ', microtime());
//			$uniName = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);  
		//	echo $uniName;
			$destination=$path.'/'.$ajh."_".$filename;
			$gbk_destination = iconv("utf-8", "gbk", $destination);
			if(@move_uploaded_file($fileInfo['tmp_name'],$gbk_destination)){
//				echo '文件上传成功';
				$path_sqlsave = "filesave_ZSDJ/".$ajh."_".$filename;
				//专案_复审等
				$SaveHis = "update `专案_复审等` set 证书 = '".$path_sqlsave."' where `案卷号`='".$ajh."'";
				$conn->query($SaveHis);
				//专案_操作记录
				$SaveHis = "INSERT INTO `专案_操作记录`(案卷号,操作员,操作名,记录时间,其他) ";
				$SaveHis .="VALUES('".$ajh."','".$name."','证书导入','".date('Y-m-d H:i:s')."','上传了证书')";
				$conn->query($SaveHis);
				//案卷流程及文档
				$SaveHis = "INSERT INTO `案卷流程及文档`(时间,处理人,文件路径,流程,案卷号) ";
				$SaveHis .="VALUES('".date('Y-m-d H:i:s')."','".$name."','".$path_sqlsave."','证书','".$ajh."')";
				$conn->query($SaveHis);
				echo 1;
			}else{
//				echo '文件上传失败';
				echo 0;
			}
		break;
		case 'SaveFare':
			$DataLen = $_POST['DataLen'];//长度
			$ArrFare = $_POST['ArrFare'];//费用信息
			$ajh = $_POST['ajh'];//案卷号
			
			for($i=0;$i<$DataLen;$i++){
				$FareSave = "INSERT INTO `专案_年费记录`(案卷号,年度,金额,提醒日期,应缴日期) ";
				$FareSave .= "VALUES('".$ajh."','".$ArrFare[$i]['Year']."','".$ArrFare[$i]['Fare']."','".$ArrFare[$i]['DateB']."','".$ArrFare[$i]['DateE']."')";
				$resultFare = $conn->query($FareSave);
				$end_time = $ArrFare[$i]['DateB'];
				if($resultFare){
					for($y=0;$y<5;$y++){
						$kry = 'ODL'.$y;
						$star_time =  date("Y-m-d",strtotime("1days",strtotime($end_time)));
						$end_time = date("Y-m-d",strtotime("30days",strtotime($star_time)));
						$sql2 = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
						$sql2 .= "'".$ajh."','".$ArrFare[$i]['Year']."','".($y+1)."','".$ArrFare[$i][$kry]."','".$star_time."','".$end_time."')";
						$result2 = $conn->query($sql2);
					}
				}
			}
			if($resultFare){
				//专案_操作记录
				$SaveHis = "INSERT INTO `专案_操作记录`(案卷号,操作员,操作名,记录时间,其他) ";
				$SaveHis .="VALUES('".$ajh."','".$name."','生成年费','".date('Y-m-d H:i:s')."','')";
				$conn->query($SaveHis);
				echo 1;
			}else{
				echo 0;
			}
		break;
		default:break;
	}
	
	
?>