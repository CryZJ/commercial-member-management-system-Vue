<?php
require'../../AHeader.php'; 

//字符串编码互换utf-8转gbk或gbk转utf-8
function change_encode($str) {
	$ret_str = $str;
	$encode = mb_detect_encoding($str);
	//获取字符串的编码格式
	if ($encode == "UTF-8") {
		$ret_str = iconv("UTF-8", "GBK", $str);
	}
	if ($encode == "GBK") {
		$ret_str = iconv("GBK", "UTF-8", $str);
	}
	return $ret_str;
}

//获取做什么的标志
$flag = $_REQUEST['flag'];
require ("../../conn.php");
		
		//删除专利案件的文件
		if ($flag == "zhuanli") {
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','删除文件','".date("Y-m-d H:i:s")."','删除“".pathinfo($path,PATHINFO_BASENAME)."”文件')";
				$conn->query($sql);
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 案卷号,文件路径  FROM 案卷流程及文档  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['文件路径'];
							$ajh = $row['案卷号'];
						}
						if($path != ""){
							$path = "../../" . $path;
							$path_gbk = change_encode($path);
							if (file_exists($path_gbk)) {
								if (unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除完成";
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}
		//删除无效案件的文件
		if ($flag == "wuxiao") {
			$id = $_GET['id'];
			$sql = "SELECT 文件路径  FROM 案卷流程及文档  WHERE id='" . $id . "'";
			$result = $conn -> query($sql);
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$path = $row['文件路径'];
				}
				if($path != ""){
					$path = "../../" . $path;
					$path = change_encode($path);
					if (file_exists($path)) {
						if (unlink($path)) {
							$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
							if ($conn -> query($sql2)) {
								echo "3";
								//文件删除成功
							} else {
								echo "2";
								//文件已删除状态未改
							}
						} else {
							echo "1";
							//删除文件失败
						}
					} else {
						$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
						if ($conn -> query($sql2)) {
							echo "3";
							//文件删除成功
						} else {
							echo "2";
							//文件已删除状态未改
						}
					}
				}else{
					$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
					if ($conn -> query($sql2)) {
						echo "3";
						//文件删除成功
					} else {
						echo "2";
						//文件已删除状态未改
					}
				}
			} else {
				echo "0";
				//数据库无这条记录
			}
		}
		
		//删除复审案件的文件
		if ($flag == "fushen") {
			$id = $_GET['id'];
			$sql = "SELECT 文件路径  FROM 案卷流程及文档  WHERE id='" . $id . "'";
			$result = $conn -> query($sql);
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$path = $row['文件路径'];
				}
				if($path != ""){
					$path = "../../" . $path;
					$path = change_encode($path);
					if (file_exists($path)) {
						if (unlink($path)) {
							$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
							if ($conn -> query($sql2)) {
								echo "3";
								//文件删除成功
							} else {
								echo "2";
								//文件已删除状态未改
							}
						} else {
							echo "1";
							//删除文件失败
						}
					} else {
						$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
						if ($conn -> query($sql2)) {
							echo "3";
							//文件删除成功
						} else {
							echo "2";
							//文件已删除状态未改
						}
					}
				}else{
					$sql2 = "UPDATE 案卷流程及文档  SET 删除状态='1' WHERE id='" . $id . "'";
					if ($conn -> query($sql2)) {
						echo "3";
						//文件删除成功
					} else {
						echo "2";
						//文件已删除状态未改
					}
				}
			} else {
				echo "0";
				//数据库无这条记录
			}	
		}
		
		//软件的基本详情的文件删除
		if($flag == "ruanjian"){
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 软件_文件  SET 删除状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 路径  FROM 软件_文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['路径'];
						}
						if($path != ""){
							$path = "../../" . $path;
							$path_gbk = change_encode($path);
							if (file_exists($path_gbk)) {
								if (unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}

		//著作的基本详情的文件删除
		if($flag == "zhuzuo"){
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 著作_文件  SET 删除状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 路径  FROM 著作_文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['路径'];
							if($path != ""){
								$path = "../../" . $path;
								$path_gbk = change_encode($path);
								if (file_exists($path_gbk)) {
									if (unlink($path_gbk)) {
										$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
									}
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}
		
		//商标的基本详情的文件删除
		if($flag == "sb_other"){
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 商标_文件  SET 状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 文件路径  FROM 商标_文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['文件路径'];
						}
						if($path != ""){
							$path = "../../" . $path;
							$path_gbk = change_encode($path);
							if (file_exists($path_gbk)) {
								if (unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}

		//海关的基本详情的文件删除
		if($flag == "海关"){
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 海关_文件  SET 状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg .= "删除记录成功";
				if($admin){
					$sql = "SELECT 文件路径  FROM 海关_文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['文件路径'];
						}
						if($path != ""){
							$path = "../../" . $path;
							$path_gbk = change_encode($path);
							if (file_exists($path_gbk)) {
								if (unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			} else {
				$ret_msg .= "删除记录失败";
			}
			echo $ret_msg;
		}
		
		//年费的基本详情的文件删除
		if($flag == "nf_file"){
			$id = $_GET['id'];
			
			$ret_msg = "";
			$sql2 = "UPDATE 专案_年费文件  SET 删除状态='1' WHERE id='" . $id . "'";
			if ($conn -> query($sql2)) {
				$ret_msg = "删除记录成功";
				if($admin){
					$sql = "SELECT 文件路径  FROM 专案_年费文件  WHERE id='" . $id . "'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						$path = "";
						while ($row = $result -> fetch_assoc()) {
							$path = $row['文件路径'];
						}
						if($path != ""){
							$path = "../../" . $path;
							$path_gbk = change_encode($path);
							if (file_exists($path_gbk)) {
								if (unlink($path_gbk)) {
									$ret_msg .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			} else {
				$ret_msg = "删除记录失败";
			}
			echo $ret_msg;
		}
		
$conn -> close();
?>