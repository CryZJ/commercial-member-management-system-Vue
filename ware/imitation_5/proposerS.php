<?php
//获取proposer.php传过来的数据
	$sqr_data = $_POST['sqr_data'];
	$arr_lxr = $_POST['arr_lxr'];
	//echo $sqr_data."\n".$arr_lxr;
	//转化为数组
	$arr_sqr = explode("/", $sqr_data);
	$arr_lxr = explode(",", $arr_lxr);
//	print_r($arr_sqr);//输出测试
//	echo "\n";
//	print_r($arr_lxr);
	//in_array('', $array)判断数组中是否有空
	if(in_array('',$arr_sqr)!=1 && in_array('', $arr_lxr)!=1){
		//保存申请人
		require("../../conn.php");
		$sql = "insert into 申请人(案源人,代理人,申请人,证件号,地址) values(";
		$sql .= "'".$arr_sqr[0]."','".$arr_sqr[1]."','".$arr_sqr[2]."','".$arr_sqr[3]."','".$arr_sqr[4]."')";
		//echo "\n".$sql;
		$result = $conn->query($sql);
		
		//获取保存好的申请人的id
		$sql2 = "select id from 申请人 where 申请人='".$arr_sqr[2]."' ";
		$result2 = $conn->query($sql2);
		if($result2->num_rows > 0){
			while($row = $result2->fetch_assoc()){
				$sid = "";
				$sid = $row["id"];//获取申请人id
			}
		}
		//保存联系人
		if($sid!=""){
			$arr_length = count($arr_lxr);
			//echo "\n".$arr_length;
			for($i=0;$i<($arr_length/8);$i++){
				$x = "";
				$x = $i*8;
				$sql3 = "insert into 联系人(申请人id,姓名,手机,固话,传真,QQ,微信,邮箱,地址) values(";
				$sql3 .= " '".$sid."','".$arr_lxr[$x]."','".$arr_lxr[$x+1]."','".$arr_lxr[$x+2]."','".$arr_lxr[$x+3]."','".$arr_lxr[$x+4]."','".$arr_lxr[$x+5]."','".$arr_lxr[$x+6]."','".$arr_lxr[$x+7]."' )";
				//echo "\n".$sql3;
				$result3 = $conn->query($sql3);			
			}			
		}

		if($result==1 && $result3==1){
			echo "1";//判断是否输出成功
		}else{
			echo "0";//判断是否输出失败
		}
		
	}else{
		echo "0";//判断是否输出失败
	}
?>

