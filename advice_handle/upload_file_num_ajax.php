<?php

require("../conn.php");
require("upfile_more_func.php");
$my_flag = isset($_REQUEST['my_flag'])? $_REQUEST['my_flag'] : "";

/*
 * 查找字符串的前两位或三位是数字
 * */
function findNum($str){
    $str=trim($str);//去掉字符串的首尾的空格
    if(empty($str)){
    	return '';
	}else{
		$reg='/[0-9][0-9][0-9]?/';//匹配数字的正则表达式
		preg_match_all($reg,$str,$result);
		return $result[0][0];
	}
}
/*
 * 获取案件的状态*/
function Getcasestaus($zt,$djzt){
	$ret_msg = "";
			switch($djzt){
				case "1" :
					$ret_msg = "结案";
					break;
				case "2" :
					$ret_msg = "删除";
					break;
				default :
					$ret_msg = $zt;
			}
			return $ret_msg;
}


/*获取本日上传文件数量*/
if($my_flag == "获取本日文件数量"){
	//本日总的上传文件数量
	$sql = "select count(id) as 数量  from 临时文件 WHERE 上传情况 ='0' AND 上传时间='".date("Y-m-d")."'";
	$result = $conn->query($sql);
	$file_num='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$file_num = $row['数量'];
		}
	}
	//本日受理的上传文件数量：专利申请受理通知书,费用减缴审批通知书 or 专利申请受理通知书,缴纳申请费通知书 
	$sql = "select count(id) as 数量  from 临时文件 WHERE 上传情况 ='0'AND 上传时间='".date("Y-m-d")."' and (通知书编码='200101,200021' or 通知书编码='200101,200103') AND 案件存在='0' ";
	$result = $conn->query($sql);
	$filenum_sl='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$filenum_sl = $row['数量'];
		}
	}
	//本日授权的上传文件数量：办理登记手续通知书
	$sql = "select count(id) as 数量  from 临时文件 WHERE 上传情况 ='0' AND 上传时间='".date("Y-m-d")."' and 通知书编码='200602' AND 案件存在='0' ";
	$result = $conn->query($sql);
	$filenum_sq='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$filenum_sq = $row['数量'];
		} 
	}
	//本日缴费的上传文件数量：缴费通知书
	$sql = "select count(id) as 数量  from 临时文件 WHERE 上传情况 ='0' AND 上传时间='".date("Y-m-d")."' and 通知书编码='200701' AND 案件存在='0'";
	$result = $conn->query($sql);
	$filenum_jf='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$filenum_jf = $row['数量'];
		}
	}
	//本日权利终止的上传文件数量：专利权终止通知书
	$sql = "select count(id) as 数量  from 临时文件 WHERE 上传情况 ='0' AND 上传时间='".date("Y-m-d")."' and 通知书编码='200702' AND 案件存在='0'";
	$result = $conn->query($sql);
	$filenum_zz='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$filenum_zz = $row['数量'];
		}
	}
	//本日其他的上传文件数量：
	$sql = "select count(id) as 数量 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c; ";
	$result = $conn->query($sql);
	$filenum_qt='0';
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$filenum_qt = $row['数量'];
		}
	}
	
	echo $file_num."#$#".$filenum_sl."#$#".$filenum_sq."#$#".$filenum_jf."#$#".$filenum_zz."#$#".$filenum_qt;
}

/*结案*/
if($my_flag == "over"){
	$id = $_POST['id'];
	$ajh ='';
	$return='';
	
	$sql = "SELECT 案卷号,申请号  FROM 临时文件  WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row=$result->fetch_assoc()){
			$ajh = $row['案卷号'];
			$sqh = $row['申请号'];
		}
	}
	
	if($ajh != ''){
		$sql_judge = "SELECT id FROM 专利信息  WHERE 申请号='".$sqh."'";
		$result_judge = $conn->query($sql_judge);
		if($result_judge->num_rows>0){
			$sql2 = "UPDATE 专利信息 SET 冻结状态='1' WHERE 申请号='".$sqh."'";
			$result2 = $conn->query($sql2);
			if($result2){
				$return['result']='结案成功！';
			}else{
				$return['result']='结案失败！';
			}
		}else{
			$return['result'] = "“专利信息”中没有申请号为".$sqh."的案件";
		}
		
	}else{
		$return['result']= '专利信息中没有此案卷号！';
	}
	
	$json = json_encode($return);
	echo $json;
	
}

/*删除*/
if($my_flag == 'del'){
	$id = $_POST['id'];
	$filename = '';
	$return='';
	
	//获取文件名称
	$sql = "SELECT 文件名称  FROM 临时文件  WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row=$result->fetch_assoc()){
			$filename = $row['文件名称'];
		}
	}
	
	//删除文件
	$path = "../tmp_fileupload/".$filename;
	$path = iconv("utf-8", "gbk", $path);
	if(file_exists($path)){
		if(unlink($path)){
			//更新数据库
			$sql2 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
			$result2 = $conn->query($sql2);
			if($result2){
				$return['result'] = '删除文件成功！';
			}else{
				$return['result'] = '删除文件失败！';
			}		
		}else{
			$return['result'] = '删除文件失败！';
		}
	}else{
		$sql2 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
		$conn->query($sql2);
		$return['result'] = '删除文件成功！';
	}
		
	
	$json=json_encode($return);
	echo $json;
}

