<?php
require("../../AHeader.php");
require("../../conn.php");
/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}

$my_flag = $_REQUEST["my_flag"];
//$my_flag = "案件登记处理中";
//$ischeck = "11";

if($my_flag == "案件登记处理中"){
	$ischeck = $_GET["ischeck"];//是否有查询标志
	
	
	$msg_result = TRUE;
	$sql_data = "";
	$serror = "";
	
	if($ischeck == "有查询"){
		$ayr = $_GET["ayr"];
		$dlr = $_GET["dlr"];
		$sql = "select id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,状态,收费情况,备注 from 办公_案件基本登记   where  状态='0' ";
		if($ayr != ""){
			$sql .= "  AND 案源人='".$ayr."'";
		}
		if($dlr != ""){
			$sql .= "  AND 代理人='".$dlr."'";
		}
		$sql .= "  order by id desc";
	}else{
		$sql = "select id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,状态,收费情况,备注 from 办公_案件基本登记   where  状态='0' order by id desc";
	}
	
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$sql_data .= ','.'{"接单日期":"'.$row["接单日期"].'","案源人":"'.$row["案源人"].'","客户姓名":"'.$row["客户姓名"].'","接单内容":"<a href=\'casemark_alter.php?self_id='.$row["id"].'\' target=\'_blank\' >'.$row["接单内容"].'</a>","代理人":"'.$row["代理人"].'","处理情况":"'.$row["处理情况"].'","收费情况":"'.$row["收费情况"].'","预计完成时间":"'.$row["预计完成时间"].'","备注":"'.$row["备注"].'",';
			$sql_data .= '"操作":"<input type=\'button\' onclick=\'finish(\"'.$row["id"].'\")\' value=\'结案\' id=\'jiean'.$row["id"].'\'/><input type=\'button\' class=\'delete\' id=\''.$row["id"].'\'  value=\'删除\' />"}';
		}
		$sql_data = substr($sql_data, 1);
		
	}else{
		$msg_result = FALSE;
		$serror = "无数据";
	}
	$json_str = '{"data":['.$sql_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

if($my_flag == "案件登记已结案"){
	$msg_result = TRUE;
	$sql_data = "";
	$serror = "";
	$sql = "select id,接单日期,预计完成时间,实际完成时间,客户姓名,接单内容,案源人,代理人,处理情况,状态,收费情况,备注 from 办公_案件基本登记   where  状态='1' order by id desc";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$sql_data .= ','.'{"inputcheckbox":"<input class=\'boxson\' type=\'checkbox\' name=\''.$row["id"].'\' />","接单日期":"'.$row["接单日期"].'","案源人":"'.$row["案源人"].'","客户姓名":"'.$row["客户姓名"].'","接单内容":"<a href=\'casemark_review.php?self_id='.$row["id"].'\' target=\'_blank\' >'.$row["接单内容"].'</a>","代理人":"'.$row["代理人"].'","处理情况":"'.$row["处理情况"].'","收费情况":"'.$row["收费情况"].'","预计完成时间":"'.$row["预计完成时间"].'","实际完成时间":"'.$row["实际完成时间"].'","备注":"'.$row["备注"].'",';
			$sql_data .= '"操作":"<input type=\'button\' class=\'delete\' id=\''.$row["id"].'\'  value=\'删除\' />"}';
		}
		$sql_data = substr($sql_data, 1);
		
	}else{
		$msg_result = FALSE;
		$serror = "无数据";
	}
	$json_str = '{"data":['.$sql_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

$conn->close();
?>