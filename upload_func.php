<?php 


/**
 * 得到文件扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename){
	return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}
//获取路径的相关信息
/*
 * @param string $path
 * @return array index[dirname,basename,filename,extension,lowerextension]
 * */
function get_pathinfo($my_path){
	$info_arr = pathinfo($my_path);
	$info_arr["lowerextension"] = strtolower($info_arr["extension"]);
	return $info_arr;
}

/*毫秒级的时间戳*/
function getMillisecond2() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}

/*将对象转化为数组*/
function objectToArray2($e){
    $e=(array)$e;
    foreach($e as $k=>$v){
        if( gettype($v)=='resource' ) return;
        if( gettype($v)=='object' || gettype($v)=='array' )
            $e[$k]=(array)objectToArray2($v);
    }
    return $e;
}

//$fileInfo=$_FILES['myFile'];
/*上传单个文件并返回路径*/
function uploadFile($fileInfo,$uploadPath,$maxSize,$id_num){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
	if ($fileInfo ['size'] > $maxSize) {
		exit ( '上传文件过大' );
	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
	if($id_num!=''){
		$destination = $uploadPath . '/' . $id_num.'_'.$uniName;//文件路径
	}else{
		$destination = $uploadPath . '/' . $uniName;
	}
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
	return $destination;
}


/*上传多个文件并返回路径的函数*/
function upload_allfile($fileInfo,$uploadPath,$maxSize){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
	if ($fileInfo ['size'] > $maxSize) {
		exit ( '上传文件过大' );
	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
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
	return $destination;
}


//发送文件上传：mailas.php,file_mailmas_save.php
function filemail($fileInfo,$uploadPath){
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

	//$maxSize = 2097152; // 2M
	// 检测上传文件大小是否符合规范
//	if ($fileInfo ['size'] > $maxSize) {
//		exit ( '上传文件过大' );
//	}
	
	//判断文件夹是否存在
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	
	//拼出路径
	$uniName = $fileInfo['name'];
	$destination = $uploadPath . '/' . time()."_".$uniName;
	
	//开始一定文件
	$destination= iconv("UTF-8","gb2312",$destination);//改变编码使之能用中文路径
	if (! @move_uploaded_file ( $fileInfo ['tmp_name'], $destination )) {
		exit ( '文件移动失败' );
	}
	
	//返回路径
	return $destination;	
}



//快递底单上传
function upload_dd($fileInfo,$uploadPath,$maxSize='209715200'){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
//	if ($fileInfo ['size'] > $maxSize) {
//		exit ( '上传文件过大' );
//	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
	$destination = $uploadPath.'/'.time()."_".$uniName;
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
	return $destination;
}

//申请人文件上传
function client_upload($fileInfo,$uploadPath,$maxSize='209715200'){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
//	if ($fileInfo ['size'] > $maxSize) {
//		exit ( '上传文件过大' );
//	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
	$destination = $uploadPath.'/'.time()."_".$uniName;
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
	$destination= iconv("gb2312","UTF-8",$destination);//保存数据库的编码
	return $destination;
}


//案件登记文件上传
function casemark_upload($fileInfo,$uploadPath,$maxSize='209715200'){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
//	if ($fileInfo ['size'] > $maxSize) {
//		exit ( '上传文件过大' );
//	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
	$destination = $uploadPath.'/'.time()."_".$uniName;
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
	$destination= iconv("gb2312","UTF-8",$destination);//保存数据库的编码
	return $destination;
}

//案卷流程及文档的文件上传
function ajjlc_upfile($fileInfo,$uploadPath,$maxSize='209715200'){
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
// 	$allowExt = array (
// 			'jpeg',
// 			'jpg',
// 			'png',
// 			'gif' 
// 	);
//	if(!is_array($allowExt)){
//		exit('系统错误');
//	}
//	// 检测上传文件的类型
//	if (! in_array ( $ext, $allowExt )) {
//		exit ( '非法文件类型' );
//	}
	//$maxSize = 2097152; // 2M
	                  // 检测上传文件大小是否符合规范
//	if ($fileInfo ['size'] > $maxSize) {
//		exit ( '上传文件过大' );
//	}
	//检测图片是否为真实的图片类型
	//$flag=true;	
	//if($flag){
	//	if(!getimagesize($fileInfo['tmp_name'])){
	//		exit('不是真实图片类型');
	//	}
	//}
	// 检测文件是否是通过HTTP POST方式上传上来
//	if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
//		exit ( '文件不是通过HTTP POST方式上传上来的' );
//	}
	//$uploadPath = 'uploads';
	if (! file_exists ( $uploadPath )) {
		mkdir ( $uploadPath, 0777, true );
		chmod ( $uploadPath, 0777 );
	}
	//$uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;//加密名称
	$uniName = $fileInfo['name'];
	$destination = $uploadPath.'/'.time()."_".$uniName;
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
	$destination= iconv("gb2312","UTF-8",$destination);//保存数据库的编码
	return $destination;
}


//专利案件新建的文件上传
function uploadFile_za($fileInfo,$path){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
//		if($fileInfo['size']>$maxSize){
//			$res['mes']=$fileInfo['name'].'上传文件过大';
//		}
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$destination= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=iconv("gbk","UTF-8",$destination);
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

//专利“无效”案件新建的文件上传
function uploadFile_wx($fileInfo,$path){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
//		if($fileInfo['size']>$maxSize){
//			$res['mes']=$fileInfo['name'].'上传文件过大';
//		}
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$destination= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=iconv("gbk","UTF-8",$destination);
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

//"专案其他文件"的新建的文件上传与新建文件监控时的文件保存,详情的文件上传保存
function uploadFile_Else($fileInfo,$path){
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
//		$uniName=getUniName();//获取随机编号作为文件名称
		$uniName=$fileInfo['name'];//文件名称
		$destination=$path.'/'.$uniName;//编写路径
		$destination= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=iconv("gbk","UTF-8",$destination);
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

//"软件_信息"的新建的文件上传与新建文件监控时的文件保存,详情的文件上传保存
function uploadFile_rj($fileInfo,$path){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
//		if($fileInfo['size']>$maxSize){
//			$res['mes']=$fileInfo['name'].'上传文件过大';
//		}
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$destination= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=iconv("gbk","UTF-8",$destination);
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

//"著作_信息"的新建的文件上传
function uploadFile_zz($fileInfo,$path){
	//$flag=true;
	//$allowExt=array('jpeg','jpg','gif','png');
	//$maxSize=1048576;//1M
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK){
		//检测上传得到小
//		if($fileInfo['size']>$maxSize){
//			$res['mes']=$fileInfo['name'].'上传文件过大';
//		}
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$destination= iconv("UTF-8","gbk",$destination);//改变编码使之能用中文路径
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=iconv("gbk","UTF-8",$destination);
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
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
//商标黑白:保存连个文件：一个有中文，一个无中文（仅要时间戳）
function myfile6($fileInfo,$path){
	if($fileInfo['error']===UPLOAD_ERR_OK){
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$timestamp = time();
		//先复制无中文的文件保存
		$path_info = get_pathinfo($uniName);
		$destination2 = $path.'/'.$timestamp.".".$path_info["extension"];//编写路径
		@copy($fileInfo['tmp_name'], $destination2);
		//保存数据库的
		$destination=$path.'/'.$timestamp."_".$uniName;//编写路径
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

//复制文件
function Filecopy($sour_path,$dest_path){
	$path = pathinfo($dest_path,PATHINFO_DIRNAME);
	//如果文件目录不存在时自动创建
	if(!file_exists($path)){
		mkdir($path,0777,true);
		chmod($path,0777);
	}	
	$sqr_filename_gbk = iconv("utf-8","gbk",$sour_path);
	$copy_path_gbk = iconv("utf-8","gbk",$dest_path);
	if(file_exists($sqr_filename_gbk)){
		if(!copy($sqr_filename_gbk,$copy_path_gbk)){
			return false;
		}else{
			return true;
		}
	}
}

//分享文件上传/发送文件上传/支出记录
function File_share($fileInfo,$path){
	if($fileInfo['error']===UPLOAD_ERR_OK){
//		$ext=getExt($fileInfo['name']);//获取文件后缀
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
		$destination=$path.'/'.getMillisecond2()."_".$uniName;//编写路径
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



/*读取list.xml的信息*/
function Read_listxml_2($path){
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
			$ext = getExt($basename);//获取文件的后缀：xml
			if($ext=='xml' and $basename == 'list.xml'){
				$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
			   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
			   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
				$xml_arr = objectToArray2($xml_obj);//将对象转化为数组
				if(array_key_exists("TONGZHISXJ", $xml_arr)){
					$information = $xml_arr['TONGZHISXJ']['SHUXINGXX'];
					if(array_key_exists("TONGZHISBM", $information)){
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
							
						}else if(@$information["TONGZHISBM"] == "200103"){//缴纳申请费通知书
							$jn_data["通知书名称"] = $information['TONGZHISMC'];
							$jn_data["通知书编码"] = $information['TONGZHISBM'];
							
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
	}else{
		$return_data["result"] = false;
	}
	return $return_data;
}


//只获取通知书名称
function Get_TONGZHISMC($path_gbk){
	$tzhmc = "";
	if(!empty($path_gbk)){
		if(file_exists($path_gbk)){
			$resource = zip_open($path_gbk);//获取文件句柄
			while ($dir_resource = zip_read($resource)){
				if(zip_entry_open($resource,$dir_resource)){
					$file_name = zip_entry_name($dir_resource);
					$basename = pathinfo($file_name,PATHINFO_BASENAME);//获取文件名称
					$ext = getExt($basename);//获取文件的后缀：xml
					if($basename == 'list.xml'){
						$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
					   	$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
					   	$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
						$xml_arr = objectToArray2($xml_obj);//将对象转化为数组
						if(array_key_exists("TONGZHISXJ", $xml_arr)){
							if(array_key_exists("SHUXINGXX", $xml_arr['TONGZHISXJ'])){
								$information = $xml_arr['TONGZHISXJ']['SHUXINGXX'];
								if(array_key_exists("TONGZHISMC", $information)){
									$tzhmc = $information['TONGZHISMC'];
								}
							}
						}
					}
				}
			}
		}
	}
	
	return $tzhmc;
}
