<?php
/*将对象转化为数组*/
function objectToArray($e){
    $e=(array)$e;
    foreach($e as $k=>$v){
        if( gettype($v)=='resource' ) return;
        if( gettype($v)=='object' || gettype($v)=='array' )
            $e[$k]=(array)objectToArray($v);
    }
    return $e;
}

/*获取文件后缀*/
function get_suffix($name){
	$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION ));
	return $ext;
}

/*毫秒级的时间戳*/
function getMillisecond(){
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}

/*上传到tmp_fileupload*/
function Save_tmpfileupload($fileInfo,$path){
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		$res = '';
		//如果文件目录不存在时自动创建
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		//移动文件
		$timestamp = getMillisecond();//获取毫秒级的时间戳
		$uniName=$timestamp."_".$fileInfo['name'];//文件名称
		$destination=$path.'/'.$uniName;//编写保存路径
		$destination_gbk= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if (! @move_uploaded_file ( $fileInfo ['tmp_name'], $destination_gbk )) {
			$res['result'] = false ;
		}else{
			$res['result'] = true;
			$res['des'] = $destination;
		}
		return $res;
	}else{
		$res['result'] = false;
		//匹配错误信息
		switch ($fileInfo ['error']) {
			case 1 :
				$res['mes'] = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
				break;
			case 2 :
				$res['mes'] = '超过了表单MAX_FILE_SIZE限制的大小';
				break;
			case 3 :
				$res['mes'] = '文件部分被上传';
				break;
			case 4 :
				$res['mes'] = '没有选择上传文件';
				break;
			case 6 :
				$res['mes'] = '没有找到临时目录';
				break;
			case 7 :
			case 8 :
				$res['mes'] = '系统错误';
				break;
		}
		return $res;
	}
}

