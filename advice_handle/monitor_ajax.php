<?php
require("../Aheader.php");
require("../conn.php");
$my_flag = $_REQUEST['my_flag'];

if($my_flag == "morefile_monitor_save"){//多文件新增监控保存
	$ret_msg = array();
	$tmp_msg = "";
	$send_data = $_GET["send_data"];
	if($send_data != ""){
		$accept_data = explode(",", $send_data);
		//【检测对应案件是否存在】
		$sql = "SELECT 案卷号,申请号,案源人,代理人,案件分类 FROM (SELECT 案卷号,申请号,案源人,代理人,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$accept_data[0]."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			$sql = "INSERT INTO 专案_监控(案卷号,监控名,提醒日期,截止日期,备注,创建时间) VALUES(";
			$sql .= "'".$accept_data[0]."','".$accept_data[4]."','".$accept_data[2]."','".$accept_data[3]."','".$accept_data[5]."','".date("Y-m-d H:i:s")."')";
			if($conn->query($sql)){
				$ret_msg["result"] = TRUE;
				$tmp_msg = "数据保存成功";
			}else{
				$ret_msg["result"] = FALSE;
				$tmp_msg = "数据保存失败";
			}
		}else{
			$ret_msg["result"] = FALSE;
			$tmp_msg = "案卷号对应的案件不存在";
		}
	}else{
		$ret_msg["result"] = FALSE;
		$tmp_msg = "接收数据为空";
	}
	
	$ret_msg["msg"] = $tmp_msg;
	$json = json_encode($ret_msg);
	echo $json;
}

$conn->close();	
?>