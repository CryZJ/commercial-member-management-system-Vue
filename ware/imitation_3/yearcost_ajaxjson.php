<?php
header("Content-Type:application/json");

require'../../AHeader.php';
require_once "../../conn.php";

$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";

//验证身份是否是“流程操作员”
if(!$lcczy == "1"){
	echo '{"state":"0","message":"您没有权限操作"}';
	exit();
}

switch($flag){
	case "GetSaveApplicant":
		$mes_id = $_GET["mes_id"];
		if(!empty($mes_id)){
			$sql = "SELECT id,案卷号 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$mes_id."');";
			require_once "../../classes/GetAnnualFeeList.php";
			$getdata = new GetAnnualFeeList($conn,$sql);
			$getdata->UseClass();
			if(!empty($getdata->sqldata_annualfee)){
				/*
				 * $getdata->sqldata_annualfee
				 * [4140] => Array
			        (
			            [id] => 4140
			            [案卷号] => 0107700200
			            [专利名称] => 称重药品并将药品信息与其运输单位记录捆绑的移动设备
			            [申请人] => 中山达华智能科技股份有限公司
			            [申请号] => 2014204039858
			            [申请日] => 2014-07-21
				 		[申请人id] => 123456
			        )
				 * 
				 */
				$settledata = array();
				foreach($getdata->sqldata_annualfee as $index_id => $datainfo){
					if(!array_key_exists($datainfo["申请人"], $settledata)){
						$settledata[$datainfo["申请人"]]["申请人id"] = $datainfo["申请人id"];
						$settledata[$datainfo["申请人"]]["id"] = $datainfo["id"];
						$settledata[$datainfo["申请人"]]["案卷号"] = $datainfo["案卷号"];
						
						
						foreach($getdata->sqldata_annualfee as $index_id_2 => $datainfo_2){
							if($datainfo["申请人"] == $datainfo_2["申请人"] && $datainfo["id"] != $datainfo_2["id"]){
								$settledata[$datainfo["申请人"]]["id"] = $settledata[$datainfo["申请人"]]["id"].",". $datainfo_2["id"];
								$settledata[$datainfo["申请人"]]["案卷号"] = $settledata[$datainfo["申请人"]]["案卷号"].",".$datainfo_2["案卷号"];
							}
						}
					}
					
				}
				/* $settledata
				 * [中山达华智能科技股份有限公司] => Array
			        (
			            [id] => 4140
			            [案卷号] => 0107700200
			        )
				 * */
				if(!empty($settledata)){
					$tempdata = "";
					foreach($settledata as $applicant =>$datainfo){
						$tempdata .= ','.'{"申请人":"'.$applicant.'","申请人id":"'.$datainfo["申请人id"].'","id":"'.$datainfo["id"].'","案卷号":"'.$datainfo["案卷号"].'"}';
					}
					$tempdata = substr($tempdata, 1);
					
					$state = TRUE;
					$message = "获取成功";
					$retdata = '['.$tempdata.']';
				}
			}else{
				$message = "获取值为空";
			}
		}else{
			$message = "传值为空";
		}
		
		
		
		break;
	default:
		$message = "没有对应的flag";
		break;
}



$state = isset($state)?$state:FALSE;
$message = isset($message)?$message:"服务器错误";
$retdata = isset($retdata)?$retdata:'""';

$json = '{"state":"'.$state.'","message":"'.$message.'","data":'.$retdata.'}';
echo $json;
?>