/*下载*/
if($my_flag == "dowload"){
	$id = $_REQUEST['id'];
	$filename='';
	//获取文件名称
	$sql = "SELECT 文件名称  FROM 临时文件  WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row=$result->fetch_assoc()){
			$filename = $row['文件名称'];
		}
	}
	
	$path = "../tmp_fileupload/".$filename;
	$path = iconv("utf-8", "gbk", $path);	
	if(file_exists($path)){
		header('content-disposition:attachment;filename='.$filename);
		header('content-length:'.filesize($path));
		readfile($path);
	}else{
		echo '<script type="text/javascript">alert("文件不存在");window.close();</script>';
	}
}


/*费用*/
if($my_flag == "cost"){
	$id = $_POST['id'];
	$return = '';
	$number = '';
	
	//获取文件名称
	$sql = "SELECT 通知书编码  FROM 临时文件  WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row=$result->fetch_assoc()){
			$number = $row['通知书编码'];
		}
	}
	if($number !='' ){
		$return['result'] = "success";
		$return['number'] =  $number;
	}else{
		$return['result'] = "defeated";
	}
	
	$json = json_encode($return);
	echo $json;
}

//受理通知书单个确认或多个确认
if($my_flag == "advice_all"){
	$id_str = $_POST['id_str'];
	$id_arr = "";
	if(strpos($id_str, ",")!="FALSE"){
		$id_arr = explode(",", $id_str);
	}else{
		$id_arr[0] = $id_str;
	}
	
	$return = '';
	$return_msg ='';
	$default_msg = '';
	$return_fee = '';
	$i = 0;
	if($id_arr != ""){//接收id
		foreach($id_arr as $kry_0 => $id){
			$data='';//获取“临时文件”的信息
			$sql = "SELECT 文件名称,案卷号,申请号,申请日,案件分类 FROM 临时文件  WHERE id='".$id."'";
			$result = $conn->query($sql);
		 	if($result->num_rows>0){
		 		while($row = $result->fetch_assoc()){
		 			$data[0] = $row['文件名称'];
					$data[2] = $row['案卷号'];
					$data[3] = $row['申请号'];
					$data[4] = $row['申请日'];
					$data[5] = $row['案件分类'];
		 		}
				$return_msg[$i] = ($i+1)."、".$data[0]."：";
				if($data != ''){
					if($data[5] ==  "专利信息"){
						//-------------------------------------专利信息 start-----------------------------
						$path = "../tmp_fileupload/".$data[0];
						$path_gbk = iconv("utf-8", "gbk", $path);
						if(file_exists($path_gbk)){
							$cost_return = read_advice_xml($path_gbk);
							if($cost_return['result']){
								//【先检测“年费费减比”与申请人的“费减比”要是否一样】
								$sqrid_str = "";//申请人id字符串
								$sql = "SELECT 申请人id FROM 专利信息 WHERE 案卷号='".$data[2]."'";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_assoc()){
										$sqrid_str = $row['申请人id'];
									}
								}
								$sqr_fjb = "";//申请人的费减比
								$sql = "SELECT 费减比例 FROM 申请人 WHERE FIND_IN_SET(id,'".$sqrid_str."') LIMIT 1";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_assoc()){
										$sqr_fjb = $row['费减比例'];
									}
								}
								if(findNum($sqr_fjb) == findNum($cost_return['年费费减比例'])){
									//【更新“专利信息”的数据 ；已确认案件已存在】
									$sql = "UPDATE 专利信息 SET 申请号='".$data[3]."',申请日='".$data[4]."',年费费减比例='".$cost_return['年费费减比例']."',复审费减比例='".$cost_return['复审费减比例']."',状态='待申请费' WHERE 案卷号='".$data[2]."' ";
									if($conn->query($sql)){
										$return_msg[$i] .= "更新“专利信息”成功！";
									}else{
										$return_msg[$i] .= "更新“专利信息”失败！";
									}
									//【添加费用信息】
									foreach($cost_return['费用'] as $key_0 => $value_0){
										//判断费用是否已经存在
										$sql2 = "SELECT id FROM 专案需交费用  WHERE 案卷号='".$data[2]."' AND 费用名称='".$key_0."' AND 状态<>'9'";
										$result2 = $conn->query($sql2);
										if($result2->num_rows >0){
											$return_msg[$i] .= $key_0."已存在";
										}else{
											$sql3 = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源,状态)  VALUES(";
											$sql3 .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return['发文日']."','".$cost_return['提醒日期']."','".$cost_return['截止日期']."','1','4')";
											if($conn->query($sql3)){
												$return_msg[$i] .= $key_0."保存SQL成功！";
											}else{
												$return_msg[$i] .= $key_0."保存SQL失败！";
											}
										}
									}
								}else{
									$sql = "UPDATE 临时文件 SET 费减比是否一样='费减比不一样' WHERE id='".$id."'";
									$conn->query($sql);
									continue;
								}
							}else{
								$return_msg[$i] .= "读取xml信息失败！";
							}
							//【处理完毕，删除掉文件，更新数据库】
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)){
									$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
									if($conn->query($sql4)){
										$return_msg[$i] .= "删除文件成功！";
									}else{
										$return_msg[$i] .= "删除文件失败！";
									}
								}
							}else{
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "删除文件成功！";
								}else{
									$return_msg[$i] .= "删除文件失败！";
								}
							}
							
						}else{
							$return_msg[$i] .= "文件不存在！";
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "删除文件成功！";
							}else{
								$return_msg[$i] .= "删除文件失败！";
							}
						}
						//-------------------------------------专利信息 end-----------------------------
					}else if($data[5] ==  "专案_复审等"){
						//-------------------------------------专案_复审等 start-----------------------------
						$path = "../tmp_fileupload/".$data[0];
						$path_gbk = iconv("utf-8", "gbk", $path);
						if(file_exists($path_gbk)){
							$cost_return = read_advice_xml($path_gbk);
							if($cost_return['result']){
								//【先检测“年费费减比”与申请人的“费减比”要是否一样】
								$sqrid_str = "";//申请人id字符串
								$sql = "SELECT 申请人id FROM 专案_复审等 WHERE 案卷号='".$data[2]."'";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_assoc()){
										$sqrid_str = $row['申请人id'];
									}
								}
								$sqr_fjb = "";//申请人的费减比
								$sql = "SELECT 费减比例 FROM 申请人 WHERE FIND_IN_SET(id,'".$sqrid_str."') LIMIT 1";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_assoc()){
										$sqr_fjb = $row['费减比例'];
									}
								}
								if(findNum($sqr_fjb) == findNum($cost_return['年费费减比例'])){
									//【更新“专案_复审等”的数据 ；已确认案件已存在】
									$sql = "UPDATE 专案_复审等 SET 申请号='".$data[3]."',申请日='".$data[4]."' WHERE 案卷号='".$data[2]."' ";
									if($conn->query($sql)){
										$return_msg[$i] .= "更新“专案其他”成功！";
									}else{
										$return_msg[$i] .= "更新“专案其他”失败！";
									}
									//【添加费用信息】
									foreach($cost_return['费用'] as $key_0 => $value_0){
										//判断费用是否已经存在
										$sql2 = "SELECT id FROM 专案需交费用  WHERE 案卷号='".$data[2]."' AND 费用名称='".$key_0."' AND 状态<>'9'";
										$result2 = $conn->query($sql2);
										if($result2->num_rows >0){
											$return_msg[$i] .= $key_0."已存在";
										}else{
											$sql3 = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源,状态)  VALUES(";
											$sql3 .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return['发文日']."','".$cost_return['提醒日期']."','".$cost_return['截止日期']."','1','4')";
											if($conn->query($sql3)){
												$return_msg[$i] .= $key_0."保存SQL成功！";
											}else{
												$return_msg[$i] .= $key_0."保存SQL失败！";
											}
										}
									}
								}else{
									$sql = "UPDATE 临时文件 SET 费减比是否一样='费减比不一样' WHERE id='".$id."'";
									$conn->query($sql);
									continue;
								}
							}else{
								$return_msg[$i] .= "读取xml信息失败！";
							}
							//【处理完毕，删除掉文件，更新数据库】
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)){
									$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
									if($conn->query($sql4)){
										$return_msg[$i] .= "删除文件成功！";
									}else{
										$return_msg[$i] .= "删除文件失败！";
									}
								}
							}else{
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "删除文件成功！";
								}else{
									$return_msg[$i] .= "删除文件失败！";
								}
							}
							
						}else{
							$return_msg[$i] .= "文件不存在！";
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "删除文件成功！";
							}else{
								$return_msg[$i] .= "删除文件失败！";
							}
						}
						//-------------------------------------专案_复审等 end-----------------------------
					}else if($data[5] ==  "专案_年费"){
						//-------------------------------------专案_年费 start-----------------------------
						//【处理完毕，删除掉文件，更新数据库】
						if(file_exists($path_gbk)){
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "删除文件成功！";
								}else{
									$return_msg[$i] .= "删除文件失败！";
								}
							}
						}else{
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "删除文件成功！";
							}else{
								$return_msg[$i] .= "删除文件失败！";
							}
						}
						
						//-------------------------------------专案_年费 end-----------------------------
					}
				}else{
					$return_msg[$i] .= "获取“临时文件”信息失败！";
				}
		 	}
			$i++;
		}
	}

	if($return_msg != ""){
		echo implode("#$#", $return_msg);
	}
}

