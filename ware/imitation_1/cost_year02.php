<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>修改</title>
	
		
		<!--pickers css-->
		<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
				  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>
		
		
		<link href="../../css/style.css" rel="stylesheet">
		<link href="../../css/style-responsive.css" rel="stylesheet">
  
		<script type="text/javascript">
				
				var xmlHttp;
			function show(){
				var obj = window.dialogArguments;
				//alert("sjdfhkjs!")
				//alert(obj.ajh);
				//document.getElementById('ajh').value = obj.ajh;
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp==null){
			 		alert ("Browser does not support HTTP Request");
			 		return;
			 	}
				var url="cost_year02-con.php";
				url=url+"?ajh="+obj.ajh;
				//url=url+"&sid="+Math.random();
				xmlHttp.onreadystatechange=stateChanged ;
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
			}	
				
		
			function stateChanged(){ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
				 	document.getElementById("show").innerHTML=xmlHttp.responseText;
				 	//alert(xmlHttp.responseText);
				}
			}
		
			function GetXmlHttpObject(){
				var xmlHttp=null;
				try{
					 // Firefox, Opera 8.0+, Safari
					 xmlHttp=new XMLHttpRequest();
				}
				catch (e){
					 //Internet Explorer
					 try{
					  	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					 }
					 catch (e){
					  	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					 }
				 }
				return xmlHttp;
			}
		
		</script>
 
	</head>
	<body onload="show()" style="background: white;">
		<div id="show">
		</div>
		
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
