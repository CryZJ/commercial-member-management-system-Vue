<?php
	header('content-type:text/html;charset=utf-8');
	
	$ajxh = $_REQUEST['ajxh'];
	require("conn.php");
	
	//保存第一张表：案件信息
	$case = array("".$_REQUEST['ayr']."","".$_REQUEST['fjbl']."","".$_REQUEST['bz']."");
	//输出测试
	//	foreach($case as $x=>$x_value){
	//		echo "Key=".$x.", Value=".$x_value;
	//	echo "<br/>";
	//	}
	$datetime = date("Y-m-d");
	if($ajxh !=null && $case[0] !=null && $case[1] !=null && $case[2] !=null && $datetime!=null){
		$sql = "insert into 案件信息(案件序号,案源人,费减比例,备注,案件状态,创建时间) values(";
		$sql .= " '".$ajxh."','".$case[0]."','".$case[1]."','".$case[2]."','新建','".$datetime."' )";
		$result = $conn->query($sql);
		if(!$result){
			echo "案件信息保存失败！<br/>";
			echo $sql;
			exit;
		}
	}else{ echo "案件信息保存失败！有数据为空！<br/>";exit; }
	
	//保存表案件发明人
	$inventor = array("".$_REQUEST['fmr']."","".$_REQUEST['sfzh']."");
	if($ajxh !=null && $inventor[0] !=null && $inventor[1] !=null){
		$sql2 = "insert into 案件发明人(案件序号,发明人,证件号) values(";
		$sql2 .= " '".$ajxh."','".$inventor[0]."','".$inventor[1]."' )";
		$result2 = $conn->query($sql2);
		if(!$result2){
			echo "案件发明人保存失败！<br/>";
			echo $sql2;
			exit;
		}
	}else{echo "案件发明人保存失败！有数据为空！<br/>";exit;}
	
	//保存表案件申请人
	$proposer = array("".$_REQUEST['sqr']."","".$_REQUEST['dz']."","".$_REQUEST['zjhm']."");
	if($ajxh !=null && $proposer[0] !=null && $proposer[1] !=null && $proposer[2] !=null){
		$sql3 = "insert into 案件申请人(案件序号,申请人,地址,证件号) values(";
		$sql3 .= "'".$ajxh."','".$proposer[0]."','".$proposer[1]."','".$proposer[2]."' )";
		$result3 = $conn->query($sql3);
		if(!$result3){
			echo "案件申请人保存失败！<br/>";
			echo $sql3;
			exit;
		}
	}else{echo "案件申请人保存失败！有数据为空！<br/>";exit;}
	
	
	
	//保存专利信息
	
	$patent = array("".$_REQUEST['ajh']."" , "".$_REQUEST['lx']."" , "".$_REQUEST['zlmc']."" , "".$_REQUEST['dlr']."");
	//打印测试
	//	foreach($patent as $x=>$x_value){
	//		echo "Key=".$x.", Value=".$x_value;
	//	echo "<br/>";
	//	}
	
	/*
	print_r($_FILES);//打印上传文件信息，为二维数组
	$filename=$_FILES['myFile']['name'];//文件名
	$type=$_FILES['myFile']['type'];//文件类型
	$tmp_name=$_FILES['myFile']['tmp_name'];//临时目录路径
	$size=$_FILES['myFile']['size'];//大小字节
	$error=$_FILES['myFile']['error'];//错误序号
	*/
	
	include_once 'upload.func.php';//加载函数
	$fileInfo=$_FILES['myfile'];//获取文件数组第一维名称
	//创建文件储存路径
	$time=date("Y-m-d h-i-sa");
	$dest = "filesave/".$patent[0]."/".$time;
	
	$allowExt=array('jpeg','jpg','png','gif','html','txt','zip','rar');//设置上传文件类型
	$new_tmp=uploadFile($fileInfo,$dest,false,$allowExt,'10485760');//调用函数并返回新的文件路径
	//echo $new_tmp;//测试
	
	
	if($ajxh !=null && $patent[0] !=null && $patent[1] !=null && $patent[2] !=null && $patent[3] !=null && $new_tmp !=null){
		$sql4 = "insert into 专利信息(案件序号,案卷号,类型,专利名称,代理人,文件路径,状态) values(";
		$sql4 .= " '".$ajxh."', '".$patent[0]."', '".$patent[1]."', '".$patent[2]."', '".$patent[3]."', '".$new_tmp."' ,'申请中' )"; 
		$result4 = $conn->query($sql4);
		if(!$result4){
			echo "专利信息人保存失败！<br/>";
			echo $sql4;
			exit;
		}else{
			echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
		}
	}else{echo "专利信息人保存失败！有数据为空！<br/>";exit;}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
		
		$num_r = count($arr_mas);	  //计算数组长度
		for($i = 0;$i < $num_r;$i++ ){//将数组元素再恢复为原数据，并存进数据库
			$arr_m = explode("|", $arr_mas["$i"]);
//			$arr_m[0]=案卷号,$arr_m[1]=案件类型,$arr_m[2]=专利名,$arr_m[3]=代理人,$arr_m[4]=文件;
			
			$sql = "insert into 专利信息(案卷号,类型,专利名称,代理人,文件路径)  values(";
			$sql .= "'".$arr_m[0]."','".$arr_m[1]."','".$arr_m[2]."','".$arr_m[3]."','".$arr_m[4]."')";

		$result = $conn->query($sql);//【表·专利信息】的更新
		}
//		echo $arr_mas["$i"];
		if($result == 1){//用于测试数据是否保存成功
			echo "1";//判断是否输出成功
		}else{
			echo "0";//判断是否输出失败
		}

	
	
?>