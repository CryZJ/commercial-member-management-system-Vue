<?php
//require("../Classes/PHPExcel.php");
//require("../Classes/PHPExcel/Reader/Excel2007.php");
require("../Classes/PHPExcel/IOFactory.php");
require("../../conn.php");

$filename = "file_excel/专利年费案件导入模板.xls";
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

//echo $highestRow."//".$highestColumm."<br/>";输出行数与列数

/** 循环读取每个单元格的数据 */
//echo "<table border='1'>";
//for($row=2;$row<=$highestRow;$row++){//行循环
//	echo "<tr>";
//	for($column = 'A';$column <= 'X';$column++){//列循环
//		echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";
//	}
//	echo "</tr>";
//}
//echo "</table>";

//装载数据
$data_excel = "";
$i = 0;
for($row=3;$row<=$highestRow;$row++){//行循环
//	for($column = 'A';$column <= 'X';$column++){//列循环
//		$data_excel[$i][] = $sheet->getCell($column.$row)->getValue();
//	}
	for($j=1;$j<31;$j++){
		$data_excel[$i][] = $sheet->getCell($arr[$j].$row)->getValue();
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
//处理数据：首先判断“申请人”是否存在，不存在将不做处理；再生成“案卷号”
foreach($data_excel as $ky => $data_info){
	//判断申请人是否创建
	$sql = "SELECT id FROM 申请人 WHERE 申请人='".$data_info[4]."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sqr_id = "";//申请人id
		while($row = $result->fetch_assoc()){
			$sqr_id = $row["id"];
		}
		//生成案卷号 strat
		$ajh = Get_ajh($data_info[0],$data_info[2]);//生成的案卷号
		if($ajh == "failure"){//生成案卷号失败
			$i = count($data_default);
			$data_default[$i] = $data_info;
			$data_default[$i]['msg'] = "案卷号生成失败";
			continue;
		}
		
		//Excel的日期需要重新定义读出的时间是天数
		//excel 的日期是从 1900-01-01 开始计算的（php 是从 1970-01-01）
		//两者间有一个天数差 25569
		//时间是格林威治时间
//		echo date("Y-m-d",($data_info[5]-25569)*24*60*60);
		$data_info[5] = date("Y-m-d",($data_info[5]-25569)*24*60*60);
		
		//添加到数据库：“专案_年费”
		$sql = "INSERT INTO 专案_年费(原案卷号,案卷号,申请号,类型,专利名称,费减比例,案源人,代理人,申请日,申请人,首年度,申请人id,创建时间,登记人,登记时间,原案卷状态) VALUES(";
		$sql .= "'".$data_info[0]."','".$ajh."','".$data_info[3]."','".$data_info[2]."','".$data_info[1]."','".$data_info[9]."%','".$data_info[6]."','".$data_info[7]."','".$data_info[5]."','".$data_info[4]."','".$data_info[8]."','".$sqr_id."','".date("Y-m-d H:i:s")."','管理员','".date("Y-m-d")."','".$data_info[10]."')";
		if($conn->query($sql)){
			//插入年费
			for($i=11;$i<30;$i++){
				if($data_info[$i] > 0){//有费用的每年年费
					$year_num = $i-9;//年度
					//保存到“专案_年费记录”
					$sql = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期) VALUES(";
					$sql .= "'".$ajh."','".$year_num."','".$data_info[$i]."','".Set_Date($data_info[5],$year_num,-1,0)."','".Set_Date($data_info[5],$year_num,1,0)."')";
					if($conn->query($sql)){
						//插入五期的滞纳金
						$msg = Create_znj($ajh,$data_info[2],$year_num,Set_Date($data_info[5],$year_num,1,0));
						echo $msg;
					}else{
						$i = count($data_default);
						$data_default[$i] = $data_info;
						$data_default[$i]['msg'] = "年费保存失败";
						break;
					}
				}
			}
		}else{//“专案_年费”保存失败
			$i = count($data_default);
			$data_default[$i] = $data_info;
			$data_default[$i]['msg'] = "“专案_年费”保存失败";
			continue;
		}
	}else{//申请人没有创建
		$i = count($data_default);
		$data_default[$i] = $data_info;
		$data_default[$i]['msg'] = "申请人没有创建";
		continue;
	}
}


//输出处理失败的信息
$conn->close();
print_r($data_default); 
?>