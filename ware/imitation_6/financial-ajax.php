<?php
require("../../AHeader.php");
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");
require("../../conn.php");

require_once "../../classes/CostMonthStatistics.php";

$my_flag = isset($_POST['my_flag']) ? $_POST['my_flag']: "";



//删除统计记录19.7
if($admin="1" && $flag = "del_tj1"){
	$x = $_POST['x'];
	$sql = "DELETE FROM $finance_month_record WHERE 年月 = '".$x."'";
	$result=$conn->query($sql);
}
//收入记录保存
if($my_flag == "save_pay"){
	$arr_send = $_POST['arr_send'];
	$arr_send = explode(",", $arr_send);
//	print_r($arr_send);
	$ymd = explode("-", $arr_send[7]);
	$ym = $ymd[0].$ymd[1];
	$ret_mag = "";
//	$sql = "INSERT INTO 收入记录(时间戳,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注,年月) VALUES(";
	$sql = "INSERT INTO ".$earn_record."(时间戳,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注,年月) VALUES(";
	$sql .= "'".time()."','".$arr_send[0]."','".$arr_send[1]."','".$arr_send[2]."','".$arr_send[3]."','".$arr_send[4]."','".$arr_send[5]."','".$arr_send[6]."','".$arr_send[7]."','".$arr_send[8]."','".$arr_send[9]."','".$arr_send[10]."','".$ym."')";
//	echo $sql;
	if($conn->query($sql)){
		$new_id = $conn->insert_id;
		$ret_mag .= "信息保存成功！\n";
		require_once "../../upload_func.php";//连接下载函数文件
		$path_sql = "";
		if(count($_FILES)){
			$dir = "../../filesave_srjl/".$new_id;
			foreach($_FILES as $ky => $fileinfo){
				$ret_path = File_share($fileinfo,$dir);
				$path_sql = substr($ret_path, 6);
//				$sql = "INSERT INTO 收入记录文件(收入id,文件路径,上传时间,上传人) VALUES('".$new_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				$sql = "INSERT INTO ".$earn_file_record."(收入id,文件路径,上传时间,上传人) VALUES('".$new_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret_mag .= pathinfo($path_sql,PATHINFO_BASENAME)."保存成功！\n";
				}else{
					$ret_mag .= pathinfo($path_sql,PATHINFO_BASENAME)."保存失败！\n";
				}
			}
		}
	}else{
		$ret_mag .= "信息保存失败！";
	}
	echo $ret_mag;
}
//欠费记录保存
if($my_flag == "SaveNew_Arrearage"){
	$arr_send = $_POST['arr_send'];
//	print_r($arr_send);
	$ymd = explode("-", $arr_send[7]);
	$ym = $ymd[0].$ymd[1];
//	$sql = "INSERT INTO 欠费记录(时间戳,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注,年月) VALUES(";
	$sql = "INSERT INTO ".$arrearage_record."(时间戳,客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人,代理人,备注,年月) VALUES(";
	$sql .= "'".time()."','".$arr_send[0]."','".$arr_send[1]."','".$arr_send[2]."','".$arr_send[3]."','".$arr_send[4]."','".$arr_send[5]."','".$arr_send[6]."','".$arr_send[7]."','".$arr_send[8]."','".$arr_send[9]."','".$arr_send[10]."','".$ym."')";
//	echo $sql;
	if($conn->query($sql)){
		echo "保存成功";
	}else{
		echo "保存失败";
	}	
}
//支出记录保存
if($my_flag == "save_pay2"){
//	$arr_send = $_POST['arr_send'];
	$str_data = $_POST['str_data'];
	$arr_send = explode("#$#", $str_data);
//	print_r($arr_send);	
	$ret_mag = "";

	$ymd = explode("-", $arr_send[3]);
	$ym = $ymd[0].$ymd[1];
//	$sql = "INSERT INTO 支出记录(时间戳,支出项目,金额,支付方式,支出日期,付款人,收款人,备注,年月) VALUES(";
	$sql = "INSERT INTO ".$expend_record."(时间戳,支出项目,金额,支付方式,支出日期,付款人,收款人,备注,年月) VALUES(";
	$sql .= "'".time()."','".$arr_send[0]."','".$arr_send[1]."','".$arr_send[2]."','".$arr_send[3]."','".$arr_send[4]."','".$arr_send[5]."','".$arr_send[6]."','".$ym."')";
//	echo $sql;
	if($conn->query($sql)){
		$new_id = $conn->insert_id;
		$ret_mag .= "信息保存成功！\n";
		require_once "../../upload_func.php";//连接下载函数文件
		$path_sql = "";
		if(count($_FILES)){
			$dir = "../../filesave_zcjl/".$new_id;
			foreach($_FILES as $ky => $fileinfo){
				$ret_path = File_share($fileinfo,$dir);
//				$path_sql = "filesave_zcjl/".pathinfo($ret_path,PATHINFO_BASENAME);
				$path_sql = substr($ret_path, 6);
//				$sql = "INSERT INTO 支出记录文件(支出id,文件路径,上传时间,上传人) VALUES('".$new_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				$sql = "INSERT INTO ".$expend_file_record."(支出id,文件路径,上传时间,上传人) VALUES('".$new_id."','".$path_sql."','".date("Y-m-d H:i:s")."','".$name."')";
				if($conn->query($sql)){
					$ret_mag .= pathinfo($path_sql,PATHINFO_BASENAME)."保存成功！\n";
				}else{
					$ret_mag .= pathinfo($path_sql,PATHINFO_BASENAME)."保存失败！\n";
				}
			}
		}
	}else{
		$ret_mag .= "信息保存失败！";
	}
	echo $ret_mag;
}

