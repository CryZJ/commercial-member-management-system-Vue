var tab = 'dynamic-table';
var tab2 = 'dynamic-table_2';
//结案
function jiean(){
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum = 0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		var ajh = document.getElementById(tab).rows[i].cells[1].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
//			alert(ajh);
			$.ajax({
				type:"POST",
				url:"case_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "ja",
					ajh: ajh
				},
				success:function(data){
					RowNum++;
//					console.log(data);
//					alert('结案成功');
//					alert(data);
//					if(data == 1){
//					}
//					alert(data);
//					console.log(data);
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		}
	}
	if (RowNum) {
		alert("结案成功");
		window.location="blogo.php";
	} else{
		alert('请选中案件后再操作');
	}
}

//删除
function del(){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum2=0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		var ajh = document.getElementById(tab).rows[i].cells[1].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"case_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "del",
					ajh: ajh
				},
				success:function(data){
					RowNum2++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		}
	}
	if (RowNum2) {
		alert("删除成功");
		window.location="blogo.php";
	} else{
		alert('请选中案件后再操作');
	}
//	alert("删除成功");
//	window.location="blogo.php";
}
//恢复
function huif(){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum3=0;
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		var ajh = document.getElementById(tab).rows[i].cells[1].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"case_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "huif",
					ajh: ajh
				},
				success:function(data){
					RowNum3++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		}
	}
	if (RowNum3) {
		alert("恢复成功");
		window.location="blogo.php";
	} else{
		alert('请选中案件后再操作');
	}
//	alert("恢复成功");
//	window.location="blogo.php";
}
//最终删除
function hid(){
//	alert("nzbx");
	var Tab =document.getElementById(tab);
	var nrow = Tab.rows.length;
	var RowNum4=0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		var ajh = document.getElementById(tab).rows[i].cells[1].getElementsByTagName("a")[0].innerHTML;
//		var ajh = document.getElementById(tab).rows[i].cells[1].innerHTML;
//		alert(falg+","+ajh);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"case_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "hidden",
					ajh: ajh
				},
				success:function(data){
					RowNum4++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		}
	}
	if (RowNum4) {
		alert("最终删除成功");
		window.location="blogo.php";
	} else{
		alert('请选中案件后再操作');
	}
//	alert("最终删除成功");
//	window.location="blogo.php";
}
//委托书删除
function del_wt(){
	var Tab2 =document.getElementById(tab2);
	var nrow = Tab2.rows.length;
	var id='';
	var RowNum5=0;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab2.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		id = Tab2.rows[i].cells[5].innerHTML;
//		alert(id);
		if(falg == true){
			$.ajax({
				type:"POST",
				url:"case_action.php",
				async:false,
//				dataType:"json",
				//传参
				data:{
					falg_1: "del_ReP",
					ajh: id
				},
				success:function(data){
					RowNum5++;
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		}
	}
	if (RowNum5) {
		alert("委托书删除成功");
		window.location="blogo.php";
	} else{
		alert('请选中案件后再操作');
	}
//	alert("删除成功");
//	window.location="blogo.php";
}


//导出选中行的Excel清单
//window.open的post传输数据函数
function openPostWindow(url, name, data, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="data";
     hideInput1.value = data;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="data2";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
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
function Export_someExcel(tab_id,my_url){
	$send_id = "";//案卷号
	$("#"+tab_id+" input").each(function(){
		if($(this).hasClass("box_son")){
			if($(this).attr("checked")){
				$send_id +=  "," + $(this).attr("id");
			}
		}
	});
	if($send_id != ""){
		$send_id = $send_id.substr(1,$send_id.length);
		console.log($send_id);
		openPostWindow(my_url,"_blank",$send_id);
		setTimeout(function(){
			location.reload();
		},1000)
	}else{
		alert("没有选中行！");
	}
	
}