/*读取list.xml的信息*/
function Read_listxml($path){
//	Array("result","通知书名称","通知书编码","专利名称","申请号","发文日","申请日","案卷号","原案卷号")
	$return_data='';//创建返回数组
	$sl_data = "";
	$jh_data = "";
	$jn_data = "";
	$comm_data = "";
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = pathinfo($file_name,PATHINFO_BASENAME);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				if(array_key_exists("TONGZHISXJ", $xml_arr)){
					$information = $xml_arr['TONGZHISXJ']['SHUXINGXX'];
					//更新“通知书类型”
					require("../conn.php");
					$sql = "SELECT 通知书编码 FROM 通知书类型";
					$arr_tzslx = "";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($row = $result->fetch_assoc()){
							$arr_tzslx[] = $row["通知书编码"];
						}
					}
					if($arr_tzslx != ""){
						if(!in_array($information["TONGZHISBM"], $arr_tzslx)){
							$sql = "INSERT INTO 通知书类型(通知书编码,通知书名称) VALUES(";
							$sql .= "'".$information["TONGZHISBM"]."','".$information['TONGZHISBM']."')";
							$conn->query($sql);
						}
					}
					$conn->close();
					
					
					if(@$information["TONGZHISBM"] == "200101"){//专利申请受理通知书
						$sl_data["通知书名称"] = $information['TONGZHISMC'];
						$sl_data["通知书编码"] = $information['TONGZHISBM'];
						$sl_data["专利名称"] = $information['FAMINGMC'];
						$sl_data["申请号"] = $information['SHENQINGH'];
						$sl_data["发文日"] = date("Y-m-d",strtotime($information['FAWENR']));
						$sl_data["申请日"] = date("Y-m-d",strtotime($information['SHENQINGR']));
						$sl_data["案卷号"] = $information['NEIBUBH'];
						$sl_data["原案卷号"] = $information['ANJUANH'];
					}else if(@$information["TONGZHISBM"] == "200021"){//费用减缓审批通知书
						$jh_data["通知书名称"] = $information['TONGZHISMC'];
						$jh_data["通知书编码"] = $information['TONGZHISBM'];
						$jh_data["专利名称"] = $information['FAMINGMC'];
						$jh_data["申请号"] = $information['SHENQINGH'];
						$jh_data["发文日"] = date("Y-m-d",strtotime($information['FAWENR']));
						$jh_data["申请日"] = date("Y-m-d",strtotime($information['SHENQINGR']));
						$jh_data["案卷号"] = $information['NEIBUBH'];
						$jh_data["原案卷号"] = $information['ANJUANH'];						
					}else if(@$information["TONGZHISBM"] == "200103"){//缴纳申请费通知书
						$jn_data["通知书名称"] = $information['TONGZHISMC'];
						$jn_data["通知书编码"] = $information['TONGZHISBM'];
						$jn_data["专利名称"] = $information['FAMINGMC'];
						$jn_data["申请号"] = $information['SHENQINGH'];
						$jn_data["发文日"] = date("Y-m-d",strtotime($information['FAWENR']));
						$jn_data["申请日"] = date("Y-m-d",strtotime($information['SHENQINGR']));
						$jn_data["案卷号"] = $information['NEIBUBH'];
						$jn_data["原案卷号"] = $information['ANJUANH'];						
					}else if(@$information["TONGZHISBM"] == "400002" || @$information["TONGZHISBM"] == "400003" || @$information["TONGZHISBM"] == ""){//导入专利证书
						$zs_data["通知书名称"] = $information['TONGZHISMC'];
						$zs_data["通知书编码"] = $information['TONGZHISBM'];
						$zs_data["通知书ID"] = $information['TONGZHISID'];
						$zs_data["专利名称"] = $information['FAMINGMC'];
						$zs_data["申请号"] = $information['SHENQINGH'];
						$zs_data["发文日"] = date("Y-m-d",strtotime($information['FAWENR']));
						$zs_data["申请日"] = date("Y-m-d",strtotime($information['SHENQINGR']));
						$zs_data["案卷号"] = $information['NEIBUBH'];
						$zs_data["原案卷号"] = $information['ANJUANH'];
					}else{
						$comm_data["通知书名称"] = $information['TONGZHISMC'];
						$comm_data["通知书编码"] = $information['TONGZHISBM'];
						$comm_data["专利名称"] = $information['FAMINGMC'];
						$comm_data["申请号"] = $information['SHENQINGH'];
						$comm_data["发文日"] = date("Y-m-d",strtotime($information['FAWENR']));
						$comm_data["申请日"] = date("Y-m-d",strtotime($information['SHENQINGR']));
						$comm_data["案卷号"] = $information['NEIBUBH'];
						$comm_data["原案卷号"] = $information['ANJUANH'];
					}
				}
			}
		}
	}
	//装载数据
	if($sl_data != ""){
		$return_data["result"] = true;
		$return_data["通知书名称"] = $sl_data["通知书名称"];
		$return_data["通知书编码"] = $sl_data["通知书编码"];
		$return_data["专利名称"] = $sl_data["专利名称"];
		$return_data["申请号"] = $sl_data["申请号"];
		$return_data["发文日"] = $sl_data["发文日"];
		$return_data["申请日"] = $sl_data["申请日"];
		$return_data["案卷号"] = $sl_data["案卷号"];
		$return_data["原案卷号"] = $sl_data["原案卷号"];
		if($jh_data != ""){
			$return_data["通知书名称"] = $return_data["通知书名称"].",".$jh_data["通知书名称"];
			$return_data["通知书编码"] = $return_data["通知书编码"].",".$jh_data["通知书编码"];
		}
		if($jn_data != ""){
			$return_data["通知书名称"] = $return_data["通知书名称"].",".$jn_data["通知书名称"];
			$return_data["通知书编码"] = $return_data["通知书编码"].",".$jn_data["通知书编码"];
		}
	}else if($comm_data !=""){
		$return_data["result"] = true;
		$return_data["通知书名称"] = $comm_data["通知书名称"];
		$return_data["通知书编码"] = $comm_data["通知书编码"];
		$return_data["专利名称"] = $comm_data["专利名称"];
		$return_data["申请号"] = $comm_data["申请号"];
		$return_data["发文日"] = $comm_data["发文日"];
		$return_data["申请日"] = $comm_data["申请日"];
		$return_data["案卷号"] = $comm_data["案卷号"];
		$return_data["原案卷号"] = $comm_data["原案卷号"];
	}else if($jh_data != ""){
		$return_data["result"] = true;
		$return_data["通知书名称"] = $jh_data["通知书名称"];
		$return_data["通知书编码"] = $jh_data["通知书编码"];
		$return_data["专利名称"] = $jh_data["专利名称"];
		$return_data["申请号"] = $jh_data["申请号"];
		$return_data["发文日"] = $jh_data["发文日"];
		$return_data["申请日"] = $jh_data["申请日"];
		$return_data["案卷号"] = $jh_data["案卷号"];
		$return_data["原案卷号"] = $jh_data["原案卷号"];			
	}else if($jn_data != ""){
		$return_data["result"] = true;
		$return_data["通知书名称"] = $jn_data["通知书名称"];
		$return_data["通知书编码"] = $jn_data["通知书编码"];
		$return_data["专利名称"] = $jn_data["专利名称"];
		$return_data["申请号"] = $jn_data["申请号"];
		$return_data["发文日"] = $jn_data["发文日"];
		$return_data["申请日"] = $jn_data["申请日"];
		$return_data["案卷号"] = $jn_data["案卷号"];
		$return_data["原案卷号"] = $jn_data["原案卷号"];				
	}else if($zs_data != ""){
		$return_data["result"] = true;
		$return_data["通知书名称"] = $zs_data["通知书名称"];
		$return_data["通知书编码"] = $zs_data["通知书编码"];
		$return_data["通知书ID"] = $zs_data["通知书ID"];
		$return_data["专利名称"] = $zs_data["专利名称"];
		$return_data["申请号"] = $zs_data["申请号"];
		$return_data["发文日"] = $zs_data["发文日"];
		$return_data["申请日"] = $zs_data["申请日"];
		$return_data["案卷号"] = $zs_data["案卷号"];
		$return_data["原案卷号"] = $zs_data["原案卷号"];
	}else{
		$return_data["result"] = false;
	}
	return $return_data;
}


