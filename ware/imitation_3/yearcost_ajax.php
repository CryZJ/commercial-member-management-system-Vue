<?php
require'../../conn.php';
//	$flag = $_POST['flag'];
	$flag = $_REQUEST['flag'];
	
	if($flag == "yearcost_del"){
		$id = $_POST['id'];
		$sql = "update 专案_年费记录 set 状态='9' where id='".$id."'";
		if($conn->query($sql)){
			echo "删除成功";
		}else{
			echo "删除失败";
		}
	}
	
	if($flag == "yearcost_alter"){
		$id = $_POST['id'];
		$fee = $_POST['fee'];
		$sql = "UPDATE 专案_年费记录 SET 金额='".$fee."'  WHERE id='".$id."'";
		if($conn->query($sql)){
			echo "保存成功";
		}else{
			echo "保存失败";
		}
	}
	
	//“待通知”的选中删除
	if($flag == "fee_dtz"){
		$str_id = $_GET['str_id'];
		$arr_id = "";
		if(strpos($str_id, ",")){
			$arr_id = explode(",", $str_id);
		}else{
			$arr_id[0] = $str_id;
		}
		$ret = "";
		foreach($arr_id as $ky =>$id){
			$sql = "update 专案_年费记录 set 状态='9' where id='".$id."'";
			if($conn->query($sql)){
				$ret = "删除成功";
			}else{
				$ret = "删除失败";
			}
		}
		echo $ret;
	}

$conn->close();
?>