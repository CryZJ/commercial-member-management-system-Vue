<?php
	require'../../../AHeader.php'; 
	$flag = $_POST['flag'];
	require'../../../conn.php';
	if($flag=='change'){
//		$ajh = $_POST['ajh'];
//		$messc = $_POST['MessC'];
//		$FId = $_POST['FId'];
//		$date = date('Y-m-d H:i:s');
//		//查找年费信息
//		$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$FId."'";
//		$result3 = $conn->query($sql3);
//		if($result3->num_rows>0){
//			while($row3 = $result3->fetch_assoc()){
//				$fareid = $row3['id'];
//				$FareName = $row3['费用名称'];
//				$Fare = $row3['金额'];
//			}
//		}
//		//更改年费信息
//		$sql2 = "update 专案_年费记录  set 金额='".$messc."',修改时间='".$date."',修改人='".$userid."'  where id='".$FId."' ";
//		$result2 = $conn->query($sql2);
//		if($result2){
//			//保存操作记录
//			$FareMes = $FareName.'('.$Fare.'->'.$messc.')';
//			$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
//			$conn->query($AddHis);
//			echo '操作成功';
////			echo $sql2;
//		}else{
//			echo '出现未知错误，请联系管理员';
//		}
		
		
		$ajh = $_POST['ajh'];
            $messc = $_POST['MessC'];
            $FId = $_POST['FId'];
            $date = date('Y-m-d H:i:s');
            //查找费用信息
                //年费
            $sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$FId."' and 案卷号='".$ajh."'";
            $result3 = $conn->query($sql3);
            if($result3->num_rows>0){
                while($row3 = $result3->fetch_assoc()){
                    $fareid = $row3['id'];
                    $FareName = $row3['费用名称'];
                    $Fare = $row3['金额'];
                }
                //更改费用信息
                $sql2 = "update 专案_年费记录  set 金额='".$messc."',修改时间='".$date."',修改人='".$userid."'  where id='".$FId."' ";
                $result2 = $conn->query($sql2);
                if($result2){
                    //保存操作记录
                    $FareMes = $FareName.'('.$Fare.'->'.$messc.')';
                    $AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
                    $conn->query($AddHis);
                    echo '操作成功';
                }else{
                    echo '出现未知错误，请联系管理员';
                }
            }
                //其他费用
            $sql3 = "SELECT id,费用名称,金额  FROM 专案需交费用 where id = '".$FId."' and 案卷号='".$ajh."'";
            $result3 = $conn->query($sql3);
            if($result3->num_rows>0){
                while($row3 = $result3->fetch_assoc()){
                    $fareid = $row3['id'];
                    $FareName = $row3['费用名称'];
                    $Fare = $row3['金额'];
                }
                //更改费用信息
                $sql2 = "update 专案需交费用  set 金额='".$messc."',系统确认时间='".$date."'  where id='".$FId."' ";
                $result2 = $conn->query($sql2);
                if($result2){
                    //保存操作记录
                    $FareMes = $FareName.'('.$Fare.'->'.$messc.')';
                    $AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','修改费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
                    $conn->query($AddHis);
                    echo '操作成功';
                }else{
                    echo '出现未知错误，请联系管理员';
                }
            }
	}
	if($flag == 'del'){
//		$ajh = $_POST['ajh'];
//		$id = $_POST['id'];
//		//查找年费信息
//		$sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$id."'";
//		$result3 = $conn->query($sql3);
//		if($result3->num_rows>0){
//			while($row3 = $result3->fetch_assoc()){
//				$fareid = $row3['id'];
//				$FareName = $row3['费用名称'];
//				$Fare = $row3['金额'];
//			}
//		}
//		//更改年费信息
//		$sql4 = " update 专案_年费记录 set 状态 = 9 where id = '".$id."' ";
//		$result4 = $conn->query($sql4);
//		if($result4){
//			$FareMes = $FareName.'('.$Fare.')';
//			$AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','删除费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
//			$conn->query($AddHis);
//			echo '操作成功';
//		}else{
//			echo '出现未知错误，请联系管理员';
//		}
		
		
		$ajh = $_POST['ajh'];
        $id = $_POST['id'];
        
        //删改年费信息
        $sql3 = "SELECT id,案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 where id = '".$id."' and 案卷号='".$ajh."'";
        $result3 = $conn->query($sql3);
        if($result3->num_rows>0){
            while($row3 = $result3->fetch_assoc()){
                $fareid = $row3['id'];
                $FareName = $row3['费用名称'];
                $Fare = $row3['金额'];
            }
            $sql4 = " update 专案_年费记录 set 状态 = 9 where id = '".$id."' ";
            $result4 = $conn->query($sql4);
        }
        //删改其他信息
        $sql3 = "SELECT id,费用名称,金额  FROM 专案需交费用 where id = '".$id."' and 案卷号='".$ajh."'";
        $result3 = $conn->query($sql3);
        if($result3->num_rows>0){
            while($row3 = $result3->fetch_assoc()){
                $fareid = $row3['id'];
                $FareName = $row3['费用名称'];
                $Fare = $row3['金额'];
            }
            $sql4 = " update 专案需交费用 set 状态 = 9 where id = '".$id."' ";
            $result4 = $conn->query($sql4);
        }
        //
        if($result4){
            $FareMes = $FareName.'('.$Fare.')';
            $AddHis = "insert into 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) values('".$ajh."','".$name."','删除费用','".date('Y-m-d H:i:s')."','".$FareMes."')";
            $conn->query($AddHis);
            echo '操作成功';
        }else{
            echo '出现未知错误，请联系管理员';
        }
	}
	$conn->close();
?>