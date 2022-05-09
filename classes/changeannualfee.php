<?php
/*
 * 
 * 
 * 重新生成年费
 * 
 * 没有费减比例的改为：85%
 * 
 * 申请案件：冻结状态＝0的不要，状态：申请中，年费中
 * */
 require_once "../conn.php";
 require_once "CreateAnnualFee.php";
 
 //`专利信息`表
// $sql = "SELECT `案卷号`,`申请日`,`年费首年度`,`年费费减比例`,`类型` FROM `专利信息` WHERE `冻结状态`='0' AND `状态`='年费中'";
 
 //`专案_年费`表
   $sql = "SELECT `案卷号`,`申请日`,`首年度`,`费减比例`,`类型` FROM `专案_年费` WHERE `冻结状态`='0' AND `案件状态`='0' AND `状态`='年费中'";
 
 $result = $conn->query($sql);
 
 $sqldata_zl = "";
 if($result->num_rows>0){
 	while($row = $result->fetch_row()){
// 		$sqldata_zl[] = $row;
//		echo $row["申请日"].$row["年费首年度"].$row["年费费减比例"].$row["类型"];
		
//		$feedataclass = new CreateAnnualFee($conn,$row["申请日"],$row["年费首年度"],$row["年费费减比例"],$row["类型"]);
		$feedataclass = new CreateAnnualFee($conn,$row[1],$row[2],$row[3],$row[4]);
		$feedata = $feedataclass->GetAnnualFeeDate();
		$sqldata_zl[$row[0]] = $feedata;
 	}
	if(isset($sqldata_zl)){
		$i = 0;
		foreach($sqldata_zl as $ajh => $annualfeeinfo){
			if(isset($annualfeeinfo)){
				foreach($annualfeeinfo as $annualyear => $feeinfo){
					//保存表`专案_年费记录`
//					$sql = "INSERT INTO 专案_年费记录(`案卷号`,`年度`,`金额`,`提醒日期`,`应缴日期`) VALUES(";
//					$sql .= "'".$ajh."','".$feeinfo["年度"]."','".$feeinfo["金额"]."','".$feeinfo["提醒日期"]."','".$feeinfo["截止日期"]."')";
////					echo $sql."</br>";
//					if($conn->query($sql)){
//						//保存表`滞纳金列表`
//						foreach($feeinfo["滞纳金"] as $index => $overfeeinfo){
//							$num = intval($index)+1;
//							$sql = "INSERT INTO 滞纳金列表(`案卷号`,`年度`,`期数`,`滞纳金`) VALUES(";
//							$sql .= "'".$ajh."','".$feeinfo["年度"]."','".$num."','".$overfeeinfo."')";
//							if(!$conn->query($sql)){
//								echo "案卷号：".$ajh."年度：".$feeinfo["年度"]."期数：".$num;
//							}
//						}
//					}else{
//						echo "案卷号：".$ajh."年度：".$feeinfo["年度"];
//					}
				}
				$i++;
			}else{
				echo "案卷号：".$ajh;
			}
			
		}
	}
	echo "运行完毕".$i;
 }
?>