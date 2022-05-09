//鼠标移入移出
    $('.AddRow').mouseover(function(){
        $(this).css("background-color","#E0E1E0");
    });
    $('.AddRow').mouseout(function(){
        $(this).css("background-color","#FFFFFF");
    });
    $(function() {
        $('#Datepicker').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-MM',
            showButtonPanel: true,
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month option:selected").val();//得到选中的月份值
                var year = $("#ui-datepicker-div .ui-datepicker-year option:selected").val();//得到选中的年份值
                $('#Datepicker').val(year+'-'+(parseInt(month)+1));//给input赋值，其中要对月值加1才是实际的月份
            }
        });
     });  
    //表格增行
    function AddRow(flag,obj){
        var table = {};
        var objTr = obj.parentNode;
        var tanRow = objTr.rowIndex;
        switch (flag){
            case 'FareMes':
                table = document.getElementById("tab4");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input style="width: 50px;" class="TabMes_4 NumType" type="text" id="" />';
                NewRow.insertCell(1).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" onchange="CountA(this)" />';
                NewRow.insertCell(2).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" />';
                NewRow.insertCell(3).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" onchange="CountA(this)" />';
                NewRow.insertCell(4).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" />';
                NewRow.insertCell(5).innerHTML = '<input style="width: 120px;" type="text" id="" readonly="readonly"/>';
                NewRow.insertCell(6).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" />';
                NewRow.insertCell(7).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" />';
                NewRow.insertCell(8).innerHTML = '<input style="width: 120px;" class="NumType" type="text" id="" />';
                NewRow.insertCell(9).innerHTML = '<input style="width: 120px;" type="text" id="" readonly="readonly"/>%';
                NewRow.insertCell(10).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            case 'ProMes':
                table = document.getElementById("tab5");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<select class="ProList ProMes"><option></option><option>国家级</option><option>省级</option><option>市级</option><option>区级</option></select>';
                NewRow.insertCell(1).innerHTML = '<input type="date" id="" style="height: 26px;" class="ProMes"/>';
                NewRow.insertCell(2).innerHTML = '<input style="width: 98%;" class="ProMes" type="text" id=""/>';
                NewRow.insertCell(3).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            case 'ZSMes':
                table = document.getElementById("tab5");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="date" class="ZSMes ZS" id="" style="height: 26px;"/>';
                NewRow.insertCell(1).innerHTML = '<input style="width: 98%;" class="ZS" type="text" id=""/>';
                NewRow.cells[1].colSpan='2';
                NewRow.insertCell(2).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
//              alert(tanRow);
                break;
            case 'PeoInLow':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="PeoInLow" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                NewRow.insertCell(2).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            case 'FareCount':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="FareCount" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                NewRow.insertCell(2).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            case 'TecPeo':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="TecPeo" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                NewRow.insertCell(2).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            case 'LifeCon':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="LifeCon" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                NewRow.insertCell(2).innerHTML = '<button class="delRow" onclick="DelRow(this)">删除</button>';
                break;
            default:
                alert('出现错误，请联系管理员');
                return;
                break;
        }
    }
    //获取数据
    function ChangeMes(){
        //获取案源人
        var ayr = document.getElementById("ayr").value;
        //获取第一个表格的数据
        var TabMes_1 = '';
        var TabArr_1 = document.getElementsByClassName("TabMes_1");
        for (var i=0;i<TabArr_1.length;i++) {
            TabMes_1 = TabMes_1+TabArr_1[i].value+'||';
        }
        TabMes_1 = TabMes_1.substr(0,TabMes_1.length-2);
//      alert(TabMes_1);
        //获取第二个表格的数据
        var TabMes_2 = '';
        var TabArr_2 = document.getElementsByClassName("TabMes_2");
        for (var i=0;i<TabArr_2.length;i++) {
            TabMes_2 = TabMes_2+TabArr_2[i].value+'||';
        }
        TabMes_2 = TabMes_2.substr(0,TabMes_2.length-2);
//      alert(TabMes_2);
        //获取第三个表格的数据
        var TabMes_3 = '';
        var TabArr_3 = document.getElementsByClassName("TabMes_3");
        for (var i=0;i<TabArr_3.length;i++) {
            TabMes_3 = TabMes_3+TabArr_3[i].value+'||';
        }
        TabMes_3 = TabMes_3.substr(0,TabMes_3.length-2);
//      alert(TabMes_3);
        //获取第四个表格的数据
        var TabMes_4 = '';
        var TabArr_4 = document.getElementsByClassName("TabMes_4");
        //行数获取
        for (var i=0;i<TabArr_4.length;i++) {
            var fareMes = '';
            var objTd = TabArr_4[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByTagName('input');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<10;y++){
                    fareMes = fareMes + Inpur[y].value+',';
                }
                fareMes = fareMes.substr(0,fareMes.length-1);
                TabMes_4 = TabMes_4+fareMes+'||';
            }
        }
        TabMes_4 = TabMes_4.substr(0,TabMes_4.length-2);
