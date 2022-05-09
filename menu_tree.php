<?php
//用于创建左边菜单栏
// * mod_num:在那个大模块：0：案件管理，1：OA办公，2：费用管理，3:人员管理，4:系统设置，5:财务管理
// * mod_small_num:在大模块中的第几小模块.从0开始
function Create_leftlist($mod_num,$mod_small_num){
	require("AHeader.php");
	require("conn.php");
	$ret_data = "";
	$sql = "SELECT 最高权限者,流程操作员,事务管理员,sys_set,fare_con FROM 用户 WHERE id='".$userid."'";
	$result = $conn->query($sql);
	if($result->num_rows){
		while($row = $result->fetch_assoc()){
			$ret_data["最高权限者"] = $row["最高权限者"];
			$ret_data["流程操作员"] = $row["流程操作员"];
			$ret_data["事物管理员"] = $row["事务管理员"];
			$ret_data["系统设置"] = $row["sys_set"];//系统设置
			$ret_data["财务管理"] = $row["fare_con"];//财务管理
		}
	}
	if(!empty($ret_data)){
		$server_host = "http://".$_SERVER["HTTP_HOST"]."/zlxt/";
	//	echo $server_host;
		
		//大logo图片
		$logo_big = '<div class="logo"><a href="'.$server_host.'remind.php"><img src="'.$server_host.'images/logo.png" alt=""></a></div>';
		echo $logo_big;
		
		$logo_little = '<div class="logo-icon text-center"><a href="'.$server_host.'index.php"><img src="'.$server_host.'images/logo_icon.png" alt=""></a></div>';
		echo $logo_little;
		
		//开头标签
		echo '<div class="left-side-inner">';
		echo '<ul class="nav nav-pills nav-stacked custom-nav">';
		
		//------------------------------------案件管理---------------------------------------------
		$tmp_html = "";
		$tmp_html = '<li class="menu-list">';
		$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>案件管理</span></a>';
		$tmp_html .= '<ul class="sub-menu-list">';
		
		$tmp_html .= '<li><a href="'.$server_host.'index.php">专利案件</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_1/blogo_case/blogo.php">商标案件</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_1/software_case/software.php">软件案件</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_1/works_case/works.php">著作案件</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_1/customs_case/customes.php">海关备案</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_1/project_report/ProReport.php">项目申报</a></li>';
		
		$tmp_html .= '</ul>';
		$tmp_html .='</li>';
		echo $tmp_html;
		
		//-------------------------------------OA办公-----------------------------------------------
		$tmp_html = "";
		$tmp_html = '<li class="menu-list">';
		$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>OA办公</span></a>';
		$tmp_html .= '<ul class="sub-menu-list">';
		
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_2/mailmas.php">文件收发</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_2/exdelmas.php">快递收发</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_2/casemark.php">案件登记</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_2/dateworks.php">日程管理</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_2/ClieMag.php">客户管理</a></li>';
		$tmp_html .= '';
		
		$tmp_html .= '</ul>';
		$tmp_html .='</li>';
		echo $tmp_html;
		
		//-------------------------------------费用管理-----------------------------------------------
		$tmp_html = "";
		$tmp_html = '<li class="menu-list">';
		$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>费用管理</span></a>';
		$tmp_html .= '<ul class="sub-menu-list">';
		
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_3/cost_application.php">专利申请费用</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_3/cost_authorization.php">专利授权费用</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_3/yearcost.php?flag=none&v=0">专利年费管理</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_3/cost.php">专利其他费用</a></li>';
		
		$tmp_html .= '</ul>';
		$tmp_html .='</li>';
		echo $tmp_html;
		
		//-------------------------------------人员管理-----------------------------------------------
		$tmp_html = "";
		$tmp_html = '<li class="menu-list">';
		$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>人员管理</span></a>';
		$tmp_html .= '<ul class="sub-menu-list">';
		
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_5/client.php"> 申请人管理</a></li>';
		$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_5/agent.php">账号管理</a></li>';
		
		$tmp_html .= '</ul>';
		$tmp_html .='</li>';
		echo $tmp_html;
		
		//-------------------------------------系统设置-----------------------------------------------
		if($ret_data["系统设置"] == "1"){
			$tmp_html = "";
			$tmp_html = '<li class="menu-list">';
			$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>系统设置</span></a>';
			$tmp_html .= '<ul class="sub-menu-list">';
			
			$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/bank_set.php">银行账户设置</a></li>';
			$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/fare_set.php">专案费用名设置</a></li>';
			$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/BLogoC_set.php">商标代理人设置</a></li>';
			$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/Circuit_set.php">流程设置</a></li>';
			$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/ZLCase_set.php">专利类型设置</a></li>';
			if($ret_data["最高权限者"] == "1"){
				$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_7/FirmName_set.php">公司与财务设置</a></li>';
			}
			
			$tmp_html .= '</ul>';
			$tmp_html .='</li>';
			echo $tmp_html;
		}
		
		
		//-------------------------------------财务管理-----------------------------------------------
		if($ret_data["财务管理"] == "1"){
			$tmp_html = "";
			$tmp_html = '<li class="menu-list">';
			$tmp_html .= '<a href=""><i class="fa fa-laptop"></i><span>财务管理</span></a>';
			$tmp_html .= '<ul class="sub-menu-list">';
			
			$sql = "SELECT id,公司,财务管理人员id FROM 公司管理 WHERE 删除状态='0'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$userid_arr = explode(",", $row["财务管理人员id"]);
					if(in_array($userid, $userid_arr) || $admin){
						$tmp_html .= '<li><a href="'.$server_host.'ware/imitation_6/financial-management.php" onclick="Chang_session(\''.$row["id"].'\',\''.$server_host.'\')">'.$row["公司"].'</a></li>';
					}
				}
			}
			
			
			$tmp_html .= '</ul>';
			$tmp_html .='</li>';
			echo $tmp_html;
		}
		
		//-------------------------------------账号注销-----------------------------------------------
		$tmp_html = "";
		$tmp_html = '<li>';
		$tmp_html .= '<a href="'.$server_host.'login.php"><i class="fa fa-sign-in"></i><span>账号注销</span></a>';
		$tmp_html .='</li>';
		echo $tmp_html;
		
		//结尾标签
		echo '</ul>';
		echo '</div>';
		
		//-------------------------------------用于添加active------------------------------------------------------
//		echo '<script src="js/jquery-1.10.2.min.js"></script>';//连接jQuery库文件
		echo '<script type="text/javascript">';
		echo '$("li[class=\'menu-list\']").eq('.$mod_num.').addClass("nav-active");';
		if($mod_num == 5){
			echo '$("li[class=\'menu-list nav-active\'] li").addClass("active");';
		}else{
			echo '$("li[class=\'menu-list nav-active\'] li").eq('.$mod_small_num.').addClass("active");';
		}
		
		echo '</script>';
	}
	$conn->close();
}

?>