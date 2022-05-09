<?php
require("../../AHeader.php");

	$falg = $_GET['falg'];
	if($falg == 'zl_change'){
		$sqrid = $_GET['sqrid'];//申请人id
		$zlm = $_GET['zlm'];//专利名称
		$ayr = $_GET['ayr'];//案源人
		$dlr = $_GET['dlr'];//代理人
		$sqd = $_GET['sqd'];//申请日
		$dqcx = $_GET['dqcx'];//当前程序
		$ajh = $_GET['ajh'];//案卷号
		$cpeo = $_GET['cpeo'];//创建人
		$sqgg = $_GET['sqgg'];//授权公告
		$FareCount = $_GET['FareCount'];//费减比例
		
		$date = date('Y-m-d');
		
		require'../../conn.php';
		
		//查找案源人代理人信息
			//案源人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$ayr."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$ayrid = $row_sqrid['id'];//案源人代理id
				$ayrsonid = $row_sqrid['sonid'];//案源人用户id
			}
		}
			//代理人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$dlr."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$dlrid = $row_sqrid['id'];//代理人代理id
				$dlrsonid = $row_sqrid['sonid'];//代理人用户id
			}
		}
		//保存专案_可见表，确定谁可见
		$sql_view = "update `专案_可见`set 创建时间='".$date."',创建人='".$cpeo."',案源可见id='".$ayrid."',案源可见人='".$ayr."',案源代理id='".$ayrsonid."',代理可见id='".$dlrid."',代理可见人='".$dlr."',代理代理id='".$dlrsonid."' where 案卷号='".$ajh."' ";
//		$sql_view = "insert into `专案_可见`(案卷号,ctype,创建时间,创建人,案源可见id,案源可见人,案源代理id,代理可见id,代理可见人,代理代理id)  values('".$str_mas[0]."','0','".$time."','".$arr_tabf[1]."','".$ayrid."','".$str_mas[2]."','".$ayrsonid."','".$dlrid."','".$str_mas[3]."','".$dlrsonid."')";
		$result_view = $conn->query($sql_view);
		
		$sqrAL='';
//		
		
		$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$sqrid."')";
		$result8 = $conn->query($sql8);
		if($result8 ->num_rows>0){
			while($row8 = $result8->fetch_assoc()){
				$sqrAL = $row8["申请人"];
			}
		}
		
		
		if($dqcx == '结案'){
			$sql = "update 专利信息 set 专利名称 = '".$zlm."',案源人='".$ayr."',代理人='".$dlr."',申请日='".$sqd."',申请人id='".$sqrid."',申请人='".$sqrAL."',冻结状态=1 where 案卷号='".$ajh."' ";
		}else{
			$sql = "update 专利信息 set 专利名称 = '".$zlm."',案源人='".$ayr."',代理人='".$dlr."',状态='".$dqcx."',申请日='".$sqd."',申请人id='".$sqrid."',申请人='".$sqrAL."',授权时间='".$sqgg."',冻结状态=0,年费费减比例='".$FareCount."'  where 案卷号='".$ajh."' ";
		}
		//保存专利信息
		$result = $conn->query($sql);
//		echo $sqrAL;
		if($result){
			$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','修改案件基本信息','".date("Y-m-d H:i:s")."','更新案件基本信息')";
			$conn->query($sql);
			echo 1;
		}else{
			echo $sql;
		}
	}


$conn->close();
?>