//表格选择全部
function SelectAll_totable(table_id,tbody_id){
//	console.log($("#"+table_id+" input[type='checkbox']").first().attr("checked"));
	if($("#"+table_id+" input[type='checkbox']").first().attr("checked")){
		$("#"+tbody_id+" input[type='checkbox']").attr("checked",true);
	}else{
		$("#"+tbody_id+" input[type='checkbox']").attr("checked",false);
	}
	
}



/*批量下载文件部分 star*/
var download = document.getElementById("download");
var dynamic = document.getElementById("tab_info_0");
download.addEventListener('click',function(){
	var nrow = dynamic.rows.length;
	var flag = confirm("是否确定要下载全部文件");
//	alert( nrow+"\n"+ dynamic.rows[0].cells[0].innerHTML );
	
	if(flag && dynamic.rows[0].cells[0].innerHTML != "没有数据！"){
		window.open("../../file_download.php",'_blank');
		setTimeout(location.reload(),15000);
	}else{
		alert("无文件下载！");
	}

});
/*批量下载文件部分 end*/

/*全选功能 start    */
//表格tab_info_0
document.getElementById("select_all_wxzsqwj").addEventListener("change",function(){
	var tab_0 = document.getElementById("tab_info_0");
	for(i=0;i<tab_0.rows.length;i++){
		tab_0.rows[i].cells[0].getElementsByTagName("input")[0].checked = this.checked;
	}
});

//表格tab_info_1
document.getElementById("select_all_1").addEventListener("click",function(){
	var tab_1 = document.getElementById("tab_info_1");
	for(i=0;i<tab_1.rows.length;i++){
		tab_1.rows[i].cells[0].getElementsByTagName("input")[0].checked = this.checked;
	}
});
/*全选功能 end*/

/*下载选中文件 start*/
/*
 * 说明：先把“案卷流程及文档”的id传过去PHP页面进行打包下载，再用id去查案卷号以更改“专案信息”的状态为“申请中”
 */
//打开新的窗口进行下载
function openpostwindow(url,name,data1,data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="flag";
     hideInput1.value = data1;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="send_id";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
     if(document.all){
         tempForm.attachEvent("onsubmit",function(){});        //IE
     }else{
         var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
     }
     document.body.appendChild(tempForm);
     if(document.all){
         tempForm.fireEvent("onsubmit");
     }else{
         tempForm.dispatchEvent(new Event("submit"));
     }
     tempForm.submit();
     document.body.removeChild(tempForm);
}
//下载选中的申请文件
document.getElementById("dow_sel_file").addEventListener("click",function(){
	var tab_0 = document.getElementById("tab_info_0");
	var send_id = '';
	var file_num = 0;
	for(i=0;i<tab_0.rows.length;i++){
		if(tab_0.rows[i].cells[0].getElementsByTagName("input")[0].checked){
			send_id += tab_0.rows[i].cells[0].getElementsByTagName("input")[0].id + ",";
			file_num++;
		}
	}
	if(file_num){
		if(confirm("本次选中"+file_num+"个文件，是否确认下载？")){
			send_id = send_id.substr(0,send_id.length-1);
			console.log(send_id + "\n" + file_num);
			flag = "wxzsqwj_downfile";
			openpostwindow("dow_file_more.php","_blank",flag,send_id);
			setTimeout(function(){
				window.onfocus = function(){
					window.location.reload();
				}
			},1000);
		}
		
	}else{
		alert("本页没有打钩的行！");
	}
	
	
})

/*下载选中文件 end*/

/*删除选中申请文件 start*/
document.getElementById("del_sel_file").addEventListener("click",function(){
	var tab_1 = document.getElementById("tab_info_1");
	var send_id = '';
	var file_num = 0;
	for(i=0;i<tab_1.rows.length;i++){
		if(tab_1.rows[i].cells[0].getElementsByTagName("input")[0].checked){
			send_id += tab_1.rows[i].cells[0].getElementsByTagName("input")[0].id + ",";
			file_num++;
		}
	}
	if(file_num){
		if(confirm("本次选中"+file_num+"行，是否确认不显示？")){
			send_id = send_id.substr(0,send_id.length-1);
//			console.log(send_id + "\n" + file_num);
//			flag = "yxzsqwj_noneshow";
//			openpostwindow("dow_file_more.php","_blank",flag,send_id);
//			setTimeout(function(){
//				window.onfocus = function(){
//					window.location.reload();
//				}
//			},1000);
			$.ajax({
				type:"post",
				url:"dow_file_more.php",
				async:true,
				data:{
					flag:"yxzsqwj_noneshow",
					send_id:send_id
				},
				success:function(data){
					alert(data);
					window.location.reload();
				},
				error:function(XML,status,XMLthrow){
					console.log("ajax error!"+status+XMLthrow);
				}
			});
		}
	}else{
		alert("本页没有打钩的行！");
	}
	
	
})

