 //打开选择页面
function addnew(){
	openWin("casemark_new.php","_blank","");
}
//打开选择案源人窗口
function select_ayr(id){
	//	alert(id);
	var ayr = document.getElementById(id);
	var ayrid = document.getElementById('ayrid');
	
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
					$("#"+id).attr("value",localStorage.ayr_name);
					ayrid.value = localStorage.ayr_id;
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
	var dlrid = document.getElementById('dlrid');
	//	dlr = dlr.value.length;
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
					$("#"+id).attr("value",localStorage.dlr_name);
					dlrid.value = localStorage.dlr_id;
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
//窗口刷新（替代open.window）
function openWin(url,text,winInfo){  
    var winObj = window.open(url,text,winInfo);
    var loop = setInterval(function() {
        if(winObj.closed) {
            clearInterval(loop);
            parent.location.reload();
        }
    }, 1);     
} 
//表格增行
function tab_add(tab){
	nrow = tab.rows.length;
	ncol = tab.rows[1].cells.length;
	newr = tab.insertRow(nrow);
//	alert(nrow+'/'+ncol);
	for(var i =0;i<ncol;i++){
		newr.insertCell(i).innerHTML = tab.rows[1].cells[i].innerHTML;
	}
	
}
//表格减行
function tab_del(tab){
	var nrow = tab.rows.length;
	var ncell= tab.rows[1].cells.length;
	for(var i =1;i<nrow;i++){
		var checkm = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
		if(checkm == true){
			tab.deleteRow(i);
			i--;
			nrow--;
		}
	}
}

//添加文件
//function addfile(){
//	var tmp_file = document.getElementById("tmp_file");
//	tmp_file.click();
//}
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
　　for (i = 0; i < 10; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
   }
    return pwd;
}
//生成文件列表
function createfilelist(){
	var file_list = document.getElementById("file_list");
	var tmp_file = document.getElementById("tmp_file");
	file_list.innerHTML = '';
	file_list.innerHTML += '<tr id="jindutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';
	for(var i=0;i<tmp_file.files.length;i++){
		my_files[i] = new Object();
		my_files[i] = tmp_file.files[i];
		tmp_id = random_id();
		my_files[i].id = tmp_id;
		tmp_html = '';
		tmp_html = '<tr id="'+ tmp_id +'">';
		tmp_html += '<td style="width:30%" ><span>'+ tmp_file.files[i].name +'</span>&nbsp;&nbsp;<em>('+bytesToSize(tmp_file.files[i].size)+')</em>&nbsp;<strong></strong></td>';
//		tmp_html += '<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div></td>';
		tmp_html +='<td><input type="text" placeholder="请填写文件描述" /></td>';
		tmp_html += '</tr>';
		file_list.innerHTML += tmp_html;
	}
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

//数据保存
function save_send(){
//	alert('ok');
	var bmes0 = document.getElementById('ayr').value;
	var bmes1 = document.getElementById('dlr').value;
	//判断“案源人”与“代理人”
	if(bmes0.length!=0 && bmes1.length!=0){
		//清除保存按钮事件
		var savebtn = document.getElementById('button_save');
		savebtn.onclick = null;
		
		var caseadd = document.getElementById('case_bz').value;
		var bmes = '';
		var emes = '';
		
		var bmes2 = document.getElementById('gdate').value;
		var bmes3 = document.getElementById('fdate').value;
		bmes = bmes0+'/'+bmes1+'/'+bmes2+'/'+bmes3;
		var emes0 = document.getElementById('cuna').value;
		var emes1 = document.getElementById('cula').value;
		var emes2 = document.getElementById('cunw').value;
		var emes3 = document.getElementById('cufn').value;
		emes = emes0+'/'+emes1+'/'+emes2+'/'+emes3;
	//	alert(caseadd);
		$.ajax({
			url:"casemark_save.php",
			type:"post",
			async:true,
			data:{
				bmes:bmes,
				emes:emes,
				bz:caseadd,
				flag:'casesave'
			},
			dataType:'json',
			success:function(data){
				console.log(data);
				alert("信息"+data["result"]);
				if(data["result"] == "保存成功"){
	//				self.location.href = "casemark.php";
					var djid = data['djid'];
					var tmp_file = document.getElementById("tmp_file").files;
					if(file_numer > 0){
						var fd = new FormData();
						
						//获取描述成object
						var des_arr = new Array();
						var inp = document.getElementById("file_list").getElementsByTagName("input");
						for(var i=0,len=inp.length;i<len;i++){
							if(inp[i].value.length != 0){
								des_arr[i] = inp[i].value;
							}else{
								des_arr[i] = "无";
							}
						}
						fd_file.append("des",des_arr);
						fd_file.append("djid",djid);
						fd_file.append("flag","uploadfile");
						//异步
						$.ajax({
							url:"casemark_save.php",
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
							data:fd_file,
	//						dataType:"json",
							success:function(data){
								setTimeout(function(){
									alert(data);
									if(confirm("是否继续新建？")){
										window.location.reload();
									}else{
										window.location.href="casemark.php";
									}
								},1000)
	//							console.log(data);
	//							document.getElementsByTagName('input').value = '';
							},
							error:function(){
								console.log("ajax error!");
							}
						});
					}
				}
			}
		});
	}else{
		alert("请把信息填完整...");
	}
}


//修改
function alter(id){
//	 alert(id);
	var my_url = "casemark_alter.php?self_id=" + id;
	var winObj = window.open(my_url,"_blank");
    var loop = setInterval(function() {
//  	alert(winObj.closed);
        if(winObj.closed) {
            clearInterval(loop);
            parent.location.reload();
        }
    }, 1); 
}

//结案，把状态改为1
function finish(id){
	$.ajax({
		url:"casemark_save.php",
		type:"post",
		async:true,
		data:{
			flag:'finish',
			self_id:id
		},
		success:function(data){
			alert(data);
			if(data == "结案成功"){
				var jiean="jiean"+id;
				document.getElementById(jiean).value="结案完成";
				document.getElementById(jiean).disabled="disabled";
		
			}
		}
	});
}

//删除：仅把状态改为2
function delAll(){
	if(confirm("是否确认删除选中行?")){
		var id_str = "";
		$("#dynamic-table_2 input[class='boxson']").each(function(){
			if($(this).attr("checked")){
				id_str += ","+$(this).attr("name");
			}
		});
		if(id_str != ""){
			id_str = id_str.substr(1);
			console.log(id_str);
			$.ajax({
				type:"post",
				url:"casemark_save.php",
				data:{
					flag: "del",
					self_id: id_str
				},
				success:function(data){
					var a=id_str;
					document.getElementById(a).value="完成";		
					//window.location.reload();
				},
				error:function(){
					alert('发生错误,请联系管理员');
				}
			});
		}else{
			alert("没有选中行!");
		}
	}
}
//案件查看
function caseche(id){
	//	 alert(id);
	var my_url = "casemark_review.php?self_id=" + id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	 var winObj = window.open(my_url,"_blank");
//  var loop = setInterval(function() {
////  	alert(winObj.closed);
//      if(winObj.closed) {
//          clearInterval(loop);
//          parent.location.reload();
//      }
//  }, 1); 
}
