<?php
require'../../conn.php';
$flag = $_POST["flag"];
if($flag=="check_time"){
	$nf = $_POST["nf"];
	$finance_month_record = $_POST["bm"];
	$pjt = "00";
	$pjw = "12";
	$nyt = $nf.$pjt;
	$nyw = $nf.$pjw;
	$sql1 = "SELECT 年月,总收费,规费,管理费,税费,支出金额,本月利润,期初结转,本月结存,本月欠费  FROM ".$finance_month_record." WHERE `年月`>=".$nyt." AND `年月`<=".$nyw." ORDER BY 年月 DESC";
	$result1 = $conn->query($sql1);
	$sqldata='';
	if ($result1->num_rows > 0) {
		$count=mysqli_num_rows($result1);
			while($row = $result1->fetch_assoc()) {
				$sqldata=$sqldata.'{"年月":"'.$row["年月"].'","总收费":"'.$row["总收费"].'","规费":"'.$row["规费"].'","管理费":"'.$row["管理费"].'","税费":"'.$row["税费"].'","支出金额":"'.$row["支出金额"].'","本月利润":"'.$row["本月利润"].'","期初结转":"'.$row["期初结转"].'","本月结存":"'.$row["本月结存"].'","本月欠费":"'.$row["本月欠费"].'"},';
			}
		$jsonresult='success';
		$otherdata = '{"result":"'.$jsonresult.'",
					"count":"'.$count.'"
					}';
		$json="[".$sqldata.$otherdata."]";
		echo $json;	    	
	}else{
		echo "null";
	}
};
?>