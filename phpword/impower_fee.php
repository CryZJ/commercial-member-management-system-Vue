<?php
require_once 'PHPWord.php';

$text = '恭喜您申请的专利已经通过了国家知识产权局的审查。在收到本通知后，请在回复绝限前缴纳下表所列的专利申请的专利登记费、专利证书印花税、年费，在您缴纳上述费用后，国家知识产权局将在2-3个月内颁发专利证书，并在国家知识产权局的网站上予以公告。根据专利法的规定，未按规定缴纳上述费用的，视为放弃取得专利的权利，专利权终止后不再办理专利权恢复手续，如果放弃下表所列的专利或部分专利，请您在通知书上写明“放弃”字样并签名或加盖公章，在回复绝限前寄回或传真回我司，我司将相应的专利结案。在此非常感谢您配合和支持我们的工作。';
/*
$top_str = '珠海格兰新材料科技有限公司';
$date = array('2017-6-23','2017-7-15',);
$client_link = array(
'款胡','0258-9652154','12563254257','15641654165@qq.com',
'款胡','0258-9652154','12563254257','15641651512@qq.com',
'款胡','0258-9652154','12563254257','15641651512@qq.com'
);
$my_link = array('光八戒','0125-6325142','12563254251','16515615112@qq.com');
$bank = array(
'广发银行中山彩虹支行',
'中山市中亿星诚知识产权服务有限公司',
'9550 8802 0597 3200 158'
);
//表格数据
$data = array();
$data[0] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[1] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[2] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[3] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[4] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[5] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[6] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[7] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[8] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
$data[9] = array('2016214399863','一种环保防水板材','2016-12-27','205','90','100','395');
*/
//top_str,cli_link,my_link,bank,str2,send_num

//top_str 致||发函日期||回复日期
//cli_link  联系人||固话||手机||邮箱,联系人||固话||手机||邮箱
//my_link 联系人||固话||手机||邮箱
//bank 开户银行,户名,银行账号
//str2 专利号,专利名,申请日,登记费,年费,代理费,小计,总计
//接收数据
$top_str = $_POST['data1'];
$cli_link = $_POST['data2'];
$my_link = $_POST['data3'];
$bank = $_POST['data4'];
$str2 = $_POST['data5'];
$send_num = $_POST['data6'];
$file_name = $_POST['data7'];
//整理数据
//echo $cli_link."\n<br/>";
//echo $my_link."\n<br/>";

$top_arr = explode("||", $top_str);
$cli_link = explode("||", $cli_link);
$my_link = explode("||", $my_link);
$bank = explode(",", $bank);
$str2 = explode(",", $str2);
$send_num = explode(",", $send_num);

//print_r($top_arr);

/*新建一个PHPWord类，最后保存为docx文件*/
$my_Word = new PHPWord();

/*新建一个页面*/
//页面样式
$sectionStyle = array(
	'orientation' => null,
	'marginLeft' => 1400 ,
	'marginRight' =>  900,
	'marginTop' => 1700 ,
	'marginBottom' =>  1700
);
$my_section_one = $my_Word ->createSection($sectionStyle);

/*创建页眉和页脚*/
//页眉
$header = $my_section_one -> createHeader();

$styleTable = array(
	'borderBottomSize'=>5,
	'borderBottomColor'=>'000000',
	'cellMargin'=>20
);
$my_Word->addTableStyle('myTable', $styleTable);
$table = $header->addTable('myTable');
$row_one = $table -> addRow(100);
$img = $table->addCell(100);
$img->addImage('image/yi.jpg',array('width'=>50,'height'=>50,'align'=>'left'));
$text = $table->addCell(9000);
$text->addText('广东中亿律师事务所（机构代码：44277）',array('name'=>'隶书','size'=>13,'color'=>'red'));
$text->addText('中山市中亿星诚知识产权服务有限公司',array('name'=>'隶书','size'=>13,'color'=>'red'));
//页脚
$footer = $my_section_one->createFooter();
$styleTable_2 = array(
	'borderTopSize'=>5,
	'borderBottomColor'=>'blue',
	'cellMargin'=>20
);
$my_Word->addTableStyle('myTable_2', $styleTable_2);
$table_f = $footer->addTable('myTable_2');
$row_one = $table_f->addRow();
$table_f->addCell(9000)->addText('地址：中山市东区起湾道金来街1号來胜商务楼619',array('name'=>'隶书','size'=>12,'color'=>'red'));
//$table_f->addCell(500);
$row_tow = $table_f->addRow();
$table_f->addCell(4000)->addText('电话：0760-88886258        传真：0760-88886171',array('name'=>'隶书','size'=>12,'color'=>'red'));
//$table_f->addCell(4000)->addText('传真：0760-88886171',array('name'=>'隶书','size'=>12,'color'=>'red'));



