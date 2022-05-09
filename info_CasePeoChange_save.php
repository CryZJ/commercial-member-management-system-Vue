<?php 
	$falg = $_POST['falg'];
	require'conn.php';
	switch($falg) {
	    case 'changeSelect':
	        $ayr = $_POST['ayr'];
	        $dlr = $_POST['dlr'];
	        $ajh = $_POST['ajh'];
	        //如果属于专利案件
	        $sql1 = "select id from 专利信息 where 案卷号 ='".$ajh."'";
	        $result1 = $conn->query($sql1);
	        if($result1->num_rows>0){
	            if(strlen($ayr)==0 && strlen($dlr)>0){
	                $sql = "update 专利信息 set 代理人='".$dlr."' where 案卷号='".$ajh."' ";
                    $result = $conn->query($sql);
	            }
	            else if(strlen($ayr)>0 && strlen($dlr)==0){
	                $sql = "update 专利信息 set 案源人='".$ayr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
	            }else{
	                $sql = "update 专利信息 set 案源人='".$ayr."',代理人='".$dlr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
	            }
	        }
	        //如果属于年费案件
	        $sql1 = "select id from 专案_年费  where 案卷号 ='".$ajh."'";
            $result1 = $conn->query($sql1);
            if($result1->num_rows>0){
                if(strlen($ayr)==0 && strlen($dlr)>0){
                    $sql = "update 专案_年费 set 代理人='".$dlr."' where 案卷号='".$ajh."' ";
                    $result = $conn->query($sql);
                }
                else if(strlen($ayr)>0 && strlen($dlr)==0){
                    $sql = "update 专案_年费 set 案源人='".$ayr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
                }else{
                    $sql = "update 专案_年费 set 案源人='".$ayr."',代理人='".$dlr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
                }
            }
	        //如果属于其他案件
	        $sql1 = "select id from 专案_复审等  where 案卷号 ='".$ajh."'";
            $result1 = $conn->query($sql1);
            if($result1->num_rows>0){
                if(strlen($ayr)==0 && strlen($dlr)>0){
                    $sql = "update 专案_复审等 set 代理人='".$dlr."' where 案卷号='".$ajh."' ";
                    $result = $conn->query($sql);
                }
                else if(strlen($ayr)>0 && strlen($dlr)==0){
                    $sql = "update 专案_复审等 set 案源人='".$ayr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
                }else{
                    $sql = "update 专案_复审等 set 案源人='".$ayr."',代理人='".$dlr."' where 案卷号='".$ajh."'";
                    $result = $conn->query($sql);
                }
            }
	        break;
	    case 'changeAYR':
	        $OldName = $_POST['ayrO'];
            $NewName = $_POST['ayrN'];
            //专利案件
            $sql = "update 专利信息     set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            $sql = "update 专案_年费  set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            $sql = "update 专案_复审等 set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            //商标案件
            $sql = "update 商标_案件 set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            //著作案件
            $sql = "update 著作_信息 set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            //软件案件
            $sql = "update 软件_信息 set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            //海关案件
            $sql = "update 海关_案件 set 案源人='".$NewName."' where 案源人='".$OldName."'";
            $result = $conn->query($sql);
            break;
        case 'changeDLR':
            $OldName = $_POST['dlrO'];
            $NewName = $_POST['dlrN'];
            //专利案件
        	$sql = "update 专利信息 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	$sql = "update `专案_年费` set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	$sql = "update 专案_复审等 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	//商标案件
        	$sql = "update 商标_案件 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	//著作案件
        	$sql = "update 著作_信息 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	//软件案件
        	$sql = "update 软件_信息 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
        	//海关案件
        	$sql = "update 海关_案件 set 代理人='".$NewName."' where 代理人='".$OldName."'";
        	$result = $conn->query($sql);
            break;
        default:break;
	}
//	$OldName = $_GET['OldName'];
//	$NewName = $_GET['NewName'];
//	switch($falg){
//		case 'ayr':
//			$CaseType='案源人';
//		break;
//		case 'dlr':
//			$CaseType='代理人';
//		break;
//		default:break;
//	}
	
	
	if($result){
		echo 1;
	}else{
		echo $sql;
	}
	$conn->close();
?>