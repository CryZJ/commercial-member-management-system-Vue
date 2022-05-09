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
			//				SQ.value =arr[1]; //向申请人的input赋值
					Tab_sqr.rows[1].cells[0].innerHTML= arr[1];
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
			//					alert(return_data);
						var len=(arr.length/7)-1;
						var nlen = 2;
						while(len){
							var nrow = Tab_sqr.rows.length;
			//						var new_row = Tab_sqr.insertRow(nrow);
							var j=0;
							for(var i=len*7;i<len*7+7;i++){
								if(i==len*7){
									newsqrtab();
			//								alert(return_data);
									Tab_sqr.rows[nlen].cells[6].innerHTML = arr[i];
			//								j++;
								}else if(i==len*7+1){
									Tab_sqr.rows[nlen].cells[j].innerHTML = arr[i];
									j++;
								}else{
									Tab_sqr.rows[nlen].cells[j].innerHTML = arr[i];
									j++;
								}
							}
							len--;
							nlen++;
						}
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
	var tabsqr = document.getElementById('tab_sqr');
	var tablen = tabsqr.rows.length;
	var newRow = tabsqr.insertRow(tablen);
	newRow.insertCell(0).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(1).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(2).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(3).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(4).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(5).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
	newRow.insertCell(6).innerHTML = "<input style='background-color:#DDDDDD;' type='text' value='' name='' readonly='readonly' />";
//	alert('ok');
}

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
					createajh(id);
					
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
	var num = id.replace(/[^0-9]/ig,"");
//	var fzrid = "zlfz["+num+"]";
	var dlrid = "dlr["+num+"]";
//	alert(fzrid);
	var real_id = id.replace(/[^0-9]/ig,"");
//	alert(real_id);
	var ayr = document.getElementById(id);
//	var fzr = document.getElementById(fzrid);
//	ayr_len = ayr.value.length;
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
					if(document.getElementById(dlrid).value.length>0){
						createajh(id);
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
//改变案卷类型
function changeAJH(obj){
//	alert(obj.value);
	var id = obj.id;
	var real_id = id.replace(/[^0-9]/ig,"");
	createajh(id);
}
//生成案卷号
function createajh(btn_id){
	var btn_id = btn_id.replace(/[^0-9]/ig,"");
	btn_id = parseInt(btn_id);
//	alert(btn_id);
//	window.num_r = btn_id; //获取需要生成案卷号的行位置，并设置为全局变量
	//获取表格中类型、案源人、代理人
	var Table 	= document.getElementById("tabUserInfo");
    var ctype 	= Table.rows[btn_id+1].cells[2].getElementsByTagName("select")[0];
    var str2	= Table.rows[btn_id+1].cells[3].getElementsByTagName("input")[0].value;
    var str3	= Table.rows[btn_id+1].cells[4].getElementsByTagName("input")[0].value;
    var str 	= ctype.value;
//  alert(str+'+'+str2+'+'+str3);

	//案卷类型获取
   		if(str == "发明专利"){
   			str = 1;
   		}else if(str == "实用新型"){
   			str = 2;
   		}else if(str == "外观设计"){
   			str = 3;
   		}else{ alert("增添了新的专利名称了吗？"); }
   	//获取字符串的首字
   		//判断专利名称有没有填写
	   	if (str2 !== null||str2!== undefined||str2!=="") {
	   	} else{
	   		alert("请填写专利名称");
	   		return;
	   	}
   		//判断代理人有没有填写
   		//alert(str3);
	   	if (str3 !== null||str3!== undefined||str3!=="") {
	   	} else{
	   		alert("请选择代理人");
	   		return;
	   	}
	if(str2.length == 0 || str3.length == 0 ){
		alert("请将案源人，代理人信息填写完整");
		return;
	}
    $.ajax({
    	url:"up.php",
    	type:"post",
    	async:true,
    	data:{
    		str:str,
    		str2:str2,
    		str3:str3
    	},
    	success:function(data){
    		var tab_x = "ajh["+btn_id+"]";   // 获取案卷号需要添加的位置
    		document.getElementById(tab_x).value=data;
//  		alert(data);
    	}
    });
}