//授权文件的单个或多个确认处理
if($my_flag == "impower_all"){
	$impower_id = $_POST['id_str'];
	if(strpos($impower_id, ",")!="FALSE"){
		$id_arr = explode(",", $impower_id);
	}else{
		$id_arr[0] = $impower_id;
	}
	
	$return = '';
	$return_msg ='';
	$return_fee = '';
	$i = 0;
	foreach($id_arr as $key_0 => $id){
		//【获取“临时文件”信息】
		$data='';
		$sql = "SELECT 文件名称,案卷号,申请号,申请日,案件分类 FROM 临时文件  WHERE id='".$id."'";
		$result = $conn->query($sql);
	 	if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$data[0] = $row['文件名称'];
				$data[2] = $row['案卷号'];
				$data[3] = $row['申请号'];
				$data[4] = $row['申请日'];
				$data[5] = $row['案件分类'];
	 		}
			$return_msg[$i] = ($i+1)."、".$data[0]."：";
			if($data != ''){
				if($data[5] == "专利信息"){
					//-------------------------------------专利信息 start-----------------------------
					//【读取xml的费用】
					$path = "../tmp_fileupload/".$data[0];
					$path_gbk = iconv("utf-8", "gbk", $path);
					if(file_exists($path_gbk)){
						$cost_return = read_other_xml($path_gbk);
						if($cost_return['result'] == "success" ){
							//【更新“专利信息”的年度】
							$sql2 = "UPDATE 专利信息   SET 年费首年度='".$cost_return['年度']."',授权时间='".$cost_return['发文日']."',状态='待登记费'  WHERE 申请号='".$data[3]."'";
							if($conn->query($sql2)){
								$return_msg[$i] .= "“专利信息”的年费首年度与授权公告日更新成功！";
							}else{
								$return_msg[$i] .= "“专利信息”的年费首年度与授权公告日更新失败！";
							}
							//【添加费用】
							//插入“公告印刷费”到$cost_return
//							$cost_return['费用']["公告印刷费"] = "50";//已去掉2018年8月8日16:53:39
							foreach($cost_return['费用'] as $key_0 => $value_0){
								//判断费用是否存在
								$sql3 = "SELECT id FROM 专案需交费用  WHERE 案卷号='".$data[2]."' AND 费用名称='".$key_0."'";
								$result3 = $conn->query($sql3);
								if($result3->num_rows >0){
									$return_msg[$i] .=  $key_0."费用已存在！";
								}else{
									if($key_0 == "年费"){
										$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,年度,费用来源)  VALUES(";
										$sql .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return["发文日"]."','".$cost_return["提醒日期"]."','".$cost_return["截止日期"]."','".$cost_return["年度"]."','2')";
										if($conn->query($sql)){
											$return_msg[$i] .= $key_0."保存SQL成功！";
										}else{
											$return_msg[$i] .= $key_0."保存SQL失败！";
										}
									}else{
										$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源)  VALUES(";
										$sql .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return["发文日"]."','".$cost_return["提醒日期"]."','".$cost_return["截止日期"]."','2')";
										if($conn->query($sql)){
											$return_msg[$i] .= $key_0."保存SQL成功！";
										}else{
											$return_msg[$i] .= $key_0."保存SQL失败！";
										}
									}
								}
							}
							
							//【更新“专案需交费用”的年度】
							$sql3 = "UPDATE 专案需交费用  SET 年度='".$cost_return['年度']."'  WHERE 案卷号='".$data[2]."' AND 费用名称='年费'";
							if($conn->query($sql3)){
								$return_msg[$i] .= "“专案需交费用”的年费首年度更新成功！";
							}else{
								$return_msg[$i] .= "“专案需交费用”的年费首年度更新失败！";
							}
						}else{
							$return_msg[$i] .= "读取xml的费用失败！";
						}
						//【删除文件】
						if(file_exists($path_gbk)){
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "文件删除成功！";
							}else{
								$return_msg[$i] .= "文件删除失败！";
							}
						}
						
					}else{
						$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
						if($conn->query($sql4)){
							$return_msg[$i] .= "文件删除成功！";
						}else{
							$return_msg[$i] .= "文件删除失败！";
						}
						$return_msg[$i] .= "要读取的文件不存在！";
					}
					//-------------------------------------专利信息 end-----------------------------
				}else if($data[5] == "专案_复审等"){
					//-------------------------------------专案_复审等 start-----------------------------
					//【读取xml的费用】
					$path = "../tmp_fileupload/".$data[0];
					$path_gbk = iconv("utf-8", "gbk", $path);
					if(file_exists($path_gbk)){
						$cost_return = read_other_xml($path_gbk);
						if($cost_return['result'] == "success" ){
							
							//【添加费用】
							//插入“公告印刷费”到$cost_return
//							$cost_return['费用']["公告印刷费"] = "50";//已去掉2018年8月8日16:54:03
							foreach($cost_return['费用'] as $key_0 => $value_0){
								//判断费用是否存在
								$sql3 = "SELECT id FROM 专案需交费用  WHERE 案卷号='".$data[2]."' AND 费用名称='".$key_0."'";
								$result3 = $conn->query($sql3);
								if($result3->num_rows >0){
									$return_msg[$i] .=  $key_0."费用已存在！";
								}else{
									if($key_0 == "年费"){
										$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,年度,费用来源)  VALUES(";
										$sql .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return["发文日"]."','".$cost_return["提醒日期"]."','".$cost_return["截止日期"]."','".$cost_return["年度"]."','2')";
										if($conn->query($sql)){
											$return_msg[$i] .= $key_0."保存SQL成功！";
										}else{
											$return_msg[$i] .= $key_0."保存SQL失败！";
										}
									}else{
										$sql = "INSERT INTO 专案需交费用(案卷号,费用名称,金额,通知时间,提醒时间,缴费期限,费用来源)  VALUES(";
										$sql .= "'".$data[2]."','".$key_0."','".$value_0."','".$cost_return["发文日"]."','".$cost_return["提醒日期"]."','".$cost_return["截止日期"]."','2')";
										if($conn->query($sql)){
											$return_msg[$i] .= $key_0."保存SQL成功！";
										}else{
											$return_msg[$i] .= $key_0."保存SQL失败！";
										}
									}
								}
							}
							
							//【更新“专案需交费用”的年度】
							$sql3 = "UPDATE 专案需交费用  SET 年度='".$cost_return['年度']."'  WHERE 案卷号='".$data[2]."' AND 费用名称='年费'";
							if($conn->query($sql3)){
								$return_msg[$i] .= "“专案需交费用”的年费首年度更新成功！";
							}else{
								$return_msg[$i] .= "“专案需交费用”的年费首年度更新失败！";
							}
						}else{
							$return_msg[$i] .= "读取xml的费用失败！";
						}
						//【删除文件】
						if(file_exists($path_gbk)){
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "文件删除成功！";
							}else{
								$return_msg[$i] .= "文件删除失败！";
							}
						}
						
					}else{
						$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
						if($conn->query($sql4)){
							$return_msg[$i] .= "文件删除成功！";
						}else{
							$return_msg[$i] .= "文件删除失败！";
						}
						$return_msg[$i] .= "要读取的文件不存在！";
					}
					//-------------------------------------专案_复审等 end-----------------------------
				}else if($data[5] == "专案_年费"){
					//-------------------------------------专案_年费 start-----------------------------
						$path = "../tmp_fileupload/".$data[0];
						$path_gbk = iconv("utf-8", "gbk", $path);
						//【删除文件】
						if(file_exists($path_gbk)){
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{
							$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
							if($conn->query($sql4)){
								$return_msg[$i] .= "文件删除成功！";
							}else{
								$return_msg[$i] .= "文件删除失败！";
							}
						}
						
					//-------------------------------------专案_年费 end-----------------------------
				}
				
			}
		}else{
			$return_msg[$i] .= "获取数据库信息失败！";
		}
		$i++;
	}

	if($return_msg != ""){
		echo implode("#$#", $return_msg);
	}
}

