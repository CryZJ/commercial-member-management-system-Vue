<?php
	$ajh = $_GET['ajh'];
	//echo $ajh;
	require("../../conn.php");
	
	echo "<section><div><h3 align=\"center\">年费记录</h3>";
	echo "<form action=\"cost_yearUpdate.php\" class=\"form-horizontal\" method=\"post\">";
	echo "<input type=\"text\" hidden name=\"idnum\" id=\"1\" />";
	echo "<input type=\"text\" hidden name=\"ajh\" id=\"ajh\" value='".$ajh."'/>";
	echo "<table align=\"center\" class=\" table-bordered \"  >";
	echo "<thead><tr><th >年度</th><th >应缴日期</th><th >金额</th><th >滞纳金</th><th >恢复费</th><th >代理费</th><th >合计</th></tr></thead><tbody>";
	
	$sql ="select 年度,应缴日期,金额,滞纳金,恢复费,代理费,合计 from 年费记录  where 案卷号='".$ajh."' and 年度='2'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['年度'];$tz[$i]=$row['应缴日期'];$jf[$i]=$row['金额'];
			$je[$i]=$row['滞纳金'];$sf[$i]=$row['恢复费'];$jfr[$i]=$row['代理费'];
			$ju[$i]=$row['合计'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"sqmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sqtz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqsf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"sqje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sqsj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	
	$sql ="select 年度,应缴日期,金额,滞纳金,恢复费,代理费,合计 from 年费记录  where 案卷号='".$ajh."' and 年度='3'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['年度'];$tz[$i]=$row['应缴日期'];$jf[$i]=$row['金额'];
			$je[$i]=$row['滞纳金'];$sf[$i]=$row['恢复费'];$jfr[$i]=$row['代理费'];
			$ju[$i]=$row['合计'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"ssmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"sstz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sssf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"ssje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"ssjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"ssjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"sssj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	
	$sql ="select 年度,应缴日期,金额,滞纳金,恢复费,代理费,合计 from 年费记录  where 案卷号='".$ajh."' and 年度='4'";
	$result = $conn->query($sql);
	$i=0;
	$mc = array();$tz = array();$jf = array();$je = array();
	$sf = array();$jfr = array();$sj = array();
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$mc[$i]=$row['年度'];$tz[$i]=$row['应缴日期'];$jf[$i]=$row['金额'];
			$je[$i]=$row['滞纳金'];$sf[$i]=$row['恢复费'];$jfr[$i]=$row['代理费'];
			$ju[$i]=$row['合计'];
		}
		echo "<tr>";
			echo "<td ><input type=\"text\" readonly name=\"djmc\" value=\"".$mc[0]."\"></td>";
			echo "<td ><input class=\"default-date-picker\"  type=\"text\" name=\"djtz\" value=\"".$tz[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djsf\" value=\"".$jf[0]."\"/></td>";
			echo "<td ><input type=\"text\" name=\"djje\" id=\"sqje\" value=\"".$je[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djjf\" value=\"".$sf[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djjr\" value=\"".$jfr[0]."\" /></td>";
			echo "<td ><input type=\"text\" name=\"djsj\"  value=\"".$ju[0]."\" /></td>";
		echo "</tr>";
	}
	
	echo "</table><br /><div align=\"center\"><input type=\"reset\" value=\"重置\"/>";
	echo "&nbsp;&nbsp;<input type=\"submit\" value=\"修改\"  />";
	echo "</div></form></div></section>";
	
	
?>