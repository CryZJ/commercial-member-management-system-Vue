function data_save(){
	var base_arr = new Array();
	base_arr[0] = document.getElementById('ajh').value;
	base_arr[1] = document.getElementById('nfj').value;
	base_arr[2] = document.getElementById('ffj').value;
	base_arr[3] = document.getElementById('sqr').value;
	base_arr[4] = document.getElementById('sqh').value;
//	alert(base_arr);
	
	var Tab_fare = document.getElementById('tab_fare');
	var fee_length = Tab_fare.rows.length;//有费用的行数___6
//	alert(fee_length);
	//获取费用名称及金额
	var fee_arr = new Object();//数组无法成功改用对象
	for(var i=1;i<=fee_length-5;i++){
			//获取费用名称及金额
			var fee_name = Tab_fare.rows[i].cells[0].innerHTML;
//			var fee = Tab_fare.rows[i].cells[1].innerHTML;
			var fee = Tab_fare.rows[i].cells[1].getElementsByTagName("input")[0].value;
//			alert(fee_name+fee);
			fee_arr[fee_name]=fee;			
	}
	
	
	var fee_time = new Array();
	//获取发文日期
	var time_value = Tab_fare.rows[fee_length-3].cells[1].innerHTML;
	fee_time[0] = time_value;
	//获取截止日期
	var time_value = Tab_fare.rows[fee_length-2].cells[1].innerHTML;
	fee_time[1] = time_value;
	//获取提醒时间
	time_value = Tab_fare.rows[fee_length-1].cells[1].getElementsByTagName('input')[0].value;
	fee_time[2] = time_value;
//	alert(fee_time);
	
//	var x
//	for(x in mydata){
//		alert(x+"："+mydata[x]+"<br/>");
//	}
//	alert(base_arr+fee_arr[fee_name]+fee_time);
	$.ajax({
		type:"post",
		url:"info_sqing_save.php",
		async:true,
		data:{
			base: base_arr,
			fee : fee_arr,
			fee_time : fee_time
		},
		dataType:"json",
		success: function(data){
//			alert(data);
			alert(data.result);
			window.close();
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});

}

function data_save2(){
	var base_arr = new Array();
	base_arr[0] = document.getElementById('ajh').value;
//	alert(base_arr);
	
	var Tab_fare = document.getElementById('tab_fare');
	var fee_length = Tab_fare.rows.length;//有费用的行数
//	alert(fee_length);
	//获取费用名称及金额
	var fee_arr = new Object();//数组无法成功改用对象
	for(var i=1;i<fee_length-4;i++){
			//获取费用名称及金额
			var fee_name = Tab_fare.rows[i].cells[0].innerHTML;
			var fee = Tab_fare.rows[i].cells[1].getElementsByTagName("input")[0].value;
//			alert(fee_name+fee);
			fee_arr[fee_name]=fee;
//			alert(fee_name+"=>"+fee_arr[fee_name]);
	}
	
	
	var fee_time = new Array();
	//获取发文日期
	var time_value = Tab_fare.rows[fee_length-3].cells[1].innerHTML;
	fee_time[0] = document.getElementById("fwr").innerHTML;
	//获取截止日期
	var time_value = Tab_fare.rows[fee_length-2].cells[1].innerHTML;
	fee_time[1] = document.getElementById("jfjzrq").innerHTML;
	//获取提醒时间
	time_value = Tab_fare.rows[fee_length-1].cells[1].getElementsByTagName('input')[0].value;
	fee_time[2] = document.getElementById("txsj").value;
//	alert(fee_time);
	
//	alert(base_arr+fee_arr+fee_time);
	$.ajax({
		type:"post",
		url:"info_squan_save.php",
		async:true,
		data:{
			my_flag:"保存费用",
			base: base_arr,
			fee : fee_arr,
			fee_time : fee_time
		},
		dataType:"json",
		success: function(data){
//			alert(data);
			alert(data.result+"!");
//			window.returnValue='success';
			window.close();
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("ajax error! + 保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});	
}

function data_save3(){
	//获取案卷号
	ajh = document.getElementById('ajh').value;
	//获取列表信息
	var fee_arr = new Array();
	Tab = document.getElementById("tab_base");
	var R_num = Tab.rows.length;
	for(i=1;i<R_num;i++){
		fee_arr[i-1] = new Array();
		fee_arr[i-1][0] = Tab.rows[i].cells[0].innerHTML;
		fee_arr[i-1][1] = Tab.rows[i].cells[1].getElementsByTagName("input")[0].value;
		fee_arr[i-1][2] = Tab.rows[i].cells[2].innerHTML;
		fee_arr[i-1][3] = Tab.rows[i].cells[3].getElementsByTagName("input")[0].value;
		fee_arr[i-1][4] = Tab.rows[i].cells[4].innerHTML;
		fee_arr[i-1][5] = Tab.rows[i].cells[5].innerHTML;
		fee_arr[i-1][6] = Tab.rows[i].cells[6].innerHTML;
		fee_arr[i-1][7] = Tab.rows[i].cells[7].innerHTML;
		fee_arr[i-1][8] = Tab.rows[i].cells[8].innerHTML;
//		alert(fee_arr[i-1][1]);
	}
//	alert(fee_arr[1]);
	
	$.ajax({
		type:"post",
		url:"info_zsdengji_save.php",
		async:true,
		data:{
			ajh: ajh,
			fee : fee_arr,
		},
		dataType:"json",
		success: function(data){
//			alert(data);
			alert(data.result+"!");
//			window.returnValue='success';
			window.close();
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});
}

function data_save4(){
	var ajh = document.getElementById('ajh2').value;
	var sqggr = document.getElementById('sqggr').value;
	var nfsnd = document.getElementById("nfsnd").value;
//	alert(ajh +" " +sqggr +"  "+ nfsnd);
	$.ajax({
		type:"post",
		url:"info_squan_save.php",
		async:true,
		data:{
			my_flag:"保存授权公告日",
			ajh:ajh,
			sqggr:sqggr,
			nfsnd:nfsnd
		},
		dataType:"json",
		success: function(data){
			alert(data.result);
//			alert(data.result);
//			window.returnValue='success';
//			window.close();
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});
}

function data_save5(){
//保存授权公告日，首年年度	
	var ajh = document.getElementById('ajh').value;
	var sqggr = document.getElementById('sqggr').value;
	var nfsnd = document.getElementById("nfsnd").value;
//	alert(ajh +" " +sqggr +"  "+ nfsnd);
	$.ajax({
		type:"post",
		url:"info_squan_save.php", 
		async:false,  
		data:{
			my_flag:"保存授权公告日",
			ajh:ajh,
			sqggr:sqggr,
			nfsnd:nfsnd
		},
		dataType:"json",
		success: function(data){
//			alert(data);
			alert(data.result);
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});
	

//费用
	var base_arr = new Array();
	base_arr[0] = document.getElementById('ajh').value;
//	alert(base_arr);
	
	var Tab_fare = document.getElementById('tab_fare');
	var fee_length = Tab_fare.rows.length;//有费用的行数
//	alert(fee_length);
	//获取费用名称及金额
	var fee_arr = new Object();//数组无法成功改用对象
	for(var i=1;i<fee_length-4;i++){
			//获取费用名称及金额
			var fee_name = Tab_fare.rows[i].cells[0].innerHTML;
//			var fee = Tab_fare.rows[i].cells[1].innerHTML;
			var fee = Tab_fare.rows[i].cells[1].getElementsByTagName("input")[0].value;
//			alert(fee_name+fee);
			fee_arr[fee_name]=fee;
//			alert(fee_name+"=>"+fee_arr[fee_name]);
	}
	
	
	var fee_time = new Array();
	//获取发文日期
	fee_time[0] = document.getElementById("fwr").innerHTML;
	//获取截止日期
	fee_time[1] = document.getElementById("jfjzrq").innerHTML;
	//获取提醒时间
	fee_time[2] = document.getElementById("txsj").value;
//	alert(fee_time);
	
//	alert(base_arr+fee_arr+fee_time);
	$.ajax({
		type:"post",
		url:"info_squan_save.php",
		async:true,
		data:{
			my_flag:"保存费用",
			base: base_arr,
			fee : fee_arr,
			fee_time : fee_time
		},
		dataType:"json",
		success: function(data){
//			alert(data);
			alert(data.result);
			console.log(data.result);
//			window.returnValue='success';
			window.close();
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("ajax error! + 保存失败！"+XMLHttpRequest+textStatus+errorThrown);
		}
	});	
	
}

