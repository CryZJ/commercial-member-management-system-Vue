<?php
$flag = $_REQUEST["flag"];

switch($flag){
	case "Change_finance":
		$firm_id = $_GET["firm_id"];
		session_start();
		$_SESSION["firm_id"] = $firm_id;
		break;
	default :
		echo "非法flag";
}


?>