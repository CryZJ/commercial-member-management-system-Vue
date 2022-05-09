<?php
header("charset:utf-8");
include 'Classes/PHPExcel.php';
require_once "../conn.php";
//require_once "../AHeader.php";
require_once "../classes/GetAnnualFeePayment.php";

/*根据申请号获取案件类型*/
function get_type($str){
	$return_type = "";
	$num = substr($str,4,1);
	switch($num){
		case 1 : 
			$return_type = "发明专利";
			break;
		case 2 :
			$return_type = "实用新型专利";
			break;
		case 3 :
			$return_type = "外观设计专利";
	}
	return $return_type;
}
/*毫秒级的时间戳*/
function getMillisecond() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}

//print_r($_REQUEST);
//Array
//(
//  [PHPSESSID] => n0upcu1p8a1gcotrdmrrmjf9b1
//  [my_flag] => UpdateAndCreate
//  [costidstr] => 23281,23290
//  [data] => Array
//      (
//          [23281] => 94.5
//          [23290] => 94.5
//      )
//
//)
/*
 * 接收数据并进行更新数据库“专案_年费记录”
 * */
$costidstr = isset($_POST["costidstr"])?$_POST["costidstr"]:"";
$data_arr = isset($_POST["data"])?$_POST["data"] : array();
$nowdate	= date('Y-m-d');//获取当前日期

$ret_data = array(
	"state"=>"0",
	"message"=>"",
	"filename"=>""
);

//获取毫秒级时间戳
$msectime =  getMillisecond();
//文件名
$FileName = $msectime.$userid.'.xls';
$ret_data["filename"] = $FileName;

$sql = "SELECT id,处理状态 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$costidstr."')";
$result = $conn->query($sql);
if($result->num_rows > 0){
	while($row = $result->fetch_row()){
		$sql = "UPDATE 专案_年费记录 SET 缴费处理人='".$name."',缴费文件名='".$FileName."',系统确认时间='".$nowdate."',缴费时间='".$nowdate."',滞纳金='".$data_arr[$row[0]]."',状态='3',处理状态='".$row[1]."2"."' WHERE id='".$row[0]."'";
		if(!$conn->query($sql)){
			$ret_data["message"] .= ",id为".$row[0]."更新失败";
		}
	}
}

/*
 * 装载信息到Excel中
 * */
//读取模板
$path = '../excel_file/国家申请或集成电路费用信息模板.xls';
$filesname = iconv("utf-8", "gbk", $path);
$name = iconv("utf-8", "gbk", '国家申请或集成电路费用信息模板.xls');
$excel = PHPExcel_IOFactory::load($filesname); 
//写进头部
$letter = array('A','B','C','D','E','F','G','H'); 
$sql = "SELECT id,案卷号,年度,金额,滞纳金 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$costidstr."') ORDER BY 案卷号;";
//$sql = "SELECT a.id,a.案卷号,a.年度,a.金额,a.滞纳金,b.申请人  FROM 专案_年费记录 a,专利信息  b,WHERE FIND_IN_SET(a.id,'".$costidstr."') and a.案卷号=b.案卷号 ORDER BY 案卷号 ;";
	
$getannualfeedata = new GetAnnualFeePayment($conn,$sql,$costidstr);
$getannualfeedata->UseClass();

if(count($getannualfeedata->sqldata_annualfee) > 0){
	$i = 1;
	foreach($getannualfeedata->sqldata_annualfee as $index_is => $datainfo){
		$case_type = get_type($datainfo['申请号']);
		$feename = $case_type."第".$datainfo['年度']."年年费";
		
		$excel->getActiveSheet()->setCellValue("A".($i+1),$i);
		$excel->getActiveSheet()->setCellValueExplicit("B".($i+1),$datainfo["申请号"],PHPExcel_Cell_DataType::TYPE_STRING);
		$excel->getActiveSheet()->setCellValue("C".($i+1),$feename);
		$excel->getActiveSheet()->setCellValue("D".($i+1),$datainfo["金额"]);
		$excel->getActiveSheet()->setCellValue("E".($i+1),$datainfo["申请人"]);
		
		$i++;
		if(!empty($datainfo["滞纳金"]) && $datainfo["滞纳金"] != "0.00"){			
			$feename = $case_type."年费滞纳金";
			$excel->getActiveSheet()->setCellValue("A".($i+1),$i);
			$excel->getActiveSheet()->setCellValueExplicit("B".($i+1),$datainfo["申请号"],PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->getActiveSheet()->setCellValue("C".($i+1),$feename);
			$excel->getActiveSheet()->setCellValue("D".($i+1),$datainfo["滞纳金"]);
			$excel->getActiveSheet()->setCellValue("E".($i+1),$datainfo["申请人"]);
			
			$i++;
		}
	}
	
	//保存新Excel文件
	$write = new PHPExcel_Writer_Excel2007($excel);
	$save_dir = "../filesave_notice";
	if(!file_exists($save_dir)){
		mkdir ( $save_dir, 0777, true );
		chmod ( $save_dir, 0777 );
	}
	$down_path = $save_dir."/".$FileName;
	$write->save($down_path);
	
	$ret_data["state"] = "1";
	
	
}else{
	$ret_data["message"] .= ",没有数据";
}

$json = json_encode($ret_data);
echo $json;

?>