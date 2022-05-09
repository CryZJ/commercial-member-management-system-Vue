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
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 900;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					$("#"+id).attr("value",localStorage.dlr_name);
					$("#dlrid").attr("value",localStorage.dlr_id);
					localStorage.clear();
					creatajh();
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
					$("#"+id).attr("value",localStorage.ayr_name);
					$("#ayrid").attr("value",localStorage.ayr_id);
					localStorage.clear();
					creatajh();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开委托书窗口[转让人]
function openW(){
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
					var RePN = document.getElementById('ReP');
					var RePId = document.getElementById('RePC');
					var ajlx = document.getElementById("ajlx");
					
					RePId.value = localStorage.wts_id;
					RePN.value = localStorage.wts_proprietaryname;
					ajlx.innerHTML = localStorage.wts_type;
					document.getElementById('addc').value = localStorage.wts_address;
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
							//证件图,营业执照图,营业执照翻,证件翻 idyj SPic yyfyj idfyj
							var sqrid = document.getElementById('sqrid');
							sqrid.value = data['id']
							document.getElementById('sqrc').value=data['申请人'];//中文名
							document.getElementById('sqre').value=data['英文名'];//英文名
							document.getElementById('sfzh').value=data['证件号'];//IDN
		//					document.getElementById('addc').value=data['地址'];//地址
							document.getElementById('adde').value=data['地址E'];//地址E
							document.getElementById('stmp').value=data['邮政编码'];//邮编
							document.getElementById('coty').value=data['国籍'];//国籍
							
							localStorage.clear();
						},
						error:function(XMLhttprequest,errorstatus,errorThrow){
							console.log("ajax error!"+errorstatus+errorThrow);
						}
					});
				}else{
					alert("未选中委托书！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开委托书窗口
function openW2(){
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
					var RePN = document.getElementById('ReP2');
					var RePId = document.getElementById('RePC2');
					var ajlx = document.getElementById("ajlx2");
					var sqh = document.getElementById("sqh");
					
					RePId.value = localStorage.wts_id;
					RePN.value = localStorage.wts_proprietaryname;
					ajlx.innerHTML = localStorage.wts_type;
					document.getElementById('addc2').value = localStorage.wts_address;
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
							var sqrid = document.getElementById('sqrid2');
							sqrid.value = data['id']
							document.getElementById('sqrc2').value=data['申请人'];//中文名
							document.getElementById('sqre2').value=data['英文名'];//英文名
							document.getElementById('sfzh2').value=data['证件号'];//IDN
//							document.getElementById('addc2').value=data['地址'];//地址
//							alert(data['地址']);
							document.getElementById('adde2').value=data['地址E'];//地址
							document.getElementById('stmp2').value=data['邮政编码'];//邮编
							document.getElementById('coty2').value=data['国籍'];//国籍
							
							localStorage.clear();
						},
						error:function(XMLhttprequest,errorstatus,errorThrow){
							console.log("ajax error!"+errorstatus+errorThrow);
						}
					});
				}else{
					alert("未选中委托书！");
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


//保存信息【转让】
function savemes_transfer(btn_doc){
	btn_doc.onclick = null;
	var strm = '';//案件信息-表格1
	var strb = '';//人员信息-表格2
	//
	var ReP  = document.getElementById('RePC');//委托书id【转让】
	var ReP_2  = document.getElementById('RePC2');//委托书id【受让】
	
	
	var ATypem = document.getElementById("ATypem").value;//受让人类型
	var ajh = document.getElementById('ajh').value;//案卷号
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CType = document.getElementById('CType').value;//类别
	var thbz = document.getElementById('thbz').value;//商品说明
	var sqh_v = document.getElementById("sqh").value;//申请号
	var case_bz = document.getElementById('case_bz').value;//备注
	
	//转让人
	var sqrid = document.getElementById('sqrid').value;
	var sqrc = document.getElementById('sqrc').value;//申请人（中文名）
	var addc = document.getElementById("addc").value;
	//受让人
	var sqrid_2 = document.getElementById('sqrid2').value;
	var sqrc_2= document.getElementById('sqrc2').value;//申请人（中文名）
	var addc_2 = document.getElementById("addc2").value;//地址
	
	//【转让的其他信息】
	var DTypem = document.getElementById("DTypem").value;//转让人类型
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
	
	str_other = str_other.substr(3);
	//
	strm = ATypem+"#$#"+ayr+"#$#"+dlr+"#$#"+ajh+"#$#"+CType+"#$#"+thbz+"#$#"+case_bz+"#$#"+sqh_v;
	strb = sqrc_2+"#$#"+sqrid_2+"#$#"+addc_2; 
	str_other += "#$#"+ sqrid+"#$#"+sqrc+"#$#"+addc+"#$#"+DTypem+"#$#"+ReP.value;
//	console.log(strm + "\n---" +strb + "\n---" +ReP_2.value + "\n---"+str_other);
	
	var file_ajh = ajh;
	if(ayr.value !="" && dlr.value !=""){
		$.ajax({
			url:'blogo_action.php',
			async:true,
			type:"post",
			data:{
				flag:'savemes_transfer',
				strm:strm,
				strb:strb,
				wt_id:ReP_2.value,
				str_other:str_other
			},
			success:function(data){
				alert(data);
				console.log(data);
				document.getElementById("dlr").value ="";
				document.getElementById("ajh").value ="";
				if(data == "保存基本信息成功"){//开始保存文件
//					alert(file_ajh);
					fd_file.append("flag","sb_upfile");
					fd_file.append("ajh",file_ajh);
					var dest = "";
					if(file_num > 1){
						//装载信息+文件 
						$("#file_list input").each(function(i){
							if($(this).attr("value")){
								dest += ","+$(this).attr("value");
							}else{
								dest += ","+"无";
							}
						});
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
								setTimeout(function(){
									alert(data);
//									console.log(data);
								},1000)
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