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
function suffix($name){
	$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION ));
	return $ext;
}
/*
 *读取受理通知书的xml文件 
 */
function acceptor_readxml($path){
	$ruturn_date=array();//创建返回数组
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
//		echo gettype($resource)."<br/>";//php的资源类型：resource
//		echo $resource."<br/><hr/>";//输出：Resource id #2
	while ($dir_resource = zip_read($resource)){
//			echo gettype($dir_resource)."<br/>";//php的资源类型：resource
//			echo $dir_resource."<br/>";//输出：Resource id #i(i=3,4,...)			
		if(zip_entry_open($resource,$dir_resource)){
			/*读取方式：先读取最外面的文件，再读取文件夹里面的文件
			 * 首个读取肯定是list.xml文件
			 * */
			$file_name = zip_entry_name($dir_resource);
//				echo gettype($file_name)."</br>";//类型：string
//				echo $file_name."</br>";//首个输出：GA000052044969\GA000052044969\GA000052044969\000001.tif
			$basename = basename($file_name);//获取文件名称
//				echo $basename."<br/>";//输出：000001.tif
			$ext = pathinfo ( $basename, PATHINFO_EXTENSION );//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
			   	$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//			   	print_r($xml_arr);
//					echo gettype($xml_obj);
//					echo $xml_obj->notice_name."<br/><hr/>";
				if($xml_obj->notice_name == '费用减缓审批通知书' || substr($xml_obj->notice_template_code,0,6) == '200103'){
//					print_r($xml_obj);
//					$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//					print_r($xml_arr);
//					$ruturn_date['通知书名称']=$xml_arr['notice_name'];//读取通知书名称
					$ruturn_date['发文日期']=date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));//发文日期
					$ruturn_date['缴费截止日期']=date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));//缴费截止日期
					/*获取各种费用*/
					$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
//					echo gettype($fee_arr).count($fee_arr)."<br/><hr/>";
					for($i=0;$i<count($fee_arr);$i++){
						if($fee_arr[$i]['fee_amount'] != 0){
							$fee_name = $fee_arr[$i]['fee_name'];//费用名称
							$ruturn_date['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
						}
					}
					if($xml_obj->notice_template_code != '20010301'){
						$ruturn_date['年费费减比例']=$xml_arr['cost_slow_rate_annul'];
						if(@$xml_arr['cost_slow_rate_review'] !=null){
							$ruturn_date['复审费减比例']=@$xml_arr['cost_slow_rate_review']; 
						}else{
							$ruturn_date['复审费减比例']="100％";
						}
					}else{
						$ruturn_date['年费费减比例'] = "100％";
						$ruturn_date['复审费减比例'] = "100％";
					}
					//判断是否有实审费
					if(substr($xml_arr['application_number'],4,1) == 1){
						$num = substr($ruturn_date['年费费减比例'], 0, 2);
						switch($num){
							case "70":
								$ruturn_date['费用']['实审费'] = 750;
								break;
							case "85":
								$ruturn_date['费用']['实审费'] = 375;
							    break;
							default:
								$ruturn_date['费用']['实审费'] = 2500;
						}
					}
					
					$ruturn_date['费用金额总计']=$xml_arr['fee_info_all']['fee_total'];
					
					
					/*输出测试*/
//					print_r($ruturn_date);
//					foreach($ruturn_date as $key=>$value){
//						echo $key."->".$value."<br/>";
//					}
				}
			}
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				if($xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC']=='专利申请受理通知书'){
					$ruturn_date['专利名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['FAMINGMC'];
					$ruturn_date['申请号']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGH'];
					$ruturn_date['申请日']=date("Y-m-d",strtotime($xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGR']));
					$ruturn_date['通知书名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
					
				}else{
					$ruturn_date['通知书名称']=$ruturn_date['通知书名称'].",".$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
				}
			}
		}
	}
	zip_close($resource);//关闭压缩包
//	foreach($ruturn_date as $key => $value){
//		echo $key."\n ->".$value."<br/>";
//	}
//	print_r($ruturn_date);
	return $ruturn_date;
}	
	
