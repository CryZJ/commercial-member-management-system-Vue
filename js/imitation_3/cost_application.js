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

/*
 刷新表格
 * */
function SelectRefreshTable(tab_idstr){
	switch(tab_idstr){
		case "dynamic-table":
			Refresh_DynmicTable();
			break;
		case "dynamic-table_1":
			Refresh_DynmicTable_1();
			break;
		case "dynamic-table_2":
			Refresh_DynmicTable_2();
			break;
		case "dynamic-table_3":
			Refresh_DynmicTable_3();
			break;
		default :
			alert("服务器错误");
	}
}

/*
 单个删除费用
 * */
function delf(btn_obj){
	if(confirm("是否确认删除该费用？")){
		$.ajax({
			url:'cost_del.php',
			async:true,
			type:'post',
			data:{
				flag:'costzl',
				id:btn_obj.id
			},
			success:function(){
				alert('操作成功');
				SelectRefreshTable(btn_obj.name);
			}
		});
	}
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
//						window.location.reload();
						SelectRefreshTable(tab_id);
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

//修改费用函数
function Cost_alter(a_doc){
	var cost_id = document.getElementById("cost_id");
	var cost_value = document.getElementById("cost_value");
	cost_id.value = a_doc.id;
	tr_doc = a_doc.parentNode.parentNode;
	cost_value.value = tr_doc.cells[7].innerHTML;
	
	$("#save_add").attr("name",a_doc.name);
}

//修改费用保存函数
function Save_alterdata(btn_obj){
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
			SelectRefreshTable(btn_obj.name)
		},
		error:function(xhr,status,xmlthrow){
			console.log("ajax error!"+status+xmlthrow);
		}
	});
	
}

//收费
function TollFee(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
	var mas = '';
	if(tabname == 'dynamic-table_3'){
		for(i = 1;i < tab_nrow; i++){
			var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
			if (row_che == true){
//				mas += tab.rows[i].cells[3].innerHTML+'/';
				mas += tab.rows[i].cells[0].getElementsByTagName('input')[0].id + ',';
			}
		}
		if(mas.length){
			mas = mas.substring(0,mas.length-1);
			console.log(mas);
			
			$.ajax({
				type:"GET",
				url:"cost_ajax.php",
				data:{
					flag : "Charge",
					costid : mas
				},
				dataType:"json",
				success:function(data){
					if(data.state){
						alert(data.message);
						window.location.reload();
					}else{
						alert(data.message);
					}
				},
				error:function(x,s,t){
					alert("收费失败-ajax");
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
	var mas = '';
	if(tabname == 'dynamic-table'){
		for(i = 1;i < tab_nrow; i++){
			var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
			if (row_che == true){
//				mas += tab.rows[i].cells[3].innerHTML+'/';
				mas += tab.rows[i].cells[0].getElementsByTagName('input')[0].id + '/';
			}
		}
	}else{
		alert('发生错误');
		location.reload([true]);
		return;
	}
	mas = mas.substring(0,mas.length-1);
	console.log(mas);
	my_url = "cost_change.php?mas="+mas;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	openWin(my_url,'_blank',"");
}

//合并收据
function shouju_all(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
	var mas = '';
	var PayDate = "";
	var HCaceNum = "";
	if(tabname == 'dynamic-table_1'){
		var y=0;
		for(i = 1;i < tab_nrow; i++){
			if (tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
				if(y==0){
					PayDate = tab.rows[i].cells[6].innerHTML;
					HCaceNum = tab.rows[i].cells[2].innerHTML;
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
				}
//					只有申请号和缴费日期相同才能合并收据
				else if(PayDate == tab.rows[i].cells[6].innerHTML && PayDate.length>0 && HCaceNum == tab.rows[i].cells[2].innerHTML && HCaceNum.length > 0){
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
				}else{
					alert('注意，只有【缴费日期】和【申请号】相同才能合并收据，请重新选择');
					return;
				}
				
			}
		}
	}else{
		alert('发生错误');
		location.reload([true]);
		return;
	}
//		alert(HCaceNum);
	mas = mas.substring(0,mas.length-1);
	my_url = "cost_check.php?mas="+mas;
	openWin(my_url,'_blank',"",false);
}

//更改收据
function shouju_all_2(tabname){
	var tab = document.getElementById(tabname);
	var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
	var mas = '';
	var PayDate = "";
	var HCaceNum = "";
	if(tabname == 'dynamic-table_2'){
		var y=0;
		for(i = 1;i < tab_nrow; i++){
			if (tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
				if(y==0){
					PayDate = tab.rows[i].cells[6].innerHTML;
					HCaceNum = tab.rows[i].cells[2].innerHTML;
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
				}
//					只有申请号和缴费日期相同才能合并收据
				else if(PayDate == tab.rows[i].cells[6].innerHTML && PayDate.length>0 && HCaceNum == tab.rows[i].cells[2].innerHTML && HCaceNum.length > 0){
					mas += tab.rows[i].cells[3].innerHTML+'/';
					y++;
				}else{
					alert('注意，只有【缴费日期】和【申请号】相同才能合并收据，请重新选择');
					return;
				}
				
			}
		}
	}else{
		alert('发生错误');
		location.reload([true]);
		return;
	}
	if(mas.length){
		mas = mas.substring(0,mas.length-1);
		my_url = "cost_check.php?mas="+mas;
		openWin(my_url,'_blank',"",false);
	}else{
		alert("请选中行");
	}
	
}