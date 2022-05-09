//增加负责人
function addfzr(){
	var tab = document.getElementById('tab_peo');
	var tablen = tab.rows.length;
	var newRow = tab.insertRow(tablen-1);
	newRow.insertCell(0).innerHTML = tablen-1;
	newRow.insertCell(1).innerHTML = '<input type="text" id="fzr'+(tablen-1)+'" hidden="hidden" /><input type="text" id="'+(tablen-1)+'" onclick="select_fzr('+(tablen-1)+')" readonly="readonly" />';
	newRow.insertCell(2).innerHTML = '';
	newRow.insertCell(3).innerHTML = '';
	newRow.insertCell(4).innerHTML = '<input type="button" value="保存" id="save'+(tablen-1)+'" onclick="save('+(tablen-1)+')" />';
	newRow.insertCell(5).hidden = true;//隐藏id行
//	newRow.insertCell(5).innerHTML = 'true';
//	alert('ok');
}
//选择负责人
function select_fzr(id){
	var fzr = document.getElementById(id);
	var fzrid = document.getElementById('fzr'+id);
	
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
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					var fzr_mas = return_data.split("/");
					fzr.value = fzr_mas[1];
					fzrid.value = fzr_mas[0];
					
					localStorage.clear();
				}else{
					dlr.value = '';
					alert("未选中客户！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//删除负责人
function del(id){
	var tab = document.getElementById('tab_peo');
	var fzrid = tab.rows[id].cells[5].innerHTML;
	$.ajax({
		type:"get",
		url:"info_chag.php",
		async:true,
		data:{
			id:fzrid,
			flag:'del'
		},
		success:function(data){
			tab.deleteRow(id);
		}
	});
	
//	alert(fzrid);
}
//保存负责人
function save(id){
	var idT = 'fzr'+id;
	var fzr = document.getElementById(id).value;//负责人
	var fzrid = document.getElementById(idT).value;//负责人id
	var ajh = document.getElementById('ajhT').value;//案卷号
	var czy = document.getElementById('useid').value;//操作员id
	var czyname = document.getElementById('useer').value;//操作员
	$.ajax({
		url:'SC_fzr.php',
		async:true,
		type:'get',
		data:{
			fzr:fzr,
			ajh:ajh,
			czy:czyname,
			flag:'save'
		},
		success:function(data){
			if(data){
				var tab = document.getElementById('tab_peo');
//				data_str = data.split('/');
				tab.rows[id].cells[1].innerHTML = fzr;
				tab.rows[id].cells[2].innerHTML = data;
				tab.rows[id].cells[3].innerHTML = czyname;
				tab.rows[id].cells[4].innerHTML = '<input type="button" value="删除" id="del'+id+'" onclick="del('+id+')" />';
				tab.rows[id].cells[5].innerHTML = '';
			}else{
				console.log(data);
			}
		}
	});
}

//上传文件
function upfile(ajh){
	var myurl = "../upfile_wx.php"+"?ajh="+ajh;
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

//删除无效案件的文件
function del_wx(btn_doc){
	id = btn_doc.id;
	btn_doc.onclick = null;
	if(confirm("是否删除文件？")){
		$.ajax({
			type:"get",
			url:"../del_file.php",
			async:true,
			data:{
				flag:"wuxiao",
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

//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=wx&"+"id="+id;
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
