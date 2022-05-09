<?php
	$flag = $_REQUEST['flag'];
	if($flag == 'ajh'){
		$dlid = $_REQUEST['dlrid'];
		$ayid = $_REQUEST['ayrid'];
		require'../../../conn.php';
		//案源人
		$sql = "select 编号,id,名称 from 案源人信息  where id='".$ayid."'";
		$result = $conn->query($sql);
		if($result->num_rows >= 0){
            while($row = $result->fetch_assoc()){
            	$aybh = $row['编号'];
            }
        }
		//代理人
		$sqlx = "select 编号,id,名称 from 代理人信息  where id='".$dlid."'";
		$resultx = $conn->query($sqlx);
		if($resultx->num_rows >= 0){
            while($rowx = $resultx->fetch_assoc()){
            	$dlbh = $rowx['编号'];
            }
        }
        //查数据库数据条数
        $sqli = "select count(id) as num from `海关_案件`";
        $result2 = $conn->query($sqli);
        if($result2->num_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				$xhnumber = $row2["num"];
			}
		}
		$xhnumber+=1;
		$xhstr = strval($xhnumber);
		$lenght = strlen($xhstr);
		//案卷号[案件号+案源人+7+代理人]
		switch($lenght){
			case 1 : $xhstr2 = "0000".$xhstr;break;
			case 2 : $xhstr2 = "000".$xhstr;break;
			case 3 : $xhstr2 = "00".$xhstr;break;
			case 4 : $xhstr2 = "0".$xhstr;break;
			case 5 : $xhstr2 = $xhstr;break;
			default : echo "<script type=\"text/javascript\">alert(\"案件信息表数量过大！请联系管理员！\");</script>";exit;
		}
		$ajh = $xhstr2.$aybh.'7'.$dlbh;
		
		//创建新纪录空间，避免案卷号重复
		$sql_new = "insert into `海关_案件`(案卷号,状态) values ('".$ajh."',9)";
		$result = $conn->query($sql_new);
        echo $ajh;
	}else if($flag == 'sqrmes'){
		$sid = $_REQUEST['sqrid'];
		require'../../../conn.php';
		$sql = "select 申请人,证件号,地址,邮政编码,英文名,国籍 from 申请人 where id='".$sid."'";
		$result = $conn->query($sql);
		if($result -> num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data['申请人']=$row['申请人'];
				$data['证件号']=$row['证件号'];
				$data['地址']=$row['地址'];
				$data['邮政编码']=$row['邮政编码'];
				$data['英文名']=$row['英文名'];
				$data['国籍']=$row['国籍'];
			}
		}
//		echo print_r($data);
		$return_data = json_encode($data);
		echo $return_data;
	}else if($flag == 'savemes'){
		$bmes = $_REQUEST['bmes'];//基本信息
		$cmes = $_REQUEST['cmes'];//申请人信息【申请人id】
		$emes = $_REQUEST['emes'];//备案信息
		$bz = $_REQUEST['bz'];//备注
		$czy = $_REQUEST['czy'];//操作员
		$now_date = date('Y-m-d');//当前时间
		
		$arr_bmes = explode('|',$bmes);
		$arr_emes = explode('|',$emes);
		
		require'../../../conn.php';
		//获取申请人姓名
		$arr_cmes = explode('|',$cmes);
		$CmesLen = count($arr_cmes);
		$sqr = '';
		for($y=0;$y<$CmesLen;$y++){
			$sqlSelect = "select 申请人 from 申请人 where id = '".$arr_cmes[$y]."'";
			$resultSelect = $conn->query($sqlSelect);
			if($resultSelect->num_rows>0){
				while($rowSelect = $resultSelect->fetch_assoc()){
					$sqr = $sqr.','.$rowSelect['申请人'];
				}
			}
		}
		$sqr = substr($sqr,1);
		//保存表【海关_案件】
		$sql_smes = "update `海关_案件` set 状态=0,代理人='".$arr_bmes[1]."',案源人='".$arr_bmes[0]."',备案类型='".$arr_bmes[3]."',申请号='".$arr_bmes[4]."',申请日='".$arr_bmes[5]."',名称='".$arr_bmes[6]."',备案日期='".$arr_emes[0]."',备案监控='".$arr_emes[1]."',备案天数='".$arr_emes[2]."',案件备注='".$bz."',登记人='".$czy."',登记日期='".$now_date."',申请人 = '".$sqr."',申请人id='".$cmes."' where 案卷号='".$arr_bmes[2]."'";
		$resule_smes = $conn->query($sql_smes);
		
		//获取案件id
//		$sql_gid = "select id as cid from `海关_案件` where 案卷号='".$arr_bmes[2]."'";
//		$result_gid = $conn->query($sql_gid);
//		if($result_gid ->num_rows>0){
//			while($row_g = $result_gid->fetch_assoc()){
//				$caseid = $row_g['cid'];
//			}
//		}
		//保存表【海关_申请人】
//		$sql_ssqr = "insert into `海关_申请人`(案件id,申请人,证件号,地址,邮编,创建人,创建时间) values ('".$caseid."','".$arr_bmes[3]."','".$arr_bmes[4]."','".$arr_bmes[5]."','','".$czy."','".$now_date."')";
//		$result_ssqr = $conn->query($sql_ssqr);
		
//		$sql_del = "delete from `海关_案件` where 状态='9'";
//		$result_del = $conn->query($sql_del);
		
		if($resule_smes){
			echo '操作成功';
		}else{
			echo '保存时出现错误，请联系管理员';
		}
	}
	else{
		echo '出现未知错误，请联系管理员';
	}
?>