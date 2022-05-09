//显示申请人信息
function ShowSQR(SqrId){
    $.ajax({
        url:'select_people_newcase.php',
        type:'post',
        async:true,
        data:{
           flag:'ShowSQR',
           id:SqrId
        },
        dataType:'json',
        success:function(data){
//          console.log(data);
            if(data['result'] == 'success'){
                var Tab_sqr = document.getElementById('tab_sqr');
                //删去旧数据
                for(var y = Tab_sqr.rows.length; y > 1 ;y--){
                    Tab_sqr.deleteRow(1);
                }
                //增加新行
                for (var i=0;i<data['num'];i++) {
                    var nrow = Tab_sqr.rows.length;
                    var new_row = Tab_sqr.insertRow(nrow);
                    new_row.insertCell(0).innerHTML= data[i]['sqr'];//申请人姓名
                    new_row.insertCell(1).innerHTML= data[i]['zjh'];//证件号
                    new_row.insertCell(2).innerHTML= data[i]['dz'];//地址
                    new_row.insertCell(3).innerHTML= data[i]['yb'];//邮政编码
                    new_row.insertCell(4).innerHTML= data[i]['fj'];//费减年度
                    new_row.insertCell(5).innerHTML= data[i]['bz'];//备注
                    new_row.insertCell(6).innerHTML= data[i]['sqrlx'];//申请人类型
                    new_row.insertCell(7).innerHTML= data[i]['id'];//id
                    Tab_sqr.rows[i+1].cells[7].hidden = true;
                }
            }
        },
        error:function(e,t,s){
            alert('出现未知错误，请联系管理员');
        }
    });
}
//显示发明设计人信息
function ShowFMSJR(SqrId){
    //获取发明设计人
    $.ajax({
        url:'fmsjr.php',
        type:'post',
        async:true,
        data:{
            sqrid:SqrId
        },
        dataType:'json',
        success:function(data){
            var tab_fmsjr = document.getElementById('tab_fmsjr');
            for(var i=tab_fmsjr.rows.length;i>1;i--){
                tab_fmsjr.deleteRow(1);
            }
            var tab_len  = tab_fmsjr.rows.length;
            var new_fmr = tab_fmsjr.insertRow(tab_len);
            for(var z = 0;z<data['num'];z++){
                tab_len  = tab_fmsjr.rows.length;
                new_fmr = tab_fmsjr.insertRow(tab_len);
                new_fmr.insertCell(0).innerHTML = data[z]['id'];
                new_fmr.insertCell(1).innerHTML = data[z]['姓名'];
                new_fmr.insertCell(2).innerHTML = data[z]['证件号'];
                new_fmr.insertCell(3).innerHTML = '<button onclick="delFMSJR(this)">删除</button>';
                tab_fmsjr.rows[tab_len].cells[0].hidden = true;
            }
        }
    });
}
//响应点击新建申请人按钮
var sqr_id = new String();
var $ary = new Array();
var SQ = document.getElementById("select_sqr");
SQ.addEventListener("click",function(){
    var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 900;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_sqrNew.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.return_data){
					ShowSQR(localStorage.return_data);
       				ShowFMSJR(localStorage.return_data);
       				
					localStorage.clear();
				}else{
					alert("未选中客户！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
});
//改变案卷类型
function changeAJH(obj){
    var id = obj.id;
    var real_id = id.replace(/[^0-9]/ig,"");
//  alert(real_id);
    var dlr = 'dlr['+real_id+']';
    var ayr = 'ayr['+real_id+']';
    var dlrVal = document.getElementById(dlr).value;
    var ayrVal = document.getElementById(ayr).value;
    if(dlrVal && ayrVal){
    	createajh(id);
    }
}
//删除发明设计人
function delFMSJR(btn){
    var tab = document.getElementById('tab_fmsjr');
    var td = btn.parentNode;
    var tr = td.parentNode;
    var row = tr.rowIndex;
    tab.deleteRow(row);
}

//选择代理人  
function select_dlr(id){
	var real_id = id.replace(/[^0-9]/ig,"");
	//alert(return_data);
	var dlr = document.getElementById(id);
//	dlr = dlr.value.length;

	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					dlr.value = localStorage.dlr_name;
					createajh(id);
					
					localStorage.clear();
				}else{
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择案源人
function select_ayr(id){
//	alert(id);
	var num = id.replace(/[^0-9]/ig,"");
	var fzrid = "zlfz["+num+"]";
	var dlrid = "dlr["+num+"]";
//	alert(fzrid);
	var real_id = id.replace(/[^0-9]/ig,"");
//	alert(real_id);
	var ayr = document.getElementById(id);
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					ayr.value = localStorage.ayr_name;
					
					if(document.getElementById(dlrid).value.length>0){
						createajh(id);
					}
					
					localStorage.clear();
				}else{
					ayr.value = '';
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);

}

//生成案卷号
function createajh(btn_id){
	var btn_id = btn_id.replace(/[^0-9]/ig,"");
	btn_id = parseInt(btn_id);
//	alert(typeof(btn_id));
//	window.num_r = btn_id; //获取需要生成案卷号的行位置，并设置为全局变量
	//获取表格中类型、案源人、代理人
	var Table 	= document.getElementById("tabUserInfo");
    var ctype 	= Table.rows[btn_id+1].cells[2].getElementsByTagName("select")[0];
    var str2	= Table.rows[btn_id+1].cells[3].getElementsByTagName("input")[0].value;
    var str3	= Table.rows[btn_id+1].cells[4].getElementsByTagName("input")[0].value;
    var str 	= ctype.value;
//  alert(str+'+'+str2+'+'+str3);
	if (str) {
		//获取案件申请人的id
		var tab_sqr = document.getElementById('tab_sqr');
		var tab_sqr_nrow = tab_sqr.rows.length;
		var sqr_id = '';
	//	alert(tab_sqr_nrow);
		for (i = 1;i < tab_sqr_nrow; i++) {
	//		alert(i);
			sqr_id = sqr_id + tab_sqr.rows[i].cells[6].innerHTML + ',';
		}
		sqr_id = sqr_id.substring(0,sqr_id.length-1);//去掉最后面的一根“/”	
	//	alert(sqr_id);
		
		
		//案卷类型获取
	   		if(str == "发明专利"){
	   			str = 1;
	   		}else if(str == "实用新型"){
	   			str = 2;
	   		}else if(str == "外观设计"){
	   			str = 3;
	   		}else{ alert("增添了新的专利名称了吗？"); }
	   	//获取字符串的首字
	   		//判断专利名称有没有填写
		   	if (str2 !== null||str2!== undefined||str2!=="") {
		   	} else{
		   		alert("请填写专利名称");
		   		return;
		   	}
	   		//判断代理人有没有填写
	   		//alert(str3);
//		   	if (str3 !== null||str3!== undefined||str3!=="") {
//		   	} else{
//		   		alert("请选择代理人");
//		   		return;
//		   	}
//		if(str2.length == 0 || str3.length == 0 ){
//			alert("请将案源人，代理人信息填写完整");
//			return;
//		}
	//	alert(sqr_id);
	    $.ajax({
	    	url:"up.php",
	    	type:"post",
	    	async:true,
	    	data:{
	    		str:str,
	    		str2:str2,
	    		str3:str3,
	    		sqr_id:sqr_id
	    	},
	    	success:function(data){
	    		var tab_x = "ajh["+btn_id+"]";   // 获取案卷号需要添加的位置
	    		document.getElementById(tab_x).value=data;
	//  		alert(data);
	    	}
	    });
		
	} else{
		alert('请先选择案件类型');
	}
	
	
}