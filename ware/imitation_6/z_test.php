<?php
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");

require("../../conn.php");

$flag = $_REQUEST['flag'];
//$flag = 'GetFirstData_ALL';

	if($flag == "GetFirstData"){//获取本月的收入记录的数据
		$ny = date("Ym");
//		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 收入记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$earn_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = $arr_ret["monthcount"]["本月税费"] + floatval($row['税费']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_SELECT"){//“收入记录”获取选择月份
//		$sql = "SELECT DISTINCT 年月 FROM 收入记录 ORDER BY 收费日期 DESC";
		$sql = "SELECT DISTINCT 年月 FROM ".$earn_record." ORDER BY 收费日期 DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		if($result->num_rows>0){
			$i = 0;
			$arr_ret["result"] = "success";
			while($row = $result->fetch_assoc()){
				$arr_ret[$i] = $row['年月'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_YM"){//收入记录选择年月后创建表格信息
		$ny = $_GET['Ym'];
//		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 收入记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$earn_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = $arr_ret["monthcount"]["本月税费"] + floatval($row['税费']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}

	if($flag == "GetFirstData_expense"){//加载时获取“支出记录”的信息
		$ny = date("Ym");
//		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM 支出记录 WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM ".$expend_record." WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月金额"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月金额"] = $arr_ret["monthcount"]["本月金额"] + floatval($row['金额']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['支出项目'] = $row['支出项目'];
				$arr_ret[$i]['金额'] = $row['金额'];
				$arr_ret[$i]['支出日期'] = $row['支出日期'];
				$arr_ret[$i]['收款人'] = $row['收款人'];
				$arr_ret[$i]['付款人'] = $row['付款人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_SELECT_zc"){//“支出记录”获取选择月份
//		$sql = "SELECT DISTINCT 年月 FROM 支出记录 ORDER BY 支出日期 DESC";
		$sql = "SELECT DISTINCT 年月 FROM ".$expend_record." ORDER BY 支出日期 DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		if($result->num_rows>0){
			$i = 0;
			$arr_ret["result"] = "success";
			while($row = $result->fetch_assoc()){
				$arr_ret[$i] = $row['年月'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	if($flag == "GetFirstData_YM_zc"){//根据年月查询“支出记录”
		$ny = $_GET['Ym'];
//		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM 支出记录 WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM ".$expend_record." WHERE 年月='".$ny."' ORDER BY 支出日期 DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月金额"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月金额"] = $arr_ret["monthcount"]["本月金额"] + floatval($row['金额']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['支出项目'] = $row['支出项目'];
				$arr_ret[$i]['金额'] = $row['金额'];
				$arr_ret[$i]['支出日期'] = $row['支出日期'];
				$arr_ret[$i]['收款人'] = $row['收款人'];
				$arr_ret[$i]['付款人'] = $row['付款人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_Arrearage"){//获取本月的欠费记录的数据
		$ny = date("Ym");
//		$sql = "SELECT id,客户名称,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 欠费记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = $arr_ret["monthcount"]["本月税费"] + floatval($row['税费']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "SELECT_Arrearage"){//“欠费记录”获取选择月份
//		$sql = "SELECT DISTINCT 年月 FROM 欠费记录 ORDER BY 收费日期 DESC";
		$sql = "SELECT DISTINCT 年月 FROM ".$arrearage_record." ORDER BY 收费日期 DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		if($result->num_rows>0){
			$i = 0;
			$arr_ret["result"] = "success";
			while($row = $result->fetch_assoc()){
				$arr_ret[$i] = $row['年月'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	if($flag == "GetFirstData_YM_Arrearage"){//欠费记录选择年月后创建表格信息
		$ny = $_GET['Ym'];
//		$sql = "SELECT id,客户名称,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 欠费记录 WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." WHERE 年月='".$ny."'  ORDER BY 收费日期   DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = $arr_ret["monthcount"]["本月税费"] + floatval($row['税费']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_ALL"){//获取总的收入记录的数据
		$ny = date("Ym");
//		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 收入记录 ORDER BY id DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$earn_record." ORDER BY id DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
//		$sqldata_str = "";
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = round($arr_ret["monthcount"]["本月税费"] + floatval($row['税费']),2);
//				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_expense_ALL"){//加载时获取“总支出记录”的信息
		$ny = date("Ym");
//		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM 支出记录  ORDER BY id DESC";
		$sql = "SELECT id,支出项目,金额,支出日期,收款人,付款人 FROM ".$expend_record."  ORDER BY id DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月金额"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月金额"] = $arr_ret["monthcount"]["本月金额"] + floatval($row['金额']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['支出项目'] = $row['支出项目'];
				$arr_ret[$i]['金额'] = $row['金额'];
				$arr_ret[$i]['支出日期'] = $row['支出日期'];
				$arr_ret[$i]['收款人'] = $row['收款人'];
				$arr_ret[$i]['付款人'] = $row['付款人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
	if($flag == "GetFirstData_Arrearage_ALL"){//获取本月的欠费记录的数据
		$ny = date("Ym");
//		$sql = "SELECT id,客户名称,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM 欠费记录 ORDER BY id DESC";
		$sql = "SELECT id,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人  FROM ".$arrearage_record." ORDER BY id DESC";
		$result = $conn->query($sql);
		$arr_ret = array();
		$arr_ret["monthcount"]["本月"] = $ny;
		$arr_ret["monthcount"]["本月总收费"] = 0;
		$arr_ret["monthcount"]["本月规费"] = 0;
		$arr_ret["monthcount"]["本月管理费"] = 0;
		$arr_ret["monthcount"]["本月税费"] = 0;
		if($result->num_rows>0){
			$arr_ret["result"] = "success";
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arr_ret["monthcount"]["本月总收费"] = $arr_ret["monthcount"]["本月总收费"] + floatval($row['总收费']);
				$arr_ret["monthcount"]["本月规费"] = $arr_ret["monthcount"]["本月规费"] + floatval($row['规费']);
				$arr_ret["monthcount"]["本月管理费"] = $arr_ret["monthcount"]["本月管理费"] + floatval($row['管理费']);
				$arr_ret["monthcount"]["本月税费"] = $arr_ret["monthcount"]["本月税费"] + floatval($row['税费']);
				
				$arr_ret[$i]['id'] = $row['id'];
				$arr_ret[$i]['客户名称'] = $row['客户名称'];
				$arr_ret[$i]['项目内容'] = $row['项目内容'];
				$arr_ret[$i]['总收费'] = $row['总收费'];
				$arr_ret[$i]['规费'] = $row['规费'];
				$arr_ret[$i]['管理费'] = $row['管理费'];
				$arr_ret[$i]['税费'] = $row['税费'];
				$arr_ret[$i]['收费方式'] = $row['收费方式'];
				$arr_ret[$i]['收费日期'] = $row['收费日期'];
				$arr_ret[$i]['案源人'] = $row['案源人'];
				$i++;
			}
			$arr_ret["num"] = $i;
		}else{
			$arr_ret["result"] = "failure";
		}
		$json_str = json_encode($arr_ret);
		echo $json_str;
	}
	
$conn->close();
?>