var save = document.getElementById("save");
var Tab = document.getElementById("tab_info");
save.addEventListener('click',function(){
	var nrow = Tab.rows.length;
	var data_send = new Array();
	var j=0;
	for(i=1;i<nrow;i++){
		data_send[i-1] = Array();
		data_send[i-1][0] = Tab.rows[i].cells[2].innerHTML;//案卷号
		data_send[i-1][1] = Tab.rows[i].cells[7].innerHTML;//费用名称
		data_send[i-1][2] = Tab.rows[i].cells[8].innerHTML;//金额
		data_send[i-1][3] = Tab.rows[i].cells[9].getElementsByTagName("input")[0].value;//提醒日期
		data_send[i-1][4] = Tab.rows[i].cells[10].innerHTML;//剩余日期
		data_send[i-1][5] = Tab.rows[i].cells[11].innerHTML;//截止日期
	}
//	alert(data_send[0]);
	$.ajax({
		type:"post",
		url:"file_check_02_save.php",
		async:true,
		dataType:"json",
		data:{
			data_send:data_send
		},
		success:function(data){
//			alert(data);
			alert(data["结果"]);
			self.location="index.php";
		},
		error:function(){
			alert("保存失败！");
		}
	});
});