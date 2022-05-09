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

  <title>缴费通知-子页</title>
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

<body class="sticky-header" style="background: white;"><!--onload="onshow()"-->

<section>
        <!--body wrapper start-->
        <!--<div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">-->
            <div class="panel-body">
            	<p style="color:red;">请点击边框外的地方再滚动鼠标滑轮</p>
            	<input type="text" id="localstorageindex" value="<?php echo $_GET["index"]; ?>" hidden="hidden" />
            	<input type="text" id="application_num" hidden="hidden" value="" />
            	<table class="display table table-bordered table-striped" id="my_table">
                  	<tr>
	                  	<th>操作员</th>
	                  	<td><input style="border:none;width:250px;" type="text" id="cpeo" name="" value="<?php echo $_SESSION['name']; ?>" readonly="readonly" /></td>
                  	</tr>
                  	<tr>
            			<th>致</th>
            			<!--申请人显示-->
            			<td><input style="width: 600px;" type="text" id="sqr_name" name="sqr_name" value="" /></td>
            		</tr>
            		<tr>
            			<th>事由</th>
            			<td><input style="border: none;" type="text" id="" name="" value="专利授权缴费通知" readonly="readonly"/> </td>
            		</tr>
            		<tr>
            			<th>发函日期</th>
            			<?php $ndate = date('Y-m-d');$dateline = date('Y-m-d', strtotime($ndate.' +7 day')); ?>
            			<td><input style="height: 25px;" type="date" id="" name="" value="<?php echo $ndate; ?>" /></td>
            		</tr>
            		<tr>
            			<th>回复期限</th>
            			<td><input style="height: 25px;" type="date" id="" name="" value="<?php echo $dateline; ?>" /></td>
            		</tr>
            	</table>
            	<br />
            	
				<a href="#" class="btn btn-primary" id="select_client">选择客户联系人 </a>
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
            			$sql = "SELECT 开户银行,户名,银行账号 FROM 银行账户 WHERE 开户银行 LIKE '%广发%' LIMIT 1";
						$result = $conn->query($sql);
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
                	<thead>
                		<th>序号</th>
                  		<th>专利号</th>
                  		<th>专利名</th>
                      	<th>申请日</th>
                      	<th>印花费</th>
                      	<th>年费</th>
                      	<th>代理费</th>
                      	<th>小计</th>
                	</thead>
	                <tbody id="costtable">
	                  	
	                </tbody>
	                <tfoot>
	                	<tr>
	                  		<th colspan="7">总金额</th>
	                  		<td><input style="border: 0px;background: none;" type="text" id="fareall" name="" value="" readonly="readonly" /></td>
	                  	</tr>
	                </tfoot>
              	</table>
              <!--<div id='error' ></div>-><!--用于输出测试-->
          	<div>
	          	<center>
	              	<input class="btn-primary" type="button" id="btn2" value="确认通知" onclick="exportWord()" />
	              	<button class="btn btn-info hidden" id="waitingtodel">处理中.......</button>
	              	<a class="btn btn-success hidden" id="downloadfile" onclick="NextClickable()">下载Word通知书文件</a>
	              	<button class="btn btn-danger hidden" id="nextcost" title="下载通知书后才能点击" disabled="disabled" onclick="parent.NextCost()">下一个</button>
	              	<button class="btn btn-danger hidden" id="closewindow" onclick="parent.window.close();">关闭</button>
	          	</center>
          	</div>
         </div>
       	<!--</section>
        </div>
        </div>
        </div>-->
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
<!--<script src="../../js/imitation_3/cost.js"></script>-->

