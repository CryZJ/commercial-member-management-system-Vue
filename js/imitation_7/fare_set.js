//var tab_1 = document.getElementById("tab_set_1");
//var tab_2 = document.getElementById("tab_set_2");
//var tab_3 = document.getElementById("tab_set_3");
//
//var nrow1 = tab_1.rows.length;
//var nrow2 = tab_2.rows.length;
//var nrow3 = tab_3.rows.length;
//
//for(var i=1;i<nrow1;i++){
//	var obj = tab_1.rows[i].cells[1].getElementsByTagName('input')[0];
//	obj.readOnly=true;
//}
//for(var i=1;i<nrow2;i++){
//	var obj = tab_2.rows[i].cells[1].getElementsByTagName('input')[0];
//	obj.readOnly=true;
//}
//for(var i=1;i<nrow3;i++){
//	var obj = tab_3.rows[i].cells[1].getElementsByTagName('input')[0];
//	obj.readOnly=true;
//}

function changef(id,flag){//id为费用在数据库中的id，flag为操作的类型
	var Count = "fa"+id;
	var FareN = "fn"+id;
	var BId = document.getElementById(id);//按钮id
	var CId = document.getElementById(Count);//费用金额id
	var FId = document.getElementById(FareN);//费用名id
	var useid = document.getElementById('useid').value;//操作人id
	if(flag == '修改'){//修改
		CId.readOnly = false;
		FId.readOnly = false;
//		CId.bgColor ="#FFFFFF";
//		FId.style.bgColor ="#FFFFFF";
		BId.value="保存";
		BId.style.color = 'red';
	}else{//保存
//		alert(fid.value+'/'+id);
		$.ajax({
			url:'fare_creat.php',
			type:'post',
			async:true,
			data:{
				id:id,
				MessC:CId.value,
				MessF:FId.value,
				useid:useid,
				flag:'change'
			},
			success:function(data){
//				if(data=='1'){
//					alert('操作成功');
//				}else{
//					alert('操作失败，请联系管理员');
//				}
//				alert(data);
			}
		});
		CId.readOnly = true;
		FId.readOnly = true;
		BId.value="修改";
		BId.style.color = 'black';
	}
}

function change(tabn){
//	alert('ok');
	var tab = document.getElementById(tabn);
	var nrow = tab.rows.length;
	var newr = tab.insertRow(nrow-1);
	var numr = nrow-1;
	newr.insertCell(0).innerHTML = numr;
	newr.insertCell(1).innerHTML = tab.rows[1].cells[1].innerHTML;
	newr.insertCell(2).innerHTML = tab.rows[1].cells[2].innerHTML;
	newr.insertCell(2).innerHTML = tab.rows[1].cells[3].innerHTML;
}
//检测想要新建的费用是不是已经存在
function compare(ctype){
	alert('ok');
}
//数据保存
function savenew(){
	var ctype = document.getElementById('ctype').value;
//	alert(ctype);
//	var TabName = 'tab_'+ctype;
	var tab = document.getElementById('tabfare');
	var useid = document.getElementById('useid').value;
	var mesn = '';
	mesn = tab.rows[1].cells[1].getElementsByTagName('input')[0].value+'|';//费用名
	mesn += tab.rows[1].cells[2].getElementsByTagName('input')[0].value;//金额
	if(tab.rows[1].cells[1].getElementsByTagName('input')[0].value!=""){
		$.ajax({
			url:'fare_creat.php',
			type:'post',
			async:true,
			data:{
				mess:mesn,
				flag:'new',
				useid:useid,
				ctype:ctype
			},
			success:function(data){
				alert(data);
//				if(data == 'ok'){
//					alert(data);
//				}else{
//					alert(data);
//				}
			}
		});
	}else{
		alert('请将费用名补充完整');
	}
}

//删除费用名
function Delete_f(f_id){
	if(confirm("是否确认删除？")){
		$.ajax({
			url:'fare_creat.php',
			type:'post',
			async:true,
			data:{
				flag:'del',
				f_id:f_id
			},
			success:function(data){
				if(data == "删除成功"){
					alert(data);
					window.location.reload();
				}else{
					alert(data);
				}
				
			},
			error:function(x,s,t){
				alert("删除失败");
				console.log("ajax error!"+s+t);
			}
			
		});	
	}
	
}
