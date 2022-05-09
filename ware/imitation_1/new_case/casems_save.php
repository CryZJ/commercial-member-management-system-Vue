<?php
/* *
 *  文件保存在newcasefile_save.php的文件中，此文件仅保存信息
 * */
	
//保存代码行
	header('content-type:text/html;charset=utf-8');
	require("../../../conn.php");
	require'../../../AHeader.php';

	$mas 		= $_POST['ms'];//获取JS文件传来的值
	$mas_tabf 	= $_POST['tabf'];//获取案件基本信息
	$mas_bz 	= $_POST['bz'];//获取备注
	$ajsqr 		= $_POST['sqr'];//案件申请人id
	$FMSJRid 	= $_POST['FMSJRid'];//案件发明设计人id
	$arr_tabf 	= explode("|", $mas_tabf);//案件基本信息转换为数组
	$arr_mas    = $mas;//案件详细信息转换为数组 jQuery异步
	$num_tabf 	= count($arr_tabf);//计算基本信息元素个数
	$num_mas 	= count($arr_mas);//计算专利案件详细信息的元素个数
	$time 		= date("Y-m-d");//获取当前时间
	
//查询申请人姓名
	$sqrname = "";
//	if(strpos($ajsqr,',')){
//		$str_ajdlr = explode(",", $ajsqr);//将数组数据分为字符串数据
//	}else {
//		$str_ajdlr[0] = $ajsqr;
//	}
//	$len = count($str_ajdlr);
//	$len = $len-1;
//	$sqrname = '';
//	for($j=0;$j<=$len;$j++){
////		从数据库比对数据，得到申请人详细信息
//		$sql8 		= "select * FROM `申请人` WHERE id= '".$str_ajdlr[$j]."'";
//		$result8 = $conn->query($sql8);
//		if($result8 ->num_rows>0){
//			while($row8 = $result8->fetch_assoc()){
//				$sqrname = $sqrname.','.$row8["申请人"];
//			}
//		}
//	}
//	$sqrname = substr($sqrname, 1);
	
	$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$ajsqr."')";
	$result8 = $conn->query($sql8);
	if($result8 ->num_rows>0){
		while($row8 = $result8->fetch_assoc()){
			$sqrname = $row8["申请人"];
		}
	}

//保存表-专利信息
	for($i = 0;$i <$num_mas;$i++){
		if($arr_mas[$i] != null){
			$str_mas = explode("|", $arr_mas[$i]);//将数组数据分为字符串数据
			//删除之前创建的用于占位的案卷号
			$sql_del = "delete from `专利信息` where 状态='9' and 案卷号='".$str_mas[0]."'";
			$result_del = $conn->query($sql_del);
			//保存专案信息
			$showtime = date("Y-m-d H:i:s");//修改php.ini，在php.ini中找到data.timezone =去掉它前面的;号，然后设置date.timezone=PRC;
			$sql3 = "insert into 专利信息(案卷号,类型,案源人,代理人,专利名称,状态,提交时间,证书状态,申请人,申请人id,创建人,备注,发明设计人id,创建时间)  values(";
				$sql3 .= "'".$str_mas[0]."','".$str_mas[1]."','".$str_mas[2]."','".$str_mas[3]."','".$str_mas[4]."','待提交','".$time."','未登记','".$sqrname."','".$ajsqr."','".$arr_tabf[1]."','".$mas_bz."','".$FMSJRid."','".$showtime."')";
			$result3 = $conn->query($sql3);
			//查找案源人代理人信息
				//案源人
			$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$str_mas[2]."'";
			$result_sqrid = $conn->query($sql_sqrid);
			if($result_sqrid->num_rows>0){
				while($row_sqrid = $result_sqrid->fetch_assoc()){
					$ayrid = $row_sqrid['id'];//案源人代理id
					$ayrsonid = $row_sqrid['sonid'];//案源人用户id
				}
			}
				//代理人
			$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$str_mas[3]."'";
			$result_sqrid = $conn->query($sql_sqrid);
			if($result_sqrid->num_rows>0){
				while($row_sqrid = $result_sqrid->fetch_assoc()){
					$dlrid = $row_sqrid['id'];//代理人代理id
					$dlrsonid = $row_sqrid['sonid'];//代理人用户id
				}
			}
			//保存专案_可见表，确定谁可见
			$sql_view = "insert into `专案_可见`(案卷号,ctype,创建时间,创建人,案源可见id,案源可见人,案源代理id,代理可见id,代理可见人,代理代理id)  values('".$str_mas[0]."','0','".$time."','".$arr_tabf[1]."','".$ayrid."','".$str_mas[2]."','".$ayrsonid."','".$dlrid."','".$str_mas[3]."','".$dlrsonid."')";
			$result_view = $conn->query($sql_view);
			
			//专案操作记录
			$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他)  values('".$name."','新建案件','".$str_mas[0]."','".date("Y-m-d H:i:s")."','新建案卷号为 “".$str_mas[0]."” 的专利案件')";
			$resultHIS = $conn->query($sqlHIS);
			
		}
	}

	if($result3){//用于测试数据是否保存成功
		echo 1;//判断是否输出成功
//		echo $sql3;
	}else{
		echo 0;//判断是否输出失败
	}
?>