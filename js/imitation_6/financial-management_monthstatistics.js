//原“js/dynamic_table_init.js”文件
function fnFormatDetails ( oTable, nTr ){
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';
    return sOut;
}

//window.open的post传输数据函数
function openPostWindow(url, name, data, data2){
     var tempForm = document.createElement("form");
     tempForm.id = "tempForm1";
     tempForm.method = "post";
     tempForm.action = url;
     tempForm.target=name;
     var hideInput1 = document.createElement("input");
     hideInput1.type = "hidden";
     hideInput1.name="data";
     hideInput1.value = data;
     var hideInput2 = document.createElement("input");
     hideInput2.type = "hidden";
     hideInput2.name="data2";
     hideInput2.value = data2;
     tempForm.appendChild(hideInput1);
     tempForm.appendChild(hideInput2);
     if(document.all){
         tempForm.attachEvent("onsubmit",function(){});        //IE
     }else{
         var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
     }
     document.body.appendChild(tempForm);
     if(document.all){
         tempForm.fireEvent("onsubmit");
     }else{
         tempForm.dispatchEvent(new Event("submit"));
     }
     tempForm.submit();
     document.body.removeChild(tempForm);
 }

$(document).ready(function() {
	//获取节点
//	var tab1 = $(".dynamic-table").html();//获取排序表1
//	var tab2 = $(".dynamic-table_2").html();//获取排序表2
//	var tab3 = $(".dynamic-table_3").html();//获取排序表3
//	alert($(".dynamic-table").html());
	//拆分数据
//	var turn1 = tab1.split('/');
//	var turn2 = tab2.split('/');
//	var turn3 = tab3.split('/');
	//排序设置
    $('#dynamic-table_3').dataTable( {
        "aaSorting": []
    } );
       
   
    
} );