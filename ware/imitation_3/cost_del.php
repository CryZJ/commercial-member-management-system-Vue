<?php
require'../../AHeader.php'; 
require'../../conn.php';

//验证身份是否是“流程操作员”
if(!$lcczy == "1"){
	echo "您没有权限操作";
	exit();
}

	$flag = $_REQUEST['flag'];
	
	//单个删除
	if($flag == 'costzl'){
		$id = $_POST['id'];
		
		$sql = "UPDATE 专案需交费用 SET 状态='9' WHERE id='".$id."'";
		$result = $conn->query($sql);
		return 0;
	}
	
	//修改费用保存
	if($flag == "cost_alter"){
		$id = $_POST['id'];
		$fee = $_POST['fee'];
		$sql = "UPDATE 专案需交费用 SET 金额='".$fee."'  WHERE id='".$id."'";
		if($conn->query($sql)){
			echo "保存成功";
		}else{
			echo "保存失败";
		}
	}
	
	//删除选中行
	if($flag == "delete_djf"){
		$str_id = $_GET['str_id'];
		$arr_id = "";
		if(strpos($str_id, ",")){
			$arr_id = explode(",", $str_id);
		}else{
			$arr_id[0] = $str_id;
		}
		foreach($arr_id as $ky =>$id){
			$sql = "update 专案需交费用 set 状态=9 where id='".$id."'";
			$result = $conn->query($sql);
		}
		echo "删除完成";
	}
	
$conn->close();
?>