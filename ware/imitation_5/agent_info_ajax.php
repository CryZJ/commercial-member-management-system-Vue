<?php
require("../../AHeader.php");
require("../../conn.php");

$flag = $_REQUEST['flag'];

	//获取
	if($flag == "Getdata_info"){
		$bh = $_GET['bh'];
		
		$ret_data = array();//返回数据
		$sql = "SELECT a.编号,a.名称,a.证件号码,b.账号,b.密码,a.入职日期,a.离职日期,a.固话,a.手机,a.QQ,a.微信,a.邮箱,a.通信地址,b.流程操作员,b.事务管理员,b.状态 FROM 代理人信息 a,用户 b WHERE a.编号=b.代理人编号 AND a.编号='".$bh."' ";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ret_data[0] = $row['编号'];
				$ret_data[1] = $row['名称'];
				$ret_data[2] = $row['证件号码'];
				$ret_data[3] = $row['账号'];
				$ret_data[4] = $row['密码'];
				if($row['入职日期'] == "0000-00-00"){
					$ret_data[5] = "";
				}else{
					$ret_data[5] = $row['入职日期'];
				}
				if($row['离职日期'] == "0000-00-00"){
					$ret_data[6] = "";
				}else{
					$ret_data[6] = $row['离职日期'];
				}
				$ret_data[7] = $row['固话'];
				$ret_data[8] = $row['手机'];
				$ret_data[9] = $row['QQ'];
				$ret_data[10] = $row['微信'];
				$ret_data[11] = $row['邮箱'];
				$ret_data[12] = $row['通信地址'];
				$ret_data['流程操作员'] = $row['流程操作员'];
				$ret_data['事务管理员'] = $row['事务管理员'];
				$ret_data['状态'] = $row['状态'];
			}
		}
		
		$yh_id = "";
		$sql = "SELECT id FROM 用户 WHERE 案源人编号='".$bh."'";//查询用户id
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$yh_id = $row['id'];
			}
		}
		$sql = "SELECT 副用户id,副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$yh_id."'";
		$result = $conn->query($sql);
		$ret_data['idstr'] = "";
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ret_data['idstr'] = $row['副用户id'];
			}
		}
		
		$json = json_encode($ret_data);
		echo $json;
	}
	
	if($flag == "Save_admin"){//管理员模块保存
		$ybh = $_GET['ybh'];
		$xbh = $_GET['xbh'];
		$lcczy_flag = $_GET['lcczy_flag'];
		$zhty_flag = $_GET['zhty_flag'];
		$swgly_flag = $_GET['swgly_flag'];
		$data_str = $_GET['data_str'];
		$id_str = $_GET['id_str'];
		$name_str = $_GET['name_str'];
		
		$data_arr = explode("#$#", $data_str);
		foreach($data_arr as $ky => $v){//清除“无”字
			if($v=="无"){
				$data_arr[$ky] = "";
			}
		}
		
		$ret_msg = "";
		//更新“人员账号绑定”
		$yh_id = "";
		$sql = "SELECT id FROM 用户 WHERE 案源人编号='".$ybh."'";//查询用户id
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$yh_id = $row['id'];
			}
		}
		$sql = "SELECT id FROM 人员账号绑定 WHERE 主用户id='".$yh_id."'";//判断记录是否存在
		$result = $conn->query($sql);
		if($result->num_rows>0){//已存在
			$sql = "UPDATE 人员账号绑定 SET 副用户id='".$id_str."',副用户名称='".$name_str."' WHERE 主用户id='".$yh_id."'";
			if($conn->query($sql)){
				$ret_msg .= "“人员账号绑定”更新成功\n";
			}
		}else{//不存在
			$sql = "INSERT INTO 人员账号绑定(主用户id,副用户id,副用户名称) VALUES('".$yh_id."','".$id_str."','".$name_str."')";
			if($conn->query($sql)){
				$ret_msg .= "“人员账号绑定”更新成功\n";
			}
		}
		
		//更新“用户”
		$sql = "UPDATE 用户 SET 案源人编号='".$xbh."',代理人编号='".$xbh."',名称='".$data_arr[0]."',账号='".$data_arr[2]."',密码='".$data_arr[3]."',流程操作员='".$lcczy_flag."',事务管理员='".$swgly_flag."',状态='".$zhty_flag."' WHERE 代理人编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“用户”更新成功\n";
		}
		
		//更新“案源人信息”
		$sql = "UPDATE 案源人信息 SET 编号='".$xbh."',名称='".$data_arr[0]."',证件号码='".$data_arr[1]."',入职日期='".$data_arr[4]."',离职日期='".$data_arr[5]."',固话='".$data_arr[6]."',手机='".$data_arr[7]."',QQ='".$data_arr[8]."',微信='".$data_arr[9]."',邮箱='".$data_arr[10]."',通信地址='".$data_arr[11]."',状态='".$zhty_flag."' WHERE 编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“案源人信息”更新成功\n";
		}
		
		//更新“代理人信息”
		$sql = "UPDATE 代理人信息 SET 编号='".$xbh."',名称='".$data_arr[0]."',证件号码='".$data_arr[1]."',入职日期='".$data_arr[4]."',离职日期='".$data_arr[5]."',固话='".$data_arr[6]."',手机='".$data_arr[7]."',QQ='".$data_arr[8]."',微信='".$data_arr[9]."',邮箱='".$data_arr[10]."',通信地址='".$data_arr[11]."',状态='".$zhty_flag."' WHERE 编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“代理人信息”更新成功\n";
		}
		echo $ret_msg;
	}

	if($flag == "Save_general"){//非管理员模块保存
		$ybh = $_GET['ybh'];
		$xbh = $_GET['xbh'];
		$data_str = $_GET['data_str'];
		
		$data_arr = explode("#$#", $data_str);
		foreach($data_arr as $ky => $v){//清除“无”字
			if($v=="无"){
				$data_arr[$ky] = "";
			}
		}
		
		$ret_msg = "";
		
		//更新“用户”
		$sql = "UPDATE 用户 SET 案源人编号='".$xbh."',代理人编号='".$xbh."',名称='".$data_arr[0]."',账号='".$data_arr[2]."',密码='".$data_arr[3]."' WHERE 代理人编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“用户”更新成功\n";
		}
		
		//更新“案源人信息”
		$sql = "UPDATE 案源人信息 SET 编号='".$xbh."',名称='".$data_arr[0]."',证件号码='".$data_arr[1]."',入职日期='".$data_arr[4]."',离职日期='".$data_arr[5]."',固话='".$data_arr[6]."',手机='".$data_arr[7]."',QQ='".$data_arr[8]."',微信='".$data_arr[9]."',邮箱='".$data_arr[10]."',通信地址='".$data_arr[11]."' WHERE 编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“案源人信息”更新成功\n";
		}
		
		//更新“代理人信息”
		$sql = "UPDATE 代理人信息 SET 编号='".$xbh."',名称='".$data_arr[0]."',证件号码='".$data_arr[1]."',入职日期='".$data_arr[4]."',离职日期='".$data_arr[5]."',固话='".$data_arr[6]."',手机='".$data_arr[7]."',QQ='".$data_arr[8]."',微信='".$data_arr[9]."',邮箱='".$data_arr[10]."',通信地址='".$data_arr[11]."' WHERE 编号='".$ybh."'";
		if($conn->query($sql)){
			$ret_msg .= "“代理人信息”更新成功\n";
		}
		echo $ret_msg;
	}


$conn->close();
?>