/*删除选中申请文件 end*/

/*发送文件部分 star*/
var tab_send = document.getElementById("tab_send");
var select_all = document.getElementById("select_all");

//选择全部
select_all.addEventListener('click',function(){
	if(select_all.checked == true){
		var row_num = tab_send.rows.length;
		for(i=0;i<row_num;i++){
			tab_send.rows[i].cells[0].getElementsByTagName("input")[0].checked = true;
		}
	}else{
		var row_num = tab_send.rows.length;
		for(i=0;i<row_num;i++){
			tab_send.rows[i].cells[0].getElementsByTagName("input")[0].checked = false;
		}		
	}
});

//"待发送文件"批量删除按钮
function Delect_acceptfile(tbody_id){
	if(confirm("是否确定删除文件？")){
		var rowid_str = "";
		$("#"+tbody_id+" input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				rowid_str += ","+$(this).attr("id");
			}
		});
		if(rowid_str){
			rowid_str = rowid_str.substr(1);
			console.log(rowid_str);
			$.ajax({
				data:{
					my_flag:"del_send",
					rowid_str:rowid_str
				},
				type:"post",
				url:"mailmas_ajax.php",
				async:true,
				success:function(data){
					alert(data);
					window.location.reload();
				},
				error:function(x,s,t){
					alert("删除失败_ae");
					console.log("ajax error!"+"---"+s+"---"+t);
				}
			});
		}else{
			alert("没有选中行！");
		}
	}
}

//"已发送文件"，"已接收文件"批量删除按钮
function Delect_files(tbody_id,diff_flag){
	if(confirm("是否确定删除文件？")){
		var rowid_str = "";
		$("#"+tbody_id+" input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				rowid_str += ","+$(this).attr("id");
			}
		});
		if(rowid_str){
			rowid_str = rowid_str.substr(1);
			console.log(rowid_str);
			$.ajax({
				data:{
					my_flag:diff_flag,
					rowid_str:rowid_str
				},
				type:"post",
				url:"mailmas_ajax.php",
				async:true,
				success:function(data){
					alert(data);
					window.location.reload();
				},
				error:function(x,s,t){
					alert("删除失败_ae");
					console.log("ajax error!"+"---"+s+"---"+t);
				}
			});
		}else{
			alert("没有选中行！");
		}
	}
}


//"发送文件"函数
function Send_file(tbody_id,ajax_flag){
	if(confirm("是否确定发送文件？")){
		var rowid_str = "";
		$("#"+tbody_id+" input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				rowid_str += ","+$(this).attr("id");
			}
		});
		if(rowid_str){
			rowid_str = rowid_str.substr(1);
			
			var my_url = "member_0.php?rowid_str="+rowid_str+"&"+"ajax_flag="+ajax_flag;
			var scr_height = window.screen.availHeight;
			var scr_width = window.screen.availWidth;
			var bro_height = 500;
			var bro_width = 600;
			var top = (scr_height-bro_height)/2;
			var left = (scr_width-bro_width)/2;
			var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
			var winobj = window.open(my_url,"_blank",specs,false);
			var loop = setInterval(function(){
				if(winobj.closed){
					clearInterval(loop);
					parent.location.reload();
				}
			},1);
		}
	}else{
			alert("没有选中行！");
	}
}
//接收后再次发送文件

/*发送文件部分 end*/

/*接收文件部分 star*/
//接收选中行函数
//接收批量下载
//window.open的post传输数据函数
function openPostWindow(url, name, data1, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="xtid";
     hideInput1.value = data1;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="xtmc";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
     
     if(document.all){
         tempForm.attachEvent("onsubmit",function(){});        //IE
     }else{
         var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
     }
     document.body.appendChild(tempForm);
     if(document.all){
         tempForm.fireEvent("onsubmit");
     }else{
         tempForm.dispatchEvent(new Event("submit"));
     }
     
     tempForm.submit();
     document.body.removeChild(tempForm);
     
}
function AcceptAll_file(tbody_id){
	if(confirm("是否确定接收文件？")){
		var rowid_str = "";
		$("#"+tbody_id+" input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				rowid_str += ","+$(this).attr("id");
			}
		});
		if(rowid_str){
			rowid_str = rowid_str.substr(1);
//			console.log(rowid_str);
			openPostWindow("dowload_file.php","_blank",rowid_str);
			setTimeout(function(){
//				if(confirm("是否需要刷新？")){
					location.reload();
//				}
			}, 5000 );
		}
	}
}

