<?php

	require'../../../AHeader.php';
	require'../../../conn.php';
	require"../../../classes/CreateAnnualFee.php";
	
	
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
	
	switch($flag){
		case 'casesave':
			$CaseType = $_GET['CaseType'];
			$ayr = $_GET['ayr'];
			$dlr = $_GET['dlr'];
			$alx = $_GET['alx'];
			$ajh = $_GET['ajh'];
			$amc = $_GET['amc'];
			$sqh = $_GET['sqh'];
			$sqr = $_GET['sqr'];
			$sqPId = $_GET['sqPId'];
			$CaseBz = $_GET['CaseBz'];
			$OAjh = $_GET['OAjh'];
//			echo $CaseType.'/'.$ayr.'/'.$dlr.'/'.$alx.'/'.$ajh.'/'.$amc.'/'.$sqh.'/'.$sqr.'/'.$sqPId.'/'.$CaseBz;
			//删除之前的案卷号
			$sql_del = "delete from `专案_复审等` where 状态='9' and 案卷号='".$ajh."'";
			$result_del = $conn->query($sql_del);
			//判断申请号
			$sql9 = "select * from 专案_复审等 where 申请号='".$sqh."'";
			$result9 = $conn->query($sql9);
			$sql10 = "select * from 专利信息 where 申请号='".$sqh."'";
			$result10 = $conn->query($sql10);
			$sql11 = "select * from 专案_年费 where 申请号='".$sqh."'";
			$result11 = $conn->query($sql11);
			$count1 = 0;			
			$count1 = $result9 ->num_rows;
			$count1 = $count1+$result10 ->num_rows;
			$count1 = $count1+$result11 ->num_rows;
			if($count1>0){
				echo '申请号重复';
				die();
			}
			//创建信息
			$sqrname = "";
			$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$sqPId."')";
			$result8 = $conn->query($sql8);
			if($result8 ->num_rows>0){
				while($row8 = $result8->fetch_assoc()){
					$sqrname = $row8["申请人"];
				}
			}
			$sql = "insert into 专案_复审等 (案件类型,案源人,代理人,类型,案卷号,专利名称,申请号,申请日,申请人,申请人id,备注,创建人,创建时间,原案卷号) ";
			$sql = $sql."values('".$CaseType."','".$ayr."','".$dlr."','".$alx."','".$ajh."','".$amc."','".$sqh."','".$sqr."','".$sqrname."','".$sqPId."','".$CaseBz."','".$name."','".date('Y-m-d H:i:s')."','".$OAjh."')";
			$result = $conn->query($sql);
			if($result){
				$sqlC = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','案件新建','".$name."','".date("Y-m-d H:i:s")."','".$CaseBz."')";
				$resultC = $conn->query($sqlC);
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
                $sql_view = "insert into `专案_可见`(案卷号,ctype,创建时间,创建人,案源可见id,案源可见人,案源代理id,代理可见id,代理可见人,代理代理id) ";
                $sql_view.= " values('".$ajh."','2','".date("Y-m-d H:i:s")."','".$name."','".$ayrid."','".$ayr."','".$ayrsonid."','".$dlrid."','".$dlr."','".$dlrsonid."')";
//              $result_view = $conn->query($sql_view);
				echo '操作成功';
			}else{
//				echo $sql;
				echo '操作失败';
			}
			break;
		case 'save_bz':
			$str_ajh = $_GET['str_ajh'];
			$str_bz = $_GET['str_bz'];
			$sql = "UPDATE 专案_复审等  SET 备注='".$str_bz."' WHERE 案卷号='".$str_ajh."'";
			$result = $conn->query($sql);
			$sqlC = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$str_ajh."','修改备注','".$name."','".date("Y-m-d H:i:s")."','".$str_bz."')";
			$resultC = $conn->query($sqlC);
			if($conn->query($sql)){
				echo "保存成功！";
			}else{
				echo "保存失败！";
			}
			break;
		case 'upfile_Else':
			require_once "../../../upload_func.php"; //使用函数uploadFile_rj
			$ajh = $_POST['ajh'];
	//		echo $ajh."\n".$name."\n";
	//		print_r($_FILES);
			$ret_mag = "";
			if(isset($ajh)){
				$sql_s = "SELECT id FROM 专案_复审等 WHERE 案卷号='".$ajh."'";
				$result_s = $conn->query($sql_s);
				if($result_s->num_rows>0){
					$save_path = "../../../filesave_ZLElse"."/".$ajh;
					foreach($_FILES as $num =>$fileinfo){
						$ret_path = uploadFile_Else($fileinfo,$save_path);
						$filename_arr = explode("/", $ret_path['dest']);//basename()
						$file_name = $filename_arr[count($filename_arr)-1];
						$sql_savepath = "filesave_ZLElse/".$ajh."/".$file_name;
						$sql_i = "INSERT INTO 案卷流程及文档(案卷号,处理人,时间,文件路径,流程) VALUES(";
						$sql_i .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$sql_savepath."','')";
						if($conn->query($sql_i)){
							$ret_mag .= $file_name."保存成功！\n";
							$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','文件上传','".$name."','".date("Y-m-d H:i:s")."','".$file_name."')";
							$result_his = $conn->query($sql_his);
						}else{
							$ret_mag .= $file_name."保存失败！\n";
						}
					}
				}else{
					$ret_mag .= "“专案其他案件”中没有案卷号为".$ajh."的案件！\n";
				}
			}
			echo $ret_mag;
			break;
		case 'DelFile':
			$id = $_GET['id'];
			$sql = "update 案卷流程及文档  set 删除状态=1 where id = '".$id."'";
			$result = $conn->query($sql);
			
			if($result){
				$SQL_SEl = "select 案卷号,文件路径 from 案卷流程及文档 where id='".$id."'";
				$result_SEL = $conn->query($SQL_SEl);
				$ajh = $CheName = '';
				if($result_SEL ->num_rows>0){
					while($row_SEL=$result_SEL->fetch_assoc()){
						$ajh = $row_SEL['案卷号'];
						$CheName = $row_SEL['文件路径'];
					}
				}
				$CheNameArr = explode('/',$CheName);
				$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','删除文件','".$name."','".date("Y-m-d H:i:s")."','".$CheNameArr[2]."')";
				$result_his = $conn->query($sql_his);
				echo 3;
			}
			break;
		case 'new_monitor':
			$ajh = $_GET['ajh'];
			$send_str = $_GET['send_str'];//格式:监控名|金额|提醒日期|截止日期|备注
	//		echo $ajh ."/" .$send_str;
			$ret_mag = "";
			//检测案件是否存在
			if(isset($ajh)){
				$sql_s = "SELECT id FROM 专案_复审等 WHERE 案卷号='".$ajh."'";
				$result_s = $conn->query($sql_s);
				if($result_s->num_rows>0){
					$send_arr = explode("|", $send_str);
					$sql_i = "INSERT INTO 专案_监控(案卷号,监控名,金额,提醒日期,截止日期,备注) VALUES(";
					$sql_i .= "'".$ajh."','".$send_arr[0]."','".$send_arr[1]."','".$send_arr[2]."','".$send_arr[3]."','".$send_arr[4]."')";
					if($conn->query($sql_i)){
						$ret_mag = "保存成功";
						$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','新建监控','".$name."','".date("Y-m-d H:i:s")."','".$send_arr[0]."')";
						$result_his = $conn->query($sql_his);
					}else{
						$ret_mag = "保存失败";
					}
				}else{
					$ret_mag = "没有案卷号为".$ajh."的案件";
				}
			}else{
				$ret_mag = "案卷号为空！";
			}
			echo $ret_mag;
			break;
		case 'new_monitor_upfile':
			require_once "../../../upload_func.php";
			$ajh = $_POST['ajh'];
	//		echo $ajh."\n";
	//		print_r($_FILES);
			$ret_mag = "";
			//检测案件是否存在
			if(isset($ajh)){
				$sql_s = "SELECT id FROM 专案_复审等 WHERE 案卷号='".$ajh."'";
				$result_s = $conn->query($sql_s);
				if($result_s->num_rows>0){
					$save_path = "../../../filesave_ZLElse/".$ajh;
					$ret_mag = uploadFile_rj($_FILES['myfile'],$save_path);
					$filename_arr = explode("/", $ret_mag['dest']);
					$file_name = $filename_arr[count($filename_arr)-1];
					$save_sqlpath = "filesave_ZLElse/".$ajh."/".$file_name;
					$sql_i = "INSERT INTO 案卷流程及文档(案卷号,处理人,时间,文件路径) VALUES(";
					$sql_i .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$save_sqlpath."')";
					if($conn->query($sql_i)){
						$sql_s = "SELECT id FROM 案卷流程及文档  WHERE 案卷号='".$ajh."' ORDER BY id DESC LIMIT 1";
						$result_s = $conn->query($sql_s);
						if($result_s->num_rows>0){
							while($row_s = $result_s->fetch_assoc()){
								$file_id = $row_s['id'];
							}
							$sql_s2 = "SELECT id FROM 专案_监控  WHERE 案卷号='".$ajh."' ORDER BY id DESC LIMIT 1";
							$result_s2 = $conn->query($sql_s2);
							if($result_s2->num_rows>0){
								while($row_s2 = $result_s2->fetch_assoc()){
									$monitor_id = $row_s2['id'];
								}
								$sql_u = "UPDATE 专案_监控  SET 文件id = '".$file_id."' WHERE id='".$monitor_id."'";
								if($conn->query($sql_u)){
									$ret_mag = "保存成功";
								}else{
									$ret_mag = "保存失败";
								}
							}else{
								$ret_mag = "没有相应的监控";
							}
						}else{
							$ret_mag = "没有案卷号为".$ajh."的监控";
						}
					}else{
						$ret_mag = "文件保存失败";
					}
				}else{
					$ret_mag = "没有案卷号为".$ajh."的案件";
				}
			}else{
				$ret_mag = "案卷号为空！";
			}
			echo $ret_mag;
			break;
		case 'selectMes':
			$Name = $_GET['Name'];
			$sql = "SELECT 流程,金额,监控天数 FROM `案件流程设置` where 流程='".$Name ."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$fare = $row['金额'];
					$day  = $row['监控天数'];
				}
			}
			echo $fare.','.$day;
			break;
		case 'ChangeSitu':
			$MesId = $_GET['id'];
			$sql_C = "update 专案_监控  set 状态=1 where id = '".$MesId."' ";
			if($conn->query($sql_C)){
				$ret_mag = "操作成功";
				$SQL_SEl = "select 案卷号,监控名 from 专案_监控 where id='".$MesId."'";
				$result_SEL = $conn->query($SQL_SEl);
				$ajh = $CheName = '';
				if($result_SEL ->num_rows>0){
					while($row_SEL=$result_SEL->fetch_assoc()){
						$ajh = $row_SEL['案卷号'];
						$CheName = $row_SEL['监控名'];
					}
				}
				$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$ajh."','结束监控','".$name."','".date("Y-m-d H:i:s")."','".$CheName."')";
				$result_his = $conn->query($sql_his);
			}else{
				$ret_mag = "操作失败,请联系管理员";
			}
			echo $ret_mag;
			break;
		case 'Save_StatusType':
			$str_ajh = $_GET['str_ajh'];
			$stu_str = $_GET['stu_str'];
			$ret_msg = "";
			if($stu_str != "结案"){
				$sql = "UPDATE 专案_复审等 SET 状态='".$stu_str."',冻结状态='0' WHERE 案卷号='".$str_ajh."' ";
				if($conn->query($sql)){
					$ret_msg = "修改成功";
					$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$str_ajh."','更改案件状态','".$name."','".date("Y-m-d H:i:s")."','把案件状态更改为“".$stu_str."”')";
					$conn->query($sql_his);
				}else{
					$ret_msg = "修改失败";
				}
			}else{
				$sql = "UPDATE 专案_复审等 SET 冻结状态='1' WHERE 案卷号='".$str_ajh."' ";
				if($conn->query($sql)){
					$ret_msg = "修改成功";
					$sql_his = "insert into 专案_操作记录(案卷号,操作名,操作员,记录时间,其他) values('".$str_ajh."','更改案件状态','".$name."','".date("Y-m-d H:i:s")."','把案件状态更改为“".$stu_str."”')";
					$conn->query($sql_his);
				}else{
					$ret_msg = "修改失败";
				}
			}
			echo $ret_msg;
			break;
		case 'yearfare':
			$year = $_REQUEST['year'];//年度：[1~20]
			$count = $_REQUEST['count'];//费减比：70%,85%,100%
			$type = $_REQUEST['type'];//专利类型：发明，实用，外观
			$sqr = $_REQUEST["SQDate"];//申请日