//授权公告
function impower($path){
	$ruturn_date=array();//创建返回数组
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
	while ($dir_resource = zip_read($resource)){
		if(zip_entry_open($resource,$dir_resource)){
			/*读取方式：先读取最外面的文件，再读取文件夹里面的文件
			 * 首个读取肯定是list.xml文件
			 * */
			$file_name = zip_entry_name($dir_resource);
			$basename = basename($file_name);//获取文件名称
			$ext = strtolower(pathinfo($basename, PATHINFO_EXTENSION ));//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				
				$ruturn_date['发文日期'] = (array_key_exists("notice_sent",$xml_arr) && array_key_exists("notice_sent_date",$xml_arr['notice_sent'])) ? date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date'])) : "";
				$ruturn_date['办理登记缴费截止日期'] = array_key_exists("pay_deadline_date", $xml_arr)?date("Y-m-d",strtotime($xml_arr['pay_deadline_date'])) : "";
				
				/*获取各种费用*/
				$countfee = 0;//应缴总费用
				if(array_key_exists("fee_info_all",$xml_arr) && array_key_exists("fee_info",$xml_arr["fee_info_all"]) && array_key_exists("fee",$xml_arr["fee_info_all"]["fee_info"])){
					$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
					for($i=0;$i<count($fee_arr);$i++){
						if($fee_arr[$i]['fee_amount'] != 0 && strtolower(gettype($fee_arr[$i]['fee_amount'])) == "string"){
							$fee_name = $fee_arr[$i]['fee_name'];//费用名称
							$ruturn_date['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
							$countfee = $countfee + $fee_arr[$i]['fee_amount'];//费用相加
						}
					}
				}
				
				$ruturn_date['应缴费用']= $countfee;
				$ruturn_date['缴纳年费年度']= (array_key_exists("fee_info_all", $xml_arr) && array_key_exists("annual_year", $xml_arr["fee_info_all"])) ? $xml_arr["fee_info_all"]["annual_year"] : "";
				$ruturn_date['减缓标记']= (array_key_exists("fee_info_all", $xml_arr) && array_key_exists("cost_slow_flag", $xml_arr["fee_info_all"])) ? $xml_arr["fee_info_all"]["cost_slow_flag"] : "";
				
			}
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//				print_r($xml_arr);
				$ruturn_date['通知书名称']=(array_key_exists("TONGZHISXJ", $xml_arr) && array_key_exists("SHUXINGXX", $xml_arr['TONGZHISXJ']) && array_key_exists("TONGZHISMC", $xml_arr['TONGZHISXJ']['SHUXINGXX']) ) ? $xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'] : "";
			}
		}

	}
	
	zip_close($resource);//关闭压缩包
//	foreach($ruturn_date as $key => $value){
//		echo $key."\n ->".$value."<br/>";
//	}
//	print_r($ruturn_date);
	return $ruturn_date;	
}

//批量上传受理通知书
function acceptor_readxml_all($path){
	$ruturn_date=array();//创建返回数组
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
//		echo gettype($resource)."<br/>";//php的资源类型：resource
//		echo $resource."<br/><hr/>";//输出：Resource id #2
	while ($dir_resource = zip_read($resource)){
//			echo gettype($dir_resource)."<br/>";//php的资源类型：resource
//			echo $dir_resource."<br/>";//输出：Resource id #i(i=3,4,...)			
		if(zip_entry_open($resource,$dir_resource)){
			/*读取方式：先读取最外面的文件，再读取文件夹里面的文件
			 * 首个读取肯定是list.xml文件
			 * */
			$file_name = zip_entry_name($dir_resource);
//				echo gettype($file_name)."</br>";//类型：string
//				echo $file_name."</br>";//首个输出：GA000052044969\GA000052044969\GA000052044969\000001.tif
			$basename = basename($file_name);//获取文件名称
//				echo $basename."<br/>";//输出：000001.tif
			$ext = pathinfo ( $basename, PATHINFO_EXTENSION );//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
			   	$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//			   	print_r($xml_arr);
//					echo gettype($xml_obj);
//					echo $xml_obj->notice_name."<br/><hr/>";
				if($xml_obj->notice_name == '费用减缓审批通知书'){
//					print_r($xml_obj);
					$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//					print_r($xml_arr);
					$ruturn_date['通知书名称']=$xml_arr['notice_name'];//读取通知书名称
					$ruturn_date['发文日期']=date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));//发文日期
					$ruturn_date['缴费截止日期']=date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));//缴费截止日期
					/*获取各种费用*/
					$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
