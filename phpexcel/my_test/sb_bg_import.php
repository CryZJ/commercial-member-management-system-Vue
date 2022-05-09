<?php
//商标变更.xls
//require("../Classes/PHPExcel.php");
//require("../Classes/PHPExcel/Reader/Excel2007.php");
require("../Classes/PHPExcel/IOFactory.php");
require("../../conn.php");

$filename = "file_excel/商标变更.xls";
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
//  echo "<tr>";
//  for($column = 'A';$column <= 'S';$column++){//列循环
//      echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";
//  }
//  echo "</tr>";
//}
//echo "</table>";

//装载数据
$data_excel = "";
$i = 0;
for($row=2;$row<=$highestRow;$row++){//行循环
//  for($column = 'A';$column <= 'X';$column++){//列循环
//      $data_excel[$i][] = $sheet->getCell($column.$row)->getValue();
//  }
    for($j=1;$j<8;$j++){
        if($j == 6){
            $data_excel[$i][] =  date("Y-m-d",($sheet->getCell($arr[$j].$row)->getValue()-25569)*24*60*60);
        }else{
            $data_excel[$i][] = $sheet->getCell($arr[$j].$row)->getValue();
        }
    }
    $i++;
}   
print_r($data_excel);

?>