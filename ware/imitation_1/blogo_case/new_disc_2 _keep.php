<?php
	require'../../../AHeader.php';
	$id=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>新建商标评审类委托书</title>

  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->
  
  <style type="text/css">
  	input {
  		text-align: center;
  	}
  	.diffinput {
  		border-top: none;
  		border-left: none;
  		border-right: none;
  		border-bottom: 1px solid black;
  	}
  	.input_long {
  		width: 400px;
  	}
  	.input_short {
  		width: 100px;
  	}
  	.input_min {
  		width: 50px;
  	}
  	/*td{
  		border: 1px solid black;
  	}*/
  </style>
</head>

<body class="sticky-header">

<?php 
	$id=$_GET['id'];
     $conn=mysqli_connect('127.0.0.1','root','123456','zlxt');
     $sql="SELECT 委托人,委托人id,委托人地址,法定人,职务,代理人,受托人地址,联系人,电话,国籍,类号码,第几号,商标名,评审事宜,权限,委托书日期,委托书类型 FROM `商标_委托书` WHERE id='{$id}';";
     $query=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($query);
     $str=$row['评审事宜'];
     $str1=$row['权限'];
     $arr=explode(',',$str);
     $arr2=explode(',',$str1);
//   var_dump($arr2);
//   var_dump(explode(',',$str));
?>
<script type="text/javascript">
			
</script>
	

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
		<strong>商标评审类委托书</strong>
            <span class="tools pull-right">
                <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
            </span>
            <br /><br />
            <div>
	            <input style="width: 100px;" class="btn btn-primary" type="button" value="选择委托人" onclick="select_sqr()" />
		        <!--<input style="width: 100px;" class="btn btn-primary" type="button" value="选择受托人" onclick="select_sqr_2()" />-->
		        <input style="width: 100px;" class="btn btn-primary" type="button" value="选择受托人" onclick="select_ConOP()" />
	        </div>
        </header>
        <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	        
            
            <table id="info_0">
            	<tr>
            		<td><label>委托人：</label><input class="diffinput input_long"  type="text" readonly="readonly"/ value="<?php echo $row['委托人'];?>"></td>
            		<td><label>地址：</label><input class="input_long" type="text" placeholder="选填正确的地址" list="addreslist_wtr" value="<?php echo $row['委托人地址'];?>"/><datalist id="addreslist_wtr"></datalist></td>
            	</tr>
            	
            	<tr>
            		<td><label>法定代表人/负责人姓名：</label><input type="text" placeholder="需手动填写" value="<?php echo $row['法定人'];?>" /></td>
            		<td><label>职务：</label><input type="text" placeholder="需手动填写" value="<?php echo $row['职务'];?>" /></td>
            	</tr>
            	
            	<tr>
            		<td><label>受托人：</label><input class="diffinput input_long" type="text" readonly="readonly" value="<?php echo $row['代理人'];?>"/></td>
            		<td><label>地址：</label><input class="input_long" type="text" placeholder="选填正确的地址" list="addreslist_str" value="<?php echo $row['受托人地址'];?>"/><datalist id="addreslist_str"></datalist></td>
            	</tr>
            	
            	<tr>
            		<td><label>联系人：</label><input class="diffinput" type="text" readonly="readonly" value="<?php echo $row['联系人'];?>" /></td>
            		<td><label>电话：</label><input class="diffinput" type="text" readonly="readonly"  value="<?php echo $row['电话'];?>"/></td>
            	</tr>
            </table>
            
            <table id="info_1">	
            	<tr>
            		<td colspan="2">
            			<blockquote>
            				委托人是<input class="diffinput input_min" type="text" readonly="readonly" value="<?php echo $row['国籍'];?>" />国家/地区的公民/法人，现委托人代理对第<input class="input_min" type="text" placeholder="需手动填写" value="<?php echo $row['类号码'];?>" />类第<input value="<?php echo $row['第几号'];?>" type="text" placeholder="需手动填写"  />号<input value="<?php echo $row['商标名'];?>" type="text" placeholder="需手动填写" />商标进行如下" &radic; "评审事宜：
            			</blockquote>
            			<br />
