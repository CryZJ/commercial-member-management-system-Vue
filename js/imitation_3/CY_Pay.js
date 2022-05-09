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
	
//			farea.value = parseFloat(faredl);
	farea.value = parseFloat(farezn) + parseFloat(faredl) + parseFloat(fareje);
//			alert(farezn);
//			alert(typeof(farea.value));
	fareall.value = parseFloat(fareall.value)-parseFloat(fareab)+parseFloat(farea.value);
}
//输入验证码和验证操作
function che(){
	var Check = document.getElementById("y_yzh").value;
	var CheckMes = prompt('请在输入框内输入对应数字:'+Check);
	//验证码正确
	if(CheckMes == Check){
		sure_f();
		return;
	}
	//不正确
	alert('输入的字符不正确，请重新操作');
	return;
}


//缴费确认页面，提交信息
function sure_f(){
	var btn0 = document.getElementById('btn0');
	btn0.onclick = null;
	var tab = document.getElementById("tab_info");
//	var fid = document.getElementById("fid").value;//获取费用id
	var cpeo = document.getElementById("cpeo").value;//获取处理人
	var faremas = new Array();//创建新数组
	
//				var y_yzh = document.getElementById('y_yzh').value;//原验证码
//				var yzh = document.getElementById('yzh').value;//输入验证
	
	var year = '';//年度
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
		ffid  = document.getElementById('fid['+y+']').value;//费用id
//		year  = document.getElementById('fyn['+y+']').value;//申请号
//		fname = document.getElementById('zlm['+y+']').value;//专利名
//		ffnum = document.getElementById('ajh['+y+']').value;//案卷号
//		fsnum = document.getElementById('sqr['+y+']').value;//申请日
//		fjefy = document.getElementById('jef['+y+']').value;//金额
		fdlfy = document.getElementById('dlf['+y+']').value;//代理费
		fznjy = document.getElementById('znj['+y+']').value;//滞纳金
		str   = ffid+'/'+ fdlfy +'/'+ fznjy;
//			alert(str);
		faremas[y] = str;
	}
	
	$.ajax({
		url:"yearcost_messend_ajax.php",
		type:"post",
		async:true,
		data:{
			mas:faremas,
			cpeo:cpeo,
			my_flag:'savefare'
		},
		success:function(data){
			if(data){
				var FName = document.getElementById('FName');
				FName.value = data;
				alert('操作成功');
				var btnshow = document.getElementById('btn0');
				btnshow.hidden = null;
				btnshow.style.display = "none";
				var btnExcel = document.getElementById('btn1');
				btnExcel.style.display = "block";
				
			}else{
				alert('操作失败，请联系管理员');
				console.log(data);
			}
		}
	});
}

//更改年费或者滞纳金时会自动算出小计与总金额
function AutoCount(inp_obj){
	var znj = $(inp_obj).val();
	if(znj){
		var totalannualfee = 0;//总金额
		var mincount = 0;//小计
		mincount = Number($(inp_obj).parent().parent().children("td:gt(5)").html()) + Number($(inp_obj).parent().parent().children("td:gt(6)").children("input").val());
		$(inp_obj).parent().parent().children("td:last").html(mincount);
		
		$(inp_obj).parent().parent().parent().children("tr").each(function(){
			totalannualfee = Number(totalannualfee) + Number($(this).children("td:last").html());
		})
		$("#fareall").attr("value",totalannualfee);
	}else{
		znj = 0;
		var totalannualfee = 0;//总金额
		var mincount = 0;//小计
		mincount = Number($(inp_obj).parent().parent().children("td:gt(5)").html()) + Number(znj);
		$(inp_obj).parent().parent().children("td:last").html(mincount);
		
		$(inp_obj).parent().parent().parent().children("tr").each(function(){
			totalannualfee = Number(totalannualfee) + Number($(this).children("td:last").html());
		})
		$("#fareall").attr("value",totalannualfee);
	}
}

//更新数据库的“专案_年费记录”并生成缴费文件
function CreatePaymentFile(btn_obj){
	if($("#captcha").attr("name") == $("#captcha").val()){
		$(btn_obj).attr("onclick",null);
		$(btn_obj).html("处理中......");
		
		var send_data = {
			"costidstr" : $("#costidstring").val(),
			"data" : {}
		};
		var data_arr = new Array();
		$("#yearcostinfo tr").each(function(i){
			send_data.data[$(this).children("td:eq(7)").children("input").attr("name")] = $(this).children("td:eq(7)").children("input").val();
		});
//		console.log(send_data);
		$.ajax({
			url:"../../phpexcel/phpexcel_annualfee.php",
			type:"post",
			async:true,
			data:send_data,
			dataType:"json",
			success:function(data){
				console.log(data);
				if(data.state == 1){
					$("#createpaymentfile").addClass("hidden");
					$("#downexcelfile").removeClass("hidden");
					$("#downexcelfile").attr("href","downloadonefile_excel.php?filepath=../../filesave_notice/"+data.filename+"&"+"filename=国家申请或集成电路费用信息模板.xls")
				}else{
					alert(data.message);
				}
			},
			error:function(x,s,t){
				console.log(s+": "+t);
			}
		});
	}else{
		alert("验证码错误，可以根据提示填写正确热验证码");
	}
	
	
}
