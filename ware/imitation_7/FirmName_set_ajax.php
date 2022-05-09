<?php
require("../../AHeader.php");
require("../../conn.php");

$flag = $_REQUEST["flag"];

switch($flag){
	case "GetTableData"://获取【公司管理】的信息
		$sql = "SELECT id,公司,财务管理人员id FROM 公司管理 WHERE 删除状态='0'";
		$result = $conn->query($sql);
		$ret_msg = array();
		$ret_msg["result"] = "success";
		$row_num = 0;
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ret_msg[$row_num]["firm"] = $row['公司'];
				$ret_msg[$row_num]["id"] = $row['id'];
				$sql_id = "SELECT 名称 FROM 用户 WHERE FIND_IN_SET(id,'".$row['财务管理人员id']."')";
				$result_id = $conn->query($sql_id);
				$tmp_name_str = "";
				if($result_id->num_rows>0){
					while($row_id = $result_id->fetch_assoc()){
						$tmp_name_str .= ",".$row_id['名称'];
					}
				}
				if(!empty($tmp_name_str)){
					$tmp_name_str = substr($tmp_name_str, 1);
				}
				$ret_msg[$row_num]["user_name"] = $tmp_name_str;
				$row_num++;
			}
		}else{
			$ret_msg["result"] = "failure";
		}
		$ret_msg["row_num"] = $row_num;
		$json = json_encode($ret_msg);
		echo $json;
		break;
	case "GetSelect_user" ://获取【用户】的信息
		$sql = "SELECT id,名称 FROM 用户 WHERE 账号<>'admin' AND 状态=0";
		$result = $conn->query($sql);
		$ret_msg = array();
		$row_num = 0;
		$ret_msg["result"] = "success";
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$ret_msg[$row_num]["id"] = $row["id"];
				$ret_msg[$row_num]["us_name"] = $row["名称"];
				$row_num++;
			}
		}else{
			$ret_msg["result"] = "failure";
		}
		$ret_msg["row_num"] = $row_num;
		$json = json_encode($ret_msg);
		echo $json;
		break;
	case "Save_first"://第一次录入数据的保存
		$firm = str_replace(' ','',$_GET['firmname']);
		$usid_str = str_replace(' ','',$_GET['usid']);
		$sql = "INSERT INTO 公司管理(公司,财务管理人员id,创建时间,修改时间) VALUES(";
		$sql .= "'".$firm."','".$usid_str."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
		if($conn->query($sql)){
			$new_id = $conn->insert_id;
//			echo "保存成功";
			//创建公司的所有相关的表，视图
			$sql_1 = "CREATE TABLE `收入记录_".$new_id."` (`id` int(255) NOT NULL AUTO_INCREMENT,`时间戳` varchar(20) DEFAULT NULL,`客户名称` varchar(255) DEFAULT NULL,`项目内容` varchar(255) DEFAULT NULL,`总收费` float(255,2) DEFAULT '0.00',`规费` float(255,2) DEFAULT '0.00',`管理费` float(255,2) DEFAULT '0.00',`税费` float(255,2) DEFAULT '0.00',`收费方式` varchar(50) DEFAULT NULL,`收费日期` date DEFAULT NULL,`案源人` varchar(255) DEFAULT NULL,`代理人` varchar(255) DEFAULT NULL,`备注` varchar(255) DEFAULT NULL,`年月` varchar(255) DEFAULT NULL COMMENT '方便每月统计',PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;";
			$sql_2 = "CREATE TABLE `收入记录文件_".$new_id."` (`id` int(255) unsigned NOT NULL AUTO_INCREMENT,`收入id` int(255) unsigned DEFAULT NULL COMMENT '收入记录的id',`文件路径` varchar(255) DEFAULT NULL,`删除状态` int(10) unsigned DEFAULT '0' COMMENT '0：正常，1：已删除',`上传时间` datetime DEFAULT NULL,`上传人` varchar(255) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;";
			$sql_3 = "CREATE TABLE `支出记录_".$new_id."` (`id` int(255) NOT NULL AUTO_INCREMENT,`时间戳` varchar(20) DEFAULT NULL,`支出项目` varchar(100) DEFAULT NULL,`金额` float(255,2) DEFAULT '0.00',`支付方式` varchar(255) DEFAULT NULL,`支出日期` date DEFAULT NULL,`备注` varchar(255) DEFAULT NULL,`年月` varchar(255) DEFAULT NULL,`文件路径` varchar(255) DEFAULT NULL,`收款人` varchar(255) DEFAULT NULL,`付款人` varchar(255) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;";
			$sql_4 = "CREATE TABLE `支出记录文件_".$new_id."` (`id` int(255) unsigned NOT NULL AUTO_INCREMENT,`支出id` int(255) unsigned DEFAULT NULL COMMENT '支出记录的id',`文件路径` varchar(255) DEFAULT NULL,`删除状态` int(10) unsigned DEFAULT '0' COMMENT '0：正常，1：已删除',`上传时间` datetime DEFAULT NULL,`上传人` varchar(255) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;";
			$sql_5 = "CREATE TABLE `欠费记录_".$new_id."` (`id` int(255) NOT NULL AUTO_INCREMENT,`时间戳` varchar(20) DEFAULT NULL,`客户名称` varchar(255) DEFAULT NULL,`项目内容` varchar(255) DEFAULT NULL,`总收费` float(255,2) DEFAULT '0.00',`规费` float(255,2) DEFAULT '0.00',`管理费` float(255,2) DEFAULT '0.00',`税费` float(255,2) DEFAULT '0.00',`收费方式` varchar(50) DEFAULT NULL,`收费日期` date DEFAULT NULL,`案源人` varchar(255) DEFAULT NULL,`代理人` varchar(255) DEFAULT NULL,`备注` varchar(255) DEFAULT NULL,`年月` varchar(255) DEFAULT NULL COMMENT '方便每月统计',PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='与表【收入记录】一样';";
			$sql_6 = "CREATE TABLE `财务月统计_".$new_id."` (`id` int(255) NOT NULL AUTO_INCREMENT,`年月` varchar(255) DEFAULT NULL,`总收费` float(255,2) DEFAULT '0.00',`规费` float(255,2) DEFAULT '0.00',`管理费` float(255,2) DEFAULT '0.00',`税费` float(255,2) DEFAULT '0.00',`支出金额` float(255,2) DEFAULT '0.00',`本月利润` float(255,2) DEFAULT '0.00',`期初结转` float(255,2) DEFAULT '0.00',`本月结存` float(255,2) DEFAULT '0.00',`本月欠费` float(255,2) DEFAULT '0.00', PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;";
			
			$sql_7 = "CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `收入统计首月_".$new_id."` AS select `收入记录_".$new_id."`.`年月` AS `年月`,sum(`收入记录_".$new_id."`.`总收费`) AS `总收费`,sum(`收入记录_".$new_id."`.`规费`) AS `规费`,sum(`收入记录_".$new_id."`.`管理费`) AS `管理费`,sum(`收入记录_".$new_id."`.`税费`) AS `税费` from `收入记录_".$new_id."` group by `收入记录_".$new_id."`.`年月` order by `收入记录_".$new_id."`.`年月` limit ".$new_id."";
			$sql_8 = "CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `支出统计首月_".$new_id."` AS select `支出记录_".$new_id."`.`年月` AS `年月`,sum(`支出记录_".$new_id."`.`金额`) AS `支出金额` from `支出记录_".$new_id."` group by `支出记录_".$new_id."`.`年月` order by `支出记录_".$new_id."`.`年月` limit 1";
			if($conn->query($sql_1)){
				if($conn->query($sql_2)){
					if($conn->query($sql_3)){
						if($conn->query($sql_4)){
							if($conn->query($sql_5)){
								if($conn->query($sql_6)){
									if($conn->query($sql_7)){
										if($conn->query($sql_8)){
											echo "保存成功";
										}
									}
								}
							}
						}
					}
				}
			}
		}else{
			echo "保存数据失败";
		}
		break;
	case "GetData_Alter"://查看没个公司的获取函数
		$self_id = $_GET['self_id'];
		$ret_msg = array();
		$ret_msg["result"] = "success";
		$row_num = 0;
		$sql = "SELECT id,公司,财务管理人员id FROM 公司管理 WHERE id='".$self_id."'";
		$result = $conn->query($sql);
		if($result->num_rows){
			while($row = $result->fetch_assoc()){
				$ret_msg[$row_num]["id"] = $row["id"];
				$ret_msg[$row_num]["firm"] = $row["公司"];
				$ret_msg[$row_num]["usid_str"] = $row["财务管理人员id"];
				$row_num++;
			}
		}else{
			$ret_msg["result"] = "failure";
		}
		$ret_msg["row_num"] = $row_num;
		$json = json_encode($ret_msg);
		echo $json;
		break;
	case "Save_alter":
		$self_id = str_replace(' ','',$_GET['self_id']);
		$firm = str_replace(' ','',$_GET['firmname']);
		$usid_str = str_replace(' ','',$_GET['usid']);
		$sql = "UPDATE 公司管理 SET 公司='".$firm."',财务管理人员id='".$usid_str."',修改时间='".date("Y-m-d H:i:s")."' WHERE id='".$self_id."'";
		if($conn->query($sql)){
			echo "保存成功";
		}else{
			echo "保存失败";
		}
		break;
	default:
		echo "flag非法！";
}

$conn->close();
											
?>