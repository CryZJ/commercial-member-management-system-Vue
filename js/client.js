

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

//打开新建客户页面【保存成功后不需要刷新页面】
function client_new(){
	//alert("test!");
	var winopen = window.open('client_new.php','_blank');
	var loop = setInterval(function(){
		if(winopen.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1);
	
}

//点击添加文件
//document.getElementById("add_select").addEventListener("click",function(){
//	var tmp_file = document.getElementById("tmp_file");
//	tmp_file.click();
//});

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

//异步检测申请人是否已存在，匹配字段：姓名，证件号
function check_per(){
	$.ajax({
		type:"post",
		url:"client_save.php",
		async:true,
		dataType:"json",
		data:{
			flag:"check_per",
			name:document.getElementById("per_name").value,
			zjh:document.getElementById("per_zjh").value
		},
		success:function(data){
//			console.log(data);
			if(data['flag'] == "11"){
				alert(data['msg']+"\n无法保存此次的申请人信息！");
			}else if(data['flag'] != "00"){
				if(confirm(data['msg']+"\n是否确定要保存？")){
					Save_client();
				}
			}else{
				Save_client();
			}
		},
		error:function(xhr,status,XMLthrow){
			console.log("ajax error！"+status + XMLthrow);
		}
	});
}

//保存申请人身份证件的函数
/*参数：对应id的值，表的字段
 */
//function Savefile_person(id_value,flag_msg,sqrid){
//	//上传身份相关的文件
//	var file_doc = document.getElementById(id_value).files;
//	if(file_doc.length != 0){
//		var fd = new FormData();
//		fd.append("flag","person_info");
//		fd.append("msg",flag_msg);
//		fd.append("sqrid",sqrid);
//		fd.append("upfile",file_doc[0]);
//		$.ajax({
//			url:"client_save.php",
//			type:"POST",
//			processData:false,
//			contentType:false,
//			data:fd,
//			success:function(data){
//				console.log(data);
//			},
//			error:function(){
//				console.log("ajax error!");
//			}
//		});
//	}
//}
//保存新建申请人
function Save_client(){
		//获取操作人数据
	//	var czy = document.getElementById('czy').value;//获取操作员信息	ajSt
		var czy = document.getElementById('ayrid').value;//案源人id
		var ajSt = document.getElementById('ajSt').innerHTML;//申请人类型
//		alert(ajSt);
		//获取申请人数据
		var tab = document.getElementById("tab_1"); //上一页面table id =tab_1
		var nrow = tab.rows.length;//获取表格行数
		var sqr = new String();//创建字符串，把数据连成以“/”分割的字符串
		
		var name = tab.rows[1].cells[0].getElementsByTagName('input')[0].value;//名字
		var enna = tab.rows[1].cells[1].getElementsByTagName('input')[0].value;//英文名
		var idnu = tab.rows[1].cells[2].getElementsByTagName('input')[0].value;//证件号
		var cory = tab.rows[1].cells[3].getElementsByTagName('input')[0].value;//国籍
		var maid = tab.rows[1].cells[4].getElementsByTagName('input')[0].value;//邮政编码
		var cony = tab.rows[1].cells[5].getElementsByTagName('input')[0].value;//费减年度
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
		var ades = tab.rows[2].cells[1].getElementsByTagName('input')[0].value
		var adesE = tab.rows[3].cells[0].getElementsByTagName('input')[0].value
		if(nrow>4){
			for(var i=4;i<nrow;i++){
				var info = tab.rows[i].cells[0].getElementsByTagName('input')[0].value;
				if(info.length<2){
				}else{
					ades = ades+'/'+info;
				}
			}
		}
	//	alert(ades);
		
		//获取发明人数据
		var Tab_1=document.getElementById("tab_2");//上一页面table id =tab_2
		var nrow_1 = Tab_1.rows.length;
		var ncell_1 = Tab_1.rows[1].cells.length;
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
	
		//获取备注
		var sqr_bz = document.getElementById("sqr_bz").value;
	
		$.ajax({
			url:"client_save.php",
			type:"post",
			asycn:true,
			data:{
				flag:"savedata",
				sqr:sqr,
				fmr:fmr,
				lxr:lxr,
				bz:sqr_bz,
				conid:czy,
				ades:ades,
				adesE:adesE,
				ajSt:ajSt	//申请人类型
			},
			dataType:"json",
			success:function(data){
//				alert(data["result"]);
				if(data["result"]){
					alert('数据保存成功');
					var save_btn = document.getElementById("save_btn");
					//判断是否已经点击保存按钮，yes已保存
					save_btn.onclick = null;
					var sqrid = data['sqrid'];
//					//上传身份相关的文件
//					Savefile_person("IDO","证件图",sqrid);
//					Savefile_person("IDT","证件翻",sqrid);
//					Savefile_person("TRO","营业执照图",sqrid);
//					Savefile_person("TRT","营业执照翻",sqrid);
					//开始上传文件
					
					var tmp_file = document.getElementById("tmp_file").files;
					if(tmp_file.length != 0){
//						var fd = new FormData();
						fd_file.append("flag","uploadfile");
						fd_file.append("sqrid",sqrid);
						var inp = document.getElementById("file_list").getElementsByTagName("input");
						var des = new Array();
						for(var i=0;i<inp.length;i++){
							if(inp[i].value.length == 0){
								des[i] = "无";
							}else{
								des[i] = inp[i].value;
							}
//							fd_file.append(i,tmp_file[i]);
						}
						fd_file.append("des",des);
						
						$.ajax({
							url:"client_save.php",
							type:"POST",
							xhr:function(){
							myXhr = $.ajaxSettings.xhr();
								if(myXhr.upload){
									myXhr.upload.addEventListener('progress',uploadProgress,false);
								}
								return myXhr;
							},
							processData:false,
							contentType:false,
							data:fd_file,
							success:function(data){
								setTimeout(function(){
									alert(data);
								},1000);
							},
							error:function(){
								console.log("ajax error!");
							}
						});
					}else{
						alert("无其他文件上传");
					}
				}else{
					alert('数据保存失败，请联系管理员');
				}
			}
	});
}

//删除申请人
function del_client(btn_doc){
	if(confirm("是否确认删除？")){
		var id = btn_doc.id;
		btn_doc.onclick =null;
		$.ajax({
			type:"post",
			url:"client_save.php",
			async:true,
			data:{
				flag:"del_client",
				id  : id
			},
			success:function(data){
				alert($.trim(data));
	//			console.log(data);
	        	window.location.reload();
	//      	td_doc = btn_doc.parentNode;
	//      	tr_doc = td_doc.parentNode;
	//      	var dynamic = document.getElementById("dynamic-table");
	//      	dynamic.deleteRow(tr_doc.rowIndex);
			},
			error:function(xhr,staues,XMLthrow){
				console.log(xhr+staues+XMLthrow);
			}
		});
	}
}

//恢复申请人
function reply_client(btn_doc){
	var id = btn_doc.id;
	btn_doc.onclick =null;
	$.ajax({
		type:"post",
		url:"client_save.php",
		async:true,
		data:{
			flag:"reply_client",
			id  : id
		},
		success:function(data){
			if(data == "该申请人已存在,不用恢复"){
				alert($.trim(data));
			}else{
				alert($.trim(data));
				window.location.reload();
			}
			
//			console.log(data);
//      	td_doc = btn_doc.parentNode;
//      	tr_doc = td_doc.parentNode;
//      	var dynamic = document.getElementById("dynamic-table");
//      	dynamic.deleteRow(tr_doc.rowIndex);
		},
		error:function(xhr,staues,XMLthrow){
			console.log(xhr+staues+XMLthrow);
		}
	});	
}



//打开申请人查看页面
function Open_altertocheck_sqr(my_url){
	var winobj = window.open(my_url,"_blank");
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	});
}

