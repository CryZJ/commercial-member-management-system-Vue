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

  <title>上传文件</title>
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
	<div>
		<div id="my_form">
			<input type="text" id="self_id" value="<?php echo $_GET['id']; ?>" hidden="hidden" />
			<div>
				<table>
				<tr>
					<td><input type="file"  id="tmp_file"  /></td>
					<td><button id="uploading">上传</button></td>
				</tr>
				</table>
			</div>
			<p>文件列表：</p>
			<div>
				<table style="border-spacing: 10px;">
					<tbody id="file_list">
						
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
	my_files = new Object();
	//产生随机码做id
	function random_id() {
		/*
	　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz0123456789';   
	　　var maxPos = chars.length;
	　　var pwd = '';
	　　for (i = 0; i < 10; i++) {
	    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
	   }
	    return pwd;
	    */
		return Math.round(Math.random()*1000);
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
	//创建文件列表
	document.getElementById("tmp_file").addEventListener("change",function(){
		var file_list = document.getElementById("file_list");
		var tmp_file = document.getElementById("tmp_file");
		file_list.innerHTML = '';
		file_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
		for(var i=0;i<tmp_file.files.length;i++){
			my_files[i] = new Object();
			my_files[i] = tmp_file.files[i];
			tmp_id = random_id();
			my_files[i].id = tmp_id;
			tmp_html = '';
			tmp_html = '<tr id="'+ tmp_id +'">';
			tmp_html += '<td style="width:30%" ><span>'+ tmp_file.files[i].name +'</span>&nbsp;&nbsp;<em>('+bytesToSize(tmp_file.files[i].size)+')</em>&nbsp;<strong></strong></td>';
//			tmp_html +='<td><input type="text" placeholder="请填写文件描述" /></td>';
			tmp_html += '</tr>';
			file_list.innerHTML += tmp_html;
		}
	});
	
	//点击上传，异步上传文件
	document.getElementById("uploading").addEventListener("click",function(){
		var self_id_v = document.getElementById("self_id").value;
		var tmp_file = document.getElementById("tmp_file").files;
		if(tmp_file.length != 0){
			var fd = new FormData();
			var inp = document.getElementById(my_files[0].id).getElementsByTagName("input");
			//获取描述成object
//			fd.append("des",inp[0].value);
			fd.append("self_id",self_id_v);
			fd.append("flag","changefile");
			fd.append("upfile",tmp_file[0]);
			//异步
			$.ajax({
				url:"change_file_sr_ajax.php",
				type:"POST",
				xhr:function(){
					myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress',uploadProgress,false);
					}
					return myXhr;
				},
				processData:false,
				contentType:false,
				data:fd,
				success:function(data){
					setTimeout(function(){
						alert(data+"点击确认关闭本页！\n");
						window.close();
					},1000);
				},
				error:function(){
					console.log("ajax error!");
				}
			});
		}
		
	});

</script>