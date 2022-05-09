<?php
/*
 * 说明：各案件详情的文件替换
 * 
 * */
header('content-type:text/html;charset=utf-8');
require("../../AHeader.php");
require("../../conn.php");
require_once "../../upload_func.php";//连接下载函数文件
$flag = $_POST['flag'];
	
	//专利案件详情的文件替换的保存
	if($flag == "za"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,文件路径 FROM 案卷流程及文档 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['文件路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
//					require("../../advice_handle/upfile_more_func.php");
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$ret_data = Read_listxml_2($path_gbk);
						$tzhmc = $ret_data['通知书名称'];
					}
				}
				$sql = "";
				$sql = "UPDATE 案卷流程及文档 SET 处理人='".$name."',时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',通知书名称='".$tzhmc."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','替换文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($ret_path,PATHINFO_BASENAME)."”文件')";
					$conn->query($sql);
					$ret_data .= basename($ret_path)."替换成功\n";
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“案卷流程及文档”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“案卷流程及文档”中id没有".$id."\n";
		}

		echo $ret_data;//返回的信息
	}
	
	//“无效详情”的文件替换
	if($flag == "wx"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,文件路径 FROM 案卷流程及文档 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['文件路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
//					require("../../advice_handle/upfile_more_func.php");
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$ret_data = Read_listxml_2($path_gbk);
						$tzhmc = $ret_data['通知书名称'];
					}
				}
				$sql = "";
				$sql = "UPDATE 案卷流程及文档 SET 处理人='".$name."',时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',通知书名称='".$tzhmc."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."替换成功\n";
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“案卷流程及文档”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“案卷流程及文档”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息
	}
	
	//“其他案件详情”的文件替换
	if($flag == "fs"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,文件路径  FROM 案卷流程及文档  WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['文件路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_ZLElse"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$tzhmc = "";
				if(strtolower(pathinfo($ret_path,PATHINFO_EXTENSION)) == "zip"){//如果是zip文件则读取list.xml文件
//					require("../../advice_handle/upfile_more_func.php");
					$path_gbk = iconv("utf-8", "gbk", "../../".$ret_path);
					if(file_exists($path_gbk)){
						$ret_data = Read_listxml_2($path_gbk);
						$tzhmc = $ret_data['通知书名称'];
					}
				}
				$sql = "";
				$sql = "UPDATE 案卷流程及文档  SET 处理人='".$name."',时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."替换成功\n";
					$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','替换文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($ret_path,PATHINFO_BASENAME)."”文件')";
					$conn->query($sql);
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“专案其他文件”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“专案其他文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息
	}
	
	//软件的详情的文件替换的保存
	if($flag == "rj"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,路径 FROM 软件_文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_rj"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$sql = "";
				$sql = "UPDATE 软件_文件 SET 处理人='".$name."',时间='".date("Y-m-d H:i:s")."',路径='".$ret_path."',删除状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."替换成功\n";
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“软件_文件”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“软件_文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息

	}
	
	//著作的详情的文件替换的保存
	if($flag == "zz"){
		$id = $_POST['id'];
		$dest = $_POST['dest'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,路径 FROM 著作_文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_zz"."/".$ajh;
				foreach($_FILES as $num =>$fileinfo){
					$ret_path =  ajjlc_upfile($fileinfo,$up_path);
					$ret_path = substr($ret_path, 6,strlen($ret_path));
					$sql = "";
					$sql = "UPDATE 著作_文件 SET 处理人='".$name."',时间='".date("Y-m-d H:i:s")."',路径='".$ret_path."',删除状态='0',描述='".$dest."' WHERE id = '".$id."'";
					if($conn->query($sql)){
						$ret_data .= basename($ret_path)."替换成功\n";
					}else{
						$ret_data .= basename($ret_path)."替换失败\n";
					}
				}
				
			}else{
				$ret_data .= "“著作_文件”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“著作_文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息

	}
	//商标的详情的文件替换的保存
	if($flag == "sb"){
		$id = $_POST['id'];
		$ajh = $_POST['flag_name'];//案卷号
		$ret_data = "";
		if(!empty($id)){
			$sql_s = "SELECT 文件路径 FROM 商标_文件 WHERE 案卷号='".$ajh."' and id = '".$id."' and 描述='商标图样黑白'";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows > 0){//文件记录存在
				$former_path = "";
				while($row_s = $result_s->fetch_assoc()){
//					$ajh = $row_s["案卷号"];
					$former_path = $row_s["文件路径"];
				}
				if($former_path != ""){
					//删除旧的文件
					if($admin){
						$path_gbk = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($path_gbk)){
							unlink($path_gbk);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_sb"."/".$ajh;
				$ret_path =  myfile6($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_arr = explode("/",$ret_path);
				$file_name = $file_arr[count($file_arr)-1];
				$sql = "UPDATE 商标_文件 SET 案卷号='".$ajh."',文件路径='".$ret_path."',创建时间='".date("Y-m-d H:i:s")."',创建人='".$name."' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= $file_name."替换成功\n";
				}else{
					$ret_data .= $file_name."替换失败\n";
				}
			}else{//文件记录不存在
				//保存新的文件
				$up_path = "../../filesave_sb"."/".$ajh;
				$ret_path =  myfile6($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_arr = explode("/",$ret_path);
				$file_name = $file_arr[count($file_arr)-1];
				$sql = "INSERT INTO 商标_文件(案卷号,文件路径,创建时间,创建人,描述) VALUES('".$ajh."','".$ret_path."','".date("Y-m-d H:i:s")."','".$name."','商标图样黑白')";
	//			$sql = "UPDATE 商标_文件 SET 文件路径='".$ret_path."',创建时间='".date("Y-m-d H:i:s")."',创建人='".$name."' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= $file_name."替换成功\n";
				}else{
					$ret_data .= $file_name."替换失败\n";
				}
			}
		}else{//文件记录不存在
			//保存新的文件
			$up_path = "../../filesave_sb"."/".$ajh;
			$ret_path =  myfile6($_FILES["upfile"],$up_path);
			$ret_path = substr($ret_path, 6,strlen($ret_path));
			$file_arr = explode("/",$ret_path);
			$file_name = $file_arr[count($file_arr)-1];
			$sql = "INSERT INTO 商标_文件(案卷号,文件路径,创建时间,创建人,描述) VALUES('".$ajh."','".$ret_path."','".date("Y-m-d H:i:s")."','".$name."','商标图样黑白')";
//			$sql = "UPDATE 商标_文件 SET 文件路径='".$ret_path."',创建时间='".date("Y-m-d H:i:s")."',创建人='".$name."' WHERE id = '".$id."'";
			if($conn->query($sql)){
				$ret_data .= $file_name."替换成功\n";
			}else{
				$ret_data .= $file_name."替换失败\n";
			}
		}
		echo $ret_data;//返回的信息	
	}
	//商标的详情的其他文件替换的保存
		if($flag == "sb_other"){
			$id = $_POST['id'];
			$ret_data = "";
			$sql_s = "SELECT 案卷号,文件路径 FROM 商标_文件 WHERE id = '".$id."' and 状态=0";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows > 0){
				$ajh = $former_path = "";
				while($row_s = $result_s->fetch_assoc()){
					$ajh = $row_s['案卷号'];
					$former_path = $row_s['文件路径'];
				}
				if($ajh != ""){
					//删除旧的文件
					if($admin){
						if($former_path != ""){
							$del_path = iconv("utf-8", "gbk", "../../".$former_path);
							if(file_exists($del_path)){
								unlink($del_path);
							}
						}
					}
					//保存新的文件
					$up_path = "../../filesave_sb"."/".$ajh;
					$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
					$ret_path = substr($ret_path, 6,strlen($ret_path));
					$file_arr = explode("/",$ret_path);
					$file_name = $file_arr[count($file_arr)-1];
					$sql = "";
					$sql = "UPDATE 商标_文件 SET 创建人='".$name."',创建时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',状态='0' WHERE id = '".$id."'";
					if($conn->query($sql)){
						$ret_data .= $file_name."替换成功\n";
					}else{
						$ret_data .=$file_name."替换失败\n";
					}
				}else{
					$ret_data .= "“商标_文件”中id为".$id."的案卷号为空！\n";
				}
			}else{
				$ret_data .= "“商标_文件”中id没有".$id."\n";
			}
			echo $ret_data;//返回的信息
	
		}
		
		
		//海关的详情的文件替换的保存
	if($flag == "hg"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,文件路径 FROM 海关_文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['文件路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				
				//保存新的文件
				$up_path = "../../filesave_hg"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "";
				$sql = "UPDATE 海关_文件 SET 操作人='".$name."',操作时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',文件名='".$file_name."',状态='0' WHERE id = '".$id."'";
				if($conn->query($sql)){
					$ret_data .= basename($ret_path)."替换成功\n";
				}else{
					$ret_data .= basename($ret_path)."替换失败\n";
				}
			}else{
				$ret_data .= "“海关_文件”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“海关_文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息

	}
	
		//年费的详情的文件替换的保存
	if($flag == "nf"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 案卷号,文件路径 FROM 专案_年费文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$ajh = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$ajh = $row_s['案卷号'];
				$former_path = $row_s['文件路径'];
			}
			if($ajh != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_nf"."/".$ajh;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "";
				$sql = "UPDATE 专案_年费文件 SET 上传人='".$name."',上传时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',删除状态='0' WHERE id = '".$id."'";
//				echo $sql ; 
				if($conn->query($sql)){
					$ret_data .= $file_name."替换成功\n";
				}else{
					$ret_data .= $file_name."替换失败\n";
				}
			}else{
				$ret_data .= "“专案_年费文件”中id为".$id."的案卷号为空！\n";
			}
		}else{
			$ret_data .= "“专案_年费文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息
	}

	//项目申报的详情的文件替换的保存
	if($flag == "pr"){
		$id = $_POST['id'];
		$ret_data = "";
		$sql_s = "SELECT 对应id,文件路径 FROM 专案_项目申报文件 WHERE id = '".$id."'";
		$result_s = $conn->query($sql_s);
		if($result_s->num_rows > 0){
			$self_id = $former_path = "";
			while($row_s = $result_s->fetch_assoc()){
				$self_id = $row_s['对应id'];
				$former_path = $row_s['文件路径'];
			}
			if($self_id != ""){
				//删除旧的文件
				if($admin){
					if($former_path != ""){
						$del_path = iconv("utf-8", "gbk", "../../".$former_path);
						if(file_exists($del_path)){
							unlink($del_path);
						}
					}
				}
				//保存新的文件
				$up_path = "../../filesave_xm"."/".$self_id;
				$ret_path =  ajjlc_upfile($_FILES["upfile"],$up_path);
				$ret_path = substr($ret_path, 6,strlen($ret_path));
				$file_name = pathinfo($ret_path,PATHINFO_BASENAME);
				$sql = "";
				$sql = "UPDATE 专案_项目申报文件 SET 创建人='".$name."',创建时间='".date("Y-m-d H:i:s")."',文件路径='".$ret_path."',删除状态='0' WHERE id = '".$id."'";
				$sql2 = "INSERT INTO 专案_项目申报文件操作记录(Caseid,文件路径,操作员,操作名,记录时间) VALUES(";
				$sql2 .= "'".$self_id."','".$ret_path."','".$name."','2','".date("Y-m-d H:i:s")."')";
				$conn->query($sql2);
//				echo $sql ; 
				if($conn->query($sql)){
					$ret_data .= $file_name."替换成功\n";
				}else{
					$ret_data .= $file_name."替换失败\n";
				}
			}else{
				$ret_data .= "“专案_项目申报文件”中id为".$id."的记录！\n";
			}
		}else{
			$ret_data .= "“专案_项目申报文件”中id没有".$id."\n";
		}
		echo $ret_data;//返回的信息
	}

$conn->close();
?>