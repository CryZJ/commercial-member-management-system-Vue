<?php
require("../../AHeader.php");
$flag = $_REQUEST['flag'];

//检测申请人是否存在
if($flag == "check_per"){
	$name = $_POST['name'];
	$zjh = $_POST['zjh'];
	$ret = "";
	$ret['msg'] = "";
	$ret['flag'] = "";
	require('../../conn.php');
	$sql = "SELECT 申请人,证件号 FROM 申请人 WHERE 申请人='".$name."' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret['msg'] .= "申请人的‘名称’已存在\n";
		$ret['flag'] .=  "1";
	}else{
		$ret['msg'] .= "申请人的‘名称’不存在\n";
		$ret['flag'] .=  "0";
	}
	$sql = "SELECT 申请人,证件号 FROM 申请人 WHERE 证件号='".$zjh."' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret['msg'] .= "申请人的‘证件号’已存在\n";
		$ret['flag'] .=  "1"; 
	}else{
		$ret['msg'] .= "申请人的‘证件号’不存在\n";
		$ret['flag'] .=  "0";
	}
	$json = json_encode($ret);
	echo $json;
	$conn->close();
}


if($flag == "savedata"){
	//保存数据
	require('../../conn.php');
	$sqr = $_POST['sqr'];
	$fmr = $_POST['fmr'];
	$lxr = $_POST['lxr'];
	$bz = $_POST['bz'];
	$conid = $_POST['conid'];
	$ades = $_POST['ades'];
	$adesE = $_POST['adesE'];
	$ajSt = $_POST['ajSt'];//申请人类型
	
//	$sql8="UPDATE `申请人文件` set `上传人` ='111' WHERE 申请人id='{$conid}'";
//	mysqli_query($conn,$sql8);
//	echo '1';
	
	
//		echo $sqr."\n".$fmr;
	$sqr = explode("/", $sqr);//explode()转化为数组
	$arr_fmr = explode(",",$fmr);
	$arr_lxr = explode(",",$lxr);
	$str_add = explode('/',$ades);
	
	$num_fmr = count($arr_fmr); //计算数组长度
	$num_lxr = count($arr_lxr);
	//$first_str = explode("/", $firs;t_str);
	//in_array判断数组中是否有空值
	$ret = "";
	if($sqr[0]!=""){
		//先保存客户
		
		$sqrid = '';
		$sql = "insert into 申请人(英文名,国籍,申请人,证件号,邮政编码,费减备案,备注,记录所属,费减比例,地址,地址E,申请人类型) values(";
		$sql .= "'".$sqr[1]."','".$sqr[3]."','".$sqr[0]."','".$sqr[2]."','".$sqr[4]."','".$sqr[5]."','".$bz."','".$conid."','".$sqr[6]."','".$str_add[0]."','".$adesE."','".$ajSt."' )";
		$result = $conn->query($sql);
		if($result==1){
			$sql2 = "select id from 申请人 where 申请人='$sqr[0]' and 证件号='$sqr[2]'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows>0){
				while($row2 = $result2->fetch_assoc()){
					$sqrid = $row2['id'];
				}
			}
			$ret['sqrid'] = $sqrid;
		}else{
			$ret['result'] = "0";
			$json = json_encode($ret);
			echo $json;
//			echo "0";//判断是否保存成功的条件
			$conn->close();
			$ret['result'] = "操作失败，";
			$json = json_encode($ret);
			echo $json;
//			echo "操作失败，";
			exit;
		}
		//保存申请人地址
		$numadd = count($str_add);
		$date = date('Y-m-d');
		if($numadd>1){
			for($xx = 1;$xx<$numadd;$xx++){
				$sqlx = "insert into 申请人地址(申请人id,地址,新建日期,操作员) values('".$sqrid."','".$str_add[$xx]."','".$date."','".$conid."')";
				$resultx = $conn->query($sqlx);
			}
		}
		
		//保存发明设计人，需申请人id
		for($i=0;$i<$num_fmr;$i++){
			if($arr_fmr["$i"]!=null){
				$fmr = explode("/",$arr_fmr["$i"]);
				$sql3 = "insert into 发明设计人(申请人id,姓名,证件号) values(";
				$sql3 .= "'$sqrid','$fmr[0]','$fmr[1]')";
				$result3 = $conn->query($sql3);
			}
		}
		
		//保存联系人
		for($i=0;$i<$num_lxr;$i++){
			if($arr_lxr["$i"]!=null){
				$lxr = explode("/",$arr_lxr["$i"]);
				$sql4 = "insert into 联系人(申请人id,姓名,手机,固话,邮箱,地址,传真) values(";
				$sql4 .= "'$sqrid','$lxr[0]','$lxr[1]','$lxr[2]','$lxr[3]','$lxr[4]','$lxr[5]')";
				$result4 = $conn->query($sql4);
			}
		}

		if($result3){
			$ret['sqrid'] = $sqrid;
			$ret['result'] = "1";
			$json = json_encode($ret);
			echo $json;
		}
		$conn->close();
		//echo $sql."\n".$sql2;
	}else{
		$ret['result'] = $sqlx;
		$json = json_encode($ret);
		echo $json;
//		echo $sqlx;//判断是否保存成功的条件
	}
}else if($flag == "uploadfile"){
	$des_str = $_POST['des'];
	$sqrid = $_POST['sqrid'];
//	echo $des."???".$sqrid;
//	echo "\n<br/>";
//	print_r($_FILES);
	$ret = '';
	$des = "";
	if(strpos($des_str, ",")){
		$des = explode(",", $des_str);
	}else{
		$des[0] = $des_str;
	}
	
	$i = 0;
	foreach($_FILES as $ky =>$fileinfo){
		require_once "../../upload_func.php";
		$uppath = "../../client_file"."/".$sqrid;
		$ret_path = client_upload($fileinfo,$uppath);
		$file_arr = explode("/", $ret_path);
		$ret_path = "client_file"."/".$sqrid."/".$file_arr[count($file_arr)-1];
		require('../../conn.php');
		$sql = "INSERT INTO 申请人文件(申请人id,文件路径,描述,上传时间,上传人)  VALUES('".$sqrid."','".$ret_path."','".$des[$i]."','".date("Y-m-d H:i:s")."','".$user."')";
		if($conn->query($sql)){
			$ret .=  $file_arr[count($file_arr)-1]."文件保存成功\n";
		}else{
			$ret .=  $file_arr[count($file_arr)-1]."文件保存失败\n";
		}
		$i++;
	}
	
//	for($i=0;$i<count($des);$i++){
//		require_once "../../upload_func.php";
//		$uppath = "../../client_file"."/".$sqrid;
//		$ret_path = client_upload($_FILES[$i],$uppath);
//		$file_arr = explode("/", $ret_path);
//		$ret_path = "client_file"."/".$sqrid."/".$file_arr[count($file_arr)-1];
//		require('../../conn.php');
//		$sql = "INSERT INTO 申请人文件(申请人id,文件路径,描述,上传时间)  VALUES('".$sqrid."','".$ret_path."','".$des[$i]."','".date("Y-m-d H:i:s")."')";
//		if($conn->query($sql)){
//			$ret .=  $file_arr[count($file_arr)-1]."文件保存成功\n";
//		}else{
//			$ret .=  $file_arr[count($file_arr)-1]."文件保存失败\n";
//		}
//	}
	echo $ret;
	
}
if($flag=='del_client'){
	require('../../conn.php');
	$id = $_POST["id"];
	$ret = "";
	$sql5 = "UPDATE 申请人 SET 删除状态=1 where id ='".$id."'";
	if ($conn->query($sql5)){
		$ret.= "删除成功";
	}else{
		$ret.= "删除失败";
	}
	echo $ret;
	$conn->close();
	
}
if($flag=='del_client1'){
	require('../../conn.php');
	$id = $_POST["id"];
	$ret = "";
	$sql5 = "delete from 申请人   where id ='".$id."'";
	if ($conn->query($sql5)){
		$ret.= "删除成功";
	}else{
		$ret.= "删除失败";
	}
	echo $ret;
	$conn->close();
	
}
if($flag=='person_info'){
	$msg = $_POST['msg'];
	$sqrid = $_POST['sqrid'];
	$ret="";
	require('../../conn.php');
	require_once "../../upload_func.php";
	$uppath = "../../client_file"."/".$sqrid;
	$ret_path = client_upload($_FILES["upfile"],$uppath);
	$file_arr = explode("/", $ret_path);
	$ret_path = "client_file"."/".$sqrid."/".$file_arr[count($file_arr)-1];
	$sql = "UPDATE 申请人 SET ".$msg."='".$ret_path."' WHERE id='".$sqrid."'";
	if($conn->query($sql)){
		$ret .=  $file_arr[count($file_arr)-1]."文件保存成功\n";
	}else{
		$ret .=  $file_arr[count($file_arr)-1]."文件保存失败\n";
	}
	echo $ret;
	
	$conn->close();
}			
	