//      alert(TabMes_4);
        //获取第五个表格的数据
        var TabMes_5 = '';
        var TabArr_5 = document.getElementsByClassName("TabMes_5");
        for (var i=0;i<TabArr_5.length;i++) {
            TabMes_5 = TabMes_5+TabArr_5[i].value+'||';
        }
        TabMes_5 = TabMes_5.substr(0,TabMes_5.length-2);
        //各级立项情况信息获取
        var ProList = document.getElementsByClassName("ProList");
        var ProMesAll='';
        //行数获取
        for (var i=0;i<ProList.length;i++) {
            var ProMes = '';
            var objTd = ProList[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByClassName('ProMes');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<3;y++){
                    ProMes = ProMes + Inpur[y].value+',';
                }
                ProMes = ProMes.substr(0,ProMes.length-1);
                ProMesAll = ProMesAll+ProMes+'//';
            }
        }
        ProMesAll = ProMesAll.substr(0,ProMesAll.length-2);
        TabMes_5 = TabMes_5+'||'+ProMesAll;
        //资质证书信息获取
        var ZSMes = document.getElementsByClassName("ZSMes");
        var ZSListMesAll = '';
        //行数获取
        for (var i=0;i<ZSMes.length;i++) {
            var ZSListMes = '';
            var objTd = ZSMes[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByClassName('ZS');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<2;y++){
                    ZSListMes = ZSListMes + Inpur[y].value+',';
                }
                ZSListMes = ZSListMes.substr(0,ZSListMes.length-1);
                ZSListMesAll = ZSListMesAll+ZSListMes+'//';
            }
        }
        ZSListMesAll = ZSListMesAll.substr(0,ZSListMesAll.length-2);
        TabMes_5 = TabMes_5+'||'+ZSListMesAll;
//      alert(TabMes_5);
        //获取第六个表格的数据
        var TabMes_6 = '';
        var TabArr_6 = document.getElementsByClassName("TabMes_6");
        for (var i=0;i<TabArr_6.length;i++) {
            TabMes_6 = TabMes_6+TabArr_6[i].value+'||';
        }
        TabMes_6 = TabMes_6.substr(0,TabMes_6.length-2);
//      alert(TabMes_6);
        //获取第七个表格的数据
        var TabMes_7 = '';
        //获取法人代表信息
        var PeoInLow = document.getElementsByClassName("PeoInLow");
        var PeoInLowMesAll = '';
        //行数获取
        for (var i=0;i<PeoInLow.length;i++) {
            var PeoInLowMes = '';
            var objTd = PeoInLow[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByTagName('input');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<2;y++){
                    PeoInLowMes = PeoInLowMes + Inpur[y].value+',';
                }
                PeoInLowMes = PeoInLowMes.substr(0,PeoInLowMes.length-1);
                PeoInLowMesAll = PeoInLowMesAll+PeoInLowMes+'//';
            }
        }
        PeoInLowMesAll = PeoInLowMesAll.substr(0,PeoInLowMesAll.length-2);
        TabMes_7 = PeoInLowMesAll;
        //获取财务管理员信息
        var FareCount = document.getElementsByClassName("FareCount");
        var FareCountMesAll = '';
        //行数获取
        for (var i=0;i<FareCount.length;i++) {
            var FareCountMes = '';
            var objTd = FareCount[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByTagName('input');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<2;y++){
                    FareCountMes = FareCountMes + Inpur[y].value+',';
                }
                FareCountMes = FareCountMes.substr(0,FareCountMes.length-1);
                FareCountMesAll = FareCountMesAll+FareCountMes+'//';
            }
        }
        FareCountMesAll = FareCountMesAll.substr(0,FareCountMesAll.length-2);
        TabMes_7 = TabMes_7 +'||'+FareCountMesAll;
        //获取技术管理员信息
        var TecPeo = document.getElementsByClassName("TecPeo");
        var TecPeoMesAll = '';
        //行数获取
        for (var i=0;i<TecPeo.length;i++) {
            var TecPeoMes = '';
            var objTd = TecPeo[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByTagName('input');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<2;y++){
                    TecPeoMes = TecPeoMes + Inpur[y].value+',';
                }
                TecPeoMes = TecPeoMes.substr(0,TecPeoMes.length-1);
                TecPeoMesAll = TecPeoMesAll+TecPeoMes+'//';
            }
        }
        TecPeoMesAll = TecPeoMesAll.substr(0,TecPeoMesAll.length-2);
        TabMes_7 = TabMes_7 +'||'+TecPeoMesAll;
        //获取日常联系人信息
        var LifeCon = document.getElementsByClassName("LifeCon");
        var LifeConMesAll = '';
        //行数获取
        for (var i=0;i<LifeCon.length;i++) {
            var LifeConMes = '';
            var objTd = LifeCon[i].parentNode;
            var objTr = objTd.parentNode;
            var Inpur = objTr.getElementsByTagName('input');
            //列信息获取
            if(Inpur[0].value){
                for(var y=0;y<2;y++){
                    LifeConMes = LifeConMes + Inpur[y].value+',';
                }
                LifeConMes = LifeConMes.substr(0,LifeConMes.length-1);
                LifeConMesAll = LifeConMesAll+LifeConMes+'//';
            }
        }
        LifeConMesAll = LifeConMesAll.substr(0,LifeConMesAll.length-2);
        TabMes_7 = TabMes_7 +'||'+LifeConMesAll;