//			echo "年度：".$year.",费减比例：".$count.",类型：".$type.",申请日：".$sqr;
			
			require_once "../../../classes/CreateAnnualFee.php";//连接生成年费的类
			$annualfee = new CreateAnnualFee($conn,$sqr,$year,$count,$type);//创建实例
			$redata = $annualfee->GetAnnualFeeDate();//获取年费数据
			
			$json = json_encode($redata);
			echo $json;
			
			/*
			$data = array();
			
			
//			echo $year.'/'.$count.'/'.$type;
			//获取前六年的金额
			$sql3 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '".$count."' and 年度>='".$year."' ORDER BY `年度`  limit 10 ";
			$result3 = $conn->query($sql3);
			if($result3->num_rows>0){
				$i = 1;
				while($row3 = $result3->fetch_assoc()){
					$data[$i]['fare'] = $row3['金额'];
					$data[$i]['year'] = $row3['年度'];
					$i++;
				}
			}
			$yearl = $year+10;//计算年度
			//获取六年之后的金额
			$sql4 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '100%' and 年度>='".$yearl."' OEDER BY `年度` ";
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
			*/
			break;
		case 'change':
			$ajh = $_POST['ajh'];
			$messc = $_POST['MessC'];
			$FId = $_POST['FId'];
			$date = date('Y-m-d H:i:s');
			//查找费用信息
			    //年费
			$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$FId."' and 案卷号='".$ajh."'";
			$result3 = $conn->query($sql3);
			if($result3->num_rows>0){
				while($row3 = $result3->fetch_assoc()){
					$fareid = $row3['id'];
					$FareName = $row3['费用名称'];
					$Fare = $row3['金额'];
				}
				//更改费用信息
                $sql2 = "update 专案_年费记录  set 金额='".$messc."',修改时间='".$date."',修改人='".$userid."'  where id='".$FId."' ";
                $result2 = $conn->query($sql2);
                if($result2){
                    //保存操作记录
                    $FareMes = $FareName.'('.$Fare.'->'.$messc.')';
                    $AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
                    $conn->query($AddHis);
                    echo '操作成功';
                }else{
                    echo '出现未知错误，请联系管理员';
                }
			}
			    //其他费用
			$sql3 = "SELECT id,费用名称,金额  FROM 专案需交费用 where id = '".$FId."' and 案卷号='".$ajh."'";
            $result3 = $conn->query($sql3);
            if($result3->num_rows>0){
                while($row3 = $result3->fetch_assoc()){
                    $fareid = $row3['id'];
                    $FareName = $row3['费用名称'];
                    $Fare = $row3['金额'];
                }
                //更改费用信息
                $sql2 = "update 专案需交费用  set 金额='".$messc."',系统确认时间='".$date."'  where id='".$FId."' ";
    			$result2 = $conn->query($sql2);
    			if($result2){
    				//保存操作记录
    				$FareMes = $FareName.'('.$Fare.'->'.$messc.')';
    				$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
    				$conn->query($AddHis);
    				echo '操作成功';
    			}else{
    				echo '出现未知错误，请联系管理员';
    			}
            }
			break;
		case 'del':
			$ajh = $_POST['ajh'];
			$id = $_POST['id'];
			
			//删改年费信息
			$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$id."' and 案卷号='".$ajh."'";
			$result3 = $conn->query($sql3);
			if($result3->num_rows>0){
				while($row3 = $result3->fetch_assoc()){
					$fareid = $row3['id'];
					$FareName = $row3['费用名称'];
					$Fare = $row3['金额'];
				}
				$sql4 = " update 专案_年费记录 set 状态 = 9 where id = '".$id."' ";
			    $result4 = $conn->query($sql4);
			}
			//删改其他信息
            $sql3 = "SELECT id,费用名称,金额  FROM 专案需交费用 where id = '".$id."' and 案卷号='".$ajh."'";
            $result3 = $conn->query($sql3);
            if($result3->num_rows>0){
                while($row3 = $result3->fetch_assoc()){
                    $fareid = $row3['id'];
                    $FareName = $row3['费用名称'];
                    $Fare = $row3['金额'];
                }
                $sql4 = " update 专案需交费用 set 状态 = 9 where id = '".$id."' ";
                $result4 = $conn->query($sql4);
            }
			//
			if($result4){
				$FareMes = $FareName.'('.$Fare.')';
				$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','删除费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
				$conn->query($AddHis);
				echo '操作成功';
			}else{
				echo '出现未知错误，请联系管理员';
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
						$sql = "update 专案_复审等 set 申请人id='".$Mes."' , 申请人='".$sqrAL."'  where 案卷号='".$ajhT."' ";
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
					$sql = "UPDATE 专案_复审等 SET 原案卷号='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "专利名称":
					$sql = "UPDATE 专案_复审等 SET 专利名称='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "案源人":
					$sql = "UPDATE 专案_复审等 SET 案源人='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "代理人":
					$sql = "UPDATE 专案_复审等 SET 代理人='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
				case "申请日":
					$sql = "UPDATE 专案_复审等 SET 申请日='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
						
						
						$firstyearnum = isset($_REQUEST["firstyear"]) ? $_REQUEST["firstyear"] : "1";//年费首年度
						//根据案卷号获取生成年费相关的信息：申请日、首年度、年费费减比、案件类型
						$case_info = array("申请日"=>"","首年度"=>$firstyearnum,"费减比例"=>"","类型"=>"");
						$sql = "SELECT 申请日,费减比例,类型 FROM `专案_复审等` WHERE `案卷号`='".$ajhT."'";
						$result = $conn->query($sql);
						if($result->num_rows > 0){
							while($row = $result->fetch_row()){
								$case_info["申请日"] = $row[0];
//								$case_info["首年度"] = $row[1];
								$case_info["费减比例"] = $row[1];
								$case_info["类型"] = $row[2];
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
				case "费减比例":
					$sql = "UPDATE 专案_复审等 SET 费减比例='".$Mes."' WHERE 案卷号='".$ajhT."'";
					if($conn->query($sql)){
						$retarr["state"] = TRUE;
						$retarr["message"] = "保存成功";
					}else{
						$retarr["message"] = "服务器错误";
					}
					break;
					
				default:
					break;
			}
			$json = json_encode($retarr);
			echo $json;
       		break;
		
		default:
			echo '{"state":"0","message":"非正常操作"}';
	}
	$conn->close();
?>