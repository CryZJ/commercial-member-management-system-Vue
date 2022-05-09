<?php require'../../../AHeader.php'; ?>

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

  <title>商标续展</title>

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
  		  			/*上传条的样式*/
	.progress_upload{
		margin-top:1px;
	    width: 200px;
	    height: 20px;
	    margin-bottom: 1px;
	    overflow: hidden;
	    background-color: #f5f5f5;
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	}
	.progress-bar{ 
		background-color: rgb(92, 184, 92);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.14902) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.14902) 50%, rgba(255, 255, 255, 0.14902) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
		box-shadow: rgba(0, 0, 0, 0.14902) 0px -1px 0px 0px inset;
		box-sizing: border-box;
		color: rgb(255, 255, 255);
		display: block;
		float: left; 
		font-size: 12px;
		height: 25px;
		line-height: 20px;
		text-align: center;
		transition-delay: 0s;
		transition-duration: 0.6s;
		transition-property: width;
		transition-timing-function: ease;
		width:266.188px;
	}
  	#tab_bank{
  		position: absolute;
  		z-index: 10;
  		margin-right: auto;
   		margin-left: auto;
   		background: #E0E1E7;
  		border: 1px solid #999; 
  		border-collapse: collapse;
  		/*width: 96%;*/
  		display: none;
  		/*font-size: 20px;*/
  		font-weight: bold;
  	}
  	#tab_bank td {
  		border: 1px solid #000000;
  		text-align: center;
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
	    background: #DDDDDD;
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
  
</head>

