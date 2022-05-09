//全选功能
var sel_all = document.getElementById("sel_all");
var tab_info = document.getElementById("tab_info");

sel_all.addEventListener("click",function(){
	if(sel_all.checked == true){
		var row_tab = tab_info.rows.length;
		for(i=0;i<row_tab;i++){
			tab_info.rows[i].cells[0].getElementsByTagName("input")[0].checked = true;
		}
	}else{
		var row_tab = tab_info.rows.length;
		for(i=0;i<row_tab;i++){
			tab_info.rows[i].cells[0].getElementsByTagName("input")[0].checked = false;
		}		
	}
});

//添加保存功能
var save_add = document.getElementById("save_add");
var my_input = document.getElementById("my_form").getElementsByTagName("input");
save_add.addEventListener("click",function(){
	if(my_input[0].value!=''){
		var str_send = my_input[0].value;
//		alert(str_send);
		$.ajax({
			data:{
				my_flag:"save_add",
				str_send:str_send
			},
			type:"post",
			url:"ZLCase_ajax.php",
			async:true,
			dataType:"json",
			success:function(data){
				if(data['result']=="success"){
					alert("保存成功！");
					location.reload();
				}else{
					alert("保存失败！");
				}
			},
			error:function(){
				alert("新类型添加失败！");
			}
		});		
	}else{
		alert("请检查数据是否有空！");
	}
});

//删除功能
var del = document.getElementById("del");

del.addEventListener("click",function(){
	var row_tab = tab_info.rows.length;
	var id_send = new String();
	var num = 0;
	for(i=0;i<row_tab;i++){
		if(tab_info.rows[i].cells[0].getElementsByTagName("input")[0].checked == true){
			id_send = id_send + tab_info.rows[i].cells[1].innerHTML + ",";
			num++;
		}
	}
	id_send = id_send.substr(0,id_send.length-1);
//	alert(id_send);
	if(num!=0){
		$.ajax({
			data:{
				my_flag:"del_handle",
				num:num,
				id_send:id_send
			},
			type:"post",
			url:"ZLCase_ajax.php",
			async:true,
			dataType:"json",
			success:function(data){
	//			alert(data);
				if(data['result']=="success"){
					alert("删除成功！");
					location.reload();
				}else{
					alert("删除失败！");
					location.reload();
				}
			},
			error:function(){
				alert("ajax error! + 删除失败！")
			}
		});		
	}else{
		alert("请勾选条目！");
	}
});

////修改功能
//function open_detail(id_self){
//	my_url = "bank_detail.php?id_self="+id_self+"&"+"my_flag=alter";
//	var scr_height = window.screen.availHeight;
//	var scr_width = window.screen.availWidth;
//	var bro_height = 400;
//	var bro_width = 600;
//	var top = (scr_height-bro_height)/2;
//	var left = (scr_width-bro_width)/2;
//	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
//	var flag = window.open(my_url,"_blank",specs,false);
//	 
//}


















