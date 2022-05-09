//寄件登记页面
function new_send(){
	window.open("exdelmas_send.php","_self");
}

//收件登记页面
function new_arri(){
	window.open("exdelmas_arri.php","_self");
}

//数据增行
function tab_add(tab){
	var nrow = tab.rows.length;
	var ncol = tab.rows[2].cells.length;
	var newr = tab.insertRow(nrow);
//	alert(nrow+'/'+ncol);
	for(var i =0;i<ncol;i++){
		newr.insertCell(i).innerHTML = tab.rows[2].cells[i].innerHTML;
	}
}

//数据删减
function tab_del(tab){
	var nrow = tab.rows.length;
	var ncell= tab.rows[2].cells.length;
	for(var i =2;i<nrow;i++){
		var checkm = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
		if(checkm == true){
			tab.deleteRow(i);
			i--;
			nrow--;
		}
	}
}

//寄件记录添加保存
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
function save_add(){
	var conid = document.getElementById('conid');
	var save_one = document.getElementById("save_one");
	save_one.hidden = "hidden";
	var inp = document.getElementById("my_form").getElementsByTagName("input");
	send_str = '';
	for(i=0;i<inp.length;i++){
		send_str = send_str + inp[i].value + "||";
	}
	send_str = send_str.substr(0,send_str.length-2);
	var tmp_file = document.getElementById("jj_file").files;
//	alert(send_str);
	var fd = new FormData();
	fd.append("flag","save_one");
	fd.append("conid",conid.value);
	fd.append("send_str",send_str);
	if(tmp_file.length>0){
		fd.append("upfile",tmp_file[0]);
	}
	$.ajax({
		url:"exdelmas_save.php",
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
			if(data==1){
				setTimeout(function(){
					alert('数据保存成功');
					window.location.reload();
				},1000);
			}else{
				alert('数据保存失败，请联系管理员');
			}
		}
	});
}

//新增收件记录保存
//监督进度条
function uploadProgress_2(evt){
	if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		var file_list = document.getElementById("file_list_2");
		file_list.getElementsByTagName("strong")[0].innerHTML = '<span>'+percentComplete.toString()+'%</span>';
        var prog = file_list.getElementsByTagName('div')[0];
		var progBar = prog.getElementsByTagName('div')[0];
		progBar.style.width= 2*percentComplete+'px';
		progBar.setAttribute('aria-valuenow', prog.percent);
   }else {
    	var file_list = document.getElementById("file_list_2");
    	var prog = file_list.getElementsByTagName('div')[0];
        prog.getElementsByTagName("div")[0].innerHTML = '上传失败！';
    }
}
function save_add2(){
	var conid = document.getElementById('conid');
	var save_two = document.getElementById("save_two");
	save_two.hidden = "hidden";
	var inp = document.getElementById("my_form2").getElementsByTagName("input");
	send_str = '';
	for(i=0;i<inp.length;i++){
		send_str = send_str + inp[i].value + "||";
	}
	send_str = send_str.substr(0,send_str.length-2);
	var sj_file = document.getElementById("sj_file").files;
	var fd = new FormData();
	fd.append("flag","save_two");
	fd.append("conid",conid.value);
	fd.append("send_str",send_str);
	fd.append("upfile",sj_file[0]);
//	alert(send_str);
	$.ajax({
		url:"exdelmas_save.php",
		type:"post",
		data:fd,
		xhr:function(){
			myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',uploadProgress_2,false);
			}
			return myXhr;
		},
		processData:false,
		contentType:false,
		success:function(data){
			if(data==1){
				setTimeout(function(){
					alert('数据保存成功');
					window.location.reload();
				},1000);
			}else{
				alert('数据保存失败，请联系管理员');
			}
		}
	});
}

//数据删除
function mesdel(id){
	
}

//底单上传[寄件]
function upload_s(vid,my_flag){
//	alert(vid);
	var my_url = 'exdelmas_file.php?id='+vid + "&" + "my_flag=" + my_flag;
	var winobje = window.open(my_url,'_blank','height=600,width=1000,top=100,left=200');
	if(my_flag == "upload"){
		var loop = setInterval(function() {
	        if(winobje.closed) {
	            clearInterval(loop);
	            parent.location.reload();
	        }
	    }, 1); 		
	}
}

