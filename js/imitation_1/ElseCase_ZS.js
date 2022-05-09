//生成年费
function creatyc(){
//	alert('ok');
	//获取表格中的申请日和首年度
	var tabm = document.getElementById('tabUserInfo');
	var tabb = document.getElementById('tabUserInfo_1');
	var tabf = document.getElementById('tabUserInfo_2');
	
	//获取申请日
	var sqdate = tabm.rows[1].cells[3].getElementsByTagName('input')[0].value;
//	alert(typeof sqdate.length);
	if(sqdate.length == 0){
		alert('请选择申请日');
	}else
	{
	//生成年费
		//获取首年度&&申请日
		var ctype = document.getElementById('ctype').value;//案件类型
		var sqr = document.getElementById('zlr').value;//申请日
		var snd = document.getElementById('snd').value;//首年度
		var prec = document.getElementById('prec').value;//百分比
		var fall=new Number();
		switch(ctype){
			case '实用新型':fall=10;break;
			case '外观设计':fall=10;break;
			case '发明专利':fall=20;break;
			default:alert('请选择案件类型');exit;
		}
		//删除初始数据
		var numr = tabf.rows.length;
		while(numr>2){
			var numr = tabf.rows.length;
			numr--;
			tabf.deleteRow(numr);
		}
		//获取年费
		$.ajax({
			url:"case_save.php",
			type:"post",
			async:true,
			dataType:'json',
			data:{
				year:snd,
				count:prec,
				type:ctype,
				flag:'yearfare'
			},
			success:function(data){
//				return data;
				//增行&&显示时间&&年费
				var timen =1;
		//		var faret = farecount(snd,prec,ctype);//参数：首年度、百分比、案件类型
				while(snd<=fall){
					var numr = tabf.rows.length;//计算表格行数
					var newRow = tabf.insertRow(numr);//增行
					var creayc = creaty(snd,sqr);//计算通知时间和截至时间[首年度，申请日]
					newRow.insertCell(0).innerHTML = snd+"<input type='text' style='width:25px;height:30px;border:0px;' hidden='hidden' value='"+ snd +"' />";
//					newRow.insertCell(0).innerHTML = snd"<input type='text' style='width:25px;height:30px;border:0px;' readonly='readonly' value='"+  +"' />";
					newRow.insertCell(1).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ data[timen]['fare'] +"' />";
					newRow.insertCell(2).innerHTML = "<input style='height:30px;' type='date' value='"+ creayc[0] +"' />";
					newRow.insertCell(3).innerHTML = "<input style='height:30px;' type='date' readonly='readonly' value='"+ creayc[1] +"' />";
					newRow.insertCell(4).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(5).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(6).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(7).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(8).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ 1 +"' />";
					newRow.insertCell(9).innerHTML = "<input type='button'  value='删除' id="+timen+" onclick='del(this)' />";
					snd++;timen++;
				}
				creatznj();
				document.getElementById('SaveMes').style.display = "inline";
				//删除费用表第一行
				var tab = document.getElementById('tabUserInfo_2');
				var Obj = document.getElementById('1');
				var td_doc = Obj.parentNode;
				var tr_doc = td_doc.parentNode;
				var row_num = tr_doc.rowIndex;
				tab.deleteRow(row_num);
//				var tabf = document.getElementById('tabUserInfo_2');
//				tabf.deleteRow(1);
			}
		});
	}
}
//计算并显示滞纳金
function creatznj(){
	var type = document.getElementById('ctype').value;//案件类型
	var snd = parseInt(document.getElementById('snd').value)+1;//首年度
//	alert(type+'/'+snd);
	$.ajax({
		url:"case_save.php",
		type:"post",
		async:true,
		dataType:'json',
		data:{
			flag:"znj",
			year:snd,//首年度
			type:type
		},
		success:function(data){
//			alert(data);
			snd = parseInt(snd);
			var tab = document.getElementById('tabUserInfo_2');
			var len = tab.rows.length;
//			alert(len);
			var y = snd;
			for(var i=2;i<(len);i++){
				tab.rows[i].cells[4].getElementsByTagName('input')[0].value=data[y][0];
				tab.rows[i].cells[5].getElementsByTagName('input')[0].value=data[y][1];
				tab.rows[i].cells[6].getElementsByTagName('input')[0].value=data[y][2];
				tab.rows[i].cells[7].getElementsByTagName('input')[0].value=data[y][3];
				tab.rows[i].cells[8].getElementsByTagName('input')[0].value=data[y][4];
				y++;
			}
		}
	});
}