function czySave(){
//	alert("nzbx");
	var Tab =document.getElementById("tab_2");
	var nrow = Tab.rows.length;
	var ncell = Tab.rows[1].cells.length;
	var bh= new String();
	var czyid = document.getElementById("czyid").value;
	for(var i=1;i<nrow;i++){
		for(var y=0;y<ncell;y++){
			var falg = Tab.rows[i].cells[y].getElementsByTagName("input")[1].checked;
//			alert(falg);
			if(falg){
				var hh = Tab.rows[i].cells[y].getElementsByTagName("input")[0].value;
				bh += hh +"|";
			}
		}
	}
	bh = bh.substring(0,bh.length-1);
//获取权限信息
	var sysper = new Number();
	var fcoper = new Number();
	var tab = document.getElementById('tab');//确定表格
	var che = tab.rows[1].cells[0].getElementsByTagName('input')[0].checked;
	if(che == true){
		sysper = 1;
	}else{
		sysper = 0;
	}
	var che = tab.rows[2].cells[0].getElementsByTagName('input')[0].checked;
	if(che == true){
		fcoper = 1;
	}else{
		fcoper = 0;
	}

	if(bh){
		$.ajax({
			type:"POST",
			url:"userSave.php",
//				dataType:"json",
			//传参
			data:{
				czyid: czyid, 
				bh: bh,
				sysper:sysper,
				fcoper:fcoper,
				flag:'change'
			},
			success:function(data){
				alert(data);
//				document.getElementById('error').value=data;
			}
		});
	}else{
		alert("请选择案源人/代理人！");
	}
}
//权限显示
function ShowSysSet(){
	var czyid = document.getElementById('czyid').value;
	$.ajax({
		url:'userSave.php',
		type:'post',
		async:true,
		data:{
			czyid:czyid,
			flag:'show'
		},
		success:function(data){
			var AData = data.split('/');
//			alert(AData);
			var SysSet = document.getElementById('SysSet');
			var FcoSet = document.getElementById('FcoSet');
			if(AData[0] == '0'){//判断是不是有系统设置权限
				SysSet.checked = 0;
			}else{
				SysSet.checked = 1;
			}
			if(AData[1] == '0'){//判断是不是有财务权限
				FcoSet.checked = 0;
			}else{
				FcoSet.checked = 1;
			}
		}
	});
}

//全选
function selectAll(){
 	var checklist = document.getElementsByName("selected");
 	var selall = document.getElementById("sa");
 	var selzer = document.getElementById("sz");
 	
   	if(1){
   		y=1;
	   	for(var i=0;i<checklist.length;i++){
	   		
	   		var dlid = "dlid["+y+"]";
	   		var dlrid = document.getElementById(dlid);
//	   		alert(dlrid.value.length);
	   		if(dlrid.value.length == 0 ){
	   			checklist[i].checked = 0;
	   		}else{
	   			checklist[i].checked = 1;
	   		}
			y++;
	   	}
   	}
   	selzer.style.visibility = "visible";
   	selall.style.visibility = "hidden";
}

//取消全选
function selectzer(){
	var checklist = document.getElementsByName("selected");
 	var dlid = document.getElementsByName("dlid");
 	var selall = document.getElementById("sa");
 	var selzer = document.getElementById("sz");
   	if(1){
	   	for(var i=0;i<checklist.length;i++){
//	   		alert(dlid.value.length);
   			checklist[i].checked = 0;
	   	}
   	}
   	selzer.style.visibility = "hidden";
   	selall.style.visibility = "visible";
}

function skip(id){
	var id=id;
	var ur = "czyconcise.php?id="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 900;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(ur,"_blank",specs);
}
//反选
function selectAnti(){
//	alert('ok');
	var tab = document.getElementById('tab_2');	
	var che = document.getElementsByName('selected');
	for (var i=0;i<che.length;i++) {
		che[i].checked = !che[i].checked;
//		if(che[i].checked){
//			che[i].checked = !che[i].checked;
//		}else{
//			che[i].checked = !che[i].checked;
//		}
	}
}
