//选择案源人
function select_ayr(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					$("#"+id).attr("value",localStorage.ayr_name);
					localStorage.clear();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择代理人
function select_dlr(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					$("#"+id).attr("value",localStorage.dlr_name);
					localStorage.clear();
				}else{
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//替换案件相关人员
function changeCaseMan(tab){
    var Tab =document.getElementById(tab);
    var nrow = Tab.rows.length;
    //如果是对个案操作
    if(caseAyr_1.value.length || caseDlr_1.value.length){
        var caseNum = 0;
        var ayr = '';
        var dlr = '';
        for(i=1;i<nrow;i++){
            var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
            var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
            if(falg == true){
                $.ajax({
                    type:"POST",
                    url:"info_CasePeoChange_save.php",
                    async:false,
                    data:{
                        falg: "changeSelect",
                        ajh : ajh,
                        ayr : caseAyr_1.value,
                        dlr : caseDlr_1.value
                    },
                    success:function(data){
                        if(data){
                            caseNum++;
                        }
//                      alert(caseNum);
                    },
                    error:function(e){
                        alert('出现错误，请联系管理员，编码001');
                        return;
                    }
                });
            }
        }
        alert('成功修改案件'+caseNum+'件');
    }
    //如果是对全部案件操作
    if(caseAyr_2.value.length && caseAyr_3.value.length){
        var caseNum = 0;
        $.ajax({
            type:"POST",
            url:"info_CasePeoChange_save.php",
            async:false,
            data:{
                falg: "changeAYR",
                ayrO : caseAyr_2.value,
                ayrN : caseAyr_3.value
            },
            success:function(data){
                if(data){
                    caseNum++;
                }
            },
            error:function(e){
                alert('出现错误，请联系管理员，编码002');
                return;
            }
        });
        alert('成功修改案件案源人');
    }
    if(caseDlr_2.value.length && caseDlr_3.value.length){
        var caseNum = 0;
        $.ajax({
            type:"POST",
            url:"info_CasePeoChange_save.php",
            async:false,
            data:{
                falg: "changeDLR",
                dlrO : caseDlr_2.value,
                dlrN : caseDlr_3.value
            },
            success:function(data){
                if(data){
                    caseNum++;
                }
            },
            error:function(e){
                alert('出现错误，请联系管理员，编码003');
                return;
            }
        });
        alert('成功修改案件代理人');
    }
//  var output = caseAyr_1.value.length+'/'+caseDlr_1.value.length+'/'+caseAyr_2.value.length+'/'+caseAyr_3.value.length+'/'+caseDlr_2.value.length+'/'+caseDlr_3.value.length;
//  alert(output);
    clearAll();
}

//清空
function clearAll(){
    caseAyr_1.value = '';
    caseDlr_1.value = '';
    caseAyr_2.value = '';
    caseDlr_2.value = '';
    caseAyr_3.value = '';
    caseDlr_3.value = '';
}

//结案
function jiean(tab){
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var reason = "";//结案原因
	switch(tab){
		case 'dynamic-table'://专利案件
			reason = document.getElementById("reason_za").value;
			break;
		case 'dynamic-table_2'://无效案件
			reason = document.getElementById("reason_wx").value;
			break;
		case 'dynamic-table_3'://复审案件
			reason = document.getElementById("reason_fs").value;
			break;
		case 'dynamic-table_4'://年费案件
			reason = document.getElementById("reason_nf").value;
			break;
		default:
			alert('出现未知错误！');self.location='index.php';
	}
//	alert(nrow);
	var ajh_str = "";
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			ajh_str += ajh +",";
//			$.ajax({
//				type:"POST",
//				url:"index_action.php",
////				dataType:"json",
//				//传参
//				data:{
//					falg_1: "ja",
//					ajh: ajh,
//					tab:tab,
//					reason:reason
//				},
//				success:function(data){
////					if(data == 1){
////						
////					}
////					alert(data);
////					console.log(data);
//				},
//				error:function(){
////					alert("错误信息");
////					window.location.reload();
//				}
//			});
		}
	}
//	alert("结案成功");
//	window.location.reload();
	if(ajh_str.length != 0){
		ajh_str = ajh_str.substr(0,ajh_str.length-1);
		$.ajax({
			type:"POST",
			url:"index_action.php",
			async:false,
			data:{
				falg_1: "ja",
				ajh_str: ajh_str,
				tab:tab,
				reason:reason
			},
			success:function(data){
				console.log(data);
				alert(data);
				window.location.reload();
			},
			error:function(xhr,staues,XMLthrow){
				console.log("ajax error!"+staues + XMLthrow);
			}
		});
	}else{
		alert("无选中项！");
	}
}

//删除
function del(tab){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum2=0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		alert(falg+","+ajh+","+tab);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"index_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "del",
					ajh: ajh,
					tab:tab
				},
				success:function(data){
					RowNum2++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location.reload();
				}
			});
		}
	}
	if (RowNum2) {
		alert("删除成功");
		window.location.reload();
	} else{
		alert('请选中案件后再操作');
	}
//	alert("删除成功");
//	window.location.reload();
}
//恢复
function huif(tab){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum3=0;
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"index_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "huif",
					ajh: ajh,
					tab:tab
				},
				success:function(data){
					RowNum3++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location.reload();
				}
			});
		}
	}
	if (RowNum3) {
		alert("恢复成功");
		window.location.reload();
	} else{
		alert('请选中案件后再操作');
	}
//	alert("恢复成功");
//	window.location.reload();
}
//最终删除
function hid(tab){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum4=0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"index_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "hidden",
					ajh: ajh,
					tab:tab
				},
				success:function(data){
					RowNum4++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location.reload();
				}
			});
		}
	}
	if (RowNum4) {
		alert("最终删除成功");
		window.location.reload();
	} else{
		alert('请选中案件后再操作');
	}
//	alert("最终删除成功");
//	window.location.reload();
}

//导出选中行的Excel清单
//window.open的post传输数据函数
function openPostWindow(url, name, data, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="data";
     hideInput1.value = data;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="data2";
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
function Export_someExcel(tab_id,my_url){
	$send_id = "";
	$("#"+tab_id+" input").each(function(){
		if($(this).hasClass("box_son")){
			if($(this).attr("checked")){
				$send_id +=  "," + $(this).attr("id");
			}
		}
	});
	if($send_id != ""){
		$send_id = $send_id.substr(1,$send_id.length);
		console.log($send_id);
		openPostWindow(my_url,"_blank",$send_id);
//		setTimeout(function(){
//			location.reload();
//		},1000)
	}else{
		alert("没有选中行！");
	}
	
}

function Export_someExcel_2(tab_id,my_url){
	$send_id = "";
	$("#"+tab_id+" input").each(function(){
		if($(this).hasClass("box_son")){
			if($(this).attr("checked")){
				$send_id +=  "," + $(this).attr("ajh");
			}
		}
	});
	if($send_id != ""){
		$send_id = $send_id.substr(1,$send_id.length);
		console.log($send_id);
		openPostWindow(my_url,"_blank",$send_id);
//		setTimeout(function(){
//			location.reload();
//		},1000)
	}else{
		alert("没有选中行！");
	}
	
}

//清除查询条件
function Clear_checkdata(){
	$("#Checkformdata input[type='text']").attr("value","");
	$("#Checkformdata input[type='date']").attr("value","");
	$("#Checkformdata option[selected='selected']").attr("selected",false);
}
