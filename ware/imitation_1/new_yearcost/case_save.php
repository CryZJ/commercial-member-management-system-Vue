<?php
require'../../../AHeader.php';
require'../../../conn.php';

	$flag = $_REQUEST['flag'];
//	$flag = 'yearfare';
	if($flag == 'ajh'){
		$dlid = $_REQUEST['dlrid'];
		$ayid = $_REQUEST['ayrid'];
		$str = $_REQUEST['ctype'];
		
		//案源人
		$sql = "select 编号,id,名称 from 案源人信息  where id='".$ayid."'";
		$result = $conn->query($sql);
		if($result->num_rows >= 0){
            while($row = $result->fetch_assoc()){
            	$aybh = $row['编号'];
            	$str2 = $row['名称'];
            }
        }
		//代理人
		$sqlx = "select 编号,id,名称 from 代理人信息  where id='".$dlid."'";
		$resultx = $conn->query($sqlx);
		if($resultx->num_rows >= 0){
            while($rowx = $resultx->fetch_assoc()){
            	$dlbh = $rowx['编号'];
            	$str3 = $rowx['名称'];
            }
        }
        $sql0 = "select COUNT(id) as 总数 from 专利信息";
		$result0 = $conn->query($sql0);
		if($result0->num_rows > 0){
			while($row0 = $result0->fetch_assoc()){
				$countnumber_0 = $row0["总数"];
			}
		}
		$sql03 = "select COUNT(id) as 总数 from 专案_无效";
		$result03 = $conn->query($sql03);
		if($result03->num_rows > 0){
			while($row03 = $result03->fetch_assoc()){
				$countnumber_1 = $row03["总数"];
			}
		}
		$sql04 = "select COUNT(id) as 总数 from 专案_年费";
		$result04 = $conn->query($sql04);
		if($result04->num_rows > 0){
			while($row04 = $result04->fetch_assoc()){
				$countnumber_2 = $row04["总数"];
			}
		}
		$sql05 = "select COUNT(id) as 总数 from 专案_复审等";
		$result05 = $conn->query($sql05);
		if($result05->num_rows > 0){
			while($row05 = $result05->fetch_assoc()){
				$countnumber_3 = $row05["总数"];
			}
		}
		$countnumber = $countnumber_0 + $countnumber_1 + $countnumber_2 + $countnumber_3;

		/*前面序号：05000*/
		$sn = "";
		$num = 5000;
		$countnumber = $countnumber +1 ;
		$num += $countnumber;
		$num = strval($num);
		$len2 = strlen($num);
		switch($len2){
			case 1 : $sn2 = "0000".$num;break;
			case 2 : $sn2 = "000".$num;break;
			case 3 : $sn2 = "00".$num;break;
			case 4 : $sn2 = "0".$num;break;
			default : $sn2 = $num;
		}
		//不能用 btn_id 做第二标识，当新增行时，btn_id=“行数-2”
	//	$string = $sn . $str . $str2 . $str3;
	//	$string = $sn . $str . $str2 . $str3 . $num_r;
	//返回数据库里的行数+1、大写子母，用，分割
	//格式：流水号+案源人编号+案卷类型+代理人编号
		$ajh = $sn2.$aybh.$str.$dlbh;
		$time = date('Y-m-d H:i:s');
		$sql_ajh = "insert into 专案_年费(案卷号,案件状态,创建时间,案源人,代理人,登记人) values ('".$ajh."',9,'".$time."','".$str2."','".$str3."','".$name."')";
//		$sql_ajh = "insert into 专案_年费(案卷号,案件状态) values ('".$ajh."',9)";
		$result_ajh = $conn->query($sql_ajh);
		
		echo $ajh;
	}
	
	if($flag == 'yearfare'){
		$year = $_REQUEST['year'];
		$count = $_REQUEST['count'];
		$type = $_REQUEST['type'];
//		$year = '1';
//		$count ='85%';
//		$type = '实用新型';
		$data = array();
		//获取前六年的金额
		$sql3 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '".$count."' and 年度>='".$year."'";
		$result3 = $conn->query($sql3);
		if($result3->num_rows>0){
			$i = 1;
			while($row3 = $result3->fetch_assoc()){
				$data[$i]['fare'] = $row3['金额'];
				$data[$i]['year'] = $row3['年度'];
				$i++;
			}
		}
		$yearl = $year+10;//计算年度
		//获取六年之后的金额
		$sql4 = "select id,专利类型,年费费减比例,年度,金额 from 年费设置 where 专利类型='".$type."' and 年费费减比例= '100%' and 年度>='".$yearl."'";
		$result4 = $conn->query($sql4);
		if($result4->num_rows>0){
			$i = 7;
			while($row4 = $result4->fetch_assoc()){
				$data[$i]['fare'] = $row4['金额'];
				$data[$i]['year'] = $row4['年度'];
				$i++;
			}
		}
		$return_data = json_encode($data);
		echo $return_data;
	}
	
	if($flag == 'znj'){
		$year = $_REQUEST['year'];
		$type = $_REQUEST['type'];
		$sql6 = "select count(id) as num from 年费设置 where 专利类型='".$type."' and 年费费减比例='100%' ";
		$result6 = $conn->query($sql6);
		if($result6->num_rows>0){
			while($row6 = $result6->fetch_assoc()){
					$fid = $row6['num'];
				}
		}
		for($i=$year;$i<=$fid;$i++){
			$sql5="select count(id) as num,年度,金额 from 年费设置 where 专利类型 = '".$type."' and 年度 = '".$i."' and 年费费减比例='100%' order by 年度 ";
			$result5 = $conn->query($sql5);
			if($result5->num_rows>0){
				while($row5 = $result5->fetch_assoc()){
					$farezn = $row5['金额'];
					$data_znj[$i][0] = (int)$farezn*0.05;
					$data_znj[$i][1] = (int)$farezn*0.10;
					$data_znj[$i][2] = (int)$farezn*0.15;
					$data_znj[$i][3] = (int)$farezn*0.20;
					$data_znj[$i][4] = (int)$farezn*0.25;
				}
			}
		}
		$data_rezn=json_encode($data_znj);
		echo $data_rezn;
//		echo print_r($data_znj);
	}
	
	if($flag == 'casesave'){
		//获取数据
		$strm = $_REQUEST['strm'];
		$strb = $_REQUEST['strb'];
		$strf = $_REQUEST['strf'];//费用信息【字符串类型】
		$stre = $_REQUEST['stre'];//处理人
		$strt = $_REQUEST['strt'];//滞纳金起始截止时间【从零开始的数组】
		
		$arrm = explode('|',$strm);
		$arrb = explode('|',$strb);
		$arrf = explode(',',$strf);
		$numf = count($arrf);
		$date = date('Y-m-d');
		
		
//		//查找申请人id
//		$sql_sqridt = "select id FROM `申请人` WHERE 申请人= '".$arrm[4]."'";
//		$result_sqridt = $conn->query($sql_sqridt);
//		if($result_sqridt->num_rows>0){
//			while($row_sqridt = $result_sqridt->fetch_assoc()){
//				$sqridt = $row_sqridt['id'];
//			}
//		}
		$sqr = explode(',',$arrm[4]);
		$len = count($sqr);
		$sqrid_t='';
		for($j=0;$j<$len;$j++){
		//		从数据库比对数据，得到申请人详细信息
			$sql8 = "select id FROM `申请人` WHERE 申请人= '".$sqr[$j]."'";
			$result8 = $conn->query($sql8);
			if($result8 ->num_rows>0){
				while($row8 = $result8->fetch_assoc()){
					$sqrid_t = $sqrid_t.','.$row8["id"];
				}
			}
		}
		$sqrid_t = substr($sqrid_t,1);
		
		$sqli="select * from 专案_年费 where 申请号='".$arrm[2]."'";
		$resulti = $conn->query($sqli);
		$sqli1="select * from 专利信息 where 申请号='".$arrm[2]."'";
		$resulti1 = $conn->query($sqli1);
		$sqli2="select * from 专案_复审等 where 申请号='".$arrm[2]."'";
		$resulti2 = $conn->query($sqli2);
		$count1 = 0;
		$count1 = $count1+$resulti ->num_rows+$resulti1 ->num_rows+$resulti2 ->num_rows;		
		if($count1>0){
			echo '2';
			die();
		}		
//		echo $sqrid_t;
		//保存基本信息
		$showtime = date("Y-m-d H:i:s");
		$sql7  = "insert into 专案_年费(专利名称,申请号,申请日,申请人,类型,费减年度,案源人,代理人,案卷号,代理时间,首年度,登记人,登记时间,费减比例,申请人id,原案卷号,状态,创建时间)  values ('".$arrm[0]."','".$arrm[2]."','".$arrm[3]."','".$arrm[4]."','".$arrm[1]."','".$arrm[5]."','".$arrb[0]."','".$arrb[1]."','".$arrb[2]."','".$arrb[3]."','".$arrb[4]."','".$stre."','".$date."','".$arrb[5]."','".$sqrid_t."','".$arrb[7]."','年费中','".$showtime."')";
		echo $sql7;
		$result7 = $conn->query($sql7);
		//删除创建案件时新建的案卷号
		$sql_del = "delete from `专案_年费` where 案件状态='9' and 案卷号='".$arrb[2]."'";
		$result_del = $conn->query($sql_del);
		//提取id
		$sql8  = "select id from `专案_年费` where 登记人='".$stre."' and 案卷号='".$arrb[2]."' ";
		$result8 = $conn->query($sql8);
		if($result8 -> num_rows >0 ){
			while($row8 = $result8->fetch_assoc()){
				$case_id = $row8['id'];
			}
		}
		//查找案源人代理人信息
			//案源人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$arrb[0]."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$ayrid = $row_sqrid['id'];//案源人代理id
				$ayrsonid = $row_sqrid['sonid'];//案源人用户id
			}
		}
			//代理人
		$sql_sqrid = "select id,名称,sonid from 代理人信息  WHERE 名称= '".$arrb[1]."'";
		$result_sqrid = $conn->query($sql_sqrid);
		if($result_sqrid->num_rows>0){
			while($row_sqrid = $result_sqrid->fetch_assoc()){
				$dlrid = $row_sqrid['id'];//代理人代理id
				$dlrsonid = $row_sqrid['sonid'];//代理人用户id
			}
		}
		//保存专案_可见表，确定谁可见
		$sql_view = "insert into `专案_可见`(案卷号,ctype,创建时间,创建人,案源可见id,案源可见人,案源代理id,代理可见id,代理可见人,代理代理id)  values('".$arrb[2]."','3','".$date."','".$stre."','".$ayrid."','".$arrb[0]."','".$ayrsonid."','".$dlrid."','".$arrb[1]."','".$dlrsonid."')";
		$result_view = $conn->query($sql_view);

		//保存费用信息
		for($i=0;$i<$numf;$i++){
			$samf = explode('|',$arrf[$i]);
			//保存费用
			$sql9  = "insert into 专案_年费记录(案卷号,年度,金额,提醒日期,应缴日期) values ('".$arrb[2]."','".$samf[0]."','".$samf[1]."','".$samf[2]."','".$samf[3]."')";
			$result9 = $conn->query($sql9);
			//保存滞纳金
			$arrt = explode(',',$strt[$i]);
//			$arrt[-1] = $samf[1];
			for($y=0;$y<5;$y++){
				$sql_zn  = "insert into 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) values ('".$arrb[2]."','".$samf[0]."','".($y+1)."','".$samf[4]."','".$arrt[$y]."','".$arrt[$y+1]."')";
//				$sql10  = "insert into 滞纳金列表(案卷号,年度,期数,滞纳金,开始时间,截止时间) values ('".$arrb[2]."',''".$samf[0]."'','1','".$samf[4]."')";
				$result_zn = $conn->query($sql_zn);
			}
		}
		
		//专案操作记录
			$sqlHIS = "insert into 专案_操作记录(操作员,操作名,案卷号,记录时间,其他)  values('".$stre."','新建','".$arrb[2]."','".$date."','')";
			$resultHIS = $conn->query($sqlHIS);
		
		echo 1;
//		echo $sqrid_t;
	}
	
	if($flag == 'CAjhO'){
		$ajho = $_GET['AjhO'];
		$ajhT = $_GET['ajhT'];
		//改原案卷号
		$sqlC = "update 专案_年费 set 原案卷号 = '".$ajho."' where id= '".$ajhT."' ";
		$resultC = $conn->query($sqlC);
	}
	

$conn->close();
?>