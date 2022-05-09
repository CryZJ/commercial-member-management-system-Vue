

//导出面向专利局Excel
function showExcel(){
//	if(document.getElementById("judge_confige").value == "已确认"){
			//获取文件名
		var FileName = document.getElementById("FName").value;//获取费用id
		var fid = document.getElementById("fid").value;//获取费用id
		//开窗口传值
		var my_url = "../../phpexcel-test.php?fid="+fid+"&"+"fname="+FileName+"&"+"feeflag=cost";
	//	window.open('../../phpexcel-test.php?fid='+fid,'','');
		window.open(my_url,"_blank");
		window.onblur = function(){
			window.close();
		}
//	}else{
//		alert("请先确认后再进行导出Excel！");
//	}
}

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


//导出Word
function openPostWindow_word(url,name,data1,data2,data3,data4,data5,data6,data7){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="data1";
     hideInput1.value = data1;
     tempForm.appendChild(hideInput1);
     
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="data2";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput2);

     var hideInput3 = document.createElement("input");
     hideInput3.type = "hidden";
     hideInput3.name="data3";
     hideInput3.value = data3;
     tempForm.appendChild(hideInput3);

     var hideInput4 = document.createElement("input");
     hideInput4.type = "hidden";
     hideInput4.name="data4";
     hideInput4.value = data4;
     tempForm.appendChild(hideInput4);

     var hideInput5 = document.createElement("input");
     hideInput5.type = "hidden";
     hideInput5.name="data5";
     hideInput5.value = data5;
     tempForm.appendChild(hideInput5);
     
	 var hideInput6 = document.createElement("input");
     hideInput6.type = "hidden";
     hideInput6.name="data6";
     hideInput6.value = data6;
     tempForm.appendChild(hideInput6);
     
     var hideInput7 = document.createElement("input");
     hideInput7.type = "hidden";
     hideInput7.name="data7";
     hideInput7.value = data7;
     tempForm.appendChild(hideInput7);

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

function Ajax_CreateWord(url,data1,data2,data3,data4,data5,data6,data7){
	$.ajax({
		type:"post",
		url:url,
		async:true,
		data:{
			data1 : data1,
			data2 : data2,
			data3 : data3,
			data4 : data4,
			data5 : data5,
			data6 : data6,
			data7 : data7
		},
		success:function(data){
			if(data == "success"){
				$("#waitingtodel").addClass("hidden");
				$("#downloadfile").removeClass("hidden");
				$("#downloadfile").attr("href","Downloadfile.php?filename=../../filesave_notice/"+data7);
				$("#closewindow").removeClass("hidden");
			}else{
				console.log(data);
			}
		},
		error:function(x,s,t){
			console.log("ajax error!"+s+t);
		}
	});
}

