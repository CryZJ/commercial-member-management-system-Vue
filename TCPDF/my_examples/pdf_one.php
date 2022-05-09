<?php
/*
 * 创建时间：2017年12月3日
 * 创建者：KingShen
 * 说明：用于导出数据库中“网报商标申请书”和“营业执照”等图片信息，输出为PDF文件于网页上浏览、下载、打印，使用了TCPDF类库
 * */
 
 /*
  * 传过来的参数：
  * 案卷号：ajh 
  * 图片的标志：img_flag --》顺序：身份证(原件)，身份证(翻译件)，商标(黑白)，商标(彩色)，营业执照(原件)，营业执照(翻译件)
  */

require("../../AHeader.php");
//	echo "<script language='javascript'>alert('".$admin.$lcczy."');</script>;";
    
  //获取传值
  $ajh = $_GET['ajh'];
//$ajh = "03075bO4bO";
  
 //连接数据库
 require("../../conn.php");
 require("../../upload_func.php"); 

 //获取委托人(申请人)信息:申请人名称,证件号
 $client_msg = "";//委托人(申请人)信息
 $client_msg['名称']="";
 $client_msg['证件号']="";
 $client_msg['地址']="";
 
 $data_arr = "";
 $data_arr['邮编']="";
 $data_arr['联系人']="";
 $data_arr['电话']="";
 $data_arr['传真']="";
 $data_arr['代理组织名称']="";
 $data_arr['商标说明']="";
 $data_arr['类别']="";
 $data_arr['服务项目']="";
 $data_arr['商标名称']="";
 
  $data_one_arr = ""; 
 $sql = "SELECT a.委托书id,a.申请人id,a.申请人商标地址,a.注册号,a.商品服务,a.商标说明,a.类别 FROM 商标_案件 a,商标_委托书 c WHERE a.案卷号='".$ajh."' AND  a.委托书id=c.id";		
 $result = $conn->query($sql);
 if($result->num_rows>0){
 	while($row = $result->fetch_assoc()){
 		$data_one_arr["委托书id"] = $row["委托书id"];
		$data_one_arr["申请人id"] = $row["申请人id"];
		$client_msg['地址'] = $row['申请人商标地址'];
		$data_arr['商标说明'] = $row["商标说明"];
		$data_arr['类别'] = $row["类别"];
		$data_arr['服务项目']=$row["商品服务"];
		$data_arr["注册号"] = $row["注册号"];
 	}
	if(!empty($data_one_arr["委托书id"])){
		$sql = "SELECT 代理人,邮编,电话,联系人,传真,商标名 FROM 商标_委托书 WHERE id='".$data_one_arr["委托书id"]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$data_arr['代理组织名称'] = $row['代理人'];
				$data_arr['邮编'] = $row['邮编'];
				$data_arr['电话'] = $row['电话'];
				$data_arr['联系人'] = $row['联系人'];
				$data_arr['传真'] = $row['传真'];
				$data_arr['商标名称'] = $row['商标名'];
	 		}
		}
	}
	if(!empty($data_one_arr["申请人id"])){
		$sql = "SELECT 申请人,地址,证件号 FROM 申请人 WHERE id='".$data_one_arr["申请人id"]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$client_msg['名称'] = $row['申请人'];
//	 			$client_msg['地址'] = $row['地址'];
				$client_msg['证件号'] = $row['证件号'];
	 		}
		}
	}
 }

//图样
$sql = "SELECT 文件路径 FROM 商标_文件 WHERE 案卷号='".$ajh."' AND 描述='商标图样黑白'";
$result = $conn->query($sql);
$img_src = "";
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$path_sql = $row['文件路径'];
		$filename = pathinfo($path_sql,PATHINFO_BASENAME);
		$filename_arr = explode("_", $filename);
		$timestamp = $filename_arr[0];
		$img_src = "../../".pathinfo($path_sql,PATHINFO_DIRNAME)."/".$timestamp.".".pathinfo($path_sql,PATHINFO_EXTENSION);
	}
}

//print_r($client_msg);
//print_r($data_arr);

//连接类库
require_once('../tcpdf.php');

//创建一个PDF类
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf = new TCPDF('P', 'mm', "A4", true, 'UTF-8', false);

// 设置一些关于此文件的信息.....可以忽略
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KingShen');
$pdf->SetTitle('网报商标申请书');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// 去掉页眉和页脚
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('stsongstdlight', '', 14);

