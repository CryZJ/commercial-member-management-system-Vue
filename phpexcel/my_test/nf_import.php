<?php
//require("../Classes/PHPExcel.php");
//require("../Classes/PHPExcel/Reader/Excel2007.php");
require("../Classes/PHPExcel/IOFactory.php");
require("../../conn.php");

$filename = "file_excel/年费.xls";
$path_info = pathinfo($filename);
//print_r($path_info);
$ext = $path_info["extension"];
$filename = iconv("utf-8", "gbk", $filename);
if(file_exists($filename)){
	if($ext == "xlsx" || $ext == "xls"){
		$reader = PHPExcel_IOFactory::createReader('Excel5');
	}else{
		exit("文件类型不对！");
	}	
}else{
	exit("数据读取失败，文件不存在！");
}

$PHPExcel = $reader->load($filename); // 载入文件
$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表  
$highestRow = $sheet->getHighestRow(); // 取得总行数  
$highestColumm = $sheet->getHighestColumn(); // 取得总列数  
$arr = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J', 11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O', 16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T', 21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y', 26 => 'Z', 27=>'AA',28=>'AB',29=>'AC',30=>'AD');

echo $highestRow."//".$highestColumm."<br/>";//输出行数与列数

/** 循环读取每个单元格的数据 */
//echo "<table border='1'>";
//for($row=2;$row<=$highestRow;$row++){//行循环
//	echo "<tr>";
//	for($column = 'A';$column <= 'S';$column++){//列循环
//		echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";
//	}
//	echo "</tr>";
//}
//echo "</table>";

//装载数据
$data_excel = "";
$i = 0;
for($row=2;$row<=$highestRow;$row++){//行循环
//	for($column = 'A';$column <= 'X';$column++){//列循环
//		$data_excel[$i][] = $sheet->getCell($column.$row)->getValue();
//	}
	for($j=1;$j<20;$j++){
		if($j == 7){
			$data_excel[$i][] =  date("Y-m-d",($sheet->getCell($arr[$j].$row)->getValue()-25569)*24*60*60);
		}else{
			$data_excel[$i][] = $sheet->getCell($arr[$j].$row)->getValue();
		}
	}
	$i++;
}   
//print_r($data_excel);

/*
 * Get_ajh()生成案卷号
 * 参数：
 * $bh：编号
 * $lx_str：案件的类型
 * */
function Get_ajh($bh,$lx_str){
	$len = strlen($bh);
	$ajh_num="";//案卷号前部的数字
	switch($len){
		case 1:
			$ajh_num = '0000'.$bh;
			break;
		case 2:
			$ajh_num = '000'.$bh;
			break;
		case 3:
			$ajh_num = '00'.$bh;
			break;
		case 4:
			$ajh_num = '0'.$bh;
			break;
		case 5:
			$ajh_num = $bh;
			break;
		default:
			$ajh_num = $bh;
	}
	$lx = "";//案件的类型
	switch($lx_str){
		case "发明专利":
			$lx = "1";
			break;
		case "实用新型":
			$lx = "2";
			break;
		case "外观设计":
			$lx = "3";
			break;
		default:
			$lx = "0";
	}
	if($lx=="0"){
		return "failure";
	}else{
		return $ajh_num."00".$lx."00";//生成的案卷号
	}
}

/*判断申请人是否存在*/
function PanDuan_sqr($sqr_name){
	require("../../conn.php");
	$sql = "SELECT id FROM 申请人 WHERE 申请人='".$sqr_name."' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sqr_id = "";
		while($row = $result->fetch_assoc()){
			$sqr_id = $row['id'];
		}
		return $sqr_id;
	}else{
		return FALSE;
	}
	$conn->close();
}

/*增加日期的监控
 * $date_start:日期或时间戳
 * $y：变化的年数(-10,0,10,100.....)
 * $m:	变化的月数（-12~12）
 * $d：变化的天数（-15,15,20,30....)
*/
function Set_Date($date_start,$y,$m,$d){
	$str = $y."years,".$m."months,".$d."days";
	return date("Y-m-d",strtotime($str,strtotime($date_start)));
}

/*
 * 保存滞纳金
 * */
function Create_znj($ajh,$aj_type,$year_num,$end_date){
	require("../../conn.php");
	$msg_failure = "";
	$cost = "";
	$sql = "SELECT 金额 FROM 年费设置 WHERE 专利类型='".$aj_type."' AND 费减比='100' AND 年度='".$year_num."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$cost = $row['金额'];
		}
	}
	for($i=1;$i<6;$i++){
		$sql = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
		$sql .= "'".$ajh."','".$year_num."','".$i."','".$cost*(0.05*$i)."','".Set_Date($end_date,$year_num,1,0)."','".Set_Date($end_date,$year_num,1+$i,0)."')";
		if(!$conn->query($sql)){
			$msg_failure .= "案卷号：".$ajh."年度：".$year_num."期数：".$i."保存失败！\n";
		}
	}
	$conn->close();
	return $msg_failure;
}

$data_default = "";//处理失败的数据
$data_default = array();
$error_num = 0;//失败数量

$error_msg = "";

