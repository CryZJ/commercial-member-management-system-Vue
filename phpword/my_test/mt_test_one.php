<?php
/*
 * 功能	：		年费通知
 * 创建时间：2017-11-12
 * 创建人：KingShen
 * */
/*连接类文件*/
require_once '../PHPWord.php';

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
$my_section_one->addText('致：李鹏',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('事由：专利年费通知',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('发函日期：2017 年 5 月 11 日',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('回复日期：2017 年 5 月 30 日',array('name'=>'楷体','bold'=>true,'size'=>12));
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
$width_1 = 1050;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1500;//
$width_5 = 850;//手机
$width_6 = 1000;//
$width_7 = 850;//邮箱
$width_8 = 1000;//
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
$width_1 = 1050;//联系人
$width_2 = 1000;//
$width_3 = 850;//固话
$width_4 = 1500;//
$width_5 = 850;//手机
$width_6 = 1000;//
$width_7 = 850;//邮箱
$width_8 = 1000;//
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
$my_section_one->addTextBreak();

//敬语：尊敬的专利权人
$my_section_one->addText('尊敬的专利权人：',array('name'=>'楷体','bold'=>true,'size'=>12));
$text_hear = "根据我方档案记载，下表所列的专利应在缴费期限前向中国专利局交纳年费，请贵方在“回复期限”前通知我方是否缴纳附表所述专利的年费。根据专利法的规定，未按规定缴纳年费的，专利权自应当缴纳年费期满之日起终止，专利权终止后不再办理专利权恢复手续。如果需要缴纳所述费用的, 请配合我们做好以下工作：在“回复期限”前将上述款项汇至我方账号, 并请务必将汇款单传真至我方，同时在其上注明我方文号及写明用途为年费或附经确认的需要缴费的专利的清单。否则, 我方将视贵方已放弃该专利权，不缴纳该专利年费, 并将相应的专利结案。";
$my_section_one->addText('    '.$text_hear,array('name'=>'楷体','size'=>12));
$my_section_one->addTextBreak();

//银行账号信息
$my_section_one->addText('开户银行：广发银行中山彩虹支行',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('户    名：中山市中亿星诚知识产权服务有限公司',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addText('银行账号：9550 8802 0597 3200 158',array('name'=>'楷体','bold'=>true,'size'=>12));
$my_section_one->addTextBreak();

//表格信息

//表格标题
$my_Word->addFontStyle('rStyle', array('name'=>'楷体','bold'=>true, 'size'=>12));
$my_Word->addParagraphStyle('pStyle', array('align'=>'center'));
$my_section_one->addText('年费通知附表','rStyle','pStyle');
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
$width_2 = 100;//专利号
$width_3 = 3200;//专利名称
$width_4 = 1500;//申请日
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
$table_3->addCell($width_6)->addText('年费','rStyle_b','pStyle_c');
$table_3->addCell($width_7)->addText('代理费','rStyle_b','pStyle_c');
$table_3->addCell($width_8)->addText('小计','rStyle_b','pStyle_c');

//表内容<tr><td></td><tr>

for($i=0;$i<50;$i++){
	$table_3->addRow($heigth_0);
	$table_3->addCell($width_1)->addText($i,'rStyle_my','pStyle_c');
	$table_3->addCell($width_2)->addText('2012102437610','rStyle_my','pStyle_c');
	$table_3->addCell($width_3)->addText('一种折叠型珍珠棉包装件及其制作方法','rStyle_my','pStyle_c');
	$table_3->addCell($width_4)->addText('2012-7-16','rStyle_my','pStyle_c');
	$table_3->addCell($width_5)->addText('6','rStyle_my','pStyle_c');
	$table_3->addCell($width_6)->addText('180','rStyle_my','pStyle_c');
	$table_3->addCell($width_7)->addText('100','rStyle_my','pStyle_c');
	$table_3->addCell($width_8)->addText('280','rStyle_my','pStyle_c');	
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
$table_3->addCell($width_8)->addText('560','rStyle_my','pStyle_c');



//保存文件
$objWriter = PHPWord_IOFactory::createWriter($my_Word, 'Word2007');
$objWriter->save('my_test.docx');


//下载
	$file_name = "my_test.docx"; 
	$file_dir = ""; 
//	echo $file_dir;
if(!file_exists($file_dir . $file_name)) { //检查文件是否存在 
		echo "文件找不到"; 
		exit; 
}else{ 
	$file = fopen($file_dir . $file_name,"r"); // 打开文件 
// 输入文件标签 
	Header("Content-type: application/octet-stream"); 
	Header("Accept-Ranges: bytes"); 
	Header("Accept-Length: ".filesize($file_dir . $file_name)); 
	Header("Content-Disposition: attachment; filename=my_test.docx"); 
// 输出文件内容 
	echo fread($file,filesize($file_dir . $file_name)); 
	fclose($file); 
	exit;
}


?>