//缴费通知单个或多个处理
if($my_flag == "debit" ){
	$pay_id = $_POST['id_str'];
	if(strpos($pay_id, ",")!="FALSE"){
		$arr_id = explode(",", $pay_id);
	}else{
		$arr_id[0] = $pay_id;
	}
//	print_r($arr_id);
	$return='';
	$return_str='';
	$return_msg = '';
	$i =0;
	foreach($arr_id as $key_0 => $id){
		//【获取“临时文件”的信息】
		$data='';
		$sql = "SELECT 文件名称,案卷号,申请号,申请日,案件分类 FROM 临时文件  WHERE id='".$id."'";	
	 	$result = $conn->query($sql);
	 	if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$data[0] = $row['文件名称'];
				$data[2] = $row['案卷号'];
				$data[3] = $row['申请号'];
				$data[4] = $row['申请日'];
				$data[5] = $row['案件分类'];
	 		}
			$return_msg[$i] = ($i+1)."、".$data[0]."：";
			if($data != ''){
				if($data[5] == "专利信息"){
					//-------------------------------------专利信息 start-----------------------------
					//【读取xml的费用信息】
					$path = "../tmp_fileupload/".$data[0];
					$path_gbk = iconv("utf-8", "gbk", $path);
					if(file_exists($path_gbk)){
						$cost_return = read_feeremind_xml($path);
						if($cost_return['result'] == "success" ){
							$return_msg[$i] .= "读取xml信息成功";
							foreach($cost_return['滞纳金'] as $key_0 => $value_0){
								$sql_d = "SELECT id FROM 滞纳金列表   WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
								$result_judge = $conn->query($sql_d);
								if($result_judge ->num_rows>0){
									$sql = "UPDATE 滞纳金列表  SET 滞纳金='".$value_0["滞纳金额"]."',开始时间='".$value_0["缴费开始时间"]."',截止时间='".$value_0["缴费截止时间"]."' WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
									if($conn->query($sql)){
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存成功！";
									}else{
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存失败！";
									}
								}else{
									$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'不存在！";
								}
							}
							//【删除文件】
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{//读取xml信息失败
							$return_msg[$i] .= "读取xml信息失败";
						}
					}else{//要读取的文件不存在
						$return_msg[$i] .= "要读取的文件不存在";
					}
					//-------------------------------------专利信息 end-----------------------------
				}else if($data[5] == "专案_复审等"){
					//-------------------------------------专案_复审等 start-----------------------------
					$path = "../tmp_fileupload/".$data[0];
					$path_gbk = iconv("utf-8", "gbk", $path);
					if(file_exists($path_gbk)){
						$cost_return = read_feeremind_xml($path);
						if($cost_return['result'] == "success" ){
							$return_msg[$i] .= "读取xml信息成功";
							foreach($cost_return['滞纳金'] as $key_0 => $value_0){
								$sql_d = "SELECT id FROM 滞纳金列表   WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
								$result_judge = $conn->query($sql_d);
								if($result_judge ->num_rows>0){
									$sql = "UPDATE 滞纳金列表  SET 滞纳金='".$value_0["滞纳金额"]."',开始时间='".$value_0["缴费开始时间"]."',截止时间='".$value_0["缴费截止时间"]."' WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
									if($conn->query($sql)){
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存成功！";
									}else{
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存失败！";
									}
								}else{
									$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'不存在！";
								}
							}
							//【删除文件】
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{//读取xml信息失败
							$return_msg[$i] .= "读取xml信息失败";
						}
					}else{//要读取的文件不存在
						$return_msg[$i] .= "要读取的文件不存在";
					}
					//-------------------------------------专案_复审等 end-----------------------------
				}else if($data[5] == "专案_年费"){
					//-------------------------------------专案_年费 start-----------------------------
					$path = "../tmp_fileupload/".$data[0];
					$path_gbk = iconv("utf-8", "gbk", $path);
					if(file_exists($path_gbk)){
						$cost_return = read_feeremind_xml($path);
						if($cost_return['result'] == "success" ){
							$return_msg[$i] .= "读取xml信息成功";
							foreach($cost_return['滞纳金'] as $key_0 => $value_0){
								$sql_d = "SELECT id FROM 滞纳金列表   WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
								$result_judge = $conn->query($sql_d);
								if($result_judge ->num_rows>0){
									$sql = "UPDATE 滞纳金列表  SET 滞纳金='".$value_0["滞纳金额"]."',开始时间='".$value_0["缴费开始时间"]."',截止时间='".$value_0["缴费截止时间"]."' WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
									if($conn->query($sql)){
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存成功！";
									}else{
										$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'保存失败！";
									}
								}else{
									$return_msg[$i] .= "年度'".$cost_return["缴费年度"]."'期数'".(intval($key_0)+1)."'不存在！";
								}
							}
							//【删除文件】
							if(unlink($path_gbk)){
								$sql4 = "UPDATE 临时文件  SET 上传情况='1'  WHERE id='".$id."'";
								if($conn->query($sql4)){
									$return_msg[$i] .= "文件删除成功！";
								}else{
									$return_msg[$i] .= "文件删除失败！";
								}
							}
						}else{//读取xml信息失败
							$return_msg[$i] .= "读取xml信息失败";
						}
					}else{//要读取的文件不存在
						$return_msg[$i] .= "要读取的文件不存在";
					}
					//-------------------------------------专案_年费 end-----------------------------
				}
				
			}
	 	}else{//获取SQL信息失败
	 		$return_msg[$i] .= "获取SQL信息失败！";
	 	}
		
		$i++;
	}
	if($return_msg != ""){
		echo implode("#$#", $return_msg);
	}
}


