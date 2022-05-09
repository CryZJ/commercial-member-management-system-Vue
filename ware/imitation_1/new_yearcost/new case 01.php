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

  <title>个案管理-年费专案</title>

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
		height: 30px;
		line-height: 20px;
		text-align: center;
		transition-delay: 0s;
		transition-duration: 0.6s;
		transition-property: width;
		transition-timing-function: ease;
		width:266.188px;
	}
  </style>    
  
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			年费专案新建
	        <span class="tools pull-right">
	            <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
	        </span>
        </header>
       		<br /> &nbsp;&nbsp;&nbsp;
        	<input hidden="hidden" type="text" id="clrnow" value="<?php echo $name; ?>" />
			<button class="btn btn-primary" type="button" onclick="creatyc()" id="" >生成年费</button>
			<!--<button class="btn btn-primary" type="button" onclick="creaty('2','2017-12-31')" id="" >生成年费</button>-->
			<br />
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
		                <thead>
			                <tr>
				        		<th>专利名称</th>
				        		<th>类型</th>
								<th>申请号</th>
								<th>申请日</th>
								<th>申请人</th>
								<th hidden="hidden" >费减年度</th>
				       		</tr>
		                </thead>
		                <tbody >
		                	<tr>
		                		<td><input style="height:30px;width: 400px;" type="text" value="" id="zlname"  /></td>
		                		<td><select style="height:30px;" id="ctype" onchange="changeAJH(this)">
		                			<option selected="selected"></option>
		                			<option >发明专利</option>
		                			<option>实用新型</option>
		                			<option>外观设计</option>
		                		</select></td>
		                		<td><input style="height:30px;" type="text" id="zlh" value="" /></td>
		                		<td><input style="height:30px;" type="date" id="zlr" /></td>
		                		<td><input style="height:30px;width: 300px;" type="text" id="sqr" style="width:100px;" value="" readonly="readonly" onclick="select_sqr()" /></td>
		                		<td hidden="hidden" ><input style="width:80px;border:none;height:30px;background-color:#DDDDDD;" type="text" id="fjn" value="" readonly="readonly" /></td>
		                	</tr>
		                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <thead>
			                <tr>
				        		<th>案源人</th>
				        		<th>代理人</th>
										<th>案卷号</th>
										<th>案卷号【原】</th>
										<th hidden="hidden">代理时间</th>
										<th>首年度</th>
										<th>费减比</th>
				       		</tr>
		                </thead>
		                <tbody>
		                	<tr>
		                		<td><input style="height:30px;" hidden="hidden" type="text" value="" id="ayrid" /><input type="text" id="ayr" value="" readonly="readonly" onclick="select_ayr(this.id)" /></td>
		                		<td><input style="height:30px;" hidden="hidden" type="text" value="" id="dlrid" /><input type="text" id="dlr" value="" readonly="readonly" onclick="select_dlr(this.id)" /></td>
		                		<td><input style="height:30px;background-color:#DDDDDD;" type="text" readonly="readonly" value="" id="ajh" /></td>
		                		<td><input style="height:30px;" type="text" id="ajhO" /></td>
		                		<td hidden="hidden"><input style="height:30px;" type="date" value="" id="dlsj" /></td>
		                		<td><select style="height:30px;" id="snd" >
		                			<option selected="selected" >1</option>
		                			<option>2</option>
		                			<option>3</option>
		                			<option>4</option>
		                			<option>5</option>
		                			<option>6</option>
		                			<option>7</option>
		                			<option>8</option>
		                			<option>9</option>
		                			<option>10</option>
		                		</select></td>
		                		<td><select style="height:30px;" id="prec" >
		                			<option selected="selected" >100%</option>
		                			<option>85%</option>
		                			<option>70%</option>
		                		</select></td>
		                	</tr>
		                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
		                <thead>
			                <tr>
						        		<th>年度</th>
						        		<th>年费</th>
												<th>通知时间</th>
												<th>截止时间</th>
												<th>滞纳金1</th>
												<th>滞纳金2</th>
												<th>滞纳金3</th>
												<th>滞纳金4</th>
												<th>滞纳金5</th>
												<th>操作</th>
						       		</tr>
		                </thead>
		                <tbody >
		                	<tr hidden="hidden" ><!--本用作增行，后改变算法，此部分修改太麻烦，弃用却不能删-->
		                		<td><input type="text" style="width:50px;" readonly="readonly" /></td>
		                		<td><input style="width:200px;" type="text" /></td>
		                		<td><input type="date" /></td>
		                		<td><input type="date" readonly="readonly" /></td>
		                		<td><input type="text" /></td>
		                		<td><input type="text" /></td>
		                		<td><input type="text" /></td>
		                		<td><input type="text" /></td>
		                		<td><input type="text" /></td>
		                		<td><input type="btn btn-danger" type="button" value="删除" onclick="" id="" /></td>
		                	</tr>
		                </tbody>
	                </table>
	                <br />
	                <div>
										<table>
											<tr>
												<td><input type="file" id="int_file" multiple="multiple" /></td>
											</tr>
										</table>
										<div>
											<table>
												<thead>
													<th>文件列表</th>
												</thead>
												<tbody  id="file_list">
													
												</tbody>
											</table>
										</div>
									</div>
									<br />
	                <div align="center" id="" display ><button class="btn btn-primary" type="button" onclick="casesave()" id="SaveMes" >提交信息</button></div>
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
		<!--选择案源人，联系人,生成案卷号,保存信息，生成年费等--> <!--数据保存-->
