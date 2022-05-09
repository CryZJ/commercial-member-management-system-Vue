<?php
require("AHeader.php");

	//获取传过来的值
	$base = $_POST['base'];//（案卷号，年费费减比例，复审费减比例，申请日，申请号）
	$fee = $_POST['fee'];
	$fee_time = $_POST['fee_time'];
//	foreach($fee as $key => $value){
//		echo $key ."：".$value."\n";
//	}
	
	//更新表“专利信息”
	require('conn.php');
	$sql = "update 专利信息 set 年费费减比例='$base[1]',复审费减比例='$base[2]',申请日='$base[3]',申请号='$base[4]',状态='待申请费' where 案卷号='$base[0]'";
//	echo $sql;
	$result = $conn->query($sql);
//	echo $result;
	$i = 0;
	if($result==1){
		$feename_str = "";
		foreach($fee as $key => $value){
			if($value !=0){
				$sql = "SELECT id,费用名称 FROM 专案需交费用 WHERE 案卷号='".$base[0]."' AND 费用名称='".$key."' AND 状态<>'9' ";
				$result = $conn->query($sql);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()){
						$feeid = $row['id'];
					}
					$sql2 = "UPDATE 专案需交费用 SET 金额='".$value."',通知时间='".$fee_time[0]."',缴费期限='".$fee_time[1]."',提醒时间='".$fee_time[2]."',费用来源='1',状态='4'  WHERE id='".$feeid."'";
					$result2 = $conn->query($sql2);
					$i++;
					if($result2==1){
						$feename_str .= ",".$key;
						$return['result']='保存成功！';
					}else{
						exit('保存失败！');
					}
				}else{//费用不存在
					$sql2 = "insert into 专案需交费用(案卷号,费用名称,金额,通知时间,缴费期限,提醒时间,费用来源,状态) values(";
					$sql2 .=" '$base[0]','".$key."','".$value."','$fee_time[0]','$fee_time[1]','$fee_time[2]','1','4')";
	//				echo $sql2;
					$result2 = $conn->query($sql2);
					$i++;
					if($result2==1){
						$feename_str .= ",".$key;
						$return['result']='保存成功！';
					}else{
						exit('保存失败！');
					}
				}
									
			}
		}
		$feename_str = substr($feename_str, 1);
		$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$base[0]."','".$name."','保存费用','".date("Y-m-d H:i:s")."','保存了“".$feename_str."”等费用')";
		$conn->query($sql);
	}else{
		$return['result']='保存失败！';
	}
//	echo $return['result'];
	$json = json_encode($return);
	echo $json;
	$conn->close();
?>