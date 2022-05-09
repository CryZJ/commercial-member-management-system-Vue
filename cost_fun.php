<?php
/*各种费用*/
/*用费减比例来做判断，决定返回的费用*/
function cost($fjb,$lx){
	$return_cost ="";//返回的数组
	if($fjb=="85%"){
		switch($lx){
			case "1":
				$return_cost['2'] = 135;
				$return_cost['3'] = 135;
				$return_cost['4'] = 180;
				$return_cost['5'] = 180;
				$return_cost['6'] = 180;
				$return_cost['7'] = 300;
				$return_cost['8'] = 300;
				$return_cost['9'] = 300;
				$return_cost['10'] = 600;
				$return_cost['11'] = 600;
				$return_cost['12'] = 600;
				$return_cost['13'] = 900;
				$return_cost['14'] = 900;
				$return_cost['15'] = 900;
				$return_cost['16'] = 1200;
				$return_cost['17'] = 1200;
				$return_cost['18'] = 1200;
				$return_cost['19'] = 1200;
				$return_cost['20'] = 1200;
				break;
			case "2":
				$return_cost['2'] = 90;
				$return_cost['3'] = 90;
				$return_cost['4'] = 135;
				$return_cost['5'] = 135;
				$return_cost['6'] = 180;
				$return_cost['7'] = 180;
				$return_cost['8'] = 180;
				$return_cost['9'] = 300;
				$return_cost['10'] = 300;
				break;
			case "3":
				$return_cost['2'] = 90;
				$return_cost['3'] = 90;
				$return_cost['4'] = 135;
				$return_cost['5'] = 135;
				$return_cost['6'] = 180;
				$return_cost['7'] = 180;
				$return_cost['8'] = 180;
				$return_cost['9'] = 300;
				$return_cost['10'] = 300;
				break;
		}
	}else if($fjb=="70%"){
		switch($lx){
			case "1":
				$return_cost['2'] = 270;
				$return_cost['3'] = 270;
				$return_cost['4'] = 360;
				$return_cost['5'] = 360;
				$return_cost['6'] = 360;
				$return_cost['7'] = 600;
				$return_cost['8'] = 600;
				$return_cost['9'] = 600;
				$return_cost['10'] = 1200;
				$return_cost['11'] = 1200;
				$return_cost['12'] = 1200;
				$return_cost['13'] = 1800;
				$return_cost['14'] = 1800;
				$return_cost['15'] = 1800;
				$return_cost['16'] = 2400;
				$return_cost['17'] = 2400;
				$return_cost['18'] = 2400;
				$return_cost['19'] = 2400;
				$return_cost['20'] = 2400;
				break;
			case "2":
				$return_cost['2'] = 180;
				$return_cost['3'] = 180;
				$return_cost['4'] = 270;
				$return_cost['5'] = 270;
				$return_cost['6'] = 360;
				$return_cost['7'] = 360;
				$return_cost['8'] = 360;
				$return_cost['9'] = 600;
				$return_cost['10'] = 600;
				break;
			case "3":
				$return_cost['2'] = 180;
				$return_cost['3'] = 180;
				$return_cost['4'] = 270;
				$return_cost['5'] = 270;
				$return_cost['6'] = 360;
				$return_cost['7'] = 360;
				$return_cost['8'] = 360;
				$return_cost['9'] = 600;
				$return_cost['10'] = 600;
				break;
		}
	}else{
		switch($lx){
			case "1":
				$return_cost['2'] = 900;
				$return_cost['3'] = 900;
				$return_cost['4'] = 1200;
				$return_cost['5'] = 1200;
				$return_cost['6'] = 1200;
				$return_cost['7'] = 2000;
				$return_cost['8'] = 2000;
				$return_cost['9'] = 2000;
				$return_cost['10'] = 4000;
				$return_cost['11'] = 4000;
				$return_cost['12'] = 4000;
				$return_cost['13'] = 6000;
				$return_cost['14'] = 6000;
				$return_cost['15'] = 6000;
				$return_cost['16'] = 8000;
				$return_cost['17'] = 8000;
				$return_cost['18'] = 8000;
				$return_cost['19'] = 8000;
				$return_cost['20'] = 8000;
				break;
			case "2":
				$return_cost['2'] = 600;
				$return_cost['3'] = 600;
				$return_cost['4'] = 900;
				$return_cost['5'] = 900;
				$return_cost['6'] = 1200;
				$return_cost['7'] = 1200;
				$return_cost['8'] = 1200;
				$return_cost['9'] = 2000;
				$return_cost['10'] = 2000;
				break;
			case "3":
				$return_cost['2'] = 600;
				$return_cost['3'] = 600;
				$return_cost['4'] = 900;
				$return_cost['5'] = 900;
				$return_cost['6'] = 1200;
				$return_cost['7'] = 1200;
				$return_cost['8'] = 1200;
				$return_cost['9'] = 2000;
				$return_cost['10'] = 2000;
				break;
		}
	}
	return $return_cost;
}

/*函数测试*/
//	$year_cost = cost("85%","3");
//	print_r($year_cost); 

?>