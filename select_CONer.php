<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>联系人选择</title>
  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>


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

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	联系人查询
            	<span class="tools pull-right">
						    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
						    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body" id="SA">
            	<input  class="btn btn-primary" type="button" value="确定" onclick="che()" />
            	<br />
            	<br />
                    <table class="display table table-bordered table-striped" id="tab">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>姓名</th>
                            <th>固话</th>
                            <th>手机</th>
                            <th>邮箱</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
													require("conn.php");
													$sqrid = $_GET['id'];
													$sqrid_arr = array();
													if(strpos($sqrid, ",")){
														$sqrid_arr = explode(",", $sqrid);
													}else{
														$sqrid_arr[0] = $sqrid;
													}
													$str = "";
													if(count($sqrid_arr) > 0){
														foreach($sqrid_arr as $ky => $v){
															$str .= " 申请人id='".$v."' OR";
														}
														$str = substr($str, 0,strlen($str)-2);
														$num = 0;
														$sql = "SELECT id,姓名,固话,手机,邮箱 FROM 联系人 where ".$str;
	//													echo $sql;
														$result = $conn->query($sql);
														if($result->num_rows>0){
															while($row = $result->fetch_assoc()){
																$num++;
												?>
															<tr>
																<td><input type="checkbox" id="<?php echo $num; ?>" /></td>
																<td><?php echo $row['姓名']; ?></td>
																<td><?php echo $row['固话']; ?></td>
																<td><?php echo $row['手机']; ?></td>
																<td><?php echo $row['邮箱']; ?></td>
															</tr>
												<?php
															}
														}
													}
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
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
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
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

		<script type="text/javascript">
			window.onblur = function(){
				window.close();
			}
			function che(){
				var tab = document.getElementById('tab');
				var data_str = "";
				var rowlen = tab.rows.length;
				for (var i=1;i<rowlen;i++) {
					if(tab.rows[i].cells[0].getElementsByTagName("input")[0].checked == true){
						data_str += tab.rows[i].cells[1].innerHTML+'|';
						data_str += tab.rows[i].cells[2].innerHTML+'|';
						data_str += tab.rows[i].cells[3].innerHTML+'|';
						data_str += tab.rows[i].cells[4].innerHTML+',';
					}
				}
				data_str = data_str.substr(0,data_str.length-1);
//			console.log(data_str);
				if(typeof(Storage)!=="undefined"){
						localStorage.return_data = data_str;
						window.close();
					} else {
					    alert("抱歉！你的浏览器不支持web存储。");
					}
			}
		</script>

</body>
</html>
