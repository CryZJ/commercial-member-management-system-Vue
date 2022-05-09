<?php require'../../AHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>申请人新建</title>
  <!--dynamic table-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />-->
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <!--<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />-->

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

    <!-- main content start--主页左上方的标志-->
		<!--body wrapper start :主要内容-->
		<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
									新建申请人
							<span class="tools pull-right">
			                    <a href="javascript:;" class="fa fa-chevron-down"></a>
			                    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
			                    <a  class="fa fa-reply" onclick="window.close()" ></a>
			                </span>
	        			</header>
	        			<div class="panel-body">
	        			<input hidden="hidden" type="text" id="czy" value="<?php echo $userid; ?>" />
	        				<label>案源人：</label>
    						<input hidden="hidden"  type="text" id="ayrid" value="<?php echo $userid; ?>"  />
    						<input style="width:150px; border: none;" type="text" id="ayr"  onclick="select_ayr(this.id)" readonly="readonly" value="<?php echo $name; ?>" />	
	           				
	           				<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	           					<strong>申请人</strong>
	           					<!-- /btn-group -->
				        				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				        				<strong>申请人类型：</strong>	
					            	<div class="btn-group" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
                            	<span id="ajSt">未选择申请人类型</span>
                            	<span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu checilck" id="Menu" >
                            	<!--大专院校，科研单位，工矿企业，事业单位，个人-->
                                <li><a href="#">大专院校</a></li>
                                <li><a href="#">科研单位</a></li>
                                <li><a href="#">工矿企业</a></li>
                                <li><a href="#">事业单位</a></li>
                                <li><a href="#">个人</a></li>
                            </ul>
                        </div>
                        <br /><br />
                    	<!-- btn-group -->
									<table  class="display table table-bordered table-striped" id="tab_1">
									<thead>
										<tr>
											<th>姓名 <span style="color:red;">*</span></th>
											<th>英文名</th>
											<th>证件号<span style="color:red;">*</span></th>
											<th>国籍 <span style="color:red;">*</span></th>
											<th>邮政编码</th>
											<th>费减年度<span style="color:red;">*</span></th>
											<th>费减比例</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input style="width:300px;" type="text" id="per_name" name="" value=""  /></td>
											<td><input style="width:100px;" type="text" id="" name="" value="" /></td>
											<td><input type="text" id="per_zjh" name="" value="" /></td>
											<td><input type="text" id="" name="" value="" /></td>
											<td><input style="width:100px;" type="text" id="" name="" value="" /></td>
											<td><input type="text" id="" name="" value="" /></td>
											<td><select>
												<option></option>
												<option>70%</option>
												<option>85%</option>
												<option selected="selected">100%</option>
											</select></td>
										</tr>
										<tr>
											<th rowspan="100" >地址&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="button" value="+" onclick="addas()" /></th>
											<td colspan="6" ><input style="width:700px;" type="text" id="" name="" />&nbsp;&nbsp;&nbsp;<span style="color:red;"><strong>默认中文地址</strong></span></td>
										</tr>
										<tr>
											<td colspan="6" ><input style="width:700px;" type="text" id="" name="" />&nbsp;&nbsp;&nbsp;<span style="color:red;"><strong>默认英文地址</strong></span></td>
										</tr>
									</tbody>
								</table>
							<!--</div>-->
								<hr />
								<strong>发明人/设计人</strong>
								<button class="btn btn-primary" type="submit" id="" name="" onclick="addfmr_row()" >+</button>
								<button class="btn btn-primary" type="submit" id="" name="" onclick="delfmr_row()" >-</button>
								<br /><br />
				            <!--<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">-->
								<table class="display table table-bordered table-striped" id="tab_2">
									<thead>
										<tr>
											<th>#</th>
											<th>姓名<span style="color:red;">*</span></th>
											<th>证件号<span style="color:red;">*</span></th>
										</tr>
									</thead>
										<tr hidden="hidden" >
											<td align="center"><input type="checkbox" id="" name="" /></td>
											<td align="center"><input type="text" id="" name="" /></td>
											<td align="center"><input style="width: 300px;" type="text" id="" name="" /></td>
										</tr>
										<tr>
											<td align="center"><input type="checkbox" id="" name="" /></td>
											<td align="center"><input type="text" id="" name="" /></td>
											<td align="center"><input style="width: 300px;" type="text" id="" name="" /></td>
										</tr>
									</tbody>
								</table>
							<!--</div>-->
								<hr />
								<strong>联系人</strong>
								<button class="btn btn-primary" type="submit" id=" " name="" onclick="addlxr_row()">+</button>
								<button class="btn btn-primary" type="submit" id=" " name="" onclick="dellxr_row()">-</button>
								<br /><br />
								<table class="display table table-bordered table-striped" id="tab_3">
										<tr>
											<th align="center">#</th>
											<th>姓名<span style="color:red;">*</span></th>
											<th>手机</th>
											<th>固话</th>
											<th>邮箱</th>
											<th>地址</th>
											<th>传真</th>
										</tr>
										<tr hidden="hidden" >
											<td><input type="checkbox" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 350px;" type="text" id="" name=""   /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
										</tr>
										<tr>
											<td><input type="checkbox" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 350px;" type="text" id="" name=""   /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
										</tr>
								</table>
								<hr />
								<strong>相关文件</strong>
								<br />
								<br />
								<!--<div>
									<table class="display table table-bordered table-striped">
										<tr>
											<th>身份证</th>
											<td><input type="file" id="IDO" /></td>
										</tr>
										<tr>
											<th>身份证翻译件</th>
											<td><input type="file" id="IDT" /></td>
										</tr>
										<tr>
											<th>营业执照</th>
											<td><input type="file" id="TRO" /></td>
										</tr>
										<tr>
											<th>营业执照翻译件</th>
											<td><input type="file" id="TRT" /></td>
										</tr>
									</table>
								</div>-->
									<div>
										<input type="file"  id="tmp_file" multiple="multiple"  />
									</div>
									
									<p>文件列表：</p>
									<div>
										<table class="display table table-bordered table-striped" id="tab_3">
											<tbody id="file_list">
												
											</tbody>
										</table>
									</div>
								<hr />
								<strong>备注</strong>
									<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
										<p><textarea cols="120" rows="6" id="sqr_bz" name="bz" value="未获取"></textarea></p>
									</div>
								<br />
								<div align="center">
									<!--<input type="button" value="返回" onclick="javascript:history.back(-1);"/>&nbsp;&nbsp;&nbsp;-->
									<!--<input id="save_btn" type="button" saved="no"  class="btn btn-success" value="保存" onclick="Save_client()"/>&nbsp;&nbsp;&nbsp;-->
									<!--先检测申请人是否存在再保存-->
									<input id="save_btn" type="button" saved="no"  class="btn btn-success" value="保存" onclick="check_per()"/>&nbsp;&nbsp;&nbsp;
									<input type="button" class="btn btn-danger" value="返回" onclick="window.close()"/>
								</div>
						</div>
	        		</section>
	        	</div>
        	</div>
        </div>
        
				<!--body wrapper end-->
				
    <!-- main content end-->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-3.2.1.js"></script>
