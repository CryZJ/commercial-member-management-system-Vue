<?php
//header("content-type=text/html;charset=utf-8");
//$text = '根据我方档案记载，下表所列的专利应在缴费期限前向中国专利局交纳年费，请贵方在“回复期限”前通知我方是否缴纳附表所述专利的年费。根据专利法的规定，未按规定缴纳年费的，专利权自应当缴纳年费期满之日起终止，专利权终止后不再办理专利权恢复手续。如果需要缴纳所述费用的, 请配合我们做好以下工作：在“回复期限”前将上述款项汇至我方账号, 并请务必将汇款单传真至我方，同时在其上注明我方文号及写明用途为年费或附经确认的需要缴费的专利的清单。否则, 我方将视贵方已放弃该专利权，不缴纳该专利年费, 并将相应的专利结案。';
 /*$str = array(
'珠海格兰新材料科技有限公司',
'2017年6月23日',
'2017年7月15日',
'款胡','0258-9652154','12563254257',
'光八戒','0125-6325142','12563254251',
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
$str_get = $_POST['data1'];
$str2 = $_POST['data2'];
$file_name = $_POST['data3'];
//echo $str_get."\n<hr/>";
//echo $str2."\n<hr/>";

$str = explode("|", $str_get);
$arr_str2 = explode(",", $str2);

//print_r($str);
//echo "<hr/>";
//print_r($arr_str2);
/*
黎丽|人愿意|专利年费通知|2017-11-18|2017-12-08|asa|sa|sa|as|黎丽|0760-88886258|||11111|11111111|3333 3333 3333 3333 333
74,201322,ceshi,2017-11-13,7,2000,100,0,2100,75,201322,ceshi,2017-11-13,8,2000,100,0,2100,76,201322,ceshi,2017-11-13,9,2000,100,0,2100,6300
$str Array ( [0] => 黎丽 [1] => 人愿意 [2] => 专利年费通知 [3] => 2017-11-18 [4] => 2017-12-08 [5] => asa [6] => sa [7] => sa [8] => as [9] => 黎丽 [10] => 0760-88886258 [11] => [12] => [13] => 11111 [14] => 11111111 [15] => 3333 3333 3333 3333 333 )
$arr_str2 Array ( [0] => 74 [1] => 201322 [2] => ceshi [3] => 2017-11-13 [4] => 7 [5] => 2000 [6] => 100 [7] => 0 [8] => 2100 [9] => 75 [10] => 201322 [11] => ceshi [12] => 2017-11-13 [13] => 8 [14] => 2000 [15] => 100 [16] => 0 [17] => 2100 [18] => 76 [19] => 201322 [20] => ceshi [21] => 2017-11-13 [22] => 9 [23] => 2000 [24] => 100 [25] => 0 [26] => 2100 [27] => 6300 )
*/

/*连接类文件*/
require_once 'PHPWord.php';

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
// $str : [1] => 人愿意  [3] => 2017-11-18 [4] => 2017-12-08
$arr_start = explode("-", $str[3]);
$arr_end = explode("-", $str[4]);
$str_start = $arr_start[0]." 年  ".$arr_start[1]." 月  ".$arr_start[2]." 日 ";
$str_end = $arr_end[0]." 年  ".$arr_end[1]." 月  ".$arr_end[2]." 日 ";

