var xmlHttp;

var kh_id = new String();
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
	var winobj = window.open("../../select_sqr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.sqr_name){
					SQ.value = localStorage.sqr_name;
					kh_id = localStorage.sqr_id;
					
					localStorage.clear();
				}else{
					alert("未选中客户！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);		
});

//后期设想：传回联系人id，用js打开数据库显示所有勾选的联系人及其信息
//方案二:在选择联系人时将数据写入数据库，用js局部刷新读取
//选择联系人
//var tel_lxr = new String();
//var adds_lxr = new String();
//var $lxr = new Array();
var LS = document.getElementById("select_lxr");
LS.addEventListener("click",function(){
			//alert(SQ.value.length);
			if(SQ.value == undefined||SQ.value == null||SQ.value.length == 0){
				alert("请优先选择客户");
			}else{
				var my_url = "../../select_lxr.php?v="+kh_id;
				var scr_height = window.screen.availHeight;
				var scr_width = window.screen.availWidth;
				var bro_height = 500;
				var bro_width = 1000;
				var top = (scr_height-bro_height)/2;
				var left = (scr_width-bro_width)/2;
				var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
				var winobj = window.open("my_url","_blank",specs);
				var loop = setInterval(function(){
					if(winobj.closed){
						clearInterval(loop);
						if(typeof(Storage)!=="undefined"){
							if(localStorage.return_data){
								LS.value = localStorage.return_data;
								
								localStorage.clear();
							}else{
								alert("未选中客户！");
							}
						}else{
							alert("抱歉！该浏览器版本不支持web存储。");
						}
					}
				},1);
			}
});

//链接联系人信息
function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //document.getElementById("dz").innerHTML=xmlHttp.responseText;
 //document.getElementById("dz").value=xmlHttp.responseText;
 //alert(xmlHttp.responseText);
 
 xmlDoc=xmlHttp.responseXML;
 document.getElementById("tel").value = tel_lxr;
 document.getElementById("adds").value = adds_lxr;
 
	//alert(xmlHttp.responseXML);
 }

}


//选择代理人  
function select_dlr(id){
	var SD = document.getElementById(id);
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					if(return_name == undefined||return_name == null||return_name.length == 0){
						alert("未选中代理人");
					}else{
						SD.value = localStorage.dlr_name;
					}
					
					localStorage.clear();
				}else{
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
	//alert(return_name);
	//SD.value = return_name;
}

//选择案源人
var SA = document.getElementById("select_ayr");
SA.addEventListener("click",function(){
			
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
					$("#"+id).attr("value",localStorage.ayr_name);
					SA.value = localStorage.ayr_name;
					
					localStorage.clear();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
	//alert(return_data);
});