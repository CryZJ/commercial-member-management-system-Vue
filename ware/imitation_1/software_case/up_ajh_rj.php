<?php
  $ayr = $dlr ="";
  $ayr = $_POST['ayr'];
  $dlr = $_POST['dlr'];
  $str = 5;
  require("../../../conn.php");
	/*获取软件信息的行数*/
	$sql = "select COUNT(id) as 总数 from 软件_信息";
	$result = $conn->query($sql);
	$countnumber = 0;
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$countnumber = $row["总数"];
		}
	}

	/*分别获取案源人与代理人的编号*/
	
	$sql1 = "select 编号 from 案源人信息 where 名称='".$ayr."'";
	$result1 = $conn->query($sql1);
	if($result1->num_rows>0){
		while($row1 = $result1->fetch_assoc()){
			$ayr_num = $row1['编号'];
		}
	}
	$sql2 = "select 编号 from 代理人信息 where 名称='".$dlr."'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		while($row2 = $result2->fetch_assoc()){
			$dlr_num = $row2['编号'];
		}
	}
	/*前面序号：00001*/
	$sn = "";
	$countnumber = $countnumber +1 ;
	$countnumber = strval($countnumber);
	$len = strlen($countnumber);
	switch($len){
		case 1 : $sn = "0000".$countnumber;break;
		case 2 : $sn = "000".$countnumber;break;
		case 3 : $sn = "00".$countnumber;break;
		case 4 : $sn = "0".$countnumber;break;
		default : $sn = $countnumber;
	}
	
	
	$ajh = $sn.$ayr_num.$str.$dlr_num ;
	//插入数据库占据一行
	$sql4 = "INSERT INTO 软件_信息(案卷号,状态) VALUES('".$ajh."',9)";
	if($conn->query($sql4)){
		echo $ajh;
	}else{
		echo "生成失败，请再试一次或联系管理员";
	}
	
	
	$conn->close();
?>