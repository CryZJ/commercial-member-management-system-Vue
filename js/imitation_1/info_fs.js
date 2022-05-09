//选择申请人
function select_sqr(){
    var scr_height = window.screen.availHeight;
    var scr_width = window.screen.availWidth;
    var bro_height = 500;
    var bro_width = 1000;
    var top = (scr_height-bro_height)/2;
    var left = (scr_width-bro_width)/2;
    var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
    var winobj = window.open("../../../select_sqr_more.php","_blank",specs);
    var loop = setInterval(function(){
        if(winobj.closed){
            clearInterval(loop);
//          var CChoose = confirm('已经选择申请人，是否修改案件申请人');
//          if(CChoose){
                if(typeof(Storage)!=="undefined"){
                    if(localStorage.return_data){
                        var sqrid = document.getElementById('sqrid');
                        //删除申请人表的数据
                        var Tab_sqr = document.getElementById('tab_sqr');
                        var tab_len = Tab_sqr.rows.length;
                        if(tab_len > 1){
                            for(var i=1;i<tab_len;i++ ){
                                Tab_sqr.deleteRow(1);
                            }
                        }
                        //删除联系人表的数据
                        var tab_lxr = document.getElementById('tab_lxr');
                        var tab_lenl = tab_lxr.rows.length;
                        if(tab_lenl > 1){
                            for(var i=1;i<tab_lenl;i++ ){
                                tab_lxr.deleteRow(1);
                            }
                        }
                        var arr = localStorage.return_data.split("/");
                        //填入第一申请人
                        sqr_id =arr[0];
                        var newRow = Tab_sqr.insertRow(1);
                        newRow.insertCell(0).innerHTML= arr[1];
                        newRow.insertCell(1).innerHTML= arr[2];
                        newRow.insertCell(2).innerHTML= arr[3];
                        if(arr.length>6){
                            var len=(arr.length/7)-1;
                            while(len){
                                var nrow = Tab_sqr.rows.length;
                                var new_row = Tab_sqr.insertRow(nrow);
                                var j=0;
                                for(var i=len*7;i<len*7+7;i++){
                                    if(i==len*7){
                                        sqr_id=sqr_id+","+arr[i];
                                    }else if(i==len*7+1){
                                        new_row.insertCell(j).innerHTML = arr[i];
                                        j++;
                                    }else if(i==len*7+2){
                                        new_row.insertCell(j).innerHTML = arr[i];
                                        j++;
                                    }else if(i==len*7+3){
                                        new_row.insertCell(j).innerHTML = arr[i];
                                        j++;
                                    }else{
                                        j++;
                                    }
                                }
                                len--;
                            }
                            sqrid.value = sqr_id;
                        }
                        
                        localStorage.clear();
                    }else{
                        alert("未选中客户！");
                    }
                }else{
                    alert("抱歉！该浏览器版本不支持web存储。");
                }
//          }
            changeMes('sqrid',sqrid);
        }
    },1);
}

//设置提醒时间；新建费用提醒
    function set_remind(){
        ajh_remind = document.getElementById('ajhT').value;
//      alert(ajh_remind);
        var my_url = '../../../info_remindE_set.php?ajh='+ajh_remind;
        var scr_height = window.screen.availHeight;
        var scr_width = window.screen.availWidth;
        var bro_height = 600;
        var bro_width = 1300;
        var top = (scr_height-bro_height)/2;
        var left = (scr_width-bro_width)/2;
        var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
        var winobj = window.open(my_url,"_blank",specs);
        var loop = setInterval(function(){
            if(winobj.closed){
                clearInterval(loop);
                parent.location.reload();
            }
        },1);
    }


