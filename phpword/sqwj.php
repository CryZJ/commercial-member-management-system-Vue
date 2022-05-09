<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <title>授权文件导出内容预览</title>
</head>

<style>
	.body{
		/*border:1px solid #000;*/
		width:640px;
		/*height:877px;*/
		position:relative;
	}
	.info {
		width:600px;
	}
	#footer{
		margin-bottom:10px;
		position:absolute;
		left:0;bottom:0;
	}
	.tab{
		width:600px;
		height:50px;
		border-collapse:collapse;
	}
	.tab th{
		border:none;
	}
	#tab_info{
		border:1px solid #000;
		width:620px;
		border-collapse:collapse;
		position:absolute;
		left:1;
	}
	#tab_info td,th{
		border:1px solid #000;
		height:20px;
	}
	span{
		font-family:"楷体";
	}
	div{
		/*border:1px solid #000;*/
		font-family:"楷体";
		margin:0 auto;
		width:1000px;
	}
	#btn{
		/*border:1px solid #000;*/
		width:620px;
	}
	th,td{
		width:50px;
	}
	.mes{
		border:none;
		width:70px;
	}
	.fare{
		border:none;
		width:50px;
	}
</style>

<body class="sticky-header">
	<div style="width:640px;" id="outside">
		<div id="btn">
			<input type="button" value="增行" onclick="addrow()" />
			<input type="button" value="确定" onclick="sure()" />
		</div>
		<div class="body" >
			<!--<header>
				<img src="top.png" style="width:100%" />
			</header>-->
			<div class="info" id="part01">
					<strong>致：</strong> <input style="width:400px;" type="text" id="comname" value="珠海格兰新材料科技有限公司" /> </br>
					<strong>事由:</strong> <input style="width:400px;" type="text" id="infoname" value="专利授权缴费通知" /></br>
					<strong>发函日期：</strong><input style="width:400px;" type="date" id="strdate" value="" /></br>
					<strong>回复期限：</strong><input style="width:400px;" type="date" id="enddate" value="" />
			</div>
			<br/>
			<div class="info">
				<table class="tab">
					<tr>
						<th colspan="2">客户联系方式</th>
					</tr>
					<tr>
						<th>联系人:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>固话:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>手机:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>邮箱:</th><td><input class="mes" type="text" id="" value="" /></td>
					</tr>
				</table>
				<table class="tab">
					<tr>
						<th colspan="2">我方联系方式</th>
					</tr>
					<tr>
						<th>联系人:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>固话:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>手机:</th><td><input class="mes" type="text" id="" value="" /></td>
						<th>邮箱:</th><td><input class="mes" type="text" id="" value="" /></td>
					</tr>
				</table>
			</div>
			<br/>
			<div class="info" id="part04">
				<span>尊敬的申请人：</span></br>
				&nbsp;&nbsp;&nbsp;&nbsp;<span>恭喜您申请的专利已经通过了国家知识产权局的审查。在收到本通知后，请在回复绝限
	前缴纳下表所列的专利申请的专利登记费、专利证书印花税、年费，在您缴纳上述费用后，
	国家知识产权局将在 2-3 个月内颁发专利证书，并在国家知识产权局的网站上予以公告。根
	据专利法的规定，未按规定缴纳上述费用的，视为放弃取得专利的权利，专利权终止后不再
	办理专利权恢复手续，如果放弃下表所列的专利或部分专利，请您在通知书上写明“放弃”
	字样并签名或加盖公章，在回复绝限前寄回或传真回我司，我司将相应的专利结案。在此非
	常感谢您配合和支持我们的工作。</span>
			</div>
			<br/>
			<div class="info" id="part05">
				<span>
					开户银行： 广发银行中山彩虹支行</br>
					户 名：中山市中亿星诚知识产权服务有限公司</br>
					银行帐号： 9550 8802 0597 3200 158 
				</span>
			</div>
			<br />
				<center>
					<strong>授权通知附表</strong>
				</center>
				<table id="tab_info">
					<tr>
						<th>序号</th>
						<th>专利号</th>
						<th>专利名称</th>
						<th>申请日</th>
						<th>登记费</th>
						<th>年费</th>
						<th>代理费</th>
						<th>小计</th>
					</tr>
					<tr>
						<th>1</th>
						<td>2016214399863</td>
						<td>一种环保防水板材</td>
						<td>2016-12-27</td>
						<td><input class="fare" type="text" id="" value="" /></td>
						<td><input class="fare" type="text" id="" value="" /></td>
						<td><input class="fare" type="text" id="" value="" /></td>
						<td><input class="fare" type="text" id="" value="" /></td>
					</tr>
					<tr>
						<th colspan="7">总计</th>
						<td><input class="fare" type="text" id="" value="" /></td>
					</tr>
				</table>
			<!--</br>
			<div style="width:100%" id="footer">
				<img src="button.png" style="width:100%"  />
			</div>-->
			
		</div>
		
	</div>
  <script>
  	function addrow(){
	  	var Table = document.getElementById("tab_info");
			var nRows = Table.rows.length;
			var nCell = Table.rows[0].cells.length;
			var newRow = Table.insertRow(nRows-1);
			var onclick_cs = nRows-1;//获取的序号
			newRow.insertCell(0).innerHTML = '<center>'+onclick_cs+'</center>';
			newRow.insertCell(1).innerHTML = Table.rows[1].cells[1].innerHTML;
			newRow.insertCell(2).innerHTML = Table.rows[1].cells[2].innerHTML;
			newRow.insertCell(3).innerHTML = Table.rows[1].cells[3].innerHTML;
			newRow.insertCell(4).innerHTML = Table.rows[1].cells[4].innerHTML;
			newRow.insertCell(5).innerHTML = Table.rows[1].cells[5].innerHTML;
			newRow.insertCell(6).innerHTML = Table.rows[1].cells[6].innerHTML;
			newRow.insertCell(7).innerHTML = Table.rows[1].cells[7].innerHTML;
  	}
  	function sure(){
  		
  	}
  	
  </script>
  
</body>
</html>
