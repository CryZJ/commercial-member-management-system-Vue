//窗口刷新（替代open.window）
function openWin(url,text,winInfo){  
    var winObj = window.open(url,text,winInfo);  
    var loop = setInterval(function() {
        if(winObj.closed) {      
            clearInterval(loop);      
            //alert('closed');      
            parent.location.reload();   
        }
    }, 1);     
}

//合并通知
function send_all(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
//	alert(tab_nrow);
	var mas = '';
	for(i = 1;i < tab_nrow; i++){
		var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
		var id_num = tab.rows[i].cells[0].getElementsByTagName('input')[0].id;
		if (row_che == true){
			if(tabname == 'dynamic-table'){
//				mas += tab.rows[i].cells[1].innerHTML+'/';//获取id
//				mas += tab.rows[i].cells[3].innerHTML+'//';//获取id
				mas += ","+id_num;
			}
		}
	}
	mas = mas.substring(1);
	
	//异步整理相同“申请人”
	$.ajax({
		type:"get",
		url:"yearcost_ajaxjson.php",
		data:{
			flag:"GetSaveApplicant",
			mes_id: mas
		},
		dataType:"json",
		success:function(data){
//			console.log(data);
			if(data.state){
				if(data.state){
					if(typeof(Storage) !== "undefined"){
						localStorage.clear();
						
						localStorage.noticedata = JSON.stringify(data.data);
						openWin("yearcost_notice_parent.php","_blank","");
					}else{
						alert("对不起，您的浏览器不支持Web存储");
					}
				}else{
					alert(data.state);
				}
//				//窗口设定
//				var scr_height = window.screen.availHeight;
//				var scr_width = window.screen.availWidth;
//				var bro_height = 600;
//				var bro_width = 1200;
//				var top = (scr_height-bro_height)/2;
//				var left = (scr_width-bro_width)/2;
//				var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
//				//循环打开窗口
//				for(ky in data.data){
//					my_url = "yearcost_messend.php?id="+data.data[ky]["id"]+"&"+"ajh="+data.data[ky]["案卷号"]+"&"+"sqr="+data.data[ky]["申请人"]+"&"+"sqrid="+data.data[ky]["申请人id"];
//					openWin(my_url,'_blank',"",false);
//				}
			}else{
				alert(data.message);
			}
		},
		error:function(x,s,t){
			alert("系统错误！");
			console.log("ajax error!"+s+": "+t);
		}
	});
}

//收费
function TollFee(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
	var mas = '';
	if(tabname == 'dynamic-table_7'){
		for(i = 1;i < tab_nrow; i++){
			var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
			if (row_che == true){
//				mas += tab.rows[i].cells[3].innerHTML+'/';
				mas += tab.rows[i].cells[0].getElementsByTagName('input')[0].id + ',';
			}
		}
		if(mas.length){
			mas = mas.substring(0,mas.length-1);
//			console.log(mas);
			
			$.ajax({
				type:"GET",
				url:"yearcost_messend_ajax.php",
				data:{
					my_flag : "Charge",
					costid : mas
				},
				dataType:"json",
				success:function(data){
					console.log(data)
					if(data.state){
						alert(data.message);
						window.location.reload();
					}else{
						alert(data.message);
					}
				},
				error:function(x,s,t){
					alert("收费失败-ajax");
					console.log(s+": "+t)
				}
			});
			
		}else{
			alert('无选择');
			location.reload([true]);
		}
	}else{
		alert('发生错误');
		location.reload([true]);
	}
} 

//合并缴费
function fare_all(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
//	alert(tab_nrow);
	var mas = '';
	for(i = 1;i < tab_nrow; i++){
		var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
		if (row_che == true){
			if(tabname == 'dynamic-table_2'){
				mas += tab.rows[i].cells[3].innerHTML+',';
//				alert(mas);
			}
		}
	}
	mas = mas.substring(0,mas.length-1);
//	alert(mas);
	my_url = "yearcost_change.php?mas="+mas;
	openWin(my_url,'_blank',"",false);
}

