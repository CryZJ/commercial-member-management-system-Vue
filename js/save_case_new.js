//监督进度条
	function uploadProgress(evt){
		if (evt.lengthComputable) {
	        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
			var file_list = document.getElementById("file_list");
			file_list.getElementsByTagName("strong")[0].innerHTML = '<span>'+percentComplete.toString()+'%</span>';
	        var prog = file_list.getElementsByTagName('div')[0];
			var progBar = prog.getElementsByTagName('div')[0];
			progBar.style.width= 2*percentComplete+'px';
			progBar.setAttribute('aria-valuenow', prog.percent);
	   }else {
	    	var file_list = document.getElementById("file_list");
	    	var prog = file_list.getElementsByTagName('div')[0];
	        prog.getElementsByTagName("div")[0].innerHTML = '上传失败！';
	    }
	}
//测试
//function save_data(){
//  var tab_sqr = document.getElementById('tab_sqr');
//  var tab_sqr_nrow = tab_sqr.rows.length;
//  var sqr_id = '';
////  alert(tab_sqr_nrow);
//  for (i = 1;i < tab_sqr_nrow; i++) {
//      sqr_id = sqr_id + tab_sqr.rows[i].cells[7].innerHTML + ',';
//  }
//  sqr_id = sqr_id.substring(0,sqr_id.length-1);//去掉最后面的一根“/”  
//  alert(sqr_id);
//}
//获取页面数据,异步传递数据
function save_data(tab){
	//获取案件基本信息部分信息
	var button_save = document.getElementById("button_save");
	button_save.onclick = null;
	var myform = document.getElementById("myform");
	var tab_ajdlr = document.getElementById('ajdlr').value;//获取案件处理人
	var tab_info = 'tab_ajxh' +'|'+ tab_ajdlr;
	//获取案件申请人的id
	var tab_sqr = document.getElementById('tab_sqr');
	var tab_sqr_nrow = tab_sqr.rows.length;
	var sqr_id = '';
//	alert(tab_sqr_nrow);
	for (i = 1;i < tab_sqr_nrow; i++) {
		sqr_id = sqr_id + tab_sqr.rows[i].cells[7].innerHTML + ',';
	}
	sqr_id = sqr_id.substring(0,sqr_id.length-1);//去掉最后面的一根“/”	
//	alert(sqr_id);
	//获取案件备注信息
	var case_bz = document.getElementById("case_bz").value;
//	alert(case_bz);
	//获取案件部分详细信息
	var num_row = tab.rows.length; 			//获取案件信息表格行数
	var num_cel = tab.rows[0].cells.length;	//获取一行中的列数
	var data_str = new String();			//创建数据字符串
	var arr_row = new Array();				//创建数据数组
	var massage_warming = 0;		//创建用于确认输入位置的数组
	
	for(var i = 1; i < num_row; i++){
		var check_null = tab.rows[i].cells[1].getElementsByTagName("input")[0].value.length;
		if(check_null == 0){
			continue;
		}else{
//			计算数据总量
			massage_warming ++;
			var str_ajh = tab.rows[i].cells[1].getElementsByTagName("input")[0].value;//获取案卷号
			var str_anlx = tab.rows[i].cells[2].getElementsByTagName("select")[0].value;//获取案卷类型
			var str_ayr = tab.rows[i].cells[3].getElementsByTagName("input")[0].value;//获取案源人
			var str_dlr = tab.rows[i].cells[4].getElementsByTagName("input")[0].value;//获取代理人
			var str_zlmc = tab.rows[i].cells[5].getElementsByTagName("input")[0].value;//获取专利名称
			data_str = str_ajh +"|"+ str_anlx +"|"+ str_ayr +"|"+ str_dlr +"|"+ str_zlmc;
		}
		if(data_str.length != "||||" ){
			var q = i-1;
			arr_row[q] = data_str;				//字符串加入数组
			data_str = "";						//清空字符串
		}
	}
	//获取发明设计人信息
	var tab = document.getElementById('tab_fmsjr');
	var FMSJRid = '';
	for(var z = 2;z < tab.rows.length;z++){
	    FMSJRid = FMSJRid + tab.rows[z].cells[0].innerHTML+',';
//      console.log(tab.rows[z].cells[0]);
	}
	FMSJRid = FMSJRid.substr(0,FMSJRid.length-1);
//	alert(FMSJRid);
	
	if (arr_row.length == 0||arr_row == null ) {	//判断表格数据是否为空
		alert("请填写案件信息");
		return;
	} else{
		//jQuery的异步 start
		$.ajax({
			type:"post",
			url:"casems_save.php",
			async:true,
			data:{
				ms:arr_row,
				tabf:tab_info,
				bz:case_bz,
				sqr:sqr_id,
				FMSJRid:FMSJRid
			},
			success:function(data){
				if(data==1){
					//测试用
					alert("数据保存成功,共保存"+massage_warming+"条数据");
					//异步上传文件：需要信息：案卷号，文件信息
					var my_tabinfo = document.getElementById("my_tabinfo");
					if(my_tabinfo.rows.length != 0){
						var fd = new FormData();
						var ajh_send = new Array();
						var file_num = 0;
						for(i=0;i<my_tabinfo.rows.length;i++){
							ajh_send[i] = my_tabinfo.rows[i].cells[1].getElementsByTagName("input")[0].value;
							var tmp_file = my_tabinfo.rows[i].cells[6].getElementsByTagName("input")[0].files;
							var tmp_file_num = "";
							tmp_file_num = new Array();
							fd.append(ajh_send[i],"nofile");
							if(tmp_file.length != 0){
								for(j=0;j<tmp_file.length;j++){
									fd.append(file_num,tmp_file[j]);
									tmp_file_num[j] = file_num;
									file_num++;
								}
								fd.append(ajh_send[i],tmp_file_num);
							}
						}
						fd.append("flag","upfile_za");
						fd.append("ajh",ajh_send);
						$.ajax({
							type:"post",
							url:"../../../newcasefile_save.php",
//							async:true,
							xhr:function(){
								myXhr = $.ajaxSettings.xhr();
								if(myXhr.upload){
									myXhr.upload.addEventListener('progress',uploadProgress,false);
								}
								return myXhr;
							},
							data:fd,
							processData:false,
							contentType:false,
							success:function(data){
								setTimeout(function(){
									alert(data);
//									window.location.href="../../../index.php";
                                    window.close();
	//								console.log(data);
								},1000);
							},
							error:function(){
								console.log("error ajax!");
							}
						});
					}
				}else{
					alert("数据保存失败");
				}
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("保存信息失败！");
				console.log("ajax error!"+XMLhttprequest+errorstatus+errorThrow);
				
			}
		});
//		jQuery的异步 end
	}
}