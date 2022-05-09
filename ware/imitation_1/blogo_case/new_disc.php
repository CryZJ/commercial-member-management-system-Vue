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

  <title>新建申请类委托书</title>

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
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
				<!--用于输出测试-->
				<!--<input type="text" id="error" value="" />-->
				<!--处理人-->
				<input hidden="hidden" type="text" id="clrnow" value="<?php echo $name; ?>" />
				<strong>商标代理委托书</strong>
                    <span class="tools pull-right">
                        <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
                    </span>
	            </header>
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	            <input style="width: 100px;" class="btn btn-primary" type="button" value="选择委托人" onclick="select_WTP()" />
	            <input style="width: 100px;" class="btn btn-primary" type="button" value="选择联系人" onclick="select_ConOP()" />
	                <br />
	                <br />
	                <div style="width:90%;" >
	                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                	<span id="mes" >
	                		<strong>
	                			<input name="Mes" hidden="hidden" type="text" readonly="readonly" />
	                			委托人
	                			<input name="Mes" style="width: 400px;" type="text" readonly="readonly" />
	                			是
	                			<input name="Mes" type="text" />
	                			国国籍、依
	                			<input name="Mes" type="text" />
	                			国法律组成，现委托
	                			<input name="Mes" style="width: 300px;" type="text" value="" id="DLO" />
	                			代理
	                			<input name="Mes" style="width: 300px;" type="text" id="BLN" />
	                			商标的如下事宜。
	                		</strong>
	                	</span>  
	                </div>
	                <br />
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <tr>
			        		<td><input name="check" type="checkbox" id="商标注册申请" /></td>
			        		<td style="widtd:40%">商标注册申请</td>
							<td><input name="check" type="checkbox" id="撤销连续三年不使用商标提供证据" /></td>
							<td style="widtd:40%">撤销连续三年不使用商标提供证据</td>
			       		</tr>
	                	<tr>
			        		<td><input name="check" type="checkbox" id="商标异议申请"/></td>
			        		<td style="widtd:40%">商标异议申请</td>
							<td><input name="check" type="checkbox" id="撤销成为商品/服务通用名称注册商标答辩" /></td>
							<td style="widtd:40%">撤销成为商品/服务通用名称注册商标答辩</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标异议答辩" /></td>
			        		<td style="widtd:40%">商标异议答辩</td>
							<td><input name="check" type="checkbox" id="补发变更/转让/续展证明申请" /></td>
							<td style="widtd:40%">补发变更/转让/续展证明申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="更正商标申请/注册事项申请" /></td>
			        		<td style="widtd:40%">更正商标申请/注册事项申请</td>
							<td><input name="check" type="checkbox" id="补发商标注册证申请" /></td>
							<td style="widtd:40%">补发商标注册证申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="变更商标申请人/注册人名义/地址 变更集体商标/证明商标管理规则/集体成员名单申请" /></td>
			        		<td style="widtd:40%">变更商标申请人/注册人名义/地址 变更集体商标/证明商标管理规则/集体成员名单申请</td>
							<td><input name="check" type="checkbox" id="出具商标注册证明申请" /></td>
							<td style="widtd:40%">出具商标注册证明申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="变更商标代理人/文件接收人申请" /></td>
			        		<td style="widtd:40%">变更商标代理人/文件接收人申请</td>
							<td><input name="check" type="checkbox" id="出具优先权证明文件申请" /></td>
							<td style="widtd:40%">出具优先权证明文件申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="删除商品/服务项目申请" /></td>
			        		<td style="widtd:40%">删除商品/服务项目申请</td>
							<td><input name="check" type="checkbox" id="撤回商标注册申请" /></td>
							<td style="widtd:40%">撤回商标注册申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标续展注册申请" /></td>
			        		<td style="widtd:40%">商标续展注册申请</td>
							<td><input name="check" type="checkbox" id="撤回商标异议申请" /></td>
							<td style="widtd:40%">撤回商标异议申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="转让/转移申请/注册商标申请书" /></td>
			        		<td style="widtd:40%">转让/转移申请/注册商标申请书</td>
							<td><input name="check" type="checkbox" id="撤回变更商标申请人/注册人名义/地址  变更集体商标/证明商标管理规则/集体成员名单申请" /></td>
							<td style="widtd:40%">撤回变更商标申请人/注册人名义/地址  变更集体商标/证明商标管理规则/集体成员名单申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标使用许可备案" /></td>
			        		<td style="widtd:40%">商标使用许可备案</td>
							<td><input name="check" type="checkbox" id="撤回变更商标代理人/文件接收人申请" /></td>
							<td style="widtd:40%">撤回变更商标代理人/文件接收人申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="变更许可人/被许可人名称备案" /></td>
			        		<td style="widtd:40%">变更许可人/被许可人名称备案</td>
							<td><input name="check" type="checkbox" id="撤回删减商品/服务项目申请" /></td>
							<td style="widtd:40%">撤回删减商品/服务项目申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标使用许可提前终止备案" /></td>
			        		<td style="widtd:40%">商标使用许可提前终止备案</td>
							<td><input name="check" type="checkbox" id="撤回商标续展注册申请" /></td>
							<td style="widtd:40%">撤回商标续展注册申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标专用权质权登记申请" /></td>
			        		<td style="widtd:40%">商标专用权质权登记申请</td>
							<td><input name="check" type="checkbox" id="撤回转让/转移申请/注册商标申请" /></td>
							<td style="widtd:40%">撤回转让/转移申请/注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标专用权质权登记期限变更申请" /></td>
			        		<td style="widtd:40%">商标专用权质权登记期限变更申请</td>
							<td><input name="check" type="checkbox" id="撤回商标志使用许可备案" /></td>
							<td style="widtd:40%">撤回商标志使用许可备案</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标专用权质权登记期限延期申请" /></td>
			        		<td style="widtd:40%">商标专用权质权登记期限延期申请</td>
							<td><input name="check" type="checkbox" id="撤回商标注销申请" /></td>
							<td style="widtd:40%">撤回商标注销申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标专用权质权登记证补发申请" /></td>
			        		<td style="widtd:40%">商标专用权质权登记证补发申请</td>
							<td><input name="check" type="checkbox" id="撤回撤销连续三年不使用注册商标申请" /></td>
							<td style="widtd:40%">撤回撤销连续三年不使用注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标专用权质权登记注销申请" /></td>
			        		<td style="widtd:40%">商标专用权质权登记注销申请</td>
							<td><input name="check" type="checkbox" id="撤回撤销成为商品/服务通用名称注册商标申请" /></td>
							<td style="widtd:40%">撤回撤销成为商品/服务通用名称注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="商标注销申请" /></td>
			        		<td style="widtd:40%">商标注销申请</td>
							<td><input name="check" type="checkbox" id="" /></td>
							<td style="widtd:40%">其他<input id="ElseM" style="width: 400px;border-right-style:none ;border-top-style:none ;border-left-style:none ;border-bottom-style:solid ;" type="text" /> </td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" id="撤销连续三年不使用注册商标申请" /></td>
			        		<td style="widtd:40%">撤销连续三年不使用注册商标申请</td>
			       		</tr>
			       		<tr>
			       			<td><input name="check" type="checkbox" id="撤销成为商品/服务通用名称注册商标申请" /></td>
							<td style="widtd:40%">撤销成为商品/服务通用名称注册商标申请</td>
			       		</tr>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabinfo">
		                <tr>
			        		<th>委托人地址</th>
							<th><input placeholder="请选择正确的地址" style="width: 700px;" name="info" type="text" list="sqr_address" /><datalist id="sqr_address"></datalist></th>
			       		</tr>
			       		<tr>
			        		<th>联系人</th>
							<th><input name="info" type="text" value="" /></th>
			       		</tr>
			       		<tr>
			        		<th>电话</th>
							<th><input name="info" type="text" value="" /></th>
			       		</tr>
			       		<tr>
			        		<th>邮政编码</th>
							<th><input name="info" type="text" value="" /></th>
			       		</tr>
	                </table>
	                <!--操作员-->
	                <input id="czr" value="<?php echo $name; ?>" hidden="hidden" />
	                <!--联系人电话-->
	                <input id="dlrfax" value="" hidden="hidden" />
	                <input id="caseid" value="" hidden="hidden" />
	                
	                <!--<br />-->
	                <div align="center" >
	                	<input class="btn btn-success" type="button" value="提交信息" id="CSave" onclick="savemes_wts()" />
	           	<input class="btn btn-primary" type="button" value="导出&打印" id="MesOut" onclick="mesout()" />
	           	<input class="btn btn-warning" type="button" value="返回" id="PageBack" />
	                </div>
		</section>
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
		<!--委托书-->