function exportWord(){

	$("#btn2").addClass("hidden");
	$("#waitingtodel").removeClass("hidden");
	
	//头部
	var top_str = new String();
	var my_table = document.getElementById("my_table").getElementsByTagName("input");
	var top_str = my_table[1].value+"||"+my_table[3].value+"||"+my_table[4].value;
//	alert(top_str);//致||发函日期||回复日期
//	console.log(top_str);
//	客户联系人
	var cli_link = new String();
	var my_table2 = document.getElementById("my_table2");//获取表格
	var my_table2Len = document.getElementById("my_table2").rows.length;//计算表格行数
	for(var i=2;i<my_table2Len;i++){
		for(var j=0;j<4;j++){
//			alert(j+'/'+i);
			cli_link += my_table2.rows[i].cells[j].getElementsByTagName('input')[0].value+'||';
		}
		cli_link = cli_link.substr(0,(cli_link.length-2));
		cli_link += '||';
	}
	cli_link = cli_link.substr(0,(cli_link.length-2));
	console.log(cli_link);
//	alert(cli_link); //联系人||固话||手机||邮箱,联系人||固话||手机||邮箱
	//我方联系人
	var my_link = new String();
	var my_table4 = document.getElementById("my_table4").getElementsByTagName("input");
	for(i=0;i<my_table4.length;i++){
		my_link = my_link + my_table4[i].value + "||";
	}	
	my_link = my_link.substr(0,(my_link.length-2));
	console.log(my_link);
//	alert(my_link) ;联系人||固话||手机||邮箱
	//银行账户
	var bank = new String();
	var my_table3 = document.getElementById("my_table3").getElementsByTagName("input");
	for(i=0;i<my_table3.length;i++){
		bank = bank + my_table3[i].value + ",";
	}
	bank = bank.substr(0,(bank.length-1));
	console.log(bank);
//	alert(bank) ;//开户银行,户名,银行账号
	//列表信息
	var str2 = new String();
	var tab = document.getElementById("tab_info");
	for(i=1;i<tab.rows.length-1;i++){
		for (y=1;y<tab.rows[1].cells.length;y++) {
			if(y==6){
				str2 = str2 + tab.rows[i].cells[6].getElementsByTagName('input')[0].value + ",";
			}else{
				str2 = str2 + tab.rows[i].cells[y].innerHTML + ",";
			}
		}
	}
	str2 = str2 + tab.rows[tab.rows.length-1].cells[2].innerHTML;
//	str2 = str2.substr(0,(str2.length-1));
	console.log(str2);//专利号,专利名,申请日,登记费,年费,代理费,小计,总计
//	alert(str2);

	//申请号,用来更新状态作判断条件
	var sqh = new String();
	var tab_sqr = document.getElementById("tab_info");
	var row_num = tab_sqr.rows.length;
	for(i=1;i<row_num-1;i++){
		sqh = sqh + tab_sqr.rows[i].cells[1].innerHTML + ",";
	}
	sqh = sqh.substr(0,(sqh.length-1));
//	alert(sqh);
	
//	客户联系人，费用的行数
	var my_table2 = document.getElementById("my_table2");
	var row_cli = my_table2.rows.length - 1;
	send_num = row_cli +","+ (row_num-2) ;
//	alert(send_num);

//	var mess = document.getElementById('mess');

//异步更新数据库专案需交费
	var ajh = document.getElementById("mess").value;
	var SQRId = document.getElementById("SQRId").value;
	$.ajax({
		data:{
			my_flag:"data_update",
			sqh:sqh,
			SQRId:SQRId,
			ajh:ajh
//			mess:mess.value
		},
		type:"post",
		url:"cost_messend_ajax.php",
		async:true,
		success:function(data){
//			alert(data);console.log(data);
//			openPostWindow_word("../../phpword/impower_fee.php",'_blank',top_str,cli_link,my_link,bank,str2,send_num,data);//导出Word
			Ajax_CreateWord("../../phpword/impower_fee.php",top_str,cli_link,my_link,bank,str2,send_num,data)//异步生成Word文件
			
//			window.onblur = function(){//当该窗口失去焦点时执行该函数
//				window.close();
//			};

		},
		error:function(){
			alert("ajac error! + 更新数据库专案需交费");
		}
	});
}

//年费导出Word
function exportWord_year(){
	var my_table = document.getElementById("my_table").getElementsByTagName("input");
	var my_table2 = document.getElementById("my_table2").getElementsByTagName("input");
	var my_table3 = document.getElementById("my_table3").getElementsByTagName("input");
	var str = new String();
	for(i=0;i<my_table.length;i++){
		str = str + my_table[i].value + ",";
	}
	for(i=0;i<my_table2.length;i++){
		str = str + my_table2[i].value + ",";
	}
	for(i=0;i<my_table3.length;i++){
		str = str + my_table3[i].value + ",";
	}
	str = str.substr(0,(str.length-1));
//	alert(str);
	var str2 = new String();
	var tab_inp = document.getElementById("tab_info").getElementsByTagName("input");
	for(i=0;i<tab_inp.length;i++){
		str2 = str2 + tab_inp[i].value + ",";
	}
	str2 = str2.substr(0,(str2.length-1));
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
			openPostWindow("../../phpword/year_fee.php",'test',str,str2,data);
		},
		error:function(){
			alert("ajac error! + 更新数据库专案需交费");
		}
	});
}



