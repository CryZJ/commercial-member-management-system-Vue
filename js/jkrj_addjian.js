										//增行
	function addRow(){
		var Table = document.getElementById("ajjk");
		var nRows = Table.rows.length;
		var nCell = Table.rows[0].cells.length;
		var newRow = Table.insertRow(nRows);
		var onclick_cs = nRows-1;//获取的id编号
		newRow.insertCell(0).innerHTML = "<input type='checkbox' id='che["+onclick_cs+"]'  value='' name='' />";
		newRow.insertCell(1).innerHTML = "<input type='text' id='kjm["+onclick_cs+"]'  value='' name='' /><input type='hidden'  value='' name='' />";
		newRow.insertCell(2).innerHTML = "<input type='text' id='je["+onclick_cs+"]'  value='' name=''  />";
		newRow.insertCell(3).innerHTML = "<input type='date' id='sqday["+onclick_cs+"]'  value='' name=''  />";
		newRow.insertCell(4).innerHTML = "<input type='date' id='jzday["+onclick_cs+"]'  value='' name=''  />";
		newRow.insertCell(5).innerHTML = "<input type='text' id='bz["+onclick_cs+"]'  value='' name=''  />";
		newRow.insertCell(6).innerHTML = "";
	}
	
										//减行
	function delete_row(tabObj){
		var jkm_sc = '';
	var Tab =document.getElementById("ajjk");
	var nrow = Tab.rows.length;
//	alert(nrow);
	for(i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		if(falg == true){
		var jkm = document.getElementById("ajjk").rows[i].cells[1].getElementsByTagName("input")[0].value;
		$.ajax({
				type:"POST",
				url:"schu.php",
//				dataType:"json",
				//传参
				data:{
					jkm:jkm
				},
				success:function(data){
//					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
			});
		
		}
//		alert(jkm_sc);
       }
	   
//	alert(jkm_sc);
		
			
		var tb = tabObj;
		var row_num = tb.rows.length;
		for(var i = 1; i < row_num; i++){	//行循环
			var che_i = tb.rows[i].cells[0].getElementsByTagName("input")[0].checked;								//判断是否选中
			if (che_i == true){
				tb.deleteRow(i);
				i--;
				row_num--;
			}
		}
	};