//权利终止通知书一键确认/结案
if($my_flag == "termination"){
	$impower_id = $_POST['id_str'];
	if(strpos($impower_id, ",")!="FALSE"){
		$arr_id = explode(",", $impower_id);
	}else{
		$arr_id[0] = $impower_id;
	}
	$return='';
	$return_result='';
	foreach($arr_id as $key_0 => $id){
		
		//获取数据
		$data='';
		$sql = "SELECT 文件名称,案卷号,专利名称,申请号,申请日,案件分类 FROM 临时文件  WHERE id='".$id."'";	
	 	$result = $conn->query($sql);
	 	if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$data[0] = $row['文件名称'];
				$data[1] = $row['专利名称'];
				$data[2] = $row['案卷号'];
				$data[3] = $row['申请号'];
				$data[4] = $row['申请日'];
				$data[5] = $row['案件分类'];
	 		}
	 	}
//		print_r($data);		
		if($data!=''){
			if($data[5] == "专利信息"){
				$sql2 = "UPDATE 专利信息 SET 冻结状态='1' WHERE 案卷号='".$data[2]."'";
				$result2 = $conn->query($sql2);
				if($result2){
					//删除文件
					$path = "../tmp_fileupload/".$data[0];
					$path = iconv("utf-8", "gbk", $path);
					if(file_exists($path)){
						if(unlink($path)){
							//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}		
						}else{
							$return = $return.$data[0]."删除文件失败！\n";
						}
					}else{
						//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}
					}
					
					$return_result=$return_result.$data[3]."结案成功！\n";
				}else{
					$return_result=$return_result.$data[3]."结案失败！\n";
				}
			}else if($data[5] == "专案_复审等"){
				$sql2 = "UPDATE 专案_复审等 SET 冻结状态='1' WHERE 案卷号='".$data[2]."'";
				$result2 = $conn->query($sql2);
				if($result2){
					//删除文件
					$path = "../tmp_fileupload/".$data[0];
					$path = iconv("utf-8", "gbk", $path);
					if(file_exists($path)){
						if(unlink($path)){
							//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}		
						}else{
							$return = $return.$data[0]."删除文件失败！\n";
						}
					}else{
						//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}
					}
					$return_result=$return_result.$data[3]."结案成功！\n";
				}else{
					$return_result=$return_result.$data[3]."结案失败！\n";
				}
			}else if($data[5] == "专案_年费"){
				$sql2 = "UPDATE 专案_年费 SET 冻结状态='1' WHERE 案卷号='".$data[2]."'";
				$result2 = $conn->query($sql2);
				if($result2){
					//删除文件
					$path = "../tmp_fileupload/".$data[0];
					$path = iconv("utf-8", "gbk", $path);
					if(file_exists($path)){
						if(unlink($path)){
							//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}		
						}else{
							$return = $return.$data[0]."删除文件失败！\n";
						}
					}else{
						//更新数据库
							$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
							$result4 = $conn->query($sql4);
							if($result4){
								$return = $return.$data[0]."删除文件成功！\n";
							}else{
								$return = $return.$data[0]."删除文件失败！\n";
							}
					}
					$return_result=$return_result.$data[3]."结案成功！\n";
				}else{
					$return_result=$return_result.$data[3]."结案失败！\n";
				}
			}
		}

	}//foreach
	echo $return_result;	
}