//      alert(TabMes_7);
        //获取企业信息备注
        var CaseBz = document.getElementById("case_bz").value;
        //获取企业信息id
        var Cid = document.getElementById("Cid").innerHTML;
//      alert(Cid);
        
        if(document.getElementById("ClientName").value){
            //异步传输数据
            $.ajax({
                type:"post",
                url:"CaseSave.php",
                async:true,
                data:{
                    falg:'CMS_Change',
                    ayr:ayr,
                    TabMes_1:TabMes_1,
                    TabMes_2:TabMes_2,
                    TabMes_3:TabMes_3,
                    TabMes_4:TabMes_4,
                    TabMes_5:TabMes_5,
                    TabMes_6:TabMes_6,
                    TabMes_7:TabMes_7,
                    CaseBz:CaseBz,
                    Cid:Cid
                },
                success:function (data){
//                  console.log(data);
                    if(data == 'ok'){
                        if(confirm("企业资料修改成功,是否继续新建企业信息")){
                            window.location.reload();
                        }else{
                            window.close();
                        }
                    }else{
                        alert(data);
                        console.log(data);
                    }
                },
                error:function (e,t,s){
                    alert(s);
                }
            });
        }else{
            alert('请填写企业名称，否则无法保存信息');
        }
    }
    //改变选择,如果选了否就不能在后面进行填写
    function changeType(obj){
        var objTd = obj.parentNode;
        if(obj.value == '否'){
            objTd.getElementsByTagName('input')[0].readOnly = true;
        }if(obj.value == '是'){
            objTd.getElementsByTagName('input')[0].readOnly = false;
        }
    }
    //选择案源人
    function select_ayr(){
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
						 document.getElementById("ayr").localStorage.ayr_name;
						 
						localStorage.clear();
					}else{
						document.getElementById("ayr").value = '';
						alert("未选中案源人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
    }
    //财务相关计算
    function CountA(obj){
        var objTd = obj.parentNode;
        var objTr = objTd.parentNode;
        var FareNum = objTr.getElementsByTagName('input');
        var NumAll = FareNum[1].value;//总资产
        var NumNeg = FareNum[3].value;//负债
        //计算净资产
        if(NumAll.length && NumNeg.length){
            var NumTre = parseFloat(NumAll)-parseFloat(NumNeg);
            FareNum[5].value = NumTre;
        }
        //计算年度资产负债率
        var PercentF = 0 ? "0%" : (Math.round(NumNeg / NumAll * 10000) / 100.00 );
        FareNum[9].value = PercentF;
    }
    //计算职工相关比
    function GetPercent(objId) {
        var PeoNumA = document.getElementById("PeoNumA").value;
        var PeoNumB = document.getElementById("PeoNumB").value;
        var PeoNumC = document.getElementById("PeoNumC").value;
        if(objId == 'All'){
            if(PeoNumA.length){
                GetPercent('PeoNumA');
            }
            if(PeoNumB.length){
                GetPercent('PeoNumB');
            }
            if(PeoNumC.length){
                GetPercent('PeoNumC');
            }
        }else{
            var NumPeoAll = document.getElementById("NumPeoAll").value;
            var PeoNum = document.getElementById(objId).value;
            if(NumPeoAll.length && PeoNum.length){
                PeoNum = parseFloat(PeoNum);
                NumPeoAll = parseFloat(NumPeoAll);
                var Percent = 0 ? "0%" : (Math.round(PeoNum / NumPeoAll * 10000) / 100.00 );
                var target = document.getElementsByClassName(objId);
                target[0].value = Percent;
            }
            
        }
    }

//删除行
function DelRow(Obj){
//  alert(Obj.innerHTML);
    var ObjTd = Obj.parentNode;
    var ObjTr = ObjTd.parentNode;
    var ObjTab = ObjTr.parentNode;
    var ObjRow = ObjTr.rowIndex;
    ObjTab.deleteRow(ObjRow);
}

//打开上传文件界面
function Openwin_Uploadfile(data_0){
	var myurl = "../upfile_cms.php"+"?data_0="+data_0;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open(myurl,"_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			parent.location.reload();
		}
	},1);	
}

//企业信息详情的文件删除--没有删除服务器的文件
function Delete_file(btn_obj,file_id){
	if(confirm("是否确认删除记录？")){
		$.ajax({
			type:"get",
			url:"CaseSave.php",
			async:true,
			data:{
				falg:"Delete_file",
				file_id:file_id
			},
			success:function(data){
				alert(data);
				if(data == "删除成功"){
					$(btn_obj).parents("tr").remove();
				}
			},
			error:function(x,s,t){
				console.log("ajax error!"+s+t);
				alert("删除失败 a");
			}
		});
	}
}
