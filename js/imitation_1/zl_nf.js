//选择申请人
function select_sqr(){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqrYcC.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					var arr = return_data.split("/");
					document.getElementById('sqr').value = arr[1];//显示申请人
					document.getElementById('prec').value = arr[2];//显示费减比
					
					localStorage.clear();
				}else{
					dlr.value = '';
					alert("未选中申请人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择代理人
function select_dlr(id){
	//alert(return_data);
	var str = id+'id';
	var dlr = document.getElementById(id);
	var dlrid = document.getElementById(str);
//	dlr = dlr.value.length;
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
					dlrid.value = localStorage.dlr_id;
					creatajh();
					
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

//选择案源人
function select_ayr(id){
//	alert(id);
	var str = id+'id';
	var ayrid = document.getElementById(str);
	var ayr = document.getElementById(id);
//	var fzr = document.getElementById('zlfz');
//	ayr_len = ayr.value.length;
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
					ayrid.value = localStorage.ayr_id;
			//		fzr.value = ayr_mas[1];
					creatajh();
					
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

//改变案卷类型
function changeAJH(obj){
//	alert(obj.value);
//	var id = obj.id;
//	var real_id = id.replace(/[^0-9]/ig,"");
	creatajh();
}

//生成案卷号
function creatajh(){
	var ayrid = document.getElementById('ayrid').value;
	var dlrid = document.getElementById('dlrid').value;
	var ctype = document.getElementById('ctype').value;
	if(ctype == '发明专利'){
		var smrk = '1';
	}else if(ctype == '实用新型'){
		var smrk = '2';
	}else if(ctype == '外观设计'){
		var smrk = '3';
	}
	var ajh = document.getElementById('ajh');
	if(dlrid.length!=0 && ayrid.length != 0 && ctype.length != 0){
		$.ajax({
			url:"case_save.php",
			type:"post",
			async:true,
			data:{
				dlrid:dlrid,
				ayrid:ayrid,
				ctype:smrk,
				flag:'ajh'
			},
			success:function(data){
				ajh.value = data;
//				alert(data);
			}
		});
	}
}
//生成年费
function creatyc(){
//	alert('ok');
	//获取表格中的申请日和首年度
	var tabm = document.getElementById('tabUserInfo');
	var tabb = document.getElementById('tabUserInfo_1');
	var tabf = document.getElementById('tabUserInfo_2');
	
	//获取申请日
	var sqdate = tabm.rows[1].cells[3].getElementsByTagName('input')[0].value;
//	alert(typeof sqdate.length);
	if(sqdate.length == 0){
		alert('请选择申请日');
	}else{
	//生成年费
		//获取首年度&&申请日
		var ctype = document.getElementById('ctype').value;//案件类型
		var sqr = document.getElementById('zlr').value;//申请日
		var snd = document.getElementById('snd').value;//首年度
		var prec = document.getElementById('prec').value;//百分比
		var fall=new Number();
		switch(ctype){
			case '实用新型':fall=10;break;
			case '外观设计':fall=10;break;
			case '发明专利':fall=20;break;
			default:alert('请选择案件类型');
		}
		//删除初始数据
		var numr = tabf.rows.length;
		while(numr>2){
			var numr = tabf.rows.length;
			numr--;
			tabf.deleteRow(numr);
		}
		//获取年费
		$.ajax({
			url:"case_save.php",
			type:"post",
			async:true,
			dataType:'json',
			data:{
				year:snd,
				count:prec,
				type:ctype,
				flag:'yearfare'
			},
			success:function(data){
//				console.log(data);
				//增行&&显示时间&&年费
				var timen =1;
		//		var faret = farecount(snd,prec,ctype);//参数：首年度、百分比、案件类型
				while(snd<=fall){
					var numr = tabf.rows.length;//计算表格行数
					var newRow = tabf.insertRow(numr);//增行
					var creayc = creaty(snd,sqr);//计算通知时间和截至时间[首年度，申请日]
					newRow.insertCell(0).innerHTML = snd+"<input type='text' style='width:25px;height:30px;border:0px;' hidden='hidden' value='"+ snd +"' />";
//					newRow.insertCell(0).innerHTML = snd"<input type='text' style='width:25px;height:30px;border:0px;' readonly='readonly' value='"+  +"' />";
					newRow.insertCell(1).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ data[timen]['fare'] +"' />";
					newRow.insertCell(2).innerHTML = "<input style='height:30px;' type='date' value='"+ creayc[0] +"' />";
					newRow.insertCell(3).innerHTML = "<input style='height:30px;' type='date' readonly='readonly' value='"+ creayc[1] +"' />";
					newRow.insertCell(4).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(5).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(6).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(7).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(8).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(9).innerHTML = "<input type='button'  value='删除' id="+timen+" onclick='del(this)' />";
					snd++;timen++;
				}
				creatznj();
				document.getElementById('SaveMes').style.display = "inline";
				//删除费用表第一行
				var tab = document.getElementById('tabUserInfo_2');
				var Obj = document.getElementById('1');
				var td_doc = Obj.parentNode;
				var tr_doc = td_doc.parentNode;
				var row_num = tr_doc.rowIndex;
				tab.deleteRow(row_num);
//				var tabf = document.getElementById('tabUserInfo_2');
//				tabf.deleteRow(1);
			}
		});
	}
}

//	ydate = (ydate.getFullYear() + dline) + "-" + (ydate.getMonth() + 1) + "-" + ydate.getDate() ;
//计算截止日期和通知日期[参数：首年度，申请日]
function creaty(dline,year){
	//计算截止日期
//	var ydate = new Date(year);
//	alert(year);
	dline = parseInt(dline);
	var dateTemp = year.split("-");
	dateTemp[0] = parseInt(dateTemp[0])-1;
	dateTemp[0] = dateTemp[0] + dline;
//  var ydate = new Date(dateTemp[0] + '-' + dateTemp[1] + '-' + dateTemp[2]);
    //判断加了一个月之后是不是新一年
//  alert(parseInt(dateTemp[1]));
    dateTemp[1] = parseInt(dateTemp[1]);
    if (dateTemp[1] == 12) {
    	dateTemp[0] = dateTemp[0] + 1;
    	dateTemp[1] = 1;
    } else{
    	dateTemp[1] = parseInt(dateTemp[1])+1;
    }
    if (dateTemp[1] < 10) {
//  	console.log(dateTemp[1]);
    	dateTemp[1] = "0" + dateTemp[1];
    }
    var ydate = dateTemp[0] + '-' + dateTemp[1] + '-' + dateTemp[2];
    
//  alert(new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]));
    
//	ydate = (ydate.getFullYear() + dline) + "-" + (ydate.getMonth() + 1) + "-" + ydate.getDate() ;

	//计算通知日期
	var dateTemp = ydate.split("-");
    var nDate = new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]); //转换为MM-DD-YYYY格式  
//  var millSeconds = Math.abs(nDate) - (30 * 24 * 60 * 60 * 1000);
//  var rDate = new Date(millSeconds);  
    
    var year = nDate.getFullYear();
    var month = nDate.getMonth();
    console.log(month)
    month = month-1;
    if(month==-1){
    	month = 11;
    	year = year-1;
    }
    if(month==0){
    	month = 12;
    	year = year-1;
    }
    
    if (month < 10){
    	 month = "0" + month;
    }
    var date = nDate.getDate();  
    if (date < 10) date = "0" + date;  
    var ydate2 = year + "-" + month + "-" + date;
	console.log(ydate2)
	var dateall = new Array(ydate2,ydate);//通知时间，截止日期
	return dateall;
}

//计算有费减的年费【废弃、用于测试】
function farecount(year,count,type){
	var type = document.getElementById('ctype').value;//案件类型
	var year = document.getElementById('snd').value;//首年度
	var count = document.getElementById('prec').value;//百分比
	$.ajax({
		url:"case_save.php",
		type:"post",
		async:true,
		dataType:'json',
		data:{
			year:year,
			count:count,
			type:type,
			flag:'yearfare'
		},
		success:function(data){
			alert(data);
		}
	});
}

function creatznj(){//计算并显示滞纳金
	var type = document.getElementById('ctype').value;//案件类型
	var snd = parseInt(document.getElementById('snd').value)+1;//首年度
//	alert(type+'/'+snd);
	$.ajax({
		url:"case_save.php",
		type:"post",
		async:true,
		dataType:'json',
		data:{
			flag:"znj",
			year:snd,//首年度
			type:type
		},
		success:function(data){
//			alert(data);
			snd = parseInt(snd);
			var tab = document.getElementById('tabUserInfo_2');
			var len = tab.rows.length;
//			alert(len);
			var y = snd;
			for(var i=2;i<(len);i++){
				tab.rows[i].cells[4].getElementsByTagName('input')[0].value=data[y][0];
				tab.rows[i].cells[5].getElementsByTagName('input')[0].value=data[y][1];
				tab.rows[i].cells[6].getElementsByTagName('input')[0].value=data[y][2];
				tab.rows[i].cells[7].getElementsByTagName('input')[0].value=data[y][3];
				tab.rows[i].cells[8].getElementsByTagName('input')[0].value=data[y][4];
				y++;
			}
		}
	});
}
//信息保存
function casesave(){
	var tabf = document.getElementById('tabUserInfo_2');
	
	var zlnc = document.getElementById('zlname');//专利名
	var type = document.getElementById('ctype');//专案类型
	var sqah = document.getElementById('zlh');//申请号
	var sqrq = document.getElementById('zlr');//申请日
	var sqry = document.getElementById('sqr');//申请人
	var fjnd = document.getElementById('fjn');//费减年度
	var strm = zlnc.value+"|"+type.value+"|"+sqah.value+"|"+sqrq.value+"|"+sqry.value+"|"+fjnd.value;
//	alert(strm);//案件概况
	
	var ayrm = document.getElementById('ayr');//案源人
	var dlrm = document.getElementById('dlr');//代理人
	var tajh = document.getElementById('ajh');//系统案卷号
	var Oajh = document.getElementById('ajhO');//原案卷号
//	var zlfz = document.getElementById('zlfz');//案件负责人
	var zlnc = document.getElementById('dlsj');//代理时间
	var nfsn = document.getElementById('snd');//首年度
	var fjbl = document.getElementById('prec');//费减比
	var strb = ayrm.value+"|"+dlrm.value+"|"+ tajh.value+"|"+ zlnc.value+"|"+ nfsn.value+"|"+ fjbl.value+"|"+'zlfz.value'+"|"+ Oajh.value;
//	alert(strb);//案件信息
	
	var strf = new String;
	var numr = tabf.rows.length;
	var numc = tabf.rows[0].cells.length;
//	alert(numr+"/"+numc);
	for(var i=2;i<numr;i++){
		for(var y=0;y<(numc-1);y++){
			var strw = tabf.rows[i].cells[y].getElementsByTagName('input')[0].value;
			strf+=strw+"|";
		}strf=strf.substring(0,strf.length-1);strf+=",";
	}
	strf=strf.substring(0,strf.length-1);
//	alert(strf);//年费信息
	
	var elma = document.getElementById('clrnow').value;
	
	//计算滞纳金的开始&&截止日期
	var arrDL = new Array();
	for(var i=2;i<numr;i++){
		//获取费用截止时间
		var DL = tabf.rows[i].cells[3].getElementsByTagName('input')[0].value+',';
		//滞纳金01
		dateline01=DLCount(DL);
		DL+=dateline01+',';
		//滞纳金02
		dateline02=DLCount(dateline01);
		DL+=dateline02+',';
		//滞纳金03
		dateline03=DLCount(dateline02);
		DL+=dateline03+',';
		//滞纳金04
		dateline04=DLCount(dateline03);
		DL+=dateline04+',';
		//滞纳金05
		dateline05=DLCount(dateline04);
		DL+=dateline05;
//		DLCount
		arrDL[i-2]=DL;
	}
	
	$.ajax({
		url:"case_save.php",
		async:true,
		type:"post",
		data:{
			strm:strm,
			strb:strb,
			strf:strf,
			stre:elma,
			strt:arrDL,//滞纳金起始截止时间
			flag:'casesave'
		},
		success:function(data){
			if(data=='2'){
				alert('申请号重复')
			}else if(data) {
				alert("费用信息保存成功!");
				//保存文件
				var tajh_v = document.getElementById('ajh').value;//系统案卷号
				var int_file = document.getElementById("int_file").files;
				fd_file.append("flag","uploadfile_nf");
				fd_file.append("ajh",tajh_v);
				if(file_num > 1){
					$.ajax({
						type:"POST",
						url:"../upfile_ajax.php",
						xhr:function(){
							myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',uploadProgress,false);
							}
							return myXhr;
						},
						data:fd_file,
						processData:false,
						contentType:false,
						success:function(data){
							setTimeout(function(){
								alert(data);
								if(confirm('文件保存成功,是否继续新建年费案件？')){
									self.location='new case 01.php';
								}else{
									window.close();
								}
		//						console.log(data);
//								window.close();
							},1000);
						},
						error:function(){
							console.log(" ajax error!");
						}
					});
				}else{
					if(confirm('无文件保存,是否继续新建年费案件？')){
						self.location='new case 01.php';
					}else{
						window.close();
					}
				}
			} else{
				alert('案件保存失败，请联系管理员！');
			}
		}
	});
}

//计算开始日期和截止日期
//function DLCount(上一个截止日期){
function DLCount(BegD){
//	var BegD ='2017-10-18';
	BegD = BegD.replace(/-/g,"/");
	var BegD = new Date(BegD);
	//判断月份是不是大于12
	if(BegD.getMonth() ==11){
		var EndD = (BegD.getFullYear()+1 )+'-'+(BegD.getMonth() -10)+'-'+(BegD.getDate());
	}else{
		var EndD = (BegD.getFullYear() )+'-'+(BegD.getMonth() + 2)+'-'+(BegD.getDate());
	}
	return EndD;
//	alert(EndD);
}
//滞纳金的生成【测试用】
function check(){
	var tabf = document.getElementById('tabUserInfo_2');
	var numr = tabf.rows.length;
		//计算滞纳金的开始&&截止日期
	for(var i=2;i<numr;i++){
		//获取费用截止时间
		var DL = tabf.rows[i].cells[3].getElementsByTagName('input')[0].value+',';
		//滞纳金01
		dateline01=DLCount(DL);
		DL+=dateline01+',';
		//滞纳金02
		dateline02=DLCount(dateline01);
		DL+=dateline02+',';
		//滞纳金03
		dateline03=DLCount(dateline02);
		DL+=dateline03+',';
		//滞纳金04
		dateline04=DLCount(dateline03);
		DL+=dateline04+',';
		//滞纳金05
		dateline05=DLCount(dateline04);
		DL+=dateline05;
		alert(DL);
//		DLCount
//		arrDL[i-2]=DL;
	}
//	alert(DL);
//	alert(arrDL);
}
//删除年费
function del(btn_doc){
	var tab = document.getElementById('tabUserInfo_2');
	var td_doc = btn_doc.parentNode;
	var tr_doc = td_doc.parentNode;
	var row_num = tr_doc.rowIndex;
	tab.deleteRow(row_num);
}
//选择旧案卷号
function select_ajhO(){
	var ajh = document.getElementById('ajhO');
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ajh.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					ajh.value = return_data;
					
					localStorage.clear();
				}else{
					ajh.value = '';
					alert("未选中案卷号！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}