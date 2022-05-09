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
//费用修改
function ChangeFare(id,flag){
	var Count = "fa"+id;
	var FName = "fn"+id;
	var StrBtn = "btn"+id;
	var BId = document.getElementById(StrBtn);//按钮id
	var CId = document.getElementById(Count);//费用金额id
//	var FId = document.getElementById(FName).innerHTML;//费用id
	if(flag == '修改'){//修改
		CId.readOnly = false;
		BId.value="保存";
		BId.style.color = 'red';
	}else{//保存
//		alert(fid.value+'/'+id);
		$.ajax({
			url:'CaseSave.php',
			type:'post',
			async:true,
			data:{
				MessC:CId.value,
				FId:id,
				flag:'change'
			},
			success:function(data){
				alert(data);
				console.log(data);
			}
		});
		CId.readOnly = true;
		BId.value="修改";
		BId.style.color = 'black';
	}
//	alert('ok');
}
//费用删除
function FareDel(btn_dom){
	var td_doc = btn_dom.parentNode;
	var tr_doc = td_doc.parentNode;
	var row_num = tr_doc.rowIndex;
	var tab = document.getElementById('jftable');
	var flagid = tab.rows[row_num].cells[5].innerHTML;//费用id
	$.ajax({
		url:'CaseSave.php',
		async:true,
		type:'post',
		data:{
			flag:'del',
			id : flagid
		},
		success:function(data){
			if(data){
//				id = id-1;
				tab.deleteRow(row_num);
			}else{
				alert(data);
				self.location='../../../login.php';
			}
		}
	});
}
//上传文件
function upfile(self_id){
	var myurl = "../upfile_pr.php"+"?self_id="+self_id;
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


//删除文件
function del_file(btn_doc){
	if(confirm("是否删除文件？")){
		id = btn_doc.id;
		btn_doc.onclick = null;
		$.ajax({
			type:"get",
			url:"CaseSave.php",
			async:true,
			data:{
				falg:"DelFile_info",
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
//替换文件
function change(btn_doc){
	if(confirm("是否确认替换当前文件？")){
		id = btn_doc.id;
		btn_doc.onclick = null;
		var myurl = "../change_file.php"+"?flag=pr&"+"id="+id;
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

	
//减行
function del_row(btn_doc){
	if(confirm("是否确认撤除?")){
		var tr_doc = btn_doc.parentNode.parentNode;
		var tab = document.getElementById("tab_che");
		tab.deleteRow(tr_doc.rowIndex);
	}
}
//获取监控默认数据
function chemess(obj){//查询监控名信息，并显示信息
	var val = obj.value;
	$.ajax({
		url:"CaseSave.php",
		async:true,
		type:"get",
		data:{
			Name:val,
			flag:'selectMes'
		},
		success:function(data){
			var count = document.getElementById('');
			dataA = data.split(',');
			var td_doc = obj.parentNode;
			var tr_doc = td_doc.parentNode;
			var row_num = tr_doc.rowIndex;
			tr_doc.cells[1].getElementsByTagName('input')[0].value = dataA[0];
			//计算提醒日期【当前时间】
			var myDate = new Date();
			var mytime = myDate.toLocaleDateString();
			mytimeA = mytime.split('/');
			
			if (mytimeA[1] < 10) month1 = "0" + mytimeA[1];  else{month1=mytimeA[1];}
			if (mytimeA[2] < 10) date1 = "0" + mytimeA[2]; else{date1=mytimeA[2];}
//			alert(mytimeA[0]+'-'+month1+'-'+date1);
			tr_doc.cells[3].getElementsByTagName('input')[0].value = mytimeA[0]+'-'+month1+'-'+date1;
			//计算截止日期
//			var mytimeA = ydate.split("-");
			var DayBtw = parseInt(dataA[1]);
	    var nDate = new Date(mytimeA[1] + '-' + mytimeA[2] + '-' + mytimeA[0]); //转换为MM-DD-YYYY格式    
	    var millSeconds = Math.abs(nDate) + (DayBtw * 24 * 60 * 60 * 1000);
	    var rDate = new Date(millSeconds);  
	    var year = rDate.getFullYear();  
	    var month = rDate.getMonth() + 1;  
	    if (month < 10) month = "0" + month;  
	    var date = rDate.getDate();  
	    if (date < 10) date = "0" + date;  
	    var ydate2 = year + "-" + month + "-" + date;
//		  alert(ydate2);
	    tr_doc.cells[4].getElementsByTagName('input')[0].value = ydate2;
		}
	});
}
//监控新建保存 --案件详情
function save_kj(btn_doc){
	btn_doc.onclick = null;
	var ajh = document.getElementById("ajh").value;//案卷号
	var tr_doc = btn_doc.parentNode.parentNode;
	var txday = tr_doc.cells[3].getElementsByTagName("input")[0].value;//提醒日期
	var jzday = tr_doc.cells[4].getElementsByTagName("input")[0].value;//截止日期
	if(txday!="" && jzday!=""){
		//获取信息
		var send_str = "";
		for(i=0;i<tr_doc.cells.length-1;i++){
			if(i!=2 && i!=0){
//				console.log(tr_doc.cells[i].getElementsByTagName("input")[0].value);
				send_str += tr_doc.cells[i].getElementsByTagName("input")[0].value + "|";
			}else if(i==0){
				send_str += tr_doc.cells[i].getElementsByTagName("select")[0].value + "|";
			}
		}
		send_str = send_str.substr(0,send_str.length-1);
//		console.log(send_str);//格式:监控名|金额|提醒日期|截止日期|备注
		//异步保存
		$.ajax({
			type:"get",
			url:"CaseSave.php",
			async:true,
			data:{
				flag:"new_monitor",
				ajh:ajh,
				send_str:send_str
			},
			success:function(data){
				alert("信息"+data);
//				console.log(data);
				if(data == "保存成功"){
					//异步保存文件
					var int_file = tr_doc.cells[2].getElementsByTagName("input")[0].files;
					if(int_file.length != 0){
						var fd = new FormData();
						fd.append("flag","new_monitor_upfile");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"CaseSave.php",
							data:fd,
							processData:false,
							contentType:false,
							success:function(data){
								console.log(data);
								alert("文件"+data);
								if(data == "保存成功"){
									//清除表格的操作
									var td_doc = btn_doc.parentNode;
									td_doc.innerHTML = "";
								}
							},
							error:function(xhr,status,xmlthrow){
								console.log("ajax error!"+status+xmlthrow);
							}
						});
					}else{
						alert("无文件上传!");
					}
				}
			},
			error:function(xhr,status,xmlthrow){
				console.log("ajax error!"+status+xmlthrow);
			}
		});
	}else{
		alert("请将“提醒日期”与“截止日期”填写完整!");
	}
}
//改变监控状态【即结束监控】
function ChangeSitu(id){
	$.ajax({
			type:"get",
			url:"CaseSave.php",
			async:true,
			data:{
				flag:"ChangeSitu",
				id:id
			},
			success:function(data){
				alert(data);
				location.reload();
//				console.log(data);
			},
			error:function(xhr,status,xmlthrow){
				console.log("ajax error!"+status+xmlthrow);
			}
		});
}
//证书登记与年费生成
function CerCheIn(ajh){
//	alert(ajh);
	var myurl = "info_zsdj.php?ajh="+ajh;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1300;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(myurl,"_blank",specs);
	var loop = setInterval(function() {
        if(winobj.closed) {
            clearInterval(loop);
            parent.location.reload();
        }
    }, 1);
}
    function DownFile_zip(cid){
//      alert(cid);
        var my_url = "DownloadFile_dateworks.php?id="+cid;
        window.open(my_url,"_blank");
    }
    //修改项目类型
    function changeCaseType(Text){
        var CaseId = document.getElementById("CaseId").value;//获取id
        $.ajax({
            url:'CaseSave.php',
            type:'get',
            async:true,
            data:{
                falg:'changeCaseType',//判断表格的依据
                order:Text,
                CaseId:CaseId
            },
            success:function(data){
                alert('案件类型修改成功');
            },
            error:function(e,t,s){
                alert('出现错误，请联系管理员');
            }
        });
    }
    //启动项目
    function OpenPro(){
        var CaseId = document.getElementById("CaseId").value;//获取id
        $.ajax({
            type:"get",
            url:"CaseSave.php",
            async:true,
            data:{
                falg:'OpenPro',
                CaseId:CaseId
            },
            success:function(data){
                window.location.reload();
            },
            error:function(e,t,s){
                alert(e);
            }
        });
    }
    //结束项目
    function EndPro(){
        var CaseId = document.getElementById("CaseId").value;//获取id
        $.ajax({
            type:"get",
            url:"CaseSave.php",
            async:true,
            data:{
                falg:'EndPro',
                CaseId:CaseId
            },
            success:function(data){
                window.location.reload();
            },
            error:function(e,t,s){
                alert(e);
            }
        });
    }
    //修改备注
    function ChangeBZ(){
        var CaseId = document.getElementById("CaseId").value;//获取id
        var CaseBz = document.getElementById("fs_bz").value;//获取备注
        if(confirm('备注信息已经发生改变，是否修改项目备注')){
            $.ajax({
                type:"get",
                url:"CaseSave.php",
                async:true,
                data:{
                    falg:'ChangeBZ',
                    CaseId:CaseId,
                    CaseBz:CaseBz
                },
                success:function(data){
                    alert('备注信息修改成功');
                },
                error:function(e,t,s){
                    alert(e);
                }
            });
        }
    }
