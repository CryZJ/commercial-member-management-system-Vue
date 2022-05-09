<?php
	require("../../AHeader.php");
	require'../../conn.php';
	require_once "../../classes/CreateAnnualFee.php";
	
	/*增加日期的监控
	 * $date_start:日期或时间戳
	 * $y：变化的年数(-10,0,10,100.....)
	 * $m:	变化的月数（-12~12）
	 * $d：变化的天数（-15,15,20,30....)
	*/
	function Set_Date($date_start,$y,$m,$d){
		$str = $y."years,".$m."months,".$d."days";
		return date("Y-m-d",strtotime($str,strtotime($date_start)));
	}
	
    $falg = $_GET['falg'];
    $mes = $_GET['mes'];
    $ajh = $_GET['ajh'];
    
//  $falg = 'sqrid';
//  $mes = '1469,1468';
//  $ajh = '10502aQ3bF';
	
	switch($falg) {
	    case 'sqrid'://申请人
	        $place = '申请人id';
	        break;
	    case 'zlmc'://专利名称
	        $place = '专利名称';
            break;
        case 'select_ayr'://案源人
            $place = '案源人';
            break;
        case 'select_dlr'://代理人
            $place = '代理人';
            break;
        case 'sqd'://申请日
            $place = '申请日';
            break;
        case 'sqgg'://授权公告
            $place = '授权时间';
            break;
        case 'dqcx'://当前程序
            $place = '状态';
            break;
        case 'FareCount'://费减比
            $place = '年费费减比例';
            break;
        default:break;
	}
	
	$date = date('Y-m-d');
	$sqrAL='';
	
	switch($falg){
		case "dqcx"://更改案件状态时，如果为结案
			if($mes=='结案'){
				$sql = "update 专利信息 set 冻结状态=1 where 案卷号='".$ajh."' ";
			}else{
				$sql = "update 专利信息 set ".$place." = '".$mes."' where 案卷号='".$ajh."' ";
			}
			//保存专利信息
			$result = $conn->query($sql);
			break;
			
		case "sqrid"://更改申请人
			$sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$mes."')";
	        $result8 = $conn->query($sql8);
	        if($result8 ->num_rows>0){
	            while($row8 = $result8->fetch_assoc()){
	                $sqrAL = $row8["申请人"];
	            }
	        }
			$sql = "update 专利信息 set 申请人id='".$mes."' , 申请人='".$sqrAL."',发明设计人id=''  where 案卷号='".$ajh."' ";
			//保存专利信息
			$result = $conn->query($sql);
			break;
			
		case "sqd":
			$retarr = array(
				"state" => FALSE,
				"message" => "服务器错误"
			);
			$sql = "UPDATE 专利信息 SET 申请日='".$mes."' WHERE 案卷号='".$ajh."'";
			$result = $conn->query($sql);
			if($result){
				$retarr["state"] = TRUE;
				$retarr["message"] = "保存成功";
				
				//根据案卷号获取生成年费相关的信息：申请日、首年度、年费费减比、案件类型
				$case_info = array("申请日"=>"","首年度"=>"","费减比例"=>"","类型"=>"");
				$sql = "SELECT 申请日,年费首年度,年费费减比例,类型 FROM `专利信息` WHERE `案卷号`='".$ajh."'";
				$result_1 = $conn->query($sql);
				if($result_1->num_rows > 0){
					while($row = $result_1->fetch_row()){
						$case_info["申请日"] = $row[0];
						$case_info["首年度"] = $row[1];
						$case_info["费减比例"] = $row[2];
						$case_info["类型"] = $row[3];
					}
					//根据案件相关信息生成年费记录
					$annualfee = new CreateAnnualFee($conn,$case_info["申请日"],$case_info["首年度"],$case_info["费减比例"],$case_info["类型"]);
					$redata = $annualfee->GetAnnualFeeDate();
					
					//根据案卷号查询该案件的年费情况
					$yearnum_retsave = array();
					$sql = "SELECT id,年度,状态 FROM `专案_年费记录` WHERE `案卷号`='".$ajh."' AND (状态='0' OR 状态='8' OR 状态='1' OR 状态='4')";
					$result_2 = $conn->query($sql);
					if($result_2->num_rows > 0){
						while($row = $result_2->fetch_assoc()){
							$yearnum_retsave[] = $row["年度"];
							//删除滞纳金
							$sql_d = "DELETE FROM 滞纳金列表 WHERE 案卷号='".$ajh."' AND 年度='".$row["年度"]."'";
							$conn->query($sql_d);
							//删除年费记录
							$sql_d = "DELETE FROM 专案_年费记录 WHERE id='".$row["id"]."'";
							$conn->query($sql_d);
						}
						//重建年费记录
						foreach($redata as $index => $datainfo){
							if(in_array($datainfo["年度"], $yearnum_retsave)){
								//保存年费记录
								$sql_s = "INSERT INTO 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期,状态) VALUES(";
								$sql_s .= "'".$ajh."','".$datainfo["年度"]."','".$datainfo["金额"]."','".$datainfo["提醒日期"]."','".$datainfo["截止日期"]."','0')";
								$conn->query($sql_s);
								//保存滞纳金记录 Set_Date($date_start,$y,$m,$d){
								foreach($datainfo["滞纳金"] as $index2 => $znj){
									$sql_z = "INSERT INTO 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) VALUES(";
									$sql_z .= "'".$ajh."','".$datainfo["年度"]."','".(intval($index2)+1)."','".$znj."','".Set_Date($datainfo["截止日期"],0,intval($index2),0)."','".Set_Date($datainfo["截止日期"],0,(intval($index2)+1),0)."')";
									$conn->query($sql_z);
								}
							}
						}
						
						$retarr["message"] .= ",年费已重新生";
					}
				}else{
					$retarr["message"] .= ",无年费记录无法生成";
				}
			}else{
				$retarr["message"] = "服务器错误";
			}
			break;
			
		default://更改普通信息
			$sql = "update 专利信息 set ".$place." = '".$mes."' where 案卷号='".$ajh."' ";
			//保存专利信息
			$result = $conn->query($sql);
	}
	
//	if($falg == 'dqcx' && $mes=='结案'){//更改案件状态
//		$sql = "update 专利信息 set 冻结状态=1 where 案卷号='".$ajh."' ";
//	}else if($falg=='sqrid'){//更改申请人
//	    $sql8 = "SELECT GROUP_CONCAT(申请人) AS 申请人 FROM 申请人 WHERE FIND_IN_SET(id,'".$mes."')";
//      $result8 = $conn->query($sql8);
//      if($result8 ->num_rows>0){
//          while($row8 = $result8->fetch_assoc()){
//              $sqrAL = $row8["申请人"];
//          }
//      }
//		$sql = "update 专利信息 set 申请人id='".$mes."' , 申请人='".$sqrAL."',发明设计人id=''  where 案卷号='".$ajh."' ";
//	}else{//更改普通信息
//	    $sql = "update 专利信息 set ".$place." = '".$mes."' where 案卷号='".$ajh."' ";
//	}
	

	if($result){//保存操作记录
		$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','修改案件基本信息','".date("Y-m-d H:i:s")."','更新案件基本信息')";
		$conn->query($sql);
		echo 1;
	}else{
		echo $sql;
	}

    $conn->close();
?>