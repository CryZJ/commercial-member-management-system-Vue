<?php

//连接类库
require_once('../tcpdf.php');

//创建一个PDF类
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf = new TCPDF('P', 'mm', "A4", true, 'UTF-8', false);

// 设置一些关于此文件的信息.....可以忽略
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KingShen');
$pdf->SetTitle('TCPDF test_00');
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
$html = <<<EOD
<h1 style="text-align:center">网报商标申请书</h1>
<table style="border-collapse:collapse;width:920px;"  cellspacing="3" cellpadding="2" >
	<tr>
		<td align="right" style="width:20%;">申请人名称：</td>
		<td align="left">中山市建邦饲料科科技有限公司</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">身份证：</td>
		<td align="left">456325125321526345</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">申请人地址：</td>
		<td align="left">广东省中山市南头镇国强路3号厂房之二</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">邮政编码：</td>
		<td align="left">528400</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">联系人：</td>
		<td align="left">杜海江</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">电话(含地区号)：</td>
		<td align="left">0760-88886258</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">传真(含地区号)：</td>
		<td align="left">0760-88886171</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">代理组织名称：</td>
		<td align="left">中山市中亿星诚知识产权服务有限公司</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">商标说明：</td>
		<td align="left">建邦</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">类别：</td>
		<td align="left">31</td>
	</tr>
	<tr>
		<td align="right" style="width:20%;">商品/服务项目：</td>
		<td align="left">
		1、饲料；2、家畜催肥熟饲料；3、动物催肥剂；4、动物食品；5、未加工谷物；6、玉米；7、活动物；8、动物栖息用干草；9、新鲜水果；10、新鲜蔬菜。商品截止
		</td>
	</tr>
</table>
<div  border="1">
	<span style="font-size: 15px;">商标图样打印处</span>
	<p align="center">
		<img src="image/jb.jpg" height="200" width="500" />
	</p>
</div>
<p align="rigth"><span>被委托人章戳(签字)</span></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
/*-----------------------------第一页（网报商标申请书）end---------------------------------------*/

/*-----------------------------第二页（营业执照）---------------------------------------*/
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->Image('image/zj.jpg', 10, 10,'450' ,'580' , 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

/*-----------------------------第二页（营业执照）end---------------------------------------*/


/*-----------------------------第三页（商标代理委托书）---------------------------------------*/
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// Set some content to print
$other_mark  = "";//其他
$checked = "";//选择标志
for($i=0;$i<40;$i++){
	$checked[$i] = 0;
}
$checked[20] = 1;
//<td colspan="1" style="border-bottom: 1px solid black;">
$html_3 = '
<h1 style="text-align:center">商标代理委托书</h1>
<table border="0" style="width:600px;"  cellspacing="2" cellpadding="3">
	<tr>
		<td style="width:15%;" align="right">委托人</td>
		<td style="width:60%;border-bottom: 1px solid black;" align="center">中山市健邦饲料科技有限公司</td>
		<td style="width:5%;">是</td>
		<td style="width:15%;border-bottom: 1px solid black;" align="center">中</td>
		<td style="width:15%;">国国籍，</td>
	</tr>
	<tr>
		<td style="width:5%;">依</td>
		<td style="width:10%;border-bottom: 1px solid black;" align="center">中</td>
		<td style="width:30%;">国法律组成，现委托</td>
		<td style="width:60%;border-bottom: 1px solid black;" align="center">中山市中亿星诚知识产权服务有限公司</td>	
	</tr>
	<tr>
		<td style="width:10%;">代理</td>
		<td style="width:30%;border-bottom: 1px solid black;" align="center">健邦</td>
		<td colspan="3">商标的如下"&radic;"事宜。</td>
	</tr>
</table>
<table style="font-size:15px;" cellspacing="3" cellpadding="2"  >
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
		<td align="left"><img src="image/'.$checked[9].'.jpg"  />出具商标注册证明申请</td>
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
		<td align="left"><img src="image/'.$checked[35].'.jpg"  />其他'.$other_mark.'</td>
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
<table border="0" style="border-collapse:collapse;width:800px;"  cellspacing="3" cellpadding="2" >
	<tr>
		<td style="width:12%;">委托人地址</td>
		<td colspan="2" style="border-bottom: 1px solid black;">广东省中山市南头镇国强路3号厂房之二</td>
		
	</tr>
	<tr>
		<td>联系人</td>
		<td style="width:20%;border-bottom: 1px solid black;">杜海江</td>
		<td></td>
	</tr>
	<tr>
		<td>电话</td>
		<td style="width:20%;border-bottom: 1px solid black;">0760-88886258</td>
		<td style="width:45%;" align="right">委托人章戳(签字)</td>
	</tr>
	<tr>
		<td>邮政编码</td>
		<td style="width:20%;border-bottom: 1px solid black;">528400</td>
		<td style="width:45%;" align="right">2017 年 07 月 15 日</td>
	</tr>
</table>
';

// Print text using writeHTMLCell()
//$pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTML($html_3, true, 0, true, 0);

/*-----------------------------第三页（商标代理委托书）end---------------------------------------*/
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');
?>