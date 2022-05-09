	<?php require'AHeader.php'; ?>
<?php
	$falg = $_REQUEST['falg'];
//	$falg = 'text';
	function findNum($str){
		$str=trim($str);
		if(empty($str)){return '';}
		$result='';
		for($i=0;$i<strlen($str);$i++){
			if(is_numeric($str[$i])){
				$result=$str[$i];
				return $result;
			}
		}
	}
	if($falg == 'savedata'){//如果是费用状态更新
		$mess = $_REQUEST['mess'];
		$YFare = $_REQUEST['YFare'];
		$ajh = $_REQUEST['ajh'];
		$date=date('Y-m-d');
		$y=0;
		
		require'conn.php';
		//更新专利需交费
			///////////判断是否有第一年年费
		if(strlen($mess)>0){
			if(strstr($mess,',')){
				$arr_mes = explode(',',$mess);
				for($i=0;$i<count($arr_mes);$i++){
					$strmes = explode('/',$arr_mes[$i]);
					if(strstr($strmes[0],'第一年年费')){
						$ND =1; //年度
						$strmes[0]='年费';
					}else{
						$ND =0; //年度
					}
					$sql3 = "insert into 专案需交费用(案卷号,费用名称,金额,提醒时间,缴费期限,年度,费用来源,状态) values('".$ajh."','".$strmes[0]."','".$strmes[1]."','".$strmes[2]."','".$strmes[3]."','".$ND."','0','4')";
					$result3 = $conn->query($sql3);
					$y++;
					//更新案件操作
                    $conn->query("INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','新建费用','".date("Y-m-d H:i:s")."','".$strmes[0].":".$strmes[1]."')");
				}
			}else{
				$strmes = explode('/',$mess);
				$sql3 = "insert into 专案需交费用(案卷号,费用名称,金额,提醒时间,缴费期限,费用来源,状态) values('".$ajh."','".$strmes[0]."','".$strmes[1]."','".$strmes[2]."','".$strmes[3]."','0','4')";
				$result3 = $conn->query($sql3);
				$y++;
				//更新案件操作
                $conn->query("INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','新建费用','".date("Y-m-d H:i:s")."','".$strmes[0].":".$strmes[1]."')");
			}
		}
		
		//更新专案_年费记录
		if(strlen($YFare)>0){
			if(strstr($YFare,',')){
				$arr_YF = explode(',',$YFare);
				for($i=0;$i<count($arr_YF);$i++){
					$strmesB = explode('/',$arr_YF[$i]);
					preg_match_all('/\d+/',$strmesB[0],$arr);
                    $YNum = $arr[0][0];
					$sql4 = "insert into 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,修改人,修改时间) values('".$ajh."','".$YNum."','".$strmesB[1]."','".$strmesB[2]."','".$strmesB[3]."','".$userid."','".$date."')";
//                  echo $sql4;
					$result4 = $conn->query($sql4);
					$y++;
					//更新案件操作
                    $conn->query("INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','新建费用','".date("Y-m-d H:i:s")."','".$strmesB[0].":".$strmesB[1]."')");
				}
			}else{
				$strmesB = explode('/',$YFare);
				preg_match_all('/\d+/',$strmesB[0],$arr);
                $YNum = $arr[0][0];
				$sql4 = "insert into 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,修改人,修改时间) values('".$ajh."','".$YNum."','".$strmesB[1]."','".$strmesB[2]."','".$strmesB[3]."','".$userid."','".$date."')";
				$result4 = $conn->query($sql4);
				$y++;
				//更新案件操作
				$conn->query("INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','新建费用','".date("Y-m-d H:i:s")."','".$strmesB[0].":".$strmesB[1]."')");
			}
		}
		
		if(1){
			echo $y;
		}else{
			echo 0;
		}
	}
	else if($falg == 'CheMes'){
		$oYFCount = $_GET['oYFCount'];
		$FareName = $_GET['FareName'];
		$Fare = '';
		if(strpos($FareName,"年费")){
			preg_match_all('/\d+/',$FareName,$arr);
			$Year = $arr[0][0];
//			echo $Year;
			$Type = substr($FareName,0,12);
			$sql = "select 金额 from 年费设置 where 费减比 = '".$oYFCount."' and 专利类型 = '".$Type."' and 年度 = '".$Year."'";
		}else{
			$sql = "select 金额 from 费用名参看 where 费用名='".$FareName."'";
		}
		require'conn.php';
//		echo $sql;
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$Fare = $row['金额'];
			}
		}
//		echo strlen($FareName);
		echo $Fare;
		$conn->close();
	}
	else{
		echo "<script type='text/javascript' >alert('出现未知错误请联系系统开发者');</script>";
		exit;
	}
?>