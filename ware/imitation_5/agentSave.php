<!DOCTYPE HTML>
<head>
<meta charset="utf-8" />	
</head>
<body>
<?php
	$mc = $gh = $sj = $qq = $yx = $wx = $zjhm = $txdz = $rzrq = $lzrq = $bz = $idnum =$bh = $sonid = $zh = $czy = $mm = $zt ="";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$mc = $_REQUEST["mc"];
		$gh = $_REQUEST["gh"];
		$sj = $_REQUEST["sj"];
		$qq = $_REQUEST["qq"];
		$yx = $_REQUEST["yx"];
		$wx = $_REQUEST["wx"];
		$zjhm = $_REQUEST["zjhm"];
		$txdz = $_REQUEST["txdz"];
		$rzrq = $_REQUEST["rzrq"];
		$lzrq = $_REQUEST["lzrq"];
		$bz = $_REQUEST["bz"];
		$bh = $_REQUEST["bh"];
		$sonid = $_REQUEST["sonid"];
		$zh = $_REQUEST["zh"];
		$mm = $_REQUEST["mm"];
		
		if($_POST){
			$czy=$_POST['check'];
			$zt=isset($_POST['zt'])?$_POST['zt']:"";
//			echo "<script type='text/javascript'>alert('".$zt[0]."||".$czy[0]."')</script>";
		}
		
		if($bh!=null&&$mc!=null&&$zh != null && $mm != null){
			if ($sonid == null){
				//echo $dlrbh . "&nbsp;" . $ayrbh . "<br/>" . $sj . "&nbsp;" . $qq . "<br/>" .$yx . "&nbsp;" . $wx . "<br/>" . $zjhm . "<br/>" . $txdz ."<br/>".$rzrq."<br/>".$lzrq."<br/>".$bz ;
				require("../../conn.php");
				// 判断案源人及代理人编号是否重复
				$mysql = "SELECT * from 用户  where 案源人编号 = '".$bh."' or 代理人编号 = '".$bh."' or 账号 = '".$zh."' ";
				$res = $conn->query($mysql);
				$row= $res->fetch_assoc();
				if($row == null){
					//添加sonid
					$sql = "insert into 用户(案源人编号,代理人编号,名称,账号,密码,流程操作员) values('".$bh."','".$bh."','".$mc."','".$zh."','".$mm."','".$czy[0]."')";
					$result = $conn->query($sql);
					$mysql1 = "select * from 用户   where 案源人编号 = '".$bh."' or 代理人编号 = '".$bh."'";
					$res1 = $conn->query($mysql1);
					$row1 = $res1->fetch_assoc();
					$sonid = $row1["id"];
					//新增代理人信息
					if($bh != null){
						$sql1 = "insert into 代理人信息(名称,固话,手机,QQ,邮箱,微信,证件号码,通信地址,备注,入职日期,离职日期,编号,sonid) values(";
						$sql1 .= "'".$mc."','".$gh."','".$sj."','".$qq."','".$yx."','".$wx."','".$zjhm."','".$txdz."','".$bz."','".$rzrq."','".$lzrq."','".$bh."','".$sonid."')";
						$result1 = $conn->query($sql1);
					}
					//新增案源人信息
					if($bh != null){
						$sql2 = "insert into 案源人信息(名称,固话,手机,QQ,邮箱,微信,证件号码,通信地址,备注,入职日期,离职日期,编号,sonid) values(";
						$sql2 .= "'".$mc."','".$gh."','".$sj."','".$qq."','".$yx."','".$wx."','".$zjhm."','".$txdz."','".$bz."','".$rzrq."','".$lzrq."','".$bh."','".$sonid."')";
						$result2 = $conn->query($sql2);
					}
					//表格顺序表更新
					$sql7 = "insert into 表格顺序(用户id) values ('".$sonid."')";
					$result7 = $conn->query($sql7);
					//echo $sql;
					$conn->close();
//					echo "<script type='text/javascript'>alert('添加成功！');location.href='agent.php';</script>";
				}
				else{
					$conn->close();
					echo "<script type='text/javascript'>alert('账号，案源人编号，代理人编号中存在重复！');</script>";
				}
			}
			else {
			//echo  $idnum . "&nbsp;" . $mc . "&nbsp;" . $gh . "<br/>" . $sj . "&nbsp;" . $qq . "<br/>" .$yx . "&nbsp;" . $wx . "<br/>" . $zjhm . "<br/>" . $txdz ."<br/>".$rzrq."<br/>".$lzrq."<br/>".$bz ;
			require("../../conn.php");
			//判断账号，代理人编号，案源人编号是否有重复
			$mysql2 = "select * from 用户  where 账号 = '".$zh."' and id!='".$sonid."'";
			$res2 = $conn->query($mysql2);
			$row2 = $res2->fetch_assoc();
			$mysql3 = "select * from 用户  where 代理人编号 = '".$bh."' and id!='".$sonid."'";
			$res3 = $conn->query($mysql3);
			$row3 = $res3->fetch_assoc();
			$mysql4 = "select * from 用户  where 案源人编号 = '".$bh."' and id!='".$sonid."'";
			$res4 = $conn->query($mysql4);
			$row4 = $res4->fetch_assoc();
				if($row2==null&&$row3==null&&$row4==null){
					
					//代理人信息表更新或者新增
					$mysql = "select * from 代理人信息  where sonid = '".$sonid."'";
					$res = $conn->query($mysql);
					$row = $res->fetch_assoc();
					if($row!= null){
						$sql = "UPDATE 代理人信息 SET ";
						$sql .= " 名称='".$mc."',固话='".$gh."',手机='".$sj."',QQ='".$qq."',邮箱='".$yx."',微信='".$wx."' ";
						$sql .= ",证件号码='".$zjhm."',通信地址='".$txdz."',备注='".$bz."',入职日期='".$rzrq."',离职日期='".$lzrq."',编号='".$bh."' ";
						$sql .= " where sonid ='".$sonid."' ";
						$result = $conn->query($sql);
					}
					else{
						$sql1 = "insert into 代理人信息(名称,固话,手机,QQ,邮箱,微信,证件号码,通信地址,备注,入职日期,离职日期,编号,sonid) values(";
						$sql1 .= "'".$mc."','".$gh."','".$sj."','".$qq."','".$yx."','".$wx."','".$zjhm."','".$txdz."','".$bz."','".$rzrq."','".$lzrq."','".$bh."','".$sonid."')";
						$result1 = $conn->query($sql1);
					}
					//案源人信息表更新或者新增
					$mysql1 = "select * from 案源人信息  where sonid = '".$sonid."'";
					$res1 = $conn->query($mysql1);
					$row1 = $res1->fetch_assoc();
					if($row1 != null){
						$sql2 = "UPDATE 案源人信息 SET ";
						$sql2 .= " 名称='".$mc."',固话='".$gh."',手机='".$sj."',QQ='".$qq."',邮箱='".$yx."',微信='".$wx."' ";
						$sql2 .= ",证件号码='".$zjhm."',通信地址='".$txdz."',备注='".$bz."',入职日期='".$rzrq."',离职日期='".$lzrq."',编号='".$bh."' ";
						$sql2 .= " where sonid ='".$sonid."' ";
						$result2 = $conn->query($sql2);
					}
					else{
						$sql3 = "insert into 案源人信息(名称,固话,手机,QQ,邮箱,微信,证件号码,通信地址,备注,入职日期,离职日期,编号,sonid) values(";
						$sql3 .= "'".$mc."','".$gh."','".$sj."','".$qq."','".$yx."','".$wx."','".$zjhm."','".$txdz."','".$bz."','".$rzrq."','".$lzrq."','".$bh."','".$sonid."')";
						$result2 = $conn->query($sql3);
					}
					//用户表更新
					$sql4 = "UPDATE 用户  SET 案源人编号 ='".$bh."',代理人编号 ='".$bh."',账号 ='".$zh."',名称 = '".$mc."',密码 ='".$mm."',流程操作员 ='".$czy[0]."',状态='".$zt[0]."'  where id = '".$sonid."'";
					//echo $sql;
					$result4 = $conn->query($sql4);
					//更新案源人
					$sql5 = "UPDATE 案源人信息  SET 状态='".$zt[0]."' where sonid = '".$sonid."'";
					$result5 = $conn->query($sql5);
					//更新代理人
					$sql6 = "UPDATE 代理人信息 SET 状态='".$zt[0]."' where sonid = '".$sonid."'";
					$result6 = $conn->query($sql6);
					
					$conn->close();
					exit("<script type='text/javascript'>alert('修改成功！');location.href='agent.php';</script>");
				}
				else{
					$conn->close();
					exit("<script type='text/javascript'>alert('账号，案源人编号，代理人编号中存在重复！');location.href='agent.php';</script>");
					}
			}
		}else{
			exit("<script type='text/javascript'>alert('未输入必要信息！');location.href='agent.php';</script>");
		}
		
		exit("<script type='text/javascript'>alert('操作完成！');location.href='agent.php';</script>");
	}

?>
</body>
</html>