//复制文件
function Filecopy($sour_path,$dest_path){
	$path = pathinfo($dest_path,PATHINFO_DIRNAME);
	//如果文件目录不存在时自动创建
	if(!file_exists($path)){
		mkdir($path,0777,true);
		chmod($path,0777);
	}	
//	$sqr_filename_gbk = iconv("utf-8","gbk",$sour_path);
	$copy_path_gbk = iconv("utf-8","gbk",$dest_path);
	if(file_exists($sour_path)){
		if(!copy($sour_path,$copy_path_gbk)){
			return false;
		}else{
			return true;
		}
	}
}

//读取含有“受理通知书”的费用信息
function read_advice_xml($path){
	$return_data="";//创建返回数组
	$return_data['result'] = false;
//	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
//	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$return_data['result'] = true;
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
			   	$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//			   	print_r($xml_arr);
				if(array_key_exists('notice_template_code', $xml_arr)){
				   	if(@substr($xml_arr['notice_template_code'],0,6) == "200021"){
				   		$return_data['发文日'] = date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));
						$return_data['截止日期'] = date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));
						$return_data['提醒日期'] = date('Y-m-d',strtotime('-1months',strtotime($return_data['截止日期'])));
						/*获取各种费用*/
						$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
	//					echo gettype($fee_arr).count($fee_arr)."<br/><hr/>";
						for($i=0;$i<count($fee_arr);$i++){
							if($fee_arr[$i]['fee_amount'] != 0){
								$fee_name = $fee_arr[$i]['fee_name'];//费用名称
								$return_data['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
							}
						}
						if(@substr($xml_arr['notice_template_code'],0,6) != '200103'){
							$return_data['年费费减比例']=$xml_arr['cost_slow_rate_annul'];
							if(@$xml_arr['cost_slow_rate_review'] !=null){
								$return_data['复审费减比例']=@$xml_arr['cost_slow_rate_review']; 
							}else{
								$return_data['复审费减比例']="100％";
							}
						}else{
							$return_data['年费费减比例'] = "100％";
							$return_data['复审费减比例'] = "100％";
						}
						//判断是否有实审费
						if(substr($xml_arr['application_number'],4,1) == 1){
							$num = substr($return_data['年费费减比例'], 0, 2);
							switch($num){
								case "70":
									$return_data['费用']['实审费'] = 750;
									break;
								case "85":
									$return_data['费用']['实审费'] = 375;
								    break;
								default:
									$return_data['费用']['实审费'] = 2500;
							}
						}
//						
						$return_data['费用金额总计']=$xml_arr['fee_info_all']['fee_total'];
						
				   	}else if(@substr($xml_arr['notice_template_code'],0,6) == "200103"){
				   		$return_data['发文日'] = date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));
						$return_data['截止日期'] = date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));
						$return_data['提醒日期'] = date('Y-m-d',strtotime('-1months',strtotime($return_data['截止日期'])));
						/*获取各种费用*/
						$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
	//					echo gettype($fee_arr).count($fee_arr)."<br/><hr/>";
						for($i=0;$i<count($fee_arr);$i++){
							if($fee_arr[$i]['fee_amount'] != 0){
								$fee_name = $fee_arr[$i]['fee_name'];//费用名称
								$return_data['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
							}
						}
						
						$return_data['年费费减比例'] = "100％";
						$return_data['复审费减比例'] = "100％";
						//判断是否有实审费
						if(substr($xml_arr['application_number'],4,1) == 1){
							$num = substr($return_data['年费费减比例'], 0, 2);
							switch($num){
								case "70":
									$return_data['费用']['实审费'] = 750;
									break;
								case "85":
									$return_data['费用']['实审费'] = 375;
								    break;
								default:
									$return_data['费用']['实审费'] = 2500;
							}
						}
						
						
				   	}
				}
			}
		}
	}
	
	return $return_data;
}
//$path = "05671aC1bG(通知书).zip";
//$path_gbk = iconv("utf-8", "gbk", $path);
//$ret_data = read_advice_xml($path_gbk);
//echo "<br/><hr/>";
//print_r($ret_data);


