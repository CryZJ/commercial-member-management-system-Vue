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

  <title>企业信息采集-详情</title>

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
	    <header class="panel-heading custom-tab">
	        <span class="tools pull-right">
                <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
            </span>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#about-1" data-toggle="tab">企业信息</a></li>
                <li class=""><a href="#about-2" data-toggle="tab">企业文件</a></li>
            </ul>
        </header>
	  	<?php 
	  	    $CId = $_GET['Cid'];
	  	    require'../../../conn.php';
            $sql_Sel = "select * from 企业信息 where 状态=0 and id = ".$CId."";
            $result_Sel = $conn->query($sql_Sel);
            if($result_Sel->num_rows>0){
                while($row_Sel = $result_Sel->fetch_assoc()){
                    $CTab1Mes0 = $row_Sel['企业名称'];
                    $CTab1Mes1 = $row_Sel['成立时间'];
                    $CTab1Mes2 = $row_Sel['企业类型'];
                    $CTab1Mes3 = $row_Sel['查账征收'];
                    $CTab1Mes4 = $row_Sel['主要营业'];
                    $CTab1Mes5 = $row_Sel['所属领域'];
                    $CTab1Mes6 = $row_Sel['注册资产'];
                    
                    $CTab2Mes1 = $row_Sel['发明'];
                    $CTab2Mes2 = $row_Sel['实用'];
                    $CTab2Mes3 = $row_Sel['外观'];
                    $CTab2Mes4 = $row_Sel['软件'];
                    $CTab2Mes5 = $row_Sel['植物'];
                    $CTab2Mes6 = $row_Sel['集成'];
                    
                    $CTab3Mes0 = $row_Sel['员工总数'];
                    $CTab3Mes1 = $row_Sel['个税申报'];
                    $CTab3Mes2 = $row_Sel['社保人数'];
                    $CTab3Mes3 = $row_Sel['社保比例'];
                    $CTab3Mes4 = $row_Sel['大专人数'];
                    $CTab3Mes5 = $row_Sel['大专比例'];
                    $CTab3Mes6 = $row_Sel['本科人数'];
                    $CTab3Mes7 = $row_Sel['本科比例'];
                    
                    $CTab5Mes0 = $row_Sel['研发中心'];
                    $CTab5Mes1 = $row_Sel['高校合作'];
                    $CTab5Mes2 = $row_Sel['规范制定'];
                    $CTab5Mes3 = $row_Sel['委员工作'];
                    $CTab5Mes4 = $row_Sel['研究项目'];
                    
                    $CTab6Mes0 = $row_Sel['技术改造'];
                    $CTab6Mes1 = $row_Sel['设备总额'];
                    
                    $CBz = $row_Sel['备注'];
                    $CAyr = $row_Sel['案源人'];
                } 
            }
	  	?>
	  	<span id="Cid" hidden="hidden"><?php echo $CId; ?></span>
	  	<div class="panel-body" style="width: 98%;overflow: auto;solid #000000">
	  		<div class="tab-content">
	  			<!--企业信息 start-->
			  	<div class="tab-pane active" id="about-1">
			  		<section>
						<label>案源人：<?php echo $CAyr; ?><input id="ayr" hidden="hidden" value="<?php echo $CAyr; ?>"></label>
						<br />
						<p><strong>企业基本情况</strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab1">
			                <tr>
		                		<th>企业名称</th>
		                		<th>成立时间</th>
								<th>企业类型</th>
								<th>查账征收</th>
								<th>主要营业</th>
								<th>所属技术领域</th>
								<th>注册资产</th>
			                </tr>
			                <tr align="center">
			                	<td><input style="width: 90%;" class="TabMes_1" type="text" name="" id="ClientName" value="<?php echo $CTab1Mes0; ?>" /></td>
			                	<td><input type="date" class="TabMes_1" name="" style="height: 26px;" value="<?php echo $CTab1Mes1; ?>" /></td>
			                	<td><select class="TabMes_1">
			                		<option><?php echo $CTab1Mes2; ?></option>
			                		<option>外资</option>
			                		<option>合资</option>
			                		<option>内资</option>
			                	</select></td>
			                	<td><select class="TabMes_1">
			                		<option><?php echo $CTab1Mes3; ?></option>
			                		<option>是</option>
			                		<option>否</option>
			                	</select></td>
			                	<td><input style="width: 90%;" type="text" id="" class="TabMes_1" value="<?php echo $CTab1Mes4; ?>"/></td>
			                	<td><select class="TabMes_1">
			                		<option><?php echo $CTab1Mes5; ?></option>
			                		<option>电子信息</option>
			                		<option>生物与新医药</option>
			                		<option>航空航天</option>
			                		<option>新材料</option>
			                		<option>高技术服务</option>
			                		<option>新能源与节能</option>
			                		<option>资源与环境</option>
			                		<option>先进制造与自动化</option>
			                		<option>其他</option>
			                	</select></td>
			                	<td><input type="text" class="TabMes_1" value="<?php echo $CTab1Mes6;?>" /></td>
			                </tr>
			            </table>
			            <p><strong>近三年的自主知识产权数量</strong></p>
			            <table class="table table-bordered table-striped table-condensed" id="tab2">
			                <tr>
		                		<th>发明专利</th>
								<th>实用新型</th>
								<th>外观设计</th>
								<th>软件著作</th>
								<th>植物新品</th>
								<th>集成电路</th>
			                </tr>
			                <tr align="center">
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes1; ?>"/></td>
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes2; ?>"/></td>
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes3; ?>"/></td>
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes4; ?>"/></td>
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes5; ?>"/></td>
			                	<td><input style="width: 80px;" class="TabMes_2" type="text" id="" value="<?php echo $CTab2Mes6; ?>"/></td>
			                </tr>
			            </table>
			            <p><strong>人力资源情况</strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab3">
			                <tr>
		                		<th>职工总数</th>
		                		<th><input type="text" class="TabMes_3" value="<?php echo $CTab3Mes0; ?>" /></th>
		                		<th>个税申报人数</th>
		                		<th><input type="text" class="TabMes_3" value="<?php echo $CTab3Mes1; ?>" /></th>
		                		<th colspan="2"></th>
		                		<!--<th>个税申报比例</th>-->
			                </tr>
			                <tr>
		                		<th colspan="2">买社保人员及占职工总数比例</th>
								<th colspan="2">大专以上学历人员数及占职工总数比例</th>
								<th colspan="2">本科及以上学历或中高级工程师及占职工总数比例</th>
			                </tr>
			                <tr align="center">
			                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id="PeoNumA" value="<?php echo $CTab3Mes2; ?>" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
			                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumA" type="text" id="" value="<?php echo $CTab3Mes3; ?>" readonly="readonly"/>%</td>
			                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id="PeoNumB" value="<?php echo $CTab3Mes4; ?>" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
			                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumB" type="text" id="" value="<?php echo $CTab3Mes5; ?>" readonly="readonly"/>%</td>
			                	<td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id=" PeoNumC" value="<?php echo $CTab3Mes6; ?>" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
			                	<td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumC" type="text" id="" value="<?php echo $CTab3Mes7; ?>" readonly="readonly"/>%</td>
			                </tr>
			            </table>
			            <p><strong>财务情况</strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab4">
			                <tr>
		                		<th>年度</th>
		                		<th>总资产【万元】</th>
								<th>固定资产【万元】</th>
								<th>总负债【万元】</th>
								<th>总销售【万元】</th>
								<th>净资产【万元】</th>
								<th>研发费投入【万元】</th>
								<th>纳税总额【万元】</th>
								<th>企业所得税【万元】</th>
								<th>年度资产负债率</th>
								<th>操作</th>
			                </tr>
			                <tr hidden="hidden">
		                        <td><input style="width: 50px;" class="TabMes_4" type="text" id="" value=""  readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/></td>
		                        <td><input style="width: 120px;" type="text" id="" value="" readonly="readonly"/>%</td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
			                    $sql_Fare = "select * from 企业财务 where 企业id='".$CId."' order by 年度 asc";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row = $result->fetch_assoc()){
		                                $CFMes0 = $row['年度'];
		                                $CFMes1 = $row['总资产'];
		                                $CFMes2 = $row['固定资产'];
		                                $CFMes3 = $row['总负债'];
		                                $CFMes4 = $row['总销售'];
		                                $CFMes5 = $row['净资产'];
		                                $CFMes6 = $row['研发经费'];
		                                $CFMes7 = $row['纳税总额'];
		                                $CFMes8 = $row['企业得税'];
		                                $CFMes9 = $row['年度负率'];
		                                ?>
		                                <tr>
		            	                	<td><input style="width: 50px;" class="TabMes_4" type="text" id="" value="<?php echo $CFMes0;?>"  readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes1;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes2;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes3;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes4;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes5;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes6;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes7;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes8;?>" readonly="readonly"/></td>
		            	                	<td><input style="width: 120px;" type="text" id="" value="<?php echo $CFMes9;?>" readonly="readonly"/>%</td>
		            	                	<td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		            	                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
			                ?>
			                <tr>
			                	<th colspan="15" class="AddRow" onclick="AddRow('FareMes',this)">+</th>
			                </tr>
			            </table>
			            <p><strong>企业资质情况</strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab5">
			                <tr>
		                		<td colspan="2"><strong>一、企业研发中心情况</strong></td>
		                		<td colspan="2"><strong>二、标准化情况</strong></td>
			                </tr>
			                <tr align="center">
			                	<th>研发中心 &nbsp;&nbsp;&nbsp;
			                		<select class="TabMes_5">
			                		<option><?php echo $CTab5Mes0; ?></option>
			                		<option>无</option>
		                            <option>内地</option>
		                            <option>外批</option>
			                	</select></th>
			                	<th>高校合作 &nbsp;&nbsp;&nbsp;
			                		<select class="TabMes_5">
			                		<option><?php echo $CTab5Mes1; ?></option>
			                		<option>有</option>
		                            <option>无</option>
			                	</select></th>
			                	<th colspan="2">主导标准 &nbsp;&nbsp;&nbsp;
			                	    <select class="TabMes_5">
			                		<option><?php echo $CTab5Mes2; ?></option>
			                		<option>地方标准</option>
		                            <option>行业标准</option>
		                            <option>国家标准</option>
		                            <option>国际标准</option>
			                	</select></th>
			                </tr>
			                <tr class="ProMes">
			                	<td colspan="4"><strong>三、各级政府立项情况</strong></td>
			                </tr>
			                <tr>
			                	<th>级别</th>
			                	<th>时间</th>
			                	<th>项目名称</th>
			                	<th>操作</th>
			                </tr>
			                <tr hidden="hidden">
		                        <td><select class="ProList ProMes">
		                            <option></option>
		                            <option>国家级</option>
		                            <option>省级</option>
		                            <option>市级</option>
		                            <option>区级</option>
		                        </select></td>
		                        <td><input type="date" id="" style="height: 26px;" class="ProMes" value=""/></td>
		                        <td><input style="width: 98%;" class="ProMes" type="text" id="" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业项目 where 企业id='".$CId."' and 类型 = '政府' and 状态=0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPMes0 = $row['级别'];
		                                $CPMes1 = $row['时间'];
		                                $CPMes2 = $row['名称'];
		                                ?>
		                                <tr>
		                                    <td><select class="ProList ProMes">
		                                        <option><?php echo $CPMes0; ?></option>
		                                        <option>国家级</option>
		                                        <option>省级</option>
		                                        <option>市级</option>
		                                        <option>区级</option>
		                                    </select></td>
		                                    <td><input type="date" id="" style="height: 26px;" class="ProMes" value="<?php echo $CPMes1; ?>"/></td>
		                                    <td><input style="width: 98%;" class="ProMes" type="text" id="" value="<?php echo $CPMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="4" class="AddRow" onclick="AddRow('ProMes',this)">+</th>
			                </tr>
			                <tr>
			                	<td colspan="4"><strong>四、其他资质证书</strong></td>
			                </tr>
			                <tr class="ZSMes">
			                	<th>时间</th>
			                	<th colspan="2">项目名称</th>
			                	<th>操作</th>
			                </tr>
			                <tr hidden="hidden">
		                        <td><input type="date" class="ZSMes ZS" id="" style="height: 26px;" value=""/></td>
		                        <td colspan="2"><input style="width: 98%;" class="ZS" type="text" id="" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业项目 where 企业id='".$CId."' and 类型 = '其他' and 状态=0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPMes1 = $row['时间'];
		                                $CPMes2 = $row['名称'];
		                                ?>
		                                <tr>
		                                    <td><input type="date" class="ZSMes ZS" id="" style="height: 26px;" value="<?php echo $CPMes1; ?>"/></td>
		                                    <td colspan="2"><input style="width: 98%;" class="ZS" type="text" id="" value="<?php echo $CPMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="4" class="AddRow" onclick="AddRow('ZSMes',this)">+</th>
			                </tr>
			            </table>
			            <p><strong>其他情况<sub style="color: red;"></strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab6">
			                <tr>
		                		<th style="width:300px ;">技术改造</th>
								<th><select class="TabMes_6">
			                		<option><?php echo $CTab6Mes0; ?></option>
			                		<option>无计划</option>
		                            <option>有计划</option>
		                            <option>进行中</option>
			                	</select>
			                	<th style="width:300px ;">计划设备总额【万元】</th>
			                	<th><input type="text" style="width: 85%;" class="TabMes_6" value="<?php echo $CTab6Mes1; ?>" /></th>
			                </tr>
			            </table>
			            <p><strong>联系人</strong></p>
						<table class="table table-bordered table-striped table-condensed" id="tab7">
							<tr>
			                	<th>姓名</th>
			                	<th>联系方式</th>
			                	<th>操作</th>
			                </tr>
			                <tr class="PeoInLow">
		                		<td colspan="3"><strong>一、法人代表</strong></td>
			                </tr>
			                <tr>
		                       <td><input type="text" class="PeoInLow" id="" value=""/></td>
		                        <td><input type="text" id="" style="width: 80%;" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业联系人 where 企业id='".$CId."' and 人员类型 = 0 and 状态 = 0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPeoMes1 = $row['姓名'];
		                                $CPeoMes2 = $row['联系方式'];
		                                ?>
		                                <tr>
		                                   <td><input type="text" class="PeoInLow" id="" value="<?php echo $CPeoMes1; ?>"/></td>
		                                    <td><input type="text" id="" style="width: 80%;" value="<?php echo $CPeoMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="3" class="AddRow" onclick="AddRow('PeoInLow',this)">+</th>
			                </tr>
			                <tr class="FareCount">
			                	<td colspan="3"><strong>二、财务管理员</strong></td>
			                </tr>
			                <tr>
		                        <td><input type="text" class="FareCount" id="" value=""/></td>
		                        <td><input type="text" id="" style="width: 80%;" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业联系人 where 企业id='".$CId."' and 人员类型 = 1 and 状态 = 0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPeoMes1 = $row['姓名'];
		                                $CPeoMes2 = $row['联系方式'];
		                                ?>
		                                <tr>
		                                    <td><input type="text" class="FareCount" id="" value="<?php echo $CPeoMes1; ?>"/></td>
		                                    <td><input type="text" id="" style="width: 80%;" value="<?php echo $CPeoMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="3" class="AddRow" onclick="AddRow('FareCount',this)">+</th>
			                </tr>
			                <tr class="TecPeo">
			                	<td colspan="3"><strong>三、技术管理员</strong></td>
			                </tr>
			                <tr>
		                        <td><input type="text" class="TecPeo" id="" value=""/></td>
		                        <td><input type="text" id="" style="width: 80%;" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业联系人 where 企业id='".$CId."' and 人员类型 = 2 and 状态 = 0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPeoMes1 = $row['姓名'];
		                                $CPeoMes2 = $row['联系方式'];
		                                ?>
		                                <tr>
		                                    <td><input type="text" class="TecPeo" id="" value="<?php echo $CPeoMes1; ?>"/></td>
		                                    <td><input type="text" id="" style="width: 80%;" value="<?php echo $CPeoMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="3" class="AddRow" onclick="AddRow('TecPeo',this)">+</th>
			                </tr>
			                <tr class="LifeCon">
			                	<th colspan="3"><strong>四、日常联系人</strong></th>
			                </tr>
			                <tr>
		                        <td><input type="text" class="LifeCon" id="" value=""/></td>
		                        <td><input type="text" id="" style="width: 80%;" value=""/></td>
		                        <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                    </tr>
			                <?php
		                        $sql_Fare = "select * from 企业联系人 where 企业id='".$CId."' and 人员类型 = 3 and 状态 = 0";
		                        $result = $conn->query($sql_Fare);
		                        if($result->num_rows>0){
		                            while($row=$result->fetch_assoc()){
		                                $CPeoMes1 = $row['姓名'];
		                                $CPeoMes2 = $row['联系方式'];
		                                ?>
		                                <tr>
		                                    <td><input type="text" class="LifeCon" id="" value="<?php echo $CPeoMes1; ?>"/></td>
		                                    <td><input type="text" id="" style="width: 80%;" value="<?php echo $CPeoMes2; ?>"/></td>
		                                    <td><button class="delRow" onclick="DelRow(this)">删除</button></td>
		                                </tr>
		                                <?php
		                            }
		                        }
		                        else{
		                            ?>
		                            <tr>
		                                <th colspan="12">暂无数据</th>
		                            </tr>
		                            <?php
		                        }
		                    ?>
			                <tr>
			                	<th colspan="3" class="AddRow" onclick="AddRow('LifeCon',this)">+</th>
			                </tr>
			            </table>
			            <label>企业信息备注：</label>
			            <p><textarea cols="100" rows="5" id="case_bz" ><?php echo $CBz; ?></textarea></p>
			            <!--</div>-->
			            	<div align="center">
			            		<button class="btn btn-primary" type="button" onclick="ChangeMes()">保存修改</button>
			            	</div>
			            <br />
			        </section>
			    </div>
		        <!--企业信息 end-->
		        <!--企业文件 start-->
		        <div class="tab-pane" id="about-2">
		          <section>
		                <div class="panel-body">
		                    <div class="adv-table">
	                    		<button class="btn btn-primary" onclick="Openwin_Uploadfile('<?php echo $CId; ?>')" >上传文件</button>
	                    		<br /><br />
	                        	<table class="table table-bordered table-striped table-condensed">
		                        	<thead>
		                        		<th>文件名称</th>
		                        		<th>上传时间</th>
		                        		<th>上传人</th>
		                        		<th>操作</th>
		                        	</thead>
		                        	<tbody id="file_tbody">
		                        		<?php 
		                        			$sql = "SELECT id,文件路径,上传时间,上传人 FROM 企业文件 WHERE 删除状态='0' AND 企业id='".$CId."'";
											$result = $conn->query($sql);
											if($result->num_rows>0){
												while($row=$result->fetch_assoc()){
													$path_arr = explode("/", $row["文件路径"]);
										?>
										<tr>
											<td><?php echo end($path_arr); ?></td>
											<td><?php echo $row["上传时间"]; ?></td>
											<td><?php echo $row["上传人"]; ?></td>
											<td>
												<a class="btn btn-default" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row["文件路径"]; ?>">下载</a>
										<?php
												if($admin){
										?>
												<button class="btn btn-danger" name="<?php echo $row["id"]; ?>" onclick="Delete_file(this,'<?php echo $row["id"]; ?>')">删除</button>	
										<?php			
												}											
										?>
											</td>
										</tr>			
										<?php			
												}
											}else{
										?>
											<tr>
												<td colspan="4" style="text-align: center;">无数据!</td>
											</tr>
										<?php		
											}	
		                        		?>
		                        	</tbody>
		                        </table>
		                    </div>
		                </div>
		            </section>
		        </div>
				<!--企业文件 end-->
			</div>	
	    </div>
	</section>
	</div>
	</div>
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
<!--响应-->
<script src="../../../js/imitation_1/info_CMS.js"></script>

</body>

</html>