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

//获取页面数据,异步传递数据
function save_data_ZZ(){
		//	基本信息
		var ajdlr   = document.getElementById("ajdlr").value;
		var tab_rj  =  document.getElementById("tab_sqr");
		var bz = document.getElementById("case_bz").value; //备注
		var ayr = document.getElementById("ayr").value;
		var dlr = document.getElementById("dlr").value;
		var ajh = document.getElementById("ajh").value;
		var zzmc = document.getElementById("zzmc").value;
		var data_str1 = ayr + "|" + dlr + "|" + ajh + "|" + zzmc;
//			alert(data_str1);
		//申请人信息
		var  tab =  document.getElementById("tab_sqr1");
		var  tab_rows  =  tab.rows.length;
		var  sqrid = '';
		for(var  i = 1; i < tab_rows; i++) {
			var id = tab.rows[i].cells[0].innerHTML; //id
			sqrid = sqrid+','+id;
		}
		sqrid = sqrid.substring(1,sqrid.length);
//		alert(sqrid);
		
		if(ajh == "" || sqrid == "") {
			alert("请填写案件信息");
			return;
		} else {
			$.ajax({
				type: "post",
				url: "case_save_zz.php",
				async: true,
				data: {
					ajdlr: ajdlr,//案件处理人
					ajh: ajh,//案卷号
					ms:data_str1,//基本信息
					sqr:sqrid,//申请人id
					bz:bz,//备注
					falg:'savecase'
				},
				success:function(data) {
					if(data == 1){
						alert('保存成功');
						//异步保存文件
						if(file_num > 1){
							fd_file.append("falg","upfile_zz");
							fd_file.append("ajh",ajh);
							var dest = new Array();
							//装载信息
							$("#file_list_2 input").each(function(i){
								if($(this).attr("value")){
									dest[i] = $(this).attr("value");
								}else{
									dest[i] = "无";
								}
							});
							fd_file.append("dest2",dest);
							$.ajax({
								type:"post",
								url:"case_save_zz.php",
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
		//								console.log(data);
										//清除"代理人","案卷号"的值
										document.getElementById("dlr").value = '';
										document.getElementById("ajh").value = '';
									},1000);
								},
								error:function(xhr,staue,xmlthrow){
									console.log("ajax error!" +staue+xmlthrow);
								}
							});
						}else{
							//清除"代理人","案卷号"的值
							document.getElementById("dlr").value = '';
							document.getElementById("ajh").value = '';
							alert("无文件上传");
						}
					}else{
						alert('出现错误,请联系管理员');
					}
				}
			});
		}
		
		//alert('ok');
}

////著作监控部分
//function save_kj_zz(){
//	var jk_tab = document.getElementById("ajjk");
//	var tab_rows = jk_tab.rows.length;
//	var kj_ajh      = document.getElementById("kj_ajh").value;//案卷号
//	var sqh_zz      = document.getElementById("sqh_zz").value;//申请号
//	var sqr_zz      = document.getElementById("sqr_zz").value;//申请日
//	var zzxh        = document.getElementById("zzxh").value;//序号
//	for(var i=1;i<tab_rows;i++){
//		var dd = document.getElementById("ajjk").rows[i].cells[0].getElementsByTagName("input")[1].value;
////		alert(dd);
//		if(dd == ""){
//	var kjm_zz      = document.getElementById("ajjk").rows[i].cells[0].getElementsByTagName("input")[0].value;//控建名
//	var je_zz       = document.getElementById("ajjk").rows[i].cells[1].getElementsByTagName("input")[0].value;//金额
//	var txday       = document.getElementById("ajjk").rows[i].cells[2].getElementsByTagName("input")[0].value;//提醒日期
//	var jzday       = document.getElementById("ajjk").rows[i].cells[3].getElementsByTagName("input")[0].value;//截止日期
//	var jkbz        = document.getElementById("ajjk").rows[i].cells[4].getElementsByTagName("input")[0].value;//备注
//	var kjxx = sqh_zz +"|"+sqr_zz +"|"+ zzxh +"|"+ kjm_zz +"|"+ je_zz +"|"+ txday +"|"+jzday + "|" + jkbz;
//	if(kjxx == "|||||||"){
////		alert("没有填写信息");
//	}else{
//		$.ajax({
//				type:"post",
//				url:"save_zzkj_new.php",
//				async:true,
//				data:{
//					kjxx:kjxx,
//					ajh:kj_ajh
//				},
//				success:function(data){
////					alert(data);
//					if(data == "1"){
//						alert("监控保存成功");
//						history.go(0);
//					}else{
//						alert("监控保存失败");
//					}
//					
//				}
//		});
//	}
//	break;
//	}
//}
//}
//申请号,申请日
function save_sqh(){
	var ajh_zz = document.getElementById("kj_ajh").value;
	var  sqh = document.getElementById("sqh_zz").value;
	var sqday = document.getElementById("sqr_zz").value;
//	alert(sqh);
	$.ajax({
		type:"post",
		url:"save_sqh.php",
		async:true,
		data:{
			ajh:ajh_zz,
			sqh_zz:sqh,
			sqr_zz:sqday
		},
		 success:function(data){
			alert("保存成功");
			history.go(0);
		}
	});
}
//上传文件
function upfile(ajh){
	var myurl = "../upfile_zz.php"+"?ajh="+ajh;
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
				flag:"zhuzuo",
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


//新增监控时的撤除
function del_row(btn_doc){
	if(confirm("是否确认撤除?")){
		var tr_doc = btn_doc.parentNode.parentNode;
		var tab = document.getElementById("ajjk");
		tab.deleteRow(tr_doc.rowIndex);
	}
}

//监控新建保存 --案件详情
function save_kjxx(btn_doc){
	var ajh = document.getElementById("kj_ajh").value;//案卷号
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
			url:"save_zzkj_new.php",
			async:true,
			data:{
				flag:"new_monitor_zz",
				ajh:ajh,
				send_str:send_str
			},
			success:function(data){
				tr_doc.cells[6].innerHTML = "";
				alert("信息"+data);
//				console.log(data);
				if(data == "保存成功"){
					//异步保存文件
					var int_file = tr_doc.cells[2].getElementsByTagName("input")[0].files;
					console.log(int_file.length);
					if(int_file.length != 0){
						var fd = new FormData();
						fd.append("flag","new_monitor_upfile_zz");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"save_zzkj_new.php",
							data:fd,
							processData:false,
							contentType:false,
							success:function(data){
//								console.log(data);
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

//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file_dest.php"+"?flag=zz&"+"id="+id;
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
//改变监控状态【即结束监控】
function ChangeSitu(id){
	$.ajax({
			type:"get",
			url:"save_zzkj_new.php",
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