//合并收据
function shouju_all(tabname){
//	var tab = document.getElementById(tabname);
//	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
////	alert(tab_nrow);
//	var mas = '';
//	for(i = 1;i < tab_nrow; i++){
//		var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
//		if (row_che == true){
//			if(tabname == 'dynamic-table_3'){
//				mas += tab.rows[i].cells[3].innerHTML+'/';
////				alert(mas);
//			}
//		}
//	}
//	mas = mas.substring(0,mas.length-1);
////	alert(mas);
	var tab = document.getElementById(tabname);
		var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
		var mas = '';
		var PayDate = "";
		if(tabname == 'dynamic-table_3'){
			
			var y=0;
			for(i = 1;i < tab_nrow; i++){
				if (tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
					if(y==0){
						PayDate = tab.rows[i].cells[10].innerHTML;
					}
//					alert('ok');
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
					if(PayDate != tab.rows[i].cells[10].innerHTML && PayDate.length>0){
						alert('注意，只有缴费日期相同才能合并收据，请重新选择');
						return;
					}
				}
			}
		}else{
			alert('发生错误');
			location.reload([true]);
			return;
		}
//		alert('ok');
		mas = mas.substring(0,mas.length-1);
		my_url = "yearcost_check.php?mas="+mas;
		openWin(my_url,'_blank',"",false);
}

//更换收据
//合并收据
function shouju_all_2(tabname){
//	var tab = document.getElementById(tabname);
//	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
////	alert(tab_nrow);
//	var mas = '';
//	for(i = 1;i < tab_nrow; i++){
//		var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
//		if (row_che == true){
//			if(tabname == 'dynamic-table_3'){
//				mas += tab.rows[i].cells[3].innerHTML+'/';
////				alert(mas);
//			}
//		}
//	}
//	mas = mas.substring(0,mas.length-1);
////	alert(mas);
	var tab = document.getElementById(tabname);
		var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
		var mas = '';
		var PayDate = "";
		if(tabname == 'dynamic-table_4'){
			
			var y=0;
			for(i = 1;i < tab_nrow; i++){
				if (tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
					if(y==0){
						PayDate = tab.rows[i].cells[10].innerHTML;
					}
//					alert('ok');
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
					if(PayDate != tab.rows[i].cells[10].innerHTML && PayDate.length>0){
						alert('注意，只有缴费日期相同才能合并收据，请重新选择');
						return;
					}
				}
			}
		}else{
			alert('发生错误');
			location.reload([true]);
			return;
		}
//		alert('ok');
		mas = mas.substring(0,mas.length-1);
		my_url = "yearcost_check.php?mas="+mas;
		openWin(my_url,'_blank',"",false);
}

function showtabinfo(flag){
	var distance = document.getElementById('disd');
	var overdue  = document.getElementById('over');
	disdata = distance.value;
	overdata = overdue.value;
	var mes = '';
//	alert('ok');
	switch(flag){
		case 'disd':
			window.location.href="yearcost.php?flag=disd&v="+disdata;
			break;
		case 'over':
			window.location.href="yearcost.php?flag=over&v="+overdata;
			break;
		default:
			alert('此模块出现未知错误，请尽快联系管理员');
	}
}
//窗口刷新（替代open.window）
function openWin(url,text,winInfo){  
    var winObj = window.open(url,text,winInfo);  
    var loop = setInterval(function() {       
        if(winObj.closed) {      
            clearInterval(loop);      
            //alert('closed');      
            parent.location.reload();   
        }      
    }, 1);     
} 
//费用导出

