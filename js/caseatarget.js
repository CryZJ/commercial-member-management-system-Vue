	
	//获取URL的值函数
	function GetQueryString(name){
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
	}

	//设置提醒时间；新建费用提醒
	function set_remind(){
		ajh_remind = GetQueryString('ajh');
//		alert(ajh_remind);
		var my_url = '../../info_remind_set.php?ajh='+ajh_remind;
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
	
	
//申请受理通知书导入
function upload_sqing(get_ajh,routine){
	var dqcx = document.getElementById("dqcx").value;
	if(dqcx != "待提交"){
		ajh = GetQueryString('ajh');
		$.ajax({
			type:"post",
			url:"caseinformation_judge_ajax.php",
			async:true,
			data:{
				my_flag:"sqing",
				ajh:ajh
			},
			success:function(data){
				if(confirm(data+"是否继续打开上传？")){
					var myurl = "../../info_sqing_set.php?ajh="+ajh;
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 600;
					var bro_width = 1300;
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
			},
			error:function(){
				
			}
		});
	}else{
		alert("案件状态处于“待提交”，请把案件改为其他状态再进行操作！");
	}
}

//授权通知书导入
//var SQGG = document.getElementById("sqgg");
//SQGG.addEventListener("click",upload_squan);
//两步导入
function upload_squan(get_ajh,routine){
	var dqcx = document.getElementById("dqcx").value;
	if(dqcx != "待提交"){
		ajh = GetQueryString('ajh');
		$.ajax({
			type:"post",
			url:"caseinformation_judge_ajax.php",
			async:true,
			data:{
				my_flag:"squan",
				ajh:ajh
			},
			success:function(data){
				if(confirm(data+"是否打开上传页面？")){
					var myurl = "../../info_squan_set.php?ajh="+ajh;
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 500;
					var bro_width = 1300;
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
			},
			error:function(){
				alert("ajax error!");
			}
		});
	}else{
		alert("案件状态处于“待提交”，请把案件改为其他状态再进行操作！");
	}
}
//一步导入
function upload_squan2(get_ajh,routine){
	var dqcx = document.getElementById("dqcx").value;
	if(dqcx != "待提交"){
		ajh = GetQueryString('ajh');
		$.ajax({
			type:"post",
			url:"caseinformation_judge_ajax.php",
			async:true,
			data:{
				my_flag:"squan2",
				ajh:ajh
			},
			dataType:"json",
			success:function(data){
				if(data[0] == "0" && data[1] == "0"){
					var myurl = "../../info_squan_set2.php?ajh="+ajh;
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 500;
					var bro_width = 1300;
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
				}else if(data[0] == "1" && data[1] == "0"){
					alert("授权文件已导入；但费用可能未生成！无法使用该按钮！");
				}else if(data[0] == "1" && data[1] == "0"){
					alert("授权文件已删除；但费用可能生成！无法使用该按钮！");
				}else if(data[0] == "1" && data[1] == "1"){
					alert("授权文件已导入；登记费，印花费，首期年费    已生成！无法使用该按钮！");
				}
			},
			error:function(){
				alert("ajax error!");
			}
		});
		
	}else{
		alert("案件状态处于“待提交”，请把案件改为其他状态再进行操作！");
	}
}

//证书登记
//var ZSDJ = document.getElementById("zszt");
//ZSDJ.addEventListener("click",upload_zs);

function upload_zs(get_ajh,routine){
	var dqcx = document.getElementById("dqcx").value;
	if(dqcx != "待提交"){
		ajh = GetQueryString('ajh');
	//	alert(ajh);
		$.ajax({
			type:"post",
			url:"caseinformation_judge_ajax.php",
			async:true,
			data:{
				my_flag:"zs",
				ajh:ajh
			},
			dataType:"json",
			success:function(data){
				if(data[0]=="0" && data[1]=="0"){
					var myurl = "../../info_zsdengji_set.php?ajh="+ajh;
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 500;
					var bro_width = 1300;
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
				if(data[0]=="1" && data[1]=="0"){
					alert("证书文件已上传，但年费没有保存，请再次添加证书文件并保存费用！");
					var myurl = "../../info_zsdengji_set.php?ajh="+ajh;
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 500;
					var bro_width = 1300;
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
				if(data[0]=="1" && data[1]=="1"){
					if(confirm("证书文件已导入，年费已生成，如需导入证书文件，请打开上传页面进行操作？")){
						var myurl = "../../info_zsdengji_set.php?ajh="+ajh;
						var scr_height = window.screen.availHeight;
						var scr_width = window.screen.availWidth;
						var bro_height = 500;
						var bro_width = 1300;
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
				
			},
			error:function(){
				alert("ajax error!");
			}
		});
	}else{
		alert("请先提交申请文件后，再进行操作！");
	}
}
//费用修改
function ChangeFare(id,flag,ajh){
	var Count = "fa"+id;
	var FName = "fn"+id;
	var StrBtn = "btn"+id;
	var BId = document.getElementById(StrBtn);//按钮id
	var CId = document.getElementById(Count);//费用金额id
	var FId = document.getElementById(FName).innerHTML;//费用名id
	var useid = document.getElementById('useid').value;//操作人id
	if(flag == '修改'){//修改
		CId.readOnly = false;
//		CId.bgColor ="#FFFFFF";
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
				useid:useid,
				ajh:ajh,
				FId:FId,
				flag:'change'
			},
			success:function(data){
				alert(data);
//				console.log(data);
//				alert(data);
			}
		});
		CId.readOnly = true;
		BId.value="修改";
		BId.style.color = 'black';
	}
//	alert('ok');
}

//新费用修改
function FeeChanged(inp_obj){
//	console.log($(inp_obj).val()+"||"+$(inp_obj).attr("id")+"||"+$(inp_obj).attr("name"));
	if(confirm("是否确认修改金额？")){
		$.ajax({
			url:'FareChange.php',
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
			url:'FareChange.php',
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
//费用删除
function FareDel(btn_dom){
	var ajh = document.getElementById("ajhT").value;
	if(confirm("是否确认删除费用？")){
		var td_doc = btn_dom.parentNode;
		var tr_doc = td_doc.parentNode;
		var row_num = tr_doc.rowIndex;
	//	var Fid = 'all'+id;
		var tab = document.getElementById('jftable');
		var flagid = tab.rows[row_num].cells[5].innerHTML;
	//	alert(flagid);
		var data = flagid.split('/');
	//	var fareF = data[1];
	//	var fareId = data[0];
	//	alert(data[0]);
		$.ajax({
			url:'FareChange.php',
			async:true,
			type:'post',
			data:{
				flag:'del',
				fareF: data[1],
				id : data[0],
				ajh:ajh
			},
			success:function(data){
				if(data){
	//				id = id-1;
					tab.deleteRow(row_num);
				}else{
					alert(data);
					self.location='../../login.php';
				}
			}
		});
	}
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
				flag:"zhuanli",
				id:id
			},
			success:function(data){
				alert(data);
				tr_doc = btn_doc.parentNode.parentNode;
				tab_doc = tr_doc.parentNode.parentNode;
				tab_doc.deleteRow(tr_doc.rowIndex);
//				self.location.reload();
			},
			error:function(){
				console.log("ajax error!");
			}
		});
	}
}

//上传文件
function up_file(ajh){
	var useer_v = document.getElementById("useer").value;
	var myurl = "upfile.php"+"?ajh="+ajh+"&"+"clr="+useer_v;
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
		var myurl = "change_file.php"+"?flag=za&"+"id="+id;
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

//确认提醒
function MesChange(CType){
    var alarm = '';
    switch(CType) {
        case 'zlmc'://专利名称
            alarm = '专利名称';
            break;
//      case 'select_ayr'://案源人
//          alarm = '案源人';
//          break;
//      case 'select_dlr'://代理人
//          alarm = '代理人';
//          break;
        case 'sqd'://申请日
            alarm = '申请日';
            break;
        case 'sqgg'://授权公告
            alarm = '授权公告日';
            break;
        case 'dqcx'://当前程序
            alarm = '当前程序';
            break;
        case 'FareCount'://费减比
            alarm = '费减比';
            break;
        default:break;
    }
    var check = confirm('【'+alarm+'】发生变化，是否确认修改此项信息？');
    if(check){
        SaveChag(CType);
    }
}

//案件修改
function SaveChag(MType){
    var ajh = document.getElementById("ajhT").value;
//  console.log(document.getElementById(MType).value);
//  console.log(MType);
    $.ajax({
        url:'case_change_zl.php',
        type:'get',
        async:false,
        data:{
            ajh:ajh,
            falg:MType,
            mes:document.getElementById(MType).value
        },
        success:function(data){
//      	console.log(data);
            if(data == 1){
                alert('操作成功');
            }else{
                alert('操作失败，请联系管理员');
            }
        }
    });
}

//案件修改
//function changemes(){
//	var changebtn = document.getElementById('changebtn');
//	changebtn.onclick = savechange;
//	changebtn.value = '保存';
//	changebtn.style.color = 'red';
//	var btndiv = document.getElementById('sqrchange');
//	var btn = document.createElement('input');
//	btn.id = 'select_sqr';
//	btn.type = 'button';
//	btn.value = '选择申请人';
//	btn.onclick = select_sqr;
//	btndiv.appendChild(btn);
//	
//	var btnayr = document.getElementById('select_ayr');
//	var btndlr = document.getElementById('select_dlr');
//	btnayr.onclick = select_ayr;
//	btndlr.onclick = select_dlr;
//	
//	//获取目标input
//	var input = document.getElementsByName('change');
//	var len = input.length;
//	for (var i=0;i<len;i++) {
//		input[i].readOnly = false;
//	}
//	
//	document.getElementById('dqcx').disabled=false;
//}
//选择申请人
function select_sqr(){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_sqr_more.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
//			alert(1);
		    clearInterval(loop);
		    var CChoose = confirm('已经选择申请人，是否修改案件申请人');
		    if(CChoose){
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
    					//删除发明设计人表的数据
    					var tab_fmsjr = document.getElementById('tab_fmsjr');
    					var tab_lenf = tab_fmsjr.rows.length;
    					if(tab_lenf > 1){
    						for(var i=1;i<tab_lenf;i++ ){
    							tab_fmsjr.deleteRow(1);
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
    									new_row.insertCell(j).innerHTML	= arr[i];
    									j++;
    								}else if(i==len*7+2){
    									new_row.insertCell(j).innerHTML	= arr[i];
    									j++;
    								}else if(i==len*7+3){
    									new_row.insertCell(j).innerHTML	= arr[i];
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
		    }
		    SaveChag('sqrid');
		}
	},1000);
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
		var winobj = window.open("../../select_dlr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.dlr_name){
						$("#select_dlr").attr("value",localStorage.dlr_name);
						localStorage.clear();
					}else{
						alert("未选中代理人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
				SaveChag('select_dlr');
			}
		},1);
	}
	
	//选择案源人
	function select_ayr(id){
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
						$("#select_ayr").attr("value",localStorage.ayr_name);
						localStorage.clear();
					}else{
						alert("未选中案源人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
				SaveChag('select_ayr');
			}
		},1);
	}
//保存修改信息
//function savechange(){
//	//get aim
//	var changebtn = document.getElementById('changebtn');
//	changebtn.onclick = changemes;
//	changebtn.value = '修改';
//	changebtn.style.color = 'white';
//	
//	//removeChild
//	var btndiv = document.getElementById('sqrchange');
//	var btn = document.getElementById('select_sqr');
////	btndiv.removeChild(btn);
//	var btndiv = btn.parentNode;
//  btndiv.removeChild(btn);
//  //
//  var btndlr = document.getElementById('select_dlr');
//  var btnayr = document.getElementById('select_ayr');
//  btndlr.onclick='';
//  btnayr.onclick='';
//  document.getElementById('dqcx').disabled = true;
//  
////执行保存
//  //获取申请人id
//  var sqridT = document.getElementById('sqrid').value;
//	//获取专利名称
//	var zlmc = document.getElementById('zlmc').value;
//	//获取案源人
//	var ayrM = document.getElementById('select_ayr').value;
//	//获取代理人
//	var dlrM = document.getElementById('select_dlr').value;
//	//获取申请日
//	var sqd = document.getElementById('sqd').value;
//	//获取授权公告
//	var sqgg = document.getElementById('sqgg').value;
//	//获取当前程序
//	var dqcx = document.getElementById('dqcx').value;
//	//案卷号
//	var ajhT = document.getElementById('ajhT').value;
//	//创建人
//	var useer = document.getElementById('useer').value;
//	//费减比例
//	var FareCount = document.getElementById('FareCount').value;
//	
//	var messs = sqridT+'/'+ayrM+'/'+dlrM+'/'+ajhT+'/'+useer+'/'+ sqd+'/'+zlmc+'/'+dqcx+'/'+FareCount;
////	alert(messs);
//	console.log(messs);
//	
//	$.ajax({
//		url:'case_change_zl.php',
//		type:'get',
//		async:true,
//		data:{
//			falg:'zl_change',
//			sqrid:sqridT,
//			zlm:zlmc,
//			ayr:ayrM,
//			dlr:dlrM,
//			sqd:sqd,
//			sqgg:sqgg,
//			dqcx:dqcx,
//			ajh:ajhT,
//			cpeo:useer,
//			FareCount:FareCount
//		},
//		success:function(data){
////			alert(data);
//			if(data == 1){
//				alert('修改成功');
////				alert(data);
////				console.log(data);
//			}else{
//				alert('修改失败，请联系管理员');
//			}
//		}
//	});
//}

//新增监控时的撤除
function del_row(btn_doc){
	if(confirm("是否确认撤除?")){
		var tr_doc = btn_doc.parentNode.parentNode;
		var tab = document.getElementById("tab_che");
		tab.deleteRow(tr_doc.rowIndex);
	}
}

//监控新建保存 --案件详情
function save_kjxx(btn_doc){
	var ajh = document.getElementById("ajhT").value;//案卷号
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
			url:"save_zajk_new.php",
			async:true,
			data:{
				flag:"new_monitor_za",
				ajh:ajh,
				send_str:send_str
			},
			success:function(data){
//				alert("信息："+data);
				alert(data);
//				console.log(data);
				if(data == "保存成功"){
					//改变操作内容
//					tr_doc.cells[6].innerHTML = "<input type='button' value='结束监控' onclick='ChangeSitu(this)' />";
					
					//异步保存文件
					var int_file = tr_doc.cells[2].getElementsByTagName("input")[0].files;
					if(int_file.length != 0){
						var fd = new FormData();
						fd.append("flag","new_monitor_upfile_za");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"save_zajk_new.php",
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
					}
					//改变文件内容
//					tr_doc.cells[2].innerHTML = "";
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
//修改发明设计人
function ChaFSM(ajh){
	//获取申请人信息
	var tab_aim = document.getElementById('tab_sqr');
	var sqr = '';
	for(var i=1;i<tab_aim.rows.length;i++){
		sqr = sqr +','+ tab_aim.rows[i].cells[0].innerHTML;
	}
	sqr = sqr.substr(1,sqr.length);
//	alert(sqr);
	//打开选择发明设计人窗口并保存发明设计人
	var my_url = "../../select_fmsjr.php?mes="+sqr;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(my_url,"_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.returndata){
					data = localStorage.returndata.split('||');
					
					//处理返回值
					$.ajax({
						type:"get",
						url:"select_fmsjrSave.php",
						async:true,
						data:{
							FMRid:data[0],
							ajh:ajh
						},
						success:function(data){
				//			console.log(data);
							if (data) {
								alert('修改成功');
							} else{
								alert('修改失败，请联系管理员');
							}
						},
						error:function(e){
							alert('出现错误，请联系管理员'+e);
						}
					});
					
					
					//显示数据
					var Table = document.getElementById("tab_fmsjr");
					dataO = data[1].split(',');
					var tablen = Table.rows.length;
					for(var i=1;i<tablen;i++){
						Table.deleteRow(1);
					}
					
					for (var z=0;z<dataO.length;z++) {
						FmsjrMes = dataO[z].split('/');
						var newRow = Table.insertRow(Table.rows.length);
						newRow.insertCell(0).innerHTML = FmsjrMes[0];//发明设计人名
						newRow.insertCell(1).innerHTML = FmsjrMes[1];//证件号
					}
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
//改变监控状态【即结束监控】
function ChangeSitu(id){
	$.ajax({
		type:"get",
		url:"save_zajk_new.php",
		async:true,
		data:{
			flag:"ChangeSitu",
			id:id
		},
		success:function(data){
			alert(data);
//				console.log(data);
		},
		error:function(xhr,status,xmlthrow){
			console.log("ajax error!"+status+xmlthrow);
		}
	});
}

//打开年费重建页面；申请日、费减比、首年度修改。
function OpenResetAnnualFee(ajh,tableflag){
//	alert(ajh);
	var myurl = "resetannualfee.php?ajh="+ajh+"&"+"tabflag="+tableflag;
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