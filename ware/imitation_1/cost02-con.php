<?php
	$ajh = $_GET['ajh'];
	//echo $ajh;
	require("../../conn.php");
	$sql ="select 费用名称,通知时间,缴费时间,金额,收费时间,缴费人,收据编号 from 缴费记录  where 案卷号='".$ajh."' order by id DESC ";
	echo "<section><div><h3 align=\"center\">缴费记录</h3>";
	echo "<form action=\"costUpdate.php\" class=\"form-horizontal\" method=\"post\">";
	echo "<input type=\"text\" hidden name=\"idnum\" id=\"11\" />";
	echo "<input type=\"text\" hidden name=\"ajh\" id=\"ajh\" value='".$ajh."'/>";
	echo "<table align=\"center\" class=\" table-bordered \"  >";
	echo "<thead><tr><th >名称</th><th >通知时间</th><th >收费日期</th><th >金额</th><th >缴费日期</th><th >缴费人</th><th >收据编号</th></tr></thead><tbody>";
	
	$sql ="select 费用名称,通知时间,缴费时间,金额,收费时间,缴费人,收据编号 from 缴费记录  where 案卷号='".$ajh."' and 费用名称='申请费'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['费用名称'];$tz[$i]=$row['通知时间'];$jf[$i]=$row['缴费时间'];
			$je[$i]=$row['金额'];$sf[$i]=$row['收费时间'];$jfr[$i]=$row['缴费人'];
			$ju[$i]=$row['收据编号'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"sqmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sqtz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sqsf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"sqje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sqjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqsj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	
	$sql ="select 费用名称,通知时间,缴费时间,金额,收费时间,缴费人,收据编号 from 缴费记录  where 案卷号='".$ajh."' and 费用名称='实审费'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['费用名称'];$tz[$i]=$row['通知时间'];$jf[$i]=$row['缴费时间'];
			$je[$i]=$row['金额'];$sf[$i]=$row['收费时间'];$jfr[$i]=$row['缴费人'];
			$ju[$i]=$row['收据编号'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"ssmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sstz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sssf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"ssje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"ssjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"ssjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sssj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	
	$sql ="select 费用名称,通知时间,缴费时间,金额,收费时间,缴费人,收据编号 from 缴费记录  where 案卷号='".$ajh."' and 费用名称='登记费'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['费用名称'];$tz[$i]=$row['通知时间'];$jf[$i]=$row['缴费时间'];
			$je[$i]=$row['金额'];$sf[$i]=$row['收费时间'];$jfr[$i]=$row['缴费人'];
			$ju[$i]=$row['收据编号'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"djmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"djtz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"djsf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"djje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"djjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djsj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	
	$sql ="select 费用名称,通知时间,缴费时间,金额,收费时间,缴费人,收据编号 from 缴费记录  where 案卷号='".$ajh."' and 费用名称='第一年年费'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['费用名称'];$tz[$i]=$row['通知时间'];$jf[$i]=$row['缴费时间'];
			$je[$i]=$row['金额'];$sf[$i]=$row['收费时间'];$jfr[$i]=$row['缴费人'];
			$ju[$i]=$row['收据编号'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"nfmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"nftz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"nfsf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"nfje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"nfjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"nfjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"nfsj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	echo "</table><br /><div align=\"center\"><input type=\"reset\" value=\"重置\"/>";
	echo "&nbsp;&nbsp;<input type=\"submit\" value=\"修改\"  />";
	echo "</div></form></div></section>";
	
	
?>