<script src="../../../js/imitation_1/zl_nf.js"></script>
<script type="text/javascript">
	fd_file = new FormData();
	file_num = 1;
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
	//文件大小由字节改为合适的显示
	function bytesToSize(bytes) {
		if (bytes === 0) return '0 B';
		var k = 1024, // or 1000
		sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
		i = Math.floor(Math.log(bytes) / Math.log(k));
		return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
	}
	//监督进度条
	function uploadProgress(evt){
		if (evt.lengthComputable) {
	    var percentComplete = Math.round(evt.loaded * 100 / evt.total);
			var file_list = document.getElementById("file_list");
			file_list.getElementsByTagName("strong")[0].innerHTML = '<span>'+percentComplete.toString()+'%</span>';
	    var prog = file_list.getElementsByTagName('div')[0];
			var progBar = prog.getElementsByTagName('div')[0];
			progBar.style.width= 2*percentComplete+'px';
			progBar.setAttribute('aria-valuenow', prog.percent);
	  }else {
	    	var file_list = document.getElementById("file_list");
	    	var prog = file_list.getElementsByTagName('div')[0];
	      prog.getElementsByTagName("div")[0].innerHTML = '上传失败！';
	  }
	}
	//取消上传
	function del_addfile(id_str){
//		alert(id_str);
		fd_file.delete(id_str);
		$("#"+id_str).remove();
		file_num--;
	}
	//创建文件列表
	document.getElementById("int_file").addEventListener("change",function(){
		var int_file = document.getElementById("int_file").files;
		var div_list = document.getElementById("file_list");
//		alert(div_list.innerHTML.length)
		if(div_list.innerHTML.length == 27){
			div_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';		
		}
		for(i=0;i<int_file.length;i++){
			tmp_id = random_id();
			fd_file.append(tmp_id,int_file[i]);
			
//			var list_html = "";
//			list_html = '<tr id = "' + i + '">';
//			list_html += '<td><span>'+ int_file[i].name +'</span><em>('+ bytesToSize(int_file[i].size) +')</em></td>';
//			list_html += "</tr>";
//			div_list.innerHTML += list_html;
			  
			  var tmp_tr = document.createElement("tr");
			tmp_tr.id = tmp_id;
			var tmp_td_1 = document.createElement("td");
			tmp_td_1.style.width = "30%";
			var tmp_span = document.createElement("span");
			tmp_span.innerHTML = int_file[i].name;
			var tmp_em = document.createElement("em");
			tmp_em.innerHTML = "("+bytesToSize(int_file[i].size)+")";
			var tmp_strong = document.createElement("strong");
			tmp_tr.appendChild(tmp_td_1);
			tmp_td_1.appendChild(tmp_span);
			tmp_td_1.appendChild(tmp_em);
			tmp_td_1.appendChild(tmp_strong);
			
			var tmp_td_2 = document.createElement("td");
//			var tmp_input = document.createElement("input");
//			tmp_input.classList.add("miaoshu");
//			tmp_input.type = "text";
//			tmp_input.placeholder = "请填写文件描述";
//			tmp_input.tabIndex = file_num;
			
			tmp_tr.appendChild(tmp_td_2);
//			tmp_td_2.appendChild(tmp_input);
			tmp_td_2.innerHTML += '<button onclick="del_addfile(\''+tmp_id+'\')">取消</button>';
			div_list.appendChild(tmp_tr);
			file_num++;
		}
	});
	
	$(document).ready(function(){
		document.getElementById('SaveMes').style.display = "none";
	})
</script>
</body>
</html>