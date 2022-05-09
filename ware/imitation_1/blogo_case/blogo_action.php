<?php
		require'../../../AHeader.php';
		
$flag = $_REQUEST['flag'];

require'../../../conn.php';
require("../../../upload_func.php");
	if($flag == 'sqrmes'){
		$sid = $_REQUEST['sqrid'];
		$sql = "select 申请人,证件号,地址,邮政编码,英文名,国籍,证件图,证件翻,营业执照图,营业执照翻,地址E from 申请人 where id='".$sid."'";
		$result = $conn->query($sql);
		$data = array();
		$data['证件图']="";
		$data['证件翻']="";
		$data['营业执照图']="";
		$data['营业执照翻']="";
		$data['地址E']="";
		if($result -> num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data['申请人']=$row['申请人'];
				$data['证件号']=$row['证件号'];
				$data['地址']=$row['地址'];
				$data['地址E']=$row['地址E'];
				$data['邮政编码']=$row['邮政编码'];
				$data['英文名']=$row['英文名'];
				$data['国籍']=$row['国籍'];
				$data['证件图']=$row['证件图'];
				$data['证件翻']=$row['证件翻'];
				$data['营业执照图']=$row['营业执照图'];
				$data['营业执照翻']=$row['营业执照翻'];
			}
		}
		$sql = "SELECT 地址 FROM 申请人地址 WHERE 申请人id='".$sid."'";
		$result = $conn->query($sql);
		$add_num = 0;
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$data["其他地址"][$add_num] = $row["地址"];
				$add_num++;
			}
		}
		$data["其他地址的数量"] = $add_num;
//		echo print_r($data);
		$return_data = json_encode($data);
		echo $return_data;
		
	}else if($flag == 'zjsqrmes'){//增加申请人
		$sid = $_REQUEST['sqrid'];
		$sql = "select 申请人,证件号,地址,邮政编码,英文名,国籍,证件图,证件翻,营业执照图,营业执照翻,地址E from 申请人 where id='".$sid."'";
		$result = $conn->query($sql);
		$data = array();
		$data['证件图']="";
		$data['证件翻']="";
		$data['营业执照图']="";
		$data['营业执照翻']="";
		$data['地址E']="";
		if($result -> num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data['申请人']=$row['申请人'];
				$data['证件号']=$row['证件号'];
				$data['地址']=$row['地址'];
				$data['地址E']=$row['地址E'];
				$data['邮政编码']=$row['邮政编码'];
				$data['英文名']=$row['英文名'];
				$data['国籍']=$row['国籍'];
				$data['证件图']=$row['证件图'];
				$data['证件翻']=$row['证件翻'];
				$data['营业执照图']=$row['营业执照图'];
				$data['营业执照翻']=$row['营业执照翻'];
			}
		}
		$sql = "SELECT 地址 FROM 申请人地址 WHERE 申请人id='".$sid."'";
		$result = $conn->query($sql);
		$add_num = 0;
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$data["其他地址"][$add_num] = $row["地址"];
				$add_num++;
			}
		}
		$data["其他地址的数量"] = $add_num;
