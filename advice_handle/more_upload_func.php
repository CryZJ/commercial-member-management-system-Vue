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

/*读取list.xml*/
function read_list($path){
	$return_data='';//创建返回数组
	$advice_name = '';
	$advice_code = '';
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				if(@$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISBM'] != ''){
					$information = $xml_arr['TONGZHISXJ']['SHUXINGXX'];
					$information['TONGZHISMC'] = str_replace(' ', '', $information['TONGZHISMC']);//去掉空格
					//检测是否有新的通知书类型需要处理
					require("conn.php");
					$flag = "1";
					$sql = "select 通知书编码 from 通知书类型  ";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							if($row['通知书编码'] == $information['TONGZHISBM']){
								$flag = "0";
							}
						}
					}
					if($flag == "1"){
							$sql2 = "insert into 通知书类型(通知书编码,通知书名称,建立流程标志) values(";
							$sql2 .= "'".$information['TONGZHISBM']."','".$information['TONGZHISMC']."','1')";
							$result2 = $conn->query($sql2);
						}
					$conn->close();
					
	//				print_r($xml_arr);
					if($information['TONGZHISBM']=='200101'){
						$return_data['通知书名称']=$information['TONGZHISMC'];//名称可能有点不同但通知书编码会一样，和通知书模板代码前六位一样
						$return_data['通知书编码']=$information['TONGZHISBM'];//TONGZHISBM
						$return_data['专利名称']=$information['FAMINGMC'];
						$return_data['申请号']=$information['SHENQINGH'];
						$return_data['发文日']= date("Y-m-d",strtotime($information['FAWENR']));
						$return_data['申请日']=date("Y-m-d",strtotime($information['SHENQINGR']));
						$return_data['案卷号']=$information['NEIBUBH'];
						$return_data['原案卷号']=$information['ANJUANH'];
					}else if(@$information['TONGZHISBM']=='200021'){
						$advice_name = ",".$information['TONGZHISMC'];
						$advice_code = ",".$information['TONGZHISBM'];
					}
				}else{
					$return_data = '';
				}
				
			}
		}
	}
	zip_close($resource);//关闭压缩包
	if($return_data != ''){
		$return_data['通知书名称']=$return_data['通知书名称'].$advice_name;
		$return_data['通知书编码']=$return_data['通知书编码'].$advice_code;
		$return_data['新类型标志']=$flag;
		$return_data['result'] = "success";
		return $return_data;
	}else{
		$return_data['result'] = "defeated";
		return $return_data;
	}
}

/*上传文件到服务器*/
function my_uploadFile($fileInfo,$path,$ajh){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测文件是否是通过HTTP POST上传上来的
		if(!is_uploaded_file($fileInfo['tmp_name'])){
			$res['mes']=$fileInfo['name'].'文件不是通过HTTP POST方式上传上来的';
		}
		
		//如果文件目录不存在时自动创建
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		$timestamp = time();
		$uniName=$timestamp."_".$fileInfo['name'];//文件名称
		$destination=$path.'/'.$uniName;//编写路径
		$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
//		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
//			$res['mes']='上传失败';
//		}
		if(!copy($fileInfo['tmp_name'],$destination)){
			$res['mes']='上传失败';
		}
		
		//如果文件目录不存在时自动创建
		if($ajh != ''){
			//保存相应案卷号文件
			$path2 = "filesave/".$ajh;
			if(!file_exists($path2)){
				mkdir($path2,0777,true);
				chmod($path2,0777);
			}
			$destination2 = $path2."/".$uniName;//编写路径
			$destination2= iconv("UTF-8","gb2312",$destination2);//改变编码使之能用中文路径
			if(!copy($fileInfo['tmp_name'],$destination2)){
				$res['mes']='上传失败';
			}
			$res['dest2']=$destination2;
			
			//保存接收文件
			$path3 = "mail_file";
			if(!file_exists($path3)){
				mkdir($path3,0777,true);
				chmod($path3,0777);
			}
			$destination3 = $path3."/".$uniName;
			$destination3= iconv("UTF-8","gb2312",$destination3);//改变编码使之能用中文路径
			if(!copy($fileInfo['tmp_name'],$destination3)){
				$res['mes']='上传失败';
			}
			$res['dest3']=$destination3;
			
		}
		
		$res['mes']='上传成功';
		$res['dest']=$destination;
		return $res;
		
	}else{
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

//读取含有“通知书”的费用信息
function read_advice_xml($path){
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
				if(array_key_exists("notice_template_code", $xml_arr)){
					if(substr($xml_arr['notice_template_code'],0,6) == "200021"){
	//					print_r($xml_arr);
						$return_data['申请号'] = $xml_arr['application_number'];
						$return_data['发文日'] = date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));
						$return_data['截止日期'] = date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));
						$return_data['提醒日期'] = date('Y-m-d',strtotime('-1months',strtotime($return_data['截止日期'])));
						
						if(array_key_exists("cost_slow_rate_annul", $xml_arr)){
							if(@$xml_arr['cost_slow_rate_annul'] != NULL  ){
								$return_data['年费费减比例'] = $xml_arr['cost_slow_rate_annul'];
							}else{
								$return_data['年费费减比例']= "100%";
							}
						}else{
							$return_data['年费费减比例']= "100%";
						}
						if(array_key_exists("cost_slow_rate_review", $xml_arr)){
							if(@$xml_arr['cost_slow_rate_review'] != NULL ){
								$return_data['复审费减比例'] = $xml_arr['cost_slow_rate_review'];
							}else{
								$return_data['复审费减比例'] = 0;
							}
						}else{
							$return_data['复审费减比例'] = 0;
						}
						
						foreach($xml_arr['fee_info_all']['fee_info']['fee'] as $key => $value){
							if($value['fee_amount'] != 0){
								$return_data['费用'][$value['fee_name']] = $value['fee_amount'];
							}
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
					}
				}
			}
			
		}
	}
	zip_close($resource);//关闭压缩包
	if($return_data != ''){
		$return_data['result'] = "success";
		return $return_data;
	}else{
		$return_data['result'] = "defeated";
		return $return_data;
	}
}