//获取其他文件的上传日期
if($my_flag == "获取其他上传文件日期与申请号"){
	$tmp_result = "";
	$tmp_result_2 = "";
	$json_str = "";
	$tmp_data_update = "";//上传日期
	$tmp_data_sqh = "";//申请号
	$sql = "select DISTINCT 上传时间 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c; ";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$tmp_result = TRUE;
		while($row = $result->fetch_assoc()){
			$tmp_data_update .= ','.'"'.$row["上传时间"].'"';
		}
	}else{
		$tmp_result = FALSE;
	}
	$sql = "select DISTINCT 申请号 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c; ";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$tmp_result_2 = TRUE;
		while($row = $result->fetch_assoc()){
			$tmp_data_sqh .= ','.'"'.$row["申请号"].'"';
		}
	}else{
		$tmp_result_2 = FALSE;
	}
	if($tmp_data_update != ""){
		$tmp_data_update = substr($tmp_data_update, 1);
	}else{
		$tmp_result = FALSE;
	}
	if($tmp_data_sqh != ""){
		$tmp_data_sqh = substr($tmp_data_sqh, 1);
	}else{
		$tmp_result_2 = FALSE;
	}
	
	$json_str = '{"ret_data_update" :['.$tmp_data_update.'],"ret_data_sqh":['.$tmp_data_sqh.'],"result":"'.$tmp_result.'","result_sqh":"'.$tmp_result_2.'"}';
	
	echo $json_str;
}

