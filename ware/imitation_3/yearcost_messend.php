<?php
	require'../../AHeader.php';
	require_once "../../conn.php"; 
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

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body class="sticky-header" onload="limttotal()">
<!--<body class="sticky-header" >-->

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	缴费通知信息确认
            	<span class="tools pull-right">
				    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
				    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
				    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
				</span>
            	<!--<input type="text" hidden="hidden" value="<?php $id = $_REQUEST['mas']; echo $id; ?>" id="mess" />-->
            	<?php 
            		$id_str = isset($_GET["id"])?$_GET["id"]:"";
					$ajh_str = isset($_GET["ajh"])?$_GET["ajh"]:"";
					$sqr_str = isset($_GET["sqr"])?$_GET["sqr"]:"";
					$sqrid_str = isset($_GET["sqrid"])?$_GET["sqrid"]:"";
					
					$id_arr = explode(",", $id_str);
					$ajh_arr = explode(",", $ajh_str);
            	?>
            </header>
            <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
            	<table class="display table table-bordered table-striped" id="my_table" >
                  	<tr>
	                  	<th>操作员</th>
	                  	<td><input style="border:none;width:200px;" type="text" id="cpeo" name="" value="<?php echo $name; ?>" readonly="readonly" /></td>
                  	</tr>
                  	<tr>
            			<th>致</th>
            			<!--申请人显示-->
            			<td><input style="width: 400px;" type="text" id="" name="" value="<?php echo $sqr_str; ?>" /></td>
            		</tr>
            		<tr>
            			<th>事由</th>
            			<td><input type="text" id="" name="" value="专利年费通知" /></td>
            		</tr>
            		<tr>
            			<th>发函日期</th>
            			<td><input style="height: 25px;" type="date" id="" name="" value="<?php $dateS = date('Y-m-d');echo $dateS; ?>" /></td>
            		</tr>
            		<tr>
            			<th>回复期限</th>
            			<td><input style="height: 25px;" type="date" id="" name="" value="<?php $dateE = date('Y-m-d',strtotime("+ 20 day"));echo $dateE; ?>" /></td>
            		</tr>
            	</table>
            	<br />
				<input type="button" class="btn btn-primary" onclick="op_linkman('<?php echo $sqrid_str; ?>')" value="选择客户联系人" />
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
            	</table>
            	<table class="display table table-bordered table-striped" id="my_table4">
            		<tr>
            			<th colspan="8" >我方联系人</th>
            		</tr>
            		<?php 
            			//获取我方联系人：操作人
            			
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
						
            		?>
            		<tr>
            			<th>联系人</th>
            			<td><input style="width:200px;border: none;" type="text" id="" name="" value="<?php echo $name; ?>" readonly="readonly" /></td>
            			<th>固话</th>
            			<td><input style="width:200px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[0]; ?>" readonly="readonly" /></td>
            			<th>手机</th>
            			<td><input style="width:200px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[1]; ?>" readonly="readonly" /></td>
            			<th>邮箱</th>
            			<td><input style="width:250px;border: none;" type="text" id="" name="" value="<?php echo $my_linkman[2]; ?>" readonly="readonly" /></td>
            		</tr>
            	</table>
            	<button class="btn btn-primary" id="sel_bank" >选择账户</button>
            	<br />
            	<br />
            	<table class="display table table-bordered table-striped" id="my_table3">
            		<tr>
            			<th>开户银行</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" /></td>
            		</tr>
            		<tr>
            			<th>户名</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" /></td>
            		</tr>
            		<tr>
            			<th>银行账号</th>
            			<td><input style="width: 100%;border: none;" type="text" readonly="readonly" /></td>
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
                      	<th>年度</th>
                      	<th>年费</th>
                      	<th>代理费</th>
                      	<th>滞纳金</th>
                      	<th>小计</th>
                  	</tr>
		              	<?php
		              		require_once "../../classes/GetAnnualFeeList.php";//获取年费+案件数据
		            		$sql = "SELECT id,案卷号,年度,金额 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$id_str."') ORDER BY 案卷号";
							$getannualfeedata = new GetAnnualFeeList($conn,$sql);
							$getannualfeedata->UseClass();
							if(!empty($getannualfeedata->sqldata_annualfee)){
								$numcode = 1;
								$tempdata = "";
								foreach($getannualfeedata->sqldata_annualfee as $ky => $row){
						?>
							<tr>
		              			<td><?php echo $numcode; ?></td>
		                  		<td hidden="hidden" ><input id="fid[<?php echo $numcode; ?>]"value="<?php echo $row["id"]; ?>" /><?php echo $row["id"]; ?></td>
		                  		<td><input id="fyn[<?php echo $numcode; ?>]" value="<?php echo $row["申请号"]; ?>" hidden="hidden" /><?php echo $row["申请号"]; ?></td>
		                  		<td><input id="fyn[<?php echo $numcode; ?>]" value="<?php echo $row["专利名称"]; ?>" hidden="hidden" /><?php echo $row["专利名称"]; ?></td>
		                  		<td><input id="sqh[<?php echo $numcode; ?>]" value="<?php echo $row["申请日"]; ?>" hidden="hidden" /><?php echo $row["申请日"]; ?></td>
		                  		<td><input id="sqh[<?php echo $numcode; ?>]" value="<?php echo $row["年度"]; ?>" hidden="hidden" /><?php echo $row["年度"]; ?></td>
		                  		<!--年费-->
		                  		<td><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" id="jef[<?php echo $i; ?>]" name="" value="<?php echo $row["金额"]; ?>" hidden="hidden" /><?php echo $row["金额"]; ?></td>
		                  		<!--代理费-->
		                  		<td><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" oninput="thiscount(this)"  style="width:150px" id="dlf[<?php echo $numcode; ?>]" name="" value="<?php echo 100; ?>" /></td>
		                  		<!--滞纳金-->
		                  		<td><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^0-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" oninput="thiscount(this)"  style="width:150px" id="znj[<?php echo $numcode; ?>]" name="" value="0" /></td>
		                  		<!--小计-->
		                  		<td><input style="border: 0px;background: none;" type="text" id="zje[<?php echo $numcode; ?>]" name="" value="0" readonly="readonly" /></td>
		                  	</tr>		
						<?php	
									$numcode++;		
								}
							}
                  		?>
                  	<tr>
                  		<!--<input id="fid" value="<?php echo $id; ?>" hidden="hidden" />-->
                  		<td colspan="2">总金额</td>
                  		<?php $fare_all = 0; ?>
                  		<td colspan="6"></td>
                  		<td><input style="border: 0px;background: none;" type="text" id="fareall" name="" value="<?php echo $fare_all; ?>" readonly="readonly" /></td>
                  	</tr>
                  </tbody>
              	</table>
              <!--<div id='error' ></div>-><!--用于输出测试-->
              <div>
              	<center>
	              	&nbsp;
	              	<input class="btn btn-primary" type="button" id="btn2" name="" value="导出到word" onclick="exportWord_year()" />
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
<script src="../../js/imitation_3/yearcost.js"></script>

		<script type="text/javascript">
			//将小计相加作为总金额
			function onshowall(){
				$totalfee = 0;
				$("#tab_info tr:gt(0)").each(function(){
					if($(this).children("td:last").children().attr("id") != "fareall"){
						$totalfee  =  $totalfee + parseFloat($(this).children("td:last").children().val());
					}
				});
				$("#fareall").attr("value",$totalfee);
//				console.log($totalfee);
				
			}
			//进来是自动计算小计
			function limttotal(){
				$("#tab_info tr:gt(0)").each(function(){
					var littertotal = 0;//相加金额
					var annualfee = $(this).children("td:eq(6)").children("input").val() ? $(this).children("td:eq(6)").children("input").val() : 0;
					var dlf = $(this).children("td:eq(7)").children("input").val() ? $(this).children("td:eq(7)").children("input").val() : 0;
					var znj = $(this).children("td:eq(8)").children("input").val() ? $(this).children("td:eq(8)").children("input").val() : 0;
					littertotal = littertotal + parseFloat(annualfee);//年费
					littertotal = littertotal + parseFloat(dlf);//代理费
					littertotal = littertotal + parseFloat(znj);//滞纳金
					$(this).children("td:last").children("input").attr("value",littertotal);
				});
				onshowall();
			}
			
			//变动金额是自动同步小计数目
			function thiscount(inp_obj){
				var tr_obj =  $(inp_obj).parent().parent();//tr对象
				var littertotal = 0;//相加金额
				var annualfee = $(tr_obj).children("td:eq(6)").children("input").val() ? $(tr_obj).children("td:eq(6)").children("input").val() : 0;
				var dlf = $(tr_obj).children("td:eq(7)").children("input").val() ? $(tr_obj).children("td:eq(7)").children("input").val() : 0;
				var znj = $(tr_obj).children("td:eq(8)").children("input").val() ? $(tr_obj).children("td:eq(8)").children("input").val() : 0;
				
				littertotal = littertotal + parseFloat(annualfee);//年费
				
				littertotal = littertotal + parseFloat(dlf);//代理费
				
				littertotal = littertotal + parseFloat(znj);//滞纳金
				 
				$(tr_obj).children("td:last").children("input").attr("value",littertotal);
				
				onshowall();

			}
	
			//获取申请人
		//	var sqr = window.dialogArguments;//showModal
		//	var sqr_name = document.getElementById("sqr_name");
		//	sqr_name.value = sqr;
		
			//选择银行
			var sel_bank = document.getElementById("sel_bank");
			sel_bank.addEventListener("click",function(){
		//		alert(return_data);
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
				var my_url = "../../select_CONer.php?id="+id;
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

</script>	
</body>
</html>