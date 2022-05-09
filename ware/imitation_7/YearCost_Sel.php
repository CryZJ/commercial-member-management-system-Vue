<?php
	require'../../conn.php';
	$flag = $_GET['flag'];
	if($flag == 'showA'){
		$ArrRe = array();
		for($x=1;$x<20+1;$x++){
			$sql = "select * from 年费设置 where 专利类型='发明专利' and 年度='".$x."' ORDER BY 费减比 ASC";
			$result = $conn->query($sql);
//			75,80,100
			if($result ->num_rows>0){
				while($row = $result->fetch_assoc()){
					$ArrRe[$x][$row['费减比']] = $row['金额'];
				}
			}
		}
		if($result){
			$json_string = json_encode($ArrRe); 
			echo $json_string;
		}
	}
	else if($flag == 'showB'){
		$ArrRe = array();
		for($y=1;$y<10+1;$y++){
			$sqly = "select * from 年费设置 where 专利类型='实用新型' and 年度='".$y."' ORDER BY 费减比 ASC";
			$resulty = $conn->query($sqly);
//			75,80,100
			if($resulty ->num_rows>0){
				while($rowy = $resulty->fetch_assoc()){
					$ArrRe[$y][$rowy['费减比']] = $rowy['金额'];
				}
			}
		}
		if($resulty){
			$json_string = json_encode($ArrRe); 
			echo $json_string;
		}
	}
	else if($flag == 'showC'){
		$ArrRe = array();
		for($z=1;$z<10+1;$z++){
			$sqlz = "select * from 年费设置 where 专利类型='外观设计' and 年度='".$z."' ORDER BY 费减比 ASC";
			$resultz = $conn->query($sqlz);
//			75,80,100
			if($resultz ->num_rows>0){
				while($rowz = $resultz->fetch_assoc()){
					$ArrRe[$z][$rowz['费减比']] = $rowz['金额'];
				}
			}
		}
		if($resultz){
			$json_string = json_encode($ArrRe); 
			echo $json_string;
		}
	}
	else if($flag == 'change'){
		$Mes_100 = $_GET['Mes_0'];
		$arrMes100  = explode('|',$Mes_100);
		$Mes_85  = $_GET['Mes_1'];
		$arrMes85  = explode('|',$Mes_85);
		$Mes_70  = $_GET['Mes_2'];
		$arrMes70  = explode('|',$Mes_70);
		$tab  = $_GET['tab'];
		switch($tab){
			case 'a':
				$MesType = '发明专利';
				break;
			case 'b':
				$MesType = '实用新型';
				break;
			case 'c':
				$MesType = '外观设计';
				break;
			default:break;
		}
		//搜改100%
		$sqlS1 = "select id from 年费设置 where 费减比 = '100' and 专利类型='".$MesType."' order by 年度  asc";
		$resultS1 =$conn->query($sqlS1);
		if($resultS1->num_rows>0){
			$i=0;
			while($rowS1 = $resultS1->fetch_assoc()){
				$sqlC1 = "update 年费设置  set 金额 = '".$arrMes100[$i]."' where id='".$rowS1['id']."' ";
				$resultC1 = $conn->query($sqlC1);
				$i++;
			}
		}
		
		//搜改85%
		$sqlS2 = "select id from 年费设置 where 费减比 = '85' and 专利类型='".$MesType."' order by 年度  asc";
		$resultS2 =$conn->query($sqlS2);
		if($resultS2->num_rows>0){
			$i=0;
			while($rowS2 = $resultS2->fetch_assoc()){
				$sqlC2 = "update 年费设置  set 金额 = '".$arrMes85[$i]."' where id='".$rowS2['id']."' ";
				$resultC2 = $conn->query($sqlC2);
				$i++;
			}
		}
		
		//搜改70%
		$sqlS3 = "select id from 年费设置 where 费减比 = '70' and 专利类型='".$MesType."' order by 年度  asc";
		$resultS3 =$conn->query($sqlS3);
		if($resultS3->num_rows>0){
			$i=0;
			while($rowS3 = $resultS3->fetch_assoc()){
				$sqlC3 = "update 年费设置  set 金额 = '".$arrMes70[$i]."' where id='".$rowS3['id']."' ";
				$resultC3 = $conn->query($sqlC3);
				$i++;
			}
		}
		
		
		if($resultC1){
			echo '操作成功';
		}else{
//			echo '操作失败';
			echo $sqlC1;
		}
		
	}
?>