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
//接收数据
$top_str = $_POST['data1'];
$cli_link = $_POST['data2'];
$my_link = $_POST['data3'];
$bank = $_POST['data4'];
$str2 = $_POST['data5'];
$send_num = $_POST['data6'];
//整理数据
$top_arr = explode("||", $top_str);
$cli_link = explode(",", $cli_link);
$my_link = explode(",", $my_link);
$bank = explode(",", $bank);
$str2 = explode(",", $str2);
$send_num = explode(",", $send_num);

//print_r($top_arr);
//判断那个模板
$PHPWord = new PHPWord();
if($send_num[0] > 3 || $send_num[1]>10){
	echo '<script type="text/javascript">alert("费用数量大于10行或客户联系人多于三个，请联系开发人员更新！");</script>';
	echo '<script type="text/javascript">window.close();</script>';
	exit;
}
//$docfile_name = "wordmodle/impower/i3_5.docx";
$docfile_name = "wordmodle/impower/i".$send_num[0]."_".$send_num[1].".docx";
//$docfile_name = iconv('utf-8', 'GB2312//IGNORE',$docfile_name);
//echo '<script type="text/javascript">alert("'.$docfile_name.'")</script>';
$document = $PHPWord->loadTemplate($docfile_name);


//日期显示变换
$arr_str = explode("-", $top_arr[1]);
$str_time = $arr_str[0]."年".$arr_str[1]."月".$arr_str[2]."日";

$arr_str2 = explode("-", $top_arr[2]);
$str_time2 = $arr_str2[0]."年".$arr_str2[1]."月".$arr_str2[2]."日";

//基本信息
$document->setValue('client',iconv('utf-8', 'GB2312//IGNORE', $top_arr[0]));
$document->setValue('end',iconv('utf-8', 'GB2312//IGNORE', $str_time));
$document->setValue('star',iconv('utf-8', 'GB2312//IGNORE', $str_time2));

//客户联系人
foreach($cli_link as $key_0 => $value_0){
	$cli_flag = "client".$key_0;
	$document->setValue($cli_flag,iconv('utf-8', 'GB2312//IGNORE', $value_0));
}

//我方联系人
foreach($my_link as $key_0 => $value_0){
	$lin_flag = "mylink".$key_0;
	$document->setValue($lin_flag,iconv('utf-8', 'GB2312//IGNORE',$value_0));
}

//银行账号
$document->setValue('bank',iconv('utf-8', 'GB2312//IGNORE', $bank[0]));
$document->setValue('company',iconv('utf-8', 'GB2312//IGNORE', $bank[1]));
$document->setValue('account',iconv('utf-8', 'GB2312//IGNORE', $bank[2]));

//致词
$document->setValue('text',iconv('utf-8', 'GB2312//IGNORE', $text));

//费用表
$con_num = count($str2);
$num = 0;

foreach($str2 as $key_0 => $value_0){
	if($key_0 != ($con_num-1)){
		$flag = "value".$key_0;
		$document->setValue($flag,iconv('utf-8', 'GB2312//IGNORE', $value_0));		
	}
}

//总费用
$count = "500";
$document->setValue("count",iconv('utf-8', 'GB2312//IGNORE', $str2[$con_num-1]));

$document->save('person/example1.docx');


sleep(2);
//下载
//	$tmp_name = explode(",", $top_arr[0]); 
	$exp_name = str_replace(",", "-", $top_arr[0]);
//	$exp_name = strval($exp_name);
	
	$file_name = "example1.docx"; 
	$file_dir = "person/"; 
	echo $file_dir;
if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
	echo "文件找不到"; 
	exit; 
} else { 
$file = fopen($file_dir . $file_name,"r"); // 打开文件 
// 输入文件标签 
	Header("Content-type: application/octet-stream"); 
	Header("Accept-Ranges: bytes"); 
	Header("Accept-Length: ".filesize($file_dir . $file_name)); 
	Header("Content-Disposition: attachment; filename=".$exp_name.".docx"); 
// 输出文件内容 
echo fread($file,filesize($file_dir . $file_name)); 
fclose($file); 
exit;} 


?>