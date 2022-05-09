<?php
	/*输入参数：$path指zip文件路径
		函数返回数组[0]申请号,[1]申请日,[2]费减比例
	*/
	function readxml($path){
		$sqh=$date=$fj="";
		
		$resource = zip_open($path);
		
		while ($dir_resource = zip_read($resource)) {
			//如果能打开则继续
		  if (zip_entry_open($resource,$dir_resource)) {
		   //获取当前项目的名称,即压缩包里面当前对应的文件名
		   $file_name = zip_entry_name($dir_resource);
		   
		   //获取文件的类型：后缀名
		   $ext = pathinfo ( $file_name, PATHINFO_EXTENSION );
		  	 //如果不是目录，则写入文件
		  	 
		  	 //获取申请号、申请日期
		  	 $basename = basename($file_name);//获取最后的文件名
		  	 if($ext == 'xml' ){
		  	 	if($basename == 'list.xml'){
				   		//print_r($file_name);
				   		//echo "\t +1 <br/>";
				   		//echo "<br/>".$basename."<br/>";
				   		$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
				   		$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
				   		//echo $file_put_contents;
				   		//print_r($file_put_contents);
				   		//echo gettype($file_put_contents);
				   		$cur_encoding = mb_detect_encoding($file_put_contents,"GBK,UTF-8",'true');//获取字符串的编码
				   		$str = iconv($cur_encoding,'UTF-8',$file_put_contents);//把字符串的编码更改为utf-8
				   		
				   		  
				   		$str2 = strip_tags($str);//去除字符串中的xml标签
				   		//print_r($str2);
				   		
				   		
				   		$arr = preg_split("/[\s,]+/",$str2);//转化为数组
				   		//print_r($arr);
				   	/*Array (  [0] => 
				   	 * 		   [1] => GA000117598170 
				   	 * 		   [2] => 2016072001283970 
						   	 * [3] => 60 
						   	 * [4] => 一种可装载糖果的玩具拳头 
						   	 * [5] => 2016203145261 
						   	 * [6] => 20160725 
						   	 * [7] => 第N次补正通知书 
						   	 * [8] => 220302 
						   	 * [9] => 1 
						   	 * [10] => 2016041561845326 
						   	 * [11] => 1872 
						   	 * [12] => 20160415 
						   	 * [13] => 1 
						   	 * [14] => 70771867 
						   	 * [15] => GA000117598170_ca.txt 
						   	 * [16] => )
					  */
					  if($arr[7]=="专利申请受理通知书"){
					  	//print_r($arr);
						$sqh =$arr[5];
						$date = $arr[12];
					  }
					  continue;
		  	 			//echo $sqh."<br>";
		  	 	}else{
		  	 		//获取费减比例
		  	 		//print_r($file_name);
				   		//echo "\t +1 <br/>";
				   		//echo "<br/>".$basename."<br/>";
				   		$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
				   		$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
				   		//echo $file_put_contents;
				   		//print_r($file_put_contents);
				   		//echo gettype($file_put_contents);
				   		$cur_encoding = mb_detect_encoding($file_put_contents,"GBK,UTF-8",'true');//获取字符串的编码
				   		$str = iconv($cur_encoding,'UTF-8',$file_put_contents);//把字符串的编码更改为utf-8
				   		
				   		  
				   		$str2 = strip_tags($str);//去除字符串中的xml标签
				   		//print_r($str2);
				   		
				   		
				   		$arr = preg_split("/[\s,]+/",$str2);//转化为数组
				   		//print_r($arr);
						if($arr[1]=="费用减缓审批通知书"){
							//print_r($arr);	
							$fj = $arr[25];
						}
						continue;
						
		  	 			//echo $sqh."<br>";
		  	 		
		  	 	}
				
		   	}
			zip_entry_close($dir_resource);
		  }
		}
		//关闭压缩包
 		zip_close($resource);
 		$retu_date = array($sqh,$date,$fj);
 		return $retu_date;
	}
/*	
	//测试以上函数
	$path = "filesave/000111SZ/2017-03-21 01-34-28pm/3180X(通知书).zip";//获取文件路径
	$path= iconv("UTF-8","gb2312",$path);//改变编码使之能用中文路径
	$str = readxml($path);//调用函数返回数组
	echo "<br/>".$str[0]."\n".$str[1]."\n".$str[2];//输出测试
 * 
 */
?>