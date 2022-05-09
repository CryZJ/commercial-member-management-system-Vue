<?php
	//获取id
//	$id = $_REQUEST['id'];
	//获取案卷号和文件路径
	$af = $_REQUEST['aj'];
	
//	申请书信息保存

		//获取前端数据
		$info_base = $_REQUEST['ms0'];
		$info_fare = $_REQUEST['ms1'];
		$info_fname = $_REQUEST['ms2'];
		//前端数据分割
		$arr_base = explode("/", $info_base);
		$arr_fare = explode("/", $info_fare);
		$arr_fnamw = explode("/", $info_fname);
		$arr_af = explode("/", $af);
		$ajh = $arr_af[0];
		$filer = $arr_af[1];
		//获取当前时间3
		$time = date("Y-m-d");
		
		require('conn.php');
		
		//保存表-案件文档及流程
		$sql = "insert into 案卷流程及文档(案卷号,流程,处理人,时间,文件路径)  values(";
		$sql .= "'".$ajh."','案件申请','','".$time."','')";
		$result = $conn->query($sql);
		
		
		//保存表-监控时间管理
		$sql2 = "insert into 监控时间管理(案卷号,监控时间,提醒时间,结束终截止时间,剩余天数,文件路径)  values(";
		$sql2 .= "'".$ajh."','".$time."','".$arr_fare[5]."','".$arr_fare[6]."','','')";
		$result2 = $conn->query($sql2);
		
		
		//保存表-专利信息
		$sql3 = "update 专利信息(案卷号,申请号,申请日,费减比例)  values(";
		$sql3 .= "'".$ajh."','".$arr_base[1]."','".$arr_base[0]."','".$arr_base[2]."')";
		$result3 = $conn->query($sql3);
		
		
		//保存表-专案需交费用
		$num_fname = count($arr_fnamw);//计算信息元素个数
		
		for($i = 0;$i < $num_fname;$i++){
			$sql4 = "insert into 专案需交费用(案卷号,费用名称,金额,通知时间,缴费期限,处理人,状态)  values(";
			$sql4 .= "'$ajh','$arr_fnamw[$i]','$arr_fare[$i]','$arr_fare[5]','$arr_fare[6]','','0')";
			$result4 = $conn->query($sql4);
		}
		
		
		
		if($result == 1){
			echo "1";
		}else{
			echo $sql;
			echo "0";
		}
		
	
	$conn->close();
	
//				//获取POST传过来的数据
//				if($_SERVER['REQUEST_METHOD']=='POST'){
//					$ajh = $_POST['ajh'];
//					//lc,time,clr
//					$upload = array($_POST['lc'],$_POST['time'],$_POST['clr']);
//				
//					/***保存文件并获取文件路径***/
//					require('conn.php');
//					$sql = "select 文件路径 from 专利信息  where 案卷号='".$ajh."'";
//					$result = $conn->query($sql);
//					if($result->num_rows >0){
//						while($row = $result->fetch_assoc()){
//							$path = $row['文件路径'];
//							$arr_path = explode("/",$path);
//							$new_path = $arr_path[0]."/".$arr_path[1];//格式：filesave/案卷号
//						}
//					}
//					include_once 'upload.func.php';//加载函数
//					$fileInfo=$_FILES['myfile'];//获取文件数组第一维名称
//					//创建文件储存路径
//					$time=date("Y-m-d h-i-sa");
//					$dest = $new_path."/".$time;
//					
//					$allowExt=array('jpeg','jpg','png','gif','html','txt','zip','rar');//设置上传文件类型
//					$new_tmp=uploadFile($fileInfo,$dest,false,$allowExt,'10485760');//调用函数并返回新的文件路径
//					//echo $new_tmp;//测试
//					
//					$sql2  = "insert into 案卷流程及文档(案卷号,流程,时间,处理人,文件路径) values(";
//					$sql2 .= " '".$ajh."','".$upload[0]."','".$upload[1]."','".$upload[2]."','".$new_tmp."' )";
//					//in_array('',array) 判断数组中是否有空的，有为1
//					if(in_array('',$upload)!=1){
//						//echo $sql2;
//						$result2 = $conn->query($sql2);
//						if($result2==1){
//							echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
//						}else{
//							echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
//						}
//					}
//					
//					$conn->close();
//					
//				}

	
?>