//根据上传文件日期显示表格内容
if($my_flag == "根据上传日期查询"){
	require_once "../classes/TempFileList.php";
	
	$checkdate = $_GET["checkdate"];
	$checksqh = $_GET["checksqh"];
	$checkdlr = $_GET["checkdlr"];
	
	if(empty($checksqh)){
		$checksqh = "全部";
	}
	if(empty($checkdlr)){
		$checkdlr = "全部";
	}
	
	$ret_data = array("state"=>"fail","data"=>array(),"message"=>"");
	
	$getdata = new TempFileList($conn);
	$getdata->UseClass();
	if(count($getdata->sqldata_tempfiles) > 0){
		$ret_data["state"] = "success";
		$ret_data["message"] = "获取成功";
		//上传时间的筛选
		if($checkdate != "全部"){
			foreach($getdata->sqldata_tempfiles as $index => $datainfo){
				if($datainfo["上传时间"] == $checkdate){
					$ret_data["data"][] = $datainfo;
				}
			}
		}else{
			foreach($getdata->sqldata_tempfiles as $index => $datainfo){
				$ret_data["data"][] = $datainfo;
			}
		}
		//申请号的筛选
		if($checksqh != "全部"){
			foreach($ret_data["data"] as $index =>$datainfo){
				if($datainfo["申请号"] != $checksqh){
					unset($ret_data["data"][$index]);
				}
			}
		}
		//代理人的筛选
		if($checkdlr != "全部"){
			foreach($ret_data["data"] as $index =>$datainfo){
				if($datainfo["代理人"] != $checkdlr){
					unset($ret_data["data"][$index]);
				}
			}
		}
	}
	
	$json = json_encode($ret_data);
	echo $json;

//	$tmp_data = "";
//	$json_str = "";
//	$tmp_result = "";
//	$sql = "";
//	if($checkdate != "全部" && $checksqh != "全部"){
//		$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c WHERE 上传时间='".$checkdate."' AND 申请号 LIKE '%".$checksqh."%'";
//	}else if($checkdate == "全部" && $checksqh != "全部"){
//		$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c WHERE 申请号 LIKE '%".$checksqh."%'";
//	}else if($checkdate != "全部" && $checksqh == "全部"){
//		$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c WHERE 上传时间='".$checkdate."'";
//	}else{
//		$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c ";
//	}
//	if($sql != ""){
//		$result = $conn->query($sql);
//		$i=0;
//		if($result->num_rows >0){
//			$tmp_result = TRUE;
//			while($row = $result->fetch_assoc()){
//				$my_ayr = "";
//				$my_dlr = "";
//				$my_sqr = "";
//				$zt = "";
//				if(!$row['案件存在']){
////					$sql2 = "SELECT 案源人,代理人,申请人id FROM 专利信息 WHERE 案卷号='".$row['案卷号']."' ";
////					$sql2 = "SELECT 案卷号,案源人,代理人,申请人,案件分类 FROM (SELECT 案卷号,案源人,代理人,申请人,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,案源人,代理人,申请人,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,案源人,代理人,申请人,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$row['案卷号']."'";
//					if(!empty($checkdlr)){
//						$sql2 = "SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,案件分类 FROM (SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$row['案卷号']."' AND 代理人='".$checkdlr."'";
//					}else{
//						$sql2 = "SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,案件分类 FROM (SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$row['案卷号']."'";
//					}
//					$result2 = $conn->query($sql2);
//					if($result2->num_rows>0){
//						$arr_sqrid = "";
//						while($row2 = $result2->fetch_assoc()){
//							$my_ayr = $row2['案源人'];
//							$my_dlr = $row2['代理人'];
//							$my_sqr = $row2['申请人'];
//							$zt = Getcasestaus($row2['状态'],$row2['冻结状态']);
//						}
//					}
//				}
//				$tmp_ajcz = "";
//				if(!$row['案件存在']){
//					$tmp_ajcz = "案件存在";
//				}else{
//					$tmp_ajcz = "案件不存在";
//				}
//				$tmp_data .= ','.'["'.$row["id"].'","'.$row["案卷号"].'","'.$row["上传时间"].'","'.$my_sqr.'","'.$my_ayr.'","'.$my_dlr.'","'.$row["通知书名称"].'","'.$row["专利名称"].'","'.$row["申请号"].'","'.$row["申请日"].'","'.$row["发文日"].'","'.$tmp_ajcz.'","'.$zt.'"]';
//			
//			}
//		}else{
//			$tmp_result = FALSE;
//		}
//		if($tmp_data != ""){
//			$tmp_data = substr($tmp_data, 1);
//			$json_str = '{"ret_data":['.$tmp_data.'],"result":"'.$tmp_result.'"}';
//			
//		}else{
//			$json_str = '{"result":"'.$tmp_result.'"}';
//		}
//	}else{
//		$tmp_result = FALSE;
//		$json_str = '{"result":"'.$tmp_result.'"}';
//	}
//	echo $json_str;
}

