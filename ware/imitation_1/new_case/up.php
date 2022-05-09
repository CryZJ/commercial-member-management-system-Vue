<?php require'../../../AHeader.php'; ?>
<?php
	$str = $str2 = $str3=$num_r="";
	$str = $_REQUEST['str'];//专利类型
	$str2 = $_REQUEST['str2'];//案源人
	$str3 = $_REQUEST['str3'];//代理人
	$sqr_id = $_REQUEST['sqr_id'];//代理人
//	$num_r = $_REQUEST['len'];

	require("../../../conn.php");
	/*获取专利信息的行数*/
	$sql = "select COUNT(id) as 总数 from 专利信息";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$countnumber_0 = $row["总数"];
		}
	}
	$sql3 = "select COUNT(id) as 总数 from 专案_无效";
	$result3 = $conn->query($sql3);
	if($result3->num_rows > 0){
		while($row3 = $result3->fetch_assoc()){
			$countnumber_1 = $row3["总数"];
		}
	}
	$sql4 = "select COUNT(id) as 总数 from 专案_年费";
	$result4 = $conn->query($sql4);
	if($result4->num_rows > 0){
		while($row4 = $result4->fetch_assoc()){
			$countnumber_2 = $row4["总数"];
		}
	}
	$sql5 = "select COUNT(id) as 总数 from 专案_复审等";
	$result5 = $conn->query($sql5);
	if($result5->num_rows > 0){
		while($row5 = $result5->fetch_assoc()){
			$countnumber_3 = $row5["总数"];
		}
	}
	$countnumber = $countnumber_0 + $countnumber_1 + $countnumber_2 + $countnumber_3;

	/*分别获取案源人与代理人的编号*/
	$sql = "select 编号 from 案源人信息 where 名称='".$str2."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$ayr_num = $row['编号'];
		}
	}
	$sql2 = "select 编号 from 代理人信息 where 名称='".$str3."'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		while($row2 = $result2->fetch_assoc()){
			$dlr_num = $row2['编号'];
		}
	}
	/*前面序号：05000*/
	$sn = "";
	$num = 5000;
	$countnumber = $countnumber +1 ;
	$num += $countnumber;
	$num = strval($num);
	$len2 = strlen($num);
	switch($len2){
		case 1 : $sn2 = "0000".$num;break;
		case 2 : $sn2 = "000".$num;break;
		case 3 : $sn2 = "00".$num;break;
		case 4 : $sn2 = "0".$num;break;
		default : $sn2 = $num;
	}
	//不能用 btn_id 做第二标识，当新增行时，btn_id=“行数-2”
//	$string = $sn . $str . $str2 . $str3;
//	$string = $sn . $str . $str2 . $str3 . $num_r;
//返回数据库里的行数+1、大写子母，用，分割
//格式：流水号+案源人编号+案卷类型+代理人编号
	$ajh = $sn2.$ayr_num.$str.$dlr_num;
	//创建时间
	$time = date('Y-m-d H:i:s');
	$sql_ajh = "insert into 专利信息(案卷号,状态,创建时间,案源人,代理人,创建人,申请人id) values ('".$ajh."',9,'".$time."','".$str2."','".$str3."','".$name."','".$sqr_id."')";
	$result_ajh = $conn->query($sql_ajh);
	
//	echo $countnumber.",".$ayr_num.$str.$dlr_num ;
	echo $ajh;
		
	$conn->close();

?>