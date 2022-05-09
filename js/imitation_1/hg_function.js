//上传文件
function upfile(ajh){
	var myurl = "../upfile_hg.php"+"?ajh="+ajh;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(myurl,"_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1);	
}

//删除文件
function file_del(btn_doc){
	if(confirm("是否确定删除此文件?")){
		var id = btn_doc.id;
		$.ajax({
			type:"get",
			url:"../del_file.php",
			async:true,
			data:{
				flag:"海关",
				id:id
			},
			success:function(data){
				alert(data);
				//删除表格中对应的哪行
				tr_doc = btn_doc.parentNode.parentNode;
				var tab_jkwj = document.getElementById("jkwj");
				tab_jkwj.deleteRow(tr_doc.rowIndex);
			},
			error:function(xhr,staues,xmlthrow){
				console.log("ajax error!"+staues +xmlthrow);
			}
		});
	}
}

//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=hg&"+"id="+id;
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open(myurl,"_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				parent.location.reload();
			}
		},1)
	}
}

//新增监控时的撤除
function del_row(btn_doc){
	if(confirm("是否确认撤除?")){
		var tr_doc = btn_doc.parentNode.parentNode;
		var tab = document.getElementById("tab_che");
		tab.deleteRow(tr_doc.rowIndex);
	}
}

//监控新建保存 --案件详情
function save_kjxx(btn_doc){
	var ajh = document.getElementById("ajh").value;//案卷号
	var tr_doc = btn_doc.parentNode.parentNode;
	var txday = tr_doc.cells[3].getElementsByTagName("input")[0].value;//提醒日期
	var jzday = tr_doc.cells[4].getElementsByTagName("input")[0].value;//截止日期
	if(txday!="" && jzday!=""){
		//获取信息
		var send_str = "";
		for(i=0;i<tr_doc.cells.length-1;i++){
			if(i!=2 && i!=0){
//				console.log(tr_doc.cells[i].getElementsByTagName("input")[0].value);
				send_str += tr_doc.cells[i].getElementsByTagName("input")[0].value + "|";
			}else if(i==0){
				send_str += tr_doc.cells[i].getElementsByTagName("select")[0].value + "|";
			}
		}
		send_str = send_str.substr(0,send_str.length-1);
//		console.log(send_str);//格式:监控名|金额|提醒日期|截止日期|备注
		//异步保存
		$.ajax({
			type:"get",
			url:"save_hgkj_new.php",
			async:true,
			data:{
				flag:"new_monitor_hg",
				ajh:ajh,
				send_str:send_str
			},
			success:function(data){
				alert("信息"+data);
				
//				console.log(data);
				if(data == "保存成功"){
					//异步保存文件
					var int_file = tr_doc.cells[2].getElementsByTagName("input")[0].files;
					if(int_file.length != 0){
						var fd = new FormData();
						fd.append("flag","new_monitor_upfile_hg");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"save_hgkj_new.php",
							data:fd,
							processData:false,
							contentType:false,
							success:function(data){
								console.log(data);
								alert("文件"+data);
								if(data == "保存成功"){
									//清除表格的操作
									var td_doc = btn_doc.parentNode;
									td_doc.innerHTML = "";
								}
							},
							error:function(xhr,status,xmlthrow){
								console.log("ajax error!"+status+xmlthrow);
							}
						});
					}else{
						alert("无文件上传!");
						//清除表格的操作
						var td_doc = btn_doc.parentNode;
						td_doc.innerHTML = "";
					}
				}
			},
			error:function(xhr,status,xmlthrow){
				console.log("ajax error!"+status+xmlthrow);
			}
		});
	}else{
		alert("请将“提醒日期”与“截止日期”填写完整!");
	}
}

//改变监控状态【即结束监控】
function ChangeSitu(id){
	$.ajax({
			type:"get",
			url:"save_hgkj_new.php",
			async:true,
			data:{
				flag:"ChangeSitu",
				id:id
			},
			success:function(data){
				alert(data);
//				console.log(data);
			},
			error:function(xhr,status,xmlthrow){
				console.log("ajax error!"+status+xmlthrow);
			}
		});
}