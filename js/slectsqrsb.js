var xmlHttp;


var sqr_id = new String();
var $ary = new Array();
var SQ = document.getElementById("select_sqr");
SQ.addEventListener("click",function(){
			
			var scr_height = window.screen.availHeight;
			var scr_width = window.screen.availWidth;
			var bro_height = 500;
			var bro_width = 1000;
			var top = (scr_height-bro_height)/2;
			var left = (scr_width-bro_width)/2;
			var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
			var winobj = window.open("../../../select_sqr_more.php","_blank",specs);
			var loop = setInterval(function(){
				if(winobj.closed){
					clearInterval(loop);
					if(typeof(Storage)!=="undefined"){
						if(localStorage.return_data){
							return_data = localStorage.return_data;
							
							var arr = return_data.split("/");
			//				alert(arr + arr.length);
							//填入第一申请人
							sqr_id =arr[0];
							var Tab_sqr = document.getElementById('tab_sqr');
							SQ.value =arr[1]; //向申请人的input赋值
							Tab_sqr.rows[1].cells[1].innerHTML= arr[2];
							Tab_sqr.rows[1].cells[2].innerHTML= arr[3];
							Tab_sqr.rows[1].cells[3].innerHTML= arr[4];
							Tab_sqr.rows[1].cells[4].innerHTML= arr[5];
							Tab_sqr.rows[1].cells[5].innerHTML= arr[6];
							Tab_sqr.rows[1].cells[6].innerHTML= arr[0];
							
							var nrow = Tab_sqr.rows.length;
							if(nrow >=3){
								Tab_sqr.deleteRow(nrow-1);
								if(nrow >= 4){
									Tab_sqr.deleteRow(nrow-2);
								}
								if(nrow >= 5){
									Tab_sqr.deleteRow(nrow-3);
								}
							}
							
							//如果申请人多于一个
							if(arr.length>6){
								var len=(arr.length/7)-1;
								while(len){
									var nrow = Tab_sqr.rows.length;
									var new_row = Tab_sqr.insertRow(nrow);
									var j=0;
									for(var i=len*7;i<len*7+7;i++){
										if(i==len*7){
											sqr_id=sqr_id+"/"+arr[i];
											new_row.insertCell(j).innerHTML = arr[i];
										}else if(i==len*7+1){
											new_row.insertCell(j).innerHTML	= arr[i];
											j++;
										}else{
											new_row.insertCell(j).innerHTML = arr[i];
											j++;
										}
									}
									len--;
								}
							}
							
							localStorage.clear();
						}else{
							alert("未选中申请人！");
						}
					}else{
						alert("抱歉！该浏览器版本不支持web存储。");
					}
				}
			},1);
});


//选择代理人  
function select_dlr(id){
	//alert(return_data);
	var dlr = document.getElementById(id);
//	dlr = dlr.value.length;
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					dlr.value = localStorage.dlr_name;
					
					localStorage.clear();
				}else{
					dlr.value = '';
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择案源人
function select_ayr(id){
//	alert(id);
	var ayr = document.getElementById(id);
//	ayr_len = ayr.value.length;
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					
					localStorage.clear();
				}else{
					ayr.value = '';
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
	
}
//获取字符串中的数字
function getNum(text){
	var value = text.replace(/[^0-9]/ig,""); 
	//alert(value);
	return value;
}

function showsqr(id){
	var num = getNum(id);//获取id中的数字
	//alert(num);
	
	var sqr = document.getElementById(id).value;//获取申请人名字
	
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
   {
   alert ("Browser does not support HTTP Request");
   return;
   }
var url="newchang.php";
url=url+"?sqr="+sqr;
//url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

//链接申请人信息
function stateChanged(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   { 
   //document.getElementById("dz").innerHTML=xmlHttp.responseText;
   //document.getElementById("dz").value=xmlHttp.responseText;
   //alert(xmlHttp.responseText);
   
   xmlDoc=xmlHttp.responseXML;
   document.getElementById("dz[0]").value = xmlDoc.getElementsByTagName("dz")[0].childNodes[0].nodeValue;
   document.getElementById("zjhm[0]").value = xmlDoc.getElementsByTagName("zjh")[0].childNodes[0].nodeValue;
   
	//alert(xmlHttp.responseXML);
   }

}

function GetXmlHttpObject(){
	var xmlHttp=null;
	try
	 {
		 // Firefox, Opera 8.0+, Safari
		 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
	 	//Internet Explorer
	 try
	  {
	  	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  }
	 catch (e)
	  {
	  	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	 }
	return xmlHttp;
}

//生成案卷号
function createajh(btn_id){
//	alert(btn_id);
	window.num_r = btn_id; //获取需要生成案卷号的行位置，并设置为全局变量
	
	//获取表格中类型、案源人、代理人
	var Table 	= document.getElementById("tabUserInfo");
    var str2	= Table.rows[btn_id+1].cells[2].getElementsByTagName("input")[0].value;
    var str3	= Table.rows[btn_id+1].cells[3].getElementsByTagName("input")[0].value;
//  alert(str+'+'+str2+'+'+str3);

	if(str2.length == 0 || str3.length == 0 ){
		alert("请将案源人，代理人信息填写完整");
		return;
	}
	$.ajax({
		type:"get",
		url:"update.php",
		async:true,
		data:{
			str2:str2,
			str3:str3
		},
		success:function(data){
			var tab_x = "ajh["+num_r+"]";   // 获取案卷号需要添加的位置
		//	alert(tab_x);
			var str = data;
//			alert(str);
			var arr = str.split(",");
			var num = parseInt(arr[0],10)+parseInt(num_r,10);//parseInt()将字符转化为数字
			var zm = arr[1];
	//		alert(num+"/"+zm);
			num = String(num);
			var len = num.length;
	//		alert(len);
			switch(len){
				case 1 : var sn = "0000"+num;break;
				case 2 : var sn = "000"+num;break;
				case 3 : var sn = "00"+num;break;
				case 4 : var sn = "0"+num;break;
				default : var sn = num;
			}
	//		alert(sn);
			var ajh = sn+zm;
	//		alert(ajh)
			document.getElementById(tab_x).value=ajh;
		}
	});
}
