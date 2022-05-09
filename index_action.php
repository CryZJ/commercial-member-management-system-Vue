<?php
require'AHeader.php'; 
	$falg = $_POST['falg_1'];
	@$ajh = $_POST['ajh'];
	$tab = $_POST['tab'];
	
	switch($tab){
		case 'dynamic-table'://专利案件
			$ctype = '专利信息';
			break;
		case 'dynamic-table_2'://无效案件
			$ctype = '专案_无效';
			break;
		case 'dynamic-table_3'://复审案件
			$ctype = '专案_复审等';
			break;
		case 'dynamic-table_4'://年费案件
			$ctype = '专案_年费';
			break;
		case 'dynamic-table_5'://年费案件
			$ctype = '专利信息';
			break;
		default:
			echo "<script language='javascript'>alert('出现未知错误！');self.location='index.php';</script>;";
//			exit;
	}
	$date = date("Y-m-d H:m:i");
	require("conn.php");
	if($falg =='ja'){
		$ajh_str = $_POST['ajh_str'];
		$reason = $_POST['reason'];
		$ret = "";
		$ajh_arr = "";
		if(strpos($ajh_str, ",")){
			$ajh_arr = explode(",", $ajh_str);
		}else{
			$ajh_arr[0] = $ajh_str;
		}
		foreach($ajh_arr as $ky => $ajh){
			$sql = "UPDATE ".$ctype." b set `冻结状态`='1' WHERE `案卷号`='".$ajh."' " ;
			if($conn->query($sql)){
				$sql2 = "INSERT INTO 结案原因(案卷号,结案原因,处理人,创建时间) VALUES(";
				$sql2 .= "'".$ajh."','".$reason."','".$name."','".date("Y-m-d H:i:s")."')";
				if($conn->query($sql2)){
					$ret .= $ajh."案件结案成功！\n";
					//更新案件状态
//					$sqlC = "update 专利信息  set 状态 ='申请中' where 案卷号='".$ajh."'";
//					$resultC = $conn->query($sqlC);
					//专案操作记录
					$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他) values('".$name."','结案','".$ajh."','".date("Y-m-d H:i:s")."','".$reason."')";
					$resultHIS = $conn->query($sqlHIS);
				}else{
					$ret .= $ajh."案件结案原因保存失败！\n";
				}
			}else{
				$ret .= $ajh."案件结案失败！\n";
			}
		}
		echo $ret;
	}
	if($falg=='huif'){
		$sql = "UPDATE ".$ctype." set `冻结状态`='0' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			//专案操作记录
			$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他) values('".$name."','恢复','".$ajh."','".date("Y-m-d H:i:s")."','恢复案件为正常状态')";
			$resultHIS = $conn->query($sqlHIS);
			echo $sql;
		}
	}
	if($falg=='del'){
		$sql = "UPDATE ".$ctype."  set `冻结状态`='2' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			//专案操作记录
			$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他) values('".$name."','删除','".$ajh."','".date("Y-m-d H:i:s")."','删除案件')";
			$resultHIS = $conn->query($sqlHIS);
			echo $sql;
		}
	}
	if($falg=='hidden'){
		$sql = "UPDATE ".$ctype." b set `冻结状态`='3' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			//专案操作记录
			$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他) values('".$name."','彻底删除','".$ajh."','".date("Y-m-d H:i:s")."','已彻底删除案件')";
			$resultHIS = $conn->query($sqlHIS);
			echo $sql;
		}
	}
	$conn->close();
?>