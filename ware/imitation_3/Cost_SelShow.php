<?php
	require("../../conn.php");
	$sql01 = "SELECT id,`案卷号`,案源人,代理人,状态,申请日,申请号,专利名称 from 专利信息 ";
	$result01 = $conn->query($sql01);
	$arrMes = array();
	$i=0;
	if($result01->num_rows > 0){
		while($row01 = $result01->fetch_assoc()){
			$arrMes[$i]['id']= $row01['id'];
			$arrMes[$i]['ajh']= $row01['案卷号'];
//			$arrMes[$i]['案源人']= $row01['案源人'];
//			$arrMes[$i]['代理人']= $row01['代理人'];
//			$arrMes[$i]['状态']= $row01['状态'];
			$arrMes[$i]['sqr']= $row01['申请日'];
//			$arrMes[$i]['申请号']= $row01['申请号'];
			$arrMes[$i]['zln']= $row01['专利名称'];
			$i++;
    	}
    }
    $json_Mes = json_encode($arrMes);
    echo $json_Mes;
//  echo print_r($arrMes);
?>