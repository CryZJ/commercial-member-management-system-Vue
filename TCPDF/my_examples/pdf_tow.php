<?php
/*
 * 创建时间：2017年12月3日
 * 创建者：KingShen
 * 说明：用于导出数据库中“商标代理委托书”的信息，输出为PDF文件于网页上浏览、下载、打印，使用了TCPDF类库
 * */
//连接类库
require_once('../tcpdf.php');


//创建一个PDF类
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf = new TCPDF('P', 'mm', "A4", true, 'UTF-8', false);

// 设置一些关于此文件的信息.....可以忽略
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KingShen');
$pdf->SetTitle('商标代理委托书');
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

$caseid = $_REQUEST['caseid'];
require_once ("../../conn.php");
/*---------------------------根据caseid获取数据库的数据------------------------------------*/

$sql_s = "SELECT 委托人,国籍,国法,代理人,商标名,勾选项,委托其他,委托人地址,联系人,电话,邮编,修改时间,委托人id  FROM 商标_委托书 WHERE id='".$caseid."'";
$result_s = $conn->query($sql_s);
$header_msg = "";//头部信息
$list_msg = "";//列表信息
$list_other = "";//列表中的其他
$tail_msg = "";//尾部信息
if($result_s -> num_rows > 0){
	while($row = $result_s->fetch_assoc()){
		$header_msg[0] = $row['委托人'];
		$header_msg[1] = $row['国籍'];
		$header_msg[2] = $row['国法'];
		$header_msg[3] = $row['代理人'];
		$header_msg[4] = $row['商标名'];
		
		$list_msg = explode(",",$row['勾选项']);
		$list_other = $row['委托其他'];
		
		$tail_msg[0] = $row['委托人地址'];
		$tail_msg[1] = $row['联系人'];
		$tail_msg[2] = $row['电话'];
		$tail_msg[3] = $row['邮编'];
		$tail_msg[4] = $row['修改时间'];
		$tail_msg[5] = $row['委托人id'];
	}
	//获取申请人的信息
	$sql = "SELECT 申请人,证件号,申请人类型 FROM 申请人 WHERE id='".$tail_msg[5]."'";
	$result = $conn->query($sql);
	$tmp_name = "";
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			if($row["申请人类型"] == "个人"){
				$tmp_name = $row["申请人"]."（身份证号：".$row["证件号"]."）";
			}else{
				$tmp_name = $row["申请人"];
			}
		}
	}
}else{
	exit("数据读取失败！请检查数据是否存在.......");
}

$conn->close();

$other_mark  = $list_other;//其他
$checked = "";//选择标志
for($i=0;$i<40;$i++){
	$checked[$i] = 0;
}
foreach($list_msg as $ky => $checked_index){
	$checked[$checked_index] = 1;
}
//处理时间
$time = date("Y 年 m 月 d 日",$tail_msg[4]);

$html_3 = '
<h1 style="text-align:center">商  标  代  理  委  托  书</h1>
<table border="0" style="width:600px;"  cellspacing="2" cellpadding="0">
	<tr>
		<td style="width:15%;" align="right">委托人</td>
		<td style="width:60%;border-bottom: 1px solid black;" align="center">'.$tmp_name.'</td>
		<td style="width:5%;">是</td>
		<td style="width:15%;border-bottom: 1px solid black;" align="center">'.$header_msg[1].'</td>
		<td style="width:15%;">国国籍，</td>
	</tr>
	<tr>
		<td style="width:5%;">依</td>
		<td style="width:10%;border-bottom: 1px solid black;" align="center">'.$header_msg[2].'</td>
		<td style="width:30%;">国法律组成，现委托</td>
		<td style="width:60%;border-bottom: 1px solid black;" align="center">'.$header_msg[3].'</td>	
	</tr>
	<tr>
		<td style="width:10%;">代理</td>
		<td style="width:30%;border-bottom: 1px solid black;" align="center">'.$header_msg[4].'</td>
		<td colspan="3">商标的如下"&radic;"事宜。</td>
	</tr>
