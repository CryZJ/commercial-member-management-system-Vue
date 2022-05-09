<?php
require("../../conn.php");
$sql = "SELECT id,申请人 FROM 申请人";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$sqr_name = $row["申请人"];
		$sqr_name = str_replace(" ", '', $sqr_name);
		$sql = "UPDATE 申请人 SET 申请人='".$sqr_name."' WHERE id='".$row["id"]."'";
		$conn->query($sql);
	}
}
$conn->close();
?>