<?php
	require'../../AHeader.php';
	require'../../conn.php';
	require_once "../../classes/CheckCostOther.php";
	
	//判断二维数组中申请人是否已存在
	function JudgeApplicantexist($arr,$applicant){
		foreach($arr as $index => $datainfo){
			if(in_array($applicant, $datainfo)){
				return FALSE;
			}
		}
		return TRUE;
	}
	
	$flag = isset($_GET['flag']) ? $_GET['flag'] : "";
	
//	$flag = "";
	 
	switch($flag){
		case 'MonToInfo'://监控中变待通知
			$IdStr = $_GET['id'];
			if(strstr($IdStr,'|')){
				$IdArr = explode('|',$IdStr);
				foreach($IdArr as $id){
					$sql = "update 专案需交费用  set 状态=8 where id = '".$id."' ";
					$result = $conn->query($sql);
				}
				unset ($id);
			}else{
				$sql = "update 专案需交费用  set 状态=8 where id = '".$IdStr."' ";
				$result = $conn->query($sql);
			}
			
			//如果操作成功
			if(isset($result)){
				echo '操作成功';
				return ;
			}
			//否则
			echo '操作失败';
			return ;
			break;
		case 'SendInfo'://待通知变待缴费
			$IdStr = $_GET['id'];
//			$MesArr = ;
			if(strstr($IdStr,'|')){
				$IdArr = explode('|',$IdStr);
				$DateNum = 0;
				$SQRMes = array();//创建数组，构成返回值
				//选择多于一个费用时
				foreach($IdArr as $id){
					$sql = "update 专案需交费用  set 状态=1,通知时间='".date("Y-m-d")."' where id = '".$id."' ";
					$result = $conn->query($sql);
					//获取案卷号
					$sql2 = "select 申请人id,费用名称,a.案卷号 from 专案需交费用 a,`专利信息` b where a.id = '".$id."' and a.`案卷号`=b.`案卷号`";
					$result2 = $conn->query($sql2);
					
					if($result2->num_rows>0){
						
						while($row2 = $result2->fetch_assoc()){
							$FareName = $row2['费用名称'];
							if($FareName == '年费'){
								$SQRID = $row2['申请人id'];
								$FareAjh = $row2['案卷号'];
								//只有一个申请人
								if(strpos($SQRID,',')===false){
//								    echo '不存在两个申请人！';
									if(array_key_exists($SQRID,$SQRMes)){
//										echo '申请人重复';
										$Ajh = $SQRMes[$SQRID];//获取原有的值
										$Ajh = $Ajh.','.$FareAjh;
										$SQRMes[$SQRID] = $Ajh;
									}
									else{
//										echo '申请人不重复';
										$SQRMes[$SQRID] = $FareAjh;
										$DateNum++;
									}
								}
								//多于一个申请人
								else{
//								    echo '存在两个或以上申请人！'
									$sqrArr = explode(',',$SQRID);
								    //如果申请人重复
									if(array_key_exists($sqrArr[0],$SQRMes)){
										$Ajh = $SQRMes[$sqrArr[0]];//获取原有的值
										$Ajh = $Ajh.','.$FareAjh;
										$SQRMes[$sqrArr[0]] = $Ajh;
									}
									//如果申请人不重复
									else{
										$SQRMes[$sqrArr[0]] = $FareAjh;
										$DateNum++;
									}
								}
							}
						}
					}
					if($DateNum){
						
						$MesArr = array('result'=>'success','dataNum'=>$DateNum,'AjhMes'=>$SQRMes);
					}else{
						$MesArr = array('result'=>'failure','dataNum'=>'0');
					}
				}
				unset ($id);
			}else{
				//只选择了一个费用时
				$sql = "update 专案需交费用  set 状态=1,通知时间='".date("Y-m-d")."' where id = '".$IdStr."' ";
				$conn->query($sql);
				//获取案卷号
					$sql2 = "select 申请人id,费用名称,a.案卷号 from 专案需交费用 a,`专利信息` b where a.id = '".$IdStr."' and a.`案卷号`=b.`案卷号`";
					$result2 = $conn->query($sql2);
					if($result2->num_rows>0){
						while($row2 = $result2->fetch_assoc()){
							if($row2['费用名称'] == '申请费'){
								//如果选中一个费用，且此费用是申请费，返回对应案卷号
								$SQRMes = array($row2['申请人id']=>$row2['案卷号']);
								$MesArr = array('result'=>'success','dataNum'=>'1','AjhMes'=>$SQRMes);
							}else{
								//否则返回0，弹出费用状态已变为待缴费
								$MesArr = array('result'=>'failure','dataNum'=>'0');
							}
						}
					}
			}
//			print_r($MesArr);
			$Json_data = json_encode($MesArr);
			echo $Json_data;
//			如果操作成功
//			if(isset($result)){
//				echo '操作成功';
//				return ;
//			}
//			//否则
//			echo '操作失败';
//			return;
			break;
		case 'SendMes':
			$ajh = $_GET['ajh'];
//			新 echo $ajh;  05052aD1aD,05062aD1aD
//          原 echo $id;// 05052aD1aD/50/0//05061aD1aD/50/0//05062aD1aD/50/0
			$arrm = explode(',',$ajh);
			$numr = count($arrm);
			$sqrn="";
			$sqrid='';
			$sqrstr='';//初始化
			for($i=0;$i<$numr;$i++){
//				$strm = explode('/',$arrm[$i]);
				require'../../conn.php';
				$sqln = "SELECT 申请人,申请人id from 专利信息  where  案卷号='".$arrm[$i]."' ";
				$resultn=$conn->query($sqln);
				if($resultn->num_rows > 0){
			        while($rown = $resultn->fetch_assoc()){
			        	$SQRID = $rown['申请人id'];//判断是不是有逗号分开，即有两个或者以上的申请人
			        	if(strpos($SQRID,',')){//处理两个以上的申请人信息
			        		$sqrID = explode(',',$SQRID);
			        		$sqrlen = count($sqrID);
			        		for($y = 0;$y<$sqrlen;$y++){
			        			if(strpos($sqrstr,$sqrID[$y])){//如果有相同的申请人id
			        			}else{//如果没有相同的申请人id
			        				$sqrstr=$sqrstr.','.$sqrID[$y];
			        			}
			        		}
			        	}else{//处理只有一个申请人的情况
			        		if(strpos($sqrstr,$SQRID)){//如果有相同的申请人id
		        			}else{//如果没有相同的申请人id
		        				$sqrstr=$sqrstr.','.$SQRID;
		        			}
			        	}
					}
				}
			}
			$sqrstr = substr($sqrstr,1);
			$sqrid = $sqrstr;
			//获取申请人
			$sqrnm = explode(',',$sqrstr);
			$lensqr = count($sqrnm);
			for($z = 0;$z<$lensqr;$z++){
				if($sqrnm[$z] != ""){
					$sqlSQR = "select 申请人 from 申请人 where id='".$sqrnm[$z]."' LIMIT 1";
					$resultSQR = $conn->query($sqlSQR);
					if($resultSQR->num_rows>0){
						while($rowSQR = $resultSQR->fetch_assoc()){
							if(!strpos($sqrn, $rowSQR['申请人'])){
								$sqrn=$sqrn.','.$rowSQR['申请人'];
							}
						}
					}
				}
			}
			$sqrn=substr($sqrn,1,strlen($sqrn));
			echo $sqrid.'/'.$sqrn;//申请人id/申请人名
			break;
		case 'ShowFare':
			//返回专利名，申请日，申请号，登记费，年费
			$ajh = $_GET['ajh'];
			$ArrMes = array();
			$i=0;
			if(strstr($ajh,',')){
				$AjhArr = explode(',',$ajh);
				foreach($AjhArr as $ajhT){
//					$sql = "SELECT * from 专案待缴费 where 案卷号='".$ajhT."' and  (`费用名称`= '申请费' or `费用名称`= '印花费' or `费用名称`= '公告印刷费' or `费用名称`= '登记费' or `费用名称`= '公布印刷费' or `费用名称` = '年费')";
					$sql = "SELECT * from 专案待缴费 where 案卷号='".$ajhT."' and  (`费用名称`= '申请费' or `费用名称`= '印花费' or `费用名称`= '公布印刷费' or `费用名称` = '年费')";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						$remarkf=0;$yearf=0;$dlf=0;
		    			while($row = $result->fetch_assoc()){
//							if($row["费用名称"]=='印花费'||$row["费用名称"]=='公告印刷费'||$row["费用名称"]=='登记费'){
							if($row["费用名称"]=='印花费'){
		    					$remarkf = $remarkf + $row["金额"];
		    				}else if($row["费用名称"]=='年费'){
		    					$yearf	 = $row["金额"];
		    				}
		    				$sqh = $row["申请号"];
		        			$sqd = $row["申请日"];
		        			$zlm = $row["专利名称"];
						}
					}	
					$ArrMes[$i]["申请号"] = $sqh;
        			$ArrMes[$i]["申请日"] = $sqd;
        			$ArrMes[$i]["专利名称"] = $zlm;
        			$ArrMes[$i]["登记费"] = $remarkf;
        			$ArrMes[$i]["年费"] = $yearf;
        			$i++;
				}
				unset ($ajhT);
			}else{
				$sql = "SELECT * from 专案待缴费  where 案卷号='".$ajh."' and  (`费用名称`= '申请费' or `费用名称`= '印花费' or `费用名称`= '公告印刷费' or `费用名称`= '登记费' or `费用名称`= '公布印刷费' or `费用名称` = '年费')";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					$remarkf=0;$yearf=0;$dlf=0;
	    			while($row = $result->fetch_assoc()){
						if($row["费用名称"]=='印花费'||$row["费用名称"]=='公告印刷费'||$row["费用名称"]=='登记费'){
	    					$remarkf = $remarkf + $row["金额"];
	    				}else if($row["费用名称"]=='年费'){
	    					$yearf	 = $row["金额"];
	    				}
	    				$sqh = $row["申请号"];
	        			$sqd = $row["申请日"];
	        			$zlm = $row["专利名称"];
					}
					$ArrMes[$i]["申请号"] = $sqh;
        			$ArrMes[$i]["申请日"] = $sqd;
        			$ArrMes[$i]["专利名称"] = $zlm;
        			$ArrMes[$i]["登记费"] = $remarkf;
        			$ArrMes[$i]["年费"] = $yearf;
				}
			}
