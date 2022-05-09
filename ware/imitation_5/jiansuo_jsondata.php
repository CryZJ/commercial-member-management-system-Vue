<?php
require("../../AHeader.php");
require("../../conn.php");
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}
$jiansuo = $_GET['jiansuo'];
//$jiansuo = "李";

//	$sql = "SELECT a.`id`,a.`申请人`, a.`证件号`,a.`地址`,a.`邮政编码`,a.`费减备案`,a.`备注`,a.`记录所属`,b.`名称` AS 所属名称,`删除状态` FROM `申请人检索`a,`用户`b WHERE a.`记录所属`=b.`id` AND a.`联系人姓名` LIKE'%%$jiansuo%%' OR a.`发明人姓名` LIKE'%%$jiansuo%%' OR a.`备注` LIKE'%%$jiansuo%%' OR a.`手机` LIKE'%%$jiansuo%%'";
	$sql = "select a.id,a.申请人,a.证件号,a.地址,a.邮政编码,a.费减备案,a.备注,a.记录所属,b.名称 AS 所属名称,a.删除状态 from `申请人检索`a join `用户`b on a.记录所属 = b.id WHERE  a.联系人姓名 LIKE'%%$jiansuo%%' OR a.发明人姓名 LIKE'%%$jiansuo%%' OR a.备注 LIKE'%%$jiansuo%%' OR a.手机 LIKE'%%$jiansuo%%'order by id desc";
		$sql_data = "";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				//整理数据
				foreach($row as $ky => $tmp_data){
							$row[$ky] = Settle_string($tmp_data);
						}
						
				if($admin == 1||$lcczy == 1){//显示所属名称
					$sql_data .= ','.'{"申请人":"<a name=\'client_one.php?sonid='.$row[0].'&ss='.$row[7].'\'  onclick=\'Open_altertocheck_sqr(this.name)\' >'.$row[1].'</a>","证件号":"'.$row[2].'","地址":"'.$row[3].'","邮政编码":"'.$row[4].'","费减备案":"'.$row[5].'","备注":"'.$row[6].'","所属id":"'.$row[7].'","所属名称":"'.$row[8].'",';
					if($row[9] == "1"){//有恢复按钮
						$sql_data .= '"操作":"<button  id=\''.$row[0].'\' class=\'btn btn-success\' onclick =\'reply_client(this)\'>恢复</button>"}';
					}else{//有删除按钮
						$sql_data .= '"操作":"<button  id=\''.$row[0].'\' class=\'btn btn-success\' onclick =\'del_client(this)\'>删除</button>"}';
					}
				}else{//不显示所属名称,并只有删除按钮
					$sql_data .= ','.'{"申请人":"<a name=\'client_one.php?sonid='.$row[0].'&ss='.$row[7].'\'  onclick=\'Open_altertocheck_sqr(this.name)\' >'.$row[1].'</a>","证件号":"'.$row[2].'","地址":"'.$row[3].'","邮政编码":"'.$row[4].'","费减备案":"'.$row[5].'","备注":"'.$row[6].'","所属id":"'.$row[7].'","所属名称":"","操作":"<button  id=\''.$row[0].'\' class=\'btn btn-success\' onclick =\'del_client(this)\'>删除</button>"}';
							
						}
			}
			$sql_data = substr($sql_data, 1);
		}else{
			$serror = "无数据";
		}
		$json_str = '{"data":['.$sql_data.'],"sError":"'.$serror.'"}';
		echo $json_str;
?>