<?php
require'../../AHeader.php';
require'../../conn.php';
	
$flag = $_REQUEST["flag"];	
	
if($flag == "CreateAJH"){
	$sendmsg = $_GET["sendmsg"];//顺序：案卷号，类型，案源人，代理人
	$data_arr = explode("#$#",$sendmsg);
	$msg_result = TRUE;
	$num_str = substr($data_arr[0], 0,5);//五位流水号
	$num_lx = "";//类型对应数字
	switch($data_arr[1]){
		case "发明专利":
			$num_lx = "1";
			break;
		case "实用新型":
			$num_lx = "2";
			break;
		case "外观设计":
			$num_lx = "3";
			break;
		default:
			$msg_result = FALSE;
	}
	//获取案源人的案源人编号
	$str_ayr = "";//案源人编号
	$sql = "SELECT 编号 FROM 案源人信息 WHERE 名称='".$data_arr[2]."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			$str_ayr = $row[0];
		}
	}else{
		$msg_result = FALSE;
	}
	//获取案源人的案源人编号
	$str_dlr = "";//案源人编号
	$sql2 = "SELECT 编号 FROM 代理人信息 WHERE 名称='".$data_arr[3]."'";
	$result = $conn->query($sql2);
	if($result->num_rows>0){
		while($row2 = $result->fetch_row()){
			$str_dlr = $row2[0];
		}
	}else{
		$msg_result = FALSE;
	}
	$ajh_new = $num_str.$str_ayr.$num_lx.$str_dlr;
	$ajh_new = trim($ajh_new);
	$ajh_new = str_replace(" ", "", $ajh_new);
	$json = '{"result":"'.$msg_result.'","ajh_new":"'.$ajh_new.'","sql":"'.$sql.'","sql2":"'.$sql2.'"}';
	echo $json;
}	
	
if($flag == "Save_data"){
	$Old_ajid = $_GET["Old_ajid"];	
	$sqrid  = $_GET['sqrid'];
	$zlm 	= $_GET['zlm'];
	$ayr	= $_GET['ayr'];
	$dlr 	= $_GET['dlr'];
	$ajh 	= $_GET['ajh'];
	
	$time = date("Y-m-d");//获取当前时间
	
	$type = substr($ajh , 7 , 1);
//	echo $type;
	if($type == 1){
		$type = '发明专利';
	}else if($type == 2){
		$type = '实用新型';
	}else{
		$type = '外观设计';
	}
	
	//保存表-专利信息
		//删除之前创建的用于占位的案卷号
		$sql_del = "delete from `专利信息` where id='".$Old_ajid."'";
		$result_del = $conn->query($sql_del);
		//保存专案信息
		$sqrAL = "";
		$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$sqrid."')";
		$result8 = $conn->query($sql8);
		if($result8 ->num_rows>0){
			while($row8 = $result8->fetch_assoc()){
				$sqrAL = $row8["申请人"];
			}
		}
		$sql3 = "insert into 专利信息(案卷号,类型,案源人,代理人,专利名称,状态,提交时间,证书状态,申请人id,申请人,创建人)";
		$sql3 .= "values('".$ajh."','".$type."','".$ayr."','".$dlr."','".$zlm."','待提交','".$time."','未登记','".$sqrid."','".$sqrAL."','".$name."')";
		$result3 = $conn->query($sql3);
		//查找案源人代理人信息
			//案源人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$ayr."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$ayrid = $row_sqrid['id'];//案源人代理id
				$ayrsonid = $row_sqrid['sonid'];//案源人用户id
			}
		}
			//代理人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$dlr."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$dlrid = $row_sqrid['id'];//代理人代理id
				$dlrsonid = $row_sqrid['sonid'];//代理人用户id
			}
		}
		//保存专案_可见表，确定谁可见
		$sql_view = "insert into `专案_可见`(案卷号,ctype,创建时间,创建人,案源可见id,案源可见人,案源代理id,代理可见id,代理可见人,代理代理id)  ";
			$sql_view .= "values('".$ajh."','0','".$time."','".$name."','".$ayrid."','".$ayr."','".$ayrsonid."','".$dlrid."','".$dlr."','".$dlrsonid."')";
		$result_view = $conn->query($sql_view);
		
		//专案操作记录
		$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他)  values('".$name."','新建','".$ajh."','".$time."')";
		$resultHIS = $conn->query($sqlHIS);
	
	if($result3){//用于测试数据是否保存成功
		echo 1;//判断是否输出成功
//		echo $sql3;
	}else{
		echo 0;//判断是否输出失败
	}
}	

$conn->close();	
?>