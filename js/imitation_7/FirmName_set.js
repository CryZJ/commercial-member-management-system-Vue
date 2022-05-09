Select_4 = "";
//============================================页面初始化============================================================================
//初始化选择财务管理人员函数
function  Initialize_multi_select(){
	$('#my_multi_select3').multiSelect({
	    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询待选人...'>",
	    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询已选人...'>",
	    afterInit: function (ms) {
	        var that = this,
	            $selectableSearch = that.$selectableUl.prev(),
	            $selectionSearch = that.$selectionUl.prev(),
	            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
	            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
	
	        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	            .on('keydown', function (e) {
	                if (e.which === 40) {
	                    that.$selectableUl.focus();
	                    return false;
	                }
	            });
	
	        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	            .on('keydown', function (e) {
	                if (e.which == 40) {
	                    that.$selectionUl.focus();
	                    return false;
	                }
	            });
	    },
	    afterSelect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    },
	    afterDeselect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    }
	});	
	
	Select_4 = $('#my_multi_select4').multiSelect({
	    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询待选人...'>",
	    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询已选人...'>",
	    afterInit: function (ms) {
	        var that = this,
	            $selectableSearch = that.$selectableUl.prev(),
	            $selectionSearch = that.$selectionUl.prev(),
	            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
	            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
	
	        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	            .on('keydown', function (e) {
	                if (e.which === 40) {
	                    that.$selectableUl.focus();
	                    return false;
	                }
	            });
	
	        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	            .on('keydown', function (e) {
	                if (e.which == 40) {
	                    that.$selectionUl.focus();
	                    return false;
	                }
	            });
	    },
	    afterSelect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    },
	    afterDeselect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    }
	});
	
}

//清除Select的选中项
function Clear_selected(){
	$("select option").attr("selected",false);
	$('#my_multi_select3').multiSelect("refresh");
	$('#my_multi_select4').multiSelect("refresh");
}
//清除添加Mod的值
function Clear_Mod(mod_id){
	Clear_selected();
	$("#"+mod_id+" input").each(function(){
		$(this).attr("value","");
	});
}

//创建表格函数
function Create_tab(Tab_obj,adddata){
	Tab_obj.fnAddData(['<a data-toggle="modal" href="#addModal2" onclick="Alter('+adddata["id"]+')">'+adddata["firm"]+'</a>',adddata["user_name"]]);
}

//表格初始化
Tab_0 = $('#dynamic-table').dataTable( {
    		"aaSorting": [],
		} );
//获取数据填充表格
$.ajax({
	type:"get",
	url:"FirmName_set_ajax.php",
	async:true,
	data:{
		flag:"GetTableData"
	},
	dataType:"json",
	success:function(data){
//		console.log(data);
		if(data){
			if(data["result"] == "success"){
				if(data["row_num"]>0){
					for(var i=0,len=data["row_num"];i<len;i++){
						Create_tab(Tab_0,data[i]);
					}
				}
			}
		}
	},
	error:function(x,s,t){
		console.log("ajax error"+s+t);
	}
});
//获取财务人员的选择
$.ajax({
	type:"get",
	url:"FirmName_set_ajax.php",
	async:true,
	data:{
		flag:"GetSelect_user"
	},
	dataType:"json",
	success:function(data){
//		console.log(data);
		if(data){
			if(data["result"] == "success"){
				if(data["row_num"]>0){
					for(var i=0,len=data["row_num"];i<len;i++){
						$('#my_multi_select3').append('<option value="'+data[i]["id"]+'">'+data[i]["us_name"]+'</option>');
						$('#my_multi_select4').append('<option value="'+data[i]["id"]+'">'+data[i]["us_name"]+'</option>');
					}
				}
			}
		}
		Initialize_multi_select();
	},
	error:function(x,s,t){
		console.log("ajax error!"+s+"---"+t);
	}
});



//=======================================================操作函数======================================================================
//保存函数
function Save(form_id,select_id,flag_ajax){
	var company_name = "";
	company_name =  $("#"+form_id+" input").get(0).value;
	if(company_name){
		var usid_str = "";
		$("#"+select_id+" option").each(function(){
			if($(this).attr("selected")){
				usid_str += ","+$(this).attr("value");
			}
		});
		if(usid_str){
			usid_str = usid_str.substr(1);
//			console.log(flag_ajax+"\n"+company_name+"\n"+usid_str);
			$.ajax({
				type:"get",
				url:"FirmName_set_ajax.php",
				data:{
					flag:flag_ajax,
					firmname:company_name,
					usid:usid_str
				},
				async:true,
				success:function(data){
//					console.log(data);
					alert(data);
					self.location.reload();
				},
				error:function(x,s,t){
					alert("保存失败！");
					console.log("ajax error"+s+t);
				}
				
			});
		}else{
			alert("财务管理员为空！");
		}
	}else{
		alert("公司名称为空！");
	}
}

//保存修改函数
function Save_alter(form_id,select_id,flag_ajax){
	var company_name = "";
	var self_id = "";
	self_id = $("#"+form_id+" input").get(0).value;
	company_name =  $("#"+form_id+" input").get(1).value;
	if(company_name){
		var usid_str = "";
		$("#"+select_id+" option").each(function(){
			if($(this).attr("selected")){
				usid_str += ","+$(this).attr("value");
			}
		});
		if(usid_str){
			usid_str = usid_str.substr(1);
//			console.log(flag_ajax+"\n"+company_name+"\n"+usid_str+"\n"+self_id);
			
			$.ajax({
				type:"get",
				url:"FirmName_set_ajax.php",
				data:{
					flag:flag_ajax,
					firmname:company_name,
					usid:usid_str,
					self_id:self_id
				},
				async:true,
				success:function(data){
//					console.log(data);
					alert(data);
					self.location.reload();
				},
				error:function(x,s,t){
					alert("保存失败！");
					console.log("ajax error"+s+t);
				}
				
			});
		}else{
			alert("财务管理员为空！");
		}
	}else{
		alert("公司名称为空！");
	}	
}


//修改查看函数
function Alter(self_id){
	Clear_selected();//重置选项
	$.ajax({
		type:"get",
		url:"FirmName_set_ajax.php",
		async:true,
		data:{
			flag:"GetData_Alter",
			self_id:self_id
		},
		dataType:"json",
		success:function(data){
//			console.log(data);
			if(data){
				if(data["result"] == "success"){
					if(data["row_num"]>0){
						$("#my_form_2 input").get(0).value = data[0]["id"];
						$("#my_form_2 input").get(1).value = data[0]["firm"];
						var id_arr = data[0]["usid_str"].split(",");
						for(tmpid in id_arr){
//							console.log(id_arr[tmpid]);
							$("#my_multi_select4 option[value='"+id_arr[tmpid]+"']").attr("selected",true);
						}
						$('#my_multi_select4').multiSelect("refresh");
					}
				}
			}
		},
		error:function(x,s,t){
			console.log("ajax error"+s+t);
		}
	});
}
