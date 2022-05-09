<?php require'../../AHeader.php'; ?>
	
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico" />

  <title>OA办公-案件登记</title>

  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  	
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>
<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper">
	<div class="row">
	    <div  class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	案件登记修改
                    <span class="tools pull-right">
	                    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
	                    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
	                    <a class="btn fa fa-reply" onclick="window.close();">返回</a>
	                </span>
	            </header>
	           <div class="panel-body" style="width:98%; height:auto; solid #000000;">
	           		<?php
	            		$self_id = $_GET['self_id'];
	            	?>
	            	<input type="text" id="my_id" value="<?php echo $self_id; ?>" hidden="hidden" />
					<input class="btn btn-primary" id="button_save" type="button" value="提交信息" onclick="save_send()" />
					<!--&nbsp;-->
<!--					<input type="button" value="返回" onclick="self.location.href='casemark.php'" />-->
	                <br />
	                <br />
	                <input hidden="hidden" type="text" id="czy" value="<?php echo $name; ?>" />
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
	                <thead>
	                	<tr> 
				            <th>案源人 </th>
				            <th>代理人 </th>
				            <th>接单日期 </th>
				            <th>预计完成时间</th>
				        </tr>
	                </thead>
	                <tbody>
	                	<tr>
            				<td><input style="width:150px;" type="text" id="ayr" value="" name="" onclick="select_ayr(this.id)" readonly="readonly" /></td>
            				<td><input style="width:150px;" type="text" id="dlr" value="" name="" onclick="select_dlr(this.id)" readonly="readonly" /></td>
            				<td><input type="date" id="gdate" value="<?php $date = date('Y-m-d');echo $date; ?>" name="" /></td>
            				<td><input type="date" id="fdate" value="" name="" /></td>
						</tr>
	                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                <thead>
	                	<tr>
				            <th>客户姓名</th>
				            <th>接单内容</th>
				            <th>处理情况</th>
				            <th>收费情况</th>
				        </tr>
	                </thead>
	                <tbody >
            			<tr>
            				<td><input style="width:400px;" type="text" id="cuna" value="" name="" /></td>
            				<td><input style="width:300px;" type="text" id="cula" value="" name="" /></td>
            				<td><input type="text" id="cunw" value="" name="" /></td>
            				<td><input type="text" id="cufn" value="" name="" /></td>
						</tr>
	                </tbody>
	                </table>
	                <strong>相关文件</strong>
	                <br />
	                <input class="btn btn-primary" type="button"  value="上传文件" onclick="up_file()"/>
	                <button class="btn btn-primary" onclick="DownAll()">点击全部下载</button>
						<br  />
						<br  />
							<p>文件列表：</p>
							<div>
								<table class="display table table-bordered table-striped" id="tab_3">
									<thead>
										<th>文件名称</th>
										<th>文件描述</th>
										<th>操作</th>
									</thead>
									<tbody id="file_list">
										<?php
										require("../../conn.php");
											$sql_file = "SELECT id,文件路径,描述 FROM 办公_案件基本登记文件 WHERE 基本登记id='".$self_id."' AND 删除状态='0'";
											$result_file = $conn->query($sql_file);
											if($result_file->num_rows>0){
												while($row3 = $result_file->fetch_assoc()){
										?>
													<tr>
														<td width="25%"><?php echo basename($row3['文件路径']); ?></td>
														<td><?php echo $row3['描述']; ?></td>
														<td>
															<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=<?php echo $row3['文件路径']; ?>">
																下载
															</a>
															<button id="<?php echo $row3['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
															<button id="<?php echo $row3['id']; ?>" class="btn btn-danger" onclick="change(this)" >替换</button>
														</td>
													</tr>
										<?php			
												}
											}
											$conn->close();	
										
										?>
									</tbody>
								</table>
							</div>
	               <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	                <br />
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
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<script src="../../js/scripts.js"></script>

<!--页面响应-->
<!--<script src="../../js/imitation_2/casemark.js"></script>-->
<script type="text/javascript">
	//打开选择案源人窗口
function select_ayr(id){
	//	alert(id);
	var ayr = document.getElementById(id);
//	var ayrid = document.getElementById('ayrid');
	//	ayr_len = ayr.value.length;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					
					localStorage.clear();
				}else{
					ayr.value = '';
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开选择代理人窗口
function select_dlr(id){
	//alert(return_data);
	var dlr = document.getElementById(id);
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					dlr.value = localStorage.dlr_name;
					
					localStorage.clear();
				}else{
					dlr.value = '';
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
	var self_id = document.getElementById("my_id").value;
	//获取数据并填写
	$.ajax({
		url:"casemark_save.php",
		type:"post",
		async:true,
		data:{
			self_id:self_id,
			flag:'getdata'
		},
		dataType:"json",
		success:function(data){
//			alert(data.length);
			if(data.length != 0){
				var one_inp = document.getElementById("tabUserInfo").getElementsByTagName("input");
//				alert(one_inp.length);
				one_inp[3].value = data[3];
				for(i=0;i<one_inp.length;i++){
					one_inp[i].value = data[i];
				}
				var tow_inp = document.getElementById("tabUserInfo_2").getElementsByTagName("input");
//				alert(tow_inp.length);
				for(i=0;i<tow_inp.length;i++){
					tow_inp[i].value = data[i+4];
				}
				var case_bz = document.getElementById("case_bz");
				case_bz.value = data[8];
				
			}
		}
	});
//数据保存
function save_send(){
	var caseadd = document.getElementById('case_bz').value;
	var bmes = '';
	var emes = '';
	
	var bmes0 = document.getElementById('ayr').value;
	var bmes1 = document.getElementById('dlr').value;
	var bmes2 = document.getElementById('gdate').value;
	var bmes3 = document.getElementById('fdate').value;
	bmes = bmes0+'/'+bmes1+'/'+bmes2+'/'+bmes3;
	var emes0 = document.getElementById('cuna').value;
	var emes1 = document.getElementById('cula').value;
	var emes2 = document.getElementById('cunw').value;
	var emes3 = document.getElementById('cufn').value;
	emes = emes0+'/'+emes1+'/'+emes2+'/'+emes3;
	console.log(bmes+"\n"+emes);
//	alert(caseadd);
	
	$.ajax({
		url:"casemark_save.php",
		type:"post",
		async:true,
		data:{
			self_id:self_id,
			bmes:bmes,
			emes:emes,
			bz:caseadd,
			flag:'alter'
		},
		success:function(data){
			alert(data);
			if(data == "保存成功"){
//				window.close();
				self.location.href="casemark.php";
			}
		}
	});
	
}

//删除文件
function del_file(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id;
	if(confirm("是否确认删除文件？")){
		$.ajax({
			type:"get",
			url:"del_file.php",
			async:true,
			data:{
				flag:"ajdj",
				id:id
			},
			success:function(data){
				alert(data);
				self.location.reload();
			},
			error:function(){
				console.log("ajax error!");
			}
		});
	}
}

//上传文件
function up_file(){
	var self_id = document.getElementById("my_id").value;
	var myurl = "upfile.php"+"?id="+self_id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(myurl,"_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1)
}
//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "change_file.php"+"?flag=dj&"+"id="+id;
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open(myurl,"_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				parent.location.reload();
			}
		},1)
	}
}

//下载全部文件
function DownAll(){
	$("#tab_3 a[class='btn btn-default']").each(function(){
		this.click();
	});
}
	
</script>

</body>
</html>