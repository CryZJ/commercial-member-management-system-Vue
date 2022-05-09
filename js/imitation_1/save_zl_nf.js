							//获取页面数据,异步传递数据
function save_data(tab){
	//获取案件基本信息部分信息
	var tab_ajxh = document.getElementById("ajxh").value;//获取案件序号
	var tab_ajdlr = document.getElementById('ajdlr').value;//获取案件处理人
	var tab_info = tab_ajxh +'|'+ tab_ajdlr;
	
	
//	var tab_sqr = document.getElementById("sqr_id").value;//获取申请人id
	
//	//获取案件申请人表数据
//	var ajsqr_sa = new String();//只获取证件号、地址
//	var Tab_sqr = document.getElementById("tab_sqr");
//	var num_row = Tab_sqr.rows.length;
//	for(i=1;i<num_row;i++){
//		ajsqr_sa = ajsqr_sa+Tab_sqr.rows[i].cells[0].getElementsByTagName("input")[0].value+","+Tab_sqr.rows[i].cells[1].innerHTML +","+ Tab_sqr.rows[i].cells[2].innerHTML+",";
//	}
//	ajsqr_sa = ajsqr_sa.substring(0,ajsqr_sa.length-1);//去掉最后面的“,”
////	alert(ajsqr_sa);
	
//	//获取发明设计人表数据
//	var tab_fmsjr = document.getElementById("tab_fmsjr");
//	var fmsjr_row = tab_fmsjr.rows.length;
////	alert(fmsjr_row);
//	var fmsjr_sa = new String();
////	alert("fmsjr");
//	for (var i = 1;i < fmsjr_row ; i++){
////		alert("ok");
//		var fmsjr_str = new String();
//		for (var y = 0;y < 3;y++) {		
//			if (i == 1 && y == 0) {
//				fmsjr_str += tab_fmsjr.rows[i].cells[y].getElementsByTagName("input")[0].value+"/";
//			} else{
//				fmsjr_str += tab_fmsjr.rows[i].cells[y].innerHTML+"/";
//			}
//		}
//		fmsjr_str = fmsjr_str.substring(0,fmsjr_str.length-1);//去掉最后面的一根“/”	
////		alert(fmsjr_str);
//		fmsjr_sa +=  fmsjr_str+",";
//	}
//	fmsjr_sa = fmsjr_sa.substring(0,fmsjr_sa.length-1);//去掉最后面的一根“/”
////	alert(fmsjr_sa);


//	//获取联系人表数据
//	var tab_lxr = document.getElementById("tab_lxr");
//	var lxr_row = tab_lxr.rows.length;
////	alert(lxr_row);
////	alert("lxr");
//	var lxr_sa = new String();
//	for (var i = 1;i < lxr_row ; i++){
////		alert("ok");
//		var lxr_str = new String();
//		for (var y = 0;y < 7;y++) {
//			if (i == 1 && y == 0) {
//				lxr_str += tab_lxr.rows[i].cells[y].getElementsByTagName("input")[0].value+"/";
////				alert(lxr_str);
//			} else{
//				lxr_str += tab_lxr.rows[i].cells[y].innerHTML+"/";
//			}
//		}
//		lxr_str = lxr_str.substring(0,lxr_str.length-1);
//		lxr_sa += lxr_str+",";
//	}
//	lxr_sa = lxr_sa.substring(0,lxr_sa.length-1);
////	alert(lxr_sa);


	//获取案件申请人的id
	var tab_sqr = document.getElementById('tab_sqr');
	var tab_sqr_nrow = tab_sqr.rows.length;
	var sqr_id = '';
//	alert(tab_sqr_nrow);
	for (i = 1;i < tab_sqr_nrow; i++) {
//		alert(i);
		sqr_id = sqr_id + tab_sqr.rows[i].cells[6].innerHTML + '|';
	}
	sqr_id = sqr_id.substring(0,sqr_id.length-1);//去掉最后面的一根“/”	
//	alert(sqr_id);

	//获取案件备注信息
	var case_bz = document.getElementById("case_bz").value;
//	alert(case_bz);
	
	//获取案件部分详细信息
	var num_row = tab.rows.length; 			//获取案件信息表格行数
	var num_cel = tab.rows[0].cells.length;	//获取一行中的列数
	
	var data_str = new String();			//创建数据字符串
	var arr_row = new Array();				//创建数据数组
	var massage_warming = 0;		//创建用于确认输入位置的数组
	
	//alert(0);								//获取前端输入内容，评判断是否有内容为空
	for(var i = 1; i < num_row; i++){
		var check_null = tab.rows[i].cells[1].getElementsByTagName("input")[0].value.length;
		if(check_null == 0){

			continue;
		}else{
//			计算数据总量
			massage_warming ++;
//			alert(massage_warming);
			
			var str_ajh = tab.rows[i].cells[1].getElementsByTagName("input")[0].value;//获取案卷号
			var str_anlx = tab.rows[i].cells[2].getElementsByTagName("select")[0].value;//获取案卷类型
			var str_ayr = tab.rows[i].cells[3].getElementsByTagName("input")[0].value;//获取案源人
			var str_dlr = tab.rows[i].cells[4].getElementsByTagName("input")[0].value;//获取代理人
			var str_zlmc = tab.rows[i].cells[5].getElementsByTagName("input")[0].value;//获取专利名称
//			var str_lj = tab.rows[i].cells[6].getElementsByTagName("input")[0].value;//获取文件路径
			data_str = str_ajh +"|"+ str_anlx +"|"+ str_ayr +"|"+ str_dlr +"|"+ str_zlmc;
//			alert(data_str);
		}
		if(data_str.length != "||||" ){
			var q = i-1;
			arr_row[q] = data_str;				//字符串加入数组
			data_str = "";						//清空字符串
		}
	}
//	alert("ms="+arr_row+"&"+"tabf="+tab_info+"&"+"bz="+case_bz+"&"+"sqr="+sqr_id);

	if (arr_row.length == 0||arr_row == null ) {	//判断表格数据是否为空
		alert("请填写案件信息");
		return;
	} else{
		var xmlhttp = get_xmlhttp();
		xmlhttp.open("post","casems_save.php","true");
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("ms="+arr_row+"&"+"tabf="+tab_info+"&"+"bz="+case_bz+"&"+"sqr="+sqr_id);
		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
										//"1"为成功，“0”为失败
//			  	alert(xmlhttp.responseText);
			  	var falg = xmlhttp.responseText;
//			  	alert(falg);
				if(1){
//				if(falg == 1){
//					alert(falg);
					//测试用
//					var error = document.getElementById('error');
//					error.value = falg;
					alert("数据保存成功,共保存"+massage_warming+"条数据");
//			  		location.reload();		  		
				}else{
//					document.getElementById("error").value = falg;
					alert("数据保存失败");
//					alert(falg);
				}
			}
		}
	}
}

function get_xmlhttp(){						//创建响应
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}