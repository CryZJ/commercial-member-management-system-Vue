<?php
require("../../../AHeader.php");


	header('content-type:text/html;charset=utf-8');
require("../../../conn.php");

	$falg = $_POST['falg'];
	
	//保存“著作”新建的信息
	if($falg == 'savecase'){
		$ajdlr      = $_POST['ajdlr'];//案件处理人
	    $ajh        = $_POST['ajh'];//获取案卷号
		$ms 		= $_POST['ms'];	//基本信息
		$ms_bz   	= $_POST['bz'];	//获取备注
		$sqrid   		= $_POST['sqr'];//获取申请人id
		
		$arrf      = explode('|',$ms);//基本信息【案源人|代理人|案卷号|案卷名称】
		
		$time 		= date("Y-m-d");//获取当前时间
		
		//获取申请人姓名
		$sqr = '';
		$sqrarr = explode(',',$sqrid);
		$sqrlen = count($sqrarr);
		for($i=0;$i<$sqrlen;$i++){
		
	    $sql1 = "SELECT 申请人 FROM `申请人` WHERE `id`= '".$sqrarr[$i]."'";
	    $result1 = $conn->query($sql1);
			if($result1->num_rows > 0){
				while ($row1 = $result1->fetch_assoc()){
					$sqrN = $row1["申请人"];
				}
			}
			$sqr = $sqr.$sqrN.',';
		}
		$sqr 	 = substr($sqr, 0, -1);
	
	//保存表-案件基本信息
	
		$sql = "update 著作_信息 set 登记人='".$ajdlr."',案源人='".$arrf[0]."',代理人='".$arrf[1]."',著作名称='".$arrf[3]."',案件备注='".$ms_bz."',申请人id='".$sqrid."',创建时间='".$time."',状态='0',申请人='".$sqr."' where 案卷号='".$ajh."' ";	  
		
		$result = $conn->query($sql);
		
		if($result){//用于测试数据是否保存成功
			echo 1;//判断是否输出成功
	//		echo $sql;
		}else{
			echo 0;
	//		echo "0";//判断是否输出失败
		}
	}
	
	//著作新建的异步保存文件
	if($falg == 'upfile_zz'){
		require_once "../../../upload_func.php"; //使用函数uploadFile_zz
		$ajh = $_POST['ajh'];
		$dest = $_POST['dest2'];
		$dest_arr = explode(",", $dest);
		$ret_mag = "";
		if(isset($ajh)){
			$sql_s = "SELECT id FROM 著作_信息 WHERE 案卷号='".$ajh."'";
			$result_s = $conn->query($sql_s);
			if($result_s->num_rows>0){
				$save_path = "../../../filesave_zz"."/".$ajh;
				$i = 0;
				foreach($_FILES as $num =>$fileinfo){
					$ret_path = uploadFile_zz($fileinfo,$save_path);
					$filename_arr = explode("/", $ret_path['dest']);//basename()
					$file_name = $filename_arr[count($filename_arr)-1];
					$sql_savepath = "filesave_zz/".$ajh."/".$file_name;
					$sql_i = "INSERT INTO 著作_文件(案卷号,处理人,时间,路径,描述) VALUES(";
					$sql_i .= "'".$ajh."','".$name."','".date("Y-m-d H:i:s")."','".$sql_savepath."','".$dest_arr[$i]."')";
					if($conn->query($sql_i)){
						$ret_mag .= $file_name."保存成功！\n";
					}else{
						$ret_mag .= $file_name."保存失败！\n";
					}
					$i++;
				}
			}else{
				$ret_mag .= "“著作_信息”中没有案卷号为".$ajh."的案件！\n";
			}
		}
		
		echo $ret_mag;
	}
	
	//案件详情的申请号的保存
	if($falg == 'save_sqh'){
		
	}



$conn->close();
	
?>