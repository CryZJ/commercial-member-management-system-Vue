<?php
	$data = $_POST['data_send'];
	require('conn.php');
	foreach($data as $key => $value){
		if($value[1]=="年费"){
//			$sql = "insert into 专案需交费用(案卷号,费用名称,金额,提醒时间,剩余天数,缴费期限,年度) values(";
			$sql = "INSERT INTO 专案_年费记录(案卷号,金额,提醒日期,剩余天数,应缴日期,状态,年度,费用来源) VALUES(";
			$sql .= "'$value[0]','$value[2]','$value[3]','$value[4]','$value[5]','0','1','2')";
//			$sql .= "'$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$value[5]','1')";
			$result = $conn->query($sql);
		}else{
			$sql = "insert into 专案需交费用(案卷号,费用名称,金额,提醒时间,剩余天数,缴费期限,费用来源) values(";
			$sql .= "'$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$value[5]','2')";
			$result = $conn->query($sql);
		}
	}
	if($result){
		$return['结果']="保存成功！";
	}else{
		$return['结果']="保存失败00！";
	}
	$json = json_encode($return);
	echo $json;
?>