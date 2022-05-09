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
//	$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注  FROM 收入记录  WHERE id='".$myid."'";
	$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注  FROM ".$earn_record."  WHERE id='".$myid."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$retdata["info"][0] = $row['客户名称'];
			$retdata["info"][1] = $row['项目内容'];
			$retdata["info"][2] = $row['总收费'];
			$retdata["info"][3] = $row['规费'];
			$retdata["info"][4] = $row['管理费'];
			$retdata["info"][5] = $row['税费'];
			$retdata["info"][6] = $row['收费方式'];
			$retdata["info"][7] = $row['收费日期'];
			$retdata["info"][8] = $row['案源人'];
			$retdata["info"][9] = $row['代理人'];
			$retdata["info"][10] = $row['备注'];
		}
		$sql2 = "SELECT id,文件路径 FROM ".$earn_file_record." WHERE 收入id='".$myid."' AND 删除状态=0";
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

//删除文件
if($my_flag == "DeleteFile"){
	$file_id = $_GET['file_id'];
	
	$ret_msg = "";
	
//	$sql = "UPDATE 收入记录文件 SET 删除状态=1,上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id='".$file_id."'";
	$sql = "UPDATE ".$earn_file_record." SET 删除状态=1,上传时间='".date("Y-m-d H:i:s")."',上传人='".$name."' WHERE id='".$file_id."'";
	if($conn->query($sql)){
		$ret_msg .= "删除记录成功";
		if($admin){
//			$sql_s = "SELECT 文件路径 FROM 收入记录文件 WHERE id = '".$file_id."'";
			$sql_s = "SELECT 文件路径 FROM ".$earn_file_record." WHERE id = '".$file_id."'";			
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

//收入记录保存
if($my_flag == "save_pay"){
	$myid = $_POST['myid'];
	$arr_send = $_POST['arr_send'];
//	print_r($arr_send);
	$ymd = explode("-", $arr_send[7]);
	$ym = $ymd[0].$ymd[1];
	
//	$sql = "UPDATE 收入记录   SET 客户名称='".$arr_send[0]."',项目内容='".$arr_send[1]."',总收费='".$arr_send[2]."',规费='".$arr_send[3]."',管理费='".$arr_send[4]."',税费='".$arr_send[5]."',收费方式='".$arr_send[6]."',收费日期='".$arr_send[7]."'";
	$sql = "UPDATE ".$earn_record."   SET 客户名称='".$arr_send[0]."',项目内容='".$arr_send[1]."',总收费='".$arr_send[2]."',规费='".$arr_send[3]."',管理费='".$arr_send[4]."',税费='".$arr_send[5]."',收费方式='".$arr_send[6]."',收费日期='".$arr_send[7]."'";
	$sql .= ",案源人='".$arr_send[8]."',代理人='".$arr_send[9]."',备注='".$arr_send[10]."',年月='".$ym."' WHERE id='".$myid."'";
//	echo $sql;
	
	if($conn->query($sql)){
		echo "修改成功";
	}else{
		echo "修改失败";
	}
}

$conn->close();
?>