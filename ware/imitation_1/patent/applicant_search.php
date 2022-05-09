<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>按申请人统计</title>

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
<?
	$sqr = $_GET['sqr'];
?>
<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				申请人：<? echo $sqr; ?>
				<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
            </header>

            <div class="panel-body">
                <section id="unseen">
                	<table class="table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">筛选项目：</th>
                            <td class="numeric"></td>
                            <th class="numeric">&nbsp;&nbsp;类型：</th>
                            <td class="numeric"><select>
  <option value="#">发明专利</option>
  <option value="#">实用新型</option>
  <option value="#">外观设计</option>
</select></td>
                            <th class="numeric">时间段：</th>
                            <td class="numeric"></td>
                            <td class="numeric"><select>
  <option value="#">时间A</option>
</select></td>
                            <th class="numeric">&nbsp;&nbsp;&nbsp;&nbsp;——</th>
                            <td class="numeric"><select>
  <option value="#">时间B</option>
</select></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="numeric"></td>
                            <td class="numeric"></td>
                            <th class="numeric">案源人：</th>
                            <td class="numeric"><select>
  <option value="#">发明专利</option>
  <option value="#">实用新型</option>
  <option value="#">外观设计</option>
</select></td>
                            <th class="numeric">代理人：</th>
                            <td class="numeric"></td>
                            <td class="numeric"><select>
  <option value="#">时间A</option>
</select></td>
                            <th class="numeric">当前程序：</th>
                            <td class="numeric"><select>
  <option value="#">时间B</option>
</select></td>
                        </tr>
                        </tbody>
                    </table>

                    <div>
                    	<button>批量修改</button>
                    </div>
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="numeric">案号</th>
                            <th class="numeric">类型</th>
                            <th class="numeric">申请号</th>
                            <th class="numeric">申请日</th>
                            <th class="numeric">申请人</th>
                            <th class="numeric">专利名称</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">当前程序</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php
                        		require("../../../conn.php");
                        		$sql="select c.案件序号, c.案卷号,c.类型, c.申请号,c.提交时间, b.申请人, c.专利名称, a.案源人, c.代理人 , c.状态 from 案件信息 a, 案件申请人 b, 专利信息 c where a.案件序号=b.案件序号 and b.案件序号=c.案件序号 and a.案件序号=c.案件序号 and b.申请人='{$sqr}'";
                        		$result = $conn->query($sql);
                        		if($result->num_rows > 0){
                        			while($row = $result->fetch_assoc()){
                        					//echo $row["案卷号"];
                        				//$num_r=implode('',$row['申请人']);
                        				echo "<tr>";
                        					echo "<td><input name=\"Fruit[]\" type=\"checkbox\" value=\"0\"/></td>";
                        					echo "<td class=\"numeric\">".$row["案卷号"]."</td>";
                        					echo "<td class=\"numeric\">".$row['类型']."</td>";
                        					echo "<td class=\"numeric\">".$row['申请号']."</td>";
                        					echo "<td class=\"numeric\">".$row['提交时间']."</td>";
                        					echo "<td class=\"numeric\">".$row['申请人']."</td>";
                        					echo "<td class=\"numeric\">".$row['专利名称']."</td>";
                        					echo "<td class=\"numeric\">".$row['案源人']."</td>";
                        					echo "<td class=\"numeric\">".$row['代理人']."</td>";
                        					echo "<td class=\"numeric\">".$row['状态']."</td>";
                        				echo "</tr>";
                        			}
                        		}
                        		else {
                        			echo ' 此申请人无相关数据或出现数据错误，请联系系统管理员。 ';
                        		}
                        	$conn->close();
                        ?>
                        <!--
							<tr>
                            <td class="numeric"><label><input name="Fruit" type="checkbox" value="" /> </label></td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        -->
                        
                        </tbody>
                    </table>
								</div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        收费记录
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                    </header>
                    <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">日期</th>
                            <th class="numeric">收费方式</th>
                            <th class="numeric">费用名称</th>
                            <th class="numeric">状态</th>
                            <th class="numeric">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        </tbody>
                    </table>
                    <p><strong>已经收总费用: X 元</strong></p>
                </div>
                </section>

        </div>
				            <div class="col-sm-12">
                <section class="panel">
                	<?php
                		require("../../../conn.php");
                		$sql_sqr = "select c.案件序号, c.案卷号,c.类型, c.申请号,c.提交时间, b.申请人, c.专利名称, a.案源人, c.代理人 , c.状态 from 案件信息 a, 案件申请人 b, 专利信息 c where a.案件序号=b.案件序号 and b.案件序号=c.案件序号 and a.案件序号=c.案件序号 and b.申请人='{$sqr}'"
//										$res = mysql_query("select c.案件序号, c.案卷号,c.类型, c.申请号,c.提交时间, b.申请人, c.专利名称, a.案源人, c.代理人 , c.状态 from 案件信息 a, 案件申请人 b, 专利信息 c where a.案件序号=b.案件序号 and b.案件序号=c.案件序号 and a.案件序号=c.案件序号 and b.申请人='{$sqr}'");
//										$nums = mysql_num_rows($res);
                	?>
                    <header class="panel-heading">
                        统计栏：【总计：X件】
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                    </header>
                    <div class="panel-body">
                <div class="space15"></div>
                <table class="table table-striped  " id="editable-sample">
                <thead>
                <tr>
                    <th>发明</th>
                    <th>待提交：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th>#</th>
                    <th>件；</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>实用</th>
                    <th>待提交：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th>#</th>
                    <th>件；</th>
                </tr>
                <tr>
                    <th>外观</th>
                    <th>待提交：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th>#</th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th>#</th>
                    <th>件；</th>
                </tr>
                </tbody>
                </table>
                </div>
                </section>
            </div>
        </div>
        </div>
        <!--body wrapper end-->


        <!--footer section start-->
<!--
	作者：yaolaoxiaotu@163.com
	时间：2017-01-12
	描述：
        <footer>
            2017 &copy; AdminEx by ThemeBucket
        </footer>
-->
        <!--footer section end-->


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

<!--easy pie chart-->
<script src="../../../js/easypiechart/jquery.easypiechart.js"></script>
<script src="../../../js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="../../../js/sparkline/jquery.sparkline.js"></script>
<script src="../../../js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="../../../js/iCheck/jquery.icheck.js"></script>
<script src="../../../js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="../../../js/flot-chart/jquery.flot.js"></script>
<script src="../../../js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="../../../js/flot-chart/jquery.flot.resize.js"></script>
<script src="../../../js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="../../../js/flot-chart/jquery.flot.selection.js"></script>
<script src="../../../js/flot-chart/jquery.flot.stack.js"></script>
<script src="../../../js/flot-chart/jquery.flot.time.js"></script>
<script src="../../../js/main-chart.js"></script>

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>

</body>
</html>