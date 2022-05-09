
//select的value填入input
function SetInput(sel_doc){
	var inp = sel_doc.parentNode.getElementsByTagName("input")[0];
	inp.value = sel_doc.value;
}

//增加表格的行数
function Add_row(tr_doc,tab_id){
	if($("#kh_id").val()){
		newRow = '<tr><td><input type="date" /> </td><td><input type="text" style="width: 300px;"/></td><td><input type="date" /> </td><td><input type="text" style="width: 300px;"/></td><td><button onclick="Savedata_info(this)">保存</button></td></tr>';
		$("#"+tab_id+" tr").eq(-2).after(newRow);
	}else{
		alert("请保存“客户基本信息”后再进行操作！");
	}
}

//保存客户基本信息
function Getdata_kh(){
	//获取客户的信息
	var data_kh = "";
	$("#tab_kh input").each(function(){
		if($(this).val()){
			data_kh += $(this).val() + "#$#";
		}else{
			data_kh += "0" + "#$#";
		}
		
	});
	data_kh = data_kh.substr(0,data_kh.length-3);//去掉尾部的“#$#”
//	console.log(data_kh);
	//获取联系人的信息
	var data_lxr = "";
	$("#tab_lxr input").each(function(){
		if($(this).val()){
			data_lxr += $(this).val() + "#$#";
		}else{
			data_lxr += "0" + "#$#";
		}
		
	});
	data_lxr = data_lxr.substr(0,data_lxr.length-3);//去掉尾部的“#$#”
//	console.log(data_lxr);
	if($("#kh_id").val()){//客户id存在，更新信息
		$.ajax({
			type:"get",
			url:"ClieMag_New_ajax.php",
			async:true,
			data:{
				my_flag:"Update_khjb",
				id:$("#kh_id").val(),
				data_kh:data_kh,
				data_lxr:data_lxr
			},
			dataType:"json",
			success:function(data){
				if(data["result"] == "success"){
					alert("保存成功！");
				}else{
					alert("保存失败！");
					console.log(data["sql"]);
				}
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("保存失败！");
				console.log("ajax error!"+errorstatus+errorThrow);
			}
		});
	}else{//客户id不存在，保存信息
		//检测手机号是否填写或是否已存在
		if($("#phone_num").val()){
//			console.log($("#phone_num").val());
			//异步判断手机号是否存在
			$.ajax({
				type:"get",
				url:"ClieMag_New_ajax.php",
				async:true,
				data:{
					my_flag:"Judge_phone",
					phone_num:$("#phone_num").val()
				},
				dataType:"json",
				success:function(data){
					if(data["result"] == "success"){
						alert("该手机号与另一客户"+data["kh"]+"一样，无法保存！");
					}else{
						$.ajax({
							type:"get",
							url:"ClieMag_New_ajax.php",
							async:true,
							data:{
								my_flag:"Savedata_khjb",
								data_kh:data_kh,
								data_lxr:data_lxr
							},
							dataType:"json",
							success:function(data){
				//				console.log(data);
								if(data["result"] == "success"){
									alert("保存成功！");
									console.log(data["id"]);
									$("#kh_id").val(data["id"]);//设置客户id的值
								}else{
									alert("保存失败！");
									console.log(data["sql"]);
								}
							},
							error:function(XMLhttprequest,errorstatus,errorThrow){
								alert("保存失败！");
								console.log("ajax error!"+errorstatus+errorThrow);
							}
						});
					}
				},
				error:function(XMLhttprequest,errorstatus,errorThrow){
					alert("保存失败！");
					console.log("ajax error!"+errorstatus+errorThrow);
				}
			});
		}else{
			alert("手机号不能为空！");
		}
	}
}
	
//保存会谈的详情
function Savedata_info(btn_doc){
	tr_doc = btn_doc.parentNode.parentNode;
	var str_data = "";
	$(tr_doc).find("input").each(function(){
		str_data += $(this).val() + "#$#";
	});
	str_data = str_data.substr(0,str_data.length-3);
//	console.log(str_data);
	
	if($("#kh_id").val()){//客户id存在
		$.ajax({
			type:"get",
			url:"ClieMag_New_ajax.php",
			async:true,
			data:{
				my_flag:"Savedata_info",
				id:$("#kh_id").val(),
				str_data:str_data
			},
			dataType:"json",
			success:function(data){
//				console.log(data);
				if(data["result"] == "success"){
					alert("保存成功！");
					btn_doc.style.display = "none";
				}else{
					alert("保存失败！");
					console.log(data["sql"]);
				}
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("保存失败！");
				console.log("ajax error!"+errorstatus+errorThrow);
			}
		});
	}
}

//填写客户信息
function Writedata_kh(kh_data){
	var i = 0;
	$("#tab_kh input").each(function(i){
		$(this).val(kh_data[i]);
	});
	
	$("#tab_lxr input").each(function(i){
		$(this).val(kh_data[i+3]);
	});
}

//填写会谈信息
function Writedata_info(info_data,info_num){
	if(info_num){
		for(i=0;i<info_num;i++){
			newRow = '<tr><td>'+info_data[i]["本次联系时间"]+'</td><td>'+info_data[i]["会谈详情"]+'</td><td>'+info_data[i]["下次联系时间"]+'</td><td>'+info_data[i]["备注"]+'</td><td></td></tr>';
			$("#tab_info tr:first").after(newRow);
		}
	}
}
