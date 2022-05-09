<?php
require("../../../conn.php");

$flag = $_REQUEST['flag'];

	//保存专利案件备注修改
	if($flag == "save_rjbz"){
		$str_ajh = $_GET['str_ajh'];
		$str_bz = $_GET['str_bz'];
		
		$sql = "UPDATE 软件_信息 SET 案件备注='".$str_bz."' WHERE 案卷号='".$str_ajh."'";
		if($conn->query($sql)){
			echo "保存成功！";
		}else{
			echo "保存失败！";
		}
	}
	//修改详情的信息：软件名称，案源人，代理人，申请日
	if($flag == "ChanCaseMes"){
		$Mes = $_GET["Mes"];//修改内容
		$Text = $_GET["Text"];//修改字段
		$ajhT = $_GET["ajhT"];//对应案卷号
		$sql = "UPDATE 软件_信息 SET ".$Text."='".$Mes."'"."WHERE 案卷号='".$ajhT."'";
		if($conn->query($sql)){
			echo "ok";
		}else{
			echo "failed";
		}
	}	


$conn->close();
?>