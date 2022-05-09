<?php
require("AHeader.php");
	$my_flag = $_POST['my_flag'];
	
	if($my_flag == "保存费用"){
		//获取传过来的值
		$base = $_POST['base'];//（案卷号，年费费减比例，复审费减比例，申请日，申请号）
		$fee = $_POST['fee'];
		$fee_time = $_POST['fee_time'];
		
//		print_r($base);
//		print_r($fee);
//		print_r($fee_time);
	//	echo gettype($fee);
	//	foreach($fee as $key => $value){
	//		echo $key ."：".$value."\n";
	//	}
		require('conn.php');
		$return["result"] = "";
		$i = 0;
		$feename_str = "";
		foreach($fee as $key => $value){
			if($value !=0){
				if($key=="年费"){
					$sql = "SELECT id FROM 专案需交费用 WHERE 案卷号='".$base[0]."' AND 费用名称='年费' AND 状态<>'9' ";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
							$fee_id = $row['id'];
						}
						$sql2 = "UPDATE 专案需交费用 SET 金额='".$value."',通知时间='".$fee_time[0]."',缴费期限='".$fee_time[1]."',提醒时间='".$fee_time[2]."',费用来源='2' WHERE id='".$fee_id."'";
						$result2 = $conn->query($sql2);
						$i++;
						if($result2==1){
							$feename_str .= ",".$key;
							$return['result'] .= $key.'保存费用成功'."\n";
						}else{
							$return['result'] .= $key.'保存失败！'."\n".$sql2;
						}
					}else{
						$sql2 = "insert into 专案需交费用(案卷号,年度,费用名称,金额,通知时间,缴费期限,提醒时间,费用来源) values(";
	//					$sql2 = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,状态) VALUES(";
						$sql2 .=" '$base[0]','1','年费','$value','$fee_time[0]','$fee_time[1]','$fee_time[2]','2')";
	//					echo $sql2;
						$result2 = $conn->query($sql2);
						$i++;
						if($result2==1){
							$feename_str .= ",".$key;
							$return['result'] .= $key.'保存费用成功'."\n";
						}else{
							$return['result'] .= $key.'保存失败！'."\n".$sql2;
						}
					}
				}else{
					$sql = "SELECT id FROM 专案需交费用 WHERE 案卷号='".$base[0]."' AND 费用名称='".$key."' AND 状态<>'9' ";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
							$fee_id = $row['id'];
						}
						$sql2 = "UPDATE 专案需交费用 SET 金额='".$value."',通知时间='".$fee_time[0]."',缴费期限='".$fee_time[1]."',提醒时间='".$fee_time[2]."',状态=0,费用来源='2' WHERE id='".$fee_id."'";
						$result2 = $conn->query($sql2);
						$i++;
						if($result2==1){
							$feename_str .= ",".$key;
							$return['result'] .= $key.'保存费用成功'."\n";
						}else{
							$return['result'] .= $key.'保存失败！'."\n".$sql2;
						}
					}else{
						$sql2 = "insert into 专案需交费用(案卷号,费用名称,金额,通知时间,缴费期限,提醒时间,费用来源) values(";
						$sql2 .=" '$base[0]','$key','$value','$fee_time[0]','$fee_time[1]','$fee_time[2]','2')";
	//					echo $sql2;
						$result2 = $conn->query($sql2);
						$i++;
						if($result2==1){
							$feename_str .= ",".$key;
							$return['result'] .= $key.'保存费用成功'."\n";
						}else{
							$return['result'] = $key.'保存失败！'."\n".$sql2;
						}
					}
				}					
			}
		}
		$feename_str = substr($feename_str, 1);
		$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$base[0]."','".$name."','保存费用','".date("Y-m-d H:i:s")."','保存了“".$feename_str."”等费用')";
		$conn->query($sql);
		
		$json = json_encode($return);
		echo $json;
		$conn->close();
	
	}else if($my_flag == "保存授权公告日"){
		$ajh = $_POST['ajh'];
		$sqggr = $_POST['sqggr'];
		$nfsnd = $_POST['nfsnd'];
		$cid ='';
		require('conn.php');
		//更新“专案_年费记录”的第一次年度
		$sql3 = "SELECT id FROM 专案需交费用  WHERE 案卷号='$ajh' AND 费用名称='年费' AND 状态<>'9' ORDER BY id LIMIT 1";
		$result3 = $conn->query($sql3);
		if($result3 ->num_rows >0){
			while($row3 = $result3->fetch_assoc()){
				$cid = $row3['id'];
			}
		}
		if($cid!=''){
			$sql3 = "UPDATE 专案需交费用  SET 年度='$nfsnd' WHERE id='$cid'";
			$result3 = $conn->query($sql3);
		}
		//更新“专利信息”
		$sql = "update 专利信息 set 授权时间='$sqggr',状态='待登记费',年费首年度 ='$nfsnd' where 案卷号='$ajh'";
		$result = $conn->query($sql);
		if($result){
			$return['result']='更新公告日成功！';
		}else{
			$return['result']='更新失败！';
		}
		
		$json = json_encode($return);
		echo $json;
		$conn->close();
	}
	
?>