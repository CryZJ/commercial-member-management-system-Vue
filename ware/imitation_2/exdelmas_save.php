<?php
	header("Contnet-type:text/html;charset=utf-8");
	require("../../AHeader.php");
	require'../../conn.php';
	//其中，数据库字段【方向】代表寄出还是收入，若为寄出为【0】，若为收入为【1】
	$flag=$_REQUEST['flag'];
	/*
	 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
	 * */
	function Settle_string($str){
		$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
		$str = str_replace(" ", "", $str);//去掉空格 
		$str = trim($str);//去除一个字符串两端空格
		return $str; 
	}
	/*
	 * 获取文件路径的文件名称(包含后缀)
	 * */
	function Getbasename($path){
		$path_arr = explode("/", $path);
		$file_basename = end($path_arr);
		return $file_basename;
	}
	
	
	
	if($flag == 'save_one'){
		$send_str=$_POST['send_str'];
		$conid=$_POST['conid'];
		$strs=explode('||',$send_str);
		
		if(count($_FILES)>0){
			require_once "../../upload_func.php";
			$upload_path = "../../mail_file";
			$ret_path = upload_dd($_FILES['upfile'],$upload_path);
			$ret_path = iconv("gbk", "utf-8", $ret_path);
			$didan = "1";
		}else{
			$ret_path = "";
			$didan = "0";
		}
		
		$sql="insert into 快递信息(寄件人,收件人,客户联系电话,单位名称,地址,内件品名,快递单号,收发件日期,备注,方向,登记人id,登记日期,底单地址,底单) values (";
		$sql.="'".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','0','".$conid."','".date("Y-m-d")."','".$ret_path."','".$didan."')";
		if($conn->query($sql)){
			echo "1";
		}else{
			echo "0";
		}
			
	}
	if($flag == 'save_two'){
		$send_str=$_POST['send_str'];
		$conid=$_POST['conid'];
		$strs=explode('||',$send_str);
		
		if(count($_FILES)>0){
			require_once "../../upload_func.php";
			$upload_path = "../../mail_file";
			$ret_path = upload_dd($_FILES['upfile'],$upload_path);
			$ret_path = iconv("gbk", "utf-8", $ret_path);
			$didan = "1";
		}else{
			$ret_path = "";
			$didan = "0";
		}
		
		
		$sql="insert into 快递信息(寄件人,收件人,客户联系电话,单位名称,地址,内件品名,快递单号,收发件日期,备注,方向,登记人id,登记日期,底单地址,底单) values (";
		$sql.="'".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','1','".$conid."','".date("Y-m-d")."','".$ret_path."','".$didan."')";
		if($conn->query($sql)){
			echo "1";
		}else{
			echo "0";
		}
	}
	if($flag == 'file_save'){
		$self_id = $_POST['self_id'];
//		echo $self_id."<br/>";
//		print_r($_FILES);
		require_once "../../upload_func.php";
		$upload_path = "../../mail_file";
		$ret_path = upload_dd($_FILES['myfile'],$upload_path);
		$ret_path = iconv("gbk", "utf-8", $ret_path);
//		echo $ret_path;
		$sql = "UPDATE 快递信息  SET 底单地址='".$ret_path."',底单='1' WHERE id='".$self_id."'";
		if($conn->query($sql)){
			echo '<script type="text/javascript">alert("保存成功");window.close();</script>';
		}else{
			echo '<script type="text/javascript">alert("保存失败");window.close();</script>';
		}
	}
	
	if($flag == "Getself_msg"){
		$self_id = $_GET['self_id'];
		$sql_data = "";
		$msg_result = TRUE;
		$sql = "SELECT id,寄件人,收件人,客户联系电话,单位名称,地址,内件品名,快递单号,收发件日期,备注,底单,底单地址 FROM 快递信息 WHERE id='".$self_id."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				foreach($row as $ky => $v){
					$row[$ky] = Settle_string($v);
				}
				$file_basename = Getbasename($row["底单地址"]);
					
				$sql_data .= '{"0":"'.$row["id"].'","1":"'.$row["寄件人"].'","2":"'.$row["收件人"].'","3":"'.$row["客户联系电话"].'","4":"'.$row["单位名称"].'","5":"'.$row["地址"].'","6":"'.$row["内件品名"].'","7":"'.$row["快递单号"].'"';
				$sql_data .= ',"8":"'.$row["收发件日期"].'","9":"'.$row["备注"].'","底单":"'.$row["底单"].'","底单地址":"'.$row["底单地址"].'","文件名称":"'.$file_basename.'"}';
			}
		}else{
			$msg_result = FALSE;
		}
		$json_str = '{"sqldata":'.$sql_data.',"result":"'.$msg_result.'","sql":"'.$sql.'"}';
		echo $json_str;
	}
	
	if($flag == "Chang_save"){
		$send_str=$_POST['send_str'];
		$data_arr = explode("#$#", $send_str);
		$msg_result = TRUE;
		$ret_path = "";
		if(count($_FILES)>0){
			if($data_arr[10] != ""){
				$del_path = "../../mail_file/".$data_arr[10];
				$del_path_gbk = iconv("utf-8", "gbk", $del_path);
				if(file_exists($del_path_gbk)){
					unlink($del_path_gbk);
				}
			}
			require_once "../../upload_func.php";
			$upload_path = "../../mail_file";
			$ret_path = upload_dd($_FILES['upfile'],$upload_path);
			$ret_path = iconv("gbk", "utf-8", $ret_path);
			$didan = "1";
		}else{
			$ret_path = "";
			$didan = "0";
		}
		
		if($ret_path != ""){//有底单文件上传
			$sql = "UPDATE 快递信息 SET 寄件人='".$data_arr[1]."',收件人='".$data_arr[2]."',客户联系电话='".$data_arr[3]."',单位名称='".$data_arr[4]."',地址='".$data_arr[5]."',内件品名='".$data_arr[6]."',快递单号='".$data_arr[7]."',收发件日期='".$data_arr[8]."',备注='".$data_arr[9]."',底单='1',底单地址='".$ret_path."',登记日期='".date("Y-m-d")."',登记人id='".$userid."' WHERE id='".$data_arr[0]."'";
		}else{
			$sql = "UPDATE 快递信息 SET 寄件人='".$data_arr[1]."',收件人='".$data_arr[2]."',客户联系电话='".$data_arr[3]."',单位名称='".$data_arr[4]."',地址='".$data_arr[5]."',内件品名='".$data_arr[6]."',快递单号='".$data_arr[7]."',收发件日期='".$data_arr[8]."',备注='".$data_arr[9]."',登记日期='".date("Y-m-d")."',登记人id='".$userid."' WHERE id='".$data_arr[0]."'";
		}
		if(!($conn->query($sql))){
			$msg_result = FALSE;
		}
		$json = '{"result":"'.$msg_result.'","sql":"'.$sql.'"}';
		echo $json;
	}
	
	
	
	$conn->close();
?>