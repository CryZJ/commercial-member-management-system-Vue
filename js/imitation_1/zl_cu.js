//打开委托书窗口
function openW(){
	window.open('new_disc.php?ajh='+'111','_blank','left=50,top=50,width=1250,height=600');
}
//选择申请人
var xmlHttp;

function select_sqr(){
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
					//		alert(return_data);
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
					alert("未选中申请人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//多个申请人显示，表格增行
function newsqrtab(){
	var tabsqr = document.getElementById('tab_sqr1');
	var tablen = tabsqr.rows.length;
	var newRow = tabsqr.insertRow(tablen);
	newRow.insertCell(0).hidden    ='hidden';
	newRow.insertCell(1).innerHTML ='';
	newRow.insertCell(2).innerHTML ='';
	newRow.insertCell(3).innerHTML ='';
}

//选择代理人
function select_dlr(id){
	//alert(return_data);
	var dlr = document.getElementById(id);
	var dlrid = document.getElementById('dlrid');
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
					dlrid.value = localStorage.dlr_id;
					dlr.value = localStorage.dlr_name;
					creatajh();
					
					localStorage.clear();
				}else{
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
	var ayrid = document.getElementById('ayrid');
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
					$("#"+id).attr("value",localStorage.ayr_name);
					ayrid.value = localStorage.ayr_id;
					ayr.value = localStorage.ayr_name;
					creatajh();
					
					localStorage.clear();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//生成案卷号
function creatajh(){
	var ayrid = document.getElementById('ayrid').value;
	var dlrid = document.getElementById('dlrid').value;
	var ajh = document.getElementById('ajh');
	if(dlrid.length!=0 && ayrid.length != 0){
		$.ajax({
			url:"cust_action.php",
			type:"post",
			async:true,
			data:{
				dlrid:dlrid,
				ayrid:ayrid,
				flag:'ajh'
			},
			success:function(data){
				ajh.value = data;
//				alert(data);
			}
		});
	}
}
//监控时间
  	//关于时间显示
	function showday(endtime){
		startime = document. getElementById('startime').value;
		document.getElementById('last_date').value=DateDiff(startime,endtime);
	}
	function showdaym(startime){
		endtime = document. getElementById('endtime').value;
		document.getElementById('last_date').value=DateDiff(startime,endtime);
	}
		//计算天数差的函数，通用 
	function  DateDiff(sDate1,  sDate2){    //sDate1和sDate2是2006-12-18格式  
       var  aDate,  oDate1,  oDate2,  iDays  
       aDate  =  sDate1.split("-")  
       oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])    //转换为12-18-2006格式  
       aDate  =  sDate2.split("-")  
       oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])  
       iDays  =  parseInt(Math.abs(oDate1  -  oDate2)  /  1000  /  60  /  60  /24)    //把相差的毫秒数转换为天数  
       return  iDays  
   } 
	function changedate(day){
//			firsttime = toLocaleDateString();
//			alert(firsttime);
		firsttime = document.getElementById('startime').value;
		lastdate = getNewDay(firsttime,day);
		document.getElementById('endtime').value = lastdate;
	}
		
	//日期加上天数得到新的日期  
	//dateTemp 需要参加计算的日期，days要添加的天数，返回新的日期，日期格式：YYYY-MM-DD  
	function getNewDay(dateTemp, days) {  
	    var dateTemp = dateTemp.split("-");  
	    var nDate = new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]); //转换为MM-DD-YYYY格式    
	    var millSeconds = Math.abs(nDate) + (days * 24 * 60 * 60 * 1000);  
	    var rDate = new Date(millSeconds);  
	    var year = rDate.getFullYear();  
	    var month = rDate.getMonth() + 1;  
	    if (month < 10) month = "0" + month;  
	    var date = rDate.getDate();  
	    if (date < 10) date = "0" + date;  
	    return (year + "-" + month + "-" + date);  
	}	
//保存信息
function savemes(){
	var bmes = '';//案件基本信息【表1】
	var cmes = '';//案件信息【表2】
	var emes = '';//备案信息【表3】
	var bz = '';//备注
	
	//保存基本信息
	var tab = document.getElementById('tabUserInfo_1');//获取表格
	for (var i=0;i<7;i++) {
		if (i == 3) {
			bmes = bmes + '|' + tab.rows[1].cells[i].getElementsByTagName('select')[0].value;
		}else if(i == 0 || i == 1){
			bmes = bmes+'|'+tab.rows[1].cells[i].getElementsByTagName('input')[1].value;
		}else{
			bmes = bmes+'|'+tab.rows[1].cells[i].getElementsByTagName('input')[0].value;
		}
	}
	bmes = bmes.substring(1,bmes.length);
//	alert(bmes);
	//保存申请人信息
	var tabsqr = document.getElementById('tab_sqr1');//获取表格
	var TabRow = tabsqr.rows.length;
//	alert(TabRow);
	for (var i=1;i<TabRow;i++) {
		cmes=cmes+ '|' +tabsqr.rows[i].cells[0].innerHTML;
	}
	cmes = cmes.substring(1,cmes.length);
//	alert(cmes);
	//保存备案信息
	var est0 = document.getElementById('startime').value;
	var est1 = document.getElementById('endtime').value;
	var est2 = document.getElementById('last_date').value;
	emes=est0+'|'+est1+'|'+est2;
	//其他信息
	bz = document.getElementById('case_bz').value;
	czy = document.getElementById('czy').value;//操作员
	
	$.ajax({
		url:"cust_action.php",
		type:"post",
		async:true,
		data:{
			flag:'savemes',
			bmes:bmes,
			cmes:cmes,
			emes:emes,
			bz:bz,
			czy:czy
		},
		success:function(date){
			var tab = document.getElementById('tabUserInfo_1');
			tab.rows[1].cells[1].getElementsByTagName('input')[1].value='';
			tab.rows[1].cells[2].getElementsByTagName('input')[0].value='';
			alert(date);
		}
	});
}
