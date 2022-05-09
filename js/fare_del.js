function delf(did){
	if(confirm("是否确认删除该费用？")){
		$.ajax({
			url:'cost_del.php',
			async:true,
			type:'post',
			data:{
				flag:'costzl',
				id:did
			},
			success:function(){
				alert('操作成功');
				location = location;
			}
		});
	}
}

//修改费用函数
function Cost_alter(a_doc){
	var cost_id = document.getElementById("cost_id");
	var cost_value = document.getElementById("cost_value");
	cost_id.value = a_doc.id;
	tr_doc = a_doc.parentNode.parentNode;
	cost_value.value = tr_doc.cells[7].innerHTML;
}

//修改费用保存函数
function Save_alterdata(){
	var cost_id = document.getElementById("cost_id");
	var cost_value = document.getElementById("cost_value");
	$.ajax({
		url:'cost_del.php',
		async:true,
		type:'post',
		data:{
			flag:'cost_alter',
			id:cost_id.value,
			fee:cost_value.value
		},
		success:function(data){
			alert(data);
//			location = location;
//			window.location.reload();
			Refresh_DynmicTable();
		},
		error:function(xhr,status,xmlthrow){
			console.log("ajax error!"+status+xmlthrow);
		}
	});
	
}

//表格选中的批量删除(input标签的id为数据库的id)
function DeleteAll_tab(tab_id,del_flag,ajax_url){
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
				alert(str_id);
				//异步删除	
				$.ajax({
					type:"get",
					url:ajax_url,
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