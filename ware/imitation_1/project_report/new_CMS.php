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

  <title>企业信息采集-新建</title>

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
        <header class="panel-heading">
            <!--<form action="newcasefile_save_rjaj.php" method="post" enctype="multipart/form-data">-->
            <strong>企业基本资料表</strong>
                <span class="tools pull-right">
                    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
                </span>
        </header>
        <div class="panel-body" style="width: 98%;overflow: auto;solid #000000">
                <label>案源人：<input type="text" id="ayr" onclick="select_ayr()" readonly="readonly" /></label>
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
                        <th>注册资产【万元】</th>
                    </tr>
                    <tr align="center">
                        <td><input style="width: 90%;" class="TabMes_1" type="text" name="" id="ClientName"/></td>
                        <td><input type="date" class="TabMes_1" name="" style="height: 26px;" /></td>
                        <td><select class="TabMes_1">
                            <option></option>
                            <option>外资</option>
                            <option>合资</option>
                            <option>内资</option>
                        </select></td>
                        <td><select class="TabMes_1">
                            <option></option>
                            <option>是</option>
                            <option>否</option>
                        </select></td>
                        <td><input style="width: 90%;" class="TabMes_1" type="text" id=""/></td>
                        <td><select class="TabMes_1">
                            <option></option>
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
                        <td><input type="text" class="TabMes_1" /></td>
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
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                        <td><input style="width: 80px;" class="TabMes_2" type="text" id=""/></td>
                    </tr>
                </table>
                <p><strong>人力资源情况</strong></p>
                <table class="table table-bordered table-striped table-condensed" id="tab3">
                    <tr>
                        <th>职工总数</th>
                        <th><input type="text" class="TabMes_3" id="NumPeoAll" onchange="GetPercent('All')" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></th>
                        <th>个税申报人数</th>
                        <th><input type="text" class="TabMes_3" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')" /></th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th colspan="2">社保人员占比</th>
                        <th colspan="2">大专以上占比</th>
                        <th colspan="2">本科及以上占比</th>
                    </tr>
                    <tr align="center">
                        <td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id="PeoNumA" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumA" type="text" id="" readonly="readonly"/>%</td>
                        <td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id="PeoNumB" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumB" type="text" id="" readonly="readonly"/>%</td>
                        <td><strong>人数：</strong><input style="width: 80px;" class="TabMes_3" type="text" id="PeoNumC" onchange="GetPercent(this.id)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><strong>比例：</strong><input style="width: 80px;" class="TabMes_3 PeoNumC" type="text" id="" readonly="readonly"/>%</td>
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
                    </tr>
                    <tr>
                        <td><input style="width: 50px;" class="TabMes_4 NumType" type="text"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onchange="CountA(this)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onchange="CountA(this)" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" type="text" id="" readonly="readonly"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" class="NumType" type="text" id="" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"/></td>
                        <td><input style="width: 120px;" type="text" id="" readonly="readonly"/>%</td>
                    </tr>
                    <tr>
                        <th colspan="10" class="AddRow" onclick="AddRow('FareMes',this)">+</th>
                    </tr>
                </table>
                <p><strong>企业资质情况</strong></p>
                <table class="table table-bordered table-striped table-condensed" id="tab5">
                    <tr>
                        <td colspan="2"><strong>一、企业研发中心情况</strong></td>
                        <td><strong>二、标准化情况</strong></td>
                    </tr>
                    <tr align="center">
                        <th>研发中心 &nbsp;&nbsp;&nbsp;
                            <select class="TabMes_5">
                            <option></option>
                            <option>无</option>
                            <option>内地</option>
                            <option>外批</option>
                        </select></th>
                        <th>高校合作 &nbsp;&nbsp;&nbsp;
                            <select class="TabMes_5">
                            <option></option>
                            <option>有</option>
                            <option>无</option>
                        </select></th>
                        <th>主导标准 &nbsp;&nbsp;&nbsp;
                            <select class="TabMes_5">
                            <option></option>
                            <option>地方标准</option>
                            <option>行业标准</option>
                            <option>国家标准</option>
                            <option>国际标准</option>
                        </select></th>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>三、各级政府立项情况</strong></td>
                    </tr>
                    <tr>
                        <th>级别</th>
                        <th>时间</th>
                        <th>项目名称</th>
                    </tr>
                    <tr>
                        <td><select class="ProList ProMes">
                            <option></option>
                            <option>区级</option>
                            <option>市级</option>
                            <option>省级</option>
                            <option>国家级</option>
                        </select></td>
                        <td><input type="date" id="" style="height: 26px;" class="ProMes"/></td>
                        <td><input style="width: 98%;" class="ProMes" type="text" id=""/></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="AddRow" onclick="AddRow('ProMes',this)">+</th>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>四、其他资质证书</strong></td>
                    </tr>
                    <tr>
                        <th>时间</th>
                        <th colspan="2">资质名称</th>
                    </tr>
                    <tr>
                        <td><input type="date" class="ZSMes ZS" id="" style="height: 26px;"/></td>
                        <td colspan="2"><input style="width: 98%;" class="ZS" type="text" id=""/></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="AddRow" onclick="AddRow('ZSMes',this)">+</th>
                    </tr>
                </table>
                <p><strong>其他情况<sub style="color: red;"></strong></p>
                <table class="table table-bordered table-striped table-condensed" id="tab6">
                    <tr>
                        <th style="width:300px ;">技术改造</th>
                        <th><select class="TabMes_6" onchange="changeType(this)">
                            <option></option>
                            <option>无计划</option>
                            <option>有计划</option>
                            <option>进行中</option>
                        </select>
                        <th style="width:300px ;">计划设备总额【万元】</th>
                        <th><input type="text" style="width: 85%;" class="TabMes_6" /></th>
                    </tr>
                </table>
                <p><strong>联系人</strong></p>
                <table class="table table-bordered table-striped table-condensed" id="tab7">
                    <tr>
                        <th>姓名</th>
                        <th>联系方式</th>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>一、法人代表</strong></td>
                    </tr>
                    <tr>
                        <td style="width:20%;"><input type="text" class="PeoInLow" id=""/></td>
                        <td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="AddRow" onclick="AddRow('PeoInLow',this)">+</th>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>二、财务管理员</strong></td>
                    </tr>
                    
                    <tr>
                        <td style="width:20%;"><input type="text" class="FareCount" id=""/></td>
                        <td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="AddRow" onclick="AddRow('FareCount',this)">+</th>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>三、技术管理员</strong></td>
                    </tr>
                    <t>
                        <td style="width:20%;"><input type="text" class="TecPeo" id=""/></td>
                        <td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="AddRow" onclick="AddRow('TecPeo',this)">+</th>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>四、日常联系人</strong></td>
                    </tr>
                    <tr>
                        <td style="width:20%;"><input type="text" class="LifeCon" id=""/></td>
                        <td style="width:80%;"><input type="text" id="" style="width: 80%;"/></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="AddRow" onclick="AddRow('LifeCon',this)">+</th>
                    </tr>
                </table>
                <label>企业信息备注：</label>
                <p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
                <!--fileupload start-->
                <table>
					<tr>
						<td><button class="btn btn-primary" id="select_file">选择文件</button><input style="display: none;" type="file" id="int_file" multiple="multiple" /></td>
					</tr>
				</table>
				<div>
				    <!--进度条 start-->
                    <div align="center" id="file_list">
                        <div class="progress_upload">
                            <div class="progress-bar" style="width: 0%">
                                &nbsp;<strong></strong>
                            </div>
                        </div>
                    </div>
                    <!--进度条 end-->
					<table>
						<thead>
							<th>文件列表</th>
						</thead>
						<tbody  id="file_list">
							
						</tbody>
					</table>
				</div>
				<!--fileupload end-->
        </div>
                    <div align="center">
                        <button class="btn btn-primary" type="button" onclick="SaveMes()">提交信息</button>
                    </div>
                <br />
            </section>
           <!--</form>-->
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
<!-- 页面响应 -->
<script src="../../../js/imitation_1/new_CMS.js"></script>

