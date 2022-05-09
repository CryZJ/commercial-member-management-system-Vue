<?php
	session_start();
	
	$falg = $_GET['falg'];
	$aim  = $_GET['aim'];
	if($falg == 'NewPage'){//点击左侧目录菜单
//		echo 'ooooo';
		$_SESSION['normal'] ='about-1';
	}else if($falg == 'Index'){//专利案件
		$_SESSION['normal'] = $aim;
//		switch($aim){
//			case about-1:
//				$_SESSION['normal'] ='about-1';
//			break;
//			case about-2:
//				$_SESSION['normal'] ='about-2';
//			break;
//			case about-3:
//				$_SESSION['normal'] ='about-3';
//			break;
//			case about-4:
//				$_SESSION['normal'] ='about-4';
//			break;
//			case about-5:
//				$_SESSION['normal'] ='about-5';
//			break;
//		}
	}else if($falg == 'OA-Mail'){
		$_SESSION['normal'] = $aim;
//		switch($aim){
//			case about-1:
//				$_SESSION['normal'] ='about-1';
//			break;
//			case about-2:
//				$_SESSION['normal'] ='about-2';
//			break;
//			case about-3:
//				$_SESSION['normal'] ='about-3';
//			break;
//			case about-4:
//				$_SESSION['normal'] ='about-4';
//			break;
//			case about-5:
//				$_SESSION['normal'] ='about-5';
//			break;
//		}
	}
	
?>