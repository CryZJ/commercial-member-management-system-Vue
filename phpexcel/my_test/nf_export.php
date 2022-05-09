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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(38);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(48);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
//编写表字段
$objPHPExcel->getActiveSheet()->setCellValue('A1','序号');
$objPHPExcel->getActiveSheet()->setCellValue('B1','案卷号');
$objPHPExcel->getActiveSheet()->setCellValue('C1','类型');
$objPHPExcel->getActiveSheet()->setCellValue('D1','申请号');
$objPHPExcel->getActiveSheet()->setCellValue('E1','申请人');
$objPHPExcel->getActiveSheet()->setCellValue('F1','专利名称');
$objPHPExcel->getActiveSheet()->setCellValue('G1','案源人');
$objPHPExcel->getActiveSheet()->setCellValue('H1','代理人');
$objPHPExcel->getActiveSheet()->setCellValue('I1','当前程序');
//居中
foreach($letter as $ky => $column){
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中 	
}
	
$sql_s="select id,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,b.状态,申请号,申请人id,原案卷号,申请人  from `专案_年费` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 案件状态<>9 group by  b.`案卷号`";
$result = $conn->query($sql_s);
$i=2;
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$i-1);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['案卷号']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['类型']);
		$objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$i,$row['申请号'],PHPExcel_Cell_DataType::TYPE_STRING);//显示字符串
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$row['申请人']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['专利名称']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['案源人']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$row['代理人']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$row['状态']);
		//日期格式化
//		$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
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
$name = "年费案件".date("Y年m月d日").".xlsx"; 
if(file_exists($filename)){
	header('content-disposition:attachment;filename='.$name);
	header('content-length:'.filesize($filename));
	readfile($filename);
}else{
	echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
}



?>