//装载文件进zip
if($my_flag == "装载文件进zip"){
	$ret_msg = "";
	$str_id = $_GET["str_id"];
	$sql = "SELECT 文件名称 FROM 临时文件 WHERE FIND_IN_SET(id,'".$str_id."')";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_msg = TRUE;
		$tmp_filename = "tmp.zip";
		if(file_exists($tmp_filename)){
			unlink($tmp_filename);
		}
		$zip = new ZipArchive();
		$zip->open($tmp_filename,ZipArchive::OVERWRITE);
		while($row = $result->fetch_assoc()){
			$path = "../tmp_fileupload/".$row["文件名称"];
			$path_gbk = iconv("utf-8", "gbk", $path);
			
			if(file_exists($path_gbk)){
				$filedata = file_get_contents($path_gbk);
				if($filedata){
					$zip ->addFromString($row["文件名称"],$filedata);
				}
			}
		}
		$zip->close();
	}else{
		$ret_msg = FALSE;
	}
	echo $ret_msg;
}
//下载tmp.zip文件
if($my_flag == "download_tmpzip"){
	$path = "tmp.zip";
	$filename = date("Y年m月d日H时i分s秒").".zip";
	if(file_exists($path)){
		header('content-disposition:attachment;filename='.$filename);
		header('content-length:'.filesize($path));
		readfile($path);
	}else{
		echo '<script type="text/javascript">alert("文件不存在");window.close();</script>';
	}
}

$conn->close();
?>