	
										//获取页面数据,异步传递数据
var SQ = document.getElementById("baocun");
SQ.addEventListener("click",save_data);
function save_data(){
	
	//获取tab_base部分信息  获取基本信息
	var info_bs = new String();
	var info = "";
	var tab_base = document.getElementById("tab_base");
	for (var i = 0;i < 4 ;i++ ) {
		info = tab_base.rows[2].cells[i].getElementsByTagName("input")[0].value+"/";
		info_bs += info;
		info = "";
	}
	info_bs = info_bs.substring(0,info_bs.length-1);//去掉最后面的一根“/”	
//	alert(info_bs);
	
		//获取tab_fare部分费用金额
	var info_fe = new String();
	var info = "";
	var tab_fare = document.getElementById("tab_fare");
	for (var i = 0;i < 7 ;i++ ) {
		info = tab_fare.rows[2].cells[i].getElementsByTagName("input")[0].value+"/";
		info_fe += info;
		info = "";
	}
	info_fe = info_fe.substring(0,info_fe.length-1);//去掉最后面的一根“/”	
//	alert(info_fe);
	
		//获取tab_fare部分费用名称
	var info_fname = new String();
	var info = "";
	var tab_fare = document.getElementById("tab_fare");
	for (var i = 0;i < 5 ;i++ ) {
		info = tab_fare.rows[1].cells[i].innerHTML+"/";
		info_fname += info;
		info = "";
	}
	info_fname = info_fname.substring(0,info_fname.length-1);//去掉最后面的一根“/”	
//	alert(info_fname);

		//案卷号获取
	var ajh = document.getElementById("ajh").value;
	var flieR = document.getElementById("file").value;
	var af = ajh+"/"+flieR;
//	alert(af);

	
	
		//数据提交
	if (0) {	//判断表格数据是否为空
		alert("请填写完整信息");
		return;
	} else{
													//异步传递数据
		var xmlhttp = get_xmlhttp();
		xmlhttp.open("post","info.save.php","true");
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id=sq"+"&"+"ms0="+info_bs+"&"+"ms1="+info_fe+"&"+"ms2="+info_fname+"&"+"aj="+af);
		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
	
										//"1"为成功，“0”为失败
			  	//alert(xmlhttp.responseText);
			  	var falg = xmlhttp.responseText;
			  	
				if(falg == 1){
//					alert(falg);
					alert("数据保存成功");
			  		location.reload();		  		
				}else{
					alert("数据保存失败");
					
					document.getElementById("error").value = falg;

					alert(falg);
					
				}
	
			}
		}
	}

}

function get_xmlhttp(){						//创建响应
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}
