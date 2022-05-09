<!DOCTYPE HTML>
<head>
<meta charset="utf-8" />	
</head>
<body>
<?php
	$mc = $gh = $sj = $qq = $yx = $wx = $zjhm = $txdz = $rzrq = $lzrq = $bz = $idnum ="";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$idnum = $_REQUEST["idnum"];
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
		if ($idnum == 0 ){
			if ($mc != null){
				//echo $mc . "&nbsp;" . $gh . "<br/>" . $sj . "&nbsp;" . $qq . "<br/>" .$yx . "&nbsp;" . $wx . "<br/>" . $zjhm . "<br/>" . $txdz ."<br/>".$rzrq."<br/>".$lzrq."<br/>".$bz ;
				require("../../conn.php");
				$sql = "insert into 案源人信息(名称,固话,手机,QQ,邮箱,微信,证件号码,通信地址,备注,入职日期,离职日期,编号) values(";
				$sql .= "'".$mc."','".$gh."','".$sj."','".$qq."','".$yx."','".$wx."','".$zjhm."','".$txdz."','".$bz."','".$rzrq."','".$lzrq."','".$bh."')";
				//echo $sql;
				$result = $conn->query($sql);
				$conn->close();
				echo "<script type='text/javascript'>alert('添加成功！');location.href='casepeople.php';</script>";
			}
		}else {
			//echo  $idnum . "&nbsp;" . $mc . "&nbsp;" . $gh . "<br/>" . $sj . "&nbsp;" . $qq . "<br/>" .$yx . "&nbsp;" . $wx . "<br/>" . $zjhm . "<br/>" . $txdz ."<br/>".$rzrq."<br/>".$lzrq."<br/>".$bz ;
			require("../../conn.php");
			$sql = "UPDATE 案源人信息 SET ";
			$sql .= " 名称='".$mc."',固话='".$gh."',手机='".$sj."',QQ='".$qq."',邮箱='".$yx."',微信='".$wx."' ";
			$sql .= ",证件号码='".$zjhm."',通信地址='".$txdz."',备注='".$bz."',入职日期='".$rzrq."',离职日期='".$lzrq."',编号='".$bh."' ";
			$sql .= " where id='".$idnum."' ";
			//echo $sql;
			$result = $conn->query($sql);
			$conn->close();
			echo "<script type='text/javascript'>alert('修改成功！');location.href='casepeople.php';</script>";
		}
		
		
	}

?>
</body>
</html>
