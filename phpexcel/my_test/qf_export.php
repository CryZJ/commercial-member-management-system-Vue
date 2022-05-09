<?php
header("Content-type:text/html;charset=utf-8");

require'../../AHeader.php'; 
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("../../ware/imitation_6/AHeaderRecord.php");


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
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
//编写表字段
$objPHPExcel->getActiveSheet()->setCellValue('A1','序号');
$objPHPExcel->getActiveSheet()->setCellValue('B1','客户名称');
$objPHPExcel->getActiveSheet()->setCellValue('C1','项目内容');
$objPHPExcel->getActiveSheet()->setCellValue('D1','总收费');
$objPHPExcel->getActiveSheet()->setCellValue('E1','规费');
$objPHPExcel->getActiveSheet()->setCellValue('F1','管理费');
$objPHPExcel->getActiveSheet()->setCellValue('G1','税费');
$objPHPExcel->getActiveSheet()->setCellValue('H1','收费方式');
$objPHPExcel->getActiveSheet()->setCellValue('I1','收费日期');
$objPHPExcel->getActiveSheet()->setCellValue('J1','案源人');
//居中
foreach($letter as $ky => $column){
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
	$objPHPExcel->getActiveSheet()->getStyle($column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中 	
}

$str_id = $_POST['data'];

//$sql_s = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 欠费记录 WHERE  FIND_IN_SET(id,'".$str_id."') ORDER BY 收费日期 ";	
$sql_s = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." WHERE  FIND_IN_SET(id,'".$str_id."') ORDER BY 收费日期 ";	

$result = $conn->query($sql_s);
$i=2;
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$i-1);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['客户名称']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['项目内容']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$row['总收费']);
//		$objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$i,$row['规费'],PHPExcel_Cell_DataType::TYPE_STRING);//显示字符串
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$row['规费']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['管理费']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['税费']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$row['收费方式']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$row['收费日期']);
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$row['案源人']);
		//日期格式化
		$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
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
$name = "欠费记录".date("Y年m月d日").".xlsx"; 
if(file_exists($filename)){
	header('content-disposition:attachment;filename='.$name);
	header('content-length:'.filesize($filename));
	readfile($filename);
}else{
	echo '<script type="text/javascript">alert("文件已被删除或移动了！");window.close();</script>';
}



?>