//					echo gettype($fee_arr).count($fee_arr)."<br/><hr/>";
					for($i=0;$i<count($fee_arr);$i++){
						if($fee_arr[$i]['fee_amount'] != 0){
							$fee_name = $fee_arr[$i]['fee_name'];//费用名称
							$ruturn_date['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
						}
					}
					
					$ruturn_date['费用金额总计']=$xml_arr['fee_info_all']['fee_total'];
					$ruturn_date['年费费减比例']=$xml_arr['cost_slow_rate_annul'];
					if(@$xml_arr['cost_slow_rate_review'] !=null){
						$ruturn_date['复审费减比例']=@$xml_arr['cost_slow_rate_review']; 
					}else{
						$ruturn_date['复审费减比例']='0';
					}
					/*输出测试*/
//					print_r($ruturn_date);
//					foreach($ruturn_date as $key=>$value){
//						echo $key."->".$value."<br/>";
//					}
				}
			}
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				if($xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC']=='专利申请受理通知书'){
					$ruturn_date['专利名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['FAMINGMC'];
					$ruturn_date['申请号']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGH'];
					$ruturn_date['申请日']=date("Y-m-d",strtotime($xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGR']));
					$ruturn_date['通知书名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
					
				}else{
					$ruturn_date['通知书名称']=$ruturn_date['通知书名称'].",".$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
				}
			}
		}
	}
	zip_close($resource);//关闭压缩包
//	foreach($ruturn_date as $key => $value){
//		echo $key."\n ->".$value."<br/>";
//	}
//	print_r($ruturn_date);
	if($ruturn_date['通知书名称']=="专利申请受理通知书,费用减缴审批通知书" || $ruturn_date['通知书名称']=="费用减缴审批通知书,专利申请受理通知书"){
		$ruturn_date["结果"]	= "成功";
		return $ruturn_date;
	}else{
		$ruturn_date["结果"] = "失败";
		return $ruturn_date;
	}
	
}

