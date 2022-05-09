function selectAll(obj,tab){
	tab_p = document.getElementById(tab);
	if(obj.checked){
		for(var i=1;i<tab_p.rows.length;i++){
		    tab_p.rows[i].cells[0].getElementsByTagName('input')[0].checked = 1;
		}
	}else{
		for(var i=1;i<tab_p.rows.length;i++){
		    tab_p.rows[i].cells[0].getElementsByTagName('input')[0].checked = 0;
		}
	}
}

//选择表格中本页全部的函数
function SelectAll_tab(inp_doc,tab_id){
	var tab_doc = document.getElementById(tab_id);
	for(i=0,len=tab_doc.rows.length;i<len;i++){
		tab_doc.rows[i].cells[0].getElementsByTagName("input")[0].checked = inp_doc.checked;
	}
}