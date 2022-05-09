<?php
	require("../../AHeader.php");
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>专案详情上传文件</title>
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
<body>
	<div align="center">
		<div id="my_form">
			<input type="text" id="flag" value="<?php echo $_GET['flag']; ?>" hidden="hidden" />
			<input type="text" id="id" value="<?php echo $_GET['id']; ?>" hidden="hidden" />
			<?php
				if($_GET['flag'] == "sb"){
			?>
					<input type="text" id="flag_name" value="<?php echo $_GET['flag_name']; ?>" hidden="hidden" />
			<?php		
				}
			?>
			<table>
				<tr>
					<td><input type="file" id="int_file" /></td>
					<td><button id="uploading">上传</button></td>
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
	</div>
</body>
</html>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<script type="text/javascript">
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
	//创建文件列表
	document.getElementById("int_file").addEventListener("change",function(){
		var int_file = document.getElementById("int_file").files;
		var div_list = document.getElementById("file_list");
		div_list.innerHTML = "";
		div_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
		for(i=0;i<int_file.length;i++){
			var list_html = "";
			list_html = '<tr id = "' + i + '">';
			list_html += '<td><span>'+ int_file[i].name +'</span><em>('+ bytesToSize(int_file[i].size) +')</em></td>';
			list_html += "</tr>";
			div_list.innerHTML += list_html;
		}
	});
	//点击上传，异步上传文件
	document.getElementById("uploading").addEventListener("click",function(){
		var int_file = document.getElementById("int_file").files;
		var flag_v = document.getElementById("flag").value;
		var id_v = document.getElementById("id").value;
		var fd = new FormData();
		fd.append("flag",flag_v);
		fd.append("id",id_v);
		if(int_file.length > 0){
			fd.append("upfile",int_file[0]);
			//专案详情的文件替换更新
			if(flag_v == "za"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			//“无效详情”的文件替换保存
			if(flag_v == "wx"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			//“专案其他详情”的文件替换保存
			if(flag_v == "fs"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			//“软件详情”的文件替换保存
			if(flag_v == "rj"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			
			//“商标详情”的文件替换保存
			if(flag_v == "sb"){
				var flag_name = document.getElementById("flag_name").value;
				fd.append("flag_name",flag_name);
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			//“商标详情”的其他文件替换保存
			if(flag_v == "sb_other"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			
			//“海关详情”的文件替换保存
			if(flag_v == "hg"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			//“年费”的文件替换保存
			if(flag_v == "nf"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			
			//项目申报文件替换保存
			if(flag_v == "pr"){
				$.ajax({
					type:"POST",
					url:"change_file_ajax.php",
					xhr:function(){
						myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){
							myXhr.upload.addEventListener('progress',uploadProgress,false);
						}
						return myXhr;
					},
					data:fd,
					processData:false,
					contentType:false,
					success:function(data){
						setTimeout(function(){
							alert(data+"点击确认关闭本页！\n");
							window.close();
						},1000);
					},
					error:function(){
						console.log(" ajax error!");
					}
				});
			}
			
		}
		
	});
</script>