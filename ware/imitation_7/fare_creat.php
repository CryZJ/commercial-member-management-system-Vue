<?php
require'../../conn.php';

$flag = $_POST['flag'];

if($flag == "new"){//保存信息
	$mess = $_POST['mess'];
	$type = $_POST['ctype'];
	$useid = $_POST['useid'];
	$arrm = explode('|',$mess);
	$date = date('Y-m-d');
	
	if($type=='发明专利'){
		$ctype = '1';
	}else if($type=='实用新型'){
		$ctype = '2';
	}else if($type=='外观设计'){
		$ctype = '3';
	}else{
		echo '出现未知错误，请联系管理员【恭喜你中了彩蛋】';
		exit;
	}
	
	$sql = "insert into 费用名参看(专案类型,费用名,金额,创建日期,创建人) values ('".$ctype."','".$arrm[0]."','".$arrm[1]."','".$date."','".$useid."')";
	$result = $conn->query($sql);
	echo '操作成功';
}

if($flag == "change"){//修改信息
	$MessC = $_POST['MessC'];//金额
	$MessF = $_POST['MessF'];//费用名
	$id   = $_POST['id'];
	$useid = $_POST['useid'];
	$date = date('Y-m-d');
	
	$sql2 = "UPDATE 费用名参看 SET 创建日期='".$date."',费用名='".$MessF."',金额='".$MessC."',创建人='".$useid."' WHERE id='".$id."'";
	$result2 = $conn->query($sql2);
	if($result2==1){
		echo "数据修改成功";
	}else{
		echo "数据保存失败，请联系管理员";
	}
}

if($flag == "del"){//删除信息
	$f_id = $_POST["f_id"];
	
	$sql = "DELETE FROM 费用名参看 WHERE id='".$f_id."'";
	if($conn->query($sql)){
		echo "删除成功";
	}else{
		echo "删除失败";
	}

}

$conn->close();	
?>