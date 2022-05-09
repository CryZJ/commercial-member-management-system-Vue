<?php
require("AHeader.php");
require("conn.php");
/*
 * 整理字符串：去掉回车，中间空格，去除一个字符串两端空格 
 * */
function Settle_string($str){
	$str = str_replace(array("\r\n", "\r", "\n", "\t"), "", $str);//去掉回车
	$str = str_replace(" ", "", $str);//去掉空格 
	$str = trim($str);//去除一个字符串两端空格
	return $str; 
}
/*
 * 获取正确的状态
 * */
function Get_stauesType($djzt,$dqcx){
	switch($djzt){
		case 1 :
			return "结案";
			break;
		case 2 :
			return "删除";
			break;
		default :
			return $dqcx;
	}
}


$my_flag = $_REQUEST["my_flag"];
//$my_flag = "申请案件";




if($my_flag == "案件总览"){
	$ischeck = $_GET["ischeck"];
	if($ischeck == "没有查询"){
		if($admin == 1){
		  $sqlA="SELECT id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,案件类型,创建时间 FROM (
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,'无' AS 原案卷号,'申请案件' AS 案件类型,创建时间 from `专利信息`  where 冻结状态<>'3' and 状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'年费案件' AS 案件类型,创建时间 from `专案_年费`  where 冻结状态<>'3' and 案件状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'其他案件' AS 案件类型,创建时间 from `专案_复审等`  where 冻结状态<>'3' and 状态<>9 
		) AS c ORDER BY 创建时间 DESC";
		}else{
			$sqlA="SELECT id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,案件类型,创建时间 FROM (
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,'无' AS 原案卷号,'申请案件' AS 案件类型,创建时间 from `专利信息`  where 冻结状态<>'3'and 冻结状态<>'2' and 状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'年费案件' AS 案件类型,创建时间 from `专案_年费`  where 冻结状态<>'3'and 冻结状态<>'2' and 案件状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'其他案件' AS 案件类型,创建时间 from `专案_复审等`  where 冻结状态<>'3'and 冻结状态<>'2' and 状态<>9 
		) AS c ORDER BY 创建时间 DESC";
		}
	}else{

		$check_zllx = $_GET["zllx"];
		$check_dqcx = $_GET["dqcx"];
		$check_ayr = $_GET["ayr"];
		$check_dlr = $_GET["dlr"];
		$check_sqr_start = $_GET["sqr_start"];
		$check_sqr_end = $_GET["sqr_end"];
		
		if($admin == 1){
		  $sqlA="SELECT id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,案件类型 FROM (
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,'无' AS 原案卷号,'申请案件' AS 案件类型 from `专利信息`  where 冻结状态<>'3' and 状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'年费案件' AS 案件类型 from `专案_年费`  where 冻结状态<>'3' and 案件状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'其他案件' AS 案件类型 from `专案_复审等`  where 冻结状态<>'3' and 状态<>9 
		) AS c WHERE 1=1";
		}else{
			$sqlA="SELECT id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,案件类型 FROM (
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,'无' AS 原案卷号,'申请案件' AS 案件类型 from `专利信息`  where 冻结状态<>'3'and 冻结状态<>'2' and 状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'年费案件' AS 案件类型 from `专案_年费`  where 冻结状态<>'3'and 冻结状态<>'2' and 案件状态<>9 UNION
		select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号,'其他案件' AS 案件类型 from `专案_复审等`  where 冻结状态<>'3'and 冻结状态<>'2' and 状态<>9 
		) AS c WHERE 1=1";
		}
		if($check_dqcx != ""){
			if($check_dqcx == "结案"){
				$sqlA .= " and 冻结状态='1' ";
			}else{
				$sqlA .= " and 状态='".$check_dqcx."' and 冻结状态<>'1' ";
			}
		}
		if($check_zllx != ""){
			$sqlA .= " and 类型='".$check_zllx."' ";
		}
		if($check_ayr != ""){
			$sqlA .= " and 案源人='".$check_ayr."'";
		}
		if($check_dlr != ""){
			$sqlA .= " and 代理人='".$check_dlr."'";
		}
		if($check_sqr_start != "" && $check_sqr_end != ""){
			if($check_sqr_end > $check_sqr_start){
				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_start."' AND '".$check_sqr_end."' ";
			}else{
				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_end."' AND '".$check_sqr_start."' ";
			}
		}else{
			if($check_sqr_start != ""){
				$sqlA .= " and 申请日 > '".$check_sqr_start."' ";
			}
			if($check_sqr_end != ""){
				$sqlA .= " and 申请日 < '".$check_sqr_end."' ";
			}
		}
		$sqlA .= " order by id desc";
	}