<body class="sticky-header">
<section>
	<?php
    		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
    		  			echo '<input id="ajh" type="text" hidden="hidden" value="'.$ajh.'"/>';
	        			//获取案卷基本情况
	        			require('../../../conn.php');
	        			$sql = "select 案件类型,id,委托人类型,案源人,代理人,注册日,注册号,委托书id,专权期始,专权期末,备注,申请人id,状态,类别,商标说明,商品服务  from 商标_案件 a  where a.案卷号='".$ajh."'";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
	        					$CaseST = $row['状态'];
	        					$CaseId = $row['id'];
    							$ctype = $row['委托人类型'];//委托人类型
    							$cayr = $row['案源人'];//案源人
    							$cdlr = $row['代理人'];//代理人
    							$cReF = $row['委托书id'];//委托书
    							$cBz = $row['备注'];//委托书
    							$cMKD = $row['注册日'];//注册日
    							$cMKN = $row['注册号'];//注册号
    							$cOPB = $row['专权期始'];//专权期限始
    							$cOPE = $row['专权期末'];//专权期限末
    							$sqrid = $row['申请人id'];
								$ttype = $row['类别'];
								$tSeN = $row['商品服务'];
								$tBLB = $row['商标说明'];
								$CType = $row['案件类型'];
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			<span class="tools pull-right">
	        <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
	    </span>
			<div id="myform2">
			<strong>商标续展</strong>
			<input type="text" style="background-color:transparent;border: none;" id="ajdlr" value="<?php echo $ajdlr; ?>" readonly="readonly" hidden="hidden" />
	    </header>
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	           	<label>案件处理人：</label><input type="text" style="background-color:transparent;border: none;" id="ajdlr" value="<?php echo $name; ?>"  readonly />
	           	<label>案件类型：</label><strong id="ajlx"></strong><br />
	           	<input class="btn btn-primary" type="button" value="委托书未选择" onclick="openW_have()" id="ReP" />
	           	<label>申请号：</label><strong></strong><input id="sqh" style="background-color:transparent;border: none;" readonly="readonly" />
	           	<label>是否有商标图样：</label><input type="checkbox" id="judge_tyhb_1" />是 &nbsp;&nbsp;&nbsp;<input type="checkbox" id="judge_tyhb_0" />否
	           	<input type="text" id="RePC" hidden="hidden" />
	                <br />
	                <br />
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <thead>
			                <tr>
						        		<th hidden="hidden">委托人类型</th>
						        		<th>案源人</th>
						        		<th>代理人</th>
						        		<th>案卷号</th>
						        		<th>类别</th>
						        		<th>商标名</th>
						        		<th>商标说明</th>
						       		</tr>
		                </thead>
		                <tbody >
		                	<tr>
					        			<td hidden="hidden">
					        				<select id="ctypem" >
							        			<option selected="selected" ></option>
							        			<option>国内个人</option>
							        			<option>国内法人</option>
							        			<option>涉外个人或法人</option>
							        		</select>
							        	</td>
						        		<td><input type="text" id="ayrid" hidden="hidden" /><input type="text" style="width:100px;" id="ayr" value="<?php echo $cayr; ?>" readonly="readonly" onclick="select_ayr(this.id)" /></td>
						        		<td><input type="text" id="dlrid" hidden="hidden" /><input type="text" style="width:100px;" id="dlr" value="<?php echo $cdlr; ?>" readonly="readonly" onclick="select_dlr(this.id)" /></td>
						        		<td><input type="text" id="ajh" name="ajh" value="<?php echo $ajh; ?>" readonly="readonly" /></td>
							       		<td><input style="width: 50px;" type="text" value="<?php echo $ttype; ?>" id="CType" onclick="SetType()" readonly="readonly" />
												<div id="tab_bank">
								 					<table id="edit_tab">
																	<?php
																		$num=0;
																		for($i=0;$i<5;$i++){
																	?>
															<tr>
																	<?php
																			for($y=0;$y<9;$y++){
																				$num++;
																	?>
																<td onclick="choose(this.innerHTML)" ><?php echo $num; ?></td>
																	<?php
																			}
																	?>
															</tr>
																	<?php
																		}
																	?>
									 				</table>
								 				</div>           	
												</td>
												<td id="thna" style="width: 200px;"></td>
												<td><input style="width: 400px;" type="text" id="thbz" /></td>
											</tr>
		                </tbody>
	                </table>
	                <input type="text" id="sqrid" hidden="hidden" />
	                <table class="table table-striped  table-bordered" id="">
				       		<tr>
				        		<th>申请人(中文名)</th>
				        		<td colspan="2"><input style="width: 400px;" type="text" readonly="readonly" id="sqrc"/></td>
										<th>申请人(英文名)</th>
				        		<td colspan="2"><input style="width: 400px;" type="text" id="sqre" readonly="readonly" /></td>
				        	</tr>
				       		<tr>	
				       			<th>证件文件编号</th>
										<td><input style="width: 250px;" type="text" readonly="readonly" id="sfzh" /></td>
				       			<th>邮编</th>
										<td><input style="width: 250px;" type="text" id="stmp" readonly="readonly" /></td>
										<th>国籍</th>
										<td><input style="width: 250px;" type="text" id="coty"  readonly="readonly" /></td>
				       		</tr>
				       		<tr>
				       			<th colspan="1" >地址(中文)</th>
										<td colspan="5" ><input style="width:95%;" type="text" id="addc" readonly="readonly" /></td>
				       		</tr>
				       		<tr>
				       			<th colspan="1" >地址(英文)</th>
										<td colspan="5" ><input style="width:95%;" type="text" id="adde" readonly="readonly" /></td>
				       		</tr>
	                </table>
	                <table class="table table-striped  table-bordered" id="file_list">
	                	<tr>
	                		<!--<th>商标图样(黑白)</th>
											<th><input type="file" name="myfile[]" onchange="selectImage1(this);" id="tyhb" /></th>-->
											<!--<th>商标图样(彩色)</th>
											<th><input type="file" name="myfile[]" onchange="selectImage2(this);"/></th>-->
	                	</tr>
	                	<!--<tr>
	                		<th>身份证原件</th>
											<th style="word-break: break-word;"><span hidden="hidden"></span><em style="font-size: 10px;"></em><input type="file"  name="myfile[]" onchange="selectImage3(this);"/></th>
											<th>身份证翻译件</th>
											<th style="word-break: break-word;"><span hidden="hidden"></span><em style="font-size: 10px;"></em><input type="file"  name="myfile[]" onchange="selectImage4(this);"/></th>
	                	</tr>
	                	<tr>
	                		<th>营业执照原件</th>
											<th style="word-break: break-word;"><span hidden="hidden"></span><em style="font-size: 10px;"></em><input type="file"  name="myfile[]" onchange="selectImage5(this);"/></th>
											<th>营业执照翻译件</th>
											<th style="word-break: break-word;"><span hidden="hidden"></span><em style="font-size: 10px;"></em><input type="file" name="myfile[]" onchange="selectImage6(this);"/></th>
	                	</tr>-->
	                	<tr>
	                		<th>其他文件</th>
											<th colspan="3" ><input id="tmp_file" type="file" name="myfile[]" multiple="multiple" /></th>
	                	</tr>
	                </table>
	                <p>文件列表：</p>
									<div>
										<table class="display table table-bordered table-striped" id="tab_3">
											<tbody id="file_list_2">
												
											</tbody>
										</table>
									</div>
	                 <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	    </div> 
	    <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">  
	    	 <label>图片预览：</label><br />
		    	 <div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="hbty" src="" />
		    	 	<br />
		    	 	<strong>商标图样【黑白】</strong>
		    	 </div>
		    	 <!--<div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="csty" src="" />
		    	 	<br />
		    	 	<strong>商标图样【彩色】</strong>
		    	 </div>
		    	 <div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="idyj" src="" />
		    	 	<br />
		    	 	<strong>身份证【原件】</strong>
		    	 </div>
		    	 <div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="SPic" src="" />
		    	 	<br />
		    	 	<strong>营业执照【原件】</strong>
		    	 </div>
		    	 <div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="yyfyj" src="" />
		    	 	<br />
		    	 	<strong>营业执照【翻译件】</strong>
		    	 </div>
		    	 <div style="float:left;width:33%;" align="center" >
		    	 	<img style="width:100%;height:300px;" id="idfyj" src="" />
		    	 	<br />
		    	 	<strong>身份证【翻译件】</strong>
		    	 </div>-->
	    </div>
	    <div align="center" ><input class="btn btn-primary" type="button" value="提交信息" onclick="savemes_extension(this)" />&nbsp;&nbsp;&nbsp;<input class="btn btn-warning" type="button" value="返回" id="PageBack" /></div><br />
	    
		</section>
		</div>
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
		<!--选择案源人，联系人,生成案卷号,保存信息--> <!--数据保存-->