//			print_r ($ArrMes);
			$return_data = json_encode($ArrMes);
			echo $return_data;
			break;
		
		case "Notice_authorization":
			
			//验证身份是否是“流程操作员”
			if(!$lcczy == "1"){
				$ret_arr = array(
					"state"=>FALSE,
					"message"=>"您没有权限操作",
					"data"=>array()
				);
				$json = json_encode($ret_arr);
				echo $json;
				exit();
			}
			
			$id_str = $_GET["id"];
			
			$ret_arr = array(
				"state"=>FALSE,
				"message"=>"服务器错误",
				"data"=>array()
			);
			
			$sql = "SELECT id,案卷号,费用名称,金额,年度 FROM 专案需交费用 WHERE FIND_IN_SET(id,'".$id_str."')";
			$getdata = new CheckCostOther($conn,$sql);
			$getdata->UsingClass();
			if($getdata->sqldata_count > 0){
				$applicant_arr = array();//申请人名称及id
				//获取申请人信信息
				foreach($getdata->sqldata_return as $index => $datainfo){
					if(JudgeApplicantexist($applicant_arr,$datainfo["申请人"])){
						$applicant_arr[$datainfo["申请人id"]]["申请人"] = $datainfo["申请人"];
						$applicant_arr[$datainfo["申请人id"]]["申请人id"] = $datainfo["申请人id"];
					}
				}
				//获取费用信息的id
				foreach($getdata->sqldata_return as $index => $datainfo){
					$applicant_arr[$datainfo["申请人id"]]["costid"] .= ",".$datainfo["id"];
				}
				//去掉id的连接符,再装载
				$i = 0;
				foreach($applicant_arr as $index => $datainfo){
					$applicant_arr[$index]["costid"] = substr($datainfo["costid"], 1);
					
					$ret_arr["data"][$i] = $applicant_arr[$index];
					$i++;
				}
				if(count($ret_arr["data"]) > 0){
					$ret_arr["state"] = TRUE;
					$ret_arr["message"] = "获取成功";
				}else{
					$ret_arr["message"] = "查询不到数据";
				}
			}else{
				$ret_arr["message"] = "查询不到数据";
			}
			$json = json_encode($ret_arr);
			echo $json;
			break;	
			
		default:echo '非法操作';break ;
	}
?>