<script src="../../../js/imitation_1/zl_sb.js"></script>

<script type="text/javascript">
//	style="BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: solid"
	//输入框显示
	$(document).ready(function(){
		$('#mes input').css('border-top-style','none');
		$('#mes input').css('border-left-style','none');
		$('#mes input').css('border-right-style','none');
		$('#mes input').css('border-bottom-style','solid');
	})
	//委托书信息保存
	function savemes_wts(){
		var BName = document.getElementById('BLN').value;
		if (BName.length == 0) {
			alert('商标名为必填，请确认后填写');
		} else{
//			var SBtn = document.getElementById('CSave');//保存按钮
//			SBtn.onclick = null;
			
			var BaseM = document.getElementById('mes');//获取第一个信息框
			var LastM = document.getElementById('tabinfo');//最后一个信息区域
			var FrontM = '';
			var Input = document.getElementsByName('Mes');
			for(var i=0;i<Input.length;i++){
				FrontM = FrontM+'|'+Input[i].value;
			}
			FrontM = FrontM.substr(1,FrontM.length);
			var CheMe = document.getElementsByName('check');//获取check框
			var CMess = '';
			var CMess_value = '';
			var j=0;
			for(var i=0;i<CheMe.length;i++){
				if(CheMe[i].checked == 1){
					CMess = CMess+','+i;
					CMess_value = CheMe[i].id;
					j++;
				}
			}
			if(j == 1){
				CMess = CMess.substr(1,CMess.length);
				var ElseMes = document.getElementById('ElseM').value;//获取其他信息
				if(CMess == "35"){
					CMess_value = ElseMes;
				}
				CMess = CMess+'|'+CMess_value+'|'+ElseMes;
				var LastInput = '';
				var LastM = document.getElementsByName('info');
				for(var i=0;i<LastM.length;i++){
					LastInput = LastInput+'|'+LastM[i].value;
				}
				LastInput = LastInput.substr(1,LastInput.length);
				var Coner = document.getElementById('czr').value;//获取操作员信息
				var dlrfax = document.getElementById('dlrfax').value;//获取操作员信息
				
				$.ajax({
					url:'blogo_action.php',
					type:'get',
					async:true,
					data:{
						FrM:FrontM,
						CMe:CMess,
						LIn:LastInput,
						Coner:Coner,
						dlrfax:dlrfax,
						flag:'RePSave'
					},
					success:function(data){
						if(data){
							var che = confirm('委托书保存成功，导出打印委托书？');
							if(che == true){
								document.getElementById('CSave'). disabled=true;
								document.getElementById('caseid').value = data;
							}else{
								self.location = 'blogo.php';
							}
						}else{
							alert('委托书保存失败，请联系管理员！');
						}
					}
				})
			}else{
				alert("必须勾选且只能勾选一项");
			}
				
		}
	}
	
	//信息打印
	function mesout(){
		var caseid = document.getElementById('caseid').value;//获取委托书id
		if (caseid.length == 0) {
			alert('请先填写并保存委托书');
		} else{
//			window.open("../../../TCPDF/my_examples/pdf_tow.php");
			var my_url = "../../../TCPDF/my_examples/pdf_tow.php?caseid="+caseid;
			window.open(my_url,"_blank");
		}
	}
	//按键返回
	var PageBack = document.getElementById("PageBack");
	PageBack.addEventListener('click',function(){
		self.location = 'blogo.php';
//		window.close();
	})
	
</script>

</body>
</html>