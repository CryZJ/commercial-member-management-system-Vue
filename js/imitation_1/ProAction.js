//删除
function del(tab){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum2 = 0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var CheBox = Tab.rows[i].cells[0].getElementsByTagName("input")[0];
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var id = document.getElementById(tab).rows[i].cells[0].getElementsByTagName("input")[0].id;
		if(falg == true){
			RowNum2++;
//			alert(id);
			$.ajax({
				type:"get",
				url:"CaseSave.php",
				async:false,
				//传参
				data:{
					falg: "del",
					id: id
				},
				success:function(data){
					
//					alert(RowNum2);
//					alert('ok');
				},
				error:function(e,t,s){
				}
			});
		}
	}
	if (RowNum2) {
		alert("删除成功");
		window.location="ProReport.php";
	} else{
		alert('请选中案件后再操作');
	}
}
//最终删除
function hid(tab){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum4=0;
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var id = document.getElementById(tab).rows[i].cells[0].getElementsByTagName("input")[0].id;
		if(falg == true){
			RowNum4++;
			$.ajax({
				type:"get",
				url:"CaseSave.php",
				async:false,
				//传参
				data:{
					falg: "hidden",
					id: id
				},
				success:function(data){
					
				},
				error:function(e,t,s){
				}
			});
		}
	}
	if (RowNum4) {
		alert("最终删除成功");
		window.location="ProReport.php";
	} else{
		alert('请选中案件后再操作');
	}
}

//打开新建页面
function Open_add(my_url,name){
	var winobj = window.open(my_url,name);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	})
}

//打开共享文件的上传界面
function Upsharefile(ajax_flag){
	var myurl = "upfile_gl.php?ajax_flag="+ajax_flag;
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