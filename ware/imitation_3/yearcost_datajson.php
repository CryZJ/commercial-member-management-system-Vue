<?php
header("Content-Type:application/json");

require_once "../../Aheader.php";
require_once "../../conn.php";
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
/*
 * 比较月日区间，返回boolean
 * */
function CompareMonthDay($temp,$startdate,$enddate){
	//获取要比较的日期的月日
	$tempMonth = date("m",strtotime($temp));
	$tempDay = date("d",strtotime($temp));
	//获取起始的日期的月日
	$startMonth = date("m",strtotime($startdate));
	$startDay = date("d",strtotime($startdate));
	//获取截止的日期的月日
	$endMonth = date("m",strtotime($enddate));
	$endDay = date("d",strtotime($enddate));
	//强制转为数字进行比较
	$tempnum = intval($tempMonth.$tempDay);
	$startnum = intval($startMonth.$startDay);
	$endnum = intval($endMonth.$endDay);
//	echo "tempnum: ".$tempnum.",startnum: ".$startnum.",endnum: ".$endnum."<br/><br/>";
	return ($tempnum>=$startnum && $tempnum<=$endnum);
}

@$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";

//$flag = "GetWaitNotice";

switch($flag){
	case "GetWaitNotice" :
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案_年费记录 WHERE DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='90' AND (状态='0' OR 状态='8') ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
	
	case "GetWaitNotice_NumberOfDay" :
		$numberofday = isset($_GET["numberofday"]) ? $_GET["numberofday"] : "90";
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案_年费记录 WHERE DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='".$numberofday."' AND (状态='0' OR 状态='8') ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
	
	case "GetWaitNotice_ApplicationDate" :
		$numberofday = isset($_GET["numberofday"]) ? $_GET["numberofday"] : "90";
		$startdate = isset($_GET["startdate"]) ? $_GET["startdate"] : "";
		$enddate = isset($_GET["enddate"]) ? $_GET["enddate"] : "";
		
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案_年费记录 WHERE DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='".$numberofday."' AND (状态='0' OR 状态='8') ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
//				if(strtotime($row["申请日"])>=strtotime($startdate) && strtotime($row["申请日"])<=strtotime($enddate)){
				if(CompareMonthDay($row["申请日"],$startdate,$enddate)){
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
					$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
					$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
					if($lcczy == "1"){
						$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
					}else{
						$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
					}
					$tempdata .= '}';
				}
				
			}
			if(strlen($tempdata) >0 ){
				$tempdata = substr($tempdata, 1);
			}
			$state = TRUE;
			$message = "获取成功";
			$retdata = '['.$tempdata.']';
		}else{
			$state = TRUE;
			$message = "没有数据";
		}
		break;
	
	case "GetWaitCharge":
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,通知书名 FROM 专案_年费记录 WHERE 状态='4' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				$tempdata .= ',"通知书生成日期":"'.$row["通知书生成日期"].'"';
				$tempdata .= ',"通知书名":"<a target=\"_blank\" href=\"Downloadfile.php?filename=../../filesave_notice/'.$row["通知书名"].'\">'.$row["通知书名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" disabled=\"disabled\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
		
	case "GetWaitPayment":
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,通知书名 FROM 专案_年费记录 WHERE 状态='1' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				$tempdata .= ',"通知书生成日期":"'.$row["通知书生成日期"].'"';
				$tempdata .= ',"通知书名":"<a target=\"_blank\" href=\"Downloadfile.php?filename=../../filesave_notice/'.$row["通知书名"].'\">'.$row["通知书名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<a class=\"btn btn-default\" disabled=\"disabled\" id=\"'.$row["id"].'\" data-toggle=\"modal\" href=\"#addModal\" onclick=\"Cost_alter(this)\">修改</a><input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
	
	case "GetWaitReceipt":
		$sql = "SELECT id,案卷号,年度,金额,通知书名,缴费时间,缴费文件名 FROM 专案_年费记录 WHERE 状态='2' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"通知书名":"<a target=\"_blank\" href=\"Downloadfile.php?filename=../../filesave_notice/'.$row["通知书名"].'\">'.$row["通知书名"].'</a>"';
				$tempdata .= ',"缴费时间":"'.$row["缴费时间"].'"';
				$tempdata .= ',"缴费文件名":"<a target=\"_blank\" href=\"Downloadfile.php?filename=../../filesave_notice/'.$row["缴费文件名"].'\">'.$row["缴费文件名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
		
	case "GetFinish":
		$sql = "SELECT id,案卷号,年度,金额,通知书名,缴费时间,文件名 FROM 专案_年费记录 WHERE 状态='3' ORDER BY 案卷号 ";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"通知书名":"<a target=\"_blank\" href=\"Downloadfile.php?filename=../../filesave_notice/'.$row["通知书名"].'\">'.$row["通知书名"].'</a>"';
				$tempdata .= ',"缴费时间":"'.$row["缴费时间"].'"';
				$tempdata .= ',"文件名":"<a target=\"_blank\" href=\"../../img_receipt/'.$row["文件名"].'\" >'.$row["文件名"].'</a>"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
		
	case "GetMonitoring":
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案_年费记录 WHERE 状态='0' ORDER BY 案卷号";
		$getannualfeedata = new GetAnnualFeeList($conn,$sql);
		$getannualfeedata->UseClass();
		if(!empty($getannualfeedata->sqldata_annualfee)){
			$tempdata = "";
			foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
				//整理数据
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
				$tempdata .= ',"计算日期":"'.$row["计算日期"].'"';
				if($lcczy == "1"){
					$tempdata .= ',"操作":"<input type=\"button\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}else{
					$tempdata .= ',"操作":"<input type=\"button\" disabled=\"disabled\" class=\"btn btn-danger\" id=\"'.$row["id"].'\" value=\"删除\" onclick=\"delf(this.id)\" />"';
				}
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
		
	case "GetTotalCheck":
		$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' ORDER BY 案卷号";
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
				$tempdata .= ',"应缴日期":"'.$row["应缴日期"].'"';
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