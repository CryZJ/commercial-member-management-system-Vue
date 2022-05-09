<?php
/*
 * 申请人导入数据
 * */

require("../Classes/PHPExcel.php");
require("../Classes/PHPExcel/Reader/Excel2007.php");
require("../Classes/PHPExcel/IOFactory.php");
require("../../conn.php");


$filename = "file_excel/20180424Client_i.xls";
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
$arr = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J', 11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O', 16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T', 21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y', 26 => 'Z');

echo "行数：".$highestRow."//列数：".$highestColumm."<br/>";

/** 循环读取每个单元格的数据 */
//echo "<table border='1'>";
//for($row=1;$row<=$highestRow;$row++){//行循环
//	echo "<tr>";
//	for($column = 'A';$column <= 'J';$column++){//列循环
//		echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";
//	}
//	echo "</tr>";
//}
//echo "</table>";

$getdataforexcel = "";//装载Excel数据的数组

for($row=2;$row<=$highestRow;$row++){//行循环
	for($column = 1;$column<=10;$column++){
		$getdataforexcel[$row-1][] = $sheet->getCell($arr[$column].$row)->getValue();
	}
}

//print_r($getdataforexcel);
$error_dataforexcel = "";//无法保存到数据库的Excel的数据
$error_num = 0;//失败数量

//---------------------------------------------------将数据保存到数据库----------------------------------------------------------------------------------------------------
foreach($getdataforexcel as $index_num =>$datainfo){
	//----------------判断“证件号”是否为空----------------------
	for($i=0;$i<10;$i++){//清除空格
		$datainfo[$i] = str_replace(' ', '', $datainfo[$i]);
	}
	
	if(!empty($datainfo[3])){
		$sql = "SELECT id FROM 申请人 WHERE 证件号='".$datainfo[3]."'";
		$result = $conn->query($sql);
		//----------------------判断“证件号”是否存在-----------------------------------
		if($result->num_rows>0){
			$error_dataforexcel[$error_num] = $datainfo;
			$error_dataforexcel[$error_num]["错误信息"] = "证件号已存在";
			$error_num++;
		}else{
			//--------------------------保存到数据库中--------------------------------------------------
			//处理费减比例
			if(empty($datainfo[7])){
				$datainfo[7] = "100%";
			}else{
				$datainfo[7] = $datainfo[7]."%";
			}
			
			$sql = "INSERT INTO 申请人(申请人类型,申请人,英文名,证件号,国籍,邮政编码,费减备案,费减比例,地址,备注,记录所属) VALUES(";
			$sql .= "'".$datainfo[0]."','".$datainfo[1]."','".$datainfo[2]."','".$datainfo[3]."','".$datainfo[4]."','".$datainfo[5]."','".$datainfo[6]."','".$datainfo[7]."','".$datainfo[8]."','".$datainfo[9]."','21')";
			if(!$conn->query($sql)){
				$error_dataforexcel[$error_num] = $datainfo;
				$error_dataforexcel[$error_num]["错误信息"] = "保存失败";
				$error_num++;
			}
		}
	}else{
		$error_dataforexcel[$error_num] = $datainfo;
		$error_dataforexcel[$error_num]["错误信息"] = "证件号为空";
		$error_num++;
	}
}

//print_r($error_dataforexcel);

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
$letter = array('A','B','C','D','E','F','G','H','I','J','K');
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
$objPHPExcel->getActiveSheet()->setCellValue('A1','申请人类型');
$objPHPExcel->getActiveSheet()->setCellValue('B1','申请人');
$objPHPExcel->getActiveSheet()->setCellValue('C1','英文名');
$objPHPExcel->getActiveSheet()->setCellValue('D1','证件号');
$objPHPExcel->getActiveSheet()->setCellValue('E1','国籍');
$objPHPExcel->getActiveSheet()->setCellValue('F1','邮政编码');
$objPHPExcel->getActiveSheet()->setCellValue('G1','费减年度');
$objPHPExcel->getActiveSheet()->setCellValue('H1','费减比例');
$objPHPExcel->getActiveSheet()->setCellValue('I1','地址【中文默认地址】');
$objPHPExcel->getActiveSheet()->setCellValue('J1','备注');
$objPHPExcel->getActiveSheet()->setCellValue('K1','错误原因');
//居中
foreach($letter as $ky => $column){
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中 	
}

$i = 2;
foreach($error_dataforexcel as $ky_my => $errordatainfo){
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
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$errordatainfo["错误信息"]);
	
	$i++;
}

//保存
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);  
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save("file_excel/sqr_errordata.xlsx");

 
 
?>