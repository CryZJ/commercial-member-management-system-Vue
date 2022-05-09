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

  <title>个案管理页面</title>

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
	<?
	$sqh = $_GET['sqh'];
?>

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				案卷基本情况
					  <span class="tools pull-right">
		        	<a href="javascript:;" class="fa fa-chevron-down"></a>
			      </span>
      </header>
            <div class="panel-body">
            	
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">案号</th>
                            <td class="numeric">#</td>
                            <th class="numeric">申请号</th>
                            <td class="numeric"><? echo $sqh ?></td>
                            <th class="numeric">申请日</th>
                            <td class="numeric">#</td>
                            <th class="numeric">申请人</th>
                            <td class="numeric">#</td>
                            <th class="numeric">案源人</td>
                            <td class="numeric">#</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="numeric">类型</th>
                            <td class="numeric">#</td>
                            <th class="numeric">专利名称</th>
                            <td class="numeric">#</td>
                            <th class="numeric">授权公告日</th>
                            <td class="numeric">#</td>
                            <th class="numeric">当前程序</td>
                            <td class="numeric">#</td>
                            <td class="numeric"></td>
                            <td class="numeric"></td>
                        </tr>
                        <tr>
                            <th class="numeric">联系人</th>
                            <td class="numeric">#</td>
                            <th class="numeric">手机</th>
                            <td class="numeric">#</td>
                            <th class="numeric">固话</th>
                            <td class="numeric">#</td>
                            <th class="numeric">传真</th>
                            <td class="numeric">#</td>
                            <th class="numeric">QQ</th>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <th class="numeric">邮箱</th>
                            <td class="numeric">#</td>
                            <th class="numeric">地址</th>
                            <td class="numeric">#</td>
                            <td class="numeric"> </td>
                            <td class="numeric"> </td>
                            <td class="numeric"> </td>
                            <td class="numeric"> </td>
                            <td class="numeric"> </td>
                            <td class="numeric"> </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    </section>
                   </div>


            <div class="col-sm-12">
                <section class="panel">
			<header class="panel-heading">
				案卷流程及文档
				 <span class="tools pull-right">
		        	<a href="javascript:;" class="fa fa-chevron-down"></a>
			      </span>
      </header>
            <div class="panel-body">           	
									<a href="circuit create.html"><button>新建流程</button></a>
									<button>修改</button>
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">流程</th>
                            <th class="numeric">时间</th>
                            <th class="numeric">处理人</th>
                            <th class="numeric">文件记录</th>
        
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="numeric">新建案件</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">欠缺输入框</td>
                        </tr>
                        <tr>
                            <th class="numeric">上报文件</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <th class="numeric">处理</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <th class="numeric">授权通知</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        </tbody>
                    </table>
                                        </div>
                            </section>
													</div>


        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				缴费记录
				 <span class="tools pull-right">
		        	<a href="javascript:;" class="fa fa-chevron-down"></a>
			      </span>
      </header>
            <div class="panel-body">

                    
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">名称</th>
                            <th class="numeric">通知时间</th>
                            <th class="numeric">收费日期</th>
                            <th class="numeric">金额</th>
                            <th class="numeric">缴费日期</th>
                            <th class="numeric">缴费人</th>
                            <th class="numeric">收据编号</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="numeric">申请费</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>                            
                        </tr>
                        <tr>
                            <th class="numeric">实审费</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <th class="numeric">登记费</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <th class="numeric">第一年年费</th>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                    </table>
                    </div>
                            </section>

        </div>

        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				费用记录
				 <span class="tools pull-right">
		        	<a href="javascript:;" class="fa fa-chevron-down"></a>
			      </span>
      </header>
            <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed" >
                        <thead>
                        <tr>
                            <th class="numeric">年度</th>
                            <th class="numeric">应缴日期</th>
                            <th class="numeric">金额</th>
                            <th class="numeric">滞纳金</th>
                            <th class="numeric">恢复费</th>
                            <th class="numeric">代理费</th>
                            <th class="numeric">合计</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="numeric">2</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <td class="numeric">3</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        <tr>
                            <td class="numeric">4</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                            <td class="numeric">#</td>
                        </tr>
                        </tbody>
                    </table>
									</div>
        </section>
						</div>
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

</body>

</html>
