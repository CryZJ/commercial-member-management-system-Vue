<?php
	$flag = $_POST['flag'];
	if($flag == 'change'){//操作员手下及其相应权限保存
		$bh= $_POST['bh'];
		$czyid = $_POST['czyid'];
		$sonbh = explode("|",$bh);
		$num = count($sonbh);
		require("../../conn.php");
		$sql = "delete from 操作员下表 where czyid = '$czyid'";
		$result = $conn->query($sql);
	
		for($i=0;$i<$num;$i++){
			$sql3 = "select 编号,id,sonid from 代理人信息 where id = '".$sonbh[$i]."'";
			$result3=$conn->query($sql3);
			$row3 = $result3->fetch_assoc();
			if($result3->num_rows>0){
				$dlrbh = $row3['编号'];
				$yhid = $row3['sonid'];
			}
			$mysql = "insert into 操作员下表(czyid,编号,代理人id,代理人用户id) values('$czyid','".$dlrbh."','".$sonbh[$i]."','".$yhid."')";
			$result2 = $conn->query($mysql);
		}
		$sysper = $_POST['sysper'];
		$fcoper = $_POST['fcoper'];
		$date   = date('Y-m-d');
		$sql_set = "update 用户 set sys_set ='".$sysper."' ,fare_con='".$fcoper."',修改日期='".$date."' where id = '".$czyid."'";
		$result_sys = $conn->query($sql_set);
		
		if($result2 == 1 && $result_sys == 1){
			echo "修改成功";
		}else{
//			echo "出现未知错误，请联系开发人员";
			echo $sql_set;
		}
	}else if($flag == 'show'){//返回查询结果，操作员权限查询
		$czyid = $_POST['czyid'];
		require'../../conn.php';
		$sql_show = "select sys_set,fare_con from 用户  where id = '".$czyid."'";
		$result_show = $conn->query($sql_show);
		if($result_show->num_rows>0){
			while($row_s = $result_show->fetch_assoc()){
				$sys_set = $row_s['sys_set'];
				$fare_con = $row_s['fare_con'];
			}
		}
		echo $sys_set.'/'.$fare_con;
	}else{
		echo '';
	}
	
?>