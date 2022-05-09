<?php
$my_flag = $_POST['my_flag'];

if($my_flag == "debit" ){
	$pay_id = $_POST['id_str'];
	if(strpos($pay_id, ",")!="FALSE"){
		$arr_id = explode(",", $pay_id);
	}else{
		$arr_id[0] = $pay_id;
	}
//	print_r($arr_id);
	$return='';
	$return_str='';
	require('../conn.php');	
	foreach($arr_id as $key_0 => $id){
		//获取数据
		$data='';
		$sql = "SELECT 文件名称,案卷号,专利名称,申请号,申请日 FROM 临时文件  WHERE id='".$id."'";	
	 	$result = $conn->query($sql);
	 	if($result->num_rows>0){
	 		while($row = $result->fetch_assoc()){
	 			$data[0] = $row['文件名称'];
				$data[1] = $row['专利名称'];
				$data[2] = $row['案卷号'];
				$data[3] = $row['申请号'];
				$data[4] = $row['申请日'];
	 		}
	 	}else{
	 		exit("“临时文件”中无id为".$id."这行数据！");
	 	}
//		print_r($data);
		if($data != ''){
			//读取xml里的费用
			require_once "more_upload_func.php";
			$path = "../tmp_fileupload/".$data[0];
			if(file_exists($path)){
				$cost_return = read_feeremind_xml($path);
	//Array ( [发文日] => 2016-03-30 [申请号] => 2014300322665 [缴费年度] => 3 
	//[滞纳金] => Array ( 
	//[0] => Array ( [年费] => 90.0 [滞纳金额] => 30.0 [缴费开始时间] => 2016-03-25 [缴费截止时间] => 2016-04-25 ) 
	//[1] => Array ( [年费] => 90.0 [滞纳金额] => 60.0 [缴费开始时间] => 2016-04-26 [缴费截止时间] => 2016-05-24 ) 
	//[2] => Array ( [年费] => 90.0 [滞纳金额] => 90.0 [缴费开始时间] => 2016-05-25 [缴费截止时间] => 2016-06-24 ) 
	//[3] => Array ( [年费] => 90.0 [滞纳金额] => 120.0 [缴费开始时间] => 2016-06-25 [缴费截止时间] => 2016-07-25 ) 
	//[4] => Array ( [年费] => 90.0 [滞纳金额] => 150.0 [缴费开始时间] => 2016-07-26 [缴费截止时间] => 2016-08-24 ) ) 
	//[result] => success )	
				if($cost_return['result'] == "success" ){
					foreach($cost_return['滞纳金'] as $key_0 => $value_0){
						$sql_d = "SELECT id FROM 滞纳金列表   WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
						$result_judge = $conn->query($sql_d);
						if($result_judge ->num_rows>0){
							$sql = "UPDATE 滞纳金列表  SET 滞纳金='".$value_0["滞纳金额"]."',开始时间='".$value_0["缴费开始时间"]."',截止时间='".$value_0["缴费截止时间"]."' WHERE 案卷号='".$data[2]."' AND 年度='".$cost_return["缴费年度"]."' AND 期数='".(intval($key_0)+1)."'";
							$result = $conn->query($sql);
							if($result){
								//删除文件
								$path = "../tmp_fileupload/".$data[0];
								$path = iconv("utf-8", "gbk", $path);
								if(file_exists($path)){
									if(unlink($path)){
									//更新数据库
									$sql4 = "UPDATE 临时文件  SET 上传情况='已删除'  WHERE id='".$id."'";
									$result4 = $conn->query($sql4);
									if($result4){
										$return = $return.$data[0]."删除文件成功！\n";
									}else{
										$return = $return.$data[0]."删除文件失败！\n";
									}		
									}else{
										$return = $return.$data[0]."删除文件失败！\n";
									}
								}
								$return_str = $return_str.$data[3]."的滞纳金更新成功！\n";
							}else{
								$return_str = $return_str.$data[3]."的滞纳金更新失败！\n";
							}
						}
					}
				}else{
					exit("读取费用失败！");
				}
			}
		}
	}//foreach
	echo $return.$return_str;
}
?>