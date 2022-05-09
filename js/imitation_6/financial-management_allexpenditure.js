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
////	alert($(".dynamic-table").html());
//	//拆分数据
//	var turn1 = tab1.split('/');
//	var turn2 = tab2.split('/');
//	var turn3 = tab3.split('/');
	//排序设置
    var Tab_6 = $('#dynamic-table_6').dataTable( {
    	"oLanguage": {
		 	"sEmptyTable": "无数据1！",
		 	"sProcessing": "加载中...",
		 	"sLoadingRecords": "加载中...",
		 	"sZeroRecords": "没找到符合的数据",
		},
		"aLengthMenu": [
            [5,10,15,20,25,30,-1],
            [5,10,15,20,25,30,"全部"] 
        ],
        "iDisplayLength": 5,
        "aaSorting": [],
        "aoColumnDefs": [{//指定那列不进行排序
                'bSortable': false,
                'aTargets': [0]
            }
        ],
        "sAjaxSource": "json_tabledata.php",
        "sServerMethod": "GET",
        "fnServerParams": function ( aoData ) {
	        aoData.push({ "name": "my_flag", "value": "allexpenditure" });
    	},
		"sAjaxDataProp": "data",
		"aoColumns":[
			{"mData":"inputcheckbox","sClass":"center"},
			{"mData":"支出项目"},
			{"mData":"金额"},
			{"mData":"支出日期"},
			{"mData":"收款人"},
			{"mData":"付款人"},
			{"mData":"操作"},
		]
    } );
    
      
    //========================“月支出记录”==========================================
    //加载时创建表格，本月的信息
    //创建“支出记录”表格列表
	function Creat_tab_2(data,Tab_obj){
		Tab_obj.fnAddData(['<input type="checkbox" class="box_son" name="'+data['id']+'" />','<a name="'+data['id']+'" onclick="checkzc(this.name)">'+data['支出项目']+'</a>',data['金额'],data['支出日期'],data['收款人'],data['付款人'],'<button class="delete_zc" name="'+data['id']+'" >删除</button>']);
	}
	function Creat_foottab_2(tab_id,data){
		$("#"+tab_id).html('<tr><td>'+data["本月"]+'</td><td>'+data["本月金额"]+'</td></tr>');
	}
   
    //====================总支出记录==========================
    function Creat_foottab_2_ALL(tab_id,data){
		$("#"+tab_id).html('<tr><td style="text-align: center;">'+data["本月金额"]+'</td></tr>');
	}
     //加载页面时创建表格信息
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_expense_ALL"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
//  			Tab_6.children('tr').each(function(){
//  				Tab_6.fnDeleteRow($(this));
//  			});
////  			alert(data[0]["id"]);
//  			for(i=0;i<data["num"];i++){
//  				Creat_tab_2(data[i],Tab_6);
//  			}
    			Creat_foottab_2_ALL("tab_monthcount_zc_ALL",data["monthcount"]);
    		}else{
    			console.log("没有数据！");
    		}
    	},
    	error:function(x,s,t){
    		alert("获取数据失败！");
    		console.log("ajax error!"+s+t);
    	}
    });
    //-----------总支出记录“监听事件”---------------
     //删除总支出记录
   $('#dynamic-table_6 button.delete_zc').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_6.fnDeleteRow($(this).parents('tr')[0]);
        	$.ajax({
				data:{
					my_flag:"del_zc",
					myid:id
				},
				type:"post",
				url:"financial-ajax.php",
				async:true,
				success:function(data){
					alert(data);
				},
				error:function(){
					alert("ajax error! + 保存失败！");
				}
			});
        }
    });
     //支出记录选中行导处Excel
    $(".export_Excel_zc_ALL").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table_6 input[class='box_son']").each(function(){
    		if($(this).attr("checked")){
    			str_id += ","+$(this).attr("name");
    			i++;
    		}
    	});
    	str_id = str_id.substr(1);
//  	console.log(str_id);
    	if(confirm("是否导出"+i+"行？")){
    		openPostWindow("../../phpexcel/my_test/zc_export.php","_blank",str_id);
    	}
    });
    
} );