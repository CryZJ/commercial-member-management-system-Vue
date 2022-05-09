//新建保存
function saveNew(TabId){
	var tab = document.getElementById(TabId);
	var Input = tab.getElementsByTagName('input');
//	var CaseType = document.getElementById('SelType');
	switch(TabId){
		case "Tab01":
			var CaseType = "专利案件";
			break;
		case "Tab02":
			var CaseType = "商标案件";
			break;
		case "Tab03":
			var CaseType = "软件案件";
			break;
		case "Tab04":
			var CaseType = "著作案件";
			break;
		case "Tab05":
			var CaseType = "海关案件";
			break;
		case "Tab06":
            var CaseType = "项目类型";
            break;
		default:break;
	}
//	alert(CaseType);
	$.ajax({
		url:'Circuit_save.php',
		type:'get',
		async:true,
		data:{
			Name:Input[0].value,
			Day:Input[1].value,
			Count:Input[2].value,
			CaseType:CaseType,
			falg:'save'
		},
		success:function(data){
			alert(data);
			location.reload();
		}
	});
}

//删除信息
function delMes(obj,id){
	var del = confirm('是否删除此条数据');
	if(del){
		$.ajax({
			type:"get",
			url:"Circuit_save.php",
			async:true,
			data:{
				id:id,
				falg:'delet'
			},
			success:function(data){
				location.reload();
			}
		});
	}else{
		
	}
	

}