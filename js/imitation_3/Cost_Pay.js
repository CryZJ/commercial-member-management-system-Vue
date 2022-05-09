function onshow(){
	var tab = document.getElementById('tab_info');
	var num = tab.rows.length;
//				alert(num);
	var fareje = '';
	var faredl = '';
	var farezn = '';
	var farea = '';
	var fareall = document.getElementById('fareall');
	for(var i=2;i<num-1;i++ ){
		var y = i-2;
		fareje = document.getElementById('jef['+y+']').value;
		faredl = document.getElementById('dlf['+y+']').value;
//					滞纳金
		farezn = document.getElementById('znj['+y+']').value;
		farea  = document.getElementById('zje['+y+']');
//					alert(fareje+'/'+farezn+'/'+faredl+'/'+farea.value);
		farea.value = parseFloat(farezn) + parseFloat(faredl) + parseFloat(fareje);
//					alert(tab.rows[i].cells[1].innerHTML);
		fareall.value = parseFloat(fareall.value)+parseFloat(farea.value);
	}
}

function thiscount(event,id){
	var str = event.target.value;
	var tnum = id.substring(4,id.length-1);
	var name = id.substring(0,3);
	var fareje = document.getElementById('jef['+tnum+']').value;
	var fareab = document.getElementById('zje['+tnum+']').value;
	if(name == 'dlf'){
		var faredl = str;
		var farezn = document.getElementById('znj['+tnum+']').value;
	}else{
		var farezn = str;
		var faredl = document.getElementById('dlf['+tnum+']').value;
	}
	var farea = document.getElementById('zje['+tnum+']');
	
	farea.value = parseFloat(farezn) + parseFloat(faredl) + parseFloat(fareje);
	fareall.value = parseFloat(fareall.value)-parseFloat(fareab)+parseFloat(farea.value);
}
//输入验证码和验证操作
function che(){
	var Check = document.getElementById("y_yzh").value;
	var CheckMes = prompt('请在输入框内输入对应数字:'+Check);
	//验证码正确
	if(CheckMes == Check){
//					document.getElementById("judge_confige").value="已确认";//"点击“导出Excel”时的判断条件"
		sure_f();
		return;
	}
	//不正确
	alert('输入的字符不正确，请重新操作');
	return;
}
//缴费确认页面，确认操作
function sure_f(){
	var tab = document.getElementById("tab_info");
	var fid = document.getElementById("fid").value;//获取费用id
	var cpeo = document.getElementById("cpeo").value;//获取费用id
	var faremas = new Array();//创建新数组
	
	var ffid  = '';//获取费用id
	var fname = '';//获取费用名
	var ffnum = '';//获取案卷号
	var fsnum = '';//获取申请号
	var fjefy = '';//获取金额
	var fdlfy = '';//获取代理费
	var fznjy = '';//获取滞纳金
	var fcoun = '';//获取行总金额
	var fcall = document.getElementById('fareall');//获取总金额
	var fczpe = document.getElementById('fareall');//获取操作员
	
	var str = '';
	rnum = tab.rows.length;
	for(var i=2;i< rnum-1;i++ ){
		var y = i -2;
		ffid  = document.getElementById('fid['+y+']').value;
		fname = document.getElementById('fyn['+y+']').value;
		ffnum = document.getElementById('ajh['+y+']').value;
		fsnum = document.getElementById('sqh['+y+']').value;
		fjefy = document.getElementById('jef['+y+']').value;
		fdlfy = document.getElementById('dlf['+y+']').value;
		fznjy = document.getElementById('znj['+y+']').value;
		str   = ffid+'/'+fname+'/'+ ffnum +'/'+ fsnum +'/'+ fjefy +'/'+ fdlfy +'/'+ fznjy;
//			alert(str);
		faremas[y] = str;
	}
//	console.log(faremas);
	
	//验证码验证正确后
	$.ajax({
		url:"cost_fare_save.php",
		type:"post",
		async:true,
		data:{
			mas:faremas,
			cpeo:cpeo
		},
		success:function(data){
			if(data){
				var FName = document.getElementById('FName');
				FName.value = data;
				alert('操作成功');
				var btnshow = document.getElementById('btn0');
				btnshow.onclick = null;
				btnshow.style.display = "none";
				var btn_Excel = document.getElementById('btn1');
				btn_Excel.style.display = "block";
			}else{
				alert('操作失败');
			}
		}
	});
	
}