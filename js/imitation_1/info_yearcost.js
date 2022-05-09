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
                break;
            case 'FareCount':
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
            var ajhT = document.getElementById('ajhT');
//          console.log(Place+"||"+Mes+"||"+ajhT.value);
            $.ajax({
                type:"post",
                url:"CaseSave.php",
                async:false,
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
//              		alert("修改成功");
                		alert(data.message);
                		window.location.reload();
                	}else{
                		alert(data.message);
                	}
                },
                error:function(x,s,t){
                	alert("更改失败");
                	console.log("ajax error!"+s+": "+t);
                }
            });
        }
    }

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

//设置提醒时间；新建费用提醒
    function set_remind(){
        ajh_remind = document.getElementById('ajhT').value;
//      alert(ajh_remind);
        var my_url = '../../../info_remindY_set.php?ajh='+ajh_remind;
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
//选择申请日
function select_sqDate(){
    changeMes('sqDate',sqDate);   
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
	var ajh = document.getElementById('ajhT').value;//案卷号
//	var FId = document.getElementById(FName).innerHTML;//费用id
	if(flag == '修改'){//修改
		CId.readOnly = false;
		BId.value="保存";
		BId.style.color = 'red';
	}else{//保存
//		alert(fid.value+'/'+id);
		$.ajax({
			url:'FareChange.php',
			type:'post',
			async:true,
			data:{
				MessC:CId.value,
				FId:id,
				flag:'change',
				ajh:ajh
			},
			success:function(data){
				alert(data);
//				console.log(data);
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
			url:'FareChange.php',
			async:true,
			type:'post',
			data:{
				flag:'del',
				id : flagid,
				ajh: ajh
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
function UpFiles(btn_doc){
	var ajh = btn_doc.id;
	var myurl = "../upfile_nf.php"+"?ajh="+ajh;
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

//删除文件
function del_fs(btn_doc){
	id = btn_doc.name;
	btn_doc.onclick = null;
	$.ajax({
		type:"get",
		url:"../del_file.php",
		async:true,
		data:{
			flag:"nf_file",
			id:id
		},
		success:function(data){
			alert(data);
			tr_doc = btn_doc.parentNode.parentNode;
			tab_doc = tr_doc.parentNode.parentNode;
			tab_doc.deleteRow(tr_doc.rowIndex);
		},
		error:function(){
			console.log("ajax error!");
		}
	});	
}
//替换文件
function change_nf(btn_doc){
	id = btn_doc.name;
	flag_name = "changfile_nf";
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=nf&"+"id="+id+"&"+"flag_name="+flag_name;
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