//var select_all2 = document.getElementById("select_all2");
//var accept_tab = document.getElementById("accept_tab");
//var dele_accept = document.getElementById("dele_accept");
//var accept_file = document.getElementById("accept_file");

////选择全部
//select_all2.addEventListener('click',function(){
//	if(select_all2.checked == true){
//		var row_num = accept_tab.rows.length;
//		for(i=0;i<row_num;i++){
//			accept_tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = true;
//		}
//	}else{
//		var row_num = accept_tab.rows.length;
//		for(i=0;i<row_num;i++){
//			accept_tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = false;
//		}		
//	}
//});

////批量删除按钮
//dele_accept.addEventListener("click",function(){
//	if(confirm("是否确定删除文件？")){
//		var str_id = new String();
//		var row_num = accept_tab.rows.length;
//		for(i=0;i<row_num;i++){
//			if(accept_tab.rows[i].cells[0].getElementsByTagName("input")[0].checked == true){
//				str_id = str_id + accept_tab.rows[i].cells[1].innerHTML + ",";
//			}
//		}
//		if(str_id.length != 0){
//			str_id = str_id.substr(0,(str_id.length-1));
////			alert(str_id);		
//			$.ajax({
//				data:{
//					my_flag:"del_accept",
//					str_id:str_id
//				},
//				type:"post",
//				url:"mailmas_ajax.php",
//				async:true,
//				dataType:"json",
//				success:function(data){
//					alert(data.result);
//					location.reload();
//				},
//				error:function(XMLhttprequest,errorstatus,errorThrow){
//					alert( "接收文件删除失败！");
//					console.log("ajax error!"+errorstatus+errorThrow);
//				}
//			});
//			
//		}else{
//			alert("没有勾选数据！");
//		}
//	}
//});
//

//
//accept_file.addEventListener("click",function(){
//	if(confirm("是否确定下载文件？")){
//		var str_id = new String();
//		var row_num = accept_tab.rows.length;
//		for(i=0;i<row_num;i++){
//			if(accept_tab.rows[i].cells[0].getElementsByTagName("input")[0].checked == true){
//				str_id = str_id + accept_tab.rows[i].cells[1].innerHTML + ",";
//			}
//		}
//		if(str_id.length != 0){
//			str_id = str_id.substr(0,(str_id.length-1));
////			alert(str_id);		
//			openPostWindow("dowload_file.php","_blank",str_id);
//			setTimeout(function(){
////				if(confirm("是否需要刷新？")){
//					location.reload();
////				}
//			}, 5000 );
//			
//		}else{
//			alert("没有勾选数据！");
//		}
//	}	
//});

//单个删除 str
function del_one(id){
//	alert(id);
	if(confirm("是否确定删除？")){
		$.ajax({
			data:{
				my_flag:"del_one",
				id:id
			},
			type:"post",
			url:"mailmas_ajax.php",
			async:true,
			dataType:"json",
			success:function(data){
//				alert(data);
				alert(data.result);
				location.reload();
			},
			error:function(){
				alert("ajax error! + 删除失败！");
			}
		});
	}
}
//单个删除 str

//单个下载 str
//window.open的post传输数据函数
function openPostWindow2(url, name, data1, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="my_flag";
     hideInput1.value = data1;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="id";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
     
     if(document.all){
         tempForm.attachEvent("onsubmit",function(){});        //IE
     }else{
         var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
     }
     document.body.appendChild(tempForm);
     if(document.all){
         tempForm.fireEvent("onsubmit");
     }else{
         tempForm.dispatchEvent(new Event("submit"));
     }
     
     tempForm.submit();
     document.body.removeChild(tempForm);
     
}

function dow_one(id){
	my_url = "mailmas_ajax.php";
	openPostWindow2(my_url,"_blank","dow_one", id);
}
//单个下载 end

//费用设置 star
function cost_set(id){
	var my_url = "cost_set.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 600;
	var bro_width = 500;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs,false);
}
//费用设置 end

