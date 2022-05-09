var tab = document.getElementById("tab_set");//发明专利
var tab2 = document.getElementById("tab_set2");//实用新型
var tab3 = document.getElementById("tab_set3");//外观设计
//页面加载之后显示信息
//	发明专利
	$.ajax({
		type:"get",
		url:"YearCost_Sel.php",
		async:true,
		dataType:'json',
		data:{
			flag:'showA'
		},
		success:function(data){
			var x=0;
			var Input = tab.getElementsByTagName('input');
			for (i in data) {
				Input[x].value = data[i][100];
				Input[x+1].value = data[i][85];
				Input[x+2].value = data[i][70];
				x+=3;
			}
		},
		error:function(xhr,type,errorThrown){
			console.log(errorThrown);
			alert('ajax错误'+type+'---'+errorThrown);
		}
	});
//	实用新型
	$.ajax({
		type:"get",
		url:"YearCost_Sel.php",
		async:true,
		dataType:'json',
		data:{
			flag:'showB'
		},
		success:function(data){
			var y=0;
			var Input = tab2.getElementsByTagName('input');
			for (i in data) {
				Input[y].value = data[i][100];
				Input[y+1].value = data[i][85];
				Input[y+2].value = data[i][70];
				y+=3;
			}
		},
		error:function(t,e,c){
			alert(e);
		}
	});
//	外观设计
	$.ajax({
		type:"get",
		url:"YearCost_Sel.php",
		async:true,
		dataType:'json',
		data:{
			flag:'showC'
		},
		success:function(data){
			var z=0;
			var Input = tab3.getElementsByTagName('input');
			for (i in data) {
				Input[z].value = data[i][100];
				Input[z+1].value = data[i][85];
				Input[z+2].value = data[i][70];
				z+=3;
			}
		},
		error:function(t,e,c){
			alert(e);
		}
	});
//保存修改
function SaveChange(CaseType){
	if (CaseType == 'a') {
		var tab = document.getElementById("tab_set");
	} else if(CaseType == 'b'){
		var tab = document.getElementById("tab_set2");
	} else {
		var tab = document.getElementById("tab_set3");
	}
	var Mes_0='';//100
	var Mes_1='';//85
	var Mes_2='';//70
	for (var i=2;i<tab.rows.length;i++) {
		var Input_0 = tab.rows[i].cells[1].getElementsByTagName('input')[0].value;//100
		var Input_1 = tab.rows[i].cells[2].getElementsByTagName('input')[0].value;//85
		var Input_2 = tab.rows[i].cells[3].getElementsByTagName('input')[0].value;//70
//		alert(Input_0);
		Mes_0 = Mes_0 +'|'+ Input_0;
		Mes_1 = Mes_1 +'|'+ Input_1;
		Mes_2 = Mes_2 +'|'+ Input_2;
	}
	
	Mes_0 = Mes_0.substr(1,Mes_0.length);
	Mes_1 = Mes_1.substr(1,Mes_1.length);
	Mes_2 = Mes_2.substr(1,Mes_2.length);
//	alert(Mes_0);

	$.ajax({
		type:"get",
		url:"YearCost_Sel.php",
		async:true,
		data:{
			tab:CaseType,
			Mes_0:Mes_0,
			Mes_1:Mes_1,
			Mes_2:Mes_2,
			flag:'change'
		},
		success:function(data){
			alert(data);
//			console.log(data);
		},
		error:function(t,e,c){
			alert(e);
		}
	});
}