<script type="text/javascript">
//----------------------文件 start--------------------------------
	fd_file = new FormData();
	file_num = 1;
	//产生随机码做id
	function random_id() {
	　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz0123456789';   
	　　var maxPos = chars.length;
	　　var pwd = '';
	　　for (var i = 0; i < 10; i++) {
	    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
	   }
	    return pwd;
	}
	//文件大小由字节改为合适的显示
	function bytesToSize(bytes) {
		if (bytes === 0) return '0 B';
		var k = 1024, // or 1000
		sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
		i = Math.floor(Math.log(bytes) / Math.log(k));
		return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
	}
	//监督进度条
	function uploadProgress(evt){
		if (evt.lengthComputable) {
	        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
			var file_list = document.getElementById("file_list");
			file_list.getElementsByTagName("strong")[0].innerHTML = '<span>'+percentComplete.toString()+'%</span>';
	        var prog = file_list.getElementsByTagName('div')[0];
			var progBar = prog.getElementsByTagName('div')[0];
			progBar.style.width= 2*percentComplete+'px';
			progBar.setAttribute('aria-valuenow', prog.percent);
	   }else {
	    	var file_list = document.getElementById("file_list");
	    	var prog = file_list.getElementsByTagName('div')[0];
	        prog.getElementsByTagName("div")[0].innerHTML = '上传失败！';
	    }
	}
	//取消上传
	function del_addfile(id_str){
//		alert(id_str);
		fd_file.delete(id_str);
		$("#"+id_str).remove();
		file_num--;
	}
	//
	document.getElementById("select_file").addEventListener("click",function(){
		document.getElementById("int_file").click();
	});
	//创建文件列表
	document.getElementById("int_file").addEventListener("change",function(){
		var int_file = document.getElementById("int_file").files;
		var div_list = document.getElementById("file_list");
//		alert(div_list.innerHTML.length)
		if(div_list.innerHTML.length == 15){
			div_list.innerHTML += '<tr id="jingdutiao" ><td colspan="2"><div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong></td><tr>';		
		}
		for(i=0;i<int_file.length;i++){
			tmp_id = random_id();
			fd_file.append(tmp_id,int_file[i]);

			var tmp_tr = document.createElement("tr");
			tmp_tr.id = tmp_id;
			var tmp_td_1 = document.createElement("td");
			tmp_td_1.style.width = "300px";
			var tmp_span = document.createElement("span");
			tmp_span.innerHTML = int_file[i].name;
			var tmp_em = document.createElement("em");
			tmp_em.innerHTML = "("+bytesToSize(int_file[i].size)+")";
			var tmp_strong = document.createElement("strong");
			tmp_tr.appendChild(tmp_td_1);
			tmp_td_1.appendChild(tmp_span);
			tmp_td_1.appendChild(tmp_em);
			tmp_td_1.appendChild(tmp_strong);
			
			var tmp_td_2 = document.createElement("td");
//			var tmp_input = document.createElement("input");
//			tmp_input.classList.add("miaoshu");
//			tmp_input.type = "text";
//			tmp_input.placeholder = "请填写文件描述";
//			tmp_input.tabIndex = file_num;
			
			tmp_tr.appendChild(tmp_td_2);
//			tmp_td_2.appendChild(tmp_input);
			tmp_td_2.innerHTML += '<button onclick="del_addfile(\''+tmp_id+'\')">取消</button>';
			
			div_list.appendChild(tmp_tr);
			
			file_num++;
		}
	});	
	
	
	
	
	//----------------------文件 end--------------------------------
</script>
</body>

</html>