<?php
/* *
 *  文件保存在newcasefile_save.php的文件中，此文件仅保存信息
 * */ 

//保存代码行
	header('content-type:text/html;charset=utf-8');
require("../../../conn.php");
	
	$falg     = $_POST['falg'];
	if($falg == 'savecase'){//案件新建
		//$id = $_REQUEST['id'];
		$ajdlr      = $_POST['ajdlr'];//案件处理人
	    $sqrid     = $_POST['sqr'];//获取申请人id
		$ms 		= $_POST['ms'];//获取基本信息[案源人|代理人|案卷号|软件名称]
		$ms_bz   	= $_POST['bz'];//获取备注
		
		$arrf1      = explode('|',$ms);//基本信息分割
		$sqrMes 	= explode('|',$sqrid);//分割申请人id
		$SqrLen 	= count($sqrMes);//计算申请人个数
		
		$time 		= date("Y-m-d");//获取当前时间
		
		//获取申请人姓名
		$sqr = '';
//		$sqrarr = explode(',',$sqrid);
		for($i=0;$i<$SqrLen;$i++){
		
	    $sql1 = "SELECT 申请人 FROM `申请人` WHERE `id`= '".$sqrMes[$i]."'";
	    $result1 = $conn->query($sql1);
			if($result1->num_rows > 0){
				while ($row1 = $result1->fetch_assoc()){
					$sqrN 	 = $row1["申请人"];
				}
			}
			$sqr = $sqr.$sqrN.',';
		}
		$sqr 	 = substr($sqr, 0, -1);//减去最后一个‘,’

		//保存表信息
			//保存费用
//		$sql = "insert into 软件_信息(案卷号,登记人,案源人,代理人,软件名称,案件备注,申请人id,创建时间) values (";
//		$sql .= "'".$arrf1[2]."','".$ajdlr."','".$arrf1[0]."','".$arrf1[1]."','".$arrf1[3]."','".$ms_bz."','".$sqrid1."','".$time."')";
		
		$sql = "UPDATE 软件_信息   SET 登记人='".$ajdlr."',案源人='".$arrf1[0]."',代理人='".$arrf1[1]."',软件名称='".$arrf1[3]."',案件备注='".$ms_bz."',申请人id='".$sqrid."',创建时间='".$time."',申请人='".$sqr."',状态='0'  WHERE 案卷号='".$arrf1[2]."'";
		$result = $conn->query($sql);
				
		if($result){//用于测试数据是否保存成功
			echo "保存成功";//判断是否输出成功
		//		echo $sql;
		}else{
			echo "保存失败";
		//		echo "0";//判断是否输出失败
		}
	}
	//保存软件基本信息中的“申请号”，“申请日”
	if($falg == 'save_sqh'){
		//保存软件案件基本信息
		/*
		 *  ajh:ajh_rj,
			sqh_zz:sqh,
			sqr_zz:sqday,
			falg:'save_sqh'
		*/
		$ajh  = $_POST['ajh'];
		$sqh  = $_POST["sqh_zz"];
		$sqday= $_POST["sqr_zz"];
		$sql3 = "UPDATE 软件_信息 SET 申请号 = '".$sqh."', 申请日期 = '".$sqday."' WHERE 案卷号 = '".$ajh."'";
		if($conn->query($sql3)){
			echo "1";
		}else{
	    	echo "0";
	    }
	}
	
$conn->close();	
	
?>