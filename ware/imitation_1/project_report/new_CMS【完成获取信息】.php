<?php 
	require'../../../AHeader.php'; 
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>企业信息采集-新建</title>

  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->
  
	  <style type="text/css">
  	/*上传条的样式*/
	.progress_upload{
		margin-top:1px;
	    width: 200px;
	    height: 20px;
	    margin-bottom: 1px;
	    overflow: hidden;
	    background-color: #f5f5f5;
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	}
	.progress-bar{ 
		background-color: rgb(92, 184, 92);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.14902) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.14902) 50%, rgba(255, 255, 255, 0.14902) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
		box-shadow: rgba(0, 0, 0, 0.14902) 0px -1px 0px 0px inset;
		box-sizing: border-box;
		color: rgb(255, 255, 255);
		display: block;
		float: left; 
		font-size: 12px;
		height: 30px;
		line-height: 20px;
		text-align: center;
		transition-delay: 0s;
		transition-duration: 0.6s;
		transition-property: width;
		transition-timing-function: ease;
		width:266.188px;
	}
  </style>   
  
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			<!--<form action="newcasefile_save_rjaj.php" method="post" enctype="multipart/form-data">-->
			<strong>企业基本资料表</strong>
                <span class="tools pull-right">
	                <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
	            </span>
	  	</header>
	    <div class="panel-body" style="width: 98%;overflow: auto;solid #000000">
				<label>案源人：<input type="text" id="ayr" /></label>
				<br />
				<p><strong>企业基本情况</strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab1">
	                <tr>
                		<th>企业名称</th>
                		<th>成立时间</th>
						<th>企业类型</th>
						<th>是否查账征收</th>
						<th>主要营业(营业执照上)</th>
						<th>所属技术领域</th>
	                </tr>
	                <tr align="center">
	                	<td><input style="width: 90%;" class="TabMes_1" type="text" name="" id="ClientName"/></td>
	                	<td><input type="date" class="TabMes_1" name="" style="height: 26px;" /></td>
	                	<td><select class="TabMes_1">
	                		<option></option>
	                		<option>外资</option>
	                		<option>合资</option>
	                		<option>内资</option>
	                	</select></td>
	                	<td><select class="TabMes_1">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></td>
	                	<td><input style="width: 90%;" class="TabMes_1" type="text" id=""/></td>
	                	<td><select class="TabMes_1">
	                		<option></option>
	                		<option>电子信息</option>
	                		<option>生物与新医药</option>
	                		<option>航空航天</option>
	                		<option>新材料</option>
	                		<option>高技术服务</option>
	                		<option>新能源与节能</option>
	                		<option>资源与环境</option>
	                		<option>先进制造与自动化</option>
	                	</select></td>
	                </tr>
	            </table>
	            <p><strong>近三年的自主知识产权</strong></p>
	            <table class="table table-bordered table-striped table-condensed" id="tab2">
	                <tr>
                		<th colspan="2">发明专利</th>
						<th colspan="2">实用新型</th>
						<th>软件著作</th>
						<th>植物新品</th>
						<th>集成电路</th>
	                </tr>
	                <tr align="center">
	                	<td><strong>授权：</strong><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><strong>未授权：</strong><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><strong>授权：</strong><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><strong>未授权：</strong><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                	<td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
	                </tr>
	            </table>
	            <p><strong>人力资源情况</strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab3">
	                <tr>
                		<th>职工总数</th>
                		<th><input type="text" class="TabMes_3" /></th>
                		<th>个税申报人数</th>
                		<th><input type="text" class="TabMes_3" /></th>
                		<th colspan="2"></th>
                		<!--<th>个税申报比例</th>-->
	                </tr>
	                <tr>
                		<th colspan="2">买社保人员及占职工总数比例</th>
						<th colspan="2">大专以上学历人员数及占职工总数比例</th>
						<th colspan="2">本科及以上学历或中高级工程师及占职工总数比例</th>
	                </tr>
	                <tr align="center">
	                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=""/></td>
	                </tr>
	            </table>
	            <p><strong>财务情况</strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab4">
	                <tr>
                		<th>年度</th>
                		<th>净资产</th>
						<th>总销售</th>
						<th>总资产</th>
						<th>研发费投入</th>
						<th>纳税总额<br/>(纳税总额 &nbsp;/&nbsp;企业所得税)</th>
						<th>年度资产负债率</th>
						<th>固定资产</th>
	                </tr>
	                <tr>
	                	<td><input style="width: 50px;" class="TabMes_4" type="text" id="" /></td>
	                	<td><input style="width: 120px;" type="text" id="" /></td>
	                	<td><input style="width: 120px;" type="text" id=""/></td>
	                	<td><input style="width: 120px;" type="text" id=""/></td>
	                	<td><input style="width: 120px;" type="text" id=""/></td>
	                	<td><input style="width: 120px;" type="text" id=""/>&nbsp;/&nbsp;<input style="width: 120px;" type="text" id=""/></td>
	                	<td><input style="width: 120px;" type="text" id=""/></td>
	                	<td><input style="width: 120px;" type="text" id=""/></td>
	                </tr>
	                <tr>
	                	<th colspan="10" class="AddRow" onclick="AddRow('FareMes',this)">+</th>
	                </tr>
	            </table>
	            <p><strong>企业资质情况</strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab5">
	                <tr>
                		<td colspan="3"><strong>一、企业研发中心情况</strong></td>
	                </tr>
	                <tr align="center">
	                	<th>是否有外部批准成立研发中心 &nbsp;&nbsp;&nbsp;
	                		<select class="TabMes_5">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></th>
	                	<th>是否有与高校合作 &nbsp;&nbsp;&nbsp;
	                		<select class="TabMes_5">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></th>
	                	<th></th>
	                </tr>
	                <tr>
	                	<td colspan="3"><strong>二、标准化情况</strong></td>
	                </tr>
	                	<tr align="center">
	                	<th>是否主导国际标准、国家标准、行业标准、地方标准及广州市技术规范的制修订 <br /><select class="TabMes_5">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></th>
	                	<th>是否负责承担市级以上专业标准化技术委员会或工作组的工作 <br /><select class="TabMes_5">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></th>
	                	<th>是否承担市级以上标准化行政主管部门批准立项的标准化研究项目 <br /><select class="TabMes_5">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select></th>
	                </tr>
	                <tr>
	                	<td colspan="3"><strong>三、各级政府立项情况</strong></td>
	                </tr>
	                <tr>
	                	<th>级别</th>
	                	<th>时间</th>
	                	<th>项目名称</th>
	                </tr>
	                <tr>
	                	<td><select class="ProList ProMes">
	                		<option></option>
	                		<option>国家级</option>
	                		<option>省级</option>
	                		<option>市级</option>
	                		<option>区级</option>
	                	</select></td>
	                	<td><input type="date" id="" style="height: 26px;" class="ProMes"/></td>
	                	<td><input style="width: 98%;" class="ProMes" type="text" id=""/></td>
	                </tr>
	                <tr>
	                	<th colspan="3" class="AddRow" onclick="AddRow('ProMes',this)">+</th>
	                </tr>
	                <tr>
	                	<td colspan="3"><strong>四、其他资质证书</strong></td>
	                </tr>
	                <tr>
	                	<th>时间</th>
	                	<th colspan="2">项目名称</th>
	                </tr>
	                <tr>
	                	<td><input type="date" class="ZSMes ZS" id="" style="height: 26px;"/></td>
	                	<td colspan="2"><input style="width: 98%;" class="ZS" type="text" id=""/></td>
	                </tr>
	                <tr>
	                	<th colspan="3" class="AddRow" onclick="AddRow('ZSMes',this)">+</th>
	                </tr>
	            </table>
	            <p><strong>其他情况<sub style="color: red;"></strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab6">
	                <tr>
                		<th style="width:300px ;">是否有新购置的设备</th>
						<th><select class="TabMes_6" onchange="changeType(this)">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select>
	                	<input type="text" style="width: 85%;" class="TabMes_6" /></th>
	                </tr>
	                <tr>
	                	<th style="width:300px ;">是否有对生产或研发设备进行技术改造</th>
	                	<th><select class="TabMes_6" onchange="changeType(this)">
	                		<option></option>
	                		<option>是</option>
	                		<option>否</option>
	                	</select>
	                	<input type="text" style="width: 85%;" class="TabMes_6" /></th>
	                </tr>
	            </table>
	            <p><strong>联系人</strong></p>
				<table class="table table-bordered table-striped table-condensed" id="tab7">
					<tr>
	                	<th>姓名</th>
	                	<th>联系方式</th>
	                </tr>
	                <tr>
                		<td colspan="2"><strong>一、法人代表</strong></td>
	                </tr>
	                <tr>
	                	<td style="width:20%;"><input type="text" class="PeoInLow" id=""/></td>
	                	<td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
	                </tr>
	                <tr>
	                	<th colspan="2" class="AddRow" onclick="AddRow('PeoInLow',this)">+</th>
	                </tr>
	                <tr>
	                	<td colspan="2"><strong>二、财务管理员</strong></td>
	                </tr>
	                
	                <tr>
	                	<td style="width:20%;"><input type="text" class="FareCount" id=""/></td>
	                	<td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
	                </tr>
	                <tr>
	                	<th colspan="2" class="AddRow" onclick="AddRow('FareCount',this)">+</th>
	                </tr>
	                <tr>
	                	<td colspan="2"><strong>三、技术管理员</strong></td>
	                </tr>
	                <t>
	                	<td style="width:20%;"><input type="text" class="TecPeo" id=""/></td>
	                	<td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
	                </tr>
	                <tr>
	                	<th colspan="2" class="AddRow" onclick="AddRow('TecPeo',this)">+</th>
	                </tr>
	                <tr>
	                	<th colspan="2"><strong>四、日常联系人</strong></th>
	                </tr>
	                <tr>
	                	<td style="width:20%;"><input type="text" class="LifeCon" id=""/></td>
	                	<td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
	                </tr>
	                <tr>
	                	<th colspan="2" class="AddRow" onclick="AddRow('LifeCon',this)">+</th>
	                </tr>
	            </table>
	            <label>企业信息备注：</label>
	            <p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	            </div>
	            	<div align="center">
	            		<button class="btn btn-primary" type="button" onclick="SaveMes()">提交信息</button>
	            	</div>
	            <br />
	        </section>
	       <!--</form>-->
	       </div>
	    </div>
	 </div>
	
	<!--body wrapper end-->

	</div>
	<!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<script src="../../../js/scripts.js"></script>
