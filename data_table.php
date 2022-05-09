<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>XXXXX</title>
  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--提醒弹窗-->
<!--<script language="JavaScript">
	function ShowEdit_01(s_name){
		//var name=
		//var r = window.open("applicant.php?n=" + s_name,null,"");
		alert(s_name);
	}
</script>-->

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	<span class="tools pull-right">
              	<a href="javascript:;" class="fa fa-chevron-down"></a>
              	</span>
            	XXXXX
            </header>
            <div class="panel-body">
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="numeric">案卷号</th>
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
                        <tr>
                            <td><label><input name="Fruit" type="checkbox" value="" /> </label></td>
                            <td>00001AADAD</td>
                            <td class="numeric">发明</td>
                            <td class="numeric">11111111</td>
                            <td class="numeric">17-10-10</td>
                            <td class="numeric">XXXXX</td>
                            <td class="numeric">AAA</td>
                            <td class="numeric">BBB</td>
                            <td class="numeric">CCC</td>
                            <td class="numeric">DDD</td>
                        </tr>
                        <tr>
                            <td><label><input name="Fruit" type="checkbox" value="" /> </label> </td>
                            <td>00002BADAD</td>
                            <td class="numeric">实用</td>
                            <td class="numeric">11111111</td>
                            <td class="numeric">17-10-10</td>
                            <td class="numeric">XXXXX</td>
                            <td class="numeric">AAA</td>
                            <td class="numeric">BBB</td>
                            <td class="numeric">CCC</td>
                            <td class="numeric">DDD</td>
                        </tr>
                        </tr>
                        <tr>
														<td><label><input name="Fruit" type="checkbox" value="" /> </label> </td>
                            <td>00003CADAD</td>
                            <td class="numeric">外观</td>
                            <td class="numeric">11111111</td>
                            <td class="numeric">17-10-10</td>
                            <td class="numeric">XXXXX</td>
                            <td class="numeric">AAA</td>
                            <td class="numeric">BBB</td>
                            <td class="numeric">CCC</td>
                            <td class="numeric">DDD</td>
                        </tr>
                       </tr>
                        </tbody>
                    </table>
                </form>
                <!-- form end -->
            </div>
           </div>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>