//头部信息：致，事由，发函日期，回复日期
$my_section_one->addText('致：'.$str[1],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('事由：专利年费通知',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('发函日期：'.$str_start,array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('回复日期：'.$str_end,array('name'=>'楷体','bold'=>true,'size'=>12));
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
$my_Word->addFontStyle('rStyle_my', array('name'=>'楷体', 'size'=>12));
$my_Word->addParagraphStyle('pStyle', array('align'=>'left'));
$table_4 = $my_section_one->addTable('myTable_4');
//表头<header>
/*表格列宽、行高*/
$heigth_0 = 80;//
$width_1 = 1200;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1800;//
$width_5 = 850;//手机
$width_6 = 1000;//
$width_7 = 850;//邮箱
$width_8 = 1000;//

$num_str = count($str);
$cli_num = $num_str-5-4-3;//客户联系人从键值5开始，减去头部信息（5），我方联系人（4），银行账号（3）
for($i=0;$i<($cli_num/4);$i++){
	$table_4->addRow($heigth_0);
	$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
	$table_4->addCell($width_2)->addText($str[$i*4+5],'rStyle_my','pStyle');
	$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
	$table_4->addCell($width_4)->addText($str[$i*4+6],'rStyle_my','pStyle');
	$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
	$table_4->addCell($width_6)->addText($str[$i*4+7],'rStyle_my','pStyle');
	$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
	$table_4->addCell($width_8)->addText($str[$i*4+8],'rStyle_my','pStyle');
}

//for($i=0;$i<3;$i++){
//	$table_4->addRow($heigth_0);
//	$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
//	$table_4->addCell($width_2)->addText('李鹏飞','rStyle_my','pStyle');
//	$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
//	$table_4->addCell($width_4)->addText('0689-1256325','rStyle_my','pStyle');
//	$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
//	$table_4->addCell($width_6)->addText('12635245821','rStyle_my','pStyle');
//	$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
//	$table_4->addCell($width_8)->addText('1235625456@qq.com','rStyle_my','pStyle');	
//}
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
$my_Word->addFontStyle('rStyle_my', array('name'=>'楷体', 'size'=>12));
$my_Word->addParagraphStyle('pStyle', array('align'=>'left'));
$table_4 = $my_section_one->addTable('myTable_4');
//表头<header>
/*表格列宽、行高*/
$heigth_0 = 80;//
$width_1 = 1200;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1800;//
$width_5 = 850;//手机
$width_6 = 1000;//
$width_7 = 850;//邮箱
$width_8 = 1000;//

$num_my = $num_str-3;    		//我方联系人倒数第七个开始，先减银行账户（3）

$table_4->addRow($heigth_0);
$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
$table_4->addCell($width_2)->addText($str[$num_my-4],'rStyle_my','pStyle');
$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
$table_4->addCell($width_4)->addText($str[$num_my-3],'rStyle_my','pStyle');
$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
$table_4->addCell($width_6)->addText($str[$num_my-2],'rStyle_my','pStyle');
$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
$table_4->addCell($width_8)->addText($str[$num_my-1],'rStyle_my','pStyle');	

/*
for($i=0;$i<3;$i++){
	$table_4->addRow($heigth_0);
	$table_4->addCell($width_1)->addText('联系人：','rStyle_b','pStyle');
	$table_4->addCell($width_2)->addText('李鹏飞','rStyle_my','pStyle');
	$table_4->addCell($width_3)->addText('固话：','rStyle_b','pStyle');
	$table_4->addCell($width_4)->addText('0689-1256325','rStyle_my','pStyle');
	$table_4->addCell($width_5)->addText('手机：','rStyle_b','pStyle');
	$table_4->addCell($width_6)->addText('12635245821','rStyle_my','pStyle');
	$table_4->addCell($width_7)->addText('邮箱：','rStyle_b','pStyle');
	$table_4->addCell($width_8)->addText('1235625456@qq.com','rStyle_my','pStyle');	
}
 * */
$my_section_one->addTextBreak();

//敬语：尊敬的专利权人
$my_section_one->addText('尊敬的专利权人：',array('name'=>'楷体','bold'=>true,'size'=>12));
$text_hear = "根据我方档案记载，下表所列的专利应在缴费期限前向中国专利局交纳年费，请贵方在“回复期限”前通知我方是否缴纳附表所述专利的年费。根据专利法的规定，未按规定缴纳年费的，专利权自应当缴纳年费期满之日起终止，专利权终止后不再办理专利权恢复手续。如果需要缴纳所述费用的, 请配合我们做好以下工作：在“回复期限”前将上述款项汇至我方账号, 并请务必将汇款单传真至我方，同时在其上注明我方文号及写明用途为年费或附经确认的需要缴费的专利的清单。否则, 我方将视贵方已放弃该专利权，不缴纳该专利年费, 并将相应的专利结案。";
$my_section_one->addText('    '.$text_hear,array('name'=>'楷体','size'=>12));
$my_section_one->addTextBreak();


//银行账号信息
//$num_str//银行账户最后倒数（3）
$my_section_one->addText('开户银行：'.$str[$num_str-3],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('户    名：'.$str[$num_str-2],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('银行账号：'.$str[$num_str-1],array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addTextBreak();


//费用表格信息
//表格标题
$my_Word->addFontStyle('rStyle', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addParagraphStyle('PStyle_c', array('align'=>'center'));
$my_section_one->addText('年费通知附表','rStyle','PStyle_c');
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
$width_4 = 1800;//申请日
$width_5 = 900;//年度
$width_6 = 1000;//年费
$width_7 = 1000;//代理费
$width_8 = 1000;//小计

$table_3->addRow($heigth_0);
$table_3->addCell($width_1)->addText('序号','rStyle_b','pStyle_c');
$table_3->addCell($width_2)->addText('专利号','rStyle_b','pStyle_c');
$table_3->addCell($width_3)->addText('专利名称','rStyle_b','pStyle_c');
$table_3->addCell($width_4)->addText('申请日','rStyle_b','pStyle_c');
$table_3->addCell($width_5)->addText('年度','rStyle_b','pStyle_c');
$table_3->addCell($width_6)->addText('年滞金','rStyle_b','pStyle_c');
$table_3->addCell($width_7)->addText('代理费','rStyle_b','pStyle_c');
$table_3->addCell($width_8)->addText('小计','rStyle_b','pStyle_c');

//表内容<tr><td></td><tr>
$num_str2 = count($arr_str2);//费用表格的总长度
//id,专利号，专利名，申请日，年度，年费，代理费，滞纳金，小计...总计
for($i=0;$i<($num_str2-1)/9;$i++){
	$table_3->addRow($heigth_0);
	$table_3->addCell($width_1)->addText($i+1,'rStyle_my','pStyle_c');
	$table_3->addCell($width_2)->addText($arr_str2[$i*9+1],'rStyle_my','pStyle_c');
	$table_3->addCell($width_3)->addText($arr_str2[$i*9+2],'rStyle_my','pStyle_c');
	$table_3->addCell($width_4)->addText($arr_str2[$i*9+3],'rStyle_my','pStyle_c');
	$table_3->addCell($width_5)->addText($arr_str2[$i*9+4],'rStyle_my','pStyle_c');
	$table_3->addCell($width_6)->addText(round(floatval($arr_str2[$i*9+5])+floatval($arr_str2[$i*9+7])),'rStyle_my','pStyle_c');
	$table_3->addCell($width_7)->addText(round($arr_str2[$i*9+6]),'rStyle_my','pStyle_c');
	$table_3->addCell($width_8)->addText(round($arr_str2[$i*9+8]),'rStyle_my','pStyle_c');
}

//	$table_3->addRow($heigth_0);
//	$table_3->addCell($width_1)->addText($i,'rStyle_my','pStyle_c');
//	$table_3->addCell($width_2)->addText('2012102437610','rStyle_my','pStyle_c');
//	$table_3->addCell($width_3)->addText('一种折叠型珍珠棉包装件及其制作方法','rStyle_my','pStyle_c');
//	$table_3->addCell($width_4)->addText('2012-7-16','rStyle_my','pStyle_c');
//	$table_3->addCell($width_5)->addText('6','rStyle_my','pStyle_c');
//	$table_3->addCell($width_6)->addText('180','rStyle_my','pStyle_c');
//	$table_3->addCell($width_7)->addText('100','rStyle_my','pStyle_c');
//	$table_3->addCell($width_8)->addText('280','rStyle_my','pStyle_c');	

//表格最后一行<foot>
$table_3->addRow($heigth_0);
$table_3->addCell($width_1,array('cellMerge'=>'restart','valign'=>'center'))->addText('总计','rStyle_my','pStyle_c');
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_1,array('cellMerge'=>'continue'));
$table_3->addCell($width_8)->addText($arr_str2[$num_str2-1],'rStyle_my','pStyle_c');

//保存临时文件
$objWriter = PHPWord_IOFactory::createWriter($my_Word, 'Word2007');
$objWriter->save('person/example2.docx');

//保存文件 $file_name
$save_dir = "../filesave_notice";
if(!file_exists($save_dir)){
	mkdir ( $save_dir, 0777, true );
	chmod ( $save_dir, 0777 );
}
$save_path = $save_dir."/".$file_name;
if(file_exists("person/example2.docx")){
	@copy("person/example2.docx", $save_path);
	
	echo "success";
}

//$down_path = "person/example2.docx";
//if(strpos($str[1], ",")){
//	$str[1] = str_replace(",", "-", $str[1]);
//}
//if(file_exists($down_path)){
//	header('content-disposition:attachment;filename='.$str[1].'.docx');
//	header('content-length:'.filesize($down_path));
//	readfile($down_path);
//}	

	


?>