<!--action-->
<script>
	//鼠标移入移出
	$('.AddRow').mouseover(function(){
		$(this).css("background-color","#E0E1E0");
	});
	$('.AddRow').mouseout(function(){
		$(this).css("background-color","#FFFFFF");
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
                NewRow.insertCell(0).innerHTML = '<input style="width: 50px;" class="TabMes_4" type="text" id="" />';
                NewRow.insertCell(1).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                NewRow.insertCell(2).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                NewRow.insertCell(3).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                NewRow.insertCell(4).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                NewRow.insertCell(5).innerHTML = '<input style="width: 120px;" type="text" id=""/>&nbsp;/&nbsp;<input style="width: 120px;" type="text" id=""/>';
                NewRow.insertCell(6).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                NewRow.insertCell(7).innerHTML = '<input style="width: 120px;" type="text" id="" />';
                break;
            case 'ProMes':
                table = document.getElementById("tab5");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<select class="ProList ProMes"><option></option><option>国家级</option><option>省级</option><option>市级</option><option>区级</option></select>';
                NewRow.insertCell(1).innerHTML = '<input type="date" id="" style="height: 26px;" class="ProMes"/>';
                NewRow.insertCell(2).innerHTML = '<input style="width: 98%;" class="ProMes" type="text" id=""/>';
                break;
            case 'ZSMes':
                table = document.getElementById("tab5");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="date" class="ZSMes ZS" id="" style="height: 26px;"/>';
                NewRow.insertCell(1).innerHTML = '<input style="width: 98%;" class="ZS" type="text" id=""/>';
                NewRow.cells[1].colSpan='2';
//              alert(tanRow);
                break;
            case 'PeoInLow':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="PeoInLow" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                break;
            case 'FareCount':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="FareCount" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                break;
            case 'TecPeo':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="TecPeo" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                break;
            case 'LifeCon':
                table = document.getElementById("tab7");
                var NewRow = table.insertRow(tanRow);
                NewRow.insertCell(0).innerHTML = '<input type="text" class="LifeCon" id=""/>';
                NewRow.insertCell(1).innerHTML = '<input type="text" id="" style="width: 80%;"/>';
                break;
            default:
                alert('出现错误，请联系管理员');
                return;
                break;
        }
	}
	//获取数据
	function SaveMes(){
	    //获取案源人
	    var ayr = document.getElementById("ayr").value;
	    //获取第一个表格的数据
	    var TabMes_1 = '';
	    var TabArr_1 = document.getElementsByClassName("TabMes_1");
	    for (var i=0;i<TabArr_1.length;i++) {
	    	TabMes_1 = TabMes_1+TabArr_1[i].value+'||';
	    }
	    TabMes_1 = TabMes_1.substr(0,TabMes_1.length-2);
//	    alert(TabMes_1);
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
            for(var y=0;y<9;y++){
                fareMes = fareMes + Inpur[y].value+',';
            }
            fareMes = fareMes.substr(0,fareMes.length-1);
            TabMes_4 = TabMes_4+fareMes+'||';
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
            for(var y=0;y<3;y++){
                ProMes = ProMes + Inpur[y].value+',';
            }
            ProMes = ProMes.substr(0,ProMes.length-1);
            ProMesAll = ProMesAll+ProMes+'//';
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
            for(var y=0;y<2;y++){
                ZSListMes = ZSListMes + Inpur[y].value+',';
            }
            ZSListMes = ZSListMes.substr(0,ZSListMes.length-1);
            ZSListMesAll = ZSListMesAll+ZSListMes+'//';
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
            for(var y=0;y<2;y++){
                PeoInLowMes = PeoInLowMes + Inpur[y].value+',';
            }
            PeoInLowMes = PeoInLowMes.substr(0,PeoInLowMes.length-1);
            PeoInLowMesAll = PeoInLowMesAll+PeoInLowMes+'//';
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
            for(var y=0;y<2;y++){
                FareCountMes = FareCountMes + Inpur[y].value+',';
            }
            FareCountMes = FareCountMes.substr(0,FareCountMes.length-1);
            FareCountMesAll = FareCountMesAll+FareCountMes+'//';
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
            for(var y=0;y<2;y++){
                TecPeoMes = TecPeoMes + Inpur[y].value+',';
            }
            TecPeoMes = TecPeoMes.substr(0,TecPeoMes.length-1);
            TecPeoMesAll = TecPeoMesAll+TecPeoMes+'//';
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
            for(var y=0;y<2;y++){
                LifeConMes = LifeConMes + Inpur[y].value+',';
            }
            LifeConMes = LifeConMes.substr(0,LifeConMes.length-1);
            LifeConMesAll = LifeConMesAll+LifeConMes+'//';
        }
        LifeConMesAll = LifeConMesAll.substr(0,LifeConMesAll.length-2);
        TabMes_7 = TabMes_7 +'||'+LifeConMesAll;
//      alert(TabMes_7);
	    //获取企业信息备注
	    var CaseBz = document.getElementById("case_bz").value;
//	    alert(CaseBz);
        
        if(document.getElementById("ClientName").value){
            //异步传输数据
            $.ajax({
                type:"get",
                url:"CaseSave.php",
                async:true,
                data:{
                    falg:'CMS_Save',
                    ayr:ayr,
                    TabMes_1:TabMes_1,
                    TabMes_2:TabMes_2,
                    TabMes_3:TabMes_3,
                    TabMes_4:TabMes_4,
                    TabMes_5:TabMes_5,
                    TabMes_6:TabMes_6,
                    TabMes_7:TabMes_7,
                    CaseBz:CaseBz
                },
                success:function (data){
                    if(confirm(data+",是否继续新建企业信息")){
                        window.location.reload();
                    }else{
                        window.close();
                    }
                },
                error:function (e,t,s){
                    alert(s);
                }
            });
        }else{
            alert('请将企业名称填写完整，否则无法保存信息');
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
</script>

</body>

</html>