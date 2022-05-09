//提前通知 
	function Info_Befo(){
		var tab = document.getElementById("dynamic-table_5");
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
				url:"Cost_ChanSta.php",
				async:true,
				data:{
					id:MesId,
					flag:'MonToInfo'
				},
				success:function (data){
					alert(data);
					location.reload();
				}
			});
			return;
		}
		//如果没选中费用
		alert('请选中费用后再进行操作');
	}
	//修改成已通知状态
	function Info_Ing(){
		var tab = document.getElementById("dynamic-table");
		var TabLen  = tab.rows.length;
		var MesId = '';
		for (var i=1;i<TabLen;i++) {
			if(tab.rows[i].cells[0].getElementsByTagName('input')[0].checked == true){
				MesId = MesId+'|'+tab.rows[i].cells[3].innerHTML;
			}
		}
		MesId = MesId.substr(1,MesId.length);
//		alert(MesId);
		//如果选中了费用，判断费用有没有申请费，并打开页面
		if(MesId.length){
			$.ajax({
				type:"get",
				url:"Cost_ChanSta.php",
				async:true,
				dataType:'json',
				data:{
					id:MesId,
					flag:'SendInfo'
				},
				success:function (data){
////					alert(data['result']);
//					console.log(data);
////					location.reload();
//					//
					var scr_height = window.screen.availHeight;
					var scr_width = window.screen.availWidth;
					var bro_height = 600;
					var bro_width = 1200;
					var top = (scr_height-bro_height)/2;
					var left = (scr_width-bro_width)/2;
					var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
					
					if(data['result'] == 'success'){
//						for (var i=0;i<data['dataNum'];i++) {
//							var obj = {name:'zhangsan',age:23,addr:'China'};
							var objkeys = [];
							for(objkeys[objkeys.length] in data['AjhMes']);
//							//以上将obj的键名存放到了数组objkeys 中。
//							//遍历输出键值对
							for(var key in data['AjhMes']){
//								alert(key,data['AjhMes']);
//								console.log(key,data['AjhMes']);
								var SQRId = key;//键名
								var Ajh = (data['AjhMes'][key]);//值
							
								myurl = "cost_messend.php?mas="+Ajh+"&SQRId="+SQRId;
//								alert(myurl);
//								console.log(myurl);
								var winobj = window.open(myurl,"_blank",specs);
							}
//						}
//						location.reload();
						var loop = setInterval(function(){
							if(winobj.closed){
								clearInterval(loop);
								parent.location.reload();
							}
						});
					}else{
						alert('选中费用已进入待缴费状态');
						location.reload();
					}
				}
			});
			return;
		}
		//如果没选中费用
		alert('请选中费用后再进行操作');
	}
	//导出授权通知
	function send_all(tabname){
		var tab = document.getElementById(tabname);
		var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
		var mas = '';
		var sqr = '';
		for(i = 1;i < tab_nrow; i++){
			var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
			if (row_che == true){
				if(tabname == 'dynamic-table'){
					mas += tab.rows[i].cells[3].innerHTML+'/'+tab.rows[i].cells[4].innerHTML+'/'+tab.rows[i].cells[5].innerHTML+'//';//案卷号+登记费+年费
				}
			}
		}
		mas = mas.substring(0,mas.length-2);
		my_url = "cost_messend.php?mas="+mas;
		openWin(my_url,'_blank',"",false);
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
	//合并缴费
	function fare_all(tabname){
		var tab = document.getElementById(tabname);
		var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
		var mas = '';
		if(tabname == 'dynamic-table_3'){
			for(i = 1;i < tab_nrow; i++){
				var row_che = tab.rows[i].cells[0].getElementsByTagName('input')[0].checked;
				if (row_che == true){
					mas += tab.rows[i].cells[3].innerHTML+'/';
				}
			}
		}else{
			alert('发生错误');
			location.reload([true]);
			return;
		}
		mas = mas.substring(0,mas.length-1);
		my_url = "cost_change.php?mas="+mas;
		openWin(my_url,'_blank',"",false);
	}
	//合并收据
	function shouju_all(tabname){
		var tab = document.getElementById(tabname);
		var tab_nrow = tab.rows.length;//行数只能够显示在同一页面下的行数，翻页无效
		var mas = '';
		var PayDate = "";
		var HCaceNum = "";
		if(tabname == 'dynamic-table_4'){
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
	
	//显示监控中信息
//	var oTable = $('#editable-sample').dataTable({
//	    "aLengthMenu": [
//	        [5, 15, 20, -1],
//	        [5, 15, 20, "All"] // change per page values here
//	    ],
//	    // set the initial value
//	    "iDisplayLength": 5,
//	    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
//	    "sPaginationType": "bootstrap",
//	    "oLanguage": {
//	        //"sLengthMenu": "_MENU_ records per page",
//	        "sLengthMenu": "_MENU_ 行/页",
//	        "oPaginate": {
//	            //"sPrevious": "Prev",
//	            //"sNext": "Next"
//	            "sPrevious": "上一页",
//	            "sNext": "下一页"
//	        }
//	    },
//	    "aoColumnDefs": [{
//	            'bSortable': false,
//	            'aTargets': [0]
//	        }
//	    ]
//	});
//	$.ajax({
//		type:"get",
//		url:"Cost_SelShow.php",
//		async:true,
//		dataType:'json',
//		success:function(data){
//			var id  = '';
//			var ajh = '';
//			var sqr = '';
//			var zln = '';
//			for (i in data) {
//				id  = data[i]["id"];
//				ajh = data[i]["ajh"];
//				sqr = data[i]["sqr"];
//				zln = data[i]["zln"];
//				oTable5.fnAddData([id,ajh,sqr,zln,id,ajh,sqr,zln,id]);
//			}
//		},
//		error:function(t,s,e){
//			alert(s+'|'+e);
//		}
//	});
	