//选择案源人
function Change_ayr(){
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
function Change_dlr(){
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
//修改案件信息
function changeMes(text,obj){
    var Place = '';
    switch(text){
        case 'AYR':
            Place = '案源人';
            break;
        case 'DLR':
            Place = '代理人';
            break;
        case 'LB':
        	Place = '类别';
            break;
        case 'SPFW':
            Place = '商品服务';
            break;
    }
    var ChangeM = confirm(Place+'信息发生改变，是否对其进行修改');
    if(ChangeM){
        var Mes = obj.value;//修改后数据
//          alert(Mes);
        var ajhT = document.getElementById('ajh');//获取案卷号
        $.ajax({
            type:"post",
            url:"blogo_action.php",
            async:true,
            data:{
                Mes:Mes,//修改后数据
                Text:Place,
                ajhT:ajhT.value,//案卷号
                flag:'ChanCaseMes'
            },
            success:function(data){
                if(data=='ok'){
                    alert(Place+'修改成功');
                }
            }
        });
    }
}
//修改案件信息-附加
function changeMes2(text,obj){
    var Place = '';
    switch(text){
        case 'WGJSR':
            Place = '外国受让人的国内接收人';
            break;
        case 'YZBM':
            Place = '邮政编码';
            break;
        case 'GNJSR':
        	Place = '国内接收人地址';
            break;
        case 'SFYSB':
        	Place =	'共有商标是';
        	break;
        case 'BGQMYC':
        	Place =	'变更前名义C';
        	break;
        case 'BGQMYE':
        	Place =	'变更前名义E';
        	break;
        case 'BGQDZC':
        	Place =	'变更前地址C';
        	break;
        case 'BGQDZE':
        	Place =	'变更前地址E';
        	break;
        case 'BGGLGZ':
        	Place =	'变更管理规则';
        	break;
        case 'CYMD':
        	Place =	'变更集体成员名单';
        	break;
    }
    var ChangeM = confirm(Place+'信息发生改变，是否对其进行修改');
    if(ChangeM){
        var Mes = obj.value;//修改后数据
//          alert(Mes);
        var ajhT = document.getElementById('ajh');//获取案卷号
        $.ajax({
            type:"post",
            url:"blogo_action.php",
            async:true,
            data:{
                Mes:Mes,//修改后数据
                Text:Place,
                ajhT:ajhT.value,//案卷号
                flag:'ChanCaseMes2'
            },
            success:function(data){
//          	console.log(data);
                if(data=='ok'){
                    alert(Place+'修改成功');
                }
            }
        });
    }
}
//打开委托书窗口【注册】（无申请号）
function openW(){
//	alert(return_data);
//	console.log(return_data);
	var RePN = document.getElementById('ReP');
	var RePId = document.getElementById('RePC');
	var ajlx = document.getElementById("ajlx");
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ReP.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.wts_id){
					RePId.value = localStorage.wts_id;
					RePN.value = localStorage.wts_proprietaryname;
					ajlx.innerHTML = localStorage.wts_type;
					document.getElementById('addc').value = localStorage.wts_address;//地址
					//表格中的显示
					document.getElementById('thna').innerHTML = localStorage.wts_proprietaryname;
					$.ajax({
						type:"get",
						url:"blogo_action.php",
						dataType:"json",
						async:true,
						data:{
							flag:"chose_sqr",
							wts_id:localStorage.wts_id
						},
						success:function(data){
							console.log(data)
							//证件图,营业执照图,营业执照翻,证件翻 idyj SPic yyfyj idfyj
							var sqrid = document.getElementById('sqrid');
							sqrid.value = data['id']
							document.getElementById('sqrc').value=data['申请人'];//中文名
							document.getElementById('sqre').value=data['英文名'];//英文名
							document.getElementById('sfzh').value=data['证件号'];//IDN
							
			//				document.getElementById('addc').value=data['地址'];//地址
							
							document.getElementById('stmp').value=data['邮政编码'];//邮编
							document.getElementById('coty').value=data['国籍'];//国籍
			//				Clear_msg();
			//				if(data['证件图']) Show_idpicture("idyj","../../../"+data['证件图']);
			//				if(data['营业执照图']) Show_idpicture("SPic","../../../"+data['营业执照图']);
			//				if(data['营业执照翻']) Show_idpicture("yyfyj","../../../"+data['营业执照翻']);
			//				if(data['证件翻']) Show_idpicture("idfyj","../../../"+data['证件翻']);
							document.getElementById('table_zjsqr').style.display="block";
						},
						error:function(XMLhttprequest,errorstatus,errorThrow){
							console.log("ajax error!"+errorstatus+errorThrow);
						}
					});
					
					
					localStorage.clear();
				}else{
					alert("未选中委托书！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开委托书窗口【其他、变更】（有申请号）
function openW_have(){
//	alert(return_data);
//	console.log(return_data);
	var RePN = document.getElementById('ReP');
	var RePId = document.getElementById('RePC');
	var ajlx = document.getElementById("ajlx");
	var sqh = document.getElementById("sqh");
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ReP.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.wts_id){
					RePId.value = localStorage.wts_id;
					RePN.value = localStorage.wts_proprietaryname;
					ajlx.innerHTML = localStorage.wts_type;
					document.getElementById('addc').value = localStorage.wts_address;//地址
					//表格中的显示
					document.getElementById('thna').innerHTML = localStorage.wts_proprietaryname;
					var strhave_sqh = localStorage.wts_proprietaryname;
					//检测委托书是否存在申请号
					if(strhave_sqh.indexOf("第")>-1 && strhave_sqh.indexOf("号")>-1){//存在
						var regexp = /[0-9]/g;
						tmp_sqh_obj = strhave_sqh.match(regexp);
			//			console.log(strhave_sqh+"\n"+tmp_sqh_obj+"\n"+typeof(tmp_sqh_obj));
						tmp_sqh = "";
						for(ky in tmp_sqh_obj){
							tmp_sqh += tmp_sqh_obj[ky];
						}
						sqh.value = tmp_sqh;
					}else{
						sqh.value = "";
					}
					$.ajax({
						type:"get",
						url:"blogo_action.php",
						dataType:"json",
						async:true,
						data:{
							flag:"chose_sqr",
							wts_id:localStorage.wts_id
						},
						success:function(data){
							//证件图,营业执照图,营业执照翻,证件翻 idyj SPic yyfyj idfyj
							var sqrid = document.getElementById('sqrid');
							sqrid.value = data['id']
							document.getElementById('sqrc').value=data['申请人'];//中文名
							document.getElementById('sqre').value=data['英文名'];//英文名
							document.getElementById('sfzh').value=data['证件号'];//IDN
							
			//				document.getElementById('addc').value=data['地址'];//地址
							
							document.getElementById('stmp').value=data['邮政编码'];//邮编
							document.getElementById('coty').value=data['国籍'];//国籍
			//				Clear_msg();
			//				if(data['证件图']) Show_idpicture("idyj","../../../"+data['证件图']);
			//				if(data['营业执照图']) Show_idpicture("SPic","../../../"+data['营业执照图']);
			//				if(data['营业执照翻']) Show_idpicture("yyfyj","../../../"+data['营业执照翻']);
			//				if(data['证件翻']) Show_idpicture("idfyj","../../../"+data['证件翻']);
							
						},
						error:function(XMLhttprequest,errorstatus,errorThrow){
							console.log("ajax error!"+errorstatus+errorThrow);
						}
					});
					
					
					localStorage.clear();
				}else{
					alert("未选中委托书！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开委托书新建页面
function openNW(){
	window.open('new_disc.php?ajh='+'111','_blank','left=50,top=50,width=1250,height=600');
}
//选择类别
function SetType(){
	 var TypeTab = document.getElementById("tab_bank");
	if(TypeTab.style.display == "block"){
		TypeTab.style.display = "none";
	}else{
		TypeTab.style.display = "block";
	}
}
//显示类型
function choose(data){
	var ctype = document.getElementById('CType');
	var TypeTab = document.getElementById("tab_bank");
	ctype.value = data;
	TypeTab.style.display = "none";
//	alert(data);
}
//生成案卷号
function creatajh(){
	var ayrid = document.getElementById('ayrid').value;
	var dlrid = document.getElementById('dlrid').value;
	var ajh = document.getElementById('ajh');
	if(dlrid.length!=0 && ayrid.length != 0){
		$.ajax({
			url:"blogo_action.php",
			type:"post",
			async:true,
			data:{
				dlrid:dlrid,
				ayrid:ayrid,
				flag:'ajh'
			},
			success:function(data){
				ajh.value = data;
//				alert(data);
			}
		});
	}
}
//选择代理人
function select_dlr(id){
	//alert(return_data);
	var dlr = document.getElementById(id);
	var dlrid = document.getElementById('dlrid');
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
					dlrid.value = localStorage.dlr_id;
					dlr.value = localStorage.dlr_name;
					creatajh();
					
					localStorage.clear();
				}else{
					dlr.value = '';
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
	var ayr = document.getElementById(id);
	var ayrid = document.getElementById('ayrid');
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
					ayrid.value = localStorage.ayr_id;
					ayr.value = localStorage.ayr_name;
					creatajh();
					
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
//选择申请人
function select_sqr(){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.sqr_name){
					var arr_data = new Array();
					arr_data[0] = localStorage.sqr_id;
					$.ajax({
						url:"blogo_action.php",
						async:true,
						type:"post",
						dataType:"json",
						data:{
							flag:'sqrmes',
							sqrid:arr_data[0]
						},
						success:function(data){
			//				console.log(data);
							//证件图,营业执照图,营业执照翻,证件翻 idyj SPic yyfyj idfyj
							var sqrid = document.getElementById('sqrid');
							sqrid.value = arr_data[0];
							document.getElementById('sqrc').value=data['申请人'];//中文名
							document.getElementById('sqre').value=data['英文名'];//英文名
							document.getElementById('sfzh').value=data['证件号'];//IDN
							document.getElementById('addc').value=data['地址'];//地址
							document.getElementById('stmp').value=data['邮政编码'];//邮编
							document.getElementById('coty').value=data['国籍'];//国籍
							$("#add_other").append('<option value="'+document.getElementById('addc').value+'" />');
							if(data["其他地址的数量"] >0){
								for(var i=0,len=data["其他地址的数量"];i<len;i++){
									$("#add_other").append('<option value="'+data["其他地址"][i]+'" />');
								}
							}
			//				Clear_msg();
			//				if(data['证件图']) Show_idpicture("idyj","../../../"+data['证件图']);
			//				if(data['营业执照图']) Show_idpicture("SPic","../../../"+data['营业执照图']);
			//				if(data['营业执照翻']) Show_idpicture("yyfyj","../../../"+data['营业执照翻']);
			//				if(data['证件翻']) Show_idpicture("idfyj","../../../"+data['证件翻']);
							document.getElementById("table_zjsqr").style.display="block";//显示
						},
						error:function(x,s,t){
							console.log(x,s,t);
						}
					});
					localStorage.clear();
				}else{
					alert("未选中申请人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//增加申请人
function select_zjsqr(){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.sqr_name){
					var arr_data = new Array();
					arr_data[0] = localStorage.sqr_id;
					$.ajax({
						url:"blogo_action.php",
						async:true,
						type:"post",
						dataType:"json",
						data:{
							flag:'zjsqrmes',
							sqrid:arr_data[0]
						},
						success:function(data){
			//				console.log(data);
							//证件图,营业执照图,营业执照翻,证件翻 idyj SPic yyfyj idfyj
							var sqrid = document.getElementById('sqrid1');
							sqrid1.value = arr_data[0];
							document.getElementById('sqrc1').value=data['申请人'];//中文名
							document.getElementById('sqre1').value=data['英文名'];//英文名
							document.getElementById('sfzh1').value=data['证件号'];//IDN
							document.getElementById('addc1').value=data['地址'];//地址
							document.getElementById('stmp1').value=data['邮政编码'];//邮编
							document.getElementById('coty1').value=data['国籍'];//国籍
							$("#add_other").append('<option value="'+document.getElementById('addc').value+'" />');
							if(data["其他地址的数量"] >0){
								for(var i=0,len=data["其他地址的数量"];i<len;i++){
									$("#add_other").append('<option value="'+data["其他地址"][i]+'" />');
								}
							}
			//				Clear_msg();
			//				if(data['证件图']) Show_idpicture("idyj","../../../"+data['证件图']);
			//				if(data['营业执照图']) Show_idpicture("SPic","../../../"+data['营业执照图']);
			//				if(data['营业执照翻']) Show_idpicture("yyfyj","../../../"+data['营业执照翻']);
			//				if(data['证件翻']) Show_idpicture("idfyj","../../../"+data['证件翻']);
						},
						error:function(x,s,t){
							console.log(x,s,t);
						}
					});
					localStorage.clear();
				}else{
					alert("未选中申请人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//监督进度条
function uploadProgress(evt){
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


//选择委托人------新建委托书时
function select_WTP(){
//	alert(return_data);
//	console.log(return_data);
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_SQRBlogo.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					data = return_data.split('|');
			//		console.log(data);
					var SpanN = document.getElementById('mes');
					var RePM = SpanN.getElementsByTagName('input');
					RePM[0].value = data[0];//申请人id
					if(data[5] == "个人"){
						RePM[1].value = data[1]+" （身份证号："+data[2]+"）";//姓名、身份证号
					}else{
						RePM[1].value = data[1];//姓名
					}
					RePM[2].value = data[4];//国籍
					RePM[3].value = data[4];
					var SpanT = document.getElementById('tabinfo');
					var RePMTab = SpanT.getElementsByTagName('input');
					RePMTab[0].value = data[3];
					//获取该申请人的其他地址
					$("#sqr_address").append('<option value="'+data[3]+'">');
					$.ajax({
						type:"get",
						url:"blogo_action.php",
						async:true,
						data:{
							flag:"Get_Address",
							person_id:data[0]
						},
						dataType:"json",
						success:function(data){
							console.log(data);
							if(data["row_num"] > 0){
								for(var i=0,len=data["row_num"];i<len;i++){
									$("#sqr_address").append('<option value="'+data["地址"][i]+'">');
								}
							}
						},
						error:function(x,s,t){
							console.log("ajax error!"+s+t);
						}
					});


					localStorage.clear();
				}else{
					alert("未选中委托人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//选择代理组织&联系人
function select_ConOP(){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ConOP.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					data = return_data.split('|');
		
					var DLO = document.getElementById('DLO');
					var dlrfax = document.getElementById('dlrfax');
					var oInput = document.getElementsByName('info');
					DLO.value = data[1];
					oInput[1].value = data[2];
					oInput[2].value = data[3];
					oInput[3].value = data[4];
					dlrfax.value = data[5];
					
					localStorage.clear();
				}else{
					alert("未选中代理组织信息！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//商品/服务的增行
function addSevM(){
	var tab = document.getElementById('tabUserInfo_1');//获取表格目标
	var SeName = document.getElementById('SeName');//获取商品服务位置
	var num = tab.rows[tab.rows.length-1].cells[0].innerHTML;
	var newRow = tab.insertRow(tab.rows.length);
	num = new Number(num.substr(0,num.length-39));

	var numA = new Number(num+2);
	var numB = new Number(num+3);
	newRow.insertCell(0).innerHTML = numA+'.'+"<input style='width:90%;' name='SerN' />";
	newRow.insertCell(1).innerHTML = numB+'.'+"<input style='width:90%;' name='SerN' />";
	tab.rows[tab.rows.length-1].cells[0].colSpan = 4;
	tab.rows[tab.rows.length-1].cells[1].colSpan = 2;
	
	SeName.rowSpan ++;
}
//商品/服务的增行【商标管理新建专用】
function addSevM_Mag(){
	var tab = document.getElementById('tabUserInfo_1');//获取表格目标
	var SeName = document.getElementById('SeName');//获取商品服务位置
	var num = tab.rows[tab.rows.length-1].cells[0].innerHTML;
	var newRow = tab.insertRow(tab.rows.length);
	num = new Number(num.substr(0,num.length-39));

	var numA = new Number(num+2);
	var numB = new Number(num+3);
	newRow.insertCell(0).innerHTML = numA+'.'+"<input style='width:90%;' name='SerN' />";
	newRow.insertCell(1).innerHTML = numB+'.'+"<input style='width:90%;' name='SerN' />";
	tab.rows[tab.rows.length-1].cells[0].colSpan = 3;
	tab.rows[tab.rows.length-1].cells[1].colSpan = 2;
	
	SeName.rowSpan ++;
}
//保存信息【注册】
function savemes(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
	var ReP  = document.getElementById('RePC');//委托书id
	//
	var ctypem = document.getElementById('ctypem').value;//案件类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thna = document.getElementById('thna').innerHTML;//商品名
	var thbz = document.getElementById('thbz').value;//商品说明
	//商品服务
	var atsna = document.getElementsByName('SerN');
	var tsnanum = 1;
	var tsna = '';
	for (var i=0;i<atsna.length;i++) {
		if(atsna[i].value.length>0){
			tsna = tsna +';'+ tsnanum +' '+atsna[i].value;
			tsnanum++;
		}
	}
	tsna = tsna.substr(1,tsna.length);
	tsna = tsna+'.商品截止';
//	alert(tsna);
//	var tsna = document.getElementById('tsna').value;//商品服务
	//
	var sqrid1 = document.getElementById('sqrid').value;
	var sqrid2 = document.getElementById('sqrid1').value;
	var sqrc1 = document.getElementById('sqrc').value;//申请人（中文名）
	var sqrc2 = document.getElementById('sqrc1').value;
	var sqre = document.getElementById('sqre').value;//申请人（英文名）
	var sfzh = document.getElementById('sfzh').value;//证件号
	var yyzz = '';//营业执照号码
	var stmp = document.getElementById('stmp').value;//邮编
	var coty = document.getElementById('coty').value;//国籍
	var addc = document.getElementById('addc').value;//地址(中文)
//	var addc1 = document.getElementById('addc1').value;
	var adde = document.getElementById('adde').value;//地址(英文)
	//
	var ajdlr   = document.getElementById("ajdlr").value;//案件代理人
	var case_bz = document.getElementById('case_bz').value;//备注
	//
	if(sqrid2 == ""||sqrid2 == null||sqrid2 == undefined){
		sqrid = sqrid1;
		sqrc = sqrc;
	}else{
		sqrid = sqrid1 + "、" + sqrid2;
		sqrc = sqrc1 + "、" + sqrc2;
	}
	//
	strm = ctypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+tsna+"#$#"+thbz+"#$#"+case_bz;//信息案件
//	strm = ctypem+'|'+ajh+'|'+ayr+'|'+dlr+'|'+CType+'|'+thna+'|'+tsna+'|'+thbz;
//	strb = sqrc+'|'+sqre+'|'+sfzh+'|'+yyzz+'|'+stmp+'|'+coty+'|'+addc+'|'+adde+'|'+sqrid;
	strb = sqrc+"#$#"+sqrid+"#$#"+addc;//申请人信息
	console.log(strm + "\n---" +strb + "\n---" +ReP.value);
	
	if(ayr.value !="" && dlr.value !=""){
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes',
				strm:strm,
				strb:strb,
				wt_id:ReP.value
			},
			success:function(data){
				alert(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "保存基本信息成功"){//开始保存文件
					var fd = new FormData();
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",ajh);
					var dest = "";
					var tyhb_file =  $("#tyhb").get(0).files;
					if(tyhb_file.length){
						fd_file.append("商标图样黑白",tyhb_file[0]);
//						dest += ","+"商标图样黑白";
						file_num++;
					}
					var other_file =$("#tmp_file").get(0).files;
					if(other_file.length){
						//装载信息
						$("#file_list_2 input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
					}
					if(file_num > 1){
						dest = dest.substr(1);
						fd_file.append("dest",dest);
						$.ajax({
							url:"blogo_action.php",
							type:"post",
							processData:false,
							contentType:false,
							data:fd_file,
							xhr:function(){
								myXhr = $.ajaxSettings.xhr();
								if(myXhr.upload){
									myXhr.upload.addEventListener('progress',uploadProgress,false);
								}
								return myXhr;
							},
							success:function(data){
								alert(data);
								console.log(data);
							},
							error:function(x,s,t){
								alert("保存文件失败！");
								console.log("ajax error!"+s+t);
							}
						});
					}
				}
			},
			error:function(x,s,t){
				alert("保存信息失败！");
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				console.log("ajax error!"+s+t);
			}
		});
	}
}

//保存信息【其他】
function savemes_other(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
	var ReP  = document.getElementById('RePC');//委托书id
	//
	var ctypem = document.getElementById('ctypem').value;//案件类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thna = document.getElementById('thna').innerHTML;//商品名
	var thbz = document.getElementById('thbz').value;//商品说明
	
	var sqh_v = document.getElementById("sqh").value;//申请号
	var rajh_v = document.getElementById("rajh").value;//原案卷号
	
	//专用权期限
	var zyqs_v = document.getElementById("zyqs").value;
	var zyqm_v = document.getElementById("zyqm").value;
	
	//商品服务
	var atsna = document.getElementsByName('SerN');
	var tsnanum = 1;
	var tsna = '';
	for (var i=0;i<atsna.length;i++) {
		if(atsna[i].value.length>0){
			tsna = tsna +';'+ tsnanum +' '+atsna[i].value;
			tsnanum++;
		}
	}
	tsna = tsna.substr(1,tsna.length);
	tsna = tsna+'.商品截止';
//	alert(tsna);
//	var tsna = document.getElementById('tsna').value;//商品服务
	//
	var sqrid = document.getElementById('sqrid').value;
	var sqrc = document.getElementById('sqrc').value;//申请人（中文名）
	var sqre = document.getElementById('sqre').value;//申请人（英文名）
	var sfzh = document.getElementById('sfzh').value;//证件号
	var yyzz = '';//营业执照号码
	var stmp = document.getElementById('stmp').value;//邮编
	var coty = document.getElementById('coty').value;//国籍
	var addc = document.getElementById('addc').value;//地址(中文)
	var adde = document.getElementById('adde').value;//地址(英文)
	//
	var ajdlr   = document.getElementById("ajdlr").value;//案件代理人
	var case_bz = document.getElementById('case_bz').value;//备注
	//
	strm = ctypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+tsna+"#$#"+thbz+"#$#"+case_bz+"#$#"+sqh_v+"#$#"+rajh_v+"#$#"+zyqs_v+"#$#"+zyqm_v;
//	strm = ctypem+'|'+ajh+'|'+ayr+'|'+dlr+'|'+CType+'|'+thna+'|'+tsna+'|'+thbz;
//	strb = sqrc+'|'+sqre+'|'+sfzh+'|'+yyzz+'|'+stmp+'|'+coty+'|'+addc+'|'+adde+'|'+sqrid;
	strb = sqrc+"#$#"+sqrid+"#$#"+addc;
//	console.log(strm + "\n---" +strb + "\n---" +ReP.value);
	
	if(ayr.value !="" && dlr.value !=""){
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes_other',
				strm:strm,
				strb:strb,
				wt_id:ReP.value
			},
			success:function(data){
				alert(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "保存基本信息成功"){//开始保存文件
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",ajh);
					var dest = "";
					var tyhb_file =  $("#tyhb").get(0).files;
					if(tyhb_file.length){
						fd_file.append("商标图样黑白",tyhb_file[0]);
//						dest += ","+"商标图样黑白";
					}
					if(file_num > 1){
						//装载信息
						$("#file_list_2 input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
					}
					dest = dest.substr(1);
					fd_file.append("dest",dest);
					$.ajax({
						url:"blogo_action.php",
						type:"post",
						processData:false,
						contentType:false,
						data:fd_file,
						xhr:function(){
							myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',uploadProgress,false);
							}
							return myXhr;
						},
						success:function(data){
							alert(data);
//							console.log(data);
						},
						error:function(x,s,t){
							alert("保存文件失败！");
							console.log("ajax error!"+s+t);
						}
					});
				}
			},
			error:function(x,s,t){
				alert("保存信息失败！");
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				console.log("ajax error!"+s+t);
			}
		});
	}
}

//保存信息【变更】
function savemes_chang(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
	var ReP  = document.getElementById('RePC');//委托书id
	//
	var ctypem = document.getElementById('ctypem').value;//案件类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thna = document.getElementById('thna').innerHTML;//商品名
	var thbz = document.getElementById('thbz').value;//商品说明
	
	var sqh_v = document.getElementById("sqh").value;//申请号
	
	
	//商品服务
	var atsna = document.getElementsByName('SerN');
	var tsnanum = 1;
	var tsna = '';
	for (var i=0;i<atsna.length;i++) {
		if(atsna[i].value.length>0){
			tsna = tsna +';'+ tsnanum +' '+atsna[i].value;
			tsnanum++;
		}
	}
	tsna = tsna.substr(1,tsna.length);
	tsna = tsna+'.商品截止';
//	alert(tsna);
//	var tsna = document.getElementById('tsna').value;//商品服务
	//
	var sqrid = document.getElementById('sqrid').value;//申请人id
	var sqrc = document.getElementById('sqrc').value;//申请人（中文名）
	var addc = document.getElementById("addc").value;//申请人商标地址
	var sqre = document.getElementById('sqre').value;//申请人（英文名）
	var sfzh = document.getElementById('sfzh').value;//证件号
	var yyzz = '';//营业执照号码
	var stmp = document.getElementById('stmp').value;//邮编
	var coty = document.getElementById('coty').value;//国籍
	var addc = document.getElementById('addc').value;//地址(中文)
	var adde = document.getElementById('adde').value;//地址(英文)
	//
	var ajdlr   = document.getElementById("ajdlr").value;//案件代理人
	var case_bz = document.getElementById('case_bz').value;//备注
	
	//【变更的其他信息】
	var str_other = "";
	var judge_tyhb_1 = document.getElementById("judge_tyhb_1");//是否共有商标
	var judge_tyhb_0 = document.getElementById("judge_tyhb_0");//是否共有商标
	$("#other_info input[type='text']").each(function(){
		str_other += "#$#"+$(this).attr("value");
	});
	if(judge_tyhb_1.checked){
		str_other += "#$#"+"1";
		if(judge_tyhb_0.checked){
			str_other += "#$#"+"1"
		}else{
			str_other += "#$#"+"0"
		}
	}else{
		str_other += "#$#"+"0";
		if(judge_tyhb_0.checked){
			str_other += "#$#"+"1"
		}else{
			str_other += "#$#"+"0"
		}
	}
	$("#other_info input[type='checkbox']").each(function(){
		if($(this).attr("checked")){
			str_other += "#$#"+"1";
		}else{
			str_other += "#$#"+"0";
		}
	});
	str_other = str_other.substr(3);
	//
	strm = ctypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+tsna+"#$#"+thbz+"#$#"+case_bz+"#$#"+sqh_v;
//	strm = ctypem+'|'+ajh+'|'+ayr+'|'+dlr+'|'+CType+'|'+thna+'|'+tsna+'|'+thbz;
//	strb = sqrc+'|'+sqre+'|'+sfzh+'|'+yyzz+'|'+stmp+'|'+coty+'|'+addc+'|'+adde+'|'+sqrid;
	strb = sqrc+"#$#"+sqrid+"#$#"+addc;
//	console.log(strm + "\n---" +strb + "\n---" +ReP.value + "\n---"+str_other);
	
	
	if(ayr.value !="" && dlr.value !=""){
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes_chang',
				strm:strm,
				strb:strb,
				wt_id:ReP.value,
				str_other:str_other
			},
			success:function(data){
				alert(data);
				console.log(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "保存基本信息成功"){//开始保存文件
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",ajh);
					var dest = "";
					var tyhb_file =  $("#tyhb").get(0).files;
					if(tyhb_file.length){
						fd_file.append("商标图样黑白",tyhb_file[0]);
//						dest += ","+"商标图样黑白";
					}
					var other_file =$("#tmp_file").get(0).files;
					if(file_num > 1){
						//装载信息
						$("#file_list_2 input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
					}
					dest = dest.substr(1);
					fd_file.append("dest",dest);
					$.ajax({
						url:"blogo_action.php",
						type:"post",
						processData:false,
						contentType:false,
						data:fd_file,
						xhr:function(){
							myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',uploadProgress,false);
							}
							return myXhr;
						},
						success:function(data){
							alert(data);
							console.log(data);
						},
						error:function(x,s,t){
							alert("保存文件失败！");
							console.log("ajax error!"+s+t);
						}
					});
				}
			},
			error:function(x,s,t){
				alert("保存信息失败！");
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				console.log("ajax error!"+s+t);
			}
		});
	}
}

//保存信息【续展】
function savemes_extension(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
	var ReP  = document.getElementById('RePC');//委托书id
	//
	var ctypem = document.getElementById('ctypem').value;//案件类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thna = document.getElementById('thna').innerHTML;//商品名
	var thbz = document.getElementById('thbz').value;//商品说明
	
	var sqh_v = document.getElementById("sqh").value;//申请号
	
	
	//商品服务
	var atsna = document.getElementsByName('SerN');
	var tsnanum = 1;
	var tsna = '';
	for (var i=0;i<atsna.length;i++) {
		if(atsna[i].value.length>0){
			tsna = tsna +';'+ tsnanum +' '+atsna[i].value;
			tsnanum++;
		}
	}
	tsna = tsna.substr(1,tsna.length);
	tsna = tsna+'.商品截止';
//	alert(tsna);
//	var tsna = document.getElementById('tsna').value;//商品服务
	//
	var sqrid = document.getElementById('sqrid').value;
	var sqrc = document.getElementById('sqrc').value;//申请人（中文名）
	var sqre = document.getElementById('sqre').value;//申请人（英文名）
	var sfzh = document.getElementById('sfzh').value;//证件号
	var addc = document.getElementById("addc").value;//申请人商标地址
	var yyzz = '';//营业执照号码
	var stmp = document.getElementById('stmp').value;//邮编
	var coty = document.getElementById('coty').value;//国籍
	var addc = document.getElementById('addc').value;//地址(中文)
	var adde = document.getElementById('adde').value;//地址(英文)
	//
	var ajdlr   = document.getElementById("ajdlr").value;//案件代理人
	var case_bz = document.getElementById('case_bz').value;//备注
	
	//【续展的其他信息】
	var str_other = "";
	var judge_tyhb_1 = document.getElementById("judge_tyhb_1");//是否共有商标
	var judge_tyhb_0 = document.getElementById("judge_tyhb_0");//是否共有商标
	if(judge_tyhb_1.checked){
		str_other += "#$#"+"1";
		if(judge_tyhb_0.checked){
			str_other += "#$#"+"1"
		}else{
			str_other += "#$#"+"0"
		}
	}else{
		str_other += "#$#"+"0";
		if(judge_tyhb_0.checked){
			str_other += "#$#"+"1"
		}else{
			str_other += "#$#"+"0"
		}
	}
	str_other = str_other.substr(3);
	//
	strm = ctypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+tsna+"#$#"+thbz+"#$#"+case_bz+"#$#"+sqh_v;
//	strm = ctypem+'|'+ajh+'|'+ayr+'|'+dlr+'|'+CType+'|'+thna+'|'+tsna+'|'+thbz;
//	strb = sqrc+'|'+sqre+'|'+sfzh+'|'+yyzz+'|'+stmp+'|'+coty+'|'+addc+'|'+adde+'|'+sqrid;
	strb = sqrc+"#$#"+sqrid+"#$#"+addc;
//	console.log(strm + "\n---" +strb + "\n---" +ReP.value + "\n---"+str_other);
	
	
	if(ayr.value !="" && dlr.value !=""){
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes_extension',
				strm:strm,
				strb:strb,
				wt_id:ReP.value,
				str_other:str_other
			},
			success:function(data){
				alert(data);
//				console.log(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "保存基本信息成功"){//开始保存文件
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",ajh);
					var dest = "";
					var tyhb_file =  $("#tyhb").get(0).files;
					if(tyhb_file.length){
						fd_file.append("商标图样黑白",tyhb_file[0]);
//						dest += ","+"商标图样黑白";
					}
					var other_file =$("#tmp_file").get(0).files;
					if(file_num > 1){
						//装载信息
						$("#file_list_2 input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
					}
					dest = dest.substr(1);
					fd_file.append("dest",dest);
					$.ajax({
						url:"blogo_action.php",
						type:"post",
						processData:false,
						contentType:false,
						data:fd_file,
						xhr:function(){
							myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',uploadProgress,false);
							}
							return myXhr;
						},
						success:function(data){
							alert(data);
							console.log(data);
						},
						error:function(x,s,t){
							alert("保存文件失败！");
							console.log("ajax error!"+s+t);
						}
					});
				}
			},
			error:function(x,s,t){
				alert("保存信息失败！");
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				console.log("ajax error!"+s+t);
			}
		});
	}
}
//保存信息【商标监控_新建】
function savemes_CaseMes(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
//	var ReP  = document.getElementById('RePC');//委托书id
	//
	var ctypem = document.getElementById('ctypem').value;//案件类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thna = document.getElementById('thna').innerHTML;//商品名
	var thbz = document.getElementById('thbz').value;//商品说明
	
	var sqh_v = document.getElementById("sqh").value;//申请号
	var rajh_v = document.getElementById("rajh").value;//原案卷号
	
	//专用权期限
	var zyqs_v = document.getElementById("zyqs").value;
	var zyqm_v = document.getElementById("zyqm").value;
	
	//商品服务
	var atsna = document.getElementsByName('SerN');
	var tsnanum = 1;
	var tsna = '';
	for (var i=0;i<atsna.length;i++) {
		if(atsna[i].value.length>0){
			tsna = tsna +';'+ tsnanum +' '+atsna[i].value;
			tsnanum++;
		}
	}
	tsna = tsna.substr(1,tsna.length);
	tsna = tsna+'.商品截止';
//	alert(tsna);
//	var tsna = document.getElementById('tsna').value;//商品服务
	//
	var sqrid1 = document.getElementById('sqrid').value;
	var sqrid2 = document.getElementById('sqrid1').value;
	if(sqrid2 == ''|| sqrid2 == null || sqrid2 == undefined){
		sqrid = sqrid1;
	}else{
		sqrid = sqrid1+"、"+sqrid2;
	};
	var sqrc1 = document.getElementById('sqrc').value;//申请人（中文名）
	var sqrc2 = document.getElementById('sqrc1').value;
	if(sqrc2 == ''|| sqrc2 == null || sqrc2 == undefined){
		sqrc = sqrc1;
	}else{
		sqrc = sqrc1+"、"+sqrc2;
	};
	var sqre = document.getElementById('sqre').value;//申请人（英文名）
	var sfzh = document.getElementById('sfzh').value;//证件号
	var yyzz = '';//营业执照号码
	var stmp = document.getElementById('stmp').value;//邮编
	var coty = document.getElementById('coty').value;//国籍
	var addc = document.getElementById('addc').value;//地址(中文)
	var adde = document.getElementById('adde').value;//地址(英文)
	//
	var ajdlr   = document.getElementById("ajdlr").value;//案件代理人
	var case_bz = document.getElementById('case_bz').value;//备注
	//
	strm = ctypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+tsna+"#$#"+thbz+"#$#"+case_bz+"#$#"+sqh_v+"#$#"+rajh_v+"#$#"+zyqs_v+"#$#"+zyqm_v;
//	strm = ctypem+'|'+ajh+'|'+ayr+'|'+dlr+'|'+CType+'|'+thna+'|'+tsna+'|'+thbz;
//	strb = sqrc+'|'+sqre+'|'+sfzh+'|'+yyzz+'|'+stmp+'|'+coty+'|'+addc+'|'+adde+'|'+sqrid;
	strb = sqrc+"#$#"+sqrid+"#$#"+addc;
//	console.log(strm + "\n---" +strb + "\n---" +ReP.value);
	
	if(ayr.value !="" && dlr.value !=""){
//		alert(strm);
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes_CaseMes',
				strm:strm,
				strb:strb,
//				wt_id:ReP.value
			},
			success:function(data){
				alert(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "申请号重复！"){
					location.reload(); 
				};
				if(data == "保存基本信息成功"){//开始保存文件
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",ajh);
					var dest = "";
					var tyhb_file =  $("#tyhb").get(0).files;
					if(tyhb_file.length){
						fd_file.append("商标图样黑白",tyhb_file[0]);
//						dest += ","+"商标图样黑白";
					}
					if(file_num > 1){
						//装载信息
						$("#file_list_2 input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
					}
					dest = dest.substr(1);
					fd_file.append("dest",dest);
					$.ajax({
						url:"blogo_action.php",
						type:"post",
						processData:false,
						contentType:false,
						data:fd_file,
						xhr:function(){
							myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',uploadProgress,false);
							}
							return myXhr;
						},
						success:function(data){
							alert(data);
//							console.log(data);
						},
						error:function(x,s,t){
							alert("保存文件失败！");
							console.log("ajax error!"+s+t);
						}
					});
				}
			},
			error:function(x,s,t){
				alert("保存信息失败！");
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				console.log("ajax error!"+s+t);
			}
		});
	}
}

//修改委托书
function changeReP(type){
//	alert(type);
//	添加委托书
	if (type == 'add') {
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 1000;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../../select_ReP.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.wts_id){
						var data = new Array();
						data[0] = localStorage.wts_id;
						var ajh = document.getElementById("ajh").value;
						$.ajax({
							type:"get",
							url:"blogo_action.php",
							async:true,
							data:{
								data:data[0],
								sqr_add: localStorage.wts_address,
								ajh:ajh,
								wts_person:localStorage.wts_personalname,
								wts_personid:localStorage.wts_personalid,
								wts_proprietaryname:localStorage.wts_proprietaryname,
								flag:'addNewReP'
							},
							success:function(data){
			//					alert(data);
								if (data) {
									data = data.split(',');
									var ReF = document.getElementById('ReFW');
									ReF.href = "case_disc.php?mes="+data[0];
									ReF.innerHTML = data[1];
									document.getElementById('WFReP').innerHTML = '';
									alert('案件委托书保存成功!');
									window.location.reload();
								} else{
									alert('案件委托书保存失败!请联系管理员');
								}
							}
						});
						
						localStorage.clear();
					}else{
						alert("未选中委托书！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
//	变更委托书
	else if(type == 'change'){
		var chag = confirm('是否更换委托书？');
		if(chag){
			var scr_height = window.screen.availHeight;
			var scr_width = window.screen.availWidth;
			var bro_height = 500;
			var bro_width = 1000;
			var top = (scr_height-bro_height)/2;
			var left = (scr_width-bro_width)/2;
			var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
			var winobj = window.open("../../../select_ReP.php","_blank",specs);
			var loop = setInterval(function(){
				if(winobj.closed){
					clearInterval(loop);
					if(typeof(Storage)!=="undefined"){
						if(localStorage.wts_id){
//							console.log(localStorage.wts_proprietaryname);
							var data = new Array();
							data[0] = localStorage.wts_id;
							var ajh = document.getElementById("ajh").value;
							$.ajax({
								type:"get",
								url:"blogo_action.php",
								async:true,
								data:{
									data:data[0],
									sqr_add : localStorage.wts_address,
									ajh:ajh,
									wts_person:localStorage.wts_personalname,
									wts_personid:localStorage.wts_personalid,
									wts_proprietaryname:localStorage.wts_proprietaryname,
									flag:'addNewReP'
								},
								success:function(data){
//									console.log(data);
									if (data) {
										data = data.split(',');
										var ReF = document.getElementById('ReF');
										ReF.href = "case_disc.php?mes="+data[0];
										ReF.innerHTML = data[1];
										alert('案件委托书保存成功!');
										window.location.reload();
									} else{
										alert('案件委托书保存失败!请联系管理员');
									}
								}
							});
							
							localStorage.clear();
						}else{
							alert("未选中委托书！");
						}
					}else{
						alert("抱歉！该浏览器版本不支持web存储。");
					}
				}
			},1);
		}
	}else{
		alert('非典型错误，请联系管理员');
	}
}

//案件信息打印
function PrintOut(){
	var ajh_v = document.getElementById("ajh").value;	
	var CType = document.getElementById("CType").value;	
//	console.log(ajh_v+"\n"+flag_str);
	switch(CType){
		case '注册':
			my_url = "../../../TCPDF/my_examples/pdf_one.php?ajh="+ajh_v;
			break;
		case '转让':
			my_url = "../../../TCPDF/my_examples/pdf_B.php?ajh="+ajh_v;
			break;
		case '变更':
			my_url = "../../../TCPDF/my_examples/pdf_C.php?ajh="+ajh_v;
			break;
		case '续展':
			my_url = "../../../TCPDF/my_examples/pdf_D.php?ajh="+ajh_v;
			break;
//		case '其他':
//			my_url = "../../../TCPDF/my_examples/pdf_E.php?ajh="+ajh_v;
//			break;
		default:break;
	}
//	window.open("../../../TCPDF/my_examples/pdf_one.php");
	winobj = window.open(my_url,"_blank");
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1)
}

//保存:注册号 zch 注册日期 zcrq 专用权期限【始】 zyqqx_star 专用权期限【末】zyqqx_end
function Save_something(ajh){
//	alert("ajh");
	var zch = document.getElementById("zch").value;
	var zcrq = document.getElementById("zcrq").value;
	var zyqqx_star = document.getElementById("zyqqx_star").value;
	var zyqqx_end = document.getElementById("zyqqx_end").value;
	var ajzt='申请中';
	if(zyqqx_star !=''&&zyqqx_end!=''){
		ajzt='监控中';
	}
	$.ajax({
		url:'blogo_action.php',
		async:true,
		type:"get",
		data:{
			flag:"save_something",
			ajh:ajh,
			zch:zch,
			zcrq:zcrq,
			zyqqx_star:zyqqx_star,
			zyqqx_end:zyqqx_end
		},
		success:function(data){
//			console.log(data);
			if(zyqqx_end !=""){
				alert(data);
			}else{
				alert(data+"\n“专用权期限【末】”为空，无法创建监控！");
			}
			window.location.reload();
		},
		error:function(xhr,staues,XMLthrow){
			console.log("ajax error!"+statues+XMLthrow);
		}
	});
}
//删除商标详情的其他文件
function del_fs(btn_doc){
	id = btn_doc.id;
	if(confirm("是否删除文件？")){
		btn_doc.onclick = null;
		$.ajax({
			type:"get",
			url:"../del_file.php",
			async:true,
			data:{
				flag:"sb_other",
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
	//			self.location.reload();
				tr_doc = btn_doc.parentNode.parentNode;
				var files_list = document.getElementById("files_list");
				files_list.deleteRow(tr_doc.rowIndex);
			},
			error:function(){
				console.log("ajax error!");
			}
		});	
	}
}
//替换文件
function change_sb(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id;
	flag_name = btn_doc.name;//案卷号
//	alert(id+"////"+flag_name);
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=sb&"+"id="+id+"&"+"flag_name="+flag_name;
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
//替换其他文件
function change(btn_doc){
	btn_doc.onclick = null;
	id = btn_doc.id; 
	if(confirm("是否确认替换当前文件？")){
		var myurl = "../change_file.php"+"?flag=sb_other&"+"id="+id;
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

//上传文件
function upfile(ajh){
	var myurl = "../upfile_sb_other.php"+"?ajh="+ajh;
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
			url:"save_sbkj_new.php",
			async:true,
			data:{
				flag:"new_monitor_sb",
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
						fd.append("flag","new_monitor_upfile_sb");
						fd.append("ajh",ajh);
						fd.append("myfile",int_file[0]);
						$.ajax({
							type:"post",
							url:"save_sbkj_new.php",
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
			url:"save_sbkj_new.php",
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