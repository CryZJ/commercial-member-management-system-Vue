										//增行
	function addRow(){
		var Table = document.getElementById("ajjk");
		var nRows = Table.rows.length-1;
		var nCell = Table.rows[0].cells.length;
		var newRow = Table.insertRow(nRows);
		var onclick_cs = nRows-1;//获取的id编号
		newRow.insertCell(0).innerHTML = Table.rows[1].cells[0].innerHTML;
		newRow.insertCell(1).innerHTML = "<input style='width: 80px;' type='text'   />";
		newRow.insertCell(2).innerHTML = "<input style='width: 150px;' type='file'   />";
		newRow.insertCell(3).innerHTML = "<input type='date'   />";
		newRow.insertCell(4).innerHTML = "<input type='date'   />";
		newRow.insertCell(5).innerHTML = "<input type='text'   />";
		newRow.insertCell(6).innerHTML = '<button onclick="save_kjxx(this)">保存</button><button onclick="del_row(this)">撤除</button>';
	}
	
										//减行
	function del(numberrows){
		var num   = new Array();          //定义一数组
            num   = numberrows.split("/");  //分割传过来的字符串
        var nrows = num[1];             //分割得到所删除的行数
//      alert(nrows);
	    var Tab =document.getElementById("ajjk");
		var jkm   = Tab.rows[nrows].cells[0].getElementsByTagName("input")[0].value;//获取监控名
//		alert(jkm);
		$.ajax({
				type:"POST",
				url:"shanc.php",
				//传参
				data:{
					jkm:jkm
				},
				success:function(data){
					alert(data);
//					alert("成功！");
				},
				error:function(){
//					alert("错误信息");
//					window.location="index.php";
				}
		});
       Tab.deleteRow(nrows);
	};
		