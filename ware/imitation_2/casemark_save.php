<?php 
require("../../AHeader.php");
require'../../conn.php';
	
	$flag=$_REQUEST['flag'];
	
	if($flag == 'casesave'){
		$bmes = $_POST['bmes'];
		$emes = $_POST['emes'];
		$bz = $_POST['bz'];
//		echo $bmes."\n".$emes."\n".$bz;
		$bmes = explode("/", $bmes);
		$emes = explode("/", $emes);
		$ret = array(
			"result"=>"保存失败"
		);
		
		if(strlen($emes[1])==0){
		    $emes[1] = '无';
		}
		
		$sql = "INSERT INTO 办公_案件基本登记(案源人,代理人,接单日期,预计完成时间,客户姓名,接单内容,处理情况,收费情况,创建人,创建时间,备注) VALUES(";
		$sql .= "'".$bmes[0]."','".$bmes[1]."','".$bmes[2]."','".$bmes[3]."','".$emes[0]."','".$emes[1]."','".$emes[2]."','".$emes[3]."','".$name."','".date("Y-m-d")."','".$bz."')";
//		echo $sql;
		if($conn->query($sql)){
			$sql2 = "SELECT id FROM 办公_案件基本登记  ORDER BY id DESC LIMIT 1 ";
			$result2 = $conn->query($sql2);
			if($result2->num_rows>0){
				while($row2 = $result2->fetch_assoc()){
					$ret['djid'] = $row2['id'];
				}
			}
			$ret['result'] =  "保存成功";
			
		}else{
			$ret['result'] = "保存失败";
		}
		$json = json_encode($ret);
		echo $json;
		
	}
	
	if($flag == 'finish'){
		$self_id = $_POST['self_id'];
		$sql = "UPDATE  办公_案件基本登记 SET 状态='1',实际完成时间='".date("Y-m-d H:i:s")."' WHERE id='".$self_id."'";
		if($conn->query($sql)){
			echo "结案成功"; 
		}else{
			echo "结案失败";
		}
		
		$conn->close();
	}
	if($flag == 'del'){
		$self_id = $_POST['self_id'];
		$sql = "UPDATE  办公_案件基本登记 SET 状态='2' WHERE FIND_IN_SET(id,'".$self_id."')";
		if($conn->query($sql)){
			echo "删除成功"; 
		}else{
			echo "删除失败";
		}
		
	}
	if($flag == 'getdata'){
		$self_id = $_POST['self_id'];
		$ret_data = array();
		$sql = "SELECT id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,收费情况,备注 FROM 办公_案件基本登记   WHERE id='".$self_id."'";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$ret_data[0] = $row['案源人'];
				$ret_data[1] = $row['代理人'];
				$ret_data[2] = $row['接单日期'];
				$ret_data[3] = $row['预计完成时间'];
				$ret_data[4] = $row['客户姓名'];
				$ret_data[5] = $row['接单内容'];
				$ret_data[6] = $row['处理情况'];
				$ret_data[7] = $row['收费情况'];
				$ret_data[8] = $row['备注'];
			}
		}
		$json = json_encode($ret_data);
		echo $json;
	}
	if($flag == 'alter'){
		$bmes = $_POST['bmes'];
		$emes = $_POST['emes'];
		$bz = $_POST['bz'];
		$self_id = $_POST['self_id'];
//		echo $bmes."\n".$emes."\n".$bz;
		$bmes = explode("/", $bmes);
		$emes = explode("/", $emes);
		$sql = "UPDATE 办公_案件基本登记   SET 案源人='".$bmes[0]."',代理人='".$bmes[1]."',接单日期='".$bmes[2]."',预计完成时间='".$bmes[3]."',客户姓名='".$emes[0]."',接单内容='".$emes[1]."',处理情况='".$emes[2]."',收费情况='".$emes[3]."',创建人='".$name."',创建时间='".date("Y-m-d")."',备注='".$bz."' WHERE id='".$self_id."'";
//		echo $sql;
		if($conn->query($sql)){
			echo "保存成功";

		}else{
			echo "保存失败";
		}
	}
	if($flag == 'uploadfile'){
		$djid = $_POST['djid'];
//		echo $djid;
		$des = $_POST['des'];
		$des = explode(",", $des);
//		print_r($_FILES);
		$ret = '';
		require_once "../../upload_func.php";
		$i=0;
		if(count($_FILES)>0){
			foreach($_FILES as $ky => $fileinfo){
				$uppath = "../../casemark_file"."/".$djid;
				$ret_path = casemark_upload($fileinfo,$uppath);
				$sql = "INSERT INTO 办公_案件基本登记文件(基本登记id,文件路径,描述) VALUES('".$djid."','".$ret_path."','".$des[$i]."') ";
				if($conn->query($sql)){
					$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存成功\n";
				}else{
					$ret .= pathinfo($ret_path,PATHINFO_BASENAME)."保存失败\n";
				}
				$i++;
			}
		}else{
			$ret .= "无文件保存";
		}
		
		echo $ret;
		
		
	}


$conn->close();	
?>
