<?php
	//保存数据
	require('../../conn.php');
	$sqr = $_POST['sqr'];//申请人
	$fmr = $_POST['fmr'];//发明设计人
	$lxr = $_POST['lxr'];//联系人
	$bz = $_POST['bz'];//备注
	$ades = $_POST['ades'];//申请人地址附加
	$ades_base = $_POST["ades_base"];//默认中英地址
	$id = $_POST['id'];//申请人信息id
	$ssid = $_POST['ssid'];//所属id
	$userid = $_POST['userid'];//操作员id
	$ayrid = $_POST['ayrid'];//案源人所属、用户is，案源人sonid
	
//		echo $sqr."\n".$fmr;
	$sqr = explode("/", $sqr);//explode()转化为数组
	$arr_ades = explode("/", $ades);
	$arr_ades_base = explode("/", $ades_base);
	$arr_fmr = explode(",",$fmr);
	$arr_lxr = explode(",",$lxr);
	
	$num_fmr = count($arr_fmr); //计算数组长度
	$num_lxr = count($arr_lxr);
	$num_ades = count($arr_ades);
	//$first_str = explode("/", $firs;t_str);
	
//	$mysql = "delete from 申请人 where id='$id' ";
	$mysql1 = "delete from 发明设计人  where 申请人id='$id' ";
	$mysql2 = "delete from 联系人 where 申请人id='$id' ";
	$mysql3 = "delete from 申请人地址  where 申请人id='$id' ";
//	$res = $conn->query($mysql);
	$res1 = $conn->query($mysql1); 
	$res2 = $conn->query($mysql2);
	$res3 = $conn->query($mysql3);
	
	//修改申请人信息
	$sql_chge="update 申请人 set 申请人='$sqr[0]',英文名 ='$sqr[1]',证件号='$sqr[2]',国籍='$sqr[3]',邮政编码='$sqr[4]',费减备案='$sqr[5]',费减比例='$sqr[6]',备注='$bz',地址='$arr_ades_base[0]',地址E='$arr_ades_base[1]',记录所属='".$ayrid."'  where id='".$id."'";
	$result_chge = $conn->query($sql_chge);
	//保存除默认地址外的申请人地址
	$date = date('Y-m-d');
	if($num_ades>0){
		for($xx = 0;$xx<$num_ades;$xx++){
			if($arr_ades[$xx] != ""){
				$sqlx = "insert into 申请人地址(申请人id,地址,新建日期,操作员) values('$id','$arr_ades[$xx]','$date','$userid')";
				$resultx = $conn->query($sqlx);
			}
		}
	}
	//创建连接的发明设计人
	for($i=0;$i<$num_fmr;$i++){
		if($arr_fmr["$i"]!=null){
			$fmr = explode("/",$arr_fmr["$i"]);
			$sql3 = "insert into 发明设计人(申请人id,姓名,证件号) values(";
			$sql3 .= "'$id','$fmr[0]','$fmr[1]')";
			$result3 = $conn->query($sql3);
		}
	}
	//创建连接的联系人
	for($i=0;$i<$num_lxr;$i++){
		if($arr_lxr["$i"]!=null){
			$lxr = explode("/",$arr_lxr["$i"]);
			$sql4 = "insert into 联系人(申请人id,姓名,手机,固话,邮箱,地址,传真) values(";
			$sql4 .= "'$id','$lxr[0]','$lxr[1]','$lxr[2]','$lxr[3]','$lxr[4]','$lxr[5]')";
			$result4 = $conn->query($sql4);
		}
	}

	//更新所有该申请人的名称：专利信息，专案_复审等，专案_年费，商标_案件，海关_案件，著作_信息，软件_信息，商标_委托书
	$tables = array("专利信息","专案_复审等","专案_年费","商标_案件","海关_案件","著作_信息","软件_信息","商标_委托书");
	foreach($tables as $tablename){
		if($tablename == "商标_委托书"){
			$sql = "SELECT id,委托人id FROM ".$tablename." WHERE 委托人id LIKE '%".$id."%'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_row()){
					$sqr_name = "";
					$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$row[1]."')";
					$result8 = $conn->query($sql8);
					if($result8 ->num_rows>0){
						while($row8 = $result8->fetch_assoc()){
							$sqr_name = $row8["申请人"];
						}
					}
					$sql = "UPDATE ".$tablename." SET 委托人='".$sqr_name."' WHERE id='".$row[0]."'";
					$conn->query($sql);
				}
			}
		}else{
			$sql = "SELECT id,申请人id FROM ".$tablename." WHERE 申请人id LIKE '%".$id."%'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_row()){
					$sqr_name = "";
					$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$row[1]."')";
					$result8 = $conn->query($sql8);
					if($result8 ->num_rows>0){
						while($row8 = $result8->fetch_assoc()){
							$sqr_name = $row8["申请人"];
						}
					}
					$sql = "UPDATE ".$tablename." SET 申请人='".$sqr_name."' WHERE id='".$row[0]."'";
					$conn->query($sql);
				}
			}
		}
	}
	
	
	//返回信息
	echo '修改成功';
	
	
$conn->close();
?>	

