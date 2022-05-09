										//增行
	function addRow(){
		var Table = document.getElementById("tabUserInfo");
		var nRows = Table.rows.length;
		var nCell = Table.rows[0].cells.length;
		var newRow = Table.insertRow(nRows);
		var onclick_cs = nRows-1;//获取的id编号
		newRow.insertCell(0).innerHTML = "<input type='checkbox' id='che["+onclick_cs+"]'  value='' name='' />";
		newRow.insertCell(1).innerHTML = "<input type='text' id='ajh["+onclick_cs+"]'  value='' name='"+onclick_cs+"' readonly />";
//		newRow.insertCell(2).innerHTML = Table.rows[1].cells[2].innerHTML;
		newRow.insertCell(2).innerHTML = "<input type='text' id='ayr["+onclick_cs+"]'  value='' name='' onclick='select_ayr(this.id)' readonly />";
		newRow.insertCell(3).innerHTML = "<input type='text' id='dlr["+onclick_cs+"]'  value='' name='' onclick='select_dlr(this.id)' readonly />";
		newRow.insertCell(4).innerHTML = Table.rows[1].cells[4].innerHTML;
//		var username = Table.rows[1].cells[4].getElementsByTagName('input')[0].value;
//		newRow.insertCell(4).innerHTML = "<input type='text' id='sel["+onclick_cs+"]' onclick='select_dlr(this.id)' readonly value='"+username+"' />";
		newRow.insertCell(5).innerHTML = "<input type='button' onclick='createajh("+onclick_cs+")' value='生成案号按钮' id='btn' name=''/>";
		newRow.insertCell(6).innerHTML = Table.rows[1].cells[6].innerHTML;
	}
	
										//新增联系人表格行数
	function add_proposer(){
		var Table = document.getElementById("tab_s");
		var nRows = Table.rows.length;
		var nCell = Table.rows[0].cells.length;
		var newRow = Table.insertRow(nRows);
		var onclick_cs = nRows-1;//获取的id编号
		newRow.insertCell(0).innerHTML = "<input type='checkbox' id='' name='Fruit' />";
		newRow.insertCell(1).innerHTML = "<input type='text' name='' id='select_lxr' readonly />";
		newRow.insertCell(2).innerHTML = Table.rows[1].cells[2].innerHTML;
		newRow.insertCell(3).innerHTML = Table.rows[1].cells[3].innerHTML;
		newRow.insertCell(4).innerHTML = "<input type='text' id='' name='' />"
		newRow.insertCell(5).innerHTML = "<input type='text' id='' name='' />";
	}

										//减行
	function delete_row(tabObj){
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
	
	function delete_proposer(tabObj){
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
											//小增行【申请人信息部分增行】
	function addRow_s(tabObj){
		var nTR = tabObj.insertRow(tabObj.rows.length-targPos);
		var TRs = tabObj.getElementsByTagName('TR');
		var sorTR = TRs[sorPos];
		var TDs = sorTR.getElementsByTagName('TD');
		if(colNum==0 || colNum==undefined || colNum==isNaN){
			colNum=tabObj.rows[0].cells.length;
		}
		
		var ntd = new Array();
		for(var i=0; i< colNum; i++){
			ntd[i] = nTR.insertCell();
			ntd[i].id = TDs[0].id;
			ntd[i].innerHTML = TDs[i].innerHTML;
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