/*页面内容*/

//头部信息：致，事由，发函日期，回复日期
//日期显示变换
$arr_str = explode("-", $top_arr[1]);
$str_time = $arr_str[0]." 年 ".$arr_str[1]." 月 ".$arr_str[2]." 日 ";
$arr_str2 = explode("-", $top_arr[2]);
$str_time2 = $arr_str2[0]." 年 ".$arr_str2[1]." 月 ".$arr_str2[2]." 日 ";
//填写
$my_section_one->addText('致：'.$top_arr[0],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('事由：专利授权缴费通知',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('发函日期：'.$str_time,array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('回复日期：'.$str_time2,array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addTextBreak();

//客户联系方式
$my_section_one->addText('客户联系方式：',array('name'=>'楷体','bold'=>true,'size'=>12));
$styleTable_4 = array(
//	'borderSize'=>5,
//	'borderColor'=>'000000',
	'cellMargin'=>25
);
$my_Word->addTableStyle('myTable_4', $styleTable_4);
$my_Word->addFontStyle('rStyle_b', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addFontStyle('rStyle_my', array('name'=>'楷体', 'size'=>11));
$my_Word->addParagraphStyle('pStyle', array('align'=>'left'));
$table_4 = $my_section_one->addTable('myTable_4');
//表头<header>
/*表格列宽、行高*/
$heigth_0 = 80;//
$width_1 = 1050;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1800;//
$width_5 = 850;//手机
$width_6 = 1100;//
$width_7 = 850;//邮箱
$width_8 = 1000;//
$arr_length = count($cli_link);
//print_r($cli_link);
for($i=0;$i<$arr_length/4;$i++){
	$table_4->addRow($heigth_0);
	$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
	$table_4->addCell($width_2)->addText($cli_link[$i*4],'rStyle_my','pStyle');
	$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
	$table_4->addCell($width_4)->addText($cli_link[$i*4+1],'rStyle_my','pStyle');
	$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
	$table_4->addCell($width_6)->addText($cli_link[$i*4+2],'rStyle_my','pStyle');
	$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
	$table_4->addCell($width_8)->addText($cli_link[$i*4+3],'rStyle_my','pStyle');	
}
$my_section_one->addTextBreak();

//我方联系方式
$my_section_one->addText('我方联系方式：',array('name'=>'楷体','bold'=>true,'size'=>12));
$styleTable_4 = array(
//	'borderSize'=>5,
//	'borderColor'=>'000000',
	'cellMargin'=>25
);
$my_Word->addTableStyle('myTable_4', $styleTable_4);
$my_Word->addFontStyle('rStyle_b', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addFontStyle('rStyle_my', array('name'=>'楷体', 'size'=>11));
$my_Word->addParagraphStyle('pStyle', array('align'=>'left'));
$table_4 = $my_section_one->addTable('myTable_4');
//表头<header>
/*表格列宽、行高*/
$heigth_0 = 80;//
$width_1 = 1050;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1800;//
$width_5 = 850;//手机
$width_6 = 1100;//
$width_7 = 850;//邮箱
$width_8 = 1000;//

$arr_length = count($my_link);
for($i=0;$i<$arr_length/4;$i++){
	$table_4->addRow($heigth_0);
	$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
	$table_4->addCell($width_2)->addText($my_link[$i*4],'rStyle_my','pStyle');
	$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
	$table_4->addCell($width_4)->addText($my_link[$i*4+1],'rStyle_my','pStyle');
	$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
	$table_4->addCell($width_6)->addText($my_link[$i*4+2],'rStyle_my','pStyle');
	$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
	$table_4->addCell($width_8)->addText($my_link[$i*4+3],'rStyle_my','pStyle');	
}
$my_section_one->addTextBreak();

//敬语：尊敬的专利权人
$my_section_one->addText('尊敬的申请人：',array('name'=>'楷体','bold'=>true,'size'=>12));
$text_hear = "恭喜您申请的专利已经通过了国家知识产权局的审查。在收到本通知后，请在回复绝限前缴纳下表所列的专利申请的专利登记费、专利证书印花税、年费，在您缴纳上述费用后，国家知识产权局将在2-3个月内颁发专利证书，并在国家知识产权局的网站上予以公告。根据专利法的规定，未按规定缴纳上述费用的，视为放弃取得专利的权利，专利权终止后不再办理专利权恢复手续，如果放弃下表所列的专利或部分专利，请您在通知书上写明“放弃”字样并签名或加盖公章，在回复绝限前寄回或传真回我司，我司将相应的专利结案。在此非常感谢您配合和支持我们的工作。";
$my_section_one->addText('    '.$text_hear,array('name'=>'楷体','size'=>12));
$my_section_one->addTextBreak();


//银行账号信息
$my_section_one->addText('开户银行：'.$bank[0],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('户    名：'.$bank[1],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('银行账号：'.$bank[2],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addTextBreak();


//表格信息
//表格标题
$my_Word->addFontStyle('rStyle', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addParagraphStyle('pStyle_c', array('align'=>'center'));
$my_section_one->addText('授权通知附表','rStyle','pStyle_c');
//表格内容
$styleTable_3 = array(
	'borderSize'=>5,
	'borderColor'=>'000000',
	'cellMargin'=>50
);
$my_Word->addTableStyle('myTable_3', $styleTable_3);
$my_Word->addFontStyle('rStyle_b', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addFontStyle('rStyle_my', array('name'=>'楷体', 'size'=>12));
$my_Word->addParagraphStyle('pStyle_c', array('align'=>'center'));
$table_3 = $my_section_one->addTable('myTable_3');
//表头<header>
/*表格列宽、行高*/
$heigth_0 = 80;//行高
$width_1 = 900;//序号
$width_2 = 1000;//专利号
$width_3 = 3200;//专利名称
$width_4 = 1500;//申请日
$width_5 = 1000;//登记费
$width_6 = 1000;//年费
$width_7 = 1000;//代理费
$width_8 = 1000;//小计

$table_3->addRow($heigth_0);
$table_3->addCell($width_1)->addText('序号','rStyle_b','pStyle_c');
$table_3->addCell($width_2)->addText('专利号','rStyle_b','pStyle_c');
$table_3->addCell($width_3)->addText('专利名称','rStyle_b','pStyle_c');
$table_3->addCell($width_4)->addText('申请日','rStyle_b','pStyle_c');
$table_3->addCell($width_5)->addText('印花费','rStyle_b','pStyle_c');
$table_3->addCell($width_6)->addText('年费','rStyle_b','pStyle_c');
$table_3->addCell($width_7)->addText('代理费','rStyle_b','pStyle_c');
$table_3->addCell($width_8)->addText('小计','rStyle_b','pStyle_c');

//表内容<tr><td></td><tr>
//费用表
$con_num = count($str2);
for($i=0;$i<($con_num-1)/7;$i++){
	$table_3->addRow($heigth_0);
	$table_3->addCell($width_1)->addText($i+1,'rStyle_my','pStyle_c');
	$table_3->addCell($width_2)->addText($str2[$i*7],'rStyle_my','pStyle_c');
	$table_3->addCell($width_3)->addText($str2[$i*7+1],'rStyle_my','pStyle_c');
	$table_3->addCell($width_4)->addText($str2[$i*7+2],'rStyle_my','pStyle_c');
	$table_3->addCell($width_5)->addText(round($str2[$i*7+3]),'rStyle_my','pStyle_c');
	$table_3->addCell($width_6)->addText(round($str2[$i*7+4]),'rStyle_my','pStyle_c');
	$table_3->addCell($width_7)->addText(round($str2[$i*7+5]),'rStyle_my','pStyle_c');
	$table_3->addCell($width_8)->addText(round($str2[$i*7+6]),'rStyle_my','pStyle_c');		
}

//表格最后一行<foot>
$table_3->addRow($heigth_0);
$table_3->addCell($width_1,array('cellMerge'=>'restart','valign'=>'center'))->addText('总计','rStyle_my','pStyle_c');
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_8)->addText($str2[$con_num-1],'rStyle_my','pStyle_c');



//保存临时文件
$objWriter = PHPWord_IOFactory::createWriter($my_Word, 'Word2007');
$objWriter->save('person/example1.docx');

//保存文件 $file_name
$save_dir = "../filesave_notice";
if(!file_exists($save_dir)){
	mkdir ( $save_dir, 0777, true );
	chmod ( $save_dir, 0777 );
}
$save_path = $save_dir."/".$file_name;
if(file_exists("person/example1.docx")){
	@copy("person/example1.docx", $save_path);
}


//echo '<script type="text/javascript">window.close();</script>';

echo "success";

//下载
////	$tmp_name = explode(",", $top_arr[0]); 
//	$exp_name = str_replace(",", "-", $top_arr[0]);
////	$exp_name = strval($exp_name);
//	
//	$file_name = "example1.docx"; 
//	$file_dir = "person/"; 
//if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
//	echo "文件找不到"; 
//	exit; 
//} else { 
//	$file = fopen($file_dir . $file_name,"r"); // 打开文件 
//// 输入文件标签 
//	Header("Content-type: application/octet-stream"); 
//	Header("Accept-Ranges: bytes"); 
//	Header("Accept-Length: ".filesize($file_dir . $file_name)); 
//	Header("Content-Disposition: attachment; filename=".$exp_name.".docx"); 
//// 输出文件内容 
//	echo fread($file,filesize($file_dir . $file_name)); 
//	fclose($file); 
//	exit;
//} 


?>