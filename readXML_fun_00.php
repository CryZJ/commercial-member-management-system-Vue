<?php
	/*受理书*/
	function acceptor_readxml($path){
		$cur_encoding=mb_detect_encoding($path,"GBK,UTF-8",'true');//获取字符串的编码
		$path= iconv($cur_encoding,"gb2312",$path);//改变编码使之能用中文路径
		$ruturn_date=array();//创建返回数组
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
				/*先获取“专利申请受理通知书”*/
				if($ext=='xml' and $basename!='list.xml'){
					$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
				   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
				   	$cur_encoding = mb_detect_encoding($file_put_contents,"GBK,UTF-8",'true');//获取字符串的编码
				   	$str = iconv($cur_encoding,'UTF-8',$file_put_contents);//把字符串的编码更改为utf-8
				   	$str2 = strip_tags($str);//去除字符串中的xml标签
				   	$arr = preg_split("/[\s,]+/",$str2);//转化为数组
//				   	print_r($arr);
					if($arr[1]=="专利申请受理通知书"){
						$ruturn_date['通知书名称'] = $arr[1];	
					}
					if($arr[1]=="费用减缓审批通知书"){
						$ruturn_date['通知书名称'] = $ruturn_date['通知书名称'].",".$arr[1];
						$ruturn_date['发文日期'] = $arr[7];
						$ruturn_date['缴费截止日期'] = $arr[19];
						$ruturn_date['权利要求附加费'] = $arr[21];
						$ruturn_date['优先权要求费'] = $arr[23];	
						$ruturn_date['申请费'] = $arr[25];
						$ruturn_date['说明书附加费'] = $arr[27];
						$ruturn_date['费用金额总计'] = $arr[28];
						
						$ruturn_date['年费费减比例'] = $arr[29];
						$ruturn_date['复审费减比例'] = $arr[30];
					}
				}
				if($basename=='list.xml'){
					$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
				   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
				   	$cur_encoding = mb_detect_encoding($file_put_contents,"GBK,UTF-8",'true');//获取字符串的编码
				   	$str = iconv($cur_encoding,'UTF-8',$file_put_contents);//把字符串的编码更改为utf-8
				   	$str2 = strip_tags($str);//去除字符串中的xml标签
				   	$arr = preg_split("/[\s,]+/",$str2);//转化为数组
//				   	print_r($arr);
					$ruturn_date['申请号']=$arr[5];
					$ruturn_date['申请日']=$arr[12];
				}
			}
//			echo "<hr/>";
		}
//		echo "<hr/>";
//		print_r($ruturn_date);
		return $ruturn_date;
	}
?>