<!--<script src="../../js/jquery-1.10.2.min.js"></script>-->
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<!--<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>-->

<!--页数跳转--><!--表格插件-->
<!-- <script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script> -->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<!--<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>-->

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--保存数据的函数-->
<script src="../../js/client.js"></script>
<!--增行减行的函数-->
<script src="../../js/person_add.js"></script>

<script type="text/javascript">
	//上传文件变量
fd_file = new FormData();	
my_files = new Object();
file_num = 1;
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
	//	return Math.round(Math.random()*1000);
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz0123456789';   
　　var maxPos = chars.length;
　　var pwd = '';
　　for (i = 0; i < 10; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
   }
    return pwd;   
}
//创建文件列表
document.getElementById("tmp_file").addEventListener("change",function(){
	var file_list = document.getElementById("file_list");
	var tmp_file = document.getElementById("tmp_file");
//	file_list.innerHTML = '';
//	console.log(file_list.innerHTML.length);
	if(file_list.innerHTML.length == 25){
		file_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
	}
	for(var i=0;i<tmp_file.files.length;i++){
		my_files[i] = new Object();
		my_files[i] = tmp_file.files[i];
		tmp_id = '';
		tmp_id = random_id();
		my_files[i].id = tmp_id;
		fd_file.append(tmp_id,tmp_file.files[i]);//添加文件到fd_file对象中
		
//		tmp_html = '';
//		tmp_html = '<tr id="'+ tmp_id +'">';
//		tmp_html += '<td style="width:30%" ><span>'+ tmp_file.files[i].name +'</span>&nbsp;&nbsp;<em>('+bytesToSize(tmp_file.files[i].size)+')</em>&nbsp;<strong></strong></td>';
////		tmp_html += '<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div></td>';
//		tmp_html +='<td><input type="text" placeholder="请填写文件描述" /><button onclick="del_addfile(\''+tmp_id+'\')">取消</button></td>';
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
function del_addfile(id_str){
//	alert(id_str);
	fd_file.delete(id_str);
	$("#"+id_str).remove();
}
</script>
<script>
	//设置申请人类型
	$(".checilck > li").click(function(){
		var text = $(this).html();//获取排序方式
		var Text = text.substr(12,text.length-16);//处理获取的数据
		document.getElementById("ajSt").innerHTML = Text;
	});
</script>
</body>
</html>
