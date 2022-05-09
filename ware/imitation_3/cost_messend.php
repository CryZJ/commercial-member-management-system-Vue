<?php
	require'../../AHeader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  			<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>缴费通知</title>
  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
	
  <style type="text/css">
  	#tab_bank{
  		position: absolute;
  		z-index: 10;
  		margin-right: auto;
   		margin-left: auto;
   		background: #E0E1E7;
  		border: 1px solid #999; 
  		border-collapse: collapse;
  		width: 96%;
  		display: none;
  		font-size: 20px;
  		font-weight: bold;
  	}
  	#tab_bank td {
  		border-bottom: 1px solid #000000;
  		text-align: center;
  	}
  	#tab_bank input {
  		zoom: 150%;
  		width: 100%;
  	}
	#Layer1 {
	    height: 500px;
	    width: 500px;
	    border: 2px solid #000000;
	    margin-top: -300px;
	    margin-left: 400px;
	    z-index: 50;
	    display: none;
	    position: absolute;
	    background-color: #FFF;
	}
	#Layer1 #win_top {
	    height: 30px;
	    width: auto;
	    border-bottom-width: 1px;
	    border-bottom-style: solid;
	    border-bottom-color: #999;
	    background: #1FB0AB;
	    line-height: 30px;
	    color: #666;
	    font-family: "微软雅黑", Verdana, sans-serif, "宋体";
	    font-weight: bold;
	    text-indent: 1em;
	}
	#Layer1 #win_top a {
	    float: right;
	    margin-right: 5px;
	}
  </style>	
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body class="sticky-header" ><!--onload="onshow()"-->

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	缴费通知信息确认
            	<input hidden="hidden" type="text" value="<?php $id = $_REQUEST['mas']; echo $id; ?>" id="mess" /><!--案卷号-->
            	<input hidden="hidden" type="text" value="<?php $SQRId = $_REQUEST['SQRId']; echo $SQRId; ?>" id="SQRId" /><!--申请人id-->
            	
            	<span class="tools pull-right">
			    	<!--<a class="btn fa fa-power-off" onclick="window.close();">关闭</a>-->
				</span>
            </header>
            <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
            	<table class="display table table-bordered table-striped" id="my_table">
                  	<tr>
	                  	<th>操作员</th>
	                  	<td><input style="border:none;width:250px;" type="text" id="cpeo" name="" value="<?php echo $_SESSION['name']; ?>" readonly="readonly" /></td>
                  	</tr>
                  	<tr>
            			<th>致</th>
            			<!--申请人显示-->
            			<?php
            				$SQRId = $_REQUEST['SQRId'];
            				require'../../conn.php';
            				//获取申请人
    						$sqlSQR = "select 申请人 from 申请人 where id='".$SQRId."' LIMIT 1";
        					$resultSQR = $conn->query($sqlSQR);
        					if($resultSQR->num_rows>0){
        						while($rowSQR = $resultSQR->fetch_assoc()){
    								$sqrn = $rowSQR['申请人'];
        						}
        					}
            			?>
            			<td><input style="width: 600px;" type="text" id="sqr_name" name="sqr_name" value="<?php echo $sqrn; ?>" /></td>
            		</tr>
            		<tr>
            			<th>事由</th>
            			<td><input style="border: none;" type="text" id="" name="" value="专利授权缴费通知" readonly="readonly"/> </td>
            		</tr>
            		<tr>
            			<th>发函日期</th>
            			<?php $ndate = date('Y-m-d');$dateline = date('Y-m-d', strtotime($ndate.' +7 day')); ?>
            			<td><input type="date" id="" name="" value="<?php echo $ndate; ?>" /></td>
            		</tr>
            		<tr>
            			<th>回复期限</th>
            			<td><input type="date" id="" name="" value="<?php echo $dateline; ?>" /></td>
            		</tr>
            	</table>
            	<br />
            	
				<a href="#" class="btn btn-primary" onclick="op_linkman('<?php echo $SQRId; ?>')">选择客户联系人 </a>
				<br />
				<br />
            	<table class="display table table-bordered table-striped" id="my_table2">
            		<tr>
            			<th colspan="4" >客户联系人</th>
            		</tr>
            		<tr>
            			<th>联系人</th>
            			<th>固话</th>
            			<th>手机</th>
            			<th>邮箱</th>
            		</tr>
            		<?php
            			require('../../conn.php');
            			$sql = "SELECT 姓名,固话,手机,邮箱 FROM 联系人 WHERE FIND_IN_SET(申请人id,'".$SQRId."') LIMIT 1";
						$result = $conn->query($sql);
