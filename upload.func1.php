<?php 

/**
 * 构建上传文件信息
 * @return unknown
 */
function getFiles($myfile){
	$i=0;
	foreach($myfile as $file){
		if(is_string($file['name'])){
			$files[$i]=$file;
			$i++;
		}elseif(is_array($file['name'])){
			foreach($file['name'] as $key=>$val){
				$files[$i]['name']=$file['name'][$key];
				$files[$i]['type']=$file['type'][$key];
				$files[$i]['tmp_name']=$file['tmp_name'][$key];
				$files[$i]['error']=$file['error'][$key];
				$files[$i]['size']=$file['size'][$key];
				$i++;
			}
		}
	}
	return $files;
	
}

/**
 * 得到文件扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename){
	return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}

/**
 * 产生唯一字符串
 * @return string
 */
//function getUniName(){
//	return md5(uniqid(microtime(true),true));
//}
/**
 * 针对于单文件、多个单文件、多文件的上传
 * @param array $fileInfo
 * @param string $path
 * @param string $flag
 * @param number $maxSize
 * @param array $allowExt
 * @return string
 */
function uploadFile($fileInfo,$path,$maxSize){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
		if($fileInfo['size']>$maxSize){
			$res['mes']=$fileInfo['name'].'上传文件过大';
		}
		$ext=getExt($fileInfo['name']);//获取文件后缀
/*		//检测上传文件的文件类型
		if(!in_array($ext,$allowExt)){
			$res['mes']=$fileInfo['name'].'非法文件类型';
		}
		//检测是否是真实的图片类型
		if($flag){
			if(!getimagesize($fileInfo['tmp_name'])){
				$res['mes']=$fileInfo['name'].'不是真实图片类型';
			}
		}
 * 
 */
		//检测文件是否是通过HTTP POST上传上来的
		if(!is_uploaded_file($fileInfo['tmp_name'])){
			$res['mes']=$fileInfo['name'].'文件不是通过HTTP POST方式上传上来的';
		}
//		if($res) return $res;
		//$path='./uploads';
		//如果文件目录不存在时自动创建
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
//		$uniName=getUniName();//获取随机编号作为文件名称
		$uniName=$fileInfo['name'];//文件名称
		$destination=$path.'/'.$uniName;//编写路径
		$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
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

//商标案件文件上传
function myfile5($fileInfo,$path){
	if($fileInfo['error']===UPLOAD_ERR_OK){
		$ext=getExt($fileInfo['name']);//获取文件后缀
		//检测文件是否是通过HTTP POST上传上来的
		if(!is_uploaded_file($fileInfo['tmp_name'])){
			$res['mes']=$fileInfo['name'].'文件不是通过HTTP POST方式上传上来的';
		}
//		if($res) return $res;
		//$path='./uploads';
		//如果文件目录不存在时自动创建
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
//		$uniName=getUniName();//获取随机编号作为文件名称
		$uniName=$fileInfo['name'];//文件名称
		$destination=$path.'/'.time()."_".$uniName;//编写路径
		$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$destination = iconv("gb2312","UTF-8",$destination);
		$res['dest']=$destination;
		return $destination;
		
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

//专案复审的文件上传
function uploadFile_fs($fileInfo,$path){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
//		if($fileInfo['size']>$maxSize){
//			$res['mes']=$fileInfo['name'].'上传文件过大';
//		}
		$ext=getExt($fileInfo['name']);//获取文件后缀
/*		//检测上传文件的文件类型
		if(!in_array($ext,$allowExt)){
			$res['mes']=$fileInfo['name'].'非法文件类型';
		}
		//检测是否是真实的图片类型
		if($flag){
			if(!getimagesize($fileInfo['tmp_name'])){
				$res['mes']=$fileInfo['name'].'不是真实图片类型';
			}
		}
 * 
 */
		//检测文件是否是通过HTTP POST上传上来的
		if(!is_uploaded_file($fileInfo['tmp_name'])){
			$res['mes']=$fileInfo['name'].'文件不是通过HTTP POST方式上传上来的';
		}
//		if($res) return $res;
		//$path='./uploads';
		//如果文件目录不存在时自动创建
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
//		$uniName=getUniName();//获取随机编号作为文件名称
		$uniName=$fileInfo['name'];//文件名称
		$destination=$path.'/'.time()."_".$uniName;//编写路径
		$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=$destination;
//		return $res;
		$destination = iconv("utf-8", "gbk", $destination);
		return $destination;
		
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

/*上传多个文件并返回路径的函数*/
function upload_allfile6($fileInfo,$uploadPath){
	// 判断错误号
	if ($fileInfo ['error'] > 0) {
		switch ($fileInfo ['error']) {
			case 1 :
				$mes = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
				break;
			case 2 :
				$mes = '超过了表单MAX_FILE_SIZE限制的大小';
				break;
			case 3 :
				$mes = '文件部分被上传';
				break;
			case 4 :
				$mes = '没有选择上传文件';
				break;
			case 6 :
				$mes = '没有找到临时目录';
				break;
			case 7 :
			case 8 :
				$mes = '系统错误';
				break;
		}
		echo ( $mes );
		return false;
	}
	$ext = pathinfo ( $fileInfo ['name'], PATHINFO_EXTENSION );

	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
//	if($id_num!=''){
//		$destination = $uploadPath . '/' . $id_num.'_'.$uniName;//文件路径
//	}else{
//		$destination = $uploadPath . '/' . $uniName;
//	}
	$uniName = $fileInfo['name'];
	
	$destination = $uploadPath . '/' . time()."_".$uniName;
	
	$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
	if (! @move_uploaded_file ( $fileInfo ['tmp_name'], $destination )) {
		exit ( '文件移动失败' );
	}
	
	//echo '文件上传成功';
// 	return array(
// 		'newName'=>$destination,
// 		'size'=>$fileInfo['size'],
// 		'type'=>$fileInfo['type']
// 	);
}
