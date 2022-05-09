<?php
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



	header("charset=utf-8");
	include 'phpexcel/Classes/PHPExcel.php';
	require_once "classes/CheckCostOther.php";
	require_once "classes/GetAnnualFeeList.php";
	
//	$excel = new PHPExcel();
	
//	$excel = new PHPExcel_Writer_Excel5('国家申请或集成电路费用信息模板.xls');
	$path = 'excel_file/国家申请或集成电路费用信息模板.xls';
	$filesname = iconv("utf-8", "gbk", $path);
	$name = iconv("utf-8", "gbk", '国家申请或集成电路费用信息模板.xls');
	$excel = PHPExcel_IOFactory::load($filesname);
	
	/*写进头部*/
	$letter = array('A','B','C','D','E','F','G','H');
//	序号	申请号	费用种类	费用金额（共0人民币)	无效申请人
//	$tableheader = array('序号','申请号','费用种类','="费用金额（共"&SUM(D2:D5528)&"人民币）"');
//	for($i=0;$i<count($tableheader);$i++){
//		$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
//	}
	
	$id 	= $_GET['fid'];
	$file_name = $_GET['fname'];
	$feeflag = $_GET['feeflag'];
//	$id =  $_SERVER["QUERY_STRING"]; #id=5
	$fid = "";
	if(strpos($id, "/")){
		$fid = explode('/',$id);
	}else{
		$fid[0] = $id;
	}
	
	$len 	= count($fid);
	$data = "";
	require('conn.php');
	if($feeflag == "yearcost"){
		for($i=0;$i<$len;$i++){
			$sql = "SELECT id,案卷号,年度,金额 FROM 专案_年费记录 WHERE id='".$fid[$i]."' ORDER BY 案卷号;";
			$getannualfeedata = new GetAnnualFeeList($conn,$sql);
			$getannualfeedata->UseClass();
			foreach($getannualfeedata->sqldata_annualfee as $index => $datainfo){
				$case_type = get_type($datainfo['申请号']);
				$data[$i][0]=($i+1);
				$data[$i][1]=$datainfo['申请号'];
				$data[$i][2]=$case_type."第".$datainfo['年度']."年年费";
				$data[$i][3]=$datainfo['金额'];
		
				
			}
		}
	}else{
		for($i=0;$i<$len;$i++){
			$sql = "SELECT id,案卷号,费用名称,金额,年度 FROM 专案需交费用 WHERE id='".$fid[$i]."'";
			$result = $conn->query($sql);
			$row =$result->fetch_assoc();
			$ajh=$row['案卷号'];
			$sql2="SELECT 申请人 FROM 专利信息  WHERE 案卷号='$ajh'";
			$result2 = $conn->query($sql2);
			$row2 =$result2->fetch_assoc();
			$sqr=$row2['申请人'];			
			$getdata = new CheckCostOther($conn,$sql);
			$getdata->UsingClass();
			foreach($getdata->sqldata_return as $index => $datainfo){
				$case_type = get_type($datainfo['申请号']);
				if($datainfo['费用名称']=="年费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type."第".$datainfo['年度']."年年费";
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="申请费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="实审费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.'申请实质审查费';
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="登记费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="印花费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]="印花税";
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
				}else if($datainfo['费用名称']=="滞纳金"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type."年费".$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="公告印刷费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="复审费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="申请实质审查费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="权无效宣告请求费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}else if($datainfo['费用名称']=="权评价报告请求费"){
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$case_type.$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}
				else{
					$data[$i][0]=($i+1);
					$data[$i][1]=$datainfo['申请号'];
					$data[$i][2]=$datainfo['费用名称'];
					$data[$i][3]=$datainfo['金额'];
					$data[$i][4]=$sqr;
//					$i++;
				}
			}
		}
	}
	
	/*数据格式123*/
//	$data = array(
//					array('1','小黄','男','20','100'),
//					array('2','小李','男','20','101'),
//					array('3','小张','男','20','102'),
//					array('4','小赵','男','20','103')
//	);

	//写入数据
//	print_r($data);//Array ( [0] => Array ( [0] => 1 [1] => b6666 [2] => 第10年年费 [3] => 4000 ) )
	if($data == ""){
		exit("该“案卷号”的案件不存在");
	}
	for($i=2;$i<=count($data)+1;$i++){
		$j=0;
		foreach($data[$i-2] as $key=>$value){
			if($j==1){
				$excel->getActiveSheet()->setCellValueExplicit("$letter[$j]$i","$value",PHPExcel_Cell_DataType::TYPE_STRING);
			}else{
				$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
			}
			$j++;
		}
	}
	
//	print_r($excel);
//	$write = new PHPExcel_Writer_Excel5($excel);
/*	$write = new PHPExcel_Writer_Excel2007($excel);
	header("Pragma:public");
	header("Expires:0");
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header("Content-Type:application/force-dawnload");
	header("Content-Type:application/vnd.ms-execl");
	header("Content-Type:application/octet-stream");
	header("Content-Type:application/dawnload");
	header('Content-Disposition:attachment;filename='.$name);//文件名
	header("Content-Transfer-Encoding:binary");
	$write->save('php://output');
*/	
	$write = new PHPExcel_Writer_Excel2007($excel);
	$save_dir = "filesave_notice";
	if(!file_exists($save_dir)){
		mkdir ( $save_dir, 0777, true );
		chmod ( $save_dir, 0777 );
	}
	$down_path = $save_dir."/".$file_name;
	$write->save($down_path);
	//$file_name
	if(file_exists($down_path)){
//		$name = iconv("utf-8", "gbk", '国家申请或集成电路费用信息模板.xlsx');
		header("Location:downloadonefile.php?filepath=".$down_path."&filename=".$name);
		
//		header("Pragma:public");
////		header("Content-Type:application/dawnload");
//		header("Content-Type:application/x-xls");
//		header('content-disposition:attachment;filename='.$name);
//		header('content-length:'.filesize($down_path));
//		readfile($down_path);
	}


?>