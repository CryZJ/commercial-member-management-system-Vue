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

  <title>著作案件新建</title>

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
	<div class="wrapper">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			<span class="tools pull-right">
                <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
            </span>
			<!--<form action="newcasefile_save_zzaj.php" method="post" enctype="multipart/form-data">-->
				<!--用于输出测试-->
				<label>著作新建</label>
				<!--<input type="text" id="error" value="" />-->
	  	</header>
	    <div class="panel-body" style="width: 98%;overflow: auto;solid #000000">
				<label>案件处理人：</label><input type="text" style="background-color:transparent;border: none;" id="ajdlr" value="<?php echo $name; ?>"  readonly />
						<br /><br />
				<table class="table table-bordered table-striped table-condensed" id="tab_sqr">
	                <tr>
                		<th>案源人</th>
                		<th>代理人</th>
                		<th>案卷号</th>
						<th>著作名称</th>
	                </tr>
	                <tr>
	                	<td><input type="text" name="" id="ayr" readonly="readonly" onclick="select_ayr()" /></td>
	                	<td><input type="text" name="" id="dlr" readonly="readonly" onclick="select_dlr()" /></td>
	                	<td><input type="text" name="ajh" id="ajh" readonly="readonly"/></td>
	                	<td><input style="width: 300px;" type="text" id="zzmc" /></td>
	                </tr>
	            </table>
	            <button class="btn btn-primary" type="button" id="select_sqr" >选择申请人</button>
	            <br /><br />
	            <table class="table table-bordered table-striped table-condensed" id="tab_sqr1">
	            	<tr>
	            		<th hidden="hidden" >id</th>
	            		<th>申请人</th>
	    				<th>证件号</th>
	            		<th>地址</th>
	            	</tr>
	            	<tr>
	            		<td hidden="hidden" ></td>
	            		<td style="height: 40px;" ></td>
	            		<td></td>
	            		<td></td>
	            	</tr>
	            </table>
	            <label>案件备注：</label>
	            <p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	        	<label>相关文件：</label>
	        		<!--进度条 start-->
					<div align="center" id="file_list">
						<div class="progress_upload">
							<div class="progress-bar" style="width: 0%">
								&nbsp;<strong></strong>
							</div>
						</div>
					</div>
					<!--进度条 end-->
	            <p><input type="file" id="up_file" name="myfile" multiple="multiple"></p>
	            <div>
					<table>
						<thead>
							<th>文件列表</th>
						</thead>
						<tbody  id="file_list_2">
							
						</tbody>
					</table>
				</div>
	            <!--图片显示-->
	            <!--<img style="width:33%;height:300px;" id="zzyl" src="" />-->
	            </div>
	            <!--<div id="rjyl"></div>-->
	            	<div align="center">
	            		<button class="btn btn-primary" type="button" onclick="save_data_ZZ()">提交信息</button>
	            		<button class="btn btn-primary" type="button" onclick="window.close()">返回</button>
	            	</div>
	            <br />
	        </section>
	       <!--</form>-->
	    </div>
	 </div>
	
	<!--<!--body wrapper end-->

	</div>
	<!--<!-- main content end-->
</section>

<!--<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<script src="../../../js/scripts.js"></script>
<!--选择案源人，代理人,生成案卷号-->
<script src="../../../js/slectsqrzz.js"></script>
<!--图片选择显示-->
<script src="../../../js/xians.js"></script>
<!--异步传输数据-->
<script src="../../../js/save_zz.js"></script>
<script type="text/javascript">
	fd_file = new FormData();
	my_files = new Object();
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
	document.getElementById("up_file").addEventListener("change",function(){
		var int_file = document.getElementById("up_file").files;
		var file_list = document.getElementById("file_list_2");
//		alert(file_list.innerHTML.length)
		if(file_list.innerHTML.length == 13){
			file_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';		
		}
//		alert(int_file[0].name)
		for(i=0,len=int_file.length;i<len;i++){
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