//	echo $sqlA;
	$serror = "";
	$tmp_data = "";
	$resultA = $conn->query($sqlA);
	if($resultA->num_rows > 0){	
		while($rowA = $resultA->fetch_assoc()){
			//整理数据
			foreach($rowA as $ky => $v){
				$rowA[$ky] = Settle_string($v);
			}
			
			$sqr_name = "";
			$sqr_name = $rowA["申请人"];
			$dqcx = Get_stauesType($rowA["冻结状态"],$rowA["状态"]);
			switch($rowA["案件类型"]){
				case "申请案件":
					$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$rowA["id"].'\' ajh=\''.$rowA["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/caseinformation.php?ajh='.$rowA["案卷号"].'\' target=\'_blank\' >'.$rowA["案卷号"].'</a>","类型":"'.$rowA["类型"].'","申请号":"'.$rowA["申请号"].'","申请日":"'.$rowA["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$rowA["专利名称"].'","案源人":"'.$rowA["案源人"].'","代理人":"'.$rowA["代理人"].'","当前程序":"'.$dqcx.'","案件类型":"'.$rowA["案件类型"].'","原案卷号":"'.$rowA["原案卷号"].'"}';							
					break;
				case "年费案件":
					$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$rowA["id"].'\' ajh=\''.$rowA["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/new_yearcost/case_info.php?ajh='.$rowA["案卷号"].'\' target=\'_blank\' >'.$rowA["案卷号"].'</a>","类型":"'.$rowA["类型"].'","申请号":"'.$rowA["申请号"].'","申请日":"'.$rowA["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$rowA["专利名称"].'","案源人":"'.$rowA["案源人"].'","代理人":"'.$rowA["代理人"].'","当前程序":"'.$dqcx.'","案件类型":"'.$rowA["案件类型"].'","原案卷号":"'.$rowA["原案卷号"].'"}';							
					break;
				case "其他案件":
					$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$rowA["id"].'\' ajh=\''.$rowA["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/new_fs/case_info.php?ajh='.$rowA["案卷号"].'\' target=\'_blank\' >'.$rowA["案卷号"].'</a>","类型":"'.$rowA["类型"].'","申请号":"'.$rowA["申请号"].'","申请日":"'.$rowA["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$rowA["专利名称"].'","案源人":"'.$rowA["案源人"].'","代理人":"'.$rowA["代理人"].'","当前程序":"'.$dqcx.'","案件类型":"'.$rowA["案件类型"].'","原案卷号":"'.$rowA["原案卷号"].'"}';							
					break;
				default:
					$serror = "无数据";
			}
//			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$rowA["id"].'\' ajh=\''.$rowA["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/caseinformation.php?ajh='.$rowA["案卷号"].'\' target=\'_blank\' >'.$rowA["案卷号"].'</a>","类型":"'.$rowA["类型"].'","申请号":"'.$rowA["申请号"].'","申请日":"'.$rowA["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$rowA["专利名称"].'","案源人":"'.$rowA["案源人"].'","代理人":"'.$rowA["代理人"].'","当前程序":"'.$rowA["状态"].'","案件类型":"'.$rowA["案件类型"].'","原案卷号":"'.$rowA["原案卷号"].'"}';							
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;		
}




if($my_flag == "申请案件"){
	if($admin == 1){
		$sql="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息` b where b.冻结状态<>'3' and 状态<>9 order by id desc";
	}else{
		$sql="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 状态<>9 order by id desc";
	}

	$serror = "";
	$tmp_data = "";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$sqr_name = "";
			$sqr_name = $row["申请人"];
			$dqcx = Get_stauesType($row["冻结状态"],$row["状态"]);
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$row["id"].'\' ajh=\''.$row["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/caseinformation.php?ajh='.$row["案卷号"].'\' target=\'_blank\' >'.$row["案卷号"].'</a>","类型":"'.$row["类型"].'","申请号":"'.$row["申请号"].'","申请日":"'.$row["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$row["专利名称"].'","案源人":"'.$row["案源人"].'","代理人":"'.$row["代理人"].'","当前程序":"'.$dqcx.'"}';							
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;	
}

if($my_flag == "年费案件"){
	if($admin == 1){
		$sql="select id,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,原案卷号,申请日  from `专案_年费` b where b.冻结状态<>'3' and 案件状态<>9 group by  b.`案卷号` order by id desc";
	}else{
		$sql="select id,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,原案卷号,申请日  from `专案_年费` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 案件状态<>9 group by  b.`案卷号` order by id desc";
	}
	$serror = "";
	$tmp_data = "";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$sqr_name = "";
			$sqr_name = $row["申请人"];
			$dqcx = Get_stauesType($row["冻结状态"],$row["状态"]);
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$row["id"].'\' ajh=\''.$row["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/new_yearcost/case_info.php?ajh='.$row["案卷号"].'\' target=\'_blank\' >'.$row["案卷号"].'</a>","类型":"'.$row["类型"].'","申请号":"'.$row["申请号"].'","申请日":"'.$row["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$row["专利名称"].'","案源人":"'.$row["案源人"].'","代理人":"'.$row["代理人"].'","当前程序":"'.$dqcx.'","原案卷号":"'.$row["原案卷号"].'"}';							
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}


if($my_flag == "其他案件"){
	if($admin == 1){
		$sql="select id,案件类型,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,b.状态,申请号,申请人id,申请人,申请日  from `专案_复审等` b where b.冻结状态<>'3' and 状态<>9 group by  b.`案卷号` order by id desc";
	}else{
		$sql="select id,案件类型,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 状态<>9 group by  b.`案卷号` order by id desc";
	}
	$serror = "";
	$tmp_data = "";
	$result = $conn->query($sql);
	if($result->num_rows >= 0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$sqr_name = "";
			$sqr_name = $row["申请人"];
			$dqcx = Get_stauesType($row["冻结状态"],$row["状态"]);
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$row["id"].'\' ajh=\''.$row["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/new_fs/case_info.php?ajh='.$row["案卷号"].'\' target=\'_blank\' >'.$row["案卷号"].'</a>","类型":"'.$row["类型"].'","申请号":"'.$row["申请号"].'","申请日":"'.$row["申请日"].'","申请人":"'.$sqr_name.'","专利名称":"'.$row["专利名称"].'","案源人":"'.$row["案源人"].'","代理人":"'.$row["代理人"].'","当前程序":"'.$dqcx.'","案件类型":"'.$row["案件类型"].'"}';							
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}


if($my_flag == "失败案件"){
	$sql="select id,案卷号,案源人,代理人,创建时间,创建人,申请人id,申请人 from 专利信息 where 状态 = 9 and 冻结状态<>3";
	$serror = "";
	$tmp_data = "";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//整理数据
			foreach($row as $ky => $v){
				$row[$ky] = Settle_string($v);
			}
			
			$sqr_name = "";
			$sqr_name = $row["申请人"];
			$tmp_data .= ','.'{"inputcheckbox":"<input type=\'checkbox\' class=\'box_son\' id=\''.$row["id"].'\' ajh=\''.$row["案卷号"].'\' />","案卷号":"<a href=\'ware/imitation_1/CaseStaChan.php?ajh='.$row["案卷号"].'\' target=\'_blank\' >'.$row["案卷号"].'</a>","申请人":"'.$sqr_name.'","案源人":"'.$row["案源人"].'","代理人":"'.$row["代理人"].'","创建时间":"'.$row["创建时间"].'","创建人":"'.$row["创建人"].'"}';							
		}
		$tmp_data = substr($tmp_data, 1);
	}else{
		$serror = "无数据";
	}
	$json_str = '{"data":['.$tmp_data.'],"sError":"'.$serror.'"}';
	echo $json_str;
}


$conn->close();
?>