//底单上传[收件]
function upload_a(){
	alert('ok123');
}



//查看并修改信息-寄件
function check_msg(a_obj){
	$.ajax({
		type:"get",
		url:"exdelmas_save.php",
		async:true,
		data:{
			flag:"Getself_msg",
			self_id:a_obj.name
		},
		dataType:"json",
		success:function(data){
			$("#my_form3 input").each(function(i){
				if(i<10){
					$(this).attr("value",data["sqldata"][i]);
				}
			});
			$("#my_form3 input:eq(10)").attr("value",data["sqldata"]["文件名称"]);
			$("#my_form3 a").attr("href","Downloadfile.php?filename="+data["sqldata"]["底单地址"]);
		},
		error:function(x,s,t){
			alert("获取信息失败！");
			console.log("ajax error!"+s,t)
		}
	});
}

//查看并修改信息-收件
function check_msg2(a_obj){
	$.ajax({
		type:"get",
		url:"exdelmas_save.php",
		async:true,
		data:{
			flag:"Getself_msg",
			self_id:a_obj.name
		},
		dataType:"json",
		success:function(data){
			$("#my_form4 input").each(function(i){
				if(i<10){
					$(this).attr("value",data["sqldata"][i]);
				}
			});
			$("#my_form4 input:eq(10)").attr("value",data["sqldata"]["文件名称"]);
			$("#my_form4 a").attr("href","Downloadfile.php?filename="+data["sqldata"]["底单地址"]);
		},
		error:function(x,s,t){
			alert("获取信息失败！");
			console.log("ajax error!"+s,t)
		}
	});
}


//修改信息的保存-寄件
//监督进度条
function uploadProgress_3(evt){
	if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		var file_list = document.getElementById("file_list_3");
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
function Change_save(btn_obj){
	$(btn_obj).addClass("hidden");
	
	send_str = '';
	$("#my_form3 input").each(function(i){
		if(i<11){
			send_str += "#$#"+$(this).attr("value");
		}
	});
	if(send_str != ""){
		send_str = send_str.substr(3);
		console.log(send_str);
		
		var tmp_file = document.getElementById("changfile_jj").files;
		var fd = new FormData();
		fd.append("flag","Chang_save");
		fd.append("send_str",send_str);
		if(tmp_file.length>0){
			fd.append("upfile",tmp_file[0]);
		}
		$.ajax({
			url:"exdelmas_save.php",
			type:"post",
			data:fd,
			xhr:function(){
				myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener('progress',uploadProgress_3,false);
				}
				return myXhr;
			},
			processData:false,
			contentType:false,
			dataType:"json",
			success:function(data){
				if(data["result"]){
					setTimeout(function(){
						alert('数据保存成功');
						window.location.reload();
					},1000);
				}else{
					alert('数据保存失败，请联系管理员');
				}
			}
		});
	}else{
		alert("获取数据失败！");
	}
}

//修改信息的保存-收件
//监督进度条
function uploadProgress_4(evt){
	if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		var file_list = document.getElementById("file_list_4");
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
function Change_save2(btn_obj){
	$(btn_obj).addClass("hidden");
	
	send_str = '';
	$("#my_form4 input").each(function(i){
		if(i<11){
			send_str += "#$#"+$(this).attr("value");
		}
	});
	if(send_str != ""){
		send_str = send_str.substr(3);
		console.log(send_str);
		
		var tmp_file = document.getElementById("changfile_sj").files;
		var fd = new FormData();
		fd.append("flag","Chang_save");
		fd.append("send_str",send_str);
		if(tmp_file.length>0){
			fd.append("upfile",tmp_file[0]);
		}
		$.ajax({
			url:"exdelmas_save.php",
			type:"post",
			data:fd,
			xhr:function(){
				myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener('progress',uploadProgress_4,false);
				}
				return myXhr;
			},
			processData:false,
			contentType:false,
			dataType:"json",
			success:function(data){
				if(data["result"]){
					setTimeout(function(){
						alert('数据保存成功');
						window.location.reload();
					},1000);
				}else{
					alert('数据保存失败，请联系管理员');
				}
			}
		});
	}else{
		alert("获取数据失败！");
	}
}