//						echo $sql."___".$result->num_rows;
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
					?>
					<tr>
						<td><input style="width:90%;border: none;" type="text" value="<?php echo $row["姓名"]; ?>" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="<?php echo $row["固话"]; ?>" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="<?php echo $row["手机"]; ?>" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="<?php echo $row["邮箱"]; ?>" readonly="readonly" /></td>
					</tr>
					<?php			
							}
						}else{
					?>
					<tr>
						<td><input style="width:90%;border: none;" type="text" value="" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="" readonly="readonly" /></td>
						<td><input style="width:90%;border: none;" type="text" value="" readonly="readonly" /></td>
					</tr>
					<?php		
						}
						$conn->close();
            		?>
            	</table>
            		
            	<table class="display table table-bordered table-striped" id="my_table4">
            		<tr>
            			<th colspan="8" >我方联系人</th>
            		</tr>
            		<?php 
            			//获取我方联系人：操作人
            			require('../../conn.php');
						$my_linkman = '';
						$my_sql = "SELECT 固话,手机,邮箱 FROM 代理人信息  WHERE 名称='".$name."'";
						$my_result = $conn->query($my_sql);
						if($my_result->num_rows>0){
							while($my_row = $my_result->fetch_assoc()){
								$my_linkman[0]=$my_row['固话'];
								$my_linkman[1]=$my_row['手机'];
								$my_linkman[2]=$my_row['邮箱'];
							}
						}
						$conn->close();
            		?>
            		<tr>
            			<th>联系人</th>
            			<td><input style="width:150px;border: none;" type="text" id="" name="" value="<?php echo $name; ?>" readonly="readonly" /></td>
            			<th>固话</th>
            			<td><input style="width:150px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[0]; ?>" readonly="readonly" /></td>
            			<th>手机</th>
            			<td><input style="width:150px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[1]; ?>" readonly="readonly" /></td>
            			<th>邮箱</th>
            			<td><input style="width:150px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[2]; ?>" readonly="readonly" /></td>
            		</tr>
            	</table>
            	<button class="btn btn-primary" id="sel_bank" >选择账户</button>
            	<br />
            	<br />
            	<table class="display table table-bordered table-striped" id="my_table3">
            		<?php
            			require('../../conn.php');
            			$sql = "SELECT 开户银行,户名,银行账号 FROM 银行账户 LIMIT 1";
						$result = $conn->query($sql);
//						echo $sql."___".$result->num_rows;
						$bank_arr[0] = "";
						$bank_arr[1] = "";
						$bank_arr[2] = "";
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
								$bank_arr[0] = $row["开户银行"];
								$bank_arr[1] = $row["户名"];
								$bank_arr[2] = $row["银行账号"];
							}
						}
						$conn->close();
            		?>
            		<tr>
            			<th>开户银行</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" value="<?php echo $bank_arr[0]; ?>" /></td>
            		</tr>
            		<tr>
            			<th>户名</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" value="<?php echo $bank_arr[1]; ?>" /></td>
            		</tr>
            		<tr>
            			<th>银行账号</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" value="<?php echo $bank_arr[2]; ?>" /></td>
            		</tr>
            	</table>
            	<br />
                <table class="display table table-bordered table-striped" id="tab_info">
                  <tbody>
                  	<tr>
                  		<th>序号</th>
                  		<th>专利号</th>
                  		<th>专利名</th>
                      	<th>申请日</th>
                      	<th>登记费</th>
                      	<th>年费</th>
                      	<th>代理费</th>
                      	<th>小计</th>
                  	</tr>
                  	
                  	<tr>
                  		<!--<input id="fid" value="<?php echo $id; ?>" hidden="hidden" />-->
                  		<th colspan="2">总金额</th>
                  		<?php $fare_all = 0; ?>
                  		<td colspan="5"></td>
                  		<td><input style="border: 0px;background: none;" type="text" id="fareall" name="" value="<?php echo $fare_all; ?>" readonly="readonly" /></td>
                  	</tr>
                  </tbody>
              	</table>
              <!--<div id='error' ></div>-><!--用于输出测试-->
          	<div>
	          	<center>
	          		<!--<input type="button" value="ok" onclick="test()" />-->
	              	<input class="btn-primary" type="button" id="btn2" value="确认通知" onclick="exportWord()" />
	              	<button class="btn btn-info hidden" id="waitingtodel">处理中.......</button>
	              	<a class="btn btn-success hidden" id="downloadfile">下载Word通知书文件</a>
	              	<button class="btn btn-danger hidden" id="closewindow" onclick="window.close();">关闭</button>
	          	</center>
          	</div>
         </div>
       	</section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<!--<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--费用确认函数-->
<script src="../../js/imitation_3/cost.js"></script>

