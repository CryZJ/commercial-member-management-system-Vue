<?php require'../../AHeader.php'; ?>
<?php
$my_flag = $_POST['my_flag'];


//添加保存
if($my_flag == "save_add"){
	$str_accept = $_POST['str_send'];
	$return = '';
	require("../../conn.php");
	$sql = "INSERT INTO 专利类型设置(类型,创建人id,创建时间) VALUES('".$str_accept."','".$userid."','".date('Y-m-d H:i:s')."')";
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
			$sql = "update 专利类型设置   set 状态=1  WHERE id='".$id_arr[$i]."'";
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
		$sql = "update 专利类型设置   set 状态=1    WHERE id='".$id_acc."'";
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

?>