foreach($data_excel as $ky => $data_info){
	$sqr_id = PanDuan_sqr($data_info[4]);
	if($sqr_id){//判断申请人是否存在
		$ajh = Get_ajh($data_info[1],$data_info[2]);
		if($ajh != "failure"){//创建案卷号
			//保存案件信息
			$sql = "INSERT INTO 专案_年费(专利名称,申请号,申请日,申请人,申请人id,类型,案源人,代理人,案卷号,首年度,登记人,状态,原案卷号,创建时间,原案卷状态) VALUES(";
			$sql .= "'".$data_info[5]."','".$data_info[3]."','".$data_info[6]."','".$data_info[4]."','".$sqr_id."','".$data_info[2]."','".$data_info[7]."','".$data_info[7]."','".$ajh."','1','管理员','年费中','".$data_info[1]."','".date("Y-m-d H:i:s")."','年费中')";
			if($conn->query($sql)){
				//保存年费信息
				for($year_index = 10;$year_index<19;$year_index++){
					if($data_info[$year_index] != ""){//费用金额不为空
						$year_num = $year_index-8;
						$remad_date = Set_Date($data_info[6],$year_num-1,-1,0);
						$end_date = Set_Date($data_info[6],$year_num-1,1,0);
						
						$sql = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期) VALUES(";
						$sql .= "'".$ajh."','".$year_num."','".$data_info[$year_index]."','".$remad_date."','".$end_date."')";
						if($conn->query($sql)){
							$error_msg .= Create_znj($ajh,$data_info[2],$year_num,$end_date);
							$error_msg .= "\n";
						}else{
							$error_msg .= "案卷号：".$ajh.",年度：".$year_num."保存失败！\n";
						}
					}
				}
				
			}else{
				$data_default[$error_num] = $data_info;
				$data_default[$error_num]["error_msg"] = "案件保存失败";
				$error_num++;
				continue;
			}
		}else{
			$data_default[$error_num] = $data_info;
			$data_default[$error_num]["error_msg"] = "案卷号创建失败";
			$error_num++;
			continue;
		}
	}else{
		$data_default[$error_num] = $data_info;
		$data_default[$error_num]["error_msg"] = "申请人不存在";
		$error_num++;
		continue;
	}
}
	


//--------------------------------------------------------将导入失败数据写入Excel表----------------------------------------------------------------------------------------
//创建Excel对象
$objPHPExcel = new PHPExcel(); 
//Set properties 设置文件属性  这部分随意
$objPHPExcel->getProperties()->setCreator("KingShen");  
$objPHPExcel->getProperties()->setLastModifiedBy("KingShen");  
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test 申请人导入失败");  
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");  
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX,申请人导入失败");  
$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");  
$objPHPExcel->getProperties()->setCategory("Test result file"); 
//Rename sheet 重命名工作表标签  
$objPHPExcel->getActiveSheet()->setTitle('sheet1');  
/*写进头部*/
$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
//Set column widths 设置列宽度 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
//编写表字段
$objPHPExcel->getActiveSheet()->setCellValue('A1','状态');
$objPHPExcel->getActiveSheet()->setCellValue('B1','编号');
$objPHPExcel->getActiveSheet()->setCellValue('C1','类型');
$objPHPExcel->getActiveSheet()->setCellValue('D1','申请号');
$objPHPExcel->getActiveSheet()->setCellValue('E1','申请人');
$objPHPExcel->getActiveSheet()->setCellValue('F1','名称');
$objPHPExcel->getActiveSheet()->setCellValue('G1','申请日');
$objPHPExcel->getActiveSheet()->setCellValue('H1','业务人');
$objPHPExcel->getActiveSheet()->setCellValue('I1','申请');
$objPHPExcel->getActiveSheet()->setCellValue('J1','年登');
$objPHPExcel->getActiveSheet()->setCellValue('K1','第2年');
$objPHPExcel->getActiveSheet()->setCellValue('L1','第3年');
$objPHPExcel->getActiveSheet()->setCellValue('M1','第4年');
$objPHPExcel->getActiveSheet()->setCellValue('N1','第5年');
$objPHPExcel->getActiveSheet()->setCellValue('O1','第6年');
$objPHPExcel->getActiveSheet()->setCellValue('P1','第7年');
$objPHPExcel->getActiveSheet()->setCellValue('Q1','第8年');
$objPHPExcel->getActiveSheet()->setCellValue('R1','第9年');
$objPHPExcel->getActiveSheet()->setCellValue('S1','第10年');

//居中
foreach($letter as $ky => $column){
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中 	
}

$i = 2;
foreach($data_default as $ky_my => $errordatainfo){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$errordatainfo[0]);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$errordatainfo[1]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$errordatainfo[2]);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$i,$errordatainfo[3],PHPExcel_Cell_DataType::TYPE_STRING);//显示字符串
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$errordatainfo[4]);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$errordatainfo[5]);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$errordatainfo[6]);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$errordatainfo[7]);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$errordatainfo[8]);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$errordatainfo[9]);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$errordatainfo[10]);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$errordatainfo[11]);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$errordatainfo[12]);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i,$errordatainfo[13]);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i,$errordatainfo[14]);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$i,$errordatainfo[15]);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i,$errordatainfo[16]);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$i,$errordatainfo[17]);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$i,$errordatainfo[18]);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.$i,$errordatainfo["error_msg"]);
	
	$i++;
}

//保存
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);  
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save("file_excel/nf_errordata.xlsx");



?>