<?php
require_once "../../Aheader.php";
require_once "../../conn.php";
require_once "../../classes/AddApplicant.php";
require_once "../../classes/CheckCostOther.php";

/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}

//验证身份是否是“流程操作员”
if(!$lcczy == "1"){
	echo '{"state":"0","message":"您没有权限操作"}';
	exit();
}

@$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";

switch($flag){
	case "Charge":
		$costid = $_GET["costid"];
		
		$ret_arr = array(
			"state"=>"0",
			"message"=>"服务器错误",
			"data"=>array()
		);
		
		if(strlen($costid)>0){
			$sql = "UPDATE 专案需交费用 SET 状态='1' WHERE FIND_IN_SET(id,'".$costid."')";
			if($conn->query($sql)){
				$ret_arr["state"] = "1";
				$ret_arr["message"] = "更改成功";
			}else{
				$ret_arr["message"] = "更改失败";
			}
		}else{
			$ret_arr["message"] = "更改失败";
		}
		$json = json_encode($ret_arr);
		echo $json;
		
		break;
	default :
		echo '{"state":"0","message":"没有对应的flag"}';
}

?>