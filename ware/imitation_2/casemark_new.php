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
  
  <style type="text/css">
  	/*上传条的样式*/
	.progress_upload{
		margin-top:1px;
	    width: 200px;
	    height: 30px;
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
		height: 35px;
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
						案件登记新建
					<!--<input type="button" value="返回" onclick="self.location.href='casemark.php'" />-->
	            </header>
	           <div class="panel-body" style="width:98%; height:auto; solid #000000;">
	           		<input class="btn btn-primary" id="button_save" type="button" value="提交信息" onclick="save_send()" />
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
            				<td><input hidden="hidden" type="text" id="ayrid"  /><input style="width:150px;" type="text" id="ayr" value="" name="" onclick="select_ayr(this.id)" readonly="readonly" /></td>
            				<td><input hidden="hidden" type="text" id="dlrid"  /><input style="width:150px;" type="text" id="dlr" value="" name="" onclick="select_dlr(this.id)" readonly="readonly" /></td>
            				<td><input type="date" id="gdate" value="<?php $date = date('Y-m-d');echo $date; ?>" name="" /></td>
            				<td><input type="date" id="fdate" value="" name="" /></td>
						</tr>
	                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                <thead>
	                	<tr>
				            <th>客户名</th>
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
					<div>
						<input type="file"  id="tmp_file" multiple="multiple"   />
					</div>
					<p>文件列表：</p>
					<div>
						<table class="display table table-bordered table-striped" id="tab_3">
							<tbody id="file_list">
								
							</tbody>
						</table>
					</div>
	               <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	                
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
<script src="../../js/imitation_2/casemark.js"></script>
<script type="text/javascript">
fd_file = new FormData();	
my_files = new Object();
file_numer = 1;
//取消上传
function del_addfile(id_str){
//	alert(id_str);
	fd_file.delete(id_str);
	$("#"+id_str).remove();
	file_numer--;
}
//创建文件列表
document.getElementById("tmp_file").addEventListener("change",function(){
	var file_list = document.getElementById("file_list");
	var tmp_file = document.getElementById("tmp_file");
//	alert(file_list.innerHTML.length)
	if(file_list.innerHTML.length == 17){
		file_list.innerHTML += '<tr id="jindutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
	}
	for(var i=0;i<tmp_file.files.length;i++){
		my_files[i] = new Object();
		my_files[i] = tmp_file.files[i];
		tmp_id = random_id();
		my_files[i].id = tmp_id;
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
			tmp_input.tabIndex = file_numer;
			
			tmp_tr.appendChild(tmp_td_2);
			tmp_td_2.appendChild(tmp_input);
//			tmp_td_2.appendChild(tmp_button);
			tmp_td_2.innerHTML += '<button onclick="del_addfile(\''+tmp_id+'\')">取消</button>';
			
			file_list.appendChild(tmp_tr);
			
			file_numer++;
		
	}
});
</script>

</body>
</html>