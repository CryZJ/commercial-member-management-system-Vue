function save_kj_rj(){
	var kj_ajh      = document.getElementById("kj_ajh").value;//案卷号
	var sqh_rj      = document.getElementById("sqh_rj").value;//申请号
	var sqr_rj      = document.getElementById("sqr_rj").value;//申请日
	var rjxh        = document.getElementById("rjxh").value;//序号
	var kjm_rj      = document.getElementById("kjm_rj").value;//控建名
	var je_rj       = document.getElementById("je_rj").value;//金额
	var txday       = document.getElementById("txday").value;//提醒日期
	var jzday       = document.getElementById("jzday").value;//截止日期
	var kjxx = sqh_rj +"|"+sqr_rj +"|"+ rjxh +"|"+ kjm_rj +"|"+ je_rj +"|"+ txday +"|"+jzday;
	if(kjxx == "||||||"){
		alert("没有填写信息");
	}else{
		$.ajax({
				type:"post",
				url:"save_rjkj_new.php",
				async:true,
				data:{
					kjxx:kjxx,
					ajh:kj_ajh
				},
				success:function(data){
					if(data == "1"){
						alert("保存成功");
					}else{
						alert("保存失败");
					}
					
				}
		});
	}
}
//获取案件基本信息部分信息
function save_data_rj(){
//	基本信息
var ajdlr   = document.getElementById("ajdlr").value;
var  tab_rj  =  document.getElementById("tab_sqr");
var bz = document.getElementById("case_bz").value; //备注
var ayr = document.getElementById("ayr").value;
var dlr = document.getElementById("dlr").value;
var ajh = document.getElementById("ajh").value;
var rjmc = document.getElementById("rjmc").value;
var data_str1 = ayr + "|" + dlr + "|" + ajh + "|" + rjmc;
//	alert(data_str1);
//	//申请人信息
var  tab =  document.getElementById("tab_sqr1");
var  tab_rows  =  tab.rows.length;
for(var  i = 1; i < tab_rows; i++) {
	var sqr = tab.rows[i].cells[0].getElementsByTagName("input")[0].value; //申请人
	var zjh = tab.rows[i].cells[1].getElementsByTagName("input")[0].value; //证件号
	var dz = tab.rows[i].cells[2].getElementsByTagName("input")[0].value; //地址
	var data_str2 = sqr + "|" + zjh + "|" + dz;
	//	alert(data_str2);
	var data_str = data_str1 + "|" + data_str2;
//	 	alert(data_str);
}
if(ajh == "" || sqr == "") {
	alert("请填写案件信息");
	return;
} else {
//	alert(ajdlr+"  "+ajh+"  "+data_str+"  "+bz);
	$.ajax({
		type: "post",
		url: "case_save_rj.php",
		async: true,
		data: {
			ajdlr: ajdlr,
			ajh: ajh,
			ms: data_str,
			bz: bz
		},
//		alert(data);
		success:function(data) {
			alert(data);
//			if(data=="1") {
//				alert("数据保存成功");
//			} else {
//				alert("数据保存失败");
//			}

		}
	});
}

//alert('ok');

}