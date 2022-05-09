<?php require'../../AHeader.php'; ?>
<?php
$my_flag = $_POST['my_flag'];


//添加保存
if($my_flag == "save_add"){
	$str_accept = $_POST['str_send'];
	$arr_acc = explode(",", $str_accept);
	$return = '';
	require("../../conn.php");
	$sql = "INSERT INTO 银行账户(时间戳,开户银行,户名,银行账号,创建人id) VALUES('".time()."','".$arr_acc[0]."','".$arr_acc[1]."','".$arr_acc[2]."','".$userid."')";
	echo $sql;
	$result = $conn->query($sql);
	if($result){
		$return['result'] = "success";
	}else{
		$return['result'] = "defeated";
	}
	$json = json_encode($return);
	echo $json;
	
	$conn->close();
}

//删除更新
if($my_flag == "del_handle"){
	$id_acc = $_POST['id_send'];
	$num = $_POST['num'];
	require("../../conn.php");
	if($num != 1){
		$id_arr = explode(",", $id_acc);
		for($i=0;$i<count($id_arr);$i++){
			$sql = "update 银行账户  set 状态=1  WHERE id='".$id_arr[$i]."'";
			$result = $conn->query($sql);
		}
		if($result){
			$return['result'] = "success";
		}else{
			$return['result'] = "defeated";
		}
		$json = json_encode($return);
		echo $json;
	}else{
		$sql = "update 银行账户  set 状态=1 WHERE id='".$id_acc."'";
		$result = $conn->query($sql);
		if($result){
			$return['result'] = "success";
		}else{
			$return['result'] = "defeated";
		}
		$json = json_encode($return);
		echo $json;
	}

	$conn->close();
}

//修改更新
if($my_flag == "save_alter"){
	$str_acc = $_POST['str_send'];
	$arr_acc = explode(",", $str_acc);
	
	require("../../conn.php");
	$sql = "UPDATE 银行账户  SET 开户银行='".$arr_acc[1]."',户名='".$arr_acc[2]."',银行账号='".$arr_acc[3]."'  WHERE id='".$arr_acc[0]."'";
	$result = $conn->query($sql);
	if($result){
		$return['result'] = "success";
	}else{
		$return['result'] = "defeated";
	}
	$json = json_encode($return);
	echo $json;
	
	$conn->close();
}
?>