//进行统计
if($my_flag == "stat"){
	$getdata = new CostMonthStatistics($conn,$earn_record,$expend_record,$arrearage_record);
	$getdata->UsingClass();
	if(count($getdata->process_data) > 0){
		//清除异常数据
		$sql = "SELECT id,年月 FROM ".$finance_month_record;
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				if(empty($row[1]) || $row[1]=="无"){
					$sql = "DELETE FROM ".$finance_month_record." WHERE id='".$row[0]."'";
					$conn->query($sql);
				}
			}
		}
		//更新数据库数据
		foreach($getdata->process_data as $index => $datainfo){
			$sql = "SELECT id FROM ".$finance_month_record." WHERE 年月='".$datainfo["年月"]."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){//更新原有的数据
				$sql = "UPDATE ".$finance_month_record." SET 总收费='".$datainfo["总收费"]."',规费='".$datainfo["规费"]."',管理费='".$datainfo["管理费"]."',税费='".$datainfo["税费"]."',支出金额='".$datainfo["支出金额"]."',本月利润='".$datainfo["本月利润"]."',期初结转='".$datainfo["期初结转"]."',本月结存='".$datainfo["本月结存"]."',本月欠费='".$datainfo["本月欠费"]."'  WHERE 年月='".$datainfo["年月"]."'";
				$conn->query($sql);
			}else{//插入新的数据
				$sql = "INSERT INTO ".$finance_month_record."(年月,总收费,规费,管理费,税费,支出金额,本月利润,期初结转,本月结存,本月欠费) VALUES(";
				$sql .= "'".$datainfo["年月"]."','".$datainfo["总收费"]."','".$datainfo["规费"]."','".$datainfo["管理费"]."','".$datainfo["税费"]."','".$datainfo["支出金额"]."','".$datainfo["本月利润"]."','".$datainfo["期初结转"]."','".$datainfo["本月结存"]."','".$datainfo["本月欠费"]."')";
				$conn->query($sql);
			}
		}
	}
	echo "统计完毕";
