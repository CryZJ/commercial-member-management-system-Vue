//选择案源人
function select_ayr() {
	//	alert(id);
	var ayr = document.getElementById("ayr");
		
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					
					var ayrv = document.getElementById("ayr").value;
					var dlr = document.getElementById("dlr").value;
					
					if(ayrv.length == 0 || dlr.length == 0) {
							
					}else{
						$.ajax({
							type: "get",
							url: "up_ajh.php",
							async: true,
							data: {
								ayr: ayrv,
								dlr: dlr
							},
							success: function(data) {
								document.getElementById("ajh").value = data;
					       }
						});
					}
					
					
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
//选择代理人
function select_dlr() {
	//	alert(id);
	var dlr = document.getElementById("dlr");
	//	ayr_len = ayr.value.length;
		
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
					
					var ayr = document.getElementById("ayr").value;
					var dlrv = document.getElementById("dlr").value;
					
					if(ayr.length == 0 || dlrv.length == 0) {
				
					}else{
							$.ajax({
								type: "get",
								url: "up_ajh.php",
								async: true,
								data: {
								ayr: ayr,
								dlr: dlrv
								},
								success: function(data) {
								
									document.getElementById("ajh").value = data;
									
						       }
						});
					}
					
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
//选择申请人
var xmlHttp;

var sqr_id = new String();
var $ary = new Array();
var SQ = document.getElementById("select_sqr");
SQ.addEventListener("click", function() {
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqr1.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					return_data = localStorage.return_data;
					
					var Tab_sqr = document.getElementById('tab_sqr1');
					var nrow = Tab_sqr.rows.length;
					if(nrow >= 3) {
						Tab_sqr.deleteRow(nrow - 1);
						if(nrow >= 4) {
							Tab_sqr.deleteRow(nrow - 2);
						}
						if(nrow >= 5) {
							Tab_sqr.deleteRow(nrow - 3);
						}
					}
					if(return_data.indexOf(",")>0){
			//			alert(return_data);
						var str = return_data.split(",");
						for (var i=1;i<=str.length;i++) {
							if (i>1) {
								newsqrtab();
							}
							var arr = str[i-1].split('/');
							for (var j=0;j<4;j++) {
								Tab_sqr.rows[i].cells[j].innerHTML = arr[j];
							}
						}
					}else{
						var arr = return_data.split("/");
						Tab_sqr.rows[1].cells[0].innerHTML = arr[0];
						Tab_sqr.rows[1].cells[1].innerHTML = arr[1];
						Tab_sqr.rows[1].cells[2].innerHTML = arr[2];
						Tab_sqr.rows[1].cells[3].innerHTML = arr[3];
					}
					
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
//多个申请人显示，表格增行
function newsqrtab(){
	var tabsqr = document.getElementById('tab_sqr1');
	var tablen = tabsqr.rows.length;
	var newRow = tabsqr.insertRow(tablen);
//	newRow.insertCell(0).innerHTML ='';
	newRow.insertCell(0).hidden    ='hidden';
	newRow.insertCell(1).innerHTML ='';
	newRow.insertCell(2).innerHTML ='';
	newRow.insertCell(3).innerHTML ='';
//	newRow.insertCell(0).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
//	newRow.insertCell(1).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
//	newRow.insertCell(2).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
//	alert('ok');
}