<script type="text/javascript">
	
	
	window.onload = function(){
		var ajh = document.getElementById("mess").value;
		ShowFare(ajh);
	}
	
	
	//选择银行
	var sel_bank = document.getElementById("sel_bank");
	sel_bank.addEventListener("click",function(){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../select_FAREcon.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.return_data){
						return_data = localStorage.return_data;
						var con_mas = return_data.split("|");
						var tab_con = document.getElementById('my_table3');
						tab_con.getElementsByTagName('input')[0].value = con_mas[0];
						tab_con.getElementsByTagName('input')[1].value = con_mas[1];
						tab_con.getElementsByTagName('input')[2].value = con_mas[2];
						
						localStorage.clear();
					}else{
						alert("未选中账号！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	});
	//选择联系人
	function op_linkman(id){
//		var my_url = "../../select_CONer.php?id="+id;
		//		alert(return_data);
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open(my_url,"_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.return_data){
						return_data = localStorage.return_data;
						
						var con_mas = return_data.split(",");//计算数据个数
						var arrLen = con_mas.length;
						var tab_con = document.getElementById('my_table2');
						var tab2_len = tab_con.rows.length;
						//判断是不是只有一行
						if (tab_con.rows.length >2) {
							for(j=tab2_len-1;j>1;j--){
								tab_con.deleteRow(j);
							}
						} else{
						}
						var tab2_len = tab_con.rows.length;
						//显示数据
						for(i=0;i<arrLen;i++){
							var con_arr = con_mas[i].split("|");
							newrow = tab_con.insertRow(tab2_len);
							
							newrow.insertCell(0).innerHTML = '<input style="width:200px;border: none;" type="text" value="'+con_arr[0]+'" readonly="readonly" />';
							newrow.insertCell(1).innerHTML = '<input style="width:200px;border: none;" type="text" value="'+con_arr[1]+'" readonly="readonly" />';
							newrow.insertCell(2).innerHTML = '<input style="width:200px;border: none;" type="text" value="'+con_arr[2]+'" readonly="readonly" />';
							newrow.insertCell(3).innerHTML = '<input style="width:200px;border: none;" type="text" value="'+con_arr[3]+'" readonly="readonly" />';
						}
						
						localStorage.clear();
					}else{
						alert("未选中联系人");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	//金额计算
	function ShowMinCount(obj){
//		alert(obj.value);
		var td = obj.parentNode;
		var tr = td.parentNode;
		var SignInFare = tr.cells[4].innerHTML;
		var YearCostFare = tr.cells[5].innerHTML;
		tr.cells[7].innerHTML = parseInt(obj.value)+parseInt(SignInFare)+parseInt(YearCostFare);
		thiscount();//改变总金额
	}
	//总计计算
	function thiscount(){
		var tab = document.getElementById("tab_info");
		var NumAll = 0;
		for (var i=1;i<tab.rows.length-1;i++) {
			NumAll += parseInt(tab.rows[i].cells[7].innerHTML);
//			alert(NumAll);
		}
		tab.rows[tab.rows.length-1].cells[2].innerHTML = NumAll;
	}
	//获取费用
	function ShowFare(ajh){
//		var ajh = '05213aD3aI,05071aA3aA';
		$.ajax({
			type:"get",
			url:"Cost_ChanSta.php",
			async:true,
			data:{
				flag:'ShowFare',
				ajh:ajh
			},
			dataType:'json',
			success:function(data){
//				console.log(data);
//				alert(data[0]['年费']);
				DelTab();
				var zlh='';
				var zlm='';
				var sqr='';
				var djf='';
				var nfy='';
				var dlf='';
				var FareA = 0;
				for (NumM in data) {
					zlh=data[NumM]['申请号'];
					zlm=data[NumM]['专利名称'];
					sqr=data[NumM]['申请日'];
					djf=data[NumM]['登记费'];
					nfy=data[NumM]['年费'];
					FareA = parseFloat(data[NumM]['登记费'])+parseFloat(data[NumM]['年费'])+100;
//					alert(zlh+'/'+zlm+'/'+sqr+'/'+djf+'/'+nfy+'/'+dlf);
					ShowMes(zlh,zlm,sqr,djf,nfy,FareA);
				}
				var tab = document.getElementById("tab_info");
				var tabRow = tab.rows.length-1;
				var Num = 0;
				for(var z=1;z<tab.rows.length-1;z++){
					Num = Num+parseFloat(tab.rows[z].cells[7].innerHTML);
//					alert(Num);
				}
				tab.rows[tabRow].cells[2].innerHTML = Num;
			},
			error:function(t,s,e){
				alert(e);
			}
		});
	}
	//生成费用
	function ShowMes(zlh,zlm,sqr,djf,nfy,FareA){
		var tab = document.getElementById("tab_info");
		var NewRow = tab.insertRow(tab.rows.length-1);
		NewRow.insertCell(0).innerHTML = tab.rows.length-2;
		NewRow.insertCell(1).innerHTML = zlh;
		NewRow.insertCell(2).innerHTML = zlm;
		NewRow.insertCell(3).innerHTML = sqr;
		NewRow.insertCell(4).innerHTML = djf;
		NewRow.insertCell(5).innerHTML = nfy;
		NewRow.insertCell(6).innerHTML = "<input style='width:100px;' type='text' value='100' onchange='ShowMinCount(this)' />";
		NewRow.insertCell(7).innerHTML = FareA;
	}
	//减行
	function DelTab(){
		var tab = document.getElementById("tab_info");
		for (i=tab.rows.length;tab.rows.length > 2;i--) {
			tab.deleteRow(1);
		}
	}
</script>	
</body>
</html>