<script type="text/javascript">
	//初始化页面时启动
	if(typeof(Storage) !== "undefined"){
		var index = $("#localstorageindex").val();
		var mes_arr = JSON.parse(localStorage.noticedata);
//		console.log(mes_arr);
		
		//填写申请人
		$("#sqr_name").attr("value",mes_arr[index]["申请人"]);
		
		//选择客户联系人
		$("#select_client").attr("onclick",'op_linkman('+mes_arr[index]["申请人id"]+')');
		$.ajax({
			type:"get",
			url:"authorization_notice_ajax.php",
			data:{
				flag : "GetContacts",
				applicant_id : mes_arr[index]["申请人id"]
			},
			dataType:"json",
			success:function(data){
				if(data.state){
					var tempHtml = '<tr>';
					tempHtml += '<td><input style="width:90%;border: none;" type="text" value="'+data.data["姓名"]+'" readonly="readonly" /></td>';
					tempHtml += '<td><input style="width:90%;border: none;" type="text" value="'+data.data["固话"]+'" readonly="readonly" /></td>';
					tempHtml += '<td><input style="width:90%;border: none;" type="text" value="'+data.data["手机"]+'" readonly="readonly" /></td>';
					tempHtml += '<td><input style="width:90%;border: none;" type="text" value="'+data.data["邮箱"]+'" readonly="readonly" /></td>';
					tempHtml += '</tr>';
					$("#my_table2").append(tempHtml);
				}
			},
			error:function(x,s,t){
//				alert("获取联系人失败-ajax");
				console.log(s+": "+t);
			}
		});
		
		//费用填充
		$.ajax({
			type:"get",
			url:"authorization_notice_ajax.php",
			data:{
				flag : "GetCostData",
				costid : mes_arr[index]["costid"]
			},
			dataType:"json",
			success:function(data){
				if(data.state){
					var application_num_str = "";
					var totalfee = 0;
					for(var index in data.data){
						var mintotalfee = parseFloat(data.data[index]["登记费"])+parseFloat(data.data[index]["年费"])+100;//小计
						var temphtml = '<tr>';
						temphtml += '<td>'+(Number(index)+1)+'</td>';
						temphtml += '<td>'+data.data[index]["申请号"]+'</td>';
						temphtml += '<td>'+data.data[index]["专利名称"]+'</td>';
						temphtml += '<td>'+data.data[index]["申请日"]+'</td>';
						temphtml += '<td>'+data.data[index]["登记费"]+'</td>';
						temphtml += '<td>'+data.data[index]["年费"]+'</td>';
						temphtml += '<td><input title="填完按回车键/Enter键" type="text" id="znj" onchange="ChangTotalFee(this)" value="100" /></td>';
						temphtml += '<td>'+mintotalfee+'</td>';
						temphtml += '</tr>';
						$("#costtable").prepend(temphtml);
						
						totalfee = parseFloat(totalfee) + parseFloat(mintotalfee);//总计
						application_num_str += ","+data.data[index]["申请号"];
					}
					$("#fareall").attr("value",totalfee);//总金额
					$("#application_num").attr("value",application_num_str.substr(1));//后面有用到
				}else{
					alert("获取费用失败"+data.message);
				}
			},
			error:function(x,s,t){
				alert("获取费用-ajax");
				console.log(s+": "+t);
			}
		});
		
	}else{
		alert("对不起，您的浏览器不支持Web存储")
	}
	
	//可以点击下一个
	function NextClickable(){
		$("#nextcost").attr("disabled",false);
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
		var my_url = "../../select_CONer.php?id="+id;
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
	
	//总金额
	function CountTotalFee(){
		var totalfee = 0;
		$("#costtable tr").each(function(i){
			totalfee = Number(totalfee) + Number($(this).children("td:last").html());
		});
		$("#fareall").attr("value",totalfee);
	}
	
	//更改小计个总计
	function ChangTotalFee(inp_obj){
		var djf = $(inp_obj).parent().parent().children("td:eq(4)").html();
		var nf = $(inp_obj).parent().parent().children("td:eq(5)").html();
		var mintotal = Number(djf)+Number(nf)+Number(inp_obj.value);
		$(inp_obj).parent().parent().children("td:last").html(mintotal);
		
		CountTotalFee();
	}
	
	//异步生成word
	function Ajax_CreateWord(url,data1,data2,data3,data4,data5,data6,data7){
		$.ajax({
			type:"post",
			url:url,
			async:true,
			data:{
				data1 : data1,
				data2 : data2,
				data3 : data3,
				data4 : data4,
				data5 : data5,
				data6 : data6,
				data7 : data7
			},
			success:function(data){
				if(data == "success"){
					$("#waitingtodel").addClass("hidden");
					$("#downloadfile").removeClass("hidden");
//					$("#downloadfile").attr("href","Downloadfile.php?filename=../../filesave_notice/"+data7);
					$("#downloadfile").attr("href","downloadonefile.php?filepath=../../filesave_notice/"+data7+"&"+"filename="+mes_arr[index]["申请人"]+'.docx');
					
					if(mes_arr.length == (Number(index)+1)){
						$("#closewindow").removeClass("hidden");
					}else{
						$("#nextcost").removeClass("hidden");
					}
				}else{
					console.log(data);
				}
			},
			error:function(x,s,t){
				console.log("ajax error!"+s+t);
			}
		});
	}
	
	//生成通知书	
	function exportWord(){

		$("#btn2").addClass("hidden");
		$("#waitingtodel").removeClass("hidden");
	
		//头部
		var top_str = new String();
		var my_table = document.getElementById("my_table").getElementsByTagName("input");
		var top_str = my_table[1].value+"||"+my_table[3].value+"||"+my_table[4].value;
	//	alert(top_str);//致||发函日期||回复日期
	//	console.log(top_str);
	//	客户联系人
		var cli_link = new String();
		var my_table2 = document.getElementById("my_table2");//获取表格
		var my_table2Len = document.getElementById("my_table2").rows.length;//计算表格行数
		for(var i=2;i<my_table2Len;i++){
			for(var j=0;j<4;j++){
	//			alert(j+'/'+i);
				cli_link += my_table2.rows[i].cells[j].getElementsByTagName('input')[0].value+'||';
			}
			cli_link = cli_link.substr(0,(cli_link.length-2));
			cli_link += '||';
		}
		cli_link = cli_link.substr(0,(cli_link.length-2));
//		console.log(cli_link);
	//	alert(cli_link); //联系人||固话||手机||邮箱,联系人||固话||手机||邮箱
		//我方联系人
		var my_link = new String();
		var my_table4 = document.getElementById("my_table4").getElementsByTagName("input");
		for(i=0;i<my_table4.length;i++){
			my_link = my_link + my_table4[i].value + "||";
		}	
		my_link = my_link.substr(0,(my_link.length-2));
//		console.log(my_link);
	//	alert(my_link) ;联系人||固话||手机||邮箱
		//银行账户
		var bank = new String();
		var my_table3 = document.getElementById("my_table3").getElementsByTagName("input");
		for(i=0;i<my_table3.length;i++){
			bank = bank + my_table3[i].value + ",";
		}
		bank = bank.substr(0,(bank.length-1));
//		console.log(bank);
	//	alert(bank) ;//开户银行,户名,银行账号
		//列表信息
		var str2 = new String();
		var tab = document.getElementById("tab_info");
		for(i=1;i<tab.rows.length-1;i++){
			for (y=1;y<tab.rows[1].cells.length;y++) {
				if(y==6){
					str2 = str2 + tab.rows[i].cells[6].getElementsByTagName('input')[0].value + ",";
				}else{
					str2 = str2 + tab.rows[i].cells[y].innerHTML + ",";
				}
			}
		}
//		str2 = str2 + tab.rows[tab.rows.length-1].cells[2].innerHTML;
		str2 = str2 + $("#fareall").val();
	//	str2 = str2.substr(0,(str2.length-1));
//		console.log(str2);//专利号,专利名,申请日,登记费,年费,代理费,小计,总计
	//	alert(str2);
	
		//申请号,用来更新状态作判断条件
		var sqh = new String();
		var tab_sqr = document.getElementById("tab_info");
		var row_num = tab_sqr.rows.length;
		for(i=1;i<row_num-1;i++){
			sqh = sqh + tab_sqr.rows[i].cells[1].innerHTML + ",";
		}
		sqh = sqh.substr(0,(sqh.length-1));
	//	alert(sqh);
		
	//	客户联系人，费用的行数
		var my_table2 = document.getElementById("my_table2");
		var row_cli = my_table2.rows.length - 1;
		send_num = row_cli +","+ (row_num-2) ;
	//	alert(send_num);
	
	//	var mess = document.getElementById('mess');
	
	//异步更新数据库专案需交费
		$.ajax({
			type:"GET",
			url:"authorization_notice_ajax.php",
			data:{
				flag : "UpdateCostState",
				costid : mes_arr[index]["costid"],
				application_number:$("#application_num").val()
			},
			dataType:"json",
			success:function(data){
//				console.log(data);
				if(data.state){
					Ajax_CreateWord("../../phpword/impower_fee.php",top_str,cli_link,my_link,bank,str2,send_num,data.data["文件名称"])//异步生成Word文件
				}else{
					alert(data.message);
				}
				
			},
			error:function(){
				alert("ajac error! + 更新数据库专案需交费");
			}
		});
	}
</script>	
</body>
</html>