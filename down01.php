<?php
	
//function download($file_dir,$file_name)
//下载函数
function download($file_dir)
{
	//参数说明：
	//file_dir:文件所在目录
	//file_name:文件名
	$file_name=basename($file_dir);
    $file_dir = chop($file_dir);//去掉路径中多余的空格
    $file_path = $file_dir;
    //得出要下载的文件的路径:如果路径不包含文件名
    /*if($file_dir != '')
    {
        $file_path = $file_dir;
        if(substr($file_dir,strlen($file_dir)-1,strlen($file_dir)) != '/'){
            //echo substr($file_dir,strlen($file_dir)-1,strlen($file_dir));
            //$file_path .= '/';
        }
       // $file_path .= $file_name;
    }            
    else{
    	//$file_path = $file_name; 
    	exit;
    }
    */
   //判断要下载的文件是否存在
    if(!file_exists($file_path)){
        echo '对不起,你要下载的文件不存在。';
        return false;
    }
    $file_size = filesize($file_path);
 
    header("Content-type: application/octet-stream");
    header("Accept-Ranges: bytes");
    header("Accept-Length: $file_size");
    header("Content-Disposition: attachment; filename=".$file_name);
    
    $fp = fopen($file_path,"r");
    $buffer_size = 1024;
    $cur_pos = 0;
    
    while(!feof($fp)&&$file_size-$cur_pos>$buffer_size)
    {
        $buffer = fread($fp,$buffer_size);
        echo $buffer;
        $cur_pos += $buffer_size;
    }
    
    $buffer = fread($fp,$file_size-$cur_pos);
    echo $buffer;
    fclose($fp);
    return true;
}
	
	$file_dir = $_GET['path'];
	//$file_dir="filesave/2017-02-25 02-32-28pm/1872.zip";
	//$file_name='';
	download($file_dir);
?>