<!--//          			<?php echo "<h4>评论事宜({$row['评审事宜']})&nbsp&nbsp&nbsp [其中为1对应数据库已录入]</h4>"; ?>-->
            		</td>
            	</tr>
            	<tr>
            		<td colspan="2" id="select_pssy">
            			<input type="checkbox" id="pssy_0" <?php echo $arr[0]=='1'? checked :'' ?> /><label for="pssy_0" >驳回商标注册申请复审案</label> &nbsp;&nbsp;&nbsp;&nbsp; 
            			<input type="checkbox" id="pssy_1" <?php echo $arr[1]=='1'? checked :'' ?> /><label for="pssy_1">商标不予注册复审案</label> &nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="pssy_2" <?php echo $arr[2]=='1'? checked :'' ?>/><label for="pssy_2">撤销注册商标复审案</label> &nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="pssy_3" <?php echo $arr[3]=='1'? checked :'' ?>/><label for="pssy_3">注册商标无效宣告案</label> &nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="pssy_4" <?php echo $arr[4]=='1'? checked :'' ?>/><label for="pssy_4">注册商标无效宣告复审案</label>
            		</td>
            	</tr>
            	<tr>
            		<td colspan="2">
            			<blockquote>
            				受托人代理上述评审事宜的权限为：参与《中华人民共和国商标法》及其《实施条例》和《商标评审规则》规定的本案有关评审活动。委托人特别声明包括下列第<input class="diffinput input_short" type="text" readonly="readonly" />项权限：
            			</blockquote>
            			
            			
            		</td>
            	</tr>
            	<tr>
            		<td colspan="2" id="select_qx">
<!--            			<?php echo "<h4>权限({$row['权限']})&nbsp&nbsp&nbsp [其中为1对应数据库已录入]</h4>"; ?>-->
            			<input type="checkbox" id="qx_0" <?php echo $arr2[0]?'checked':''; ?>/><label for="qx_0">①承认对方评审请求</label>&nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="qx_1" <?php echo $arr2[1]?'checked':''; ?>/><label for="qx_1">②放弃或者变更评审请求</label>&nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="qx_2" <?php echo $arr2[2]?'checked':''; ?>/><label for="qx_2">③撤回商标评审申请</label>
<!--            			
            			<input type="checkbox" id="qx_0" <?php echo $arr2[0]?'checked':''; ?> /><label for="qx_0">①承认对方评审请求</label>&nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="qx_1" <?php echo $arr2[1]?'checked':''; ?>/><label for="qx_1">②放弃或者变更评审请求</label>&nbsp;&nbsp;&nbsp;&nbsp;
            			<input type="checkbox" id="qx_2" <?php echo $arr2[2]?'checked':''; ?>/><label for="qx_2">③撤回商标评审申请</label>-->
            			
            		</td>
            	</tr>
            	<tr>
            		<td colspan="2">
            			<label>日期：</label><input type="date" id="date_info" style="height: 20px;" value="<?php echo $row['委托书日期']; ?>" />
            		</td>
            	</tr>
            </table>
            <br /><br /><br />
            <div align="center" >
            	<input class="btn btn-success" type="button" value="提交信息" id="CSave" onclick="savemes_wts_keep()" />
           		<input class="btn btn-primary" type="button" value="导出&打印" id="MesOut" onclick="mesout()" />
           		<input class="btn btn-warning" type="button" value="返回" id="PageBack" style="opacity: 0 ;height: 0 ;width: 0;" />
           		<a href="blogo.php"><input class="btn btn-warning" type="button" value="返回"  /></a>
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
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<script src="../../../js/scripts.js"></script>
		<!--委托书-->
<!--<script src="../../../js/imitation_1/zl_sb.js"></script>-->

