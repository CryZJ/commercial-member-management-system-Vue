//获取本日上传的文件数量
function GET_num(){
	$.ajax({
		type:"get",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"获取本日文件数量",
		},
		success:function(data){
			arr_data = data.split("#$#");
			document.getElementById("files_num").innerHTML = arr_data[0];
			document.getElementById("filesnum_sl").innerHTML = arr_data[1];
			document.getElementById("filenum_sq").innerHTML = arr_data[2];
			document.getElementById("filenum_jf").innerHTML = arr_data[3];
			document.getElementById("filenum_zz").innerHTML = arr_data[4];
			document.getElementById("filenum_qt").innerHTML = arr_data[5];
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("获取本日上传文件数量失败！");
			console.log("ajax error!"+errorstatus+errorThrow);
		}
	});
}
	


/*费用*/
function cost(id){
//	alert(id);
	$.ajax({
		data:{
			my_flag:"cost",
			id:id
		},
		type:"post",
		url:"upload_file_num_ajax.php",
		async:true,
		dataType:"json",
		success:function(data){
			if(data['result'] == "success"){
				//读取受理书费用
				if(data['number'] == "200101,200021"){
					my_url = "advice_handle.php?id="+id;
					open_newwebpage(my_url,'500','1200');
				
				//读取授权费用
				}else if(data['number'] == "200602"){
					my_url = "impower_handle.php?id="+id;
					open_newwebpage(my_url,'500','1200');
				
				//读取缴费通知
				}else if(data['number'] == "200701"){
					my_url = "overdue_confirm.php?id="+id;
					open_newwebpage(my_url,'500','1200');
					
				//提醒	
				}else{
					alert("此通知书暂不能读取费用，请联系开发人员进行更新！");
				}
				
				
			}else{
				alert("获取通知书编号失败！");
			}
		},
		error:function(){
			alert("ajax error! + 结案失败！");
		}
	});	
}

//获取屏幕的高，宽度并打开新的窗口
function open_newwebpage(my_url,bro_height,bro_width){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
//	var bro_height = 500;
//	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs,false);
}

/*监控*/
function control(id){
//	alert(id);
	var my_url = "monitor_set.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 500;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs,false);	
}


/*结案*/
function over(id){
//	alert(id);
	if(confirm("是否确认结案？")){
		$.ajax({
			data:{
				my_flag:"over",
				id:id
			},
			type:"post",
			url:"upload_file_num_ajax.php",
			async:true,
			dataType:"json",
			success:function(data){
				alert(data.result);
			},
			error:function(){
				alert("ajax error! + 结案失败！");
			}
		});
	}
}


/*删除*/
function del(btn_doc){
//	alert(id);
	id = btn_doc.id;
	$.ajax({
		data:{
			my_flag:"del",
			id:id
		},
		type:"post",
		url:"upload_file_num_ajax.php",
		async:true,
		dataType:"json",
		success:function(data){
//			console.log(data)
//			alert(data.result);
			tr_doc = btn_doc.parentNode.parentNode;
			tab_doc = tr_doc.parentNode.parentNode;
			tab_doc.deleteRow(tr_doc.rowIndex);
//			location.reload();
			GET_num();
		},
		error:function(){
			alert("ajax error! + 删除失败！");
			window.location.reload();
		}
	});
}


/*下载*/
function dowload(id){
//	alert(id);
	openPostWindow('upload_file_num_ajax.php','_blank','dowload',id);
	
}

function openPostWindow(url, name, my_flag, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="my_flag";
     hideInput1.value = my_flag;
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

//文件抄送
function send(id){
//	alert(id);
	var my_url = "member.php?str_id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 700;
	var bro_width = 1200;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs);
}

//受理通知书单个确认
function advice_one(btn_doc){
//	alert(advice_id);
	advice_id = btn_doc.id;
	$.ajax({
		type:"post",
//		url:"advice_handle_test.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"advice_all",
			id_str:advice_id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			tr_doc = btn_doc.parentNode.parentNode;
//			tab_doc = tr_doc.parentNode.parentNode;
//			tab_doc.deleteRow(tr_doc.rowIndex);
//			var sl_result = document.getElementById("sl_result");
//			sl_result.innerHTML += '<tr><td style="border: 1px solid black;">'+data+'</td></tr>';
//			alert(data.msg+"\n"+data.del);
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}

//受理通知书一键确认
function advice_all(advice_id){
	var sure_1 = document.getElementById("sure_1");
	sure_1.hidden = "hidden";
//	alert(advice_id+"??");
	$.ajax({
		type:"post",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"advice_all",
			id_str:advice_id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			arr_id = advice_id.split(",");
//			for(ky in arr_id){
//				tr_doc = document.getElementById(arr_id[ky]).parentNode.parentNode;
//				
//			}
//			alert(data.msg+"\n"+data.del);
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}


//授权通知书单个确认
function impower_one(btn_doc){
//	alert(impower_id);
	impower_id = btn_doc.id;
	$.ajax({
		type:"post",
//		url:"impower_handle_test.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"impower_all",
			id_str:impower_id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			tr_doc = btn_doc.parentNode.parentNode;
//			tab_doc = tr_doc.parentNode.parentNode;
//			tab_doc.deleteRow(tr_doc.rowIndex);
//			alert(data.msg+"\n"+data.del);
//			location.reload();
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});	
}

//授权通知书一键确认
function impower_all(impower_id){
//	alert(id);
	var sure_2 = document.getElementById("sure_2");
	sure_2.hidden = "hidden";
	$.ajax({
		type:"post",
//		url:"impower_handle_test.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"impower_all",
			id_str:impower_id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			alert(data.msg+"\n"+data.del);
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});	
}

//缴费通知单个确认
function pay_one(id){
	$.ajax({
		type:"post",
//		url:"debit.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"debit",
			id_str:id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			alert(data.msg+"\n"+data.del);
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});	
}

//缴费通知一键确认
function pay(id){
	var sure_3 = document.getElementById("sure_3");
	sure_3.hidden = "hidden";
	$.ajax({
		type:"post",
//		url:"debit.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"debit",
			id_str:id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			alert(data.msg+"\n"+data.del);
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}

//权利终止通知书单个确认/结案
function termination_one(id){
//	alert(id);
	$.ajax({
		type:"post",
//		url:"termination.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"termination",
			id_str:id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			alert(data.msg+"\n"+data.del);
//			location.reload();
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}

//权利终止通知书一键确认/结案
function termination(id){
	var sure_4 = document.getElementById("sure_4");
	sure_4.hidden = "hidden";
	$.ajax({
		type:"post",
//		url:"termination.php",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"termination",
			id_str:id
		},
//		dataType:"json",
		success:function(data){
			alert(data);
//			alert(data.msg+"\n"+data.del);
//			location.reload();
			window.location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}


/*改变案件状态*/
function change(id){
//	alert(id);
	var my_url = "change.php?str_id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 600;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs);	
}
