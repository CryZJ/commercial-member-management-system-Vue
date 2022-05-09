function Chang_session(firm_id,self_dir){
	my_url = self_dir+"change_session.php";
	$.ajax({
		type:"get",
		url:my_url,
		async:true,
		data:{
			flag:"Change_finance",
			firm_id:firm_id
		},
		success:function(data){
			console.log(data);
//			alert(data);
		},
		error:function(x,s,t){
//			alert("更改状态失败");
			console.log("ajax error"+s+t);
		}
	});
}
