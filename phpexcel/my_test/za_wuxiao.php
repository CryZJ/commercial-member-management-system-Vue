<?php
/*
导入专案无效的案件
*/
//require("../Classes/PHPExcel.php");
//require("../Classes/PHPExcel/Reader/Excel2007.php");
require("../Classes/PHPExcel/IOFactory.php");
require("../../conn.php");

$filename = "file_excel/无效.xls";
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
//	for($column = 'A';$column <= 'H';$column++){//列循环
//		echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";
//	}
//	echo "</tr>";
//}
//echo "</table>";

//装载数据
$data_excel = "";//装载原始的Excel数据

$i = 0;
for($row=2;$row<=$highestRow;$row++){//行循环
//	for($column = 'A';$column <= 'X';$column++){//列循环
//		$data_excel[$i][] = $sheet->getCell($column.$row)->getValue();
//	}
	for($j=1;$j<9;$j++){
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

/*清除申请人的名称的空格*/
function Clear_sqr_empty(){
	require("../../conn.php");
	$sql = "SELECT id,申请人 FROM 申请人 ";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$sqr_name = $row["申请人"];
			$sqr_name = str_replace(" ", '', $sqr_name);
			$sql = "UPDATE 申请人 SET 申请人='".$sqr_name."' WHERE id='".$row["id"]."'";
			$conn->query($sql);
		}
	}
	$conn->close();
}
Clear_sqr_empty();


$data_default = "";//处理失败的数据
$data_default = array();
$error_num = 0;//失败数量
//保存到数据库所需的变量： $sqr_id，$ajh
foreach($data_excel as $ky => $data_info){
	$sqr_id = PanDuan_sqr($data_info[4]);
	if($sqr_id){//判断申请人是否存在
		$ajh = Get_ajh($data_info[1],$data_info[2]);
		if($ajh != "failure"){//创建案卷号
			$sql = "INSERT INTO 专案_复审等(案卷号,专利名称,类型,案源人,代理人,状态,申请人,申请号,申请人id,创建人,创建时间,申请日,案件类型,原案卷号) VALUES(";
			$sql .= "'".$ajh."','".$data_info[5]."','".$data_info[2]."','".$data_info[7]."','".$data_info[7]."','结案','".$data_info[4]."','".$data_info[3]."','".$sqr_id."','管理员','".date("Y-m-d H:i:s")."','".$data_info[6]."','数据导入','".$data_info[1]."')";
			if(!$conn->query($sql)){//保存失败
				$data_default[$error_num] = $data_info;
				$data_default[$error_num]["error_msg"] = "保存失败";
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
$objPHPExcel->getActiveSheet()->setCellValue('A1','状态');
$objPHPExcel->getActiveSheet()->setCellValue('B1','编号');
$objPHPExcel->getActiveSheet()->setCellValue('C1','类型');
$objPHPExcel->getActiveSheet()->setCellValue('D1','申请号');
$objPHPExcel->getActiveSheet()->setCellValue('E1','申请人');
$objPHPExcel->getActiveSheet()->setCellValue('F1','名称');
$objPHPExcel->getActiveSheet()->setCellValue('G1','申请日');
$objPHPExcel->getActiveSheet()->setCellValue('H1','业务人');
$objPHPExcel->getActiveSheet()->setCellValue('I1','错误信息');
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
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$errordatainfo["error_msg"]);
	
	$i++;
}

//保存
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);  
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save("file_excel/wx_errordata.xlsx");

?>