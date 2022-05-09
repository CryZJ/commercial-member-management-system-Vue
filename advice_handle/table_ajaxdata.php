<?php
//header("Content-Type:application/json");

require_once "../Aheader.php";
require_once "../conn.php";

/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}

/*
 * $date_start:日期或时间戳
 * $y：变化的年数(-10,0,10,100.....)
 * $m:	变化的月数（-12~12）
 * $d：变化的天数（-15,15,20,30....)
*/
function Set_Date($date_start,$y,$m,$d){
	$str = $y."years,".$m."months,".$d."days";
	return date("Y-m-d",strtotime($str,strtotime($date_start)));
}

@$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";

$flag = "GetUpFilesHistoryData";

switch($flag){
	case "GetUpFilesHistoryData":
		
		$ret_data = array(
			"state"=>"0",
			"message"=>"服务器错误",
			"data"=>array()
		);
		
		$nowdate = date("Y-m-d");
		$beforedate = Set_Date($nowdate,0,0,-10);
		$sql = "SELECT id,文件名称,通知书名称,专利名称,案卷号,上传时间,案件分类,上传情况 FROM `临时文件` WHERE 上传时间 BETWEEN '".$beforedate."' AND '".$nowdate."' ORDER BY 上传时间 DESC";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			$i = 0;
			while($row = $result->fetch_assoc()){
				$ret_data["data"][$i] = $row;
				
				$i++;
			}
		}else{
			$ret_data["state"] = "1";
			$ret_data["message"] = "没有数据";
		}
		
		$json = json_encode($ret_data);
		echo $json;
		
		break;
	default:
		echo '{"state":"0","message":"没有对应的标志"}';
}



?>