/*-----------------------------第一页（网报商标申请书）---------------------------------------*/
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '
<h5 style="text-align:right">'.$ajh.'</h5>
<h1 style="text-align:center">网报商标申请书</h1>
<table style="border-collapse:collapse;width:920px;"  cellspacing="3" cellpadding="2" >
	<tr>
		<td align="right" style="width:20%;">申请人名称：</td>
		<td align="left">'.$client_msg['名称'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">证件号：</td>
		<td align="left">'.$client_msg['证件号'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">申请人地址：</td>
		<td align="left">'.$client_msg['地址'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">邮政编码：</td>
		<td align="left">'.$data_arr['邮编'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">联系人：</td>
		<td align="left">'.$data_arr['联系人'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">电话(含地区号)：</td>
		<td align="left">'.$data_arr['电话'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">传真(含地区号)：</td>
		<td align="left">'.$data_arr['传真'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">代理组织名称：</td>
		<td align="left">'.$data_arr['代理组织名称'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">商标名称：</td>
		<td align="left">'.$data_arr['商标名称'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">商标说明：</td>
		<td align="left">'.$data_arr['商标说明'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">类别：</td>
		<td align="left">'.$data_arr['类别'].'</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">商品/服务项目：</td>
		<td align="left">'.$data_arr['服务项目'].'</td>
	</tr>
</table>
<div border="1">
	<span style="font-size: 15px;">商标图样打印处</span>
	<p align="center">
		<img src="'.$img_src.'" height="200" width="450" />
	</p>
</div>

<p align="rigth"><span>被委托人章戳(签字)</span></p>
';

// Print text using writeHTMLCell() <img src="'.$sbty.'" height="200" width="450" />
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

/*-----------------------------第一页（网报商标申请书）end---------------------------------------*/

/*-----------------------------第二页（营业执照）---------------------------------------*/
// Add a page
// This method has several options, check the source code documentation for more information.
//$pdf->AddPage();
//$src_tmp = "../../filesave_sb/03017bO4bO/1513669468_6个障碍物.png";
//$src_tmp = iconv("utf-8", "gbk", $src_tmp);
//if(file_exists($src_tmp)){
//	$pdf->Image($src_tmp, 10, 10,'450' ,'580' , '', '', '', true, 150, '', false, false, 0, false, false, false);
//}



// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$time = date("Y年m月d日H时i分s秒");
$file_namepdf = $ajh."_网报商标申请书.pdf";
$pdf->Output($file_namepdf, 'F');


sleep(1);
$gbk_pathpdf = iconv("utf-8", "gbk", $file_namepdf);
if(file_exists($gbk_pathpdf)){
	$save_path = "../../filesave_sb/".$ajh."/".$file_namepdf;
	if(Filecopy($file_namepdf,$save_path)){
		$sql_path = "filesave_sb/".$ajh."/".$file_namepdf;
		$sql_s = "SELECT id FROM 商标_文件 WHERE 案卷号='".$ajh."' AND 文件路径='".$sql_path."' ORDER BY id DESC LIMIT 1";
		$result = $conn->query($sql_s);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$sql_u = "UPDATE 商标_文件 SET 创建时间='".date("Y-m-d H:i:s")."',创建人='".$name."',状态='0' WHERE id='".$row['id']."'";
				$conn->query($sql_u);
			}
		}else{
			$sql_i = "INSERT INTO 商标_文件(案卷号,文件路径,创建时间,创建人,描述) VALUES(";
			$sql_i .= "'".$ajh."','".$sql_path."','".date("Y-m-d H:i:s")."','".$name."','导出打印包生成')";
			$conn->query($sql_i);
		}
		
	}
}


//创建zip文件
$tmp_filename = "tmp.zip";
if(file_exists($tmp_filename)){
	unlink($tmp_filename);
}
$zip = new ZipArchive();
$zip->open($tmp_filename,ZipArchive::OVERWRITE); 

$sql = "SELECT 文件路径 FROM 商标_文件 WHERE 案卷号='".$ajh."'";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$path_sql = "";
		$path_sql = $row['文件路径'];
		if(!empty($path_sql)){
			$gbk_pathsql = iconv("utf-8", "gbk", "../../".$path_sql);
			if(file_exists($gbk_pathsql)){
				$filedata = file_get_contents($gbk_pathsql);
				if($filedata){
					$zip ->addFromString(pathinfo($gbk_pathsql,PATHINFO_BASENAME),$filedata);
				}
			}
		}
	}
}

$zip->close();

//删除PDF文件，并下载zip文件
if(unlink($gbk_pathpdf)){
	$zip_path = "tmp.zip";
	$zip_pathgbk = iconv("utf-8", "gbk", $zip_path);
	if(file_exists($zip_pathgbk)){
		header('content-disposition:attachment;filename='.$ajh.'打印包.zip');
		header('content-length:'.filesize($zip_pathgbk));
		readfile($zip_pathgbk);
	}
}

?>