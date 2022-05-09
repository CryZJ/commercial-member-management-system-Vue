<?php
require_once "../../Aheader.php";
require_once "../../conn.php";
require_once "../../classes/AddApplicant.php";
require_once "../../classes/CheckCostOther.php";
require_once "../../classes/GetAnnualFeeList.php";//获取年费+案件数据

/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}


@$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";

//$flag = "GetAuthorization_authorization";

switch($flag){
	case "GetWaitCharge_application"://申请费的待收费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='1' AND 状态='4'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" disabled=\"disabled\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
	
	case "GetWaitPayment_application"://申请费的待缴费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='1' AND 状态='1'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" disabled=\"disabled\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}

		break;
	
	case "GetWaitReceipt_application"://申请费的待收据
		$sql = "SELECT id,案卷号,费用名称,金额,缴费文件名,缴费时间 FROM 专案需交费用 WHERE 费用来源='1' AND 状态='2' AND (收据上传日期='0' OR 收据上传日期 = '')";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"缴费文件名":"<a target=\"_blank\" href=\"../../filesave_notice/'.$datainfo["缴费文件名"].'\">'.$datainfo["缴费文件名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
	
	case "GetFinish_application"://申请费的已完成
		$sql = "SELECT id,案卷号,费用名称,金额,缴费时间,文件名 FROM 专案需交费用 WHERE 状态='3' AND 收据上传日期 !='0' AND 状态<>'9' AND 费用来源='1'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"操作":"<a target=\"_blank\" href=\"../../img_receipt/'.$datainfo["文件名"].'\" >'.$datainfo["文件名"].'</a>"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
	
	case "GetWaitCharge_other"://其他费的待收费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='0' AND 状态='4'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" disabled=\"disabled\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" disabled=\"disabled\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
		
	case "GetWaitPayment_other"://其他费的待缴费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='0' AND 状态='1'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" disabled=\"disabled\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" disabled=\"disabled\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
	
	case "GetWaitReceipt_other"://其他费的待收据
		$sql = "SELECT id,案卷号,费用名称,金额,缴费文件名,缴费时间 FROM 专案需交费用 WHERE 费用来源='0' AND 状态='2' AND (收据上传日期='0' OR 收据上传日期 = '')";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"缴费文件名":"<a target=\"_blank\" href=\"../../filesave_notice/'.$datainfo["缴费文件名"].'\">'.$datainfo["缴费文件名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_1\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_1\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
	
	case "GetFinish_other"://其他费的已完成
		$sql = "SELECT id,案卷号,费用名称,金额,缴费时间,文件名 FROM 专案需交费用 WHERE 状态='3' AND 收据上传日期 !='0' AND 状态<>'9' AND 费用来源='0'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"操作":"<a target=\"_blank\" href=\"../../img_receipt/'.$datainfo["文件名"].'\" >'.$datainfo["文件名"].'</a>"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
		
	case "GetWaitNotice_authorization" ://授权费的待通知
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='2' AND 状态='0'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\"  value=\"删除\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" disabled=\"disabled\"  value=\"删除\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		break;
	
	case "GetWaitCharge_authorization" ://授权费的待收费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='2' AND 状态='4'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_5\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_5\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_5\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_5\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
	
	case "GetWaitPayment_authorization" ://授权费的待缴费
		$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='2' AND 状态='1'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$datainfo["缴费期限"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"计算日期":"'.$datainfo["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$datainfo["id"].'\" data-toggle=\"modal\" href=\"#addModal\" name=\"dynamic-table_3\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_3\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
			
	case "GetWaitReceipt_authorization" ://授权费的待收据
		$sql = "SELECT id,案卷号,费用名称,金额,缴费文件名,缴费时间 FROM 专案需交费用 WHERE 费用来源='2' AND 状态='2' AND (收据上传日期='0' OR 收据上传日期 = '')";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"金额":"'.$datainfo["金额"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"缴费文件名":"<a target=\"_blank\" href=\"../../filesave_notice/'.$datainfo["缴费文件名"].'\">'.$datainfo["缴费文件名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_4\" value=\"删除\" onclick=\"delf(this)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$datainfo["id"].'\" name=\"dynamic-table_4\" value=\"删除\" onclick=\"delf(this)\" />"';
				}
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		
		break;
	
	case "GetFinish_authorization" ://授权费的已完成
		$sql = "SELECT id,案卷号,费用名称,金额,缴费时间,文件名 FROM 专案需交费用 WHERE 状态='3' AND 状态<>'9' AND 费用来源='2'";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$datainfo["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"id":"'.$datainfo["id"].'"';
				$tempdata .= ',"缴费时间":"'.$datainfo["缴费时间"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"费用名称":"'.$datainfo["费用名称"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
				$tempdata .= ',"操作":"<a target=\"_blank\" href=\"../../img_receipt/'.$datainfo["文件名"].'\" >'.$datainfo["文件名"].'</a>"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
		
	case "GetAuthorization_authorization" ://授权费的通知书列表
		$sql = "SELECT id,案卷号,通知书生成日期,通知书名 FROM 专案需交费用 WHERE 费用来源='2' AND NOT ISNULL(通知书名) AND 通知书生成日期<>'0' GROUP BY 案卷号 ORDER BY 通知书生成日期 DESC;";
		$getdata = new CheckCostOther($conn,$sql);
		$getdata->UsingClass();
		$tempdata = "";
		if($getdata->sqldata_count > 0){
			foreach($getdata->sqldata_return as $index => $datainfo){
				//整理数据
				foreach($datainfo as $ky => $v){
					$datainfo[$ky] = Settle_string($v);
				}
				$tempdata .= ','.'{';
				$tempdata .= '"案卷号":"'.$datainfo["案卷号"].'"';
				$tempdata .= ',"申请号":"'.$datainfo["申请号"].'"';
				$tempdata .= ',"通知书生成日期":"'.$datainfo["通知书生成日期"].'"';
				$tempdata .= ',"申请人":"'.$datainfo["申请人"].'"';
				$tempdata .= ',"申请日":"'.$datainfo["申请日"].'"';
				$tempdata .= ',"专利名称":"'.$datainfo["专利名称"].'"';
//				$tempdata .= ',"操作":"<a type=\"button\" class=\"btn btn-danger\" href=\"../../filesave_notice/'.$datainfo["通知书名"].'\" >下载</a>"';
				$tempdata .= ',"操作":"<a type=\"button\" class=\"btn btn-danger\" href=\"downloadonefile.php?filepath=../../filesave_notice/'.$datainfo["通知书名"].'&filename='.$datainfo["申请人"].'.docx'.'\" >下载</a>"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "无数据";
		}
		
		break;
		
		
//	总查询==专利申请费用============================	
		case "GetTotalCheck":
//		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' and `通知书生成日期`<>0 ORDER BY 案卷号";
//		$sql ="SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='2' AND 状态<>'9' and `通知书生成日期`<>0 ORDER BY 案卷号;";
//		$sql="SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='3' AND 状态<>'9' and `通知书生成日期`<>0 ORDER BY 案卷号;";
		$sql="SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='3' AND 状态<>'9' AND 收据上传日期 !='0' AND 费用来源='1' ORDER BY 案卷号;";
		
//		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
				$row["通知书生成日期"] = empty($row["通知书生成日期"]) ? "未通知" : $row["通知书生成日期"];
				$row["缴费时间"] = empty($row["缴费时间"]) ? "未缴费" : $row["缴费时间"];
				$row["收据上传日期"] = empty($row["收据上传日期"]) ? "未上传" : $row["收据上传日期"];
				
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$row["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$row["案卷号"].'"';
				$tempdata .= ',"专利名称":"'.$row["专利名称"].'"';
				$tempdata .= ',"id":"'.$row["id"].'"';
				$tempdata .= ',"申请人":"'.$row["申请人"].'"';
				$tempdata .= ',"申请号":"'.$row["申请号"].'"';
				$tempdata .= ',"申请日":"'.$row["申请日"].'"';
				$tempdata .= ',"年度":"'.$row["年度"].'"';
				$tempdata .= ',"金额":"'.$row["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$row["缴费期限"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				$tempdata .= ',"通知书生成日期":"'.$row["通知书生成日期"].'"';
				$tempdata .= ',"缴费时间":"'.$row["缴费时间"].'"';
				$tempdata .= ',"收据上传日期":"'.$row["收据上传日期"].'"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "没有数据";
		}
		break;
		
		
		
//		//	总查询==专利授权费用============================	
	case "GetTotalCheckzlsq":
//		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' and `通知书生成日期`<>0 ORDER BY 案卷号";
		$sql ="SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='3' AND 状态<>'9' and `通知书生成日期`<>0  AND 费用来源='2'  ORDER BY 案卷号;";
		
//		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
				$row["通知书生成日期"] = empty($row["通知书生成日期"]) ? "未通知" : $row["通知书生成日期"];
				$row["缴费时间"] = empty($row["缴费时间"]) ? "未缴费" : $row["缴费时间"];
				$row["收据上传日期"] = empty($row["收据上传日期"]) ? "未上传" : $row["收据上传日期"];
				
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$row["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$row["案卷号"].'"';
				$tempdata .= ',"专利名称":"'.$row["专利名称"].'"';
				$tempdata .= ',"id":"'.$row["id"].'"';
				$tempdata .= ',"申请人":"'.$row["申请人"].'"';
				$tempdata .= ',"申请号":"'.$row["申请号"].'"';
				$tempdata .= ',"申请日":"'.$row["申请日"].'"';
				$tempdata .= ',"年度":"'.$row["年度"].'"';
				$tempdata .= ',"金额":"'.$row["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$row["缴费期限"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				$tempdata .= ',"通知书生成日期":"'.$row["通知书生成日期"].'"';
				$tempdata .= ',"缴费时间":"'.$row["缴费时间"].'"';
				$tempdata .= ',"收据上传日期":"'.$row["收据上传日期"].'"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "没有数据";
		}
		break;
		
		//		//	总查询==专利其他费用============================	
	case "GetTotalCheckother":
		$sql = "SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='3' AND 状态<>'9' and 收据上传日期 !='0'  AND 费用来源='0'  ORDER BY 案卷号;";
//		$sql ="SELECT id,案卷号,年度,金额,`缴费期限`,DATEDIFF(`缴费期限`,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM `专案需交费用` WHERE 状态='3' AND 状态<>'9' and `通知书生成日期`<>0  AND 费用来源='0'  ORDER BY 案卷号;";
		
//		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
				$row["通知书生成日期"] = empty($row["通知书生成日期"]) ? "未通知" : $row["通知书生成日期"];
				$row["缴费时间"] = empty($row["缴费时间"]) ? "未缴费" : $row["缴费时间"];
				$row["收据上传日期"] = empty($row["收据上传日期"]) ? "未上传" : $row["收据上传日期"];
				
				$tempdata .= ','.'{';
				$tempdata .= '"checkbox":"<input type=\"checkbox\" id=\"'.$row["id"].'\">"';
				$tempdata .= ',"案卷号":"'.$row["案卷号"].'"';
				$tempdata .= ',"专利名称":"'.$row["专利名称"].'"';
				$tempdata .= ',"id":"'.$row["id"].'"';
				$tempdata .= ',"申请人":"'.$row["申请人"].'"';
				$tempdata .= ',"申请号":"'.$row["申请号"].'"';
				$tempdata .= ',"申请日":"'.$row["申请日"].'"';
				$tempdata .= ',"年度":"'.$row["年度"].'"';
				$tempdata .= ',"金额":"'.$row["金额"].'"';
				$tempdata .= ',"缴费期限":"'.$row["缴费期限"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				$tempdata .= ',"通知书生成日期":"'.$row["通知书生成日期"].'"';
				$tempdata .= ',"缴费时间":"'.$row["缴费时间"].'"';
				$tempdata .= ',"收据上传日期":"'.$row["收据上传日期"].'"';
				$tempdata .= '}';
			}
			$tempdata = substr($tempdata, 1);
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "没有数据";
		}
		break;
				
	default :
		$message = "flag错误！";
		break;
}


$state = isset($state) ? $state : FALSE;
$message = isset($message) ? $message : "服务器错误";
$retdata = isset($retdata) ? $retdata : '[]';

$json = '{"state":"'.$state.'","message":"'.$message.'","data":'.$retdata.'}';
echo $json;
?>