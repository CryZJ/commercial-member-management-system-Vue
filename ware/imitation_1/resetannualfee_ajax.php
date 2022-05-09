<?php
	require'../../AHeader.php'; 
	require'../../conn.php';
	require_once "../../classes/CreateAnnualFee.php";
	
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
	
	$flag = isset($_REQUEST["flag"]) ? $_REQUEST["flag"] : "";
	
	switch($flag){
		case "CreateAnnualFeeList" ://生成年费列表
			//接收数据
			$postdata = array(
				"caseType"=>isset($_POST["caseType"]) ? $_POST["caseType"] : "",//案件类型
				"applicationDate"=>isset($_POST["applicationDate"]) ? $_POST["applicationDate"] : "",//申请日
				"reductionRatio"=>isset($_POST["reductionRatio"]) ? $_POST["reductionRatio"] : "",//年费费减比例
				"firstYear"=>isset($_POST["firstYear"]) ? $_POST["firstYear"] : ""//年费首年度
			);
			//返回信息
			$ret_data = array(
				"state"=>TRUE,
				"message"=>"获取成功",
				"data"=>array()
			);
			
			//根据案件相关信息生成年费记录
			$annualfee = new CreateAnnualFee($conn,$postdata["applicationDate"],$postdata["firstYear"],$postdata["reductionRatio"],$postdata["caseType"]);
			$redata = $annualfee->GetAnnualFeeDate();
			$ret_data["data"] = $redata;
			
			$json = json_encode($ret_data);
			echo $json;
			break;
		
		case "SaveData" ://保存数据
			//接收数据
			$postdata = array(
				"tabflag"=>isset($_POST["tabflag"]) ? $_POST["tabflag"] : "",//表标志
				"caseNumber"=>isset($_POST["caseNumber"]) ? $_POST["caseNumber"] : "",//案卷号
				"applicationDate"=>isset($_POST["applicationDate"]) ? $_POST["applicationDate"] : "",//申请日
				"reductionRatio"=>isset($_POST["reductionRatio"]) ? $_POST["reductionRatio"] : "",//年费费减比例
				"firstYear"=>isset($_POST["firstYear"]) ? $_POST["firstYear"] : ""//年费首年度
			);
			$annualfeedata = isset($_POST["annualfee"]) ? $_POST["annualfee"] : "";//年费信息
			
			//返回信息
			$ret_data = array(
				"state"=>TRUE,
				"message"=>""
			);
			
			//区分三个表：【专利信息】【专案_年费】【专案_复审等】
			switch($postdata["tabflag"]){
				case "zlxx" ://表【专利信息】
					$sql = "UPDATE 专利信息 SET 申请日='".$postdata["applicationDate"]."',年费费减比例='".$postdata["reductionRatio"]."',年费首年度='".$postdata["firstYear"]."' WHERE 案卷号='".$postdata["caseNumber"]."'";
					break;
				case "zanf" ://表【专案_年费】
					$sql = "UPDATE 专案_年费 SET 申请日='".$postdata["applicationDate"]."',费减比例='".$postdata["reductionRatio"]."',首年度='".$postdata["firstYear"]."' WHERE 案卷号='".$postdata["caseNumber"]."'";
					break;
				case "zafsd" ://表【专案_复审等】
					$sql = "UPDATE 专案_复审等 SET 申请日='".$postdata["applicationDate"]."',费减比例='".$postdata["reductionRatio"]."' WHERE 案卷号='".$postdata["caseNumber"]."'";
					break;
				default :
					$sql = "";
			}
			if(!empty($sql)){
				if($conn->query($sql)){
					$ret_data["message"] = "申请日，费减比例，年费首年度保存成功；";
					//保存年费信息【专案_年费记录】
					//根据案卷号查询该案件的年费情况
					$yearnum_retsave = array();
					$sql = "SELECT id,年度,状态 FROM `专案_年费记录` WHERE `案卷号`='".$postdata["caseNumber"]."' AND (状态='0' OR 状态='8' OR 状态='1' OR 状态='4')";
					$result_2 = $conn->query($sql);
					if($result_2->num_rows > 0){
						while($row = $result_2->fetch_assoc()){
							$yearnum_retsave[] = $row["年度"];
							//删除滞纳金
							$sql_d = "DELETE FROM 滞纳金列表 WHERE 案卷号='".$postdata["caseNumber"]."' AND 年度='".$row["年度"]."'";
							$conn->query($sql_d);
							//删除年费记录
							$sql_d = "DELETE FROM 专案_年费记录 WHERE id='".$row["id"]."'";
							$conn->query($sql_d);
						}
						//重建年费记录
						foreach($annualfeedata as $index => $datainfo){
							if(in_array($datainfo["年度"], $yearnum_retsave)){
								//保存年费记录
								$sql_s = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,状态) VALUES(";
								$sql_s .= "'".$postdata["caseNumber"]."','".$datainfo["年度"]."','".$datainfo["金额"]."','".$datainfo["提醒日期"]."','".$datainfo["截止日期"]."','0')";
								$conn->query($sql_s);
								//保存滞纳金记录 Set_Date($date_start,$y,$m,$d)
								foreach($datainfo["滞纳金"] as $index2 => $znj){
									$sql_z = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
									$sql_z .= "'".$postdata["caseNumber"]."','".$datainfo["年度"]."','".(intval($index2)+1)."','".$znj."','".Set_Date($datainfo["截止日期"],0,intval($index2),0)."','".Set_Date($datainfo["截止日期"],0,(intval($index2)+1),0)."')";
									$conn->query($sql_z);
								}
							}
						}
						$ret_data["message"] .= ",年费已重新生";
					}else{
						$ret_data["message"] .= ",年费记录不存在，没有需要重新生成的年费。";
					}
				}else{
					$ret_data["message"] = "申请日，费减比例，年费首年度保存失败-SQL语句执行失败；";
				}
			}else{
				$ret_data["message"] = "申请日，费减比例，年费首年度保存失败-SQL语句为空；";
			}
			
			$json = json_encode($ret_data);
			echo $json;
			break;
		
		default :
			$ret_data = array(
				"state"=>FALSE,
				"message"=>"没有对应的标志"
			);
			$json = json_encode($ret_data);
			echo $json;
			exit($json);
	}
	
?>