<script src="../../../js/imitation_1/zl_sb.js"></script>
<!--图片显示-->
<script src="../../../js/blogo_xians.js"></script>
<script type="text/javascript">
	fd_file = new FormData();
	file_num = 1;
	//按键返回
	var PageBack = document.getElementById("PageBack");
	PageBack.addEventListener('click',function(){
//		self.location = 'blogo.php';
			window.close();
	});
	
		//文件大小由字节改为合适的显示
function bytesToSize(bytes) {
	if (bytes === 0) return '0 B';
	var k = 1024, // or 1000
	sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
	i = Math.floor(Math.log(bytes) / Math.log(k));
	return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
}
//产生随机码做id
function random_id() {
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz0123456789';   
　　var maxPos = chars.length;
　　var pwd = '';
　　for (var i = 0; i < 10; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
   }
    return pwd;
}

//取消上传文件
	function del_addfile(id_str){
//		alert(id_str);
		fd_file.delete(id_str);
		$("#"+id_str).remove();
		file_num--;
	}
//创建文件列表
document.getElementById("tmp_file").addEventListener("change",function(){
	var file_list = document.getElementById("file_list_2");
	var tmp_file = document.getElementById("tmp_file");
//	alert(file_list.innerHTML.length)
	if(file_list.innerHTML.length == 25){
		file_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
	}
	for(var i=0;i<tmp_file.files.length;i++){
		tmp_id = random_id();
		fd_file.append(tmp_id,tmp_file.files[i]);
		
//		tmp_html = '';
//		tmp_html = '<tr id="'+ tmp_id +'">';
//		tmp_html += '<td style="width:30%" ><span>'+ tmp_file.files[i].name +'</span>&nbsp;&nbsp;<em>('+bytesToSize(tmp_file.files[i].size)+')</em>&nbsp;<strong></strong></td>';
////		tmp_html += '<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div></td>';
//		tmp_html +='<td><input type="text" placeholder="请填写文件描述" /></td>';
//		tmp_html += '</tr>';
//		file_list.innerHTML += tmp_html;

			var tmp_tr = document.createElement("tr");
			tmp_tr.id = tmp_id;
			var tmp_td_1 = document.createElement("td");
			tmp_td_1.style.width = "30%";
			var tmp_span = document.createElement("span");
			tmp_span.innerHTML = tmp_file.files[i].name;
			var tmp_em = document.createElement("em");
			tmp_em.innerHTML = "("+bytesToSize(tmp_file.files[i].size)+")";
			var tmp_strong = document.createElement("strong");
			tmp_tr.appendChild(tmp_td_1);
			tmp_td_1.appendChild(tmp_span);
			tmp_td_1.appendChild(tmp_em);
			tmp_td_1.appendChild(tmp_strong);
			
			var tmp_td_2 = document.createElement("td");
			var tmp_input = document.createElement("input");
			tmp_input.classList.add("miaoshu");
			tmp_input.type = "text";
			tmp_input.placeholder = "请填写文件描述";
			tmp_input.tabIndex = file_num;
			
			tmp_tr.appendChild(tmp_td_2);
			tmp_td_2.appendChild(tmp_input);
//			tmp_td_2.appendChild(tmp_button);
			tmp_td_2.innerHTML += '<button onclick="del_addfile(\''+tmp_id+'\')">取消</button>';
			
			file_list.appendChild(tmp_tr);
			
			file_num++;
		
	}
	
});
</script>
</body>
</html>