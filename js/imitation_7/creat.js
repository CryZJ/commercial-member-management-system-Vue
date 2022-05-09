var tab_set = document.getElementById("tab_set");
var tab_set2 = document.getElementById("tab_set2");
var tab_set3 = document.getElementById("tab_set3");

//获取数据并填写
$.ajax({
	data:{
		my_flag:"get_data"
	},
	type:"post",
	url:"yfare_creat.php",
	async:true,
	dataType:"json",
	success:function(data){
//		alert(data['实用新型']['70'][0]);
		var y = 0;
		for(var key_1 in data['发明专利']['100']){
			tab_set.getElementsByTagName("input")[y].value = data['发明专利']['100'][key_1];
			y=y+3;
		}
		var y = 1;
		for(var key_1 in data['发明专利']['85']){
			tab_set.getElementsByTagName("input")[y].value = data['发明专利']['85'][key_1];
			y=y+3;
		}
		var y = 2;
		for(var key_1 in data['发明专利']['70']){
			tab_set.getElementsByTagName("input")[y].value = data['发明专利']['70'][key_1];
			y=y+3;
		}
		
		var y = 0;
		for(var key_1 in data['实用新型']['100']){
			tab_set2.getElementsByTagName("input")[y].value = data['实用新型']['100'][key_1];
			y=y+3;
		}
		var y = 1;
		for(var key_1 in data['实用新型']['85']){
			tab_set2.getElementsByTagName("input")[y].value = data['实用新型']['85'][key_1];
			y=y+3;
		}
		var y = 2;
		for(var key_1 in data['实用新型']['70']){
			tab_set2.getElementsByTagName("input")[y].value = data['实用新型']['70'][key_1];
			y=y+3;
		}
		
		var y = 0;
		for(var key_1 in data['外观设计']['100']){
			tab_set3.getElementsByTagName("input")[y].value = data['外观设计']['100'][key_1];
			y=y+3;
		}
		var y = 1;
		for(var key_1 in data['外观设计']['85']){
			tab_set3.getElementsByTagName("input")[y].value = data['外观设计']['85'][key_1];
			y=y+3;
		}
		var y = 2;
		for(var key_1 in data['外观设计']['70']){
			tab_set3.getElementsByTagName("input")[y].value = data['外观设计']['70'][key_1];
			y=y+3;
		}		
	},
	error:function(){
		alert("ajax error! + 获取数据失败！");
	}
});

/*
 * 更新数据库
 * */
//发明专利
var save_1 = document.getElementById("save_1");
var input_1 = tab_set.getElementsByTagName("input");
save_1.addEventListener("click",function(){
	var str_1 = new String();
	for(i=0;i<18;i=i+3){
		str_1 = str_1+","+input_1[i].value;
	}
	str_1 = str_1 + "/";
	for(i=1;i<18;i=i+3){
		str_1 = str_1+","+input_1[i].value;
	}
	str_1 = str_1 + "/";
	for(i=2;i<18;i=i+3){
		str_1 = str_1+","+input_1[i].value;
	}
	str_1 = str_1.substring(1,str_1.length);
//	alert(str_1);
	$.ajax({
		url:"yfare_creat.php",
		type:"post",
		async:true,
		data:{
			my_flag:"save_1",
			str_data:str_1
		},
		dataType:"json",
		success:function(data){
			alert(data.result+"!");
			location.reload();
//			alert("保存成功！");
		},
		error:function(){
			alert("ajax error! + 发明专利保存失败！");
		}
	});
});

//实用新型
var save_2 = document.getElementById("save_2");
var input_2 = tab_set2.getElementsByTagName("input");
save_2.addEventListener("click",function(){
	var str_2 = new String();
	for(i=0;i<12;i=i+3){
		str_2 = str_2+","+input_2[i].value;
	}
	str_2 = str_2 + "/";
	for(i=1;i<12;i=i+3){
		str_2 = str_2 + "," + input_2[i].value;
	}
	str_2 = str_2 + "/";
	for(i=2;i<12;i=i+3){
		str_2 = str_2+","+input_2[i].value;
	}
	str_2 = str_2.substring(1,str_2.length);
//	alert(str_2);
	$.ajax({
		url:"yfare_creat.php",
		type:"post",
		async:true,
		data:{
			my_flag:"save_2",
			str_data:str_2
		},
		dataType:"json",
		success:function(data){
//			alert(data);
			alert(data.result+"!");
			location.reload();
		},
		error:function(){
			alert("ajax error! + 发明专利保存失败！");
		}
	});
});



//外观设计
var save_3 = document.getElementById("save_3");
var input_3 = tab_set3.getElementsByTagName("input");
save_3.addEventListener("click",function(){
	var str_3 = new String();
	for(i=0;i<12;i=i+3){
		str_3 = str_3+","+input_3[i].value;
	}
	str_3 = str_3 + "/";
	for(i=1;i<12;i=i+3){
		str_3 = str_3 + "," + input_3[i].value;
	}
	str_3 = str_3 + "/";
	for(i=2;i<12;i=i+3){
		str_3 = str_3+","+input_3[i].value;
	}
	str_3 = str_3.substring(1,str_3.length);
//	alert(str_3);
	$.ajax({
		url:"yfare_creat.php",
		type:"post",
		async:true,
		data:{
			my_flag:"save_3",
			str_data:str_3
		},
		dataType:"json",
		success:function(data){
//			alert(data);
			alert(data.result+"!");
			location.reload();
		},
		error:function(){
			alert("ajax error! + 发明专利保存失败！");
		}
	});
});