//新增监控 star
function monitor(id){
//	var my_url = "monitor_set.php?id="+id+"&"+"flag=mail";
	if(confirm("是否新建监控？")){
		var my_url = "monitor_set.php?id="+id+"&"+"flag=mail";
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 600;
		var bro_width = 500;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		window.open(my_url,"_blank",specs,false);
	}
}
//新增监控 end

function termination(id){
	var my_url = "termination.php?id="+id+"&"+"flag=mail";
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 900;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs,false);	
}

/*接收文件部分 end*/

//删除申请人文件
function del_file(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id;
	if(confirm("是否确认删除文件？（删除后文件将不再存在）")){
		$.ajax({
			type:"get",
			url:"del_file.php",
			async:true,
			data:{
				flag:"sqwj",
				id:id
			},
			success:function(data){
	//			"0";//数据库无这条记录
	//			"1";//删除文件失败
	//			"2";//文件已删除状态未改
	//			"3";//文件删除成功
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
				self.location.reload();
			},
			error:function(){
				console.log("ajax error!");
			}
		});
	}
}

//打开查看今天新建案件的页面
function Check_newcase(){
	my_url = "check_nowcase.php";
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs);
}

//打开共享文件的上传界面
function Upsharefile(ajax_flag){
	var myurl = "upfile_share.php?ajax_flag="+ajax_flag;
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

//单个删除 str
function Del_shareone(id,ajax_flag){
//	alert(id);
	if(confirm("是否确定删除？")){
		$.ajax({
			data:{
				my_flag:ajax_flag,
				id:id
			},
			type:"post",
			url:"mailmas_ajax.php",
			async:true,
			success:function(data){
				alert(data);
				location.reload();
			},
			error:function(XMLhttpreques,status,errorthrow){
				alert("ajax error! + 删除失败！"+XMLhttpreques+status+errorthrow);
			}
		});
	}
}
//单个删除 end


//选择表格中本页全部的函数
function SelectAll_tab(inp_doc,tab_id){
	var tab_doc = document.getElementById(tab_id);
	for(i=0,len=tab_doc.rows.length;i<len;i++){
		tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].checked = inp_doc.checked;
	}
}

//表格选中的批量删除(input标签的id为数据库的id)
function DeleteAll_tab(tab_id,ajax_flag){
	if(confirm("是否确认删除？")){
		var tab_doc = document.getElementById(tab_id);
		if(tab_doc.rows.length-2){
			var str_id = "";
			//获取选中的id，除第一行
			for(i=1,len=tab_doc.rows.length;i<len;i++){
				if(tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].checked){
					str_id += tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].id + ",";
				}
			}
			if(str_id != ""){
				str_id = str_id.substr(0,str_id.length-1);//去掉最后一个分割符
//				alert(str_id);
				//异步删除	
				$.ajax({
					type:"get",
					url:"mailmas_ajax.php",
					async:true,
					data:{
						my_flag:ajax_flag,
						str_id:str_id
					},
					success:function(data){
						alert(data);
						window.location.reload();
					},
					error:function(XMLhttprequest,errorstatus,errorThrow){
						alert("删除失败");
						console.log("ajax error!"+XMLhttprequest+errorstatus+errorThrow);
					}
				});
				
			}else{
				alert("本页没有选中的行！");
			}
		}else{
			alert("无数据!");
		}
	}
}

//分享文件的批量下载
function DownloadAll_tab(tab_id,ajax_flag){
	var tab_doc = document.getElementById(tab_id);
	if(tab_doc.rows.length-2){
		var str_id = "";
		//获取选中的id，除第一行
		for(i=1,len=tab_doc.rows.length;i<len;i++){
			if(tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].checked){
				str_id += tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].id + ",";
			}
		}
		if(str_id != ""){
			str_id = str_id.substr(0,str_id.length-1);//去掉最后一个分割符
//			flag = "share_downfile";
			flag = ajax_flag;
			openpostwindow("dow_file_more.php","_blank",flag,str_id);
			setTimeout(function(){
				window.onfocus = function(){
					window.location.reload();
				}
			},1000);
		}else{
			alert("本页没有选中的行！");
		}
	}else{
		alert("无数据!");
	}	
}


//打开
function OpenWin_Upfile(){
	var my_url = "upfile_send.php";
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var opein = window.open(my_url,"_blank",specs);
	var loop = setInterval(function(){
		if(opein.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1)
}







