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
	var tab1 = $(".dynamic-table").html();//获取排序表1
	var tab2 = $(".dynamic-table_2").html();//获取排序表2
	var tab3 = $(".dynamic-table_3").html();//获取排序表3
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
	var turn3 = tab3.split('/');
	//排序设置
    var Tab_1 = $('#dynamic-table').dataTable( {
    	"aLengthMenu": [
            [5,10,15,20,25,30,-1],
            [5,10,15,20,25,30,"全部"] 
        ],
        "iDisplayLength": -1,
        "aaSorting": [[ turn1[0], turn1[1] ]],
        "aoColumnDefs": [{//指定那列不进行排序
                'bSortable': false,
                'aTargets': [0]
            }
        ],
    } );
	var Tab_2 = $('#dynamic-table_2').dataTable( {
		"aLengthMenu": [
            [5,10,15,20,25,30,-1],
            [5,10,15,20,25,30,"全部"] 
        ],
        "iDisplayLength": -1,
        "aaSorting": [[ turn2[0], turn2[1] ]],
        "aoColumnDefs": [{//指定那列不进行排序
                'bSortable': false,
                'aTargets': [0]
            }
        ],
    } );
    $('#dynamic-table_3').dataTable( {
        "aaSorting": [[ turn3[0], turn3[1] ]]
    } );
    var Tab_4 = $('#dynamic-table_4').dataTable( {
		"aLengthMenu": [
            [5,10,15,20,25,30,-1],
            [5,10,15,20,25,30,"全部"] 
        ],
        "iDisplayLength": -1,
        "aaSorting": [[ turn2[0], turn2[1] ]],
        "aoColumnDefs": [{//指定那列不进行排序
                'bSortable': false,
                'aTargets': [0]
            }
        ],
    } );
    var Tab_5 = $('#dynamic-table_5').dataTable( {
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
    } );
    var Tab_6 = $('#dynamic-table_6').dataTable( {
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
    } );
    var Tab_7 = $('#dynamic-table_7').dataTable( {
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
    } );
   
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
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
    
    //========================“月支出记录”==========================================
    //加载时创建表格，本月的信息
    //创建“支出记录”表格列表
	function Creat_tab_2(data,Tab_obj){
		Tab_obj.fnAddData(['<input type="checkbox" class="box_son" name="'+data['id']+'" />','<a name="'+data['id']+'" onclick="checkzc(this.name)">'+data['支出项目']+'</a>',data['金额'],data['支出日期'],data['收款人'],data['付款人'],'<button class="delete_zc" name="'+data['id']+'" >删除</button>']);
	}
	function Creat_foottab_2(tab_id,data){
		$("#"+tab_id).html('<tr><td>'+data["本月"]+'</td><td>'+data["本月金额"]+'</td></tr>');
	}
    //加载页面时创建表格信息--本月
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_expense"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			Tab_1.children('tr').each(function(){
    				Tab_1.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_2(data[i],Tab_2);
    			}
    			Creat_foottab_2("tab_monthcount_zc",data["monthcount"]);
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
    		flag:"GetFirstData_SELECT_zc"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			for(i=0;i<data['num'];i++){
    				$("#sr_list").append('<option>'+data[i]+'</option>');
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
    //==========“支出记录”监听事件============
    //检测月份改动动态创建表格
    $("#select_Ymsr").change(function(){
    	if($("select[name='dynamic-table_2_length']").attr("value") == -1){
    		if($(this).attr("value")){
	//  		console.log($(this).attr("value"));
	    		$.ajax({
			    	type:"get",
			    	url:"z_test.php",
			    	async:true,
			    	data:{
			    		flag:"GetFirstData_YM_zc",
			    		Ym:$(this).attr("value")
			    	},
			    	dataType:"json",
			    	success:function(data){
			    		if(data["result"]=="success"){
			    			$("#select_Ymsr").attr("value","");
			    			$("#mytab_2").find("tr").each(function(){
			    				Tab_2.fnDeleteRow($(this)[0]);
			    			});
			    			for(i=0;i<data['num'];i++){
			    				Creat_tab_2(data[i],Tab_2);
			    			}
			    			Creat_foottab_2("tab_monthcount_zc",data["monthcount"]);
			    		}else{
			    			$("#select_Ymsr").attr("value","");
			    			$("#mytab_2").find("tr").each(function(){
	//		    				console.log($(this)[0]);
			    				Tab_2.fnDeleteRow($(this)[0]);
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
     //删除支出记录
   $('#dynamic-table_2 button.delete_zc').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_2.fnDeleteRow($(this).parents('tr')[0]);
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
    $(".export_Excel_zc").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table_2 input[class='box_son']").each(function(){
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
    
    //==================================“月欠费记录”======================================
    function Creat_tab_3(data,Tab_obj){
		Tab_obj.fnAddData(['<input type="checkbox" class="box_son" name="'+data['id']+'" />','<a name="'+data['id']+'" onclick="checkqf(this.name)">'+data['客户名称']+'</a>',data['项目内容'],data['总收费'],data['规费'],data['管理费'],data['税费'],data['收费方式'],data['收费日期'],data['案源人'],'<button class="delete_sr" name="'+data['id']+'" >删除</button>']);
	}
     //加载页面时创建表格信息--本月
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_Arrearage"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			Tab_4.children('tr').each(function(){
    				Tab_4.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_3(data[i],Tab_4);
    			}
    			Creat_foottab_1("tab_monthcount_qf",data["monthcount"]);
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
    		flag:"SELECT_Arrearage"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			for(i=0;i<data['num'];i++){
    				$("#Select_qf").append('<option>'+data[i]+'</option>');
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
    //==========“欠费记录”监听事件============
    //检测月份改动动态创建表格
    $("#selected_value_qf").change(function(){
    	if($("select[name='dynamic-table_4_length']").attr("value") == -1){
    		if($(this).attr("value")){
	//  		console.log($(this).attr("value"));
	    		$.ajax({
			    	type:"get",
			    	url:"z_test.php",
			    	async:true,
			    	data:{
			    		flag:"GetFirstData_YM_Arrearage",
			    		Ym:$(this).attr("value")
			    	},
			    	dataType:"json",
			    	success:function(data){
			    		if(data["result"]=="success"){
			    			$("#selected_value_qf").attr("value","");
			    			$("#my_tab_2").find("tr").each(function(){
			    				Tab_4.fnDeleteRow($(this)[0]);
			    			});
			    			for(i=0;i<data['num'];i++){
			    				Creat_tab_3(data[i],Tab_4);
			    			}
			    			Creat_foottab_1("tab_monthcount_qf",data["monthcount"]);
			    		}else{
			    			$("#my_tab_2").find("tr").each(function(){
	//		    				console.log($(this)[0]);
			    				Tab_4.fnDeleteRow($(this)[0]);
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
    //删除欠费记录
   $('#dynamic-table_4 button.delete_sr').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_4.fnDeleteRow($(this).parents('tr')[0]);
        	$.ajax({
				data:{
					my_flag:"del_qf",
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
    //欠费记录选中行到处Excel
    $(".exp_Excel_qf").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table_4 input[class='box_son']").each(function(){
    		if($(this).attr("checked")){
    			str_id += ","+$(this).attr("name");
    			i++;
    		}
    	});
    	str_id = str_id.substr(1);
//  	console.log(str_id);
    	if(confirm("是否导出"+i+"行？")){
    		openPostWindow("../../phpexcel/my_test/qf_export.php","_blank",str_id);
    	}
    });
    
    //============================总收入记录=======================================
    //函数
    function Creat_foottab_ALL(tab_id,data){
		$("#"+tab_id).html('<tr><td>'+data["本月总收费"]+'</td><td>'+data["本月规费"]+'</td><td>'+data["本月管理费"]+'</td><td>'+data["本月税费"]+'</td></tr>');
	}
    //加载页面时创建表格信息--所有的，按最新的记录在前面
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_ALL"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			Tab_5.children('tr').each(function(){
    				Tab_5.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_1(data[i],Tab_5);
    			}
    			Creat_foottab_ALL("tab_monthcount_sr_ALL",data["monthcount"]);
    		}else{
    			console.log("没有数据！");
    		}
    	},
    	error:function(x,s,t){
    		alert("获取数据失败！");
    		console.log("ajax error!"+s+t);
    	}
    });
    //-----------总收入记录“监听事件”---------------
   //删除总收入记录
   $('#dynamic-table_5 button.delete_sr').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_5.fnDeleteRow($(this).parents('tr')[0]);
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
    $(".exp_Excel_sr_ALL").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table_5 input[class='box_son']").each(function(){
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
    			Tab_6.children('tr').each(function(){
    				Tab_6.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_2(data[i],Tab_6);
    			}
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
    
    //=============================总欠费记录=======================================
     //加载页面时创建表格信息--本月
    $.ajax({
    	type:"get",
    	url:"z_test.php",
    	async:true,
    	data:{
    		flag:"GetFirstData_Arrearage_ALL"
    	},
    	dataType:"json",
    	success:function(data){
    		if(data["result"]=="success"){
    			Tab_7.children('tr').each(function(){
    				Tab_7.fnDeleteRow($(this));
    			});
//  			alert(data[0]["id"]);
    			for(i=0;i<data["num"];i++){
    				Creat_tab_3(data[i],Tab_7);
    			}
    			Creat_foottab_ALL("tab_monthcount_qf_ALL",data["monthcount"]);
    		}else{
    			console.log("没有数据！");
    		}
    	},
    	error:function(x,s,t){
    		alert("获取数据失败！");
    		console.log("ajax error!"+s+t);
    	}
    });
    //---------------------总欠费记录“监听事件”------------------------------------
    //删除欠费记录
   $('#dynamic-table_7 button.delete_sr').live('click', function (e) {
        e.preventDefault();
        if(confirm("是否删除记录？")){
        	id = $(this).attr("name");
        	Tab_7.fnDeleteRow($(this).parents('tr')[0]);
        	$.ajax({
				data:{
					my_flag:"del_qf",
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
    //欠费记录选中行到处Excel
    $(".exp_Excel_qf_ALL").on("click",function(){
    	var i = 0;
    	var str_id = "";
    	$("#dynamic-table_7 input[class='box_son']").each(function(){
    		if($(this).attr("checked")){
    			str_id += ","+$(this).attr("name");
    			i++;
    		}
    	});
    	str_id = str_id.substr(1);
//  	console.log(str_id);
    	if(confirm("是否导出"+i+"行？")){
    		openPostWindow("../../phpexcel/my_test/qf_export.php","_blank",str_id);
    	}
    });
    
} );