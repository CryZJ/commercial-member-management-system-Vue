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

  <title>专案其他详情文件上传</title>
  
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
			<input type="text" id="ajh" value="<?php echo $_GET['ajh']; ?>" hidden="hidden" />
			<table>
				<tr>
					<td><input type="file" id="int_file" multiple="multiple" /></td>
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
		if(div_list.innerHTML.length == 13){
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
	//点击上传，异步上传文件
	document.getElementById("uploading").addEventListener("click",function(){
		var int_file = document.getElementById("int_file").files;
		var ajh_v = document.getElementById("ajh").value;
		fd_file.append("flag","uploadfile_fs");
		fd_file.append("ajh",ajh_v);
		if(int_file.length > 0){
			$.ajax({
				type:"POST",
				url:"upfile_ajax.php",
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
						alert(data+"点击确认关闭本页！\n");
//						console.log(data);
						window.close();
					},1000);
				},
				error:function(){
					console.log(" ajax error!");
				}
			});
		}
		
	});
</script>