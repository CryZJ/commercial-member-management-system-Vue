<?php

class ReadFilesList{
	protected $conn;
	protected $dir_path = array();
	protected $dir_header;
	public $files_data = array();
	protected $sql_filesdata = array();
	
	public function __construct($db,$path_arr,$dh){
		$this->conn = $db;
		$this->dir_path = $path_arr;
		$this->dir_header = $dh;		
	}
	
	/*
	 * 查询服务器文件夹下的目录文件
	 * */
	protected function GetServerFilesList(){
		foreach($this->dir_path as $index => $dirpath){
			$dirpath_com = $this->dir_header.$dirpath;//完整路径
			if(file_exists($dirpath_com)){//判断文件是否存在
				$handle = opendir($dirpath_com);//打开资源目标
				while( ($filename = readdir($handle)) !== FALSE){//读取资源信息
					if($filename !="." && $filename != ".."){//去掉为“.”或“..”
						if(is_file($dirpath_com."/".$filename)){//判断是否为文件
							$this->files_data[$filename]["name"] = $filename;
							$this->files_data[$filename]["dir_sql"] = $dirpath."/".$filename;
						}else{
							$handle2 = opendir($dirpath_com."/".$filename);
							while( ($filename2 = readdir($handle2)) !== FALSE){
								if($filename2 !="." && $filename2 != ".."){
									if(is_file($dirpath_com."/".$filename."/".$filename2)){
										$this->files_data[$filename2]["name"] = $filename2;
										$this->files_data[$filename2]["dir_sql"] = $dirpath."/".$filename."/".$filename2;
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	/*
	 * 使用类
	 * */
	public function UsingClass(){
		$this->GetServerFilesList();
	}
	
}


require_once "../conn.php";
$dir_start = "../";
$dir_path = array("client_file","filesave","filesave_notice","img_receipt","filesave_send","tmp_fileupload","filesave_sb");
$getdata = new ReadFilesList($conn,$dir_path,$dir_start);
$getdata->UsingClass();
print_r($getdata->files_data);


?>