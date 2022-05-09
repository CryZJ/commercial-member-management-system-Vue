<?php require'../../AHeader.php'; ?>
<?php
	$flag = $_GET['flag'];
	require'../../conn.php';
	//保存信息
	if($flag == 'SaveMes'){
		$time 	= $_GET['date'];
		if($time == ''){
			$time = date('Y-m-d');
		}else{
			$time = $time;
		}
		$MesShow= $_GET['MesShow'];//安排
		$MesBz 	= $_GET['MesBz'];//备注
		$date 	= date('Y-m-d H:i:s');
		
		$sql = "insert into 日程设置(事件名,事件时间,创建时间,备注,用户id) VALUES('".$MesShow."','".$time."','".$date."','".$MesBz."','".$userid."')";
		if($conn->query($sql)){
			echo $conn->insert_id;
		}else{
			echo '操作失败';
		}
//		$result = $conn->query($sql);
//		if($result){
//			$sql2 	= "select id from 日程设置 where 用户id = '".$userid."' and 创建时间 = '".$date."'";
//			$result2 = $conn->query($sql2);
//			if($result2 ->num_rows>0){
//				while($row2 = $result2->fetch_assoc()){
//					$data = $row2['id'];
//				}
//			}
//			echo $data;
//		}
//		else{
//			echo '操作失败';
//		}
	}
	//显示表格【动态创建】
	else if($flag == 'ShowTab'){
		$dateC = $_GET['date'];
		$CheStuate = $_GET['CheStuate'];
		if($dateC == ''){
			$dateC = date('Y-m-d');
		}else{
//			$dateC = $dateC;
		}
		if($admin){
			$sql = "select id,事件名,状态,备注  from 日程设置 where 事件时间='".$dateC."' AND 删除状态=0  ";
		}else{
			$sql = "select id,事件名,状态,备注  from 日程设置 where 用户id='".$userid."' and 事件时间='".$dateC."' AND 删除状态=0  ";
		}
		if(!$CheStuate){
			$sql=$sql."and 状态=0";
		}
		$result = $conn->query($sql);
		$arrMes = array();
		if($result->num_rows>0){
			$i = 0;
			while($row = $result->fetch_assoc()){
				$arrMes[$i]['id']		=	$row['id'];
				$arrMes[$i]['事件名']	=	$row['事件名'];
				$arrMes[$i]['状态']		=	$row['状态'];
				$arrMes[$i]['备注']		=	$row['备注'];
				$i++; 
			}
		}
    	$json_string = json_encode($arrMes); 
		echo $json_string;
//		echo $CheStuate.'//'.$sql;
	}
	//改变事件完成状态
	else if($flag == 'ChanStu'){
		$stu = $_GET['stu'];
		$id = $_GET['id'];
		$sql = "update 日程设置  set 状态='".$stu."' where id='".$id."' ";
		$result = $conn->query($sql);
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}
	//改变已完成事件显示状态
	else if($flag == 'ChanShowStu'){
		$stu = $_GET['ShowStu'];
		//查询数据库是否有相应记录
		$sql = "select 完成项 from 日程设置附  where 用户id='".$userid."'";
		$result = $conn->query($sql);
			//有相应数据
		if($result -> num_rows>0){
			$sql2 = "update 日程设置附  set 完成项='".$stu."' where 用户id='".$userid."'";
			$result2 = $conn->query($sql2);
			if($result2){
				echo 1;
			}else{
				echo 0;
			}
		}
			//没有相应数据
		else{
			$sql2 = "insert into 日程设置附(完成项,用户id)  values('".$stu."','".$userid."') ";
			$result2 = $conn->query($sql2);
			if($result2){
				echo 3;
			}else{
				echo 4;
			}
		}
	}
	
	//获取这次年月的有事件的天数字符串
	else if($flag == "GetDayString"){
		$y = $_GET['y'];
		$m = $_GET['m'];
		$now_day = date("j");
		//有未完成的事件的日期
		$red_day = ",0";
		$green_day = ",0";
		if($admin){
			$sql = "SELECT DISTINCT 事件时间,YEAR(事件时间) AS 年,MONTH(事件时间) AS 月,DAY(事件时间) AS 日 FROM 日程设置 WHERE YEAR(事件时间)='".$y."' AND MONTH(事件时间)='".$m."' AND 删除状态=0 AND 状态='0'  ORDER BY 事件时间";
		}else{
			$sql = "SELECT DISTINCT 事件时间,YEAR(事件时间) AS 年,MONTH(事件时间) AS 月,DAY(事件时间) AS 日 FROM 日程设置 WHERE YEAR(事件时间)='".$y."' AND MONTH(事件时间)='".$m."' AND 用户id='".$userid."' AND 删除状态=0 AND 状态='0'  ORDER BY 事件时间";
		}
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				if($row['日'] < $now_day){
					$red_day .= ",".$row['日'];
				}else{
					$green_day .= ",".$row['日'];
				}
			}
		}
		if($red_day != ""){
			$red_day = substr($red_day,1);
		}
		if($green_day != ""){
			$green_day = substr($green_day,1);
		}
		$red_day_arr = explode(",", $red_day);
		$green_day_arr = explode(",", $green_day);
		//已完成的事件的日期
		$yellow_day = ",0";
		if($admin){
			$sql = "SELECT DISTINCT 事件时间,YEAR(事件时间) AS 年,MONTH(事件时间) AS 月,DAY(事件时间) AS 日 FROM 日程设置 WHERE YEAR(事件时间)='".$y."' AND MONTH(事件时间)='".$m."' AND 删除状态=0 AND 状态='1'  ORDER BY 事件时间";
		}else{
			$sql = "SELECT DISTINCT 事件时间,YEAR(事件时间) AS 年,MONTH(事件时间) AS 月,DAY(事件时间) AS 日 FROM 日程设置 WHERE YEAR(事件时间)='".$y."' AND MONTH(事件时间)='".$m."' AND 用户id='".$userid."' AND 删除状态=0 AND 状态='1'  ORDER BY 事件时间";
		}
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
//				if(strpos($strday_nothing,$row['日']) === FALSE){
					if((!in_array($row['日'], $red_day_arr)) && (!in_array($row['日'], $green_day_arr))){
						$yellow_day .= ",".$row['日'];
					}
//				}
			}
		}
		if($yellow_day != ""){
			$yellow_day = substr($yellow_day,1);
		}
		$ret_arr = "";
		$ret_arr["red_day"] = $red_day;
		$ret_arr["green_day"] = $green_day;
		$ret_arr["yellow_day"] = $yellow_day;
		
		$json = json_encode($ret_arr);
		echo $json;
		
	}
	
	
	//修改后保存
    else if($flag == "SaveMes_chang"){
		$id  = $_GET['id'];
		$MesShow= $_GET['MesShow'];//安排
		$MesBz 	= $_GET['MesBz'];//备注
		
		$sql = "UPDATE 日程设置 SET 事件名='".$MesShow."',备注='".$MesBz."',创建时间='".date("Y-m-d H:i:s")."' WHERE id='".$id."'";
		if($conn->query($sql)){
			echo "保存成功";
		}else{
			echo "保存失败";
		}
	}
	
	//删除数据
	else if($flag == "Deletcdata"){
		$id = $_GET['id'];
		
		$sql = "UPDATE 日程设置 SET 删除状态=1 WHERE id='".$id."'";
		if($conn->query($sql)){
			echo "删除成功";
		}else{
			echo "删除失败";
		}
	}
	
	
	
	//无flag的反应
	else{
		echo '非法操作';
	}
	
	
	$conn->close();
?>