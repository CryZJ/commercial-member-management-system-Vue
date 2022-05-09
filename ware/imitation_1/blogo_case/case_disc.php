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

  <title>商标代理委托书</title>

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
	                <a href="javascript:;" class="fa fa-chevron-down"></a>
	                <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
	            </span>
        </header>
        <?php
        	$id = $_GET['mes'];
        	require'../../../conn.php';
        	$sql = "select * from 商标_委托书 where id = '".$id."'";
        	$result=$conn->query($sql);
        	if($result->num_rows>0){
        		while($row = $result->fetch_assoc()){
        			$REp = $row['委托人'];//委托人
        			$REc = $row['国籍'];//国籍
        			$REl = $row['国法'];//国法
        			$REdl = $row['代理人'];//代理人
        			$RELN = $row['商标名'];//商标名
        			$REelse = $row['委托其他'];//其他
        			$REche = $row['勾选项'];//其他
        			$REadd = $row['委托人地址'];//地址
        			$RElx = $row['联系人'];//联系人
        			$REnum = $row['电话'];//电话
        			$REcode = $row['邮编'];//邮编
        			$REMP = $row['创建人'];//创建人
        			$RET = $row['修改时间'];//创建时间
        		}
        	}
        ?>
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	           	<table style="width: 60%;" >
	           		<tr >
	           			<th>创建人:</th>
	           			<td><?php echo $REMP; ?></td>
	           			<th>创建时间:</th>
	           			<td><?php echo date('Y-m-d',$RET); ?></td>
	           		</tr>
	           	</table>
	            <!--<input class="btn btn-primary" type="button" value="选择委托人" onclick="select_WTP()" />-->
	                <br />
	                <br />
	                <div style="width:90%;" >
	                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                	<span id="mes" ><strong>委托人<input name="Mes" style="width: 400px;" type="text" readonly="readonly" value="<?php echo $REp; ?>" />是<input name="Mes" type="text" value="<?php echo $REc; ?>" />国国籍、依<input name="Mes" type="text" value="<?php echo $REl; ?>" />国法律组成，现委托<input name="Mes" style="width: 300px;" type="text" value="<?php echo $REdl; ?>" />代理<input name="Mes" style="width: 300px;" type="text" value="<?php echo $RELN; ?>" />商标的如下事宜。</strong></span>  
	                </div>
	                <br />
	                <input id="chemes" value="<?php echo $REche; ?>" hidden="hidden" />
	                <table class="table table-striped table-bordered" id="tab">
		                <tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标注册申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤销连续三年不使用商标提供证据</td>
			       		</tr>
	                	<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标异议申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤销成为商品/服务通用名称注册商标答辩</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标异议答辩</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">补发变更/转让/续展证明申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">更正商标申请/注册事项申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">补发商标注册证申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">变更商标申请人/注册人名义/地址 变更集体商标/证明商标管理规则/集体成员名单申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">出具商标注册证明申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">变更商标代理人/文件接收人申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">出具优先权证明文件申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">删除商品/服务项目申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回商标注册申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标续展注册申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回商标异议申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">转让/转移申请/注册商标申请书</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回变更商标申请人/注册人名义/地址  变更集体商标/证明商标管理规则/集体成员名单申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标使用许可备案</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回变更商标代理人/文件接收人申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">变更许可人/被许可人名称备案</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回删减商品/服务项目申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标使用许可提前终止备案</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回商标续展注册申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标专用权质权登记申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回转让/转移申请/注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标专用权质权登记期限变更申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回商标志使用许可备案</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标专用权质权登记期限延期申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回商标注销申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标专用权质权登记证补发申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回撤销连续三年不使用注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标专用权质权登记注销申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤回撤销成为商品/服务通用名称注册商标申请</td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">商标注销申请</td>
							<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">其他<input id="ElseM" style="width: 400px;border-right-style:none ;border-top-style:none ;border-left-style:none ;border-bottom-style:solid ;" type="text" value="<?php echo $REelse; ?>" /> </td>
			       		</tr>
			       		<tr>
			        		<td><input name="check" type="checkbox" /></td>
			        		<td style="widtd:40%">撤销连续三年不使用注册商标申请</td>
			       		</tr>
			       		<tr>
			       			<td><input name="check" type="checkbox" /></td>
							<td style="widtd:40%">撤销成为商品/服务通用名称注册商标申请</td>
			       		</tr>
	                </table>
	                <table class="table table-striped table-bordered" id="tabinfo">
		                <tr>
			        		<th>委托人地址</th>
							<th><input style="width: 700px;" name="info" type="text" value="<?php echo $REadd; ?>" /></th>
			       		</tr>
			       		<tr>
			        		<th>联系人</th>
							<th><input name="info" type="text" value="杜海江" readonly="readonly" value="<?php echo $RElx; ?>" /></th>
			       		</tr>
			       		<tr>
			        		<th>电话</th>
							<th><input name="info" type="text" value="0760-88886258" readonly="readonly" value="<?php echo $REnum; ?>" /></th>
			       		</tr>
			       		<tr>
			        		<th>邮政编码</th>
							<th><input name="info" type="text" value="510620" readonly="readonly" value="<?php echo $REcode; ?>" /></th>
			       		</tr>
	                </table>
	                <input id="czr" value="<?php echo $name; ?>" hidden="hidden" />
	                <input id="caseid" value="<?php echo $id; ?>" hidden="hidden" />
	                <!--<br />-->
	                <div align="center" >
	           	<input class="btn btn-primary" type="button" value="导出&打印" id="MesOut" onclick="mesout()" />
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
	
	$(document).ready(function(){
		//将所有input设为只读
		var aInput = document.getElementsByTagName('input');
		for (var i=0;i<aInput;i++) {
			aInput[i].readOnly = true;
		}
		//输入框显示
		$('#mes input').css('border-top-style','none');
		$('#mes input').css('border-left-style','none');
		$('#mes input').css('border-right-style','none');
		$('#mes input').css('border-bottom-style','solid');
		//信息显示
		var tab = document.getElementById('tab');
		var oInput = tab.getElementsByTagName('input');
		var chemes = document.getElementById('chemes').value;
		chearr = chemes.split(',');
		for (var i=0;i<chearr.length;i++) {
			oInput[chearr[i]].checked = 1;
		}
	})
	
	//信息打印
	function mesout(){
		var caseid = document.getElementById('caseid').value;//获取委托书id
		if (caseid.length == 0) {
			alert('请先填写并保存委托书');
		} else{
			var my_url = "../../../TCPDF/my_examples/pdf_tow.php?caseid="+caseid;
			window.open(my_url,"_blank");
		}
	}
</script>

</body>
</html>