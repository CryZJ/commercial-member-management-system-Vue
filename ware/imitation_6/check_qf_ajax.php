<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");


require("../../conn.php");

$my_flag = $_POST['my_flag'];

if($my_flag == "getdata"){
	$myid = $_POST['myid'];
	
	$retdata = "";
//	$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注  FROM 欠费记录  WHERE id='".$myid."'";
	$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注  FROM ".$arrearage_record."  WHERE id='".$myid."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$retdata[0] = $row['客户名称'];
			$retdata[1] = $row['项目内容'];
			$retdata[2] = $row['总收费'];
			$retdata[3] = $row['规费'];
			$retdata[4] = $row['管理费'];
			$retdata[5] = $row['税费'];
			$retdata[6] = $row['收费方式'];
			$retdata[7] = $row['收费日期'];
			$retdata[8] = $row['案源人'];
			$retdata[9] = $row['代理人'];
			$retdata[10] = $row['备注'];
		}
	}
//	$retdata['sql'] = $sql;
	$json = json_encode($retdata);
	echo $json;
}
//欠费记录保存
if($my_flag == "save_pay"){
	$myid = $_POST['myid'];
	$arr_send = $_POST['arr_send'];
//	print_r($arr_send);
	$ymd = explode("-", $arr_send[7]);
	$ym = $ymd[0].$ymd[1];
	
//	$sql = "UPDATE 欠费记录 SET 客户名称='".$arr_send[0]."',项目内容='".$arr_send[1]."',总收费='".$arr_send[2]."',规费='".$arr_send[3]."',管理费='".$arr_send[4]."',税费='".$arr_send[5]."',收费方式='".$arr_send[6]."',收费日期='".$arr_send[7]."'";
	$sql = "UPDATE ".$arrearage_record." SET 客户名称='".$arr_send[0]."',项目内容='".$arr_send[1]."',总收费='".$arr_send[2]."',规费='".$arr_send[3]."',管理费='".$arr_send[4]."',税费='".$arr_send[5]."',收费方式='".$arr_send[6]."',收费日期='".$arr_send[7]."'";
	$sql .= ",案源人='".$arr_send[8]."',代理人='".$arr_send[9]."',备注='".$arr_send[10]."',年月='".$ym."' WHERE id='".$myid."'";
//	echo $sql;
	
	if($conn->query($sql)){
		echo "修改成功";
	}else{
		echo "修改失败";
	}
	
}

$conn->close();	
?>