//	$result7=0;
//	$result10=0;
//	//搜索第一条记录
////	$sql = "SELECT a.年月,总收费,规费,管理费,税费,支出金额,(总收费-规费-管理费-税费-支出金额) AS 本月利润  FROM  收入统计首月 a,支出统计首月 b WHERE a.年月=b.年月";
////	$sql = "SELECT a.年月,总收费,规费,管理费,税费,支出金额,(总收费-规费-管理费-支出金额) AS 本月利润  FROM  收入统计首月 a,支出统计首月 b WHERE a.年月=b.年月";
////	$sql = "SELECT a.年月,总收费,规费,管理费,税费,支出金额,(总收费-支出金额) AS 本月利润  FROM  收入统计首月 a,支出统计首月 b WHERE a.年月=b.年月";
//	$sql = "SELECT a.年月,总收费,规费,管理费,税费,支出金额,(总收费-支出金额) AS 本月利润  FROM  ".$earn_month_record." a,".$expend_month_record." b WHERE a.年月=b.年月";
//	$result = $conn->query($sql);
//	if($result->num_rows>0){
//		while($row = $result->fetch_assoc()){
//			$firstym = $row['年月'];
////			$sql2 = "SELECT 年月   FROM 财务月统计   WHERE 年月='".$row['年月']."'";
//			$sql2 = "SELECT 年月   FROM ".$finance_month_record."   WHERE 年月='".$row['年月']."'";
//			$result2 = $conn->query($sql2);
//			//检测记录是否存在
//			if($result2->num_rows>0){
////				$sql3 = "UPDATE 财务月统计 SET 总收费='".$row['总收费']."',规费='".$row['规费']."',管理费='".$row['管理费']."',税费='".$row['税费']."',支出金额='".$row['支出金额']."',本月利润='".$row['本月利润']."',本月结存='".$row['本月利润']."' WHERE 年月='".$row['年月']."'";
//				$sql3 = "UPDATE ".$finance_month_record." SET 总收费='".$row['总收费']."',规费='".$row['规费']."',管理费='".$row['管理费']."',税费='".$row['税费']."',支出金额='".$row['支出金额']."',本月利润='".$row['本月利润']."',本月结存='".$row['本月利润']."' WHERE 年月='".$row['年月']."'";
//				if($conn->query($sql3)){
//					//保存其他收入统计
////					$sql4 = "SELECT 年月,SUM(总收费) AS 总收费,SUM(规费) AS 规费,SUM(管理费) AS 管理费,SUM(税费) AS 税费  FROM 收入记录  WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$sql4 = "SELECT 年月,SUM(总收费) AS 总收费,SUM(规费) AS 规费,SUM(管理费) AS 管理费,SUM(税费) AS 税费  FROM ".$earn_record."  WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$result4 = $conn->query($sql4);
//					if($result4->num_rows>0){
//						while($row4 = $result4->fetch_assoc()){
////							$sql2 = "SELECT 年月   FROM 财务月统计   WHERE 年月='".$row4['年月']."'";
//							$sql2 = "SELECT 年月   FROM ".$finance_month_record."   WHERE 年月='".$row4['年月']."'";
//							$result2 = $conn->query($sql2);
//							//检测记录是否存在
//							if($result2->num_rows>0){
////								$sql5 = "UPDATE 财务月统计 SET 总收费='".$row4['总收费']."',规费='".$row4['规费']."',管理费='".$row4['管理费']."',税费='".$row4['税费']."' WHERE 年月='".$row4['年月']."'";
//								$sql5 = "UPDATE ".$finance_month_record." SET 总收费='".$row4['总收费']."',规费='".$row4['规费']."',管理费='".$row4['管理费']."',税费='".$row4['税费']."' WHERE 年月='".$row4['年月']."'";
//								$result5 = $conn->query($sql5);
//							}else{
////								$sql5 = "INSERT INTO 财务月统计(年月,总收费,规费,管理费,税费) VALUES(";
//								$sql5 = "INSERT INTO ".$finance_month_record."(年月,总收费,规费,管理费,税费) VALUES(";
//								$sql5 .= "'".$row4['年月']."','".$row4['总收费']."','".$row4['规费']."','".$row4['管理费']."','".$row4['税费']."')";
//								$result5 = $conn->query($sql5);
//							}
//						}
//					}
//					//保存其他支出统计
////					$sql6 = "SELECT 年月,SUM(金额) AS 支出金额  FROM 支出记录 WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$sql6 = "SELECT 年月,SUM(金额) AS 支出金额  FROM ".$expend_record." WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$result6 = $conn->query($sql6);
//					if($result6->num_rows>0){
//						while($row6 = $result6->fetch_assoc()){
////							$sql2 = "SELECT 年月   FROM 财务月统计 WHERE 年月='".$row6['年月']."'";
//							$sql2 = "SELECT 年月   FROM ".$finance_month_record."   WHERE 年月='".$row6['年月']."'";
//							$result2 = $conn->query($sql2);
//							//检测记录是否存在
//							if($result2->num_rows>0){
////								$sql7 = "UPDATE 财务月统计 SET 支出金额 ='".$row6['支出金额']."' WHERE 年月='".$row6['年月']."' ";
//								$sql7 = "UPDATE ".$finance_month_record." SET 支出金额 ='".$row6['支出金额']."' WHERE 年月='".$row6['年月']."' ";
//								$result7 = $conn->query($sql7);
//							}else{
////								$sql7 = "INSERT INTO 财务月统计(年月,支出金额) VALUES('".$row6['年月']."','".$row6['支出金额']."')";
//								$sql7 = "INSERT INTO ".$finance_month_record."(年月,支出金额) VALUES('".$row6['年月']."','".$row6['支出金额']."')";
//								$result7 = $conn->query($sql7);
//							}
//						}
//					}
//				}
//			}else{
////				$sql3 = "INSERT INTO 财务月统计(年月,总收费,规费,管理费,税费,支出金额,本月利润,本月结存) VALUES(";
//				$sql3 = "INSERT INTO ".$finance_month_record."(年月,总收费,规费,管理费,税费,支出金额,本月利润,本月结存) VALUES(";
//				$sql3 .= "'".$row['年月']."','".$row['总收费']."','".$row['规费']."','".$row['管理费']."','".$row['税费']."','".$row['支出金额']."','".$row['本月利润']."','".$row['本月利润']."')";
//				if($conn->query($sql3)){
//					//保存其他收入统计
////					$sql4 = "SELECT 年月,SUM(总收费) AS 总收费,SUM(规费) AS 规费,SUM(管理费) AS 管理费,SUM(税费) AS 税费  FROM 收入记录  WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$sql4 = "SELECT 年月,SUM(总收费) AS 总收费,SUM(规费) AS 规费,SUM(管理费) AS 管理费,SUM(税费) AS 税费  FROM ".$earn_record."  WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$result4 = $conn->query($sql4);
//					if($result4->num_rows>0){
//						while($row4 = $result4->fetch_assoc()){
////							$sql2 = "SELECT 年月   FROM 财务月统计   WHERE 年月='".$row4['年月']."'";
//							$sql2 = "SELECT 年月   FROM ".$finance_month_record."   WHERE 年月='".$row4['年月']."'";
//							$result2 = $conn->query($sql2);
//							//检测记录是否存在
//							if($result2->num_rows>0){
////								$sql5 = "UPDATE 财务月统计     SET 总收费='".$row4['总收费']."',规费='".$row4['规费']."',管理费='".$row4['管理费']."',税费='".$row4['税费']."' WHERE 年月='".$row4['年月']."'";
//								$sql5 = "UPDATE ".$finance_month_record."  SET 总收费='".$row4['总收费']."',规费='".$row4['规费']."',管理费='".$row4['管理费']."',税费='".$row4['税费']."' WHERE 年月='".$row4['年月']."'";
//								$result5 = $conn->query($sql5);
//							}else{
////								$sql5 = "INSERT INTO 财务月统计(年月,总收费,规费,管理费,税费) VALUES(";
//								$sql5 = "INSERT INTO ".$finance_month_record."(年月,总收费,规费,管理费,税费) VALUES(";
//								$sql5 .= "'".$row4['年月']."','".$row4['总收费']."','".$row4['规费']."','".$row4['管理费']."','".$row4['税费']."')";
//								$result5 = $conn->query($sql5);
//							}
//						}
//					}
//					//保存其他支出统计
////					$sql6 = "SELECT 年月,SUM(金额) AS 支出金额  FROM 支出记录 WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$sql6 = "SELECT 年月,SUM(金额) AS 支出金额  FROM ".$expend_record." WHERE 年月<>'".$row['年月']."'  GROUP BY 年月";
//					$result6 = $conn->query($sql6);
//					if($result6->num_rows>0){
//						while($row6 = $result6->fetch_assoc()){
////							$sql2 = "SELECT 年月   FROM 财务月统计   WHERE 年月='".$row6['年月']."'";
//							$sql2 = "SELECT 年月   FROM ".$finance_month_record."   WHERE 年月='".$row6['年月']."'";
//							$result2 = $conn->query($sql2);
//							//检测记录是否存在
//							if($result2->num_rows>0){
////								$sql7 = "UPDATE 财务月统计     SET 支出金额 ='".$row6['支出金额']."' WHERE 年月='".$row6['年月']."' ";
//								$sql7 = "UPDATE ".$finance_month_record."  SET 支出金额 ='".$row6['支出金额']."' WHERE 年月='".$row6['年月']."' ";
//								$result7 = $conn->query($sql7);
//							}else{
////								$sql7 = "INSERT INTO 财务月统计(年月,支出金额) VALUES('".$row6['年月']."','".$row6['支出金额']."')";
//								$sql7 = "INSERT INTO ".$finance_month_record."(年月,支出金额) VALUES('".$row6['年月']."','".$row6['支出金额']."')";
//								$result7 = $conn->query($sql7);
//							}
//						}
//					}
//				}
//			}
//		}
//	}
//	
//	if($result7){
//		//获取首月的本月结存
////		$sql8 = "SELECT 本月结存 FROM 财务月统计 WHERE 年月='".$firstym."'";
//		$sql8 = "SELECT 本月结存 FROM ".$finance_month_record." WHERE 年月='".$firstym."'";
//		$result8 = $conn->query($sql8);
//		if($result8->num_rows>0){
//			while($row8 = $result8->fetch_assoc()){
//				$mf = floatval($row8['本月结存']);
//			}
//		}
//		//进行操作
////		$sql9 = "SELECT  年月,(总收费-规费-管理费-税费-支出金额) AS 本月利润  FROM 财务月统计   WHERE 年月<>'".$firstym."' ORDER BY 年月";
////		$sql9 = "SELECT  年月,(总收费-规费-管理费-支出金额) AS 本月利润  FROM 财务月统计   WHERE 年月<>'".$firstym."' ORDER BY 年月";
//		$sql9 = "SELECT  年月,(总收费-支出金额) AS 本月利润  FROM ".$finance_month_record."   WHERE 年月<>'".$firstym."' ORDER BY 年月";
//		$result9 = $conn->query($sql9);
//		if($result9->num_rows>0){
//			while($row9 = $result9->fetch_assoc()){
//				$endmf = floatval($row9['本月利润']) + $mf;
////				$sql10 = "UPDATE 财务月统计  SET 本月利润='".$row9['本月利润']."',期初结转='".$mf."',本月结存='".$endmf."' WHERE 年月='".$row9['年月']."'";
//				$sql10 = "UPDATE ".$finance_month_record."  SET 本月利润='".$row9['本月利润']."',期初结转='".$mf."',本月结存='".$endmf."' WHERE 年月='".$row9['年月']."'";
//				$result10 = $conn->query($sql10);
//				if($result10){
//					$mf = $endmf;
//				}
//			}
//		}
//	}
//	//统计欠费记录
//	$sql = "SELECT  年月,(SUM(总收费)-SUM(规费)-SUM(管理费)-SUM(税费)) AS 月欠费 FROM ".$arrearage_record." GROUP BY 年月";
//	$result = $conn->query($sql);
//	if($result->num_rows>0){
//		while($row = $result->fetch_assoc()){
//			$sql = "UPDATE ".$finance_month_record." SET 本月欠费='".$row["月欠费"]."' WHERE 年月='".$row["年月"]."'";
//			$conn->query($sql);
//		}
//	}
//	
//	
//	if($result10){
//		echo "统计完毕";
//	}else{
//		echo "统计完毕";
//	}
}