<script type="text/javascript">		
function select_sq(){
		var tmp_str = "";
		$("#select_qx input[type='checkbox']").each(function(i){
			if($(this).attr("checked")){
				tmp_str +=","+ i;
			}
		});
		if(tmp_str != ""){
			tmp_str = tmp_str.substr(1);
			switch(tmp_str){
				case "0":
					$("#info_1 input[type='text']:eq(4)").attr("value","①");
					break;
				case "1":
					$("#info_1 input[type='text']:eq(4)").attr("value","②");
					break;
				case "2":
					$("#info_1 input[type='text']:eq(4)").attr("value","③");
					break;
				case "0,1":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ②");
					break;
				case "0,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ③");
					break;
				case "1,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","②  ③");
					break;
				case "0,1,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ②  ③");
					break;
				default: 
					$("#info_1 input[type='text']:eq(4)").attr("value","");
					break;
			}
		}else{
			$("#info_1 input[type='text']:eq(4)").attr("value","");
		}
	}
	select_sq();
	//选择委托人
	function select_sqr(){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../../select_sqr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.sqr_name){
						$("#info_0 input:eq(0)").attr("value",localStorage.sqr_name);
						$("#info_0 input:eq(0)").attr("id",localStorage.sqr_id);
						
						$.ajax({
							type:"get",
							url:"new_disc_2_ajax.php",
							async:true,
							data:{
								"flag":"Get_sqr_msg",
								"sqr_id":localStorage.sqr_id
							},
							dataType:"json",
							success:function(data){
//								console.log(data);
								if(data["result"]){
									$("#info_1 input:eq(0)").attr("value",data["nationality"]);//填写国籍
									
									for( ky in data["address"]){//提供地址选项
										$("#addreslist_wtr").append('<option value="'+data["address"][ky]+'">');
									}
								}
							},
							error:function(x,s,t){
								alert("选择委托人失败");
								console.log("ajax error!"+s+t)
							}
						});
						
						localStorage.clear();
					}else{
						alert("未选中申请人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	//选择受托人
	function select_sqr_2(){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../../select_sqr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.sqr_name){
						$("#info_0 input:eq(4)").attr("value",localStorage.sqr_name);//受托人 name
						$("#info_0 input:eq(4)").attr("id",localStorage.sqr_id);//受托人 id
						
						$.ajax({
							type:"get",
							url:"new_disc_2_ajax.php",
							async:true,
							data:{
								"flag":"Get_sqr_msg",
								"sqr_id":localStorage.sqr_id
							},
							dataType:"json",
							success:function(data){
//								console.log(data);
								if(data["result"]){
									for( ky in data["address"]){//提供地址选项
										$("#addreslist_str").append('<option value="'+data["address"][ky]+'">');
									}
								}
							},
							error:function(x,s,t){
								alert("选择委托人失败");
								console.log("ajax error!"+s+t)
							}
						});
						
						
						localStorage.clear();
					}else{
						alert("未选中申请人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	//选择代理组织&联系人
	function select_ConOP(){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../../select_ConOP.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.return_data){
						return_data = localStorage.return_data;
//						console.log(return_data);//id、代理组织、联系人、电话、邮编、传真
						data = return_data.split('|');
						$("#info_0 input:eq(4)").attr("value",data[1]);//受托人
						$("#info_0 input:eq(6)").attr("value",data[2]);//联系人
						$("#info_0 input:eq(7)").attr("value",data[3]);//电话
						
						localStorage.clear();
					}else{
						alert("未选中代理组织信息！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	//按键返回
	var PageBack = document.getElementById("PageBack");
	PageBack.addEventListener('click',function(){
//		alert(2222);
		window.close();
	});
	
	
	//选择权限
	$("#select_qx input[type='checkbox']").change(function(){
		var tmp_str = "";
		$("#select_qx input[type='checkbox']").each(function(i){
			if($(this).attr("checked")){
				tmp_str +=","+ i;
			}
		});
		if(tmp_str != ""){
			tmp_str = tmp_str.substr(1);
			switch(tmp_str){
				case "0":
					$("#info_1 input[type='text']:eq(4)").attr("value","①");
					break;
				case "1":
					$("#info_1 input[type='text']:eq(4)").attr("value","②");
					break;
				case "2":
					$("#info_1 input[type='text']:eq(4)").attr("value","③");
					break;
				case "0,1":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ②");
					break;
				case "0,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ③");
					break;
				case "1,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","②  ③");
					break;
				case "0,1,2":
					$("#info_1 input[type='text']:eq(4)").attr("value","①  ②  ③");
					break;
				default: 
					$("#info_1 input[type='text']:eq(4)").attr("value","");
					break;
			}
		}else{
			$("#info_1 input[type='text']:eq(4)").attr("value","");
		}
	});
	
	//-------------------------信息打印&导出-------------------------------
	//window.open的post传输数据函数
	function openPostWindow(url, name, data, data2){
	     var tempForm = document.createElement("form");
	     tempForm.id = "tempForm1";
	     tempForm.method = "post";
	     tempForm.action = url;
	     tempForm.target=name;
	     var hideInput1 = document.createElement("input");
	     hideInput1.type = "hidden";
	     hideInput1.name="data";
	     hideInput1.value = data;
	     var hideInput2 = document.createElement("input");
	     hideInput2.type = "hidden";
	     hideInput2.name="data2";
	     hideInput2.value = data2;
	     tempForm.appendChild(hideInput1);
	     tempForm.appendChild(hideInput2);
	     if(document.all){
	         tempForm.attachEvent("onsubmit",function(){});        //IE
	     }else{
	         var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
	     }
	     document.body.appendChild(tempForm);
	     if(document.all){
	         tempForm.fireEvent("onsubmit");
	     }else{
	         tempForm.dispatchEvent(new Event("submit"));
	     }
	     tempForm.submit();
	     document.body.removeChild(tempForm);
	 }
	function mesout(){
		if(confirm("是否保存了数据？如果未保存数据，请点击“取消”。")){
			var data_str = "";
			$("#info_0 input[type='text']").each(function(){
				data_str += "#$#"+$(this).attr("value");
			});
			$("#info_1 input[type='text']").each(function(){
				data_str += "#$#"+$(this).attr("value");
			});
			if(data_str != ""){
				data_str = data_str.substr(3);
				data_str += "#$#"+$("#date_info").attr("value");
			}
			var checkbox_str = "";
			$("#select_pssy input[type='checkbox']").each(function(){
				if($(this).attr("checked")){
					checkbox_str += ","+'1'; 
				}else{
					checkbox_str += ","+'0';
				}
			});
			$("#select_qx input[type='checkbox']").each(function(){
				if($(this).attr("checked")){
					checkbox_str += ","+'1'; 
				}else{
					checkbox_str += ","+'0';
				}
			});
			if(checkbox_str != ""){
				checkbox_str = checkbox_str.substr(1);
			}
			openPostWindow("../../../TCPDF/my_examples/sbps.php","_blank",data_str,checkbox_str);
		}
	}
	
	//------------------------------------------保存信息--------------------------------------------------
	function savemes_wts_keep(){
		var data_str = "";
		$("#info_0 input[type='text']").each(function(){
			data_str += "#$#"+$(this).attr("value");
		});
		$("#info_1 input[type='text']").each(function(){
			data_str += "#$#"+$(this).attr("value");
		});
		if(data_str != ""){
			data_str = data_str.substr(3);
			data_str += "#$#"+$("#info_0 input[type='text']:eq(0)").attr("id")+"#$#"+$("#date_info").attr("value");//委托人id,日期
		}
		console.log(data_str);
		var checkbox_str = "";
		$("#select_pssy input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				checkbox_str += ","+'1'; 
			}else{
				checkbox_str += ","+'0';
			}
		});
		$("#select_qx input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				checkbox_str += ","+'1'; 
			}else{
				checkbox_str += ","+'0';
			}
		});
		if(checkbox_str != ""){
			checkbox_str = checkbox_str.substr(1);
		}
		$.ajax({
			type:"get",
			url:"new_disc_2_ajax.php",
			async:true,
			data:{
				"flag":"Save_data_keep",
				"data_str":data_str,
				"checkbox_str":checkbox_str,
				'id':<?php echo $id; ?>
			},
			dataType:"json",
			success:function(data){
//			alert('2222');
//				console.log(JSON.decode(data));
			
				if(data["result"]){
					if(confirm("保存成功，是否关闭本页？点击确认关闭本页")){
						window.close();
					}
				}else{
					alert("保存失败");
					console.log(data);
				}
			},
			error:function(x,s,t){
//				alert("选择委托人失败");
//				console.log("ajax error!"+s+t)
				alert("保存成功");
			}
		});
	}
</script>

</body>
</html>