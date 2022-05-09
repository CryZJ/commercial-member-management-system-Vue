<?php
require("AHeader.php");
	//获取信息
	$ajh = $_POST['ajh'];
	$fee_arr = $_POST['fee'];
	
//	echo $ajh;
//	echo gettype($fee_arr);
//	print_r($fee_arr);
	require('conn.php');
	foreach($fee_arr as $key => $value){
//		echo $value[0]."/".$value[1]."/".$value[2]."/".$value[3]."\n";
//		$sql = "insert into 专案需交费用(案卷号,费用名称,年度,金额,缴费期限,提醒时间,状态) values(";
		$sql = "INSERT INTO 专案_年费记录(案卷号,年度,金额,应缴日期,提醒日期) VALUES(";
		$sql .= "'$ajh','$value[0]','$value[1]','$value[2]','$value[3]')";
//		echo $sql."\n";
		$result = $conn->query($sql);
		
		$end_time = $value[2];
		if($result){
			for($i=0;$i<5;$i++){
				$star_time =  date("Y-m-d",strtotime("1days",strtotime($end_time)));
				$end_time = date("Y-m-d",strtotime("30days",strtotime($star_time)));
				$kry_0 = $i+4;
				$sql2 = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
				$sql2 .= "'".$ajh."','".$value[0]."','".($i+1)."','".$value[$kry_0]."','".$star_time."','".$end_time."')";
				$result2 = $conn->query($sql2);
			}
		}
	}	
	if($result==1){
		$sql = "UPDATE 专利信息 SET 状态='年费中' WHERE 案卷号='".$ajh."'";
		$conn->query($sql);
		$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','保存费用','".date("Y-m-d H:i:s")."','上传证书后生成的年费')";
		$conn->query($sql);
		$return['result']='保存成功';
	}else{
		exit('保存失败！');
	}
	$json = json_encode($return);
	echo $json;
	$conn->close();
	
	
?>