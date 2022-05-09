//联系人增行
function addlxr_row(){
	var Table = document.getElementById("tab_3");
	var nRows = Table.rows.length;//num of row
	var nCells = Table.rows[1].cells.length;//num of cells
	var newRow_3 = Table.insertRow(nRows);//add a new row
	for(var i=0;i<nCells;i++){
		newRow_3.insertCell(i).innerHTML = Table.rows[1].cells[i].innerHTML;
	}
}

//联系人删行
function dellxr_row(){
	var Tab = document.getElementById("tab_3");
	var nrow = Tab.rows.length;
	for(var i=1;i<nrow;i++){
		var falg = Tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		if(falg==true){
//			alert(i);
			Tab.deleteRow(i);
			nrow--;
			i--;
		}
	}
}

//发明人增行
function addfmr_row(){
	var Table_1 = document.getElementById("tab_2");
	var nRows_1 = Table_1.rows.length;
	var nCells_1 = Table_1.rows[1].cells.length;
	
	var newRow_1 = Table_1.insertRow(nRows_1);
	newRow_1.align = 'center';
	newRow_1.insertCell(0).innerHTML = Table_1.rows[1].cells[0].innerHTML;
	newRow_1.insertCell(1).innerHTML = Table_1.rows[1].cells[1].innerHTML;
	newRow_1.insertCell(2).innerHTML = Table_1.rows[1].cells[2].innerHTML;

}
//发明人删行
function delfmr_row(){
	var Tab_1 = document.getElementById("tab_2");
	var nrow_1 = Tab_1.rows.length;
	for(var i=1;i<nrow_1;i=i+1){
		var falg = Tab_1.rows[i].cells[0].getElementsByTagName("input")[0].checked;
		if(falg==true){
//			alert(i);
			Tab_1.deleteRow(i);
			i=i-1;
			nrow_1--;
		}
	}
}

var x=0;
//地址增行
function addas(){
	x++;
	var tab = document.getElementById('tab_1');
	var nrow = tab.rows.length;
	var nnew = tab.insertRow(nrow);
	var nnnn = nnew.insertCell(0);
	nnnn.innerHTML = "<input style='width:700px;' type='text' name='' />";
	nnnn.colSpan = "6";
}

