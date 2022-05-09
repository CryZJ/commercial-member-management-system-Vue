<?php
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");


require("../../conn.php");
$my_flag = $_REQUEST['my_flag'];

if($my_flag == "getdata"){
	$myid = $_POST['myid'];
	
	$retdata = "";
//	$sql = "SELECT id,支出项目,金额,支付方式,支出日期,付款人,收款人,备注  FROM 支出记录  WHERE id='".$myid."'";
	$sql = "SELECT id,支出项目,金额,支付方式,支出日期,付款人,收款人,备注  FROM ".$expend_record."  WHERE id='".$myid."'";
	$result = $conn->query($sql);
	$retdata["info"] = "";
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$retdata["info"][0] = $row['支出项目'];
			$retdata["info"][1] = $row['金额'];
			$retdata["info"][2] = $row['支付方式'];
			$retdata["info"][3] = $row['支出日期'];
			$retdata["info"][4] = $row['付款人'];
			$retdata["info"][5] = $row['收款人'];
			$retdata["info"][6] = $row['备注'];
//			$retdata[7] = pathinfo($row['文件路径'],PATHINFO_BASENAME);
//			$retdata[8] = $row['文件路径'];
		}
//		$sql2 = "SELECT id,文件路径 FROM 支出记录文件 WHERE 支出id='".$myid."' AND 删除状态=0";
		$sql2 = "SELECT id,文件路径 FROM ".$expend_file_record." WHERE 支出id='".$myid."' AND 删除状态=0";
		$result2 = $conn->query($sql2);
		$retdata["files"] = "";
		if($result2->num_rows>0){
			$j=0;
			while($row2 = $result2->fetch_assoc()){
				$retdata["files"][$j]["id"] = $row2['id'];
				$retdata["files"][$j]["name"] = pathinfo($row2['文件路径'],PATHINFO_BASENAME);
				$retdata["files"][$j]["path"] = $row2['文件路径'];
				$j++;
			}
		}
	}
//	$retdata['sql'] = $sql;
	$json = json_encode($retdata);
	echo $json;
}
//收入记录保存
if($my_flag == "save_pay"){
	$myid = $_POST['myid'];
	$arr_send = $_POST['arr_send'];
//	print_r($arr_send);
	$ymd = explode("-", $arr_send[3]);
	$ym = $ymd[0].$ymd[1];
	
//	$sql = "UPDATE 支出记录   SET 支出项目='".$arr_send[0]."',金额='".$arr_send[1]."',支付方式='".$arr_send[2]."',支出日期='".$arr_send[3]."',付款人='".$arr_send[4]."',收款人='".$arr_send[5]."',备注='".$arr_send[6]."'";
	$sql = "UPDATE ".$expend_record."   SET 支出项目='".$arr_send[0]."',金额='".$arr_send[1]."',支付方式='".$arr_send[2]."',支出日期='".$arr_send[3]."',付款人='".$arr_send[4]."',收款人='".$arr_send[5]."',备注='".$arr_send[6]."'";
	$sql .= ",年月='".$ym."' WHERE id='".$myid."'";
//	echo $sql;
	
	if($conn->query($sql)){
		echo "修改成功";
	}else{
		echo "修改失败";
	}
		
}

//删除文件
if($my_flag == "DeleteFile"){
	$file_id = $_GET['file_id'];
	
	$ret_msg = "";
	
//	$sql = "UPDATE 支出记录文件 SET 删除状态=1,上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id='".$file_id."'";
	$sql = "UPDATE ".$expend_file_record." SET 删除状态=1,上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id='".$file_id."'";
	if($conn->query($sql)){
		$ret_msg .= "删除记录成功";
		if($admin){
//			$sql_s = "SELECT 文件路径 FROM 支出记录文件 WHERE id = '".$file_id."'";
			$sql_s = "SELECT 文件路径 FROM ".$expend_file_record." WHERE id = '".$file_id."'";
			
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows > 0){
				$former_path = "";
				while($row_s = $result_s->fetch_assoc()){
					$former_path = $row_s['文件路径'];
				}
				//删除旧的文件
				if($former_path != ""){
					$del_path = iconv("utf-8", "gbk","../../".$former_path);
					if(file_exists($del_path)){
						if(unlink($del_path)){
							$ret_msg .= ";\n".pathinfo($former_path,PATHINFO_BASENAME)."删除成功";
						}
					}
				}
			}
		}
	}else{
		$ret_msg .= "删除记录失败";
	}
	echo $ret_msg;
}


$conn->close();
?>