<?php
	header('Content-Type: text/xml');
	header("Cache-Control: no-cache, must-revalidate");
	
	$sqr = $_GET['sqr'];//获取URL上的sqr
	//echo $sqr;
	/*获取完整的URL
	echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	*/
		$dz = $zjh = "";
		require("../../../conn.php");
		$sql2 = "select 地址,证件号 from 申请人 where 申请人='".$sqr."'";
		//$sql2 = "select 地址,证件号 from 申请人 where 申请人='1231'";
		$result2 = $conn->query($sql2);
		if($result2->num_rows > 0){
			while($row = $result2->fetch_assoc()){
					$dz = $row["地址"];
					$zjh = $row["证件号"];
			}
		}
	$conn->close();
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><person>";	
	echo "<dz>" .$dz. "</dz>";
	echo "<zjh>" .$zjh. "</zjh>";
	echo "</person>";	
	
?>