/*读取list.xml*/
function read_list2($path){
	$return_data='';//创建返回数组
	$advice_name = '';
	$advice_code = '';
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = get_suffix($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				
				
				if(@$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISBM'] != ''){
					$information = $xml_arr['TONGZHISXJ']['SHUXINGXX'];
					$information['TONGZHISMC'] = str_replace(' ', '', $information['TONGZHISMC']);//去掉空格
					//检测是否有新的通知书类型需要处理
					require("conn.php");
					$flag = "1";
					$sql = "select 通知书编码 from 通知书类型  ";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							if($row['通知书编码'] == $information['TONGZHISBM']){
								$flag = "0";
							}
						}
					}
					if($flag == "1"){
							$sql2 = "insert into 通知书类型(通知书编码,通知书名称,建立流程标志) values(";
							$sql2 .= "'".$information['TONGZHISBM']."','".$information['TONGZHISMC']."','1')";
							$result2 = $conn->query($sql2);
						}
					$conn->close();
					
//				print_r($xml_arr);
						$return_data['通知书名称']=$information['TONGZHISMC'];//名称可能有点不同但通知书编码会一样，和通知书模板代码前六位一样
						$return_data['通知书编码']=$information['TONGZHISBM'];//TONGZHISBM
						$return_data['专利名称']=$information['FAMINGMC'];
						$return_data['申请号']=$information['SHENQINGH'];
						$return_data['发文日']= date("Y-m-d",strtotime($information['FAWENR']));
						$return_data['申请日']=date("Y-m-d",strtotime($information['SHENQINGR']));
						$return_data['案卷号']=$information['NEIBUBH'];
						$return_data['原案卷号']=$information['ANJUANH'];
				}else{
					$return_data = '';
				}
				
			}
		}
	}
	zip_close($resource);//关闭压缩包
	if($return_data != ''){
		$return_data['新类型标志']=$flag;
		$return_data['result'] = "success";
		return $return_data;
	}else{
		$return_data['result'] = "defeated";
		return $return_data;
	}
//	print_r($return_data);
//	echo "<br/><hr/>";
}


//读取含有“授权文件”的费用信息
function read_other_xml($path){
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
				if(substr(@$xml_arr['notice_template_code'],0,6) == "200602"){
					$return_data['申请号'] = $xml_arr['application_number'];
					$return_data['发文日'] = date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));
					$return_data['截止日期'] = date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));
					$return_data['提醒日期'] = date('Y-m-d',strtotime('-1months',strtotime($return_data['截止日期'])));
					
					foreach($xml_arr['fee_info_all']['fee_info']['fee'] as $key => $value){
						if($value['fee_amount'] != 0){
							$return_data['费用'][$value['fee_name']] = $value['fee_amount'];
						}
					}
					$return_data['年度'] = $xml_arr['fee_info_all']['annual_year'];
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