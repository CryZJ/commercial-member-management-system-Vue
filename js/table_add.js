										//增行
	function addRow(){
		var Table = document.getElementById("tabUserInfo");
		var nRows = Table.rows.length;
		var nCell = Table.rows[0].cells.length;
		var newRow = Table.insertRow(nRows);
		var onclick_cs = nRows-1;//获取的id编号
		newRow.insertCell(0).innerHTML = "<input type='checkbox' id='che["+onclick_cs+"]'  value='' name='' />";//checkbox
		newRow.insertCell(1).innerHTML = "<input type='text' id='ajh["+onclick_cs+"]'  value='' name='ajh[]' readonly />";//ajh
//		newRow.insertCell(2).innerHTML = Table.rows[1].cells[2].innerHTML;//type
		newRow.insertCell(2).innerHTML = '<select name="lx" id="lx['+onclick_cs+']" onchange="changeAJH(this)"><option value=""></option><option value="发明专利">发明专利</option><option value="实用新型">实用新型</option><option value="外观设计">外观设计</option></select>';
		newRow.insertCell(3).innerHTML = "<input style='width:100px' type='text' id='ayr["+onclick_cs+"]'  value='' name='' onclick='select_ayr(this.id)' readonly />";//ayr
		newRow.insertCell(4).innerHTML = "<input style='width:100px' type='text' id='dlr["+onclick_cs+"]'  value='' name='' onclick='select_dlr(this.id)' readonly />";//dlr
		newRow.insertCell(5).innerHTML = Table.rows[1].cells[5].innerHTML;//caseneme
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

//创建响应
	function get_xmlhttp(){						
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return xmlhttp;
	}