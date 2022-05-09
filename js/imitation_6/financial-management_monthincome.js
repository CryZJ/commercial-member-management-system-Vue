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
    var Tab_1 = $('#dynamic-table').dataTable( {
    	"oLanguage": {
		 	"sEmptyTable": "无数据或加载中！",
		 	"sProcessing": "加载中...",
		 	"sLoadingRecords": "加载中...",
		 	"sZeroRecords": "没找到符合的数据"
		},
		"aLengthMenu": [
            [5,10,15,20,25,30,-1],
            [5,10,15,20,25,30,"全部"] 
        ],
        "iDisplayLength": -1,
        "aaSorting": [],
        "aoColumnDefs": [{//指定那列不进行排序
                'bSortable': false,
                'aTargets': [0]
            }
        ],
    } );
	
   
   
    
    //================================月收入记录==========================================
    //创建“月收入记录”表格列表
	function Creat_tab_1(data,Tab_obj){
		Tab_obj.fnAddData(['<input type="checkbox" class="box_son" name="'+data['id']+'" />','<a name="'+data['id']+'" onclick="checksr(this.name)">'+data['客户名称']+'</a>',data['项目内容'],data['总收费'],data['规费'],data['管理费'],data['税费'],data['收费方式'],data['收费日期'],data['案源人'],'<button class="delete_sr" name="'+data['id']+'" >删除</button>']);
	}
	function Creat_foottab_1(tab_id,data){
		$("#"+tab_id).html('<tr><td>'+data["本月"]+'</td><td>'+data["本月总收费"]+'</td><td>'+data["本月规费"]+'</td><td>'+data["本月管理费"]+'</td><td>'+data["本月税费"]+'</td></tr>');
	}
    //加载页面时创建表格信息--本月
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			Tab_1.children('tr').each(function(){
    				Tab_1.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_1(data[i],Tab_1);
    			}
    			Creat_foottab_1("tab_monthcount_sr",data["monthcount"]);
    		}else{
    			console.log("没有数据！");
    		}
    	},
    	error:function(x,s,t){
    		alert("获取数据失败！");
    		console.log("ajax error!"+s+t);
    	}
    });
    //填充选择月份
     $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_SELECT"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			for(i=0;i<data['num'];i++){
    				$("#Select_ny").append('<option>'+data[i]+'</option>');
    			}
    		}else{
    			console.log("没有数据！");
    		}
    	},
    	error:function(x,s,t){
    		alert("获取数据失败！");
    		console.log("ajax error!"+s+t);
    	}
    });
    //==========“月收入记录”监听事件============
    //检测月份改动动态创建表格
    $("#selected_value_sr").change(function(){
    	if($("select[name='dynamic-table_length']").attr("value") == -1){
    		if($(this).attr("value")){
	//  		console.log($(this).attr("value"));
	    		$.ajax({
			    	type:"get",
			    	url:"z_test.php",
			    	async:true,
			    	data:{
			    		flag:"GetFirstData_YM",
			    		Ym:$(this).attr("value")
			    	},
			    	dataType:"json",
			    	success:function(data){
			    		if(data["result"]=="success"){
			    			$("#selected_value_sr").attr("value","");
			    			$("#my_tab_1").find("tr").each(function(){
			    				Tab_1.fnDeleteRow($(this)[0]);
			    			});
			    			for(i=0;i<data['num'];i++){
			    				Creat_tab_1(data[i],Tab_1);
			    			}
			    			Creat_foottab_1("tab_monthcount_sr",data["monthcount"]);
			    		}else{
			    			$("#my_tab_1").find("tr").each(function(){
	//		    				console.log($(this)[0]);
			    				Tab_1.fnDeleteRow($(this)[0]);
			    			});
			    			console.log("没有数据！");
			    		}
			    	},
			    	error:function(x,s,t){
			    		alert("获取数据失败！");
			    		console.log("ajax error!"+s+t);
			    	}
			    });
	    	}
    	}else{
    		$(this).attr("value","");
    		alert("请把选择“全部 行/页”显示后再进行月份的选择...");
    	}
    });
    //删除收入记录
   $('#dynamic-table button.delete_sr').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_1.fnDeleteRow($(this).parents('tr')[0]);
        	$.ajax({
				data:{
					my_flag:"del_sr",
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
    //收入记录选中行到处Excel
    $(".exp_Excel_sr").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table input[class='box_son']").each(function(){
    		if($(this).attr("checked")){
    			str_id += ","+$(this).attr("name");
    			i++;
    		}
    	});
    	str_id = str_id.substr(1);
//  	console.log(str_id);
    	if(confirm("是否导出"+i+"行？")){
    		openPostWindow("../../phpexcel/my_test/sr_export.php","_blank",str_id);
    	}
    });
    
    
    
} );