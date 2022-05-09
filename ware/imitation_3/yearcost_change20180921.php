<?php
	require'../../AHeader.php'; 
	require'../../conn.php';
	require_once "../../classes/GetAnnualFeePayment.php";
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

<body class="sticky-header" onload="onshow()">

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
                  <tbody>
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
			              	<?php
			            		$id = $_REQUEST['mas'];
								
			            		if(strlen($id) == 0){
			            			echo "<script> alert('你还未选择缴费条目，请重新选择'); window.opener=null;window.close(); </script>";
			            		}
			            		$fid = explode('/',$id);
			            		$len = count($fid);
			            		$yy = 0;
//			            		echo"<script> alert('".$len."'); </script>";
			            		for($i=0;$i<$len;$i++){
			            			$yy ++ ;
			            			$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,应缴日期,剩余天数  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费 )) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.id='".$fid[$i]."'";
//			            			$sql = "SELECT id,`案卷号`,专利名称,申请人,申请号,申请日,代理人,`年度`,`金额`,`应缴日期`,缴费时间,收据上传日期,通知书生成日期,剩余天数 FROM `专案_年费记录` where id='".$fid[$i]."'";
			            			$result = $conn->query($sql);
				            		if($result->num_rows>0){
				            			while($row = $result->fetch_assoc()){
				            				$fcheckid =$row['id']; 
	                  		?>
              		<tr>
              			<th><?php echo $yy; ?></th>
                  		<th hidden="hidden" ><input id="fid[<?php echo $i; ?>]"value="<?php echo $row["id"]; ?>" /><?php echo $row["id"]; ?></th>
                  		<th><input id="fyn[<?php echo $i; ?>]" value="<?php echo $row["申请号"]; ?>" hidden="hidden" /><?php echo $row["申请号"]; ?></th>
                  		<th><input id="zlm[<?php echo $i; ?>]" value="<?php echo $row["专利名称"]; ?>" hidden="hidden" /><?php echo $row["专利名称"]; ?></th>
                  		<td><input id="ajh[<?php echo $i; ?>]" value="<?php echo $row["案卷号"]; ?>" hidden="hidden" /><?php echo $row["案卷号"]; ?></td>
                  		<td><input id="sqr[<?php echo $i; ?>]" value="<?php echo $row["申请日"]; ?>" hidden="hidden" /><?php echo $row["申请日"]; ?></td>
                  		<td><input id="yea[<?php echo $i; ?>]" value="<?php echo $row["年度"]; ?>" hidden="hidden" /><?php echo $row["年度"]; ?></td>
                  		<td hidden="hidden"><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" id="jef[<?php echo $i; ?>]" name="" value="<?php echo $row["金额"]; ?>" hidden="hidden" /><?php echo $row["金额"]; ?></td>
                  		<?php 
                  			$sqf=100;
                  		?>
                  		<td><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" oninput="thiscount(event,this.id)" style="width:150px" id="dlf[<?php echo $i; ?>]" name="" value="<?php echo $sqf; ?>" /></td>
                  		<!--滞纳金-->
                  		<td><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" oninput="thiscount(event,this.id)" style="width:150px" id="znj[<?php echo $i; ?>]" name="" value="0" /></td>
                  		<td><input style="border: 0px;background: none;" type="text" id="zje[<?php echo $i; ?>]" name="" value="" readonly="readonly" /></td>
                  	</tr>
	                  	<?php
				            			}
				            		}
			            		}
		            		$conn->close();
		            	?>
                  	<tr>
                  		<input id="fid" value="<?php echo $id; ?>" hidden="hidden" />
                  		<th colspan="2">总金额</th>
                  		<?php $fare_all = 0; ?>
                  		<td colspan="6"></td>
                  		<td colspan="2" ><input style="border: 0px;background: none;" type="text" id="fareall" name="" value="<?php echo $fare_all; ?>" readonly="readonly" /></td>
                  	</tr>
                  </tbody>
              	</table>
              <!--<div id='error' ></div>-><!--用于输出测试-->
              <div>
              	<center>
              		<input class="btn btn-primary" type="button" id="btn0" name="" value="确认" onclick="che()" />
	              	&nbsp;
	              	<input  class="btn btn-success" type="button" style="display: none;" id="btn1" name="" value="导出到Excel" onclick="showExcel()" />
	              	<input type="text" id="FName" hidden="hidden" />
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
		
</body>
</html>