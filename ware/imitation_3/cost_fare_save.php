<?php
	require'../../AHeader.php';
	require'../../conn.php';
	
	//验证身份是否是“流程操作员”
	if(!$lcczy == "1"){
		echo "您没有权限操作";
		exit();
	}
	
	$mass 	= $_POST['mas'];
//	$fid 	= $_POST['fid'];
	$cpeo 	= $_POST['cpeo'];
//	$array 	= explode('/',$mass);
	$len 	= count($mass);
	$date	= date('Y-m-d');//获取当前日期，即系统确认时间
	
	//获取毫秒级时间戳
	list($msec, $sec) = explode(' ', microtime());
   	$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
   	//文件名
   	$FileName = $msectime.$userid.'.xls';
	
	
	for($i=0;$i<$len;$i++){
		$arr= explode('/',$mass[$i]);
		$time=date("Y-m-d");
//ffid+'/'+fname+'/'+ ffnum +'/'+ fsnum +'/'+ fjefy +'/'+ fdlfy +'/'+ fznjy;
		$sql = "UPDATE `专案需交费用` SET `收费处理人`='".$cpeo."',`缴费确认人`='".$cpeo."',`系统确认时间`='".$date."',`缴费时间`='".$date."',`代理费`='".$arr[5]."',`滞纳金`='".$arr[6]."' ,`状态`=3,`缴费文件名`='".$FileName."',`收据上传日期`='".$time."' WHERE id='".$arr[0]."'";
		$result = $conn->query($sql);
		switch($arr[1]){
			case "申请费": 
				$sql = "UPDATE 专利信息 SET 状态='申请中' WHERE 案卷号='".$arr[2]."'";
				$conn->query($sql);
				break;
			case "登记费": 
				$sql = "UPDATE 专利信息 SET 状态='待证书' WHERE 案卷号='".$arr[2]."'";
				$conn->query($sql);
				break;
			default :
			    $sql = "UPDATE 专利信息 SET 状态='申请中' WHERE 案卷号='".$arr[2]."'";
			    $conn->query($sql);
				break;
		}
		
	}
	if($result){
		echo $FileName;
//		echo $mass;
	}else{
//		echo $sql;
		echo 0;
	}
?>