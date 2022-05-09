<?php
	require'../../AHeader.php'; 
	require'../../conn.php';
	require_once "../../classes/GetAnnualFeePayment.php";
	
	//生成4位数随机码
	function CreateCaptcha(){
		$captch_code = '';
		for ($i = 0; $i < 4; $i++) {
		    $fontsize = 10;
		    $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
		    $data = '0123456789';
		    $fontcontent = substr($data, rand(0, strlen($data) - 1), 1);
		    $captch_code .= $fontcontent;
		    $x = ($i * 100 / 4) + rand(5, 10);
		    $y = rand(5, 10);
//		    imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
		}
		return $captch_code;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>缴费确认</title>
  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body class="sticky-header">

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	缴费确认
            	<span class="tools pull-right">
				    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
				    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
				    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
				</span>
            </header>
            <div class="panel-body">
            	<input hidden="hidden" id="y_yzh" value="<?php echo rand(1000,9999); ?>" readonly />
                <table class="display table table-bordered table-striped" id="tab_info">
                  <thead>
                  	<th colspan="2">操作员</th>
                  	<th colspan="8" ><input style="border: 0px;width:250px" type="text" id="cpeo" name="" value="<?php echo $name; ?>" readonly="readonly" /></th>
                  </thead>
                  	<tr>
                  		<!--<th hidden="hidden">id</th>-->
                  		<th>序号</th>
                  		<th>专利号</th>
                  		<th>专利名</th>
                  		<th>案卷号</th>
                      	<th>申请日</th>
                      	<th>年度</th>
                      	<th>年费</th>
                      	<th hidden="hidden">代理费</th>
                      	<th>滞纳金</th>
                      	<!--<th>缴费期限</th>-->
                      	<th>小计</th>
                      	<!--<th>缴费日期</th>-->
                  	</tr>
                  	<tbody id="yearcostinfo">
			              	<?php
			            		$id_str = $_REQUEST['mas'];
			            		if(strlen($id_str) == 0){
			            			echo "<script> alert('你还未选择缴费条目，请重新选择'); window.opener=null;window.close(); </script>";
			            		}
								$sql = "SELECT id,案卷号,年度,金额 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$id_str."') ORDER BY 案卷号;";
								$getannualfeedata = new GetAnnualFeePayment($conn,$sql,$costid);
								$getannualfeedata->UseClass();
								if(count($getannualfeedata->sqldata_annualfee) > 0){
									$i = 1;
									$fare_all = 0;//总金额
									foreach($getannualfeedata->sqldata_annualfee as $index_is => $row){
							?>
						<tr>
	              			<td><?php echo $i; ?></td>
	                  		<td><?php echo $row["申请号"]; ?></td>
	                  		<td><?php echo $row["专利名称"]; ?></td>
	                  		<td><?php echo $row["案卷号"]; ?></td>
	                  		<td><?php echo $row["申请日"]; ?></td>
	                  		<td><?php echo $row["年度"]; ?></td>
	                  		<td><?php echo round($row["金额"],2); ?></td>
	                  		<td><input name="<?php echo $row["id"]; ?>" value="<?php echo round($row["滞纳金"],2); ?>" onkeyup="AutoCount(this)" /></td>
	                  		<td><?php echo round($row["金额"]+$row["滞纳金"],1);$fare_all = $fare_all + $row["金额"]+$row["滞纳金"]; ?></td>
	                  	</tr>
							<?php
										$i++;
									}
								}
		            		?>
		            </tbody>
		            <tfoot>
	                  	<tr>
	                  		<td class="text-center" colspan="8">总金额</td>
	                  		<td colspan="2" ><input style="border: 0px;background: none;" type="text" id="fareall" name="" value="<?php echo $fare_all; ?>" readonly="readonly" /></td>
	                  	</tr>
                  	</tfoot>
              	</table>
              <!--<div id='error' ></div>-><!--用于输出测试-->
              <div>
              	<center>
              		<input class="hidden" type="text" id="costidstring" value="<?php echo $id_str; ?>" />
              		<label>请输入验证码：</label>
              		<?php  $authcode = CreateCaptcha();?>
              		<input type="text" id="captcha" name="<?php echo $authcode; ?>" placeholder="提示：<?php echo $authcode; ?>,可按Enter键确认" />
              		<img style="width:100px;height:30px;" id="captcha_img" border="1" src="captcha.php?authcode=<?php echo $authcode; ?>&r=<?php echo rand(); ?>">
              		<br />
              		<button class="btn btn-primary" id="createpaymentfile" onclick="CreatePaymentFile(this)">生成缴费文件</button>
              		<a class="btn btn-success hidden" target="_blank" onclick="window.close()" id="downexcelfile" href="">下载缴费件</a>
              		
              		<!--<input class="btn btn-primary" type="button" id="btn0" name="" value="确认" onclick="che(this)" />
	              	&nbsp;
	              	<input  class="btn btn-success" type="button" style="display: none;" id="btn1" name="" value="导出到Excel" onclick="showExcel()" />
	              	<input type="text" id="FName" hidden="hidden" />-->
              	</center>
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
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<!--<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--费用确认函数-->
<script type="text/javascript" src="../../js/imitation_3/yearcost.js"></script>

<script src="../../js/imitation_3/CY_Pay.js"></script>

<script type="text/javascript">
	$("#captcha").keydown(function(e){
		if(e.keyCode == 13){
			$("#createpaymentfile").click();
		}
	})
</script>
		
</body>
</html>