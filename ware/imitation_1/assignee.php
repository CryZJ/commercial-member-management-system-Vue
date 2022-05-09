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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>按代理人统计</title>

  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">


  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">
	<?php
		$dlr = $_GET['dlr'];
	?>

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">

			<header class="panel-heading">
				代理人：<?php echo $dlr; ?>
					<span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
            <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
          </span>
            </header>

            <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed" id="dynamic-table" >
                        <thead>
                        <tr>
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
														require("../../conn.php");
                        	 	$sql="select * from 专利信息 where 代理人='".$dlr."'";
                        		$result=$conn->query($sql);
                        			if($result->num_rows > 0){
                        				while($row=$result->fetch_assoc()){
                           				 echo "<tr >";
					                           echo "<td class='numeric'>".$row["案卷号"]."</td>";
					                           echo "<td class='numeric'>".$row["类型"]."</td>";
					                           echo "<td class='numeric'>".$row["申请号"]."</td>";
					                           echo "<td class='numeric'>".$row["申请日"]."</td>";
					                           echo "<td class='numeric'>".$row["申请人"]."</td>";
					                           echo "<td class='numeric'>".$row["专利名称"]."</td>";
					                           echo "<td class='numeric'>".$row["案源人"]."</td>";
					                           echo "<td class='numeric'>".$row["代理人"]."</td>";
					                           echo "<td class='numeric'>".$row["状态"]."</td>";
                            			echo "</tr>";
                            		}
                      				}
                      		$conn->close();
                        ?>
                        
                        </tbody>
                    </table>
									</div>
                </section>
            </div>
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                    <?php 
                    		require("../../conn.php"); 
                    		$sql1="select count(id) as ID from 专利信息 where 代理人='".$dlr."'";
                    		$result1=$conn->query($sql1);
                    		$row = $result1->fetch_assoc();
                        echo"统计栏：【总计：".$row["ID"]."件】";
                        $conn->close();
                        ?>
                            <span class="tools pull-right">
									            <a href="javascript:;" class="fa fa-chevron-down"></a>
									            <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
									          </span>
                    </header>
                    <div class="panel-body">

                <div class="space15"></div>
                <table class="table table-striped  " id="editable-sample">
                <thead>
                <?php 
                	require("../../conn.php");
	                	$sql2="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='发明专利' and 状态='待提交'";
	                	$sql3="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='发明专利' and 状态='申请'";
	                	$sql4="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='发明专利' and 状态='年费阶段'";
	                	$sql5="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='发明专利' and 状态='无效'";
	                	$result2=$conn->query($sql2);
	                	$result3=$conn->query($sql3);
	                	$result4=$conn->query($sql4);
	                	$result5=$conn->query($sql5);
	                	
	                	$result2=$conn->query($sql2);
											$row2 = $result2->fetch_assoc();
	                  $result3=$conn->query($sql3);
	                  	$row3 = $result3->fetch_assoc();
	                  $result4=$conn->query($sql4);
	                  	$row4 = $result4->fetch_assoc();
	                  $result5=$conn->query($sql5);
	                    $row5 = $result5->fetch_assoc();
			                echo "<tr>";
			                  echo "<th>发明专利</th>
			                    <th>待提交：</th>
			                    <th>".$row2["ID"]."件；</th>";
			                  echo "<th>申请：</th>
			                    <th>".$row3["ID"]."件</th>";
			                   echo "<th>年费阶段：</th>
			                    <th>".$row4["ID"]."件</th>";
			                   echo "<th>无效：</th>
			                    <th>".$row5["ID"]."件</th>";
			                echo"</tr>";
                	$conn->close();
                ?>
                </thead>
                <tbody>
                <?php 
                	require("../../conn.php");
	                	$sql2="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='实用新型' and 状态='待提交'";
	                	$sql3="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='实用新型' and 状态='申请'";
	                	$sql4="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='实用新型' and 状态='年费阶段'";
	                	$sql5="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='实用新型' and 状态='无效'";
	                	$result2=$conn->query($sql2);
	                	$result3=$conn->query($sql3);
	                	$result4=$conn->query($sql4);
	                	$result5=$conn->query($sql5);
	                	
	                	$result2=$conn->query($sql2);
											$row2 = $result2->fetch_assoc();
	                  $result3=$conn->query($sql3);
	                  	$row3 = $result3->fetch_assoc();
	                  $result4=$conn->query($sql4);
	                  	$row4 = $result4->fetch_assoc();
	                  $result5=$conn->query($sql5);
	                    $row5 = $result5->fetch_assoc();
			                echo "<tr>";
			                  echo "<th>实用新型</th>
			                    <th>待提交：</th>
			                    <th>".$row2["ID"]."件；</th>";
			                  echo "<th>申请：</th>
			                    <th>".$row3["ID"]."件</th>";
			                   echo "<th>年费阶段：</th>
			                    <th>".$row4["ID"]."件</th>";
			                   echo "<th>无效：</th>
			                    <th>".$row5["ID"]."件</th>";
			                echo"</tr>";
                	$conn->close();
                ?>
                <?php 
                	require("../../conn.php");
	                	$sql2="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='外观设计' and 状态='待提交'";
	                	$sql3="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='外观设计' and 状态='申请'";
	                	$sql4="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='外观设计' and 状态='年费阶段'";
	                	$sql5="select count(id) as ID from 专利信息 where 代理人='".$dlr."' and 类型='外观设计' and 状态='无效'";
	                	$result2=$conn->query($sql2);
	                	$result3=$conn->query($sql3);
	                	$result4=$conn->query($sql4);
	                	$result5=$conn->query($sql5);
	                	
	                	$result2=$conn->query($sql2);
											$row2 = $result2->fetch_assoc();
	                  $result3=$conn->query($sql3);
	                  	$row3 = $result3->fetch_assoc();
	                  $result4=$conn->query($sql4);
	                  	$row4 = $result4->fetch_assoc();
	                  $result5=$conn->query($sql5);
	                    $row5 = $result5->fetch_assoc();
			                echo "<tr>";
			                  echo "<th>外观设计</th>
			                    <th>待提交：</th>
			                    <th>".$row2["ID"]."件；</th>";
			                  echo "<th>申请：</th>
			                    <th>".$row3["ID"]."件</th>";
			                   echo "<th>年费阶段：</th>
			                    <th>".$row4["ID"]."件</th>";
			                   echo "<th>无效：</th>
			                    <th>".$row5["ID"]."件</th>";
			                echo"</tr>";
                	$conn->close();
                ?>
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
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--easy pie chart-->
<script src="../../js/easypiechart/jquery.easypiechart.js"></script>
<script src="../../js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="../../js/sparkline/jquery.sparkline.js"></script>
<script src="../../js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="../../js/iCheck/jquery.icheck.js"></script>
<script src="../../js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="../../js/flot-chart/jquery.flot.js"></script>
<script src="../../js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="../../js/flot-chart/jquery.flot.resize.js"></script>
<script src="../../js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="../../js/flot-chart/jquery.flot.selection.js"></script>
<script src="../../js/flot-chart/jquery.flot.stack.js"></script>
<script src="../../js/flot-chart/jquery.flot.time.js"></script>
<script src="../../js/main-chart.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />
  
  
</body>
</html>