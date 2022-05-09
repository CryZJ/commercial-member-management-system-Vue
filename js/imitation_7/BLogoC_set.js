//新建保存
function saveNew(){
	var tab = document.getElementById('TabNew');
	var Input = tab.getElementsByTagName('input');
	$.ajax({
		url:'BLogoC_save.php',
		type:'get',
		async:true,
		data:{
			OriName:Input[0].value,
			Conter:Input[1].value,
			Phone:Input[2].value,
			Fax:Input[3].value,
			Code:Input[4].value,
			falg:'save'
		},
		success:function(data){
			alert(data);
//			console.log(data);
		}
	});
}

//删除信息
function delMes(obj,id){
	var del = confirm('是否删除此条数据');
	if(del){
		$.ajax({
			type:"get",
			url:"BLogoC_save.php",
			async:true,
			data:{
				id:id,
				falg:'delet'
			},
			success:function(data){
//				alert(data);
				var tab = document.getElementById('dynamic-table');
				var td_doc = obj.parentNode;
				var tr_doc = td_doc.parentNode;
				var row_num = tr_doc.rowIndex;
				tab.deleteRow(row_num);
			}
		});
	}else{
		
	}
	

}