//修改案件信息
    function changeMes(text,obj){
        var Place = '';
        switch(text){
            case 'ZLMC':
                Place = '专利名称';
                break;
            case 'AYR':
                Place = '案源人';
                break;
            case 'DLR':
                Place = '代理人';
                break;
            case 'YAJH':
                Place = '原案卷号';
                break;
            case 'sqDate':
            	Place = '申请日';
            	break
            case 'Farecount':
                Place = '费减比例';
                break;
            case 'sqrid':
                Place = '申请人';
                break;
            default:break;
        }
        var ChangeM = confirm(Place+'信息发生改变，是否对其进行修改');
        if(ChangeM){
        	var Mes = obj.value;//修改后数据
//          alert(Mes);
            var ajhT = document.getElementById('ajhT');
//          console.log(Place+"||"+Mes+"||"+ajhT.value);

        	if(Place == "申请日"){
        		var firstyearnum = prompt("请输入年费首年度（1～20）：","1");
        		if(firstyearnum.length){
        			$.ajax({
		                type:"post",
		                url:"CaseSave.php",
		                async:true,
		                data:{
		                    Mes:Mes,//修改后数据
		                    Text:Place,//修改字段
		                    ajhT:ajhT.value,//案卷号
		                    firstyear : firstyearnum,//年费首年度
		                    flag:'ChanCaseMes'
		                },
		                dataType:"json",
		                success:function(data){
		//              	console.log(data);
		                    if(data.state){
		                		alert("修改成功");
		                	}else{
		                		alert(data.message);
		                	}
		                },
		                error:function(e,s,t){
		                    alert("保存失败");
		                    console.log("ajax error!"+s+": "+t);
		                }
		            });
        		}else{
        			alert("请输入年费首年度");
        		}
        	}else{
        		$.ajax({
	                type:"post",
	                url:"CaseSave.php",
	                async:true,
	                data:{
	                    Mes:Mes,//修改后数据
	                    Text:Place,
	                    ajhT:ajhT.value,//案卷号
	                    flag:'ChanCaseMes'
	                },
	                dataType:"json",
	                success:function(data){
	//              	console.log(data);
	                    if(data.state){
	                		alert("修改成功");
	                	}else{
	                		alert(data.message);
	                	}
	                },
	                error:function(e,s,t){
	                    alert("保存失败");
	                    console.log("ajax error!"+s+": "+t);
	                }
	            });
        	}
        }
    }
//选择案源人
function select_ayr(){
    var ayr = document.getElementById('ayr');
    var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					changeMes('AYR',ayr);
					
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
function select_dlr(){
    var dlr = document.getElementById('dlr');
    
    var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					dlr.value = localStorage.dlr_name;
					changeMes('DLR',dlr);
					
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
//	alert(return_data);
	var fzr = document.getElementById(id);
	var fzrid = document.getElementById('fzr'+id);
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_fzr.php","_blank",specs);
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
					alert("未选中负责人！");
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
//				console.log(data);
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
	var ajh = document.getElementById('ajhT').value;//案卷号
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
				ajh:ajh,
				flag:'change'
			},
			success:function(data){
				alert(data);
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
	if(confirm("是否删除费用")){
		var td_doc = btn_dom.parentNode;
		var tr_doc = td_doc.parentNode;
		var row_num = tr_doc.rowIndex;
		var tab = document.getElementById('jftable');
		var flagid = tab.rows[row_num].cells[5].innerHTML;//费用id
		var ajh = document.getElementById('ajhT').value;//案卷号
		$.ajax({
			url:'CaseSave.php',
			async:true,
			type:'post',
			data:{
				flag:'del',
				id : flagid,
				ajh:ajh
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
}
//新费用修改
function FeeChanged(inp_obj){
//	console.log($(inp_obj).val()+"||"+$(inp_obj).attr("id")+"||"+$(inp_obj).attr("name"));
	if(confirm("是否确认修改金额？")){
		$.ajax({
			url:'../FareChange.php',
			type:'post',
			async:true,
			data:{
				flag : 'FeeChanged',
				costid : $(inp_obj).attr("id"),
				feevalue : $(inp_obj).val(),
				source : $(inp_obj).attr("name")
				
			},
			dataType:"json",
			success:function(data){
//				console.log(data);
				alert(data.message)
			},
			error:function(x,s,t){
				alert("修改失败-ajax");
				console.log(s+": "+t);
			}
		});
	}
}
//新费用删除
function FeeDelete(btn_obj){
	if(confirm("是否确认删除费用？")){
		$.ajax({
			url:'../FareChange.php',
			async:true,
			type:'post',
			data:{
				flag:'FeeDEL',
				costid : $(btn_obj).attr("id"),
				source : $(btn_obj).attr("name")
			},
			dataType:"json",
			success:function(data){
//				console.log(data)
				alert(data.message);
				window.location.reload();
			},
			error:function(x,s,t){
				alert("修改失败-ajax");
				console.log(s+": "+t);
			}
		});
	}
}
//上传文件
function upfile(ajh){
	var myurl = "../upfile_fs.php"+"?ajh="+ajh;
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
	id = btn_doc.id;
	btn_doc.onclick = null;
	$.ajax({
		type:"get",
		url:"CaseSave.php",
		async:true,
		data:{
			flag:"DelFile",
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
			$(btn_doc).parent().parent().remove();
//			self.location.reload();
		},
		error:function(){
			console.log("ajax error!");
		}
	});	
}
//替换文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=fs&"+"id="+id;
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
//								console.log(data);
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

//选择申请日
function select_sqDate(obj){
    changeMes('sqDate',obj);   
}
//选择费减比
function Select_Farecount(obj){
    changeMes('Farecount',obj);   
}

//打开年费重建页面；申请日、费减比、首年度修改。
function OpenResetAnnualFee(ajh,tableflag){
//	alert(ajh);
	var myurl = "../resetannualfee.php?ajh="+ajh+"&"+"tabflag="+tableflag;
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
