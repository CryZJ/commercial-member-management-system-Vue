<?php
require('conn.php');
/***更新数据库的剩余天数***/
//计算两日期的间隔天数
//	function diffBetweenTwoDays ($day1, $day2){
//	  $second1 = strtotime($day1);
//	  $second2 = strtotime($day2);
//	  $second1 = (int)$second1;
//	  $second2 = (int)$second2;
//	  $i = is_int($second1);
////	  if ($second1 < $second2) {
////	    $tmp = $second2;
////	    $second2 = $second1;
////	    $second1 = $tmp;
////	  }
//	  if($second1 < $second2){
//	  	return ($second1 - $second2) / 86400;
//	  }else if($second1 > $second2){
//	  	return -($second2 - $second1) / 86400;
//	  }else{
//	  	return 0;
//	  }
//	}
//	
//	$now_date = date('Y-m-d');//获取当天日期
//	//操作专利需交费用表
//	$sql = "select id,缴费期限 from 专案需交费用";
//	$result = $conn->query($sql);
//	if($result->num_rows > 0){
//		while($row = $result->fetch_assoc()){
//				$day = diffBetweenTwoDays($row['缴费期限'],$now_date);
//				$sql2 = "update 专案需交费用  set 剩余天数='$day' where id='".$row['id']."'";
//				$result2 = $conn->query($sql2);
//		}
//	}
//	//更新费用状态【将剩余天数小于或等于120天的监控中费用放到待缴费处，即将费用状态将0改成8】
//	//专案需缴费用
//	$sql4 = "update 专案需交费用  set 状态=8 where 剩余天数<=120 and 状态=0";
//	$result4 = $conn->query($sql4);
//	
////	操作专利年费表
//	$sql3 = "select id,应缴日期 from `专案_年费记录`";
//	$result3 = $conn->query($sql3);
//	if($result3->num_rows > 0){
//		while($row3 = $result3->fetch_assoc()){
//				$day2 = diffBetweenTwoDays($row3['应缴日期'],$now_date);
//				$sql4 = "update 专案_年费记录  set 剩余天数='$day2' where id='".$row3['id']."'";
//				$result4 = $conn->query($sql4);
//		}
//	}
//	//更新费用状态【将剩余天数小于或等于120天的监控中费用放到待缴费处，即将费用状态将0改成8】
//	//专案_年费记录
//	$sql5 = "update 专案_年费记录  set 状态=8 where 剩余天数<=120 and 状态=0";
//	$result5 = $conn->query($sql5);
	
	$sql = "UPDATE 专案需交费用  SET 状态='8' WHERE DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='120' AND 状态='0';";
	$sql = "UPDATE 专案_年费记录  SET 状态='8' WHERE DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='120' AND 状态='0';";
	$conn->query($sql);
	$conn->close();
?>