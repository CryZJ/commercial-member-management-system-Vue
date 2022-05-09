<?php
/**
 * 把文件存放在“filesave”，“tmp_fileupload”，“mail_file”三个文件夹，数据保存到表“临时文件”，“案卷流程及文档”，“接收上传文件”
 */
 header('content-type:text/html;charset=utf-8');
 	//用户信息
	require("../AHeader.php");
	require("../conn.php");
	require("upfile_more_func.php");
	
//	require_once "more_upload_func.php";//连接函数
	
	
//	print_r($_FILES);
	
	//整理出zip文件与非zip文件
	$files_zip = "";
	$z=0;
	$files_other = "";
	$o=0;
//	[0] => Array
//      (
//          [name] => 1917 - 副本.ZIP
//          [type] => application/x-zip-compressed
//          [tmp_name] => C:\Windows\temp\phpE74B.tmp
//          [error] => 0
//          [size] => 4985177
//      )
	foreach($_FILES as $index => $fileinfo){
		$ext = get_suffix($fileinfo['name']);
		if($ext == "zip"){//zip文件
			$files_zip[$z]["name"] = $fileinfo["name"];
			$files_zip[$z]["type"] = $fileinfo["type"];
			$files_zip[$z]["tmp_name"] = $fileinfo["tmp_name"];
			$files_zip[$z]["error"] = $fileinfo["error"];
			$files_zip[$z]["size"] = $fileinfo["size"];
			$z++;
		}else{//非zip文件
			$files_other[$o]["name"] = $fileinfo["name"];
			$files_other[$o]["type"] = $fileinfo["type"];
			$files_other[$o]["tmp_name"] = $fileinfo["tmp_name"];
			$files_other[$o]["error"] = $fileinfo["error"];
			$files_other[$o]["size"] = $fileinfo["size"];
			$o++;
		}
	}
	$ret_data = "";
	$i=0;
	//处理zip文件
	if($files_zip != ""){
		foreach($files_zip as $index => $fileinfo ){
			$ret_data[$i] = ($i+1)."、".$fileinfo["name"]."：";
			//保存文件到tmp_filesave
			$dir = "../tmp_fileupload";
			$ret_arr = Save_tmpfileupload($fileinfo,$dir);//返回：$res['result']，$res['des']
			if($ret_arr['result']){
				$ret_data[$i] .= "①上传文件保存成功！";
				//读取list.xml
				$path_gbk = iconv("utf-8", "gbk", $ret_arr['des']);
				if(file_exists($path_gbk)){
					$data_list = Read_listxml($path_gbk);//传入gbk的路径,返回数据：Array("result","通知书名称","通知书编码","专利名称","申请号","发文日","申请日","案卷号","原案卷号")
					
					if($data_list["result"]){
						$ret_data[$i] .= "③读取list.xml信息成功！";
//						if($data_list["通知书编码"] == "200101,200021" || $data_list["通知书编码"] == "200101"){//确认为受理导入，用案卷号匹配
						if(!(strpos($data_list["通知书编码"], "200101")===FALSE)){ //只要包含“受理通知书”
							//【根据案卷号判断案件是否存在】
//							$sql = "SELECT id,申请号,案源人,代理人 FROM 专利信息 WHERE 案卷号='".$data_list['案卷号']."'";
							$sql = "SELECT 案卷号,申请号,案源人,代理人,案件分类 FROM (SELECT 案卷号,申请号,案源人,代理人,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$data_list['案卷号']."'";
							$result = $conn->query($sql);
							if($result->num_rows>0){//案件存在
								$ret_data[$i] .= "④对应“案卷号”的案件存在！";
								//【判断申请号是否一样】
								while($row = $result->fetch_assoc()){
									$last_sqh = $row['申请号'];
									$ayr = $row['案源人'];
									$dlr = $row['代理人'];
									$ajfl = $row['案件分类'];
								}
								
								$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,案件分类) VALUES(";
								$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','".$ajfl."')";
								if(!$conn->query($sql)){
									$ret_data[$i] .= "“申请号一样”的mySQL保存失败！";
								}
								
								
								//【把文件copy到对应案卷号的文件夹中】
								if($ajfl == "专案_年费"){
									$savesql_path = "filesave_nf/".$data_list['案卷号']."/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
									$copy_path = "../".$savesql_path;
									if(Filecopy($path_gbk,$copy_path)){
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹成功！";
										if($data_list['通知书编码']=="200101,200021" || $data_list['通知书编码']=="200101,200103"){//受理导入
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“受理导入”的mySQL保存失败！";
											}
										}else if($data_list['通知书编码'] == "200602"){//授权导入
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“授权导入”的mySQL保存失败！";
											}
										}else{
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“批量上传”的mySQL保存失败！";
											}
										}
									}else{//文件复制失败处理
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹失败！";
									}
								}else{
									$savesql_path = "filesave/".$data_list['案卷号']."/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
									$copy_path = "../".$savesql_path;
									if(Filecopy($path_gbk,$copy_path)){
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹成功！";
										if($data_list['通知书编码']=="200101,200021" || $data_list['通知书编码']=="200101,200103"){//受理导入
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','受理导入','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“受理导入”的mySQL保存失败！";
											}
										}else if($data_list['通知书编码'] == "200602"){//授权导入
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','授权通知','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“授权导入”的mySQL保存失败！";
											}
										}else{
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','批量上传','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“批量上传”的mySQL保存失败！";
											}
										}
									}else{//文件复制失败处理
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹失败！";
									}
								} 
								
								//【把文件发送到对应案卷号的案源人，代理人，与案源人绑定的人，与代理人绑定的人】
								//【把文件复制到mail_file】
								$savesql_path = "../filesave_send/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
								if(Filecopy($path_gbk,$savesql_path)){
									//【操作人 发送 文件给 案源人，代理人，】
									$str_sendname = "";
									if($ayr != $name){
										$str_sendname .= $ayr.",";
									}
									if(strpos($str_sendname,$dlr) === FALSE){
										$str_sendname .= $dlr.",";
									}
									//【发给案源人名下的代理人，除去案件的代理人】
									
									//查询“人员账号绑定”，与案源人绑定的人
									$ayr_id="";//查询案件的案源人的用户id
									$sql ="SELECT id FROM 用户 WHERE 名称='".$ayr."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$ayr_id = $row['id'];
										}
									}
									$sql = "SELECT 副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$ayr_id."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$str_sendname .= $row['副用户名称'].",";
										}
									}
									
									//查询“人员账号绑定”，与代理人绑定的人
									$dlr_id="";//查询案件的代理人的用户id
									$sql ="SELECT id FROM 用户 WHERE 名称='".$dlr."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$dlr_id = $row['id'];
										}
									}
									$sql = "SELECT 副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$dlr_id."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$str_sendname .= $row['副用户名称'].",";
										}
									}
									
									$str_sendname = substr($str_sendname, 0,strlen($str_sendname)-1);
									$sql_path = "filesave_send/".pathinfo($savesql_path,PATHINFO_BASENAME);
									$arr_sendname = explode(",", $str_sendname);
									foreach($arr_sendname as $ky => $send_name){
										$send_name_id = "";
										$sql ="SELECT id FROM 用户 WHERE 名称='".$send_name."'";
										$result = $conn->query($sql);
										if($result->num_rows>0){
											while($row = $result->fetch_assoc()){
												$send_name_id = $row['id'];
											}
										}
										if(!empty($send_name_id)){
											$sql = "INSERT INTO 发送文件(文件路径,上传时间,发送人用户id,发送状态,发送时间) VALUES(";
											$sql .= "'".$sql_path."','".date("Y-m-d H:i:s")."','".$userid."','1','".date("Y-m-d H:i:s")."')";
											if($conn->query($sql)){
												$sql = "INSERT INTO 接收文件(文件路径,发送人用户id,发送时间,接收人用户id) VALUES(";
												$sql .= "'".$sql_path."','".$userid."','".date("Y-m-d H:i:s")."','".$send_name_id."')";
												if(!$conn->query($sql)){
													$ret_data[$i] .= pathinfo($savesql_path,PATHINFO_BASENAME)."“发给案件的案源人/代理人/流程管理员/案源人绑定的人员”的mySQL保存失败！2\n";
												}
											}else{
												$ret_data[$i] .= pathinfo($savesql_path,PATHINFO_BASENAME)."“发给案件的案源人/代理人/流程管理员/案源人绑定的人员”的mySQL保存失败！1\n";
											}
										}
									}
								}else{
									$ret_data[$i] .= "⑦发送文件保存失败！";
								}
							}else{//案件不存在
								$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,案件存在) VALUES(";
								$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','1')";
								if(!$conn->query($sql)){
									$ret_data[$i] .= "“案件不存在”的mySQL保存失败！";
								}
								$ret_data[$i] .= "④对应“案卷号”的案件不存在！";
							}
							
						}else{//除受理外的，用申请号匹配
						
							//【根据申请号号判断案件是否存在】
//							$sql = "SELECT id,案卷号,申请号,案源人,代理人 FROM 专利信息 WHERE 申请号='".$data_list['申请号']."'";
							$sql = "SELECT 案卷号,申请号,案源人,代理人,案件分类 FROM (SELECT 案卷号,申请号,案源人,代理人,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,申请号,案源人,代理人,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 申请号='".$data_list['申请号']."'";
							$result = $conn->query($sql);
							if($result->num_rows>0){ //案件存在
								$ret_data[$i] .= "④对应“申请号”的案件存在！";
								//【判断申请号是否一样】
								while($row = $result->fetch_assoc()){
									$data_list['案卷号'] = $row["案卷号"];
									$last_sqh = $row['申请号'];
									$ayr = $row['案源人'];
									$dlr = $row['代理人'];
									$ajfl = $row['案件分类'];
								}
//								if($last_sqh != $data_list['申请号']){//申请号不一样
//									$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件分类,案件存在) VALUES(";
//									$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','".$last_sqh."','".$ajfl."','1')";
//									if(!$conn->query($sql)){
//										$ret_data[$i] .= "“申请号不一样”的mySQL保存失败！";
//									}
//									$ret_data[$i] .= "⑤对应“案卷号”的申请号不一样";
//								}else{//申请号一样
//									$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,案件分类) VALUES(";
//									$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','".$ajfl."')";
//									if(!$conn->query($sql)){
//										$ret_data[$i] .= "“申请号一样”的mySQL保存失败！";
//									}
//									$ret_data[$i] .= "⑤对应“案卷号”的申请号一样";
//								}
								$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,案件分类) VALUES(";
								$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','".$ajfl."')";
								if(!$conn->query($sql)){
									$ret_data[$i] .= "“申请号一样”的mySQL保存失败！";
								}
								$ret_data[$i] .= "⑤对应“案卷号”的申请号一样";
								//【把文件copy到对应案卷号的文件夹中】
								if($ajfl == "专案_年费"){
									$savesql_path = "filesave_nf/".$data_list['案卷号']."/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
									$copy_path = "../".$savesql_path;
									if(Filecopy($path_gbk,$copy_path)){
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹成功！";
										if($data_list['通知书编码']=="200101,200021" || $data_list['通知书编码']=="200101,200103"){//受理导入
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“受理导入”的mySQL保存失败！";
											}
										}else if($data_list['通知书编码'] == "200602"){//授权导入
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“授权导入”的mySQL保存失败！";
											}
										}else{
											$sql = "INSERT INTO 专案_年费文件(案卷号,上传人,上传时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“批量上传”的mySQL保存失败！";
											}
										}
									}else{//文件复制失败处理
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹失败！";
									}
								}else{
									$savesql_path = "filesave/".$data_list['案卷号']."/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
									$copy_path = "../".$savesql_path;
									if(Filecopy($path_gbk,$copy_path)){
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹成功！";
										if($data_list['通知书编码']=="200101,200021" || $data_list['通知书编码']=="200101,200103"){//受理导入
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','受理导入','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“受理导入”的mySQL保存失败！";
											}
										}else if($data_list['通知书编码'] == "200602"){//授权导入
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','授权通知','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“授权导入”的mySQL保存失败！";
											}
										}else{
											$sql = "INSERT INTO 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) VALUES(";
											$sql .= "'".$data_list['案卷号']."','批量上传','".$name."','".date("Y-m-d H:i:s")."','".$savesql_path."','".$data_list['通知书名称']."')";
											if(!$conn->query($sql)){
												$ret_data[$i] .= "“批量上传”的mySQL保存失败！";
											}
										}
									}else{//文件复制失败处理
										$ret_data[$i] .= "⑥文件保存到相应的案件的文件夹失败！";
									}
								}
								//【把文件发送到对应案卷号的案源人，代理人，与案源人绑定的人，与代理人绑定的人】
								//【把文件复制到mail_file】
								$savesql_path = "../filesave_send/".pathinfo($ret_arr['des'],PATHINFO_BASENAME);
								if(Filecopy($path_gbk,$savesql_path)){
									//【操作人 发送 文件给 案源人，代理人，】
									$str_sendname = "";
									if($ayr != $name){
										$str_sendname .= $ayr.",";
									}
									if(strpos($str_sendname,$dlr) === FALSE){
										$str_sendname .= $dlr.",";
									}
									//【发给案源人名下的代理人，除去案件的代理人】
									
									//查询“人员账号绑定”，与案源人绑定的人
									$ayr_id="";//查询案件的案源人的用户id
									$sql ="SELECT id FROM 用户 WHERE 名称='".$ayr."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$ayr_id = $row['id'];
										}
									}
									$sql = "SELECT 副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$ayr_id."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$str_sendname .= $row['副用户名称'].",";
										}
									}
									
									//查询“人员账号绑定”，与代理人绑定的人
									$dlr_id="";//查询案件的代理人的用户id
									$sql ="SELECT id FROM 用户 WHERE 名称='".$dlr."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$dlr_id = $row['id'];
										}
									}
									$sql = "SELECT 副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$dlr_id."'";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										while($row = $result->fetch_assoc()){
											$str_sendname .= $row['副用户名称'].",";
										}
									}
									
									$str_sendname = substr($str_sendname, 0,strlen($str_sendname)-1);
									$sql_path = "filesave_send/".pathinfo($savesql_path,PATHINFO_BASENAME);
									$arr_sendname = explode(",", $str_sendname);
									foreach($arr_sendname as $ky => $send_name){
										$send_name_id = "";
										$sql ="SELECT id FROM 用户 WHERE 名称='".$send_name."'";
										$result = $conn->query($sql);
										if($result->num_rows>0){
											while($row = $result->fetch_assoc()){
												$send_name_id = $row['id'];
											}
										}
										if(!empty($send_name_id)){
											$sql = "INSERT INTO 发送文件(文件路径,上传时间,发送人用户id,发送状态,发送时间) VALUES(";
											$sql .= "'".$sql_path."','".date("Y-m-d H:i:s")."','".$userid."','1','".date("Y-m-d H:i:s")."')";
											if($conn->query($sql)){
												$sql = "INSERT INTO 接收文件(文件路径,发送人用户id,发送时间,接收人用户id) VALUES(";
												$sql .= "'".$sql_path."','".$userid."','".date("Y-m-d H:i:s")."','".$send_name_id."')";
												if(!$conn->query($sql)){
													$ret_data[$i] .= pathinfo($savesql_path,PATHINFO_BASENAME)."“发给案件的案源人/代理人/流程管理员/案源人绑定的人员”的mySQL保存失败！2\n";
												}
											}else{
												$ret_data[$i] .= pathinfo($savesql_path,PATHINFO_BASENAME)."“发给案件的案源人/代理人/流程管理员/案源人绑定的人员”的mySQL保存失败！1\n";
											}
										}
									}
								}else{
									$ret_data[$i] .= "⑦发送文件保存失败！";
								}
							}else{ //案件不存在
								$sql = "INSERT INTO 临时文件(上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,案件存在) VALUES(";
								$sql .= "'".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','".$data_list['通知书名称']."','".$data_list['通知书编码']."','".$data_list['专利名称']."','".$data_list['案卷号']."','".$data_list['原案卷号']."','".$data_list['申请号']."','".$data_list['申请日']."','".$data_list['发文日']."','1')";
								if(!$conn->query($sql)){
									$ret_data[$i] .= "“案件不存在”的mySQL保存失败！";
								}
								$ret_data[$i] .= "④对应“申请号”的案件不存在！";
							}
						}
					}else{
						$ret_data[$i] .= "③读取list.xml信息失败！";
						$sql = "INSERT INTO 临时文件(上传时间,上传时间,案件存在,上传情况) VALUES('".date("Y-m-d")."','".pathinfo($fileinfo['name'],PATHINFO_BASENAME)."','1','1')";
						if(!$conn->query($sql)){
							$ret_data[$i] .= "“读取list.xml信息失败”的mySQL保存失败！";
						}
					}
				}else{
					$ret_data[$i] .= "②保存的上传文件不存在！";
					$sql = "INSERT INTO 临时文件(上传时间,上传时间,案件存在,上传情况) VALUES('".date("Y-m-d")."','".pathinfo($fileinfo['name'],PATHINFO_BASENAME)."','1','1')";
					if(!$conn->query($sql)){
						$ret_data[$i] .= "“保存的上传文件不存在”的mySQL保存失败！";
					}
				}
			}else{//文件上传失败
				$sql = "INSERT INTO 临时文件(上传时间,上传时间,案件存在,上传情况) VALUES('".date("Y-m-d")."','".pathinfo($fileinfo['name'],PATHINFO_BASENAME)."','1','1')";
				if(!$conn->query($sql)){
					$ret_data[$i] .= "“文件上传失败”的mySQL保存失败！";
				}
				
				$ret_data[$i] .= "①上传文件保存失败！";
			}
			$i++;
		}
	}
	
	//处理非zip文件
	if($files_other != ""){
		foreach($files_other as $index => $fileinfo ){
			$ret_data[$i] = ($i+1)."、".$fileinfo['name']."：";
			//保存文件,没有相应的案卷号，无法保存到对应案件的文件夹
			$path = "../tmp_fileupload";
			$ret_arr = Save_tmpfileupload($fileinfo,$path);
			if($ret_arr['result']){
				$sql = "INSERT INTO 临时文件(上传时间,文件名称,案件存在) VALUES('".date("Y-m-d")."','".pathinfo($ret_arr['des'],PATHINFO_BASENAME)."','1')";
				if(!$conn->query($sql)){
					$ret_data[$i] .= "“非zip文件上传成功”的mySQL保存失败！";
				}
				$ret_data[$i] .= "文件保存成功！";
			}else{
				$sql = "INSERT INTO 临时文件(上传时间,文件名称,案件存在,上传情况) VALUES('".date("Y-m-d")."','".pathinfo($fileinfo['name'],PATHINFO_BASENAME)."','1','1')";
				if(!$conn->query($sql)){
					$ret_data[$i] .= "“非zip文件上传失败”的mySQL保存失败！";
				}
				$ret_data[$i] .= "文件保存失败！";
			}
			$i++;
		}
	}
	
	if($ret_data != ""){
		$ret_data["result"] = "";
	}else{
		$ret_data["result"] = "所有文件上传失败！";
	}
	
//	$json = json_encode($ret_data);
//	echo $json;
	if(strtolower(gettype($ret_data)) == "array"){
		echo implode("#$#", $ret_data);
	}else{
		echo $ret_data;
	}
	
	
?>