//		echo print_r($data);
		$return_data = json_encode($data);
		echo $return_data;			
	}else if($flag == 'ajh'){ //生成案卷号
		$dlid = $_REQUEST['dlrid'];
		$ayid = $_REQUEST['ayrid'];
		//案源人
		$sql = "select 编号,id,名称 from 案源人信息  where id='".$ayid."'";
		$result = $conn->query($sql);
		if($result->num_rows >= 0){
            while($row = $result->fetch_assoc()){
            	$aybh = $row['编号'];
            }
        }
		//代理人
		$sqlx = "select 编号,id,名称 from 代理人信息  where id='".$dlid."'";
		$resultx = $conn->query($sqlx);
		if($resultx->num_rows >= 0){
            while($rowx = $resultx->fetch_assoc()){
            	$dlbh = $rowx['编号'];
            }
        }
        //查数据库数据条数
        $sqli = "select count(id) as num from `商标_案件`";
        $result2 = $conn->query($sqli);
        if($result2->num_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				$xhnumber = $row2["num"]+1;
			}
		}
		$xhstr = strval($xhnumber);
		$lenght = strlen($xhstr);
		//案卷号[案件号+案源人+0+代理人]
		switch($lenght){
			case 1 : $xhstr2 = "0300".$xhstr;break;
			case 2 : $xhstr2 = "030".$xhstr;break;
			case 3 : $xhstr2 = "03".$xhstr;break;
			case 4 : $xhstr2 = "0".$xhstr;break;
			case 5 : $xhstr2 = $xhstr;break;
			default : echo "<script type=\"text/javascript\">alert(\"案件信息表数量过大！请联系管理员！\");</script>";exit;
		}
		$ajh = $xhstr2.$aybh.'4'.$dlbh;
		//先占一行到“商标_案件”
		$sql = "insert into 商标_案件(案卷号,状态) VALUES('".$ajh."',9)";
		if($conn->query($sql)){
			echo $ajh;
		}else{
			echo "生成失败，再试一次或找管理员";
		}
		
	}if($flag == 'savemes'){//保存新建注册案件信息
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$wt_id = $_REQUEST['wt_id'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$ajh = $strm_arr[3];
		
		$ret = "";
		$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',案件类型='注册',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$ret = "保存基本信息成功";
		}else{
			$ret = "保存基本信息失败";
//			$ret .= $sql1;
		}
		echo $ret;
		
	}if($flag == 'savemes_other'){//保存商标其他的基本信息
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$wt_id = $_REQUEST['wt_id'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$ajh = $strm_arr[3];
		
		$ret = "";
		if(empty($strm_arr[8])){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='其他',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}else{
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',注册号='".$strm_arr[8]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='其他',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$ret = "保存基本信息成功";
		}else{
			$ret = "保存基本信息失败";
//			$ret .= $sql1;
		}
		echo $ret;
		
	}if($flag == 'savemes_chang'){//保存商标变更的基本信息
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$wt_id = $_REQUEST['wt_id'];
		$str_other = $_REQUEST['str_other'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$str_other_arr = explode("#$#", $str_other);
		$ajh = $strm_arr[3];
		
		$ret = "";
		if(empty($strm_arr[8])){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',案件类型='变更',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}else{
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',注册号='".$strm_arr[8]."',案件类型='变更',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$sql = "INSERT INTO 商标_案件附加信息(案卷号,变更前名义C,变更前名义E,变更前地址C,变更前地址E,共有商标是,共有商标否,变更管理规则,变更集体成员名单) VALUES('".$ajh."','".$str_other_arr[0]."','".$str_other_arr[1]."','".$str_other_arr[2]."','".$str_other_arr[3]."','".$str_other_arr[4]."','".$str_other_arr[5]."','".$str_other_arr[6]."','".$str_other_arr[7]."')";
			if($conn->query($sql)){
				$ret = "保存基本信息成功";
			}else{
				$ret = "保存基本信息成功";
//				$ret .= $sql;
			}
		}else{
			$ret = "保存基本信息失败";
//			$ret .= $sql1;
		}
		echo $ret;
		
	}if($flag == 'savemes_extension'){//保存商标续展的基本信息
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$wt_id = $_REQUEST['wt_id'];
		$str_other = $_REQUEST['str_other'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$str_other_arr = explode("#$#", $str_other);
		$ajh = $strm_arr[3];
		
		$ret = "";
		if(empty($strm_arr[8])){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',案件类型='续展',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}else{
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',注册号='".$strm_arr[8]."',案件类型='续展',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$sql = "INSERT INTO 商标_案件附加信息(案卷号,共有商标是,共有商标否) VALUES('".$ajh."','".$str_other_arr[0]."','".$str_other_arr[1]."')";
			if($conn->query($sql)){
				$ret = "保存基本信息成功";
			}else{
				$ret = "保存基本信息成功";
//				$ret .= $sql;
			}
		}else{
			$ret = "保存基本信息失败";
//			$ret .= $sql1;
		}
		echo $ret;
		
	}if($flag == 'savemes_transfer'){//保存商标转让的基本信息
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$wt_id = $_REQUEST['wt_id'];
		$str_other = $_REQUEST['str_other'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$str_other_arr = explode("#$#", $str_other);
		$ajh = $strm_arr[3];
		
		$ret = "";
		if(empty($strm_arr[7])){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商标说明='".$strm_arr[5]."',备注='".$strm_arr[6]."',案件类型='转让',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}else{
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商标说明='".$strm_arr[5]."',备注='".$strm_arr[6]."',注册号='".$strm_arr[7]."',案件类型='转让',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
		}
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$sql = "INSERT INTO 商标_案件附加信息(案卷号,外国受让人的国内接收人,邮政编码,国内接收人地址,共有商标是,共有商标否,转让人id,转让人,转让人商标地址,转让人类型,转让人委托书id) VALUES(";
			$sql .= "'".$ajh."','".$str_other_arr[0]."','".$str_other_arr[1]."','".$str_other_arr[2]."','".$str_other_arr[3]."','".$str_other_arr[4]."','".$str_other_arr[5]."','".$str_other_arr[6]."','".$str_other_arr[7]."','".$str_other_arr[8]."','".$str_other_arr[9]."')";
			if($conn->query($sql)){
				$ret = "保存基本信息成功";
			}else{
				$ret = "保存基本信息成功";
//				$ret .= $sql;
			}
		}else{
			$ret = "保存基本信息失败";
//			$ret .= $sql1;
		}
		echo $ret;
		
	}if($flag == 'RePSave'){
		$froinfo = $_GET['FrM'];
		$cheinfo = $_GET['CMe'];
		$lasinfo = $_GET['LIn'];
		$Coner = $_GET['Coner'];
		$dlrfax = $_GET['dlrfax'];
		$date = time();//获取时间戳
		
		$froarr = explode('|',$froinfo);
		$elsarr = explode('|',$cheinfo);
		$lasarr = explode('|',$lasinfo);
		
		$sql = "insert into 商标_委托书(委托人id,委托人,国籍,国法,代理人,商标名,勾选项,案件类型,委托其他,委托人地址,联系人,电话,邮编,修改时间,创建人,传真) values ('".$froarr[0]."','".$froarr[1]."','".$froarr[2]."','".$froarr[3]."','".$froarr[4]."','".$froarr[5]."','".$elsarr[0]."','".$elsarr[1]."','".$elsarr[2]."','".$lasarr[0]."','".$lasarr[1]."','".$lasarr[2]."','".$lasarr[3]."','".$date."','".$Coner."','".$dlrfax."')";
		$result = $conn->query($sql);
		$sql_Selectid = "select id from 商标_委托书  where 修改时间 = '".$date."'";
		$result_S = $conn->query($sql_Selectid);
		if($result_S ->num_rows>0){
			while($row = $result_S->fetch_assoc()){
				$id = $row['id'];
			}
		}
		if($result){
			echo $id;
		}else{
//			echo $sql;
		}
	}
	
	if($flag == 'RePSavekeep'){
		$froinfo = $_GET['FrM'];
		$cheinfo = $_GET['CMe'];
		$lasinfo = $_GET['LIn'];
		$Coner = $_GET['Coner'];
		$dlrfax = $_GET['dlrfax'];
		$wtrid=$_GET['wtrid'];
		$date = time();//获取时间戳
		
		$froarr = explode('|',$froinfo);
		$elsarr = explode('|',$cheinfo);
		$lasarr = explode('|',$lasinfo);
		
//		$sql = "insert into 商标_委托书(委托人id,委托人,国籍,国法,代理人,商标名,勾选项,案件类型,委托其他,委托人地址,联系人,电话,邮编,修改时间,创建人,传真) values ('".$froarr[0]."','".$froarr[1]."','".$froarr[2]."','".$froarr[3]."','".$froarr[4]."','".$froarr[5]."','".$elsarr[0]."','".$elsarr[1]."','".$elsarr[2]."','".$lasarr[0]."','".$lasarr[1]."','".$lasarr[2]."','".$lasarr[3]."','".$date."','".$Coner."','".$dlrfax."')";
		$sql="UPDATE `商标_委托书` SET `委托人id`='{$froarr[0]}' ,委托人='{$froarr[1]}',国籍='{$froarr[2]}',国法='{$froarr[3]}',代理人='{$froarr[4]}',商标名='{$froarr[5]}',勾选项='{$elsarr[0]}',案件类型='{$elsarr[1]}',委托其他='{$elsarr[2]}',委托人地址='{$lasarr[0]}',联系人='{$lasarr[1]}',电话='{$lasarr[2]}',邮编='{$lasarr[3]}',修改时间='{$date}',创建人='{$Coner}',传真='{$dlrfax}' WHERE `委托人id`='{$wtrid}';";
		$result = $conn->query($sql);
		$sql_Selectid = "select id from 商标_委托书  where 修改时间 = '".$date."'";
		$result_S = $conn->query($sql_Selectid);
		if($result_S ->num_rows>0){
			while($row = $result_S->fetch_assoc()){
				$id = $row['id'];
			}
		}
		if($result){
			echo $id;
		}else{
//			echo $sql;
		}
	}
	
	if($flag == "sb_upfile_0"){
		$ajh = $_POST['ajh'];
//		echo $ajh."\n";
//		print_r($_FILES);
//		myfile5()
		$ret_msg = "";
		$path = "../../../filesave_sb"."/".$ajh;
		if(count($_FILES) != 0){
			foreach($_FILES as $index => $fileinfo){
				if($index == "0"){
					$path_tmp = myfile6($fileinfo,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
				}else{
					$path_tmp = myfile5($fileinfo,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
				}
				switch($index){
					case 0 :
						$sql = "UPDATE 商标_文件 SET 商标黑白='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					case 1 :
						$sql = "UPDATE 商标_文件 SET 商标彩色='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					case 2 :
						$sql = "UPDATE 商标_文件 SET 身份证原='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					case 3 :
						$sql = "UPDATE 商标_文件 SET 身份证翻='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					case 4 :
						$sql = "UPDATE 商标_文件 SET 营业执照原='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					case 5 :
						$sql = "UPDATE 商标_文件 SET 营业执照翻='".$save_path."' WHERE 案卷号='".$ajh."'";
						if($conn->query($sql)){
							$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
						}else{
							$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
						}
						break;
					default :
						$ret_msg .= "没有相关文件\n";
				}
			}
		}else{
			$ret_msg .= "无文件上传！";
		}
		echo $ret_msg;
	}
	
	if($flag == "sb_upfile_2"){
		$ajh = $_POST['ajh'];
		$idinfo = $_POST['idinfo'];
		$ret_msg = "";
		$path = "../../../filesave_sb/".$ajh;
		$idfilename = "";
		if(strpos($idinfo, ",")){
			$idfilename = explode(",", $idinfo);
		}else{
			$idfilename[0] = $idinfo;
		}
		
		//复制文件
		foreach($idfilename as $ky => $sqr_filename){
			if($sqr_filename != "无"){
				$file_name = pathinfo($sqr_filename,PATHINFO_BASENAME);
				$copy_path = $path."/".$file_name;
//				$ret_msg .= $sqr_filename."=====".$copy_path."\n";
				$sqr_filename_gbk = iconv("utf-8","gbk",$sqr_filename);
				if(file_exists($sqr_filename_gbk)){
					if(Filecopy($sqr_filename,$copy_path)){
						$save_path = "filesave_sb/".$ajh."/".pathinfo($copy_path,PATHINFO_BASENAME);
						switch($ky){
							case 0:
								$sql = "UPDATE 商标_文件 SET  身份证原='".$save_path."'  WHERE 案卷号='".$ajh."'";
								if($conn->query($sql)){
									$ret_msg .= "“身份证原”路径保存成功\n";
								}else{
									$ret_msg .= "“身份证原”路径保存失败\n";
								}
								break;
							case 1:
								$sql = "UPDATE 商标_文件 SET  身份证翻='".$save_path."'  WHERE 案卷号='".$ajh."'";
								if($conn->query($sql)){
									$ret_msg .= "“身份证翻”路径保存成功\n";
								}else{
									$ret_msg .= "“身份证翻”路径保存失败\n";
								}
								break;
							case 2:
								$sql = "UPDATE 商标_文件 SET  营业执照原='".$save_path."'  WHERE 案卷号='".$ajh."'";
								if($conn->query($sql)){
									$ret_msg .= "“营业执照原”路径保存成功\n";
								}else{
									$ret_msg .= "“营业执照原”路径保存失败\n";
								}
								break;
							case 3:
								$sql = "UPDATE 商标_文件 SET  营业执照翻='".$save_path."'  WHERE 案卷号='".$ajh."'";
								if($conn->query($sql)){
									$ret_msg .= "“营业执照原”路径保存成功\n";
								}else{
									$ret_msg .= "“营业执照原”路径保存失败\n";
								}
								break;
							default:
								exit("已停止运行，出现未知错误!");
						}
					}else{
						switch($ky){
							case 0:
								$ret_msg .= "“身份证原”文件复制失败\n";
								break;
							case 1:
								$ret_msg .= "“身份证翻”文件复制失败\n";
								break;
							case 2:
								$ret_msg .= "“营业执照原”文件复制失败\n";
								break;
							case 3:
								$ret_msg .= "“营业执照翻”文件复制失败\n";
								break;
							default:
								exit("已停止运行，出现未知错误!");
						}
					}
				}else{
					switch($ky){
						case 0:
							$ret_msg .= "“身份证原”文件不存在\n";
							break;
						case 1:
							$ret_msg .= "“身份证翻”文件不存在\n";
							break;
						case 2:
							$ret_msg .= "“营业执照原”文件不存在\n";
							break;
						case 3:
							$ret_msg .= "“营业执照翻”文件不存在\n";
							break;
						default:
							exit("已停止运行，出现未知错误!");
					}
				}
			}
		}
		//保存上传的文件
		if(count($_FILES) != 0){
			foreach($_FILES as $ky => $file_info){
				if($ky == "商标黑白"){
					$path_tmp = myfile6($file_info,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
				}else{
					$path_tmp = myfile5($file_info,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
				}
				$sql = "UPDATE 商标_文件 SET ".$ky."='".$save_path."' WHERE 案卷号='".$ajh."'";
				if($conn->query($sql)){
					$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
				}else{
					$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
				}
			}
		}
		echo $ret_msg;
	}

	//保存其他文件
	if($flag == "sb_upfile_1"){
		$ajh = $_POST['ajh'];
		$ret_msg = "";
		$path = "../../../filesave_sb"."/".$ajh;
		if(count($_FILES) != 0){
			foreach($_FILES as $index => $fileinfo){
				$path_tmp = myfile5($fileinfo,$path);
				$path_arr = explode("/", $path_tmp);
				$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
				$sql = "UPDATE 商标_文件 SET 商标黑白='".$save_path."' WHERE 案卷号='".$ajh."'";
				$sql = "INSERT INTO 商标_其他文件(案卷号,文件地址,文件名,创建时间,创建人) VALUES(";
				$sql .= "'".$ajh."','".$save_path."','".$path_arr[count($path_arr)-1]."','".date("Y-m-d H:i:s")."','".$name."')";//$name
				if($conn->query($sql)){
					$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
				}else{
					$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
				}
			}
		}else{
			$ret_msg .= "无文件上传！";
		}
		echo $ret_msg;
	}
	
	//保存商标案件详情的:注册号 zch 注册日期 zcrq 专用权期限【始】 zyqqx_star 专用权期限【末】zyqqx_end
	if($flag == "save_something"){
		$ajh = $_GET['ajh'];	
		$zch = $_GET['zch'];
		$zcrq = $_GET['zcrq'];
		$ajzt = $_GET['ajzt'];
		$zyqqx_star = $_GET['zyqqx_star'];
		$zyqqx_end = $_GET['zyqqx_end'];
		
//		$zyqqx_end =date("$zyqqx_star",strtotime("+10 year"));
		$ret = "";
		$sql = "UPDATE 商标_案件 SET 注册号='".$zch."',注册日='".$zcrq."',专权期始='".$zyqqx_star."',专权期末='".$zyqqx_end."' WHERE 案卷号='".$ajh."'";
		if($conn->query($sql)){
			$ret .= $ajh."案件保存成功!\n";
			$sql = "update `商标_案件` set 案件状态 = '".$ajzt."' WHERE 案卷号 = '".$ajh."'";
			$conn->query($sql);
		}else{
			$ret .= $ajh."案件保存失败!\n";
		}
		if($zyqqx_end != ""){
			$sql = "SELECT id FROM 商标_监控 WHERE 案卷号='".$ajh."' AND 监控名='".专用权期监控."' AND 状态='0' ";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				$ret .= $ajh."监控已存在！";				
				$str = "-1years,-6months,0days";
				$return_time =  date("Y-m-d",strtotime($str,strtotime($zyqqx_end)));
//				$sql = "INSERT INTO 商标_监控(案卷号,申请日期,监控名,提醒日期,截止日期,备注) VALUES( ";
				$sql="update 商标_监控 set 提醒日期='".$return_time."',截止日期='".$zyqqx_end."' where 案卷号='".$ajh."'";
//				$sql .= "INSERT INTO 商标_监控(案卷号,申请日期,监控名,提醒日期,截止日期,备注) VALUES( '".$ajh."','".date("Y-m-d")."','专用权期监控','".$return_time."','".$zyqqx_end."','填写“专用权期限【末】”时自动增加的监控')";
				if($conn->query($sql)){
					$ret .= $ajh."专用权期监控增加成功！\n";
				}else{
					$ret .= $ajh."专用权期监控增加失败！\n";
				}
			
			}else{
				$str = "-1years,-6months,0days";
				$return_time =  date("Y-m-d",strtotime($str,strtotime($zyqqx_end)));
				$sql = "INSERT INTO 商标_监控(案卷号,申请日期,监控名,提醒日期,截止日期,备注) VALUES( ";
				$sql .= "'".$ajh."','".date("Y-m-d")."','专用权期监控','".$return_time."','".$zyqqx_end."','填写“专用权期限【末】”时自动增加的监控')";
				if($conn->query($sql)){
					$ret .= $ajh."专用权期监控增加成功！\n";
				}else{
					$ret .= $ajh."专用权期监控增加失败！\n";
				}
			}
		}
		echo $ret;
	}
	//案件详情，给案件添加委托书&&修改案件委托书
	if($flag == "addNewReP"){
		$RePid = $_GET['data'];//委托书id
		$ajh = $_GET['ajh'];//案卷号
		$sqr_add = $_GET["sqr_add"];//申请人商标地址
		$wts_person = $_GET["wts_person"];//申请人名称
		$wts_proprietaryname = $_GET["wts_proprietaryname"];//商标名称
		$wts_personid = $_GET["wts_personid"];//申请人id
		$sql = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$wts_personid."')";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$wts_person = $row["申请人"];
			}
		}
		//获取委托书商标名
		$sql1 = "select 商标名 from 商标_委托书  where id = '".$RePid."'";
		$result1 = $conn->query($sql1);
		if($result1->num_rows>0){
			while($row1 = $result1->fetch_assoc()){
				$BLogoN = $row1['商标名'];
			}
		}
		//更新委托书信息
//		$sql2 = "UPDATE 商标_文件 SET 商品名='".$BLogoN."' WHERE 案卷号='".$ajh."'";
//		if($conn->query($sql2)){
			$sql = "UPDATE 商标_案件 SET 委托书id='".$RePid."',申请人商标地址='".$sqr_add."',申请人='".$wts_person."',申请人id='".$wts_personid."',商标说明='".$wts_proprietaryname."' WHERE 案卷号='".$ajh."'";
			if($conn->query($sql)){
				echo $RePid.','.$BLogoN;
			}else{
//				echo $sql;
			}
//		}
//		echo $sql2;
	}
	
	//选择委托书后确定申请人
	if($flag == "chose_sqr"){
		$wts_id = $_GET['wts_id'];
		$sql = "SELECT 委托人id FROM 商标_委托书 WHERE id='".$wts_id."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$wtr_id = $row['委托人id'];
			}
			$sql = "select id,申请人,证件号,地址,邮政编码,英文名,国籍,证件图,证件翻,地址E,营业执照图,营业执照翻 from 申请人 where id='".$wtr_id."'";
			$result = $conn->query($sql);
			$data = array();
			$data['证件图']="";
			$data['证件翻']="";
			$data['营业执照图']="";
			$data['营业执照翻']="";
			if($result -> num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data['id']=$row['id'];
					$data['申请人']=$row['申请人'];
					$data['证件号']=$row['证件号'];
					$data['地址']=$row['地址'];
					$data['地址E']=$row['地址E'];
					$data['邮政编码']=$row['邮政编码'];
					$data['英文名']=$row['英文名'];
					$data['国籍']=$row['国籍'];
					$data['证件图']=$row['证件图'];
					$data['证件翻']=$row['证件翻'];
					$data['营业执照图']=$row['营业执照图'];
					$data['营业执照翻']=$row['营业执照翻'];
				}
			}
	//		echo print_r($data);
			$return_data = json_encode($data);
			echo $return_data;
		}
	}
	
	//保存专利案件备注修改
	if($flag == "save_sbbz"){
		$str_ajh = $_GET['str_ajh'];
		$str_bz = $_GET['str_bz'];
		
		$sql = "UPDATE 商标_案件 SET 备注='".$str_bz."' WHERE 案卷号='".$str_ajh."'";
		if($conn->query($sql)){
			echo "保存成功！";
		}else{
			echo "保存失败！";
		}
	}
	
	//利用php更改日期
	if($flag == "changdate"){
		$zyqqx_star = $_GET['zyqqx_star'];
		$str = "10years,0months,0days";
		echo date("Y-m-d",strtotime($str,strtotime($zyqqx_star)));
	}
	
	//保存商标新建“注册”文件
	if($flag == "sb_upfile"){
		$ajh = $_POST['ajh'];
		$dest = $_POST['dest'];
		$dest_arr = explode(",", $dest);
//		echo $ajh;
//		print_r($_FILES);
		$ret_msg = "";
		$path = "../../../filesave_sb"."/".$ajh;
		if(count($_FILES) != 0){
			$j = 0;
			foreach($_FILES as $index => $fileinfo){
				if($index == "商标图样黑白"){
					$path_tmp = myfile6($fileinfo,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
	//				$sql = "UPDATE 商标_文件 SET 商标黑白='".$save_path."' WHERE 案卷号='".$ajh."'";
					$sql = "INSERT INTO 商标_文件(案卷号,文件路径,描述,创建时间,创建人) VALUES(";
					$sql .= "'".$ajh."','".$save_path."','".$index."','".date("Y-m-d H:i:s")."','".$name."')";//$name
					if($conn->query($sql)){
						$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
					}else{
						$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
					}
				}else{
					$path_tmp = myfile5($fileinfo,$path);
					$path_arr = explode("/", $path_tmp);
					$save_path = "filesave_sb/".$ajh."/".$path_arr[count($path_arr)-1];
	//				$sql = "UPDATE 商标_文件 SET 商标黑白='".$save_path."' WHERE 案卷号='".$ajh."'";
					$sql = "INSERT INTO 商标_文件(案卷号,文件路径,描述,创建时间,创建人) VALUES(";
					$sql .= "'".$ajh."','".$save_path."','".$dest_arr[$j]."','".date("Y-m-d H:i:s")."','".$name."')";//$name
					if($conn->query($sql)){
						$ret_msg .= $path_arr[count($path_arr)-1]."保存成功！\n";
					}else{
						$ret_msg .= $path_arr[count($path_arr)-1]."保存失败！\n";
					}
					$j++;
				}
				
			}
		}else{
			$ret_msg .= "无文件上传！";
		}
		echo $ret_msg;
	}
	//保存信息【商标监控_新建】
	if($flag == "savemes_CaseMes"){
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
//		$wt_id = $_REQUEST['wt_id'];
		
		$strm_arr = explode('#$#', $strm);
		$strb_arr = explode('#$#', $strb);
		$ajh = $strm_arr[3];
		
		$ret = "";
		$sql5 = "SELECT * FROM `商标_案件` WHERE `注册号`='".$strm_arr[8]."'";
		$result5 = mysqli_query($conn, $sql5);
		$count=mysqli_num_rows($result5);
//		echo $count;
		if(empty($strm_arr[8])){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='".$strm_arr[0]."',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
//			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='其他',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',状态='0'";
		}else if($count == "0"){
			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',注册号='".$strm_arr[8]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='".$strm_arr[0]."',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',申请人商标地址='".$strb_arr[2]."',状态='0'";
//			$sql1 = "UPDATE 商标_案件 SET 创建人='".$name."',创建时间='".date("Y-m-d")."',委托书id='".$wt_id."',委托人类型='".$strm_arr[0]."',案源人='".$strm_arr[1]."',代理人='".$strm_arr[2]."',类别='".$strm_arr[4]."',商品服务='".$strm_arr[5]."',商标说明='".$strm_arr[6]."',备注='".$strm_arr[7]."',注册号='".$strm_arr[8]."',原案卷号='".$strm_arr[9]."',专权期始='".$strm_arr[10]."',专权期末='".$strm_arr[11]."',案件类型='其他',申请人='".$strb_arr[0]."',申请人id='".$strb_arr[1]."',状态='0'";
		};
		$sql1 .= " WHERE 案卷号='".$ajh."'";
		if($conn->query($sql1)){
			$ret = "保存基本信息成功";
		}else if($count == "1"){
			$ret = "申请号重复！";
//			$ret .= $sql1;
		}else{
			$ret = "保存基本信息失败";
		}
		echo $ret;
	}

	//获取申请人的其他地址
	if($flag == "Get_Address"){
		$per_id = $_GET['person_id'];
		
		$ret_data = "";
		$row_num = 0;
		$sql = "SELECT 地址 FROM 申请人地址 WHERE 申请人id='".$per_id."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ret_data["地址"][$row_num] = $row['地址'];
				$row_num++;
			}
		}
		$ret_data["row_num"] = $row_num;
		$json = json_encode($ret_data);
		echo $json;
	}
	//修改案件信息
	if($flag == 'ChanCaseMes') {
        $Mes = $_POST['Mes'];//数据
        $Text = $_POST['Text'];//位置
        $ajhT = $_POST['ajhT'];//案卷号
        $sql4 = " update 商标_案件  set ".$Text." = '".$Mes."' where 案卷号 = '".$ajhT."' ";
        $result4 = $conn->query($sql4);
        if($result4){
            echo 'ok';
        }else{
            echo '出现未知错误，请联系管理员';
        }
    }
	
	//修改案件信息-附加
	if($flag == 'ChanCaseMes2') {
        $Mes = $_POST['Mes'];//数据
        $Text = $_POST['Text'];//位置
        $ajhT = $_POST['ajhT'];//案卷号
        
        if($Text == "共有商标是"){
        	$Mes2 = !$Mes;
        	$sql4 = " update 商标_案件附加信息  set ".$Text." = '".$Mes."',共有商标否='".$Mes2."' where 案卷号 = '".$ajhT."' ";
        }else{
        	$sql4 = " update 商标_案件附加信息  set ".$Text." = '".$Mes."' where 案卷号 = '".$ajhT."' ";
        }
//		echo $sql4;
        $result4 = $conn->query($sql4);
        if($result4){
            echo 'ok';
        }else{
            echo '出现未知错误，请联系管理员';
        }
    }
	
	
$conn->close();
?>