//批量读取授权通知的函数
function impower_all($path){
	$ruturn_date=array();//创建返回数组
	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
	$resource = zip_open($path);//获取文件句柄
//		echo gettype($resource)."<br/>";//php的资源类型：resource
//		echo $resource."<br/><hr/>";//输出：Resource id #2
	while ($dir_resource = zip_read($resource)){
//			echo gettype($dir_resource)."<br/>";//php的资源类型：resource
//			echo $dir_resource."<br/>";//输出：Resource id #i(i=3,4,...)			
		if(zip_entry_open($resource,$dir_resource)){
			/*读取方式：先读取最外面的文件，再读取文件夹里面的文件
			 * 首个读取肯定是list.xml文件
			 * */
			$file_name = zip_entry_name($dir_resource);
//				echo gettype($file_name)."</br>";//类型：string
//				echo $file_name."</br>";//首个输出：GA000052044969\GA000052044969\GA000052044969\000001.tif
			$basename = basename($file_name);//获取文件名称
//				echo $basename."<br/>";//输出：000001.tif
			$ext = pathinfo ( $basename, PATHINFO_EXTENSION );//获取文件的后缀：xml
			if($ext=='xml' and $basename!='list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//				print_r($xml_arr);
				$ruturn_date['发文日期']=date("Y-m-d",strtotime($xml_arr['notice_sent']['notice_sent_date']));//发文日期
				$ruturn_date['办理登记缴费截止日期']=date("Y-m-d",strtotime($xml_arr['pay_deadline_date']));//办理登记缴费截止日期
				/*获取各种费用*/
				$fee_arr = $xml_arr['fee_info_all']['fee_info']['fee'];//获取费用数组
//					echo gettype($fee_arr).count($fee_arr)."<br/><hr/>";
				for($i=0;$i<count($fee_arr);$i++){
					if($fee_arr[$i]['fee_amount'] != 0){
						$fee_name = $fee_arr[$i]['fee_name'];//费用名称
						$ruturn_date['费用'][$fee_name]=$fee_arr[$i]['fee_amount'];//费用金额
					}
				}
				$ruturn_date['应缴费用']=$xml_arr['fee_info_all']['fee_payable'];//应缴费用：总费用
				$ruturn_date['缴纳年费年度']=$xml_arr['fee_info_all']['annual_year'];//缴纳年费年度
				$ruturn_date['减缓标记']=$xml_arr['fee_info_all']['cost_slow_flag'];//减缓标记:费减比例
			}
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
//				print_r($xml_arr);
				$ruturn_date['通知书名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
				$ruturn_date['专利名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['FAMINGMC'];
				$ruturn_date['申请号']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGH'];
				$ruturn_date['申请日']=date("Y-m-d",strtotime($xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGR']));
			}
		}

	}
	
	zip_close($resource);//关闭压缩包
//	foreach($ruturn_date as $key => $value){
//		echo $key."\n ->".$value."<br/>";
//	}
//	print_r($ruturn_date);
	if($ruturn_date['通知书名称']=="办理登记手续通知书"){
		$ruturn_date['结果']="成功";
		return $ruturn_date;
	}else{
		$ruturn_date['结果']="失败";
		return $ruturn_date;
	}
		
}

//只读zip文件中的list.xml文件
function read_list($path){
	$return_data=array();//创建返回数组
	$return_data['result'] = 'defeated';
//	$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
	$path= iconv("utf-8","gbk",$path);//改变编码使之能用中文路径
	
	$resource = zip_open($path);//获取文件句柄
//		echo gettype($resource)."<br/>";//php的资源类型：resource
//		echo $resource."<br/><hr/>";//输出：Resource id #2
	while($dir_resource = zip_read($resource)){
//			echo gettype($dir_resource)."<br/>";//php的资源类型：resource
//			echo $dir_resource."<br/>";//输出：Resource id #i(i=3,4,...)			
		if(zip_entry_open($resource,$dir_resource)){
			/*读取方式：先读取最外面的文件，再读取文件夹里面的文件
			 * 首个读取肯定是list.xml文件
			 * */
			$file_name = zip_entry_name($dir_resource);
//				echo gettype($file_name)."</br>";//类型：string
//				echo $file_name."</br>";//首个输出：GA000052044969\GA000052044969\GA000052044969\000001.tif
			$basename = basename($file_name);//获取文件名称
//				echo $basename."<br/>";//输出：000001.tif
			$ext = pathinfo ( $basename, PATHINFO_EXTENSION );//获取文件的后缀：xml
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray($xml_obj);//将对象转化为数组
				$return_data['result'] = 'success';
				$return_data['专利名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['FAMINGMC'];
				$return_data['申请号']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGH'];
				$return_data['申请日']=date("Y-m-d",strtotime($xml_arr['TONGZHISXJ']['SHUXINGXX']['SHENQINGR']));
				$return_data['通知书名称']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['TONGZHISMC'];
				$return_data['案卷号']=$xml_arr['TONGZHISXJ']['SHUXINGXX']['NEIBUBH'];	
			}
		}
	}
	
	zip_close($resource);//关闭压缩包
	return 	$return_data;
}


	
//测试以上函数
//	$path = "filesave/0000623143/3180X(通知书).zip";//获取文件路径
//	$path = "filesave/0000623143/2_801(通知书).zip";//获取文件路径
//	$path = "filesave/00001DA1AD/7_1244.zip";
//	$path = "filesave/00001DA1AD/6_1244(通知书).zip";
//	$path= iconv("UTF-8","gb2312",$path);//改变编码使之能用中文路径
//	$str = acceptor_readxml($path);
//	$str = impower($path);//调用函数返回数组
//	echo "<br/>".$str[0]."\n".$str[1]."\n".$str[2];//输出测试

//	$path = "05770aV3bF（刘）.zip";
//	$redata = impower($path);
//	print_r($redata);
 
 
?>