//删除收入记录
if($my_flag == "del_sr"){
	$myid = $_POST['myid'];
	$ret_msg = "";
//	$sql = "DELETE FROM 收入记录  WHERE id='".$myid."'";
	$sql = "DELETE FROM ".$earn_record."  WHERE id='".$myid."'";
//	echo $sql;
	if($conn->query($sql)){
		$ret_msg .= "删除记录成功";
		if($admin){//如果是管理员，则彻底删掉所有的文件
//			$sql = "UPDATE 收入记录文件 SET 删除状态=1 WHERE 收入id='".$myid."'";
			$sql = "UPDATE ".$earn_file_record." SET 删除状态=1 WHERE 收入id='".$myid."'";
			if($conn->query($sql)){
//				$sql = "SELECT 文件路径 FROM 收入记录文件 WHERE 收入id='".$myid."'";
				$sql = "SELECT 文件路径 FROM ".$earn_file_record." WHERE 收入id='".$myid."'";
				$result = $conn->query($sql);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()){
						$path = $row['文件路径'];
						if($path != ""){
							$path_gbk = iconv("utf-8", "gbk", "../../".$path);
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)){
									$ret_msg .="；\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			}
		}else{
//			$sql = "UPDATE 支出记录文件 SET 删除状态=1 WHERE 收入id='".$myid."'";
			$sql = "UPDATE ".$earn_file_record." SET 删除状态=1 WHERE 收入id='".$myid."'";
			
		}
	}else{
		$ret_msg .= "删除记录失败";
	}
	echo $ret_msg;
}
//删除欠费记录
if($my_flag == "del_qf"){
	$myid = $_POST['myid'];
	
//	$sql = "DELETE FROM 欠费记录  WHERE id='".$myid."'";
	$sql = "DELETE FROM ".$arrearage_record."  WHERE id='".$myid."'";
//	echo $sql;
	if($conn->query($sql)){
		echo "删除成功";
	}else{
		echo "删除失败";
	}
}

//删除支出记录
if($my_flag == "del_zc"){
	$myid = $_POST['myid'];
	$ret_msg = "";
//	$sql = "DELETE FROM 支出记录  WHERE id='".$myid."'";
	$sql = "DELETE FROM ".$expend_record."  WHERE id='".$myid."'";
	if($conn->query($sql)){
		$ret_msg .= "删除记录成功";
		if($admin){//如果是管理员，则彻底删掉所有的文件
//			$sql = "UPDATE 支出记录文件 SET 删除状态=1 WHERE 支出id='".$myid."'";
			$sql = "UPDATE ".$expend_file_record." SET 删除状态=1 WHERE 支出id='".$myid."'";
			if($conn->query($sql)){
//				$sql = "SELECT 文件路径 FROM 支出记录文件 WHERE 支出id='".$myid."'";
				$sql = "SELECT 文件路径 FROM ".$expend_file_record." WHERE 支出id='".$myid."'";
				$result = $conn->query($sql);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()){
						$path = $row['文件路径'];
						if($path != ""){
							$path_gbk = iconv("utf-8", "gbk", "../../".$path);
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)){
									$ret_msg .="；\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			}
		}else{
//			$sql = "UPDATE 支出记录文件 SET 删除状态=1 WHERE 支出id='".$myid."'";
			$sql = "UPDATE ".$expend_file_record." SET 删除状态=1 WHERE 支出id='".$myid."'";
			$conn->query($sql);
		}
	}else{
		$ret_msg .= "删除记录失败";
	}
	echo $ret_msg;
}

//获取人员的收入记录
if($my_flag == "get_userdata"){
	$user_name = $_POST['user_name'];
	$star_value = $_POST['star_value'];
	$end_value = $_POST['end_value'];
	$kh_name = $_POST['kh_name'];
	
	$return_data = '';
	if(!empty($user_name) && empty($kh_name)){
		if(!empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
		}else if(empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 收费日期<'".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 收费日期<'".$end_value."'";
		}else if(!empty($star_value) && empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 收费日期>'".$star_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 收费日期>'".$star_value."'";
		}else{
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' ORDER BY id DESC";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' ORDER BY id DESC";
		}
		$result = $conn->query($sql);
		$i = 0;
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$return_data[$i][0] = $i+1;
				$return_data[$i][1] = $row['客户名称'];
				$return_data[$i][2] = $row['案源人'];
				$return_data[$i][3] = $row['项目内容'];
				$return_data[$i][4] = $row['总收费'];
				$return_data[$i][5] = $row['规费'];
				$return_data[$i][6] = $row['管理费'];
				$return_data[$i][7] = $row['税费'];
				$return_data[$i][8] = $row['收费方式'];
				$return_data[$i][9] = $row['收费日期'];
				$return_data[$i][10] = floatval($row['总收费'])-floatval($row['规费'])-floatval($row['管理费'])-floatval($row['税费']);
				$i++;
			}
		}
	}else if(empty($user_name) && !empty($kh_name)){
		if(!empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 客户名称='".$kh_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."    WHERE 客户名称='".$kh_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
		}else if(empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 客户名称='".$kh_name."' AND 收费日期<'".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 客户名称='".$kh_name."' AND 收费日期<'".$end_value."'";
		}else if(!empty($star_value) && empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 客户名称='".$kh_name."' AND 收费日期>'".$star_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 客户名称='".$kh_name."' AND 收费日期>'".$star_value."'";
		}else{
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 客户名称='".$kh_name."' ORDER BY id DESC";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 客户名称='".$kh_name."' ORDER BY id DESC";
		}
		$result = $conn->query($sql);
		$i = 0;
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$return_data[$i][0] = $i+1;
				$return_data[$i][1] = $row['客户名称'];
				$return_data[$i][2] = $row['案源人'];
				$return_data[$i][3] = $row['项目内容'];
				$return_data[$i][4] = $row['总收费'];
				$return_data[$i][5] = $row['规费'];
				$return_data[$i][6] = $row['管理费'];
				$return_data[$i][7] = $row['税费'];
				$return_data[$i][8] = $row['收费方式'];
				$return_data[$i][9] = $row['收费日期'];
				$return_data[$i][10] = floatval($row['总收费'])-floatval($row['规费'])-floatval($row['管理费'])-floatval($row['税费']);
				$i++;
			}
		}
	}else if(!empty($user_name) && !empty($kh_name)){
		if(!empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期    BETWEEN '".$star_value."' AND '".$end_value."'";
		}else if(empty($star_value) && !empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期<'".$end_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期<'".$end_value."'";
		}else if(!empty($star_value) && empty($end_value)){
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期>'".$star_value."'";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' AND 收费日期>'".$star_value."'";
		}else{
//			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM 收入记录   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' ORDER BY id DESC";
			$sql = "SELECT 客户名称,项目内容,总收费,规费,管理费,税费,收费方式,收费日期,案源人    FROM ".$earn_record."   WHERE 案源人='".$user_name."' AND 客户名称='".$kh_name."' ORDER BY id DESC";
		}
		$result = $conn->query($sql);
		$i = 0;
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$return_data[$i][0] = $i+1;
				$return_data[$i][1] = $row['客户名称'];
				$return_data[$i][2] = $row['案源人'];
				$return_data[$i][3] = $row['项目内容'];
				$return_data[$i][4] = $row['总收费'];
				$return_data[$i][5] = $row['规费'];
				$return_data[$i][6] = $row['管理费'];
				$return_data[$i][7] = $row['税费'];
				$return_data[$i][8] = $row['收费方式'];
				$return_data[$i][9] = $row['收费日期'];
				$return_data[$i][10] = floatval($row['总收费'])-floatval($row['规费'])-floatval($row['管理费'])-floatval($row['税费']);
				$i++;
			}
		}
	}
	if($return_data != ''){
		$json = json_encode($return_data);
		echo $json;
	}
}



$conn->close();
?>