//读取含有“授权文件”的费用信息
function read_other_xml($path){
	$return_data="";//创建返回数组
//	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
//	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
			   	$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//			   	print_r($xml_arr);
				if(array_key_exists('notice_template_code', $xml_arr)){
					if(substr(@$xml_arr['notice_template_code'],0,6) == "200602"){
						
						$return_data['申请号'] = isset($xml_arr['application_number'])?$xml_arr['application_number']:"";
						$return_data['发文日'] = isset($xml_arr['notice_sent']['notice_sent_date'])?date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date'])):"";
						$return_data['截止日期'] = isset($xml_arr['pay_deadline_date'])?date("Y-m-d",strtotime($xml_arr['pay_deadline_date'])):"";
						$return_data['提醒日期'] = isset($return_data['截止日期'])?date('Y-m-d',strtotime('-1months',strtotime($return_data['截止日期']))):"";
						
						foreach($xml_arr['fee_info_all']['fee_info']['fee'] as $key => $value){
							if($value['fee_amount'] != 0 && isset($value['fee_amount']) && strtolower(gettype($value['fee_amount'] ))!="array" ){
								$return_data['费用'][$value['fee_name']] = $value['fee_amount'];
							}
						}
						$return_data['年度'] = $xml_arr['fee_info_all']['annual_year'];
					}
				}
			}
			
		}
	}
	zip_close($resource);//关闭压缩包
//	print_r($return_data);
	if($return_data != ''){
		$return_data['result'] = "success";
		return $return_data;
	}else{
		$return_data['result'] = "defeated";
		return $return_data;
	}
}

//读取“缴费通知”xml的滞纳金
function read_feeremind_xml($path){
	$return_data="";//创建返回数组
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
			   	$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//			   	print_r($xml_arr);
				if(array_key_exists('notice_template_code', $xml_arr)){
					if(substr(@$xml_arr['notice_template_code'],0,6) == "200701"){
						$return_data['发文日'] = date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));
						$return_data['申请号'] = $xml_arr['application_number'];
						$return_data['缴费年度'] = $xml_arr['annual_year'];
						
						foreach($xml_arr['fee_info']['fee'] as $key_0 => $value_0){
							$return_data['滞纳金'][$key_0]['年费'] = $value_0['annual_fee'];
							$return_data['滞纳金'][$key_0]['滞纳金额'] = $value_0['late_fee'];
							$return_data['滞纳金'][$key_0]['缴费开始时间'] = date("Y-m-d",strtotime($value_0['pay_start_time']));
							$return_data['滞纳金'][$key_0]['缴费截止时间'] = date("Y-m-d",strtotime($value_0['pay_end_time']));
						}
					}
				}
			}
		}
	}
	zip_close($resource);//关闭压缩包
//	print_r($return_data);
	if($return_data != ''){
		$return_data['result'] = "success";
		return $return_data;
	}else{
		$return_data['result'] = "defeated";
		return $return_data;
	}
}

	

	
		
?>