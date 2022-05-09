//打开选择案源人窗口
function select_ayr(id){
	var ayr = document.getElementById(id);
	var ayrid = document.getElementById('ayrid');
	
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
					$.ajax({
						type:"get",
						url:"client_save.php",
						data:{
							flag:"GET_ayr_userid",
							ayrid:localStorage.ayr_id
						},
						async:true,
						success:function(data){
							var ayrid = document.getElementById('ayrid');
							ayrid.value = data;
						},
						error:function(){
							
						}
					});
					ayr.value = localStorage.ayr_name;
					
					localStorage.clear();
				}else{
					ayr.value = '';
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//打开新建客户页面
function client_new(){
	//alert("test!");
	var r = window.open('client.php');
	if(r=="refresh"){
		window.location.reload();//刷新父页面
	}
	
}
//
////创建ajax对象
//function getxmlhttp(){
//	var xmlhttp;
//	if(window.XMLHttpRequest){
//		xmlhttp = new XMLHttpRequest();
//	}else{
//		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//	}
//	return xmlhttp;
//}

//保存client_mod.php的数据
function Mod_client(){
//	//获取申请人信息
	var id = document.getElementById('id').value;
	var ssid = document.getElementById('ssid').value;
	var userid = document.getElementById('user').value;
	var ayrid = document.getElementById("ayrid").value;
//	var Tab = document.getElementById("tab_1"); //上一页面table id =tab_1
//	var nrow = Tab.rows.length;
//	var ncell = Tab.rows[1].cells.length;
//	var sqr = new String();//创建字符串，把数据连成以“/”分割的字符串
//	for(var i=0;i<ncell;i=i+1){
//		sqr = sqr+Tab.rows[1].cells[i].getElementsByTagName('input')[0].value+"/";
//	}
//	alert(1);
	//获取申请人信息
	var tab = document.getElementById("tab_1"); //上一页面table id =tab_1
	var nrow = tab.rows.length;//获取表格行数
	var sqr = new String();//创建字符串，把数据连成以“/”分割的字符串
	
	var name = tab.rows[1].cells[0].getElementsByTagName('input')[0].value;//名字
	var enna = tab.rows[1].cells[1].getElementsByTagName('input')[0].value;//英文名
	var idnu = tab.rows[1].cells[2].getElementsByTagName('input')[0].value;//证件号
	var cory = tab.rows[1].cells[3].getElementsByTagName('input')[0].value;//国籍
	var maid = tab.rows[1].cells[4].getElementsByTagName('input')[0].value;//邮政编码
	var cony = tab.rows[1].cells[5].getElementsByTagName('input')[0].value;//费减年度
	
//	var coun = tab.rows[1].cells[6].getElementsByTagName('input')[0].value;//费减比例
	var coun = tab.rows[1].cells[6].getElementsByTagName('select')[0].value;//费减比例
//	var allm = name+'/'+enna+'/'+idnu+'/'+cory+'/'+maid+'/'+cony+'/'+coun;
//	alert(allm);
	if(name.length==0||idnu.length==0||cory.length==0||cony.length==0){
		alert('请将申请人的重要信息填写完整');
		return;
	}else{
		sqr = name+'/'+enna+'/'+idnu+'/'+cory+'/'+maid+'/'+cony+'/'+coun;//申请人基本信息
	}
	//获取地址
	var ades_base = "";
	ades_base = tab.rows[2].cells[1].getElementsByTagName('input')[0].value;//中文地址
	if(tab.rows[3].cells[0].getElementsByTagName('input')[0].value){
		ades_base += "/" + tab.rows[3].cells[0].getElementsByTagName('input')[0].value;//英文地址
	}else{
		ades_base += "/" + "无";//英文地址
	}
	
	
	ades = "";
	if(nrow>4){
		for(var i=4;i<nrow;i++){
			var info = tab.rows[i].cells[0].getElementsByTagName('input')[0].value;
			if(info.length<2){
			}else{
				ades = ades+'/'+info;
			}
		}
	}
	if(ades){
		ades = ades.substr(1);
	}
	
	console.log(ades_base + "\n" +ades);
	//获取备注
	var sqr_bz = document.getElementById("sqr_bz").value;
//	alert(sqr_bz);
	//获取发明设计人
	var Tab_1=document.getElementById("tab_2");//上一页面table id =tab_2
	var nrow_1 = Tab_1.rows.length;
//	alert(nrow_1);
	var ncell_1 = Tab_1.rows[1].cells.length;
//	alert(ncell_1);
	var fmr = new String();//创建字符串，把数据连成以“/”分割的字符串
	for(var y=2;y<nrow_1;y++){
		for(var i=1;i<ncell_1;i++){
			var info2 = Tab_1.rows[y].cells[i].getElementsByTagName('input')[0].value;
			//检测数据是否为空，为空则退出保存操作
			if(info2.length>0){
				fmr = fmr+info2+'/';
			}else{
				alert('请将发明设计人信息填写完整');
				return;
			}
		}
		fmr = fmr.substring(0,fmr.length-1);
		fmr += ',';
	}
	fmr = fmr.substring(0,fmr.length-1);//删去','
//	alert(fmr);

//	获取联系人
	var Tab_2 = document.getElementById("tab_3"); //上一页面table id =tab_3
	var nrow_2 = Tab_2.rows.length;
	var ncol = Tab_2.rows[0].cells.length;
	var lxr = new String();  //创建字符串，把数据连成以“/”分割的字符串
	for(var z=2;z<nrow_2;z++){//行循环
		if(Tab_2.rows[z].cells[1].getElementsByTagName('input')[0].value.length>0){
			for(var n = 1;n<ncol;n++){//列循环
				lxr += Tab_2.rows[z].cells[n].getElementsByTagName('input')[0].value+'/';
			}
			lxr = lxr.substring(0,lxr.length-1);//删去'/'
			lxr+=',';
		}
	}
	lxr = lxr.substring(0,lxr.length-1);//删去','
//	lxr = lxr.substring(0,lxr.length-1);
//	alert(sqr+','+ades+','+ssid+','+userid);
//	alert(fmr+'   '+lxr);
	
	$.ajax({
		url:"client_mod.php",
		type:"post",
		async:true,
		data:{
			id:id,
			userid:userid,
			ssid:ssid,
			sqr:sqr,
			fmr:fmr,
			lxr:lxr,
			bz:sqr_bz,
			ades:ades,
			ades_base:ades_base,
			ayrid:ayrid
		},
		success:function(data){
			data = data.replace(/\s/ig,'');//去掉空格
			alert(data);
			window.close();
//			window.location.reload();
//			sqr_bz.value = data;
//			alert(data);
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			alert('修改失败，请联系管理员');
		}
	});
}

//删除文件
function del_file(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id;
	if(confirm("是否确认删除文件？")){
		$.ajax({
			type:"get",
			url:"del_file.php",
			async:true,
			data:{
				flag:"ajdj",
				id:id
			},
			success:function(data){
				alert(data);
				self.location.reload();
			},
			error:function(){
				console.log("ajax error!");
			}
		});
	}
}

//上传文件
function up_file(self_id){
	var myurl = "upfile.php"+"?id="+self_id;
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

//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "change_file.php"+"?flag=sqr&"+"id="+id;
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
}

//替换身份的文件函数
function Change_2(btn_doc){
	if(confirm("是否确认替换文件？")){
		id = $(btn_doc).attr("id");
		my_idflag = $(btn_doc).attr("my_flag");
//		alert(id+my_idflag);
		var myurl = "change_file_2.php"+"?flag=sqr_idfile&"+"id="+id+"&idflag="+my_idflag;
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
}
