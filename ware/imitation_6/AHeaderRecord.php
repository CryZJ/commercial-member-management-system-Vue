<?php
$earn_record = "收入记录_".$firm_id;//收入记录，表
$earn_file_record = "收入记录文件_".$firm_id;//收入记录文件，表
$expend_record = "支出记录_".$firm_id;//支出记录，表
$expend_file_record = "支出记录文件_".$firm_id;//支出记录文件，表
$arrearage_record = "欠费记录_".$firm_id;//欠费记录，表

$finance_month_record = "财务月统计_".$firm_id;//财务月统计，表
$earn_month_record = "收入统计首月_".$firm_id;//收入统计首月，视图
$expend_month_record = "支出统计首月_".$firm_id;//支出统计首月，视图

//获取公司名称
require("../../conn.php");
$firmname_show = "";
$sql = "SELECT 公司 FROM 公司管理 WHERE 删除状态='0' AND id='".$firm_id."'";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_row()){
		$firmname_show = $row[0];
	}
}
?>