//window.open的post传输数据函数
function openPostWindow(url, name, data1, data2 , data3){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="xtid";
     hideInput1.value = data1;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="xtmc";
     hideInput2.value = data2;
     var hideInput3 = document.createElement("input");
     hideInput3.type = "hidden";
     hideInput3.name="data3";
     hideInput3.value = data3;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
     tempForm.appendChild(hideInput3);
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


//年费导出Word
function exportWord_year(){
	var my_table = document.getElementById("my_table").getElementsByTagName("input");
	var my_table2 = document.getElementById("my_table2").getElementsByTagName("input");
	var my_table3 = document.getElementById("my_table3").getElementsByTagName("input");
	var my_table4 = document.getElementById("my_table4").getElementsByTagName("input");
	var str = new String();
	for(i=0;i<my_table.length;i++){
		str = str + my_table[i].value + "|";
	}
	
	for(i=0;i<my_table2.length;i++){
		str = str + my_table2[i].value + "|";
	}
	
	for(i=0;i<my_table4.length;i++){
		str = str + my_table4[i].value + "|";
	}
	
	for(i=0;i<my_table3.length;i++){
		str = str + my_table3[i].value + "|";
	}
	
	str = str.substr(0,(str.length-1));
	console.log(str);//操作员|申请人|事由|发函日|回复期限|客户联系方式|我方联系方式|银行账户
//	alert(str);
	var str2 = new String();
	var tab_inp = document.getElementById("tab_info").getElementsByTagName("input");
	for(i=0;i<tab_inp.length;i++){
		str2 = str2 + tab_inp[i].value + ",";
	}
	str2 = str2.substr(0,(str2.length-1));
	console.log(str2);//id,专利号，专利名，申请日，年度，年费，代理费，滞纳金，小计...总计
//	alert(str2);
//异步更新数据库专案需交费
	$.ajax({
		data:{
			my_flag:"data_update",
			str2:str2
		},
		type:"post",
		url:"yearcost_messend_ajax.php",
		async:true,
		success:function(data){
//			alert(data);
			openPostWindow("../../phpword/year_fee.php",'_blank',str,str2,data);
			window.onblur = function(){
				window.close();
			}
		},
		error:function(){
			alert("ajac error! + 更新数据库专案需交费");
		}
	});
}


function delf(did){
	if(confirm("是否确认删除该费用？")){
		$.ajax({
			url:'yearcost_ajax.php',
			async:true,
			type:'post',
			data:{
				flag:'yearcost_del',
				id:did
			},
			success:function(){
				alert('操作成功');
				location = location;
			}
		});
	}
	
//	alert(did);
}

//修改费用函数
function Cost_alter(a_doc){
	var cost_id = document.getElementById("cost_id");
	var cost_value = document.getElementById("cost_value");
	cost_id.value = a_doc.id;
	tr_doc = a_doc.parentNode.parentNode;
	cost_value.value = tr_doc.cells[8].innerHTML;
}

//修改费用保存函数
function Save_alterdata(){
	var cost_id = document.getElementById("cost_id");
	var cost_value = document.getElementById("cost_value");
	$.ajax({
		url:'yearcost_ajax.php',
		async:true,
		type:'post',
		data:{
			flag:'yearcost_alter',
			id:cost_id.value,
			fee:cost_value.value
		},
		success:function(data){
			alert(data);
//			location = location;
//			window.location.reload();
		},
		error:function(xhr,status,xmlthrow){
			console.log("ajax error!"+status+xmlthrow);
		}
	});
	
}

//导出面向专利局Excel
function showExcel(){
	//获取文件名
	var FileName = document.getElementById("FName").value;//获取费用id
	var fid = document.getElementById("fid").value;//获取费用id
	//开窗口传值
	var my_url = "../../phpexcel-test.php?fid="+fid+"&"+"fname="+FileName+"&"+"feeflag=yearcost";
	window.open(my_url,"_blank");
	window.onblur = function(){
		window.close();
	}
}


//表格选中的批量删除(input标签的id为数据库的id)
function DeleteAll_tab(tab_id,del_flag){
	if(confirm("是否确认删除？")){
		var tab_doc = document.getElementById(tab_id);
		if(tab_doc.rows.length-2){
			var str_id = "";
			//获取选中的id，除第一行
			for(i=1,len=tab_doc.rows.length;i<len;i++){
				if(tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].checked){
					str_id += tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].id + ",";
				}
			}
			if(str_id != ""){
				str_id = str_id.substr(0,str_id.length-1);//去掉最后一个分割符
//				alert(str_id);
				//异步删除	
				$.ajax({
					type:"get",
					url:"yearcost_ajax.php",
					async:true,
					data:{
						flag:del_flag,
						str_id:str_id
					},
					success:function(data){
						alert(data);
						window.location.reload();
					},
					error:function(XMLhttprequest,errorstatus,errorThrow){
						alert("删除失败");
						console.log("ajax error!"+XMLhttprequest+errorstatus+errorThrow);
					}
				});
				
			}else{
				alert("本页没有选中的行！");
			}
		}else{
			alert("无数据!");
		}
	}
}
//提前通知
	function Info_Befo(){
		var tab = document.getElementById("dynamic-table_6");
		var TabLen  = tab.rows.length;
		var MesId = '';
		for (var i=1;i<TabLen;i++) {
			if(tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
				MesId = MesId+'|'+tab.rows[i].cells[3].innerHTML;
			}
		}
		MesId = MesId.substr(1,MesId.length);
//		alert(MesId);
//		//如果选中了费用
		if(MesId.length){
			$.ajax({
				type:"get",
				url:"CY_ChanSta.php",
				async:true,
				data:{
					id:MesId,
					flag:'MonToInfo'
				},
				success:function (data){
					alert(data);
					location.reload();
//					console.log(data);
				}
			});
			return;
		}
		//如果没选中费用
		alert('请选中费用后再进行操作');
	}

