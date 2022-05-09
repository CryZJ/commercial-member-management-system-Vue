//清除模态框的内容
function ClearModal(div_doc,str_noclear){
	var inp_doc = document.getElementById(div_doc).getElementsByTagName("input");
	for(i=0,len=inp_doc.length;i<len;i++){
//		console.log(str_noclear.indexOf(i)+"\n");
		if(str_noclear.indexOf(i) == "-1"){
			inp_doc[i].value = "";
		}
	}
}

//获取新增客户记录
function GetDate_new(div_doc){
	var inp_doc = document.getElementById(div_doc).getElementsByTagName("input");
	var str_data = "";
	for(i=0,len=inp_doc.length;i<len;i++){
		str_data += inp_doc[i].value + "#$#";
	}
	if(str_data!=""){
		str_data.substr(0,str_data.length-3);
		SaveAjax_data("ClieMag_ajax.php","add_new",str_data);
	}
}

function SaveAjax_data(ajax_url,ajax_flag,str_data){
	$.ajax({
		type:"get",
		url:ajax_url,
		async:true,
		data:{
			flag_ajax:ajax_flag,
			str_data:str_data
		},
		success:function(data){
			alert(data);
//			console.log(data);
			window.location.reload();
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("保存失败！");
			console.log("ajax error!"+errorstatus+errorThrow);
		}
	});
}

//打开新增客户记录的界面
function OpenWin_New(){
	var myurl = "ClieMag_New.php?khid=0";
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 600;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winObj = window.open(myurl,"_blank");
	 var loop = setInterval(function() {
        if(winObj.closed) {
            clearInterval(loop);
            parent.location.reload();
        }
    }, 1);
}

//查看与修改
function Check_alter(id){
	var myurl = "ClieMag_New.php?khid="+id;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 600;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winObj = window.open(myurl,"_blank");
	 var loop = setInterval(function() {
        if(winObj.closed) {
            clearInterval(loop);
            parent.location.reload();
        }
    }, 1);
}

//删除
function Delete_data(id){
	if(confirm("是否确认删除改客户？")){
		$.ajax({
			type:"get",
			url:"ClieMag_ajax.php",
			async:true,
			data:{
				flag_ajax:"del",
				self_id:id
			},
			success:function(data){
				alert(data);
				location.reload();
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("删除失败！");
				console.log("ajax error!"+errorstatus+errorThrow);
			}
		});
	}
}