</table>
<table style="font-size:13px;" cellspacing="3" cellpadding="2"  >
	<tr>
		<td align="left"><img src="image/'.$checked[0].'.jpg"  />商标注册申请</td>
		<td align="left"><img src="image/'.$checked[1].'.jpg"  />撤销连续三年不使用注册商标提供证据</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[2].'.jpg"  />商标异议申请</td>
		<td align="left"><img src="image/'.$checked[3].'.jpg"  />撤销成为商品/服务通用名称注册商标答辩</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[4].'.jpg"  />商标异议答辩</td>
		<td align="left"><img src="image/'.$checked[5].'.jpg"  />补发变更/转让/续展证明申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[6].'.jpg"  />更正商标申请/注册事项申请</td>
		<td align="left"><img src="image/'.$checked[7].'.jpg"  />补发商标注册证申请</td>
	</tr>
	<tr>
		<td rowspan="1" align="left"><img src="image/'.$checked[8].'.jpg"  />变更商标申请人/注册人名义/地址 变更集体商标/证明商标管理规则/集体成员名单申请</td>
		<td align="left" ><img src="image/'.$checked[9].'.jpg"  />出具商标注册证明申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[10].'.jpg"  />变更商标代理人/文件接收人申请</td>
		<td align="left"><img src="image/'.$checked[11].'.jpg"  />出具优先权证明文件申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[12].'.jpg"  />删除商品/服务项目申请</td>
		<td align="left"><img src="image/'.$checked[13].'.jpg"  />撤回商标注册申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[14].'.jpg"  />商标续展注册申请</td>
		<td align="left"><img src="image/'.$checked[15].'.jpg"  />撤回商标异议申请</td>
	</tr>
	
	<tr>
		<td align="left"><img src="image/'.$checked[16].'.jpg"  />转让/转移申请/注册商标申请书</td>
		<td align="left"><img src="image/'.$checked[17].'.jpg"  />撤回变更商标申请人/注册人名义/地址 变更集体商标/证明商标管理规则/集体成员名单申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[18].'.jpg"  />商标使用许可备案</td>
		<td align="left"><img src="image/'.$checked[19].'.jpg"  />撤回变更商标代理人/文件接收人申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[20].'.jpg"  />变更许可人/被许可人名称备案</td>
		<td align="left"><img src="image/'.$checked[21].'.jpg"  />撤回删减商品/服务项目申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[22].'.jpg"  />商标使用许可提前终止备案</td>
		<td align="left"><img src="image/'.$checked[23].'.jpg"  />撤回商标续展注册申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[24].'.jpg"  />商标专用权质权登记申请</td>
		<td align="left"><img src="image/'.$checked[25].'.jpg"  />撤回转让/转移申请/注册商标申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[26].'.jpg"  />商标专用权质权登记期限变更申请</td>
		<td align="left"><img src="image/'.$checked[27].'.jpg"  />撤回商标志使用许可备案</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[28].'.jpg"  />商标专用权质权登记期限延期申请</td>
		<td align="left"><img src="image/'.$checked[29].'.jpg"  />撤回商标注销申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[30].'.jpg"  />商标专用权质权登记证补发申请</td>
		<td align="left"><img src="image/'.$checked[31].'.jpg"  />撤回撤销连续三年不使用注册商标申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[32].'.jpg"  />商标专用权质权登记注销申请</td>
		<td align="left"><img src="image/'.$checked[33].'.jpg"  />撤回撤销成为商品/服务通用名称注册商标申请</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[34].'.jpg"  />商标注销申请</td>
		<td align="left"><img src="image/'.$checked[35].'.jpg"  />其他：'.$other_mark.'</td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[36].'.jpg"  />撤销连续三年不使用注册商标申请</td>
		<td align="left"></td>
	</tr>
	<tr>
		<td align="left"><img src="image/'.$checked[37].'.jpg"  />撤销成为商品/服务通用名称注册商标申请</td>
		<td align="left"></td>
	</tr>
</table>
<br/><br/>

<table border="0" style="border-collapse:collapse;width:800px;"  cellspacing="3" cellpadding="2" >
	<tr>
		<td style="width:12%;">委托人地址</td>
		<td colspan="2" style="border-bottom: 1px solid black;">'.$tail_msg[0].'</td>
		
	</tr>
	<tr>
		<td>联系人</td>
		<td style="width:20%;border-bottom: 1px solid black;">'.$tail_msg[1].'</td>
		<td></td>
	</tr>
	<tr>
		<td>电话</td>
		<td style="width:20%;border-bottom: 1px solid black;">'.$tail_msg[2].'</td>
		<td style="width:45%;" align="right">委托人章戳(签字)</td>
	</tr>
	<tr>
		<td>邮政编码</td>
		<td style="width:20%;border-bottom: 1px solid black;">'.$tail_msg[3].'</td>
		<td style="width:45%;" align="right">'.$time.'</td>
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
$pdf->Output($time.'.pdf', 'I');

?>