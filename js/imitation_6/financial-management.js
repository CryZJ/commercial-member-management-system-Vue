//全选功能
function Slect_All(tab_id,inp_doc){
	$("#"+tab_id+" input[type='checkbox']").each(function(){
		if($(inp_doc).attr("checked")){
			$(this).attr("checked",true);
		}else{
			$(this).attr("checked",false);
		}
		
	});
}

//选择客户名称
function select_kh(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_sqr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.sqr_name){
					$("#"+id).attr("value",localStorage.sqr_name);
					localStorage.clear();
				}else{
					alert("未选中客户！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择代理人
function select_dlr(id){
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

//选择案源人
function select_ayr(id){
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

//申请人新增
//var add_sqr = document.getElementById("add_sqr");
//add_sqr.addEventListener("click",function(){
////	window.open("../imitation_5/client_new.php","_blank");
//	window.open("../imitation_5/client_new.php","_blank");
//});

$("a[class='ADD_NEW_sqr']").click(function(){
	window.open("../imitation_5/client_new.php","_blank");
});

///*收费方式的input*/
//var payway = document.getElementById("payway");
//payway.addEventListener("change",function(){
//	var payway_inp = document.getElementById("payway_inp");
//	payway_inp.value = payway.value;
//});
//
///*支付方式*/
//var payway2 = document.getElementById("payway2");
//payway2.addEventListener("change",function(){
//	 var payway_inp2 = document.getElementById("payway_inp2");
//	 payway_inp2.value = payway2.value;
//});

//清除Modal的值
function Clear_Modal(div_id,num){
	var div_doc = document.getElementById(div_id);
	var inp = div_doc.getElementsByTagName("input");
	for(i=0;i<inp.length;i++){
		
		if(num.indexOf(i) == -1){
			inp[i].value = "";
		}
	}
}


//添加收入记录保存
//监督进度条
function uploadProgress_sr(evt){
	if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		var file_list = document.getElementById("file_list_sr");
		file_list.getElementsByTagName("strong")[0].innerHTML = '<span>'+percentComplete.toString()+'%</span>';
        var prog = file_list.getElementsByTagName('div')[0];
		var progBar = prog.getElementsByTagName('div')[0];
		progBar.style.width= 2*percentComplete+'px';
		progBar.setAttribute('aria-valuenow', prog.percent);
   }else {
    	var file_list = document.getElementById("file_list_sr");
    	var prog = file_list.getElementsByTagName('div')[0];
        prog.getElementsByTagName("div")[0].innerHTML = '上传失败！';
    }
}
function Savenew_data(btn_doc){
	//防止多点保存
	btn_doc.onclick = "";
	
	var str_data = "";
	$("#my_form input[class*='save_input']").each(function(i){
		if($(this).attr("value")){
			str_data += ","+$(this).attr("value");
		}else{
			str_data += ","+"无";
		}
	});
	str_data = str_data.substr(1);
	var fd = new FormData();
	fd.append("arr_send",str_data);
	fd.append("my_flag","save_pay");
	var file_sr = document.getElementById("file_sr").files;
	if(file_sr.length){
		for(i=0,len=file_sr.length;i<len;i++){
			fd.append(i,file_sr[i]);
		}
	}
	$.ajax({
		url:"financial-ajax.php",
		type:"post",
		data:fd,
		xhr:function(){
			myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',uploadProgress_sr,false);
			}
			return myXhr;
		},
		processData:false,
		contentType:false,
		success:function(data){
			setTimeout(function(){
				alert(data+"点击确认关闭本页！\n");
				location.reload();
			},1000);
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("保存失败！");
			location.reload();
		}
	});
}

//添加欠费记录保存
function Savenew_data_qf(btn_doc){
	//防止多点保存
	btn_doc.onclick = "";
	
	var inp = document.getElementById("my_form3").getElementsByTagName("input");//获取input
	var arr_data = new Array();
	for(i=0;i<inp.length;i++){	//获取value
			arr_data[i] = inp[i].value;
	}
	if(arr_data[0]){
		btn_doc.onclick = "";
		$.ajax({
			data:{
				my_flag:"SaveNew_Arrearage",
				arr_send:arr_data
			},
			type:"post",
			url:"financial-ajax.php",
			async:true,
//			dataType:"json",
			success:function(data){
				alert(data);
				if(data == "保存成功"){
					location.reload();
				}
			},
			error:function(){
				alert("ajax error! + 保存失败！");
			}
		});
	}else{
		alert("客户名称不正确！");
	}
	
}

//添加支出记录
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
function Savenewdata_zc(btn_doc){
	btn_doc.onclick = null;
	var inp = document.getElementById("my_form2").getElementsByTagName("input");//获取input
//	var arr_data = new Array();
	var str_data = "";
	for(i=0;i<inp.length-1;i++){	//获取value
		if(inp[i].value){
			str_data += inp[i].value + "#$#";
		}else{
			str_data += "0" + "#$#";
		}
			
	}
	str_data = str_data.substr(0,str_data.length-3);
//	alert(str_data);
	var file_zc = document.getElementById("file_zc").files;
	var fd = new FormData();
	fd.append("str_data",str_data);
	fd.append("my_flag","save_pay2");
	if(file_zc.length){
		for(i=0,len=file_zc.length;i<len;i++){
			fd.append(i,file_zc[i]);
		}
	}
	$.ajax({
		url:"financial-ajax.php",
		type:"post",
		data:fd,
		xhr:function(){
			myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',uploadProgress,false);
			}
			return myXhr;
		},
		processData:false,
		contentType:false,
		success:function(data){
			setTimeout(function(){
				alert(data+"点击确认关闭本页！\n");
				location.reload();
			},1000);
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("保存失败！");
			location.reload();
		}
	});
}

//进行每月统计
function stat(){
	$.ajax({
			data:{
				my_flag:"stat"
			},
			type:"post",
			url:"financial-ajax.php",
			async:true,
//			dataType:"json",
			success:function(data){
				alert(data);
				if(data == "统计完毕"){
					location.reload();
				}
			},
			error:function(){
				alert("ajax error! + 保存失败！");
			}
	});
}
/*查看收入记录*/
function checksr(id){
//	alert(id);
	myurl = "check_sr.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 760;
	var bro_width = 650;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var childWin = window.open(myurl,"_blank",specs);
//	var loop = setInterval(function(){
//		if(childWin.closed){
//			clearInterval(loop);
//			parent.location.reload();
//		}
//	},1);
//	childWin.addEventListener("close",function(){
//		self.location.reload();
//	});
}
/*查看欠费记录*/
function checkqf(id){
//	alert(id);
	myurl = "check_qf.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 760;
	var bro_width = 650;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var childWin = window.open(myurl,"_blank",specs);
//	var loop = setInterval(function(){
//		if(childWin.closed){
//			clearInterval(loop);
//			parent.location.reload();
//		}
//	},1);

}

/*删除支出记录*/
function del_zc(id){
	$.ajax({
			data:{
				my_flag:"del_zc",
				myid:id
			},
			type:"post",
			url:"financial-ajax.php",
			async:true,
//			dataType:"json",
			success:function(data){
				alert(data);
				if(data == "删除成功"){
					location.reload();
				}
			},
			error:function(){
				alert("ajax error! + 保存失败！");
			}
	});	
}
/*查看支出记录*/
function checkzc(id){
//	alert(id);
	myurl = "check_zc.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 570;
	var bro_width = 780;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var childWin = window.open(myurl,"_blank",specs);
//	var loop = setInterval(function(){
//		if(childWin.closed){
//			clearInterval(loop);
//			parent.location.reload();
//		}
//	},1);
//	childWin.addEventListener("close",function(){
//		location.reload();
//	});
}


//清除查询条件
function Clear_check(){
	document.getElementById("ayr_check").value = "";
	document.getElementById("kh_check").value = "";
	document.getElementById("star_time").value ="";
	document.getElementById("end_time").value = "";
}


/*按人员查收入记录*/
function user_check(){
	var user_name = document.getElementById("ayr_check").value;
	var kh_name = document.getElementById("kh_check").value;
	var star_value = document.getElementById("star_time").value;
	var end_value = document.getElementById("end_time").value;
	
	var tab_user = document.getElementById("tab_user");
	if(user_name != '' || kh_name != ''){
		if(tab_user.rows.length !=0 ){
			var tab_len = tab_user.rows.length;
//			alert(tab_len);
			for(i=0;i<tab_len;i++){
				tab_user.deleteRow(0);
			}
		}
		$.ajax({
			type:"post",
			url:"financial-ajax.php",
			async:false,
			data:{
				my_flag:"get_userdata",
				user_name:user_name,
				kh_name:kh_name,
				star_value:star_value,
				end_value:end_value
			},
			dataType:"json",
			success:function(data){
				if(data != null){
//					alert(data.length);
					add_num_zsf = 0;
					add_num_gf = 0;
					add_num_glf = 0;
					add_num_sf = 0;
					add_num = 0;
					for(i=0;i<data.length;i++){
						var new_len = tab_user.rows.length;
						var new_row = tab_user.insertRow(new_len);
						for(j=0;j<11;j++){
							var new_cell = new_row.insertCell(j);
							new_cell.innerHTML = data[i][j];
						}
						add_num_zsf = add_num_zsf+parseFloat(data[i][4]);
						add_num_gf = add_num_gf+parseFloat(data[i][5]);
						add_num_glf = add_num_glf+parseFloat(data[i][6]);
						add_num_sf = add_num_sf+parseFloat(data[i][7]);
						add_num = add_num+data[i][10];
					}
					var add_zsf = document.getElementById("add_zsf");
					add_zsf.value = add_num_zsf;
					var add_gf = document.getElementById("add_gf");
					add_gf.value = add_num_gf;
					var add_glf = document.getElementById("add_glf");
					add_glf.value = add_num_glf;
					var add_sf = document.getElementById("add_sf");
					add_sf.value = add_num_sf;
					var add_all = document.getElementById("add_all");
					add_all.value = add_num;
					
					
				}else{
					var add_zsf = document.getElementById("add_zsf");
					add_zsf.value = 0;
					var add_gf = document.getElementById("add_gf");
					add_gf.value = 0;
					var add_glf = document.getElementById("add_glf");
					add_glf.value = 0;
					var add_sf = document.getElementById("add_sf");
					add_sf.value = 0;
					var add_all = document.getElementById("add_all");
					add_all.value = 0;
					alert("无数据或出错了！");
				}
			},
			error:function(){
				alert("ajax error!");
			}
		});
	}else{
		alert("没选中人员或客户！");
	}
}


