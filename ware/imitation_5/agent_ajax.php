<?php
header("Content-Type:application/json");
require_once "../../conn.php";

/*
 * 生成随机的26字母编码
 * */
function CreateNameCode(){
	$upletter = "QWERTYUIOPASDFGHJKLZXCVBNM";
	$lowerletter = "qwertyuiopasdfghjklzxcvbnm";
	$index_up = rand(0,25);
	$index_low = rand(0,25);
	return substr($upletter, $index_up,1).substr($lowerletter, $index_low,1);
}

$flag = isset($_REQUEST["flag"])?$_REQUEST["flag"]:"";
$flag = "GetNameCode";
switch($flag){
	case "GetNameCode" :
		$namecode_arr = "";
		$sql = "SELECT 案源人编号 FROM 用户";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				$namecode_arr[] = $row[0];
			}
			$cycleflag = TRUE;//如果循环完毕也没有对应的编号
			for($i=0;$i<676;$i++){
				$namecode = CreateNameCode();
				if(!in_array($namecode, $namecode_arr)){
					$cycleflag = FALSE;
					$state = TRUE;
					$message = "获取成功";
					$retdata = '{"namecode":"'.$namecode.'"}';
					break;
				}
			}
			if($cycleflag){
				$message = "676个（大写+小写）编号已用完，请联系管理员新增";
			}
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