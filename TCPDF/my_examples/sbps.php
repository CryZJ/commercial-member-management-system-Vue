<?php
/*
 * 创建时间：2018年5月31日
 * 创建者：KingShen
 * 说明：用于导出数据库中“商标评审代理委托书”的信息，输出为PDF文件于网页上浏览、下载、打印，使用了TCPDF类库
 * */
//连接类库
require_once('../tcpdf.php');

//创建一个PDF类
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf = new TCPDF('P', 'mm', "A4", true, 'UTF-8', false);

// 设置一些关于此文件的信息.....可以忽略
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KingShen');
$pdf->SetTitle('商标评审代理委托书');
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

// set font  设置字体
$pdf->SetFont('stsongstdlight', '', 13);

/*-----------------------------第一页（商标代理委托书）---------------------------------------*/
// Add a page  添加新的一页
$pdf->AddPage();


$data = $_REQUEST["data"];//#$#
$data2 = $_REQUEST["data2"];//,

$data_arr = explode("#$#", $data);
$data_arr_2 = explode(",", $data2);

$date_info = date("Y 年 m 月 d 日",strtotime(end($data_arr)));


$qx = "";
$tmp_str = $data_arr_2[5].','.$data_arr_2[6].','.$data_arr_2[7];
switch($tmp_str){
	case "1,0,0":
		$qx="①";
		break;
	case "0,1,0":
		$qx="②";
		break;
	case "0,0,1":
		$qx="③";
		break;
	case "1,1,0":
		$qx="①&nbsp;&nbsp;②";
		break;
	case "1,0,1":
		$qx="①&nbsp;&nbsp;③";
		break;
	case "0,1,1":
		$qx="②&nbsp;&nbsp;③";
		break;
	case "1,1,1":
		$qx="①&nbsp;&nbsp;②&nbsp;&nbsp;③";
		break;
	default: 
		$qx="";
		break;
}

$html_3 = '
<h1 style="text-align:center">商  标  评  审  代  理  委  托  书</h1>
<table style="border-collapse:collapse;width:920px;"  cellspacing="3" cellpadding="2">
	<tr>
		<td align="left" style="width:8%;">委托人：</td>
		<td align="left">'.$data_arr[0].'</td>
	</tr>
	<tr>
		<td align="left" style="width:8%;">地址：</td>
		<td align="left">'.$data_arr[1].'</td>
	</tr>
	<tr>
		<td align="left" style="width:30%;">法定代表人/负责人姓名：'.$data_arr[2].'</td>
		<td align="left">职务：'.$data_arr[3].'</td>
	</tr>
	<tr>
		<td align="left" style="width:8%;">受托人：</td>
		<td align="left">'.$data_arr[4].'</td>
	</tr>
	<tr>
		<td align="left" style="width:8%;">地址：</td>
		<td align="left">'.$data_arr[5].'</td>
	</tr>
	<tr>
		<td align="left" style="width:30%;">联系人：'.$data_arr[6].'</td>
		<td align="left">电话：'.$data_arr[7].'</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;委托人是&nbsp;&nbsp;'.$data_arr[8].'&nbsp;&nbsp;国家/地区的公民/法人，现委托人代理对第&nbsp;&nbsp;'.$data_arr[9].'&nbsp;&nbsp;类<br/>第&nbsp;&nbsp;'.$data_arr[10].'&nbsp;&nbsp;号&nbsp;&nbsp;'.$data_arr[11].'&nbsp;&nbsp;商标进行如下" &radic; "评审事宜：</td>
	</tr>
	<tr>
		<td style="width:30%;"><img src="image/'.$data_arr_2[0].'.jpg"  />驳回商标注册申请复审案</td>
		<td style="width:40%;"><img src="image/'.$data_arr_2[1].'.jpg"  />商标不予注册复审案</td>
	</tr>
	<tr>
		<td style="width:30%;"><img src="image/'.$data_arr_2[2].'.jpg"  />撤销注册商标复审案</td>
		<td style="width:40%;"><img src="image/'.$data_arr_2[3].'.jpg"  />注册商标无效宣告案</td>
	</tr>
	<tr>
		<td style="width:30%;"><img src="image/'.$data_arr_2[4].'.jpg"  />注册商标无效宣告复审案</td>
		<td style="width:40%;"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;受托人代理上述评审事宜的权限为：参与《中华人民共和国商标法》及其《实施条例》和《商标评审规则》规定的本案有关评审活动。委托人<br/>特别声明包括下列第&nbsp;&nbsp; '.$qx.' &nbsp;&nbsp;项权限：</td>
		
	</tr>
	<tr>
		<td colspan="2">① 承认对方评审请求</td>
	</tr>
	<tr>
		<td colspan="2">② 放弃或者变更评审请求</td>
	</tr>
	<tr>
		<td colspan="2">③ 撤回商标评审申请</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	
</table>
<table style="border-collapse:collapse;width:600px;"  cellspacing="3" cellpadding="2">
	<tr>
		<td style="width:70%;">&nbsp;</td>
		<td align="left">委托人签字（盖章）</td>
	</tr>
	<tr>
		<td style="width:45%;">&nbsp;</td>
		<td align="rigth" >'.$date_info.'</td>
	</tr>
</table>
';


// Print text using writeHTMLCell()
//$pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTML($html_3, true, 0, true, 0);

/*-----------------------------第一页（商标代理委托书）end---------------------------------------*/
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$time = date("Y年m月d日H时i分s秒");
$pdf->Output($time.'_商标评审代理委托书'.'.pdf', 'I');

?>