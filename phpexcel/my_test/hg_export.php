<?php
header("Content-type:text/html;charset=utf-8");
include '../Classes/PHPExcel.php';
require_once('../Classes/PHPExcel/Writer/Excel2007.php'); 
include '../../conn.php';

//创建Excel对象
$objPHPExcel = new PHPExcel(); 
//Set properties 设置文件属性  这部分随意
$objPHPExcel->getProperties()->setCreator("KingShen");  
$objPHPExcel->getProperties()->setLastModifiedBy("KingShen");  
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test 专案导出");  
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");  
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX,专案导出");  
$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");  
$objPHPExcel->getProperties()->setCategory("Test result file"); 
//Rename sheet 重命名工作表标签  
$objPHPExcel->getActiveSheet()->setTitle('sheet1');  
/*写进头部*/
$letter = array('A','B','C','D','E','F','G','H','I','J');
//Set column widths 设置列宽度 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
//编写表字段
$objPHPExcel->getActiveSheet()->setCellValue('A1','序号');
$objPHPExcel->getActiveSheet()->setCellValue('B1','案卷号');
$objPHPExcel->getActiveSheet()->setCellValue('C1','名称');
$objPHPExcel->getActiveSheet()->setCellValue('D1','申请人');
$objPHPExcel->getActiveSheet()->setCellValue('E1','申请号');
$objPHPExcel->getActiveSheet()->setCellValue('F1','申请日');
$objPHPExcel->getActiveSheet()->setCellValue('G1','案源人');
$objPHPExcel->getActiveSheet()->setCellValue('H1','代理人');
$objPHPExcel->getActiveSheet()->setCellValue('I1','案件备注');
//居中
foreach($letter as $ky => $column){
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中 	
}
	
$sql_s = "SELECT 案卷号,名称,申请人id,申请号,申请日,案源人,代理人,案件备注 FROM 海关_案件 WHERE 状态<>3 AND 状态<>9";
$result = $conn->query($sql_s);
$i=2;
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		//获取申请人的名称
		$str_sqrname = "";
		$sql2 = "SELECT 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$row['申请人id']."')";
		$result2 = $conn->query($sql2);
		if($result2->num_rows>0){
			while($row2=$result2->fetch_assoc()){
				$str_sqrname .= ",".$row2['申请人'];
			}
		}
		$str_sqrname = substr($str_sqrname, 1);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$i-1);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['案卷号']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['名称']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$str_sqrname);
		$objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$i,$row['申请号'],PHPExcel_Cell_DataType::TYPE_STRING);//显示字符串
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['申请日']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['案源人']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$row['代理人']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$row['案件备注']);
		//日期格式化
		$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
		$i++;
	}
}else{
	exit("没有数据！");
}	
$conn->close();

//保存
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);  
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save("file_excel/one.xlsx");

//输出下载
sleep(1);
$filename = "file_excel/one.xlsx";
$name = "海关案件".date("Y年m月d日").".xlsx"; 
if(file_exists($filename)){
	header('content-disposition:attachment;filename='.$name);
	header('content-length:'.filesize($filename));
	readfile($filename);
}else{
	echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
}



?>