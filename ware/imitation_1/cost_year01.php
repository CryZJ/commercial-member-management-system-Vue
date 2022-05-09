<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>保存</title>
	
		
	<!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>
	
	
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
<script type="text/javascript">
		
		
		function show(){
		var obj = window.dialogArguments;
		//alert(obj.ajh)
		document.getElementById('ajh').value = obj.ajh;
		
		rows = obj.row;
		//alert(rows);
		switch(rows){
			case 1 :
				//3 ssmc sstz sssf ssje ssjf ssjr sssj
				document.getElementById('ssmc').disabled=true;
				document.getElementById('sstz').disabled=true;
				document.getElementById('sssf').disabled=true;
				document.getElementById('ssje').disabled=true;
				document.getElementById('ssjf').disabled=true;
				document.getElementById('ssjr').disabled=true;
				document.getElementById('sssj').disabled=true;
				//4 djmc djtz djsf djje djjf djjr djsj
				document.getElementById('djmc').disabled=true;
				document.getElementById('djtz').disabled=true;
				document.getElementById('djsf').disabled=true;
				document.getElementById('djje').disabled=true;
				document.getElementById('djjf').disabled=true;
				document.getElementById('djjr').disabled=true;
				document.getElementById('djsj').disabled=true;
				
				break;
			case 2 :
				//2 sqmc sqtz sqsf  sqje sqjf sqjr sqsj
				document.getElementById('sqmc').disabled=true;
				document.getElementById('sqtz').disabled=true;
				document.getElementById('sqsf').disabled=true;
				document.getElementById('sqje').disabled=true;
				document.getElementById('sqjf').disabled=true;
				document.getElementById('sqjr').disabled=true;
				document.getElementById('sqsj').disabled=true;
				//4 djmc djtz djsf djje djjf djjr djsj
				document.getElementById('djmc').disabled=true;
				document.getElementById('djtz').disabled=true;
				document.getElementById('djsf').disabled=true;
				document.getElementById('djje').disabled=true;
				document.getElementById('djjf').disabled=true;
				document.getElementById('djjr').disabled=true;
				document.getElementById('djsj').disabled=true;
				
				break;
			case 3 :
				//2 sqmc sqtz sqsf  sqje sqjf sqjr sqsj
				document.getElementById('sqmc').disabled=true;
				document.getElementById('sqtz').disabled=true;
				document.getElementById('sqsf').disabled=true;
				document.getElementById('sqje').disabled=true;
				document.getElementById('sqjf').disabled=true;
				document.getElementById('sqjr').disabled=true;
				document.getElementById('sqsj').disabled=true;
				//3 ssmc sstz sssf ssje ssjf ssjr sssj
				document.getElementById('ssmc').disabled=true;
				document.getElementById('sstz').disabled=true;
				document.getElementById('sssf').disabled=true;
				document.getElementById('ssje').disabled=true;
				document.getElementById('ssjf').disabled=true;
				document.getElementById('ssjr').disabled=true;
				document.getElementById('sssj').disabled=true;	
				break;
				
			case 4 :
				//2 sqmc sqtz sqsf  sqje sqjf sqjr sqsj
				document.getElementById('sqmc').disabled=true;
				document.getElementById('sqtz').disabled=true;
				document.getElementById('sqsf').disabled=true;
				document.getElementById('sqje').disabled=true;
				document.getElementById('sqjf').disabled=true;
				document.getElementById('sqjr').disabled=true;
				document.getElementById('sqsj').disabled=true;
				//3 ssmc sstz sssf ssje ssjf ssjr sssj
				document.getElementById('ssmc').disabled=true;
				document.getElementById('sstz').disabled=true;
				document.getElementById('sssf').disabled=true;
				document.getElementById('ssje').disabled=true;
				document.getElementById('ssjf').disabled=true;
				document.getElementById('ssjr').disabled=true;
				document.getElementById('sssj').disabled=true;
				//4 djmc djtz djsf djje djjf djjr djsj
				document.getElementById('djmc').disabled=true;
				document.getElementById('djtz').disabled=true;
				document.getElementById('djsf').disabled=true;
				document.getElementById('djje').disabled=true;
				document.getElementById('djjf').disabled=true;
				document.getElementById('djjr').disabled=true;
				document.getElementById('djsj').disabled=true;		
				break;
			
			default : break;
		}
		
		
	}
 </script>
 
	</head>
	<body onload="show()" style="background: white;">
		<section>
		<div>
             <h3 align="center">年费记录</h3>                           	
			<form action="cost_yearSave.php" class="form-horizontal " method="post">
				<input type="text" hidden name="idnum" id="0" value="0" />
				<input type="text" hidden name="ajh" id="ajh" />
					<table align="center" class=" table-bordered "  >
					<thead>
					<tr>
					<th >年度</th>
					<th >应缴日期</th>
					<th >金额</th>
					<th >滞纳金</th>
					<th >恢复费</th>
					<th >代理费</th>
					<th >合计</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td ><input type="text" name="sqmc" id="sqmc" value="2" readonly></td>
					<td ><input class="default-date-picker" readonly type="text" name="sqtz" id="sqtz" /></td>
					<td ><input type="text" name="sqsf" id="sqsf" /></td>
					<td ><input type="text" name="sqje" id="sqje" value="" /></td>
					<td ><input type="text" name="sqjf" id="sqjf" /></td>
					<td ><input type="text" name="sqjr" id="sqjr" value="" /></td>
					<td ><input type="text" name="sqsj" id="sqsj" value="" readonly disabled="true"/></td>                            
					</tr>
					<tr>
					<td ><input type="text" name="ssmc" id="ssmc" readonly value="3"></td>
					<td ><input class="default-date-picker" readonly type="text" name="sstz" id="sstz" /></td>
					<td ><input type="text" name="sssf" id="sssf" /></td>
					<td ><input type="text" name="ssje" id="ssje" value="" /></td>
					<td ><input type="text" name="ssjf" id="ssjf" /></td>
					<td ><input type="text" name="ssjr" id="ssjr" value="" /></td>
					<td ><input type="text" name="sssj" id="sssj" value="" readonly disabled="true"/></td>
					</tr>
					<tr>
					<td ><input type="text" name="djmc" id="djmc" readonly value="4"></td>
					<td ><input class="default-date-picker" readonly type="text" name="djtz" id="djtz" /></td>
					<td ><input type="text" name="djsf" id="djsf" /></td>
					<td ><input type="text" name="djje" id="djje" value="" /></td>
					<td ><input type="text" name="djjf" id="djjf" /></td>
					<td ><input type="text" name="djjr" id="djjr" value="" /></td>
					<td ><input type="text" name="djsj" id="djsj" value="" readonly disabled="true"/></td>
					</tr>
					</table>
			
					<br />
					<div id="" class="" align="center">
					
						<input type="reset" value="重置"/>
						&nbsp;&nbsp;
						<input type="submit" name="" id="" value="保存" " />
					</div>
			</form>
		</div>
	</section>	
		
		
		
		
<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>	
		
<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>	

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
	</body>
</html>
