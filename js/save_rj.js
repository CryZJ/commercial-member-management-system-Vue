//选择案源人
function Change_ayr(inp_obj){
    
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
					inp_obj.value = localStorage.ayr_name;
        			changeMes('AYR',inp_obj);
        			
					localStorage.clear();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//选择代理人  
function Change_dlr(inp_obj){
    
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
					inp_obj.value = localStorage.dlr_name;
        			changeMes('DLR',inp_obj);
        			
					localStorage.clear();
				}else{
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//修改案件信息
function changeMes(text,obj){
    var Place = '';
    switch(text){
        case 'AYR':
            Place = '案源人';
            break;
        case 'DLR':
            Place = '代理人';
            break;
        case "rjmc":
        	Place = "软件名称";
        	break;
        case "sqrq":
        	Place = "申请日期";
        	break;
    }
    if(confirm(Place+'信息发生改变，是否对其进行修改')){
        var Mes = obj.value;//修改后数据
//          alert(Mes);
        var ajhT = document.getElementById('ajh');//获取案卷号
        $.ajax({
            type:"get",
            url:"rjxg_ajax.php",
            async:true,
            data:{
                Mes:Mes,//修改后数据
                Text:Place,
                ajhT:ajhT.value,//案卷号
                flag:'ChanCaseMes'
            },
            success:function(data){
                if(data=='ok'){
                    alert(Place+'修改成功');
                }
            }
        });
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

//案件信息保存 --案件新建
function save_data_rj(btn_doc){
	//基本信息
	var ajdlr   = document.getElementById("ajdlr").value;//案件创建人
	var tab_rj  =  document.getElementById("tab_sqr");
	var bz = document.getElementById("case_bz").value; //备注
	var ayr = document.getElementById("ayr").value;//案源人
	var dlr = document.getElementById("dlr").value;//代理人
	var ajh = document.getElementById("ajh").value;//案卷号
	var rjmc = document.getElementById("rjmc").value;//软件名
	
	var data_str1 = ayr + "|" + dlr + "|" + ajh + "|" + rjmc;//案件基本信息
	//	alert(data_str1);
	//申请人信息
	var  tab =  document.getElementById("tab_sqr1");
	var  tab_rows  =  tab.rows.length;
	var  sqrid = '';
		for(var  i = 1; i < tab_rows; i++) {
			var id = tab.rows[i].cells[0].innerHTML; //证件号
			sqrid = sqrid+'|'+id;
		}
		sqrid = sqrid.substring(1,sqrid.length);
//		alert(sqrid);

	if(ajh == "" || sqrid == "") {
		alert("请将信息填写完整");
		return;
	} else {
	//	alert(ajdlr+"  "+sqr+"  "+"    "+data_str3  +"  "+bz);
		$.ajax({
			type: "post",
			url: "case_save_rj.php",
			async: true,
			data: {
				ajdlr: ajdlr,//案件处理人
				sqr:sqrid,//申请人信息[申请人证件]|分
				ms: data_str1,//基本信息[案源人|代理人|案卷号|软件名称]
				bz: bz,//备注
				falg:'savecase'
			},
			success:function(data) {
				alert(data);
				
				//异步保存文件
				if(file_num > 1){
					fd_file.append("flag","upfile_rj");
					fd_file.append("ajh",ajh);
					$.ajax({
						type:"post",
						url:"newcasefile_save_rjaj.php",
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
//							console.log(data);
							setTimeout(function(){
								alert(data);
	//							console.log(data);
								//清除"代理人","案卷号"的值
								var dlr_doc = document.getElementById("dlr");
								var ajh_doc = document.getElementById("ajh");
								dlr_doc.value = "";
								ajh_doc.value = "";
							},1000);
						},
						error:function(xhr,staue,xmlthrow){
							console.log("ajax error!" +staue+xmlthrow);
						}
					});
				}else{
					alert("无上传文件");
					//清除"代理人","案卷号"的值
					var dlr_doc = document.getElementById("dlr");
					var ajh_doc = document.getElementById("ajh");
					dlr_doc.value = "";
					ajh_doc.value = "";
				}
			},
			error:function(xhr,satus,errorthow){
				console.log("ajax error!"+satus+errorthow);
			}
		});
	}
}

//申请号申请日保存 --案件详情
function save_jbxx(){
	var ajh_rj = document.getElementById("ajh").value;
	var  sqh = document.getElementById("sqh_rj").value;
	var sqday = document.getElementById("sqday").value;
	
	
//	alert(ajh_rj+"/"+sqh+"/"+sqday);

		$.ajax({
		type:"post",
		url:"case_save_rj.php",
		async:true,
		data:{
			ajh:ajh_rj,
			sqh_zz:sqh,
			sqr_zz:sqday,
			falg:'save_sqh'
		},
		 success:function(data){
		 	if(data){
		 		alert("保存成功");
		 		history.go(0);
		 	}else{
		 		alert("保存失败");
		 		history.go(0);
		 	}
		}
	});

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
			url:"save_rjkj_new.php",
			async:true,
			data:{
				flag:"new_monitor_rj",
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
						fd.append("flag","new_monitor_upfile_rj");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"save_rjkj_new.php",
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

//新增监控时的撤除
function del_row(btn_doc){
	if(confirm("是否确认撤除?")){
		var tr_doc = btn_doc.parentNode.parentNode;
		var tab = document.getElementById("tab_che");
		tab.deleteRow(tr_doc.rowIndex);
	}
}


//上传文件
function upfile(ajh){
	var myurl = "../upfile_software.php"+"?ajh="+ajh;
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
				flag:"ruanjian",
				id:id
			},
			success:function(data){
				console.log(data);
				switch(data){
					case "0" : 
						alert("数据库无这条记录"); 
						break;
					case "1" : 
						alert("删除文件失败"); 
						break;
					case "2" : 
						alert("文件已删除状态未改"); 
						break;
					case "3" : 
						alert("文件删除成功"); 
						break;
					default : alert(data);
				}
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
		var myurl = "../change_file.php"+"?flag=rj&"+"id="+id;
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
			url:"save_rjkj_new.php",
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