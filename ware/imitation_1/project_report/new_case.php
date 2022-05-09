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

  <title>项目申报-新建</title>

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
			<!--<form action="newcasefile_save_rjaj.php" method="post" enctype="multipart/form-data">-->
			<div id="my_form">
			<strong>项目申报-新建</strong>&nbsp;&nbsp;&nbsp;
                <span class="tools pull-right">
	                <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
	            </span>
	  	</header>
	    <div class="panel-body" style="width: 98%;overflow: auto;solid #000000">
	    	<input type="text" id="falg" hidden="hidden" value="<?php $falg = $_GET['falg'];echo $falg;?>" />
			<label>案件处理人：</label><input type="text" style="background-color:transparent;border: none;" id="ajdlr" value="<?php echo $name; ?>"  readonly />
			<span><strong>项目类型:</strong></span>
                <select id="caseType">
                    <option selected="selected"></option>
                    <?php
                        require'../../../conn.php';
                        $sql_St = "select 流程 from `案件流程设置` WHERE 案件类型 = '项目类型'";
                        $result_St = $conn->query($sql_St);
                        if($result_St->num_rows>0){
                            while($row_St=$result_St->fetch_assoc()){
                                ?>
                                    <option><?php echo $row_St['流程']; ?></option>
                                <?php
                            }
                        }
                        $conn->close;
                    ?>
                </select>
                <input type="text" style="background-color:transparent;border: none;" readonly />
                <span>
                    <strong>项目计划时间安排：</strong>
                    <input style="height: 26px;" type="date" class="proTime" onchange="TimeCompare()"/>
                    &nbsp;&nbsp;&nbsp;<strong>至</strong>&nbsp;&nbsp;&nbsp;
                    <input style="height: 26px;" type="date" class="proTime" onchange="TimeCompare()"/>
                    <strong><span id="timeMes" style="color: red;"></span></strong>
                </span>
			<br /><br />
			<table class="table table-bordered table-striped table-condensed" id="tab_info">
                <tr>
            		<th>案源人</th>
            		<th>代理人</th>
					<th>项目名称</th>
					<th>客户名称</th>
                </tr>
                <tr align="center">
                	<td><input type="text" name="" style="width: 100px;" readonly="readonly" onclick="select_ayr()" id="ayr" /></td>
                	<td><input type="text" name="" style="width: 100px;" readonly="readonly" onclick="select_dlr()" id="dlr" /></td>
                	<td style="width: 40%;"><input style="width: 500px;" type="text" id="ProName" /></td>
                	<td style="width: 40%;"><input style="width: 500px;" type="text" id="AgentName"/></td>
                </tr>
            </table>
            <label>案件备注：</label>
            <p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
            <br />
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
            <p><input id="up_file" type="file" name="myfile" multiple="multiple"></p>
            <div>
				<table>
					<thead>
						<th>文件列表</th>
					</thead>
					<tbody  id="file_list_2">
						
					</tbody>
				</table>
			</div>
            </div>
            	<div align="center">
            		<button class="btn btn-primary" type="button" onclick="CaseMesSave()">提交信息</button>
            	</div>
            	<br />
	        </section>
	       <!--</form>-->
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
<!--选择案源人，代理人,异步传输数据-->
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
	var div_list = document.getElementById("file_list_2");
//		alert(div_list.innerHTML.length)
//	if(div_list.innerHTML.length == 13){
//		div_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';		
//	}
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
//选择案源人
function select_ayr(){
	var ayr = document.getElementById('ayr');
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					ayrName = localStorage.ayr_name;
					
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
//选择代理人  
function select_dlr(){
	var dlr = document.getElementById('dlr');
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					dlr.value = localStorage.dlr_name;
					dlrName = localStorage.dlr_name;
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
//文件保存
function CaseMesSave(){
//	alert('ok');
	//获取案件信息
	var pageFalg = document.getElementById("falg").value;
	var ayr = document.getElementById("ayr").value;
	var dlr = document.getElementById("dlr").value;
	var ProName = document.getElementById("ProName").value;
	var AgentName = document.getElementById("AgentName").value;
	var CaseElse = document.getElementById("case_bz").value;
	var CaseType = document.getElementById("caseType").value;
	var proTime = document.getElementsByClassName('proTime');
	if(ayr.length&&dlr.length&&ProName.length&&AgentName.length){
		$.ajax({
			url:'CaseSave.php',
			type:'get',
			async:true,
			data:{
				ayr:ayr,
				dlr:dlr,
				ProName:ProName,
				AgentName:AgentName,
				CaseElse:CaseElse,
				falg:'casesave',
				pageFalg:pageFalg,
				CaseType:CaseType,
				beginTime:proTime[0].value,
				endTime:proTime[1].value
			},
			success:function(data){
				var data_arr = data.split(",");
				alert(data_arr[0]);
				if(data_arr[1] != "0"){//保存文件
					if(file_num > 1){
						fd_file.append("falg","Save_upfile");
						fd_file.append("self_id",data_arr[1]);
						$.ajax({
							type:"POST",
							url:"CaseSave.php",
							xhr:function(){
								myXhr = $.ajaxSettings.xhr();
								if(myXhr.upload){
									myXhr.upload.addEventListener('progress',uploadProgress,false);
								}
								return myXhr;
							},
							data:fd_file,
							processData:false,
							contentType:false,
							success:function(data){
								setTimeout(function(){
									alert(data);
									if (confirm('是否继续新建申报项目')){
										ayr=dlr=ProName=AgentName=CaseElse='';
									}else{
										window.close();
									}
								},1000);
							},
							error:function(){
								console.log(" ajax error!");
							}
						});
					}
				}else{//无文件保存
					if (confirm('是否继续新建申报项目')){
						ayr=dlr=ProName=AgentName=CaseElse='';
					}else{
						window.close();
					}
				}
			},
			error:function(e,t,s){
				alert('发生错误，请联系管理员');
			}
		});
	}else{
		alert('请将信息填写完整');
	}
}

//日期大小比较
function TimeCompare(){
    var Time = document.getElementsByClassName('proTime');
    var d1 = new Date(Time[0].value.replace(/\-/g, "\/")); 
    var d2 = new Date(Time[1].value.replace(/\-/g, "\/")); 

    if(Time[0].value != "" && Time[1].value != "" && d1 >= d2) 
    {
        document.getElementById("timeMes").innerHTML = '请验证时间是否正确';
    }
}
</script>
</body>

</html>