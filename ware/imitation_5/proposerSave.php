<?php
	//接收aja发送过来的数据
	$kh = $_POST['kh'];
	$lxr = $_POST['lxr'];
//	echo $kh."\n".$lxr;
	//转化为数组
	$lxr = explode("/", $lxr);
	//获取客户的id
	require("../../conn.php");
	$sql = "select id from 客户 where 客户='$kh'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$khid = $row['id'];
		}
	}else{
		echo "0";//返回失败的参数
		exit;
	}
	//保存联系人
	if($khid!==''){
		//in_array判断数组是否有空
		if(in_array('', $lxr)!=1){
			$arr_length = count($lxr);
			for($i=0;$i<$arr_length;$i=$i+9){
				$sql2 = "insert into 联系人(客户id,姓名,证件号,地址,手机,固话,邮箱,QQ,微信,备注) values(";
				$sql2 .= "'$khid','".$lxr[$i]."','".$lxr[$i+1]."','".$lxr[$i+2]."','".$lxr[$i+3]."','".$lxr[$i+4]."','".$lxr[$i+5]."','".$lxr[$i+6]."','".$lxr[$i+7]."','".$lxr[$i+8]."')";
//				echo $sql2."\n";
				$result2 = $conn->query($sql2);
				if($result2!=1){
					echo "0";//返回失败的参数
					exit;
				}
			}
			if($result2==1){
				echo "1";//返回失败的参数
			}
			
			
		}else{
			echo "0";//返回失败的参数
			exit;
		}
	}else{
		echo "0";//返回失败的参数
		exit;
	}
	
	
?>