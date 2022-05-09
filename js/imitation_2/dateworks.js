		 //===================事件增行=======================
			var addRow = document.getElementById('addRow');
			addRow.addEventListener('click',function(){
				var NoneDaWk = document.getElementById("NoneDaWk");
				if(NoneDaWk){
					NoneDaWk.hidden = true;
				}
				var tab = document.getElementById('tab');
				var nRows = tab.rows.length;
				var nCell = tab.rows[0].cells.length;
				var newRow = tab.insertRow(nRows);
				newRow.insertCell(0).innerHTML = "";
//				newRow.insertCell(1).innerHTML = "<input type='button' value='保存' onclick='SaveMes(this)' />";
//				newRow.insertCell(2).innerHTML = "<input class='' type='text' style='width:80%'; />";
//				newRow.insertCell(3).innerHTML = "<input class='' type='text' style='width:80%'; />";
				newRow.insertCell(1).innerHTML = '<input type="checkbox" hidden="hidden" />';
				newRow.insertCell(2).innerHTML = '<input type="text" style="width:80%"; />';
				newRow.insertCell(3).innerHTML = '<input type="text" style="width:80%"; />';
				newRow.insertCell(4).innerHTML = '<a class="btn" onclick="SaveMes(this)"><i class="fa fa-save"></i></a><a class="btn" onclick="Delete_Row(this)"><i class="fa fa-times"></i></a>';
				
		//		alert('ok');
				newRow.cells[0].hidden = true;
			});
		 
		 		 
		window.onload=function(){
			
  	 //===================事件初始化=======================	
  	 //计算今天日期
  	var TodayDate = new Date();
  	var month = TodayDate.getMonth()+1;
  	var day 	= TodayDate.getDate();
  	var DateNow = TodayDate.getFullYear() +'-'+ month +'-'+ day;
//		alert( TodayDate.getFullYear() +'-'+ month +'-'+ day);
		 //===================日历初始化=======================
		 //创建日历控件基本结构 
		 var obody=document.getElementById('CalT');
		 createbox();
		 function createbox(){
		  var ddbox=document.createElement("div");
		  ddbox.id="box";
		  var str="";
		  str+='<div id="title"><div id="prevyear"><<</div><div id="prevmonth"><</div><div id="month"></div><div id="year"></div><div id="nextmonth">></div><div id="nextyear">>></div></div>';
		  str+='<div id="week"><div>日</div><div>一</div><div>二</div><div>三</div><div>四</div><div>五</div><div>六</div></div>';
		  str+='<div id="con" class="clearfix"></div>';
			str+='<div id="btns"><button class="btn btn-primary" id="nowtime">当前时间</button><div id="cleartime" hidden="hidden">清空</div></div>';
		  ddbox.innerHTML=str;
		  obody.appendChild(ddbox);
		 };
		 //===================get ele=============================== 
		 var omonth=document.getElementById("month");
		 var oyear=document.getElementById("year");
		 var con=document.getElementById("con");
		 var prevmonth=document.getElementById("prevmonth");
		 var nextmonth=document.getElementById("nextmonth");
		 var prevyear=document.getElementById("prevyear");
		 var nextyear=document.getElementById("nextyear");
		 var nowtime=document.getElementById("nowtime");
		 var date=document.getElementById("date");
		 var box=document.getElementById("box");
		 var cleartime=document.getElementById("cleartime");
//		 date.value = "今日安排";

		 //===================show date===============================
		 con.onclick=function(event){//日期事项显示
		  if(event.target.tagName=="DIV" && event.target.nodeType=="1" && hasclass(event.target.className,"edate")){
		   date.value="";
		   date.value=dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		   var DateVal = dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		// box.style.display="none";
		   if(hasclass(event.target.className,"new")){
		   	$(".new").attr("class","now edate new");
		   	$(".yellowday").attr("class","yellowday ydate");
		   	$(".greenday").attr("class","greenday gdate");
		   	$(".redday").attr("class","redday rdate");
		   	$(".wdate").attr("class","edate");
		   	event.target.className = "new wdate";
		   }else{
		   	$(".new").attr("class","now edate new");
		   	$(".yellowday").attr("class","yellowday ydate");
		   	$(".greenday").attr("class","greenday gdate");
		   	$(".redday").attr("class","redday rdate");
		   	$(".wdate").attr("class","edate");
		   	event.target.className = "wdate";
		   }
		  }
		  else if(event.target.tagName=="DIV" && event.target.nodeType=="1" && hasclass(event.target.className,"ydate")){
		   date.value="";
		   date.value=dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		   var DateVal = dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		// box.style.display="none";
			
			if($(".wdate").attr("class")){
				if(hasclass($(".wdate").attr("class"),"yellowday")){
//		   		   alert("有黄色");
			   	   $(".new").attr("class","now edate new");
				   $(".greenday").attr("class","greenday gdate");
				   $(".redday").attr("class","redday rdate");
				   $(".wdate").attr("class","yellowday ydate");
				   event.target.className = "yellowday wdate";
			   }else{
//			   	   alert("无黄色")
			   	   $(".new").attr("class","now edate new");
				   $(".greenday").attr("class","greenday gdate");
				   $(".redday").attr("class","redday rdate");
				   $(".wdate").attr("class","edate");
				   event.target.className = "yellowday wdate";
			   }
			}else{//第一次点
				event.target.className = "yellowday wdate";
			}
		  }
		  else if(event.target.tagName=="DIV" && event.target.nodeType=="1" && hasclass(event.target.className,"gdate")){
		   date.value="";
		   date.value=dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		   var DateVal = dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		// box.style.display="none";
			if($(".wdate").attr("class")){
				if(hasclass($(".wdate").attr("class"),"greenday")){
				   $(".new").attr("class","now edate new");
				   $(".yellowday").attr("class","yellowday ydate");
				   $(".redday").attr("class","redday rdate");
				   $(".wdate").attr("class","greenday gdate");
				   event.target.className = "greenday wdate";
				}else{
				   $(".new").attr("class","now edate new");
				   $(".yellowday").attr("class","yellowday ydate");
				   $(".redday").attr("class","redday rdate");
				   $(".wdate").attr("class","edate");
				   event.target.className = "greenday wdate";
				}
			}else{//第一次点
				event.target.className = "greenday wdate";
			}
		  }
		  else if(event.target.tagName=="DIV" && event.target.nodeType=="1" && hasclass(event.target.className,"rdate")){
		   date.value="";
		   date.value=dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		   var DateVal = dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		// box.style.display="none";
		    if($(".wdate").attr("class")){
		    	if(hasclass($(".wdate").attr("class"),"redday")){
					$(".new").attr("class","now edate new");
				   $(".yellowday").attr("class","yellowday ydate");
				   $(".greenday").attr("class","greenday gdate");
				   $(".wdate").attr("class","redday rdate");
				   event.target.className = "redday  wdate";
				}else{
					$(".new").attr("class","now edate new");
				   $(".yellowday").attr("class","yellowday ydate");
				   $(".greenday").attr("class","greenday gdate");
				   $(".wdate").attr("class","edate");
				   event.target.className = "redday  wdate";
				}
		    }else{//第一次点
				event.target.className = "redday wdate";
			}
		  }
		  else if(event.target.tagName=="DIV" && event.target.nodeType=="1" && hasclass(event.target.className,"wdate")){
		   date.value="";
		   date.value=dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		   var DateVal = dateObj.getFullYear()+"-"+toyear(dateObj)+"-"+event.target.innerHTML;
		// box.style.display="none";
		  }
		//刷新事件表格
			ShowTab(DateVal);
		 };
		 cleartime.onclick=function(event){
		  date.value="";
		 };
		 //===================set year month===============================
		 //默认时间对象
		 var dateObj = new Date();
		 //动态控制
		 prevmonth.onclick=function(){//上一月
		  var ddm=null;
		  var ddy=null;
		  if((dateObj.getMonth()-1)==-1){
		   ddm=11;
		   ddy=dateObj.getFullYear()-1;
		  }else{
		   ddm=dateObj.getMonth()-1;
		   ddy=dateObj.getFullYear();
		  };
		  dateObj.setFullYear(ddy);
		  dateObj.setMonth(ddm);
		  omonth.innerHTML=toyear(dateObj)+"月";
		  oyear.innerHTML=dateObj.getFullYear()+"年";
		  
//		  console.log(dateObj.getFullYear()+ "#$#" + toyear(dateObj) );
		  
		  remove();
		  oneweek=oneyearoneday(dateObj);
		  alld=alldays(dateObj);
		//nowd=nowday(dateObj);
//		  init(oneweek,alld,nowd);
		  GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		 };
		 nextmonth.onclick=function(){//下一月
		  var ddm=null;
		  var ddy=null;
		  if((dateObj.getMonth()+1)==12){
		   ddm=0;
		   ddy=dateObj.getFullYear()+1;
		  }else{
		   ddm=dateObj.getMonth()+1;
		   ddy=dateObj.getFullYear();
		  };
		  dateObj.setFullYear(ddy);
		  dateObj.setMonth(ddm);
		  omonth.innerHTML=toyear(dateObj)+"月";
		  oyear.innerHTML=dateObj.getFullYear()+"年";
		  
//		  console.log(dateObj.getFullYear()+ "#$#" + toyear(dateObj) );
		  
//		  console.log(strday);
		  
		  remove();
		  oneweek=oneyearoneday(dateObj);
		  alld=alldays(dateObj);
		//nowd=nowday(dateObj);
//		  init(oneweek,alld,nowd);
		  GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		 };
		 prevyear.onclick=function(){//上一年
		  var ddy=dateObj.getFullYear()-1;
		  dateObj.setFullYear(ddy);
		  
		  console.log(toyear(dateObj));
		  
		  oyear.innerHTML=dateObj.getFullYear()+"年";
		  remove();
		  oneweek=oneyearoneday(dateObj);
		  alld=alldays(dateObj);
		//nowd=nowday(dateObj);
//		  init(oneweek,alld,nowd);
		  GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		 };
		 nextyear.onclick=function(){//下一年
		  var ddy=dateObj.getFullYear()+1;
		  dateObj.setFullYear(ddy);
		  oyear.innerHTML=dateObj.getFullYear()+"年";
		  remove();
		  oneweek=oneyearoneday(dateObj);
		  alld=alldays(dateObj);
		//nowd=nowday(dateObj);
//		  init(oneweek,alld,nowd);  
		  GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		 }; 
		 //返回到今时今日
		 nowtime.onclick=function(){
		  var dddate=new Date();
		  var ddm=dddate.getMonth();
		  var ddy=dddate.getFullYear();
		  dateObj.setFullYear(ddy);
		  dateObj.setMonth(ddm);
		  omonth.innerHTML=toyear(dateObj)+"月";
		  oyear.innerHTML=dateObj.getFullYear()+"年";
		  remove();
		  oneweek=oneyearoneday(dateObj);
		  alld=alldays(dateObj);
		  nowd=nowday(dateObj);
//		  init(oneweek,alld,nowd);  
		  GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		 };
		 //年月获取 
		 var year=dateObj.getFullYear();
		 var month=toyear(dateObj);//0是12月
		 //月年的显示
		 omonth.innerHTML=month+"月";
		 oyear.innerHTML=year+"年";
		 //===================set day===============================
		 
		 //获取本月1号的周值
		 var oneweek=oneyearoneday(dateObj);
		 //本月总日数
		 var alld=alldays(dateObj);
		 //当前是几
		 var nowd=nowday(dateObj);
		 //初始化显示本月信息
//		 init(oneweek,alld,nowd);
		 GetHaveThing(dateObj.getFullYear(),toyear(dateObj));
		  
		 //===================function===============================
		 //有无指定类名的判断
		 function hasclass(str,cla){
		  var i=str.search(cla);
		  if(i==-1){
		   return false;
		  }else{
		   return true;
		  };
		 };
		 //初始化日期显示方法
		 function remove(){
		  con.innerHTML="";
		 };
		 function init(oneweek,alld,nowd,red_date,green_date,yellow_date){
//		 	if(!str_day){
//		 		str_day = "0";
//		 	}
		 red_date = red_date.split(",");
		 green_date = green_date.split(",");
		 yellow_date = yellow_date.split(",");
		  for(var i=1;i<=oneweek;i++){//留空
		   var eday=document.createElement("div");
		   eday.innerHTML="";
		   con.appendChild(eday);
		  };
		  for(var i=1;i<=alld;i++){//正常区域
		   var eday=document.createElement("div");
		   if(i==nowd){//今天的天数底色     
		    eday.innerHTML=i;
		    eday.className="now edate new";
		    con.appendChild(eday);
//		   }else if(str_day.indexOf(i) != "-1"){//有事件的日期
		   }else if(jQuery.inArray(i.toString(),yellow_date) != "-1"){//有事件的日期未完成
		   	eday.innerHTML=i;
		    eday.className="yellowday ydate";
		    con.appendChild(eday);
		   }else if(jQuery.inArray(i.toString(),green_date) != "-1"){//有事件的日期已完成
		   	eday.innerHTML=i;
		    eday.className="greenday gdate";
		    con.appendChild(eday);
		   }else if(jQuery.inArray(i.toString(),red_date) != "-1"){//有事件的日期已完成
		   	eday.innerHTML=i;
		    eday.className="redday rdate";
		    con.appendChild(eday);
		   }else{//其他天数的底色
		    eday.innerHTML=i;
		    eday.className="edate";
		    con.appendChild(eday);
		   };
		  };
		 };
		 //===========获取这一年的这一个月有事件的日期字符串=============
		function GetHaveThing(y,m){
			var str_day = "";
			$.ajax({
				type:"get",
				url:"dateworks_Save.php",
				async:true,
				data:{
					flag:"GetDayString",
					y:y,
					m:m
				},
				dataType:"json",
				success:function(data){
					red_date = data["red_day"];
					green_date = data["green_day"];
					yellow_date = data["yellow_day"];
//					console.log(jQuery.inArray("1",str_day));
					console.log("red:"+red_date+"\n green:"+green_date+"\n yellow:"+yellow_date);
					init(oneweek,alld,nowd,red_date,green_date,yellow_date);
				},
				error:function(x,s,t){
					console.log("ajax error!"+s+t);
				}
			});
		}
		 //获取本月1号的周值
		 function oneyearoneday(dateObj){
		  var oneyear = new Date();
		  var year=dateObj.getFullYear();
		  var month=dateObj.getMonth();//0是12月
		  oneyear.setFullYear(year);
		  oneyear.setMonth(month);//0是12月
		  oneyear.setDate(1);
		  return oneyear.getDay();  
		 };
		 //当前是几
		 function nowday(dateObj){
		  return dateObj.getDate();
		 };
		 //获取本月总日数方法
		 function alldays(dateObj){
		  var year=dateObj.getFullYear();
		  var month=dateObj.getMonth();
		  if(isLeapYear(year)){//闰年
		   switch(month) { 
		   case 0: return "31"; break; 
		   case 1: return "29"; break; //2月
		   case 2: return "31"; break; 
		   case 3: return "30"; break; 
		   case 4: return "31"; break; 
		   case 5: return "30"; break; 
		   case 6: return "31"; break; 
		   case 7: return "31"; break; 
		   case 8: return "30"; break; 
		   case 9: return "31"; break; 
		   case 10: return "30"; break; 
		   case 11: return "31"; break;   
		   default:  
		   };
		  }else{//平年
		   switch(month) { 
		   case 0: return "31"; break; 
		   case 1: return "28"; break; //2月 
		   case 2: return "31"; break; 
		   case 3: return "30"; break; 
		   case 4: return "31"; break; 
		   case 5: return "30"; break; 
		   case 6: return "31"; break; 
		   case 7: return "31"; break; 
		   case 8: return "30"; break; 
		   case 9: return "31"; break; 
		   case 10: return "30"; break; 
		   case 11: return "31"; break;   
		   default:  
		   };   
		  };
		 };
		 //闰年判断函数
		 function isLeapYear(year){ 
		  if( (year % 4 == 0) && (year % 100 != 0 || year % 400 == 0)){
		   return true;
		  }else{
		   return false;
		  }; 
		 };
		 //月份转化方法
		 function toyear(dateObj){ 
		  var month=dateObj.getMonth()
		  switch(month) { 
		  case 0: return "1"; break; 
		  case 1: return "2"; break; 
		  case 2: return "3"; break; 
		  case 3: return "4"; break; 
		  case 4: return "5"; break; 
		  case 5: return "6"; break; 
		  case 6: return "7"; break; 
		  case 7: return "8"; break; 
		  case 8: return "9"; break; 
		  case 9: return "10"; break; 
		  case 10: return "11"; break; 
		  case 11: return "12"; break;   
		  default: 
		  }; 
		 };
		 ShowST();//显示已完成项
		};
		
		//===================事件保存=======================
		 function SaveMes(obj){
//		 	date.value//时间
			//指定日期
		 	if(date.value){
		 		var td = obj.parentNode;
		 		var tr = td.parentNode;
		 		var Mes = tr.getElementsByTagName('input');
		 		$.ajax({
		 			type:"get",
		 			url:"dateworks_Save.php",
		 			async:true,
		 			data:{
		 				date:date.value,
		 				MesShow:Mes[1].value,
		 				MesBz:Mes[2].value,
		 				flag:'SaveMes'
		 			},
		 			success:function(data){
		 				Mes[0].type = 'checkbox';
		 				tr.cells[3].innerHTML = Mes[2].value;
		 				tr.cells[2].innerHTML = Mes[1].value;
		 				tr.cells[1].innerHTML = "<input type='checkbox' class='0 chebox' hidden='hidden'  />";//onclick='ChanStu(this)'
		 				tr.cells[0].innerHTML = data;
		 				tr.cells[4].innerHTML ='<input hidden="hidden" type="checkbox" class="0 chebox"  onclick="ChanStu(this)" /><a class="btn" onclick="Chang_matter(this)"><i class="fa fa-pencil"></i></a><a class="btn" onclick="SaveMes_chang(this)"><i class="fa fa-save"></i></a><a class="btn" onclick="Delete_data(this)"><i class="fa fa-times"></i></a><input type="button" value="完成" onclick="CheckOn(this)" />'
		 			}
		 		});
		 	}
		 	//当前日期
		 	else{
		 		var td = obj.parentNode;
		 		var tr = td.parentNode;
		 		var Mes = tr.getElementsByTagName('input');
		 		$.ajax({
		 			type:"get",
		 			url:"dateworks_Save.php",
		 			async:true,
		 			data:{
						date:'',
		 				MesShow:Mes[1].value,//安排
		 				MesBz:Mes[2].value,//备注
		 				flag:'SaveMes'
		 			},
		 			success:function(data){
		 				Mes[0].type = 'checkbox';
		 				tr.cells[3].innerHTML = Mes[2].value;
		 				tr.cells[2].innerHTML = Mes[1].value;
		 				tr.cells[1].innerHTML = "<input type='checkbox' class='0 chebox' hidden='hidden' />";//onclick='ChanStu(this)'
		 				tr.cells[0].innerHTML = data;
		 				tr.cells[4].innerHTML ='<input hidden="hidden" type="checkbox" class="0 chebox"  onclick="ChanStu(this)" /><a class="btn"><i class="fa fa-pencil"></i></a><a class="btn" onclick="SaveMes_chang(this)"><i class="fa fa-save"></i></a><a class="btn" onclick="Delete_data(this)"><i class="fa fa-times"></i></a><input type="button" value="完成" onclick="CheckOn(this)" />'
		 			}
		 		});
		 	}
		 }
		 //==修改保存
		 function SaveMes_chang(obj){
	 		var td = obj.parentNode;
	 		var tr = td.parentNode;
	 		var Mes = tr.getElementsByTagName('input');
	 		var id = tr.cells[0].innerHTML;
	 		$.ajax({
	 			type:"get",
	 			url:"dateworks_Save.php",
	 			async:true,
	 			data:{
	 				id:id,
	 				MesShow:Mes[1].value,
	 				MesBz:Mes[2].value,
	 				flag:'SaveMes_chang'
	 			},
	 			success:function(data){
	 				alert(data);
	 				var bz = Mes[2].value;
//	 				console.log(id+Mes[1].value+bz);
	 				Mes[0].type = 'checkbox';
	 				tr.cells[0].innerHTML = id;
	 				tr.cells[1].innerHTML = "<input type='checkbox' class='0 chebox' hidden='hidden'  />";//onclick='ChanStu(this)'
					tr.cells[2].innerHTML = Mes[1].value;
					tr.cells[3].innerHTML = bz;
//	 				tr.cells[3].innerHTML = Mes[2].value;
	 				tr.cells[4].innerHTML ='<input hidden="hidden" type="checkbox" class="0 chebox"  onclick="ChanStu(this)" /><a class="btn" onclick="Chang_matter(this)"><i class="fa fa-pencil"></i></a><a class="btn" onclick="Delete_data(this)"><i class="fa fa-times"></i></a><input type="button" value="完成" onclick="CheckOn(this)" />';
	 			}
	 		});
		 }
		 //===================显示已完成事件======================= 
		 function ShowST(){
		 	//事项完成√
		 	var CheBox = document.getElementsByClassName('1');
		 	for (var i=0;i<CheBox.length;i++) {
		 		CheBox[i].checked = true;
		 		var tr_doc = CheBox[i].parentNode.parentNode;
		 		tr_doc.cells[4].innerHTML = '<input  hidden="hidden" type="checkbox" checked="true" class="1 chebox"  onclick="ChanStu(this)" /><input type="button" value="未完成" onclick="CheckOn(this)" />';
		 	}
		 	//隐藏id
		 	var Tab = document.getElementById("tab");
		 	for (var i=1;i<Tab.rows.length;i++) {
		 		Tab.rows[i].cells[0].hidden = true;
		 	}
		 }
		 //===================是否显示已完成事件======================= 
		 function ChanST(obj){
		 	if (obj.checked) {
	 			var CS = 1;
	 		} else{
	 			var CS = 0;
	 		}
	 		$.ajax({
	 			type:"get",
	 			url:"dateworks_Save.php",
	 			async:true,
	 			data:{
	 				ShowStu:CS,
	 				flag:'ChanShowStu'
	 			},
	 			success:function(data){
	 				if (data == 1||data == 3) {
//	 					alert(date.value);
	 					ShowTab(date.value);
//	 					alert('显示完成项修改成功');
	 				} else if(data == 2||data == 4){
	 					alert('显示完成项修改失败，请联系管理员');
	 				}else{
	 					alert('出现错误，请联系管理员');
	 				}
	 			}
//	 			,
//	 			error:function(xhr,type,errorThrown){
//	 				alert(errorThrown);
//	 			}
	 		});
		 }
		 //===================改变事件状态===============================
		 	function ChanStu(obj){//日期事项状态改变
		 		if (obj.checked) {
		 			var CS = 1;
		 		} else{
		 			var CS = 0;
		 		}
		 		var objtd = obj.parentNode;
		 		var objtr = objtd.parentNode;
		 		var MId	  = objtr.cells[0].innerHTML;
//		 		alert(MId);
//		 		alert(CS);
			  	$.ajax({
			  		type:"get",
			  		url:"dateworks_Save.php",
			  		async:true,
			  		data:{
			  			flag:'ChanStu',
			  			stu:CS,
			  			id:MId
			  		},
			  		success:function(data){
			  			if(data){
			  				//状态改变成功
			  				ShowTab(date.value);
			  			}else{
			  				alert('出现错误，请联系管理员');
			  			}
			  		}
//			  		,
//			  		error:function(x,t,e){
//			  			alert(e);
//			  		}
			  	});
			}
		//===================表格刷新======================= 
		function ShowTab(date){
			var tab = document.getElementById("tab");
			var CheStuate = document.getElementById("ShowType").checked;
			if (CheStuate) {
				CheStuate=1;
			} else{
				CheStuate=0;
			}
//			alert(CheStuate);
			$.ajax({
				type:"get",
				url:"dateworks_Save.php",
				async:true,
				dataType:'json',
				data:{
					date:date,
					CheStuate:CheStuate,
					flag:'ShowTab'
				},
				success:function(data){
//					//删去旧的表格数据
					for (var i=tab.rows.length-1;i>0;i--) {
						tab.deleteRow(i);
					}
					//动态创建日程事件
					if (data.length) {
//						alert(data);
//						console.log(data);
						for (var i=0;i<data.length;i++) {
							var DId = 	data[i].id;
							var DMes = 	data[i].事件名;
							var DSt = 	data[i].状态;
							var DBz = 	data[i].备注;
							CreatMesTab(DId,DMes,DSt,DBz);
						}
						ShowST();
					}
					//如果本日没有任务则显示提示
					else{
						var newRow = tab.insertRow(tab.rows.length);
						newRow.insertCell(0).innerHTML = "<strong>本日没有计划内日程</strong>";
						tab.rows[1].cells[0].colSpan = "5";
						tab.rows[1].cells[0].align = 'center';
						tab.rows[1].id = "NoneDaWk";
//						alert('0');
					}
				}
//				,
//				error:function(xhr,type,errorThrown){
//					console.log(errorThrown);
//					alert('ajax错误'+type+'---'+errorThrown);
//				}
			});
		}
		//有数据的创建
		function CreatMesTab(id,mes,stu,cbz){
			
			var tab = document.getElementById("tab");
			var newRow = tab.insertRow(tab.rows.length);
			newRow.insertCell(0).innerHTML = id;
			newRow.insertCell(1).innerHTML = "<input type='checkbox' class='"+stu+" chebox'  hidden='hidden' />";//onclick='ChanStu(this)'
			newRow.insertCell(2).innerHTML = mes;
			newRow.insertCell(3).innerHTML = cbz;
		 	newRow.insertCell(4).innerHTML ='<input hidden="hidden" type="checkbox" class="'+stu+' chebox"  onclick="ChanStu(this)" /><a class="btn" onclick="Chang_matter(this)"><i class="fa fa-pencil"></i></a><a class="btn" onclick="Delete_data(this)"><i class="fa fa-times"></i></a><input type="button" value="完成" onclick="CheckOn(this)" />&nbsp;<input type="button" name="'+id+'" value="上传" onclick="UpFiles(this.name)" />';
			
//			alert('ok');
		}
		
		//===================修改事件内容=====================
		function Chang_matter(a_doc){
			td_doc = a_doc.parentNode;
			tr_doc = td_doc.parentNode;
			M_id = tr_doc.cells[0].innerHTML;
			if(!td_doc.getElementsByTagName("input")[0].checked){
				td_doc.getElementsByTagName("input")[0].style.display = "none";
				var ap =  tr_doc.cells[2].innerHTML;
				var bz =  tr_doc.cells[3].innerHTML;
				tr_doc.cells[2].innerHTML = '<input type="text" value="'+ap+'" />';
				tr_doc.cells[3].innerHTML = '<input type="text" value="'+bz+'" />';
				tr_doc.cells[4].innerHTML = '<a class="btn" onclick="SaveMes_chang(this)"><i class="fa fa-save">';
			}else{
				alert("已完成事件不能删改！");
			}
		}
		
		//取消新增
		function Delete_Row(a_doc){
			tr_doc = a_doc.parentNode.parentNode;
			tab_doc = tr_doc.parentNode.parentNode;
			tab_doc.deleteRow(tr_doc.rowIndex);
		}
		//删除数据
		function Delete_data(a_doc){
			if(confirm("是否确认删除该事件？")){
				td_doc = a_doc.parentNode;
				tr_doc = td_doc.parentNode;
				M_id = tr_doc.cells[0].innerHTML;
				$.ajax({
					type:"get",
					url:"dateworks_Save.php",
					async:true,
					data:{
						id:M_id,
						flag:"Deletcdata"
					},
					success:function(data){
						alert(data);
						Delete_Row(a_doc);
						ShowTab(date.value);
					},
					error:function(x,s,t){
						alert("删除失败！");
						console.log("ajax error!"+s+t);
					}
				});
			}
		}
//完成
function CheckOn(obj){
	if (obj.value == '完成') {
		td_doc = obj.parentNode;
		var OInput = td_doc.getElementsByTagName('input');
		OInput[0].checked = true;
		ChanStu(OInput[0]);
		return ;
	}
	td_doc = obj.parentNode;
	var OInput = td_doc.getElementsByTagName('input');
	OInput[0].checked = false;
	ChanStu(OInput[0]);
	return ;
	
}

//上传文件窗口
function UpFiles(cid){
//	alert(cid);//upfile_dateworks.php
	var my_url = "upfile_dateworks.php?id="+cid;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 400;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	window.open(my_url,"_blank",specs);
}

