<?php
	$sqrid = $_POST['sqrid'];
	$sqr_id = explode('/',$sqrid);
	$len = count($sqr_id);
	
	require '../../../conn.php';
	$y = 0;
	for($i = 0;$i<$len;$i++){
		$sql = "select *  from 发明设计人 where 申请人id = '".$sqr_id[$i]."' ";
//		$sql_arr[]=$sql;
		$result = $conn->query($sql);
		if($result -> num_rows>0){
			while($row = $result->fetch_assoc()){
				$arr[$y]['id']=$row['id'];
				$arr[$y]['姓名']=$row['姓名'];
				$arr[$y]['证件号']=$row['证件号'];
				$y++;
			}
		}
	}
	$arr['num'] = $y;
	$datajson = json_encode($arr);
	echo $datajson;
//	echo print_r($arr).'/'.print_r($sql_arr);
?>