var ayrName = '';
var dlrName = '';

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
					ayrName = localStorage.ayr_name;
					if(document.getElementById('dlr').value.length>0){
						createajh();
					}
					
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
					dlrName = localStorage.dlr_name;
					createajh();
					
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

//生成案卷号
function createajh(){
	//获取表格中类型、案源人、代理人
	var ayr = document.getElementById('ayr').value;//案源人
	var dlr = document.getElementById('dlr').value;//代理人
	var CaseType = document.getElementById("SelThgType").value;//专案类型
	switch(CaseType){
		case "发明设计":
			var CTNumber = 1;
			break;
		case "实用新型":
			var CTNumber = 2;
			break;
		case "外观设计":
			var CTNumber = 3;
			break;
		default:break;
	}
	if(ayr.length && dlr.length && CaseType.length ){
//		alert(ayrName+'/'+dlrName+'/'+CTNumber);
	    $.ajax({
	    	url:"up.php",
	    	type:"post",
	    	async:true,
	    	data:{
	    		str2:ayrName,
	    		str3:dlrName,
	    		str:CTNumber,
	    		falg:'ajh'
	    	},
	    	success:function(data){
	    		document.getElementById('ajh').value = data;
	    	}
	    });
	}
}

//选择申请人
var xmlHttp;
var sqr_id = new String();
var $ary = new Array();
var SQ = document.getElementById("select_sqr");
SQ.addEventListener("click", function() {
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqr1.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					//		alert(return_data);
					var Tab_sqr = document.getElementById('tab_sqr1');
					var nrow = Tab_sqr.rows.length;
					if(nrow >= 3) {
						Tab_sqr.deleteRow(nrow - 1);
						if(nrow >= 4) {
							Tab_sqr.deleteRow(nrow - 2);
						}
						if(nrow >= 5) {
							Tab_sqr.deleteRow(nrow - 3);
						}
					}
					if(return_data.indexOf(",")>0){
			//			alert(return_data);
						var str = return_data.split(",");
						for (var i=1;i<=str.length;i++) {
							if (i>1) {
								newsqrtab();
							}
							var arr = str[i-1].split('/');
							for (var j=0;j<4;j++) {
								Tab_sqr.rows[i].cells[j].innerHTML = arr[j];
							}
						}
					}else{
						var arr = return_data.split("/");
						Tab_sqr.rows[1].cells[0].innerHTML = arr[0];
						Tab_sqr.rows[1].cells[1].innerHTML = arr[1];
						Tab_sqr.rows[1].cells[2].innerHTML = arr[2];
						Tab_sqr.rows[1].cells[3].innerHTML = arr[3];
					}
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
});
//多个申请人显示，表格增行
function newsqrtab(){
	var tabsqr = document.getElementById('tab_sqr1');
	var tablen = tabsqr.rows.length;
	var newRow = tabsqr.insertRow(tablen);
	newRow.insertCell(0).hidden = "hidden";
	newRow.insertCell(1).innerHTML = "";
	newRow.insertCell(2).innerHTML = "";
	newRow.insertCell(3).innerHTML = "";
//	alert('ok');
}
//保存信息
function CaseMesSave(){
	//获取案件类型
	var CaseType = document.getElementById("SelType");
	//原案卷号
	var OAjh = document.getElementById("OAjh");
//	alert(OAjh.value);
	//获取信息
	var tab = document.getElementById("tab_info");
	var OInput = tab.getElementsByTagName("input");
	var OSelect = tab.getElementsByTagName("select");
	//获取申请人id
	var tab_SQR = document.getElementById("tab_sqr1");
	var SqrId = '';
	for (var i=1;i<tab_SQR.rows.length;i++) {
		SqrId = SqrId+','+tab_SQR.rows[i].cells[0].innerHTML;
	}
	SqrId = SqrId.substr(1,SqrId.length);
	//获取案件备注
	var CaseBZ = document.getElementById("case_bz");
	
	if(OInput[2].value.length<1){
		alert('请生成案卷号');
		return;
	}
	if(CaseType.value.length<1){
		alert('请生成案件类型');
		return;
	}
//	alert(OInput[2].value.length);
	$.ajax({
		type:"get",
		url:"CaseSave.php",
		async:true,
		data:{
			flag:'casesave',
			CaseType:CaseType.value,
			ayr:OInput[0].value,
			dlr:OInput[1].value,
			alx:OSelect[0].value,
			ajh:OInput[2].value,
			amc:OInput[3].value,
			sqh:OInput[4].value,
			sqr:OInput[5].value,
			sqPId:SqrId,
			CaseBz:CaseBZ.value,
			OAjh:OAjh.value
		},
		success:function(data){
			alert(data);
//			console.log(data)
			var ajh = OInput[2].value;
//			alert(ajh);
			//异步保存文件
			if(file_num > 1){
				fd_file.append("flag","upfile_Else");
				fd_file.append("ajh",ajh);
				$.ajax({
					type:"post",
					url:"CaseSave.php",
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
//							console.log(data);
							//清除"代理人","案卷号"的值
							var dlr_doc = document.getElementById("dlr");
							var ajh_doc = document.getElementById("ajh");
							dlr_doc.value = "";
							ajh_doc.value = "";
							OAjh.value = "";
							self.location = '../../../index.php';
						},1000);
					},
					error:function(xhr,staue,xmlthrow){
						console.log("ajax error!" +staue+xmlthrow);
					}
				});
			}else{
				alert("无上传文件");
				//清除"代理人","案卷号"的值
				var dlr_doc = document.getElementById("dlr");
				var ajh_doc = document.getElementById("ajh");
				dlr_doc.value = "";
				ajh_doc.value = "";
				OAjh.value = "";
			}
//			self.location = '../../../index.php';
		}
	});
}