if($flag == "reply_client"){
	require('../../conn.php');
	
	$id = $_POST["id"];
	$ret_msg = "";
	
	$sql = "SELECT 证件号 FROM 申请人 WHERE id='".$id."'";
	$result = $conn->query($sql);
	$zjh = "";
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$zjh = $row['证件号'];
		}
	}
	//判断“证件号”相同的申请人是否存在
	$sql = "SELECT id FROM 申请人 WHERE 证件号='".$zjh."' AND 删除状态='0'";
	$result = $conn->query($sql);
	if($result->num_rows>0){//存在，不能恢复该记录
		$ret_msg = "该申请人已存在,不用恢复";
	}else{//不存在，可以恢复该记录
		$sql = "UPDATE 申请人 SET 删除状态='0' WHERE id='".$id."'";
		if($conn->query($sql)){
			$ret_msg = "恢复成功！";
		}else{
			$ret_msg = "恢复失败！";
		}
	}
	echo $ret_msg;
	$conn->close();
}	
//保存申请人类型
if($flag == "change"){
	require('../../conn.php');
	
	$order = $_GET['order'];
	$ssid = $_GET['ssid'];
	$sql = "update `申请人` set 申请人类型 = '".$order."' WHERE id = '".$ssid."'";
	$result = $conn->query($sql);
	if($result){
		echo '申请人类型修改成功';
	}else{
		echo '申请人类型修改失败';
	}
	
	$conn->close();
}

//查找案源人的用户id
if($flag == "GET_ayr_userid"){
	require('../../conn.php');
	$ret_data = "";
	$ayrid = $_GET["ayrid"];
	$sql = "SELECT sonid FROM 案源人信息 WHERE id='".$ayrid."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$ret_data = $row["sonid"];
		}
	}
	echo $ret_data;
	$conn->close();
}	
	
?>	

