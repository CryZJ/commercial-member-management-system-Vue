<?php
	require'../../../AHeader.php';
	require'../../../conn.php';
	require_once "../../../classes/CreateAnnualFee.php";
	
	/*增加日期的监控
	 * $date_start:日期或时间戳
	 * $y：变化的年数(-10,0,10,100.....)
	 * $m:	变化的月数（-12~12）
	 * $d：变化的天数（-15,15,20,30....)
	*/
	function Set_Date($date_start,$y,$m,$d){
		$str = $y."years,".$m."months,".$d."days";
		return date("Y-m-d",strtotime($str,strtotime($date_start)));
	}
	
	$flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : "";
	
//	$flag = 'ChanCaseMes';
	
	switch($flag){
		case 'yearfare':
			$year = $_REQUEST['year'];
			$count = $_REQUEST['count'];
			$type = $_REQUEST['type'];
			$data = array();
//			echo $year.'/'.$count.'/'.$type;
			//获取前六年的金额
			$sql3 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '".$count."' and 年度>='".$year."' limit 6 ";
			$result3 = $conn->query($sql3);
			if($result3->num_rows>0){
				$i = 1;
				while($row3 = $result3->fetch_assoc()){
					$data[$i]['fare'] = $row3['金额'];
					$data[$i]['year'] = $row3['年度'];
					$i++;
				}
			}
			$yearl = $year+6;//计算年度
			//获取六年之后的金额
			$sql4 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '100%' and 年度>='".$yearl."'";
			$result4 = $conn->query($sql4);
			if($result4->num_rows>0){
				$i = 7;
				while($row4 = $result4->fetch_assoc()){
					$data[$i]['fare'] = $row4['金额'];
					$data[$i]['year'] = $row4['年度'];
					$i++;
				}
			}
//			echo $sql3;
			$return_data = json_encode($data);
			echo $return_data;
			break;
			case 'savefile':
			//保存【案卷流程及文档】&&【专案_复审等】	
			$ajh = $_POST['ajh'];
//			print_r($_FILES);
			//1.通过$_FILES文件上传变量接收上传文件信息
			$fileInfo=$_FILES['upfile'];
			$filename=$fileInfo['name'];
			$type=$fileInfo['type'];
			$tmp_name=$fileInfo['tmp_name'];
			$size=$fileInfo['size'];
			$error=$fileInfo['error'];
			
			//2.保存文件到指定文件夹
			$path='../../../filesave_ZSDJ'; //中文拼音：证书登记【不客气】
			if(!file_exists($path)){
				mkdir($path,0777,true);
				chmod($path,0777);
			}
			$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
			//确保文件名唯一，防止重名产生覆盖
			list($t1, $t2) = explode(' ', microtime());
//			$uniName = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);  
		//	echo $uniName;
			$destination=$path.'/'.$ajh."_".$filename;
			$gbk_destination = iconv("utf-8", "gbk", $destination);
			if(@move_uploaded_file($fileInfo['tmp_name'],$gbk_destination)){
				$path_sqlsave = "filesave_ZSDJ/".$ajh."_".$filename;
//				echo '文件上传成功';
				//专案_复审等
				$SaveHis = "update `专案_年费` set 证书 = '".$path_sqlsave."' where `案卷号`='".$ajh."'";
				$conn->query($SaveHis);
				//专案_操作记录
				$SaveHis = "INSERT INTO `专案_操作记录`(案卷号,操作员,操作名,记录时间,其他) ";
				$SaveHis .="VALUES('".$ajh."','".$name."','证书导入','".date('Y-m-d H:i:s')."','上传了证书')";
				$conn->query($SaveHis);
				//案卷流程及文档
				$SaveHis = "INSERT INTO `专案_年费文件`(上传时间,上传人,文件路径,通知书名称,案卷号) ";
				$SaveHis .="VALUES('".date('Y-m-d H:i:s')."','".$name."','".$path_sqlsave."','证书','".$ajh."')";
				$conn->query($SaveHis);
				echo 1;
			}else{
//				echo '文件上传失败';
				echo 0;
			}
		break;
		case 'SaveFare':
			$DataLen = $_POST['DataLen'];//长度
			$ArrFare = $_POST['ArrFare'];//费用信息
			$ajh = $_POST['ajh'];//案卷号
			
			for($i=0;$i<$DataLen;$i++){
				$FareSave = "INSERT INTO `专案_年费记录`(案卷号,年度,金额,提醒日期,应缴日期) ";
				$FareSave .= "VALUES('".$ajh."','".$ArrFare[$i]['Year']."','".$ArrFare[$i]['Fare']."','".$ArrFare[$i]['DateB']."','".$ArrFare[$i]['DateE']."')";
				$resultFare = $conn->query($FareSave);
				$end_time = $ArrFare[$i]['DateB'];
				if($resultFare){
					for($y=0;$y<5;$y++){
						$kry = 'ODL'.$y;
						$star_time =  date("Y-m-d",strtotime("1days",strtotime($end_time)));
						$end_time = date("Y-m-d",strtotime("30days",strtotime($star_time)));
						$sql2 = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
						$sql2 .= "'".$ajh."','".$ArrFare[$i]['Year']."','".($y+1)."','".$ArrFare[$i][$kry]."','".$star_time."','".$end_time."')";
						$result2 = $conn->query($sql2);
					}
				}
			}
			if($resultFare){
				//专案_操作记录
				$SaveHis = "INSERT INTO `专案_操作记录`(案卷号,操作员,操作名,记录时间,其他) ";
				$SaveHis .="VALUES('".$ajh."','".$name."','生成年费','".date('Y-m-d H:i:s')."','')";
				$conn->query($SaveHis);
				echo 1;
			}else{
				echo 0;
			}
		break;
        case 'ChanCaseMes':
            $Mes = $_POST['Mes'];//数据
            $Text = $_POST['Text'];//位置
            $ajhT = $_POST['ajhT'];//案卷号
            
			$retarr = array(
				"state" => FALSE,
				"message" => "服务器错误"
			);
			switch($Text){
				case "申请人":
					$sqrAL = '';
	                $sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$Mes."')";
	                $result8 = $conn->query($sql8);
	                if($result8 ->num_rows>0){
	                    while($row8 = $result8->fetch_assoc()){
	                        $sqrAL = $row8["申请人"];
	                    }
						$sql = "update 专案_年费 set 申请人id='".$Mes."' , 申请人='".$sqrAL."'  where 案卷号='".$ajhT."' ";
						if($conn->query($sql)){
							$retarr["state"] = TRUE;
							$retarr["message"] = "保存成功";
						}else{
							$retarr["message"] = "服务器错误";
						}
	                }else{
	                	$retarr["message"] = "申请人不存在";
	                }
					break;
				case "原案卷号":
					$sql = "UPDATE 专案_年费 SET 原案卷号='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "专利名称":
					$sql = "UPDATE 专案_年费 SET 专利名称='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "案源人":
					$sql = "UPDATE 专案_年费 SET 案源人='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "代理人":
					$sql = "UPDATE 专案_年费 SET 代理人='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "申请日":
					$sql = "UPDATE 专案_年费 SET 申请日='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
						
						//根据案卷号获取生成年费相关的信息：申请日、首年度、年费费减比、案件类型
						$case_info = array("申请日"=>"","首年度"=>"","费减比例"=>"","类型"=>"");
						$sql = "SELECT 申请日,首年度,费减比例,类型 FROM `专案_年费` WHERE `案卷号`='".$ajhT."'";
						$result = $conn->query($sql);
						if($result->num_rows > 0){
							while($row = $result->fetch_row()){
								$case_info["申请日"] = $row[0];
								$case_info["首年度"] = $row[1];
								$case_info["费减比例"] = $row[2];
								$case_info["类型"] = $row[3];
							}
							//根据案件相关信息生成年费记录
							$annualfee = new CreateAnnualFee($conn,$case_info["申请日"],$case_info["首年度"],$case_info["费减比例"],$case_info["类型"]);
							$redata = $annualfee->GetAnnualFeeDate();
							
							//根据案卷号查询该案件的年费情况
							$yearnum_retsave = array();
							$sql = "SELECT id,年度,状态 FROM `专案_年费记录` WHERE `案卷号`='".$ajhT."' AND (状态='0' OR 状态='8' OR 状态='1' OR 状态='4')";
							$result = $conn->query($sql);
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){
									$yearnum_retsave[] = $row["年度"];
									//删除滞纳金
									$sql_d = "DELETE FROM 滞纳金列表 WHERE 案卷号='".$ajhT."' AND 年度='".$row["年度"]."'";
									$conn->query($sql_d);
									//删除年费记录
									$sql_d = "DELETE FROM 专案_年费记录 WHERE id='".$row["id"]."'";
									$conn->query($sql_d);
								}
								//重建年费记录
								foreach($redata as $index => $datainfo){
									if(in_array($datainfo["年度"], $yearnum_retsave)){
										//保存年费记录
										$sql_s = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,状态) VALUES(";
										$sql_s .= "'".$ajhT."','".$datainfo["年度"]."','".$datainfo["金额"]."','".$datainfo["提醒日期"]."','".$datainfo["截止日期"]."','0')";
										$conn->query($sql_s);
										//保存滞纳金记录 Set_Date($date_start,$y,$m,$d){
										foreach($datainfo["滞纳金"] as $index2 => $znj){
											$sql_z = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
											$sql_z .= "'".$ajhT."','".$datainfo["年度"]."','".(intval($index2)+1)."','".$znj."','".Set_Date($datainfo["截止日期"],0,intval($index2),0)."','".Set_Date($datainfo["截止日期"],0,(intval($index2)+1),0)."')";
											$conn->query($sql_z);
										}
									}
								}
								
								$retarr["message"] .= ",年费已重新生";
							}
						}else{
							$retarr["message"] .= ",无年费记录无法生成";
						}
						
						
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				default:
					$retarr["message"] = "没有对应的标志";
					break;
			}
			$json = json_encode($retarr);
			echo $json;
        break;
		
		default:break;
	}
?>