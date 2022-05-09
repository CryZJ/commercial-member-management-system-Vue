<?php
require'../../AHeader.php'; 
require("../../conn.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");

/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}

$my_flag = $_REQUEST["my_flag"];


if($my_flag == "management"){
	$serror = "";
	$tmp_data = "";
	
	$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$earn_record." ORDER BY id DESC";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","客户名称":"<a name=\''.$row[0].'\' onclick=\'checksr(this.name)\' >'.$row[1].'</a>","项目内容":"'.$row[2].'","总收费":"'.$row[3].'","规费":"'.$row[4].'","管理费":"'.$row[5].'","税费":"'.$row[6].'","收费方式":"'.$row[7].'","收费日期":"'.$row[8].'","案源人":"'.$row[9].'","操作":"<button class=\'delete_sr\' name=\''.$row[0].'\'>删除</button>"}';
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

if($my_flag == "allexpenditure"){
	$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM ".$expend_record."  ORDER BY id DESC";
	$result = $conn->query($sql);
	$serror = "";
	$tmp_data = "";
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","支出项目":"<a name=\''.$row[0].'\' onclick=\'checkzc(this.name)\' >'.$row[1].'</a>","金额":"'.$row[2].'","支出日期":"'.$row[3].'","收款人":"'.$row[4].'","付款人":"'.$row[5].'","操作":"<button class=\'delete_zc\' name=\''.$row[0].'\' >删除</button>"}';			
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据1！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

if($my_flag == "allowe"){
	$serror = "";
	$tmp_data = "";
	
	$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." ORDER BY id DESC";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","客户名称":"<a name=\''.$row[0].'\' onclick=\'checkqf(this.name)\' >'.$row[1].'</a>","项目内容":"'.$row[2].'","总收费":"'.$row[3].'","规费":"'.$row[4].'","管理费":"'.$row[5].'","税费":"'.$row[6].'","收费方式":"'.$row[7].'","收费日期":"'.$row[8].'","案源人":"'.$row[9].'","操作":"<button class=\'delete_sr\' name=\''.$row[0].'\'>删除</button>"}';
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;	
}

if($my_flag == "monthincome"){
	$serror = "";
	$tmp_data = "";
	$ny = date("Ym");
//	$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 收入记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
	$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$earn_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","客户名称":"'.$row[1].'","项目内容":"'.$row[2].'","总收费":"'.$row[3].'","规费":"'.$row[4].'","管理费":"'.$row[5].'","税费":"'.$row[6].'","收费方式":"'.$row[7].'","收费日期":"'.$row[8].'","案源人":"'.$row[9].'","操作":"<button class=\'delete_sr\' name=\''.$row[0].'\'>删除</button>"}';
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

if($my_flag == "monthexpenditure"){
	$serror = "";
	$tmp_data = "";
	$ny = date("Ym");
//	$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM 支出记录 WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
	$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM ".$expend_record." WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","支出项目":"<a name=\''.$row[0].'\' onclick=\'checkzc(this.name)\' >'.$row[1].'</a>","金额":"'.$row[2].'","支出日期":"'.$row[3].'","收款人":"'.$row[4].'","付款人":"'.$row[5].'","操作":"<button class=\'delete_zc\' name=\''.$row[0].'\' >删除</button>"}';			
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}

if($my_flag == "monthowe"){
	$serror = "";
	$tmp_data = "";
	$ny = date("Ym");
//	$sql = "SELECT id,客户名称,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 欠费记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
	$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_row()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' name=\''.$row[0].'\' />","客户名称":"'.$row[1].'","项目内容":"'.$row[2].'","总收费":"'.$row[3].'","规费":"'.$row[4].'","管理费":"'.$row[5].'","税费":"'.$row[6].'","收费方式":"'.$row[7].'","收费日期":"'.$row[8].'","案源人":"'.$row[9].'","操作":"<button class=\'delete_sr\' name=\''.$row[0].'\'>删除</button>"}';
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据！";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;	
}



$conn->close();
?>