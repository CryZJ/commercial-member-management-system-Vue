<?php
	$page = $_REQUEST['page'];
	$falg = $_REQUEST['falg'];
	$order = $_GET['order'];
	$czyid = $_GET['czyid'];
	require'conn.php';
	if($page == 'index'){
		//排序方式
		switch($order){
			case 案卷号【正】:$otype = '1/asc/案卷号【正】';break;
			case 案卷号【倒】:$otype = '1/desc/案卷号【倒】';break;
			case 类型:$otype = '2/asc/类型';break;
			case 申请号【正】:$otype = '3/asc/申请号【正】';break;
			case 申请号【倒】:$otype = '3/desc/申请号【倒】';break;
			case 申请日【正】:$otype = '4/asc/申请日【正】';break;
			case 申请日【倒】:$otype = '4/desc/申请日【倒】';break;
			case 申请人:$otype = '5/asc/申请人';break;
			case 专利名称:$otype = '6/asc/专利名称';break;
			case 案源人:$otype = '7/asc/案源人';break;
			case 代理人:$otype = '8/asc/代理人';break;
			case 状态:$otype = '9/asc/状态';break;
			case 原案卷号【正】:$otype = '10/asc/原案卷号【正】';break;
			case 原案卷号【倒】:$otype = '10/desc/原案卷号【倒】';break;
			default：exit('出现错误，请联系管理员');
		}
		//保存排序
		if($falg == 'MenuO'){//专利案件
			$sql = "update 表格顺序 set 专1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){//无效案件
			$sql = "update 表格顺序 set 专2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuS'){//复审案件
			$sql = "update 表格顺序 set 专3 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuF'){//年费案件
			$sql = "update 表格顺序 set 专4 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'BLogo'){//商标案件
		switch($order){
			case 案卷号【正】:$otype = '1/asc/案卷号【正】';break;
			case 案卷号【倒】:$otype = '1/desc/案卷号【倒】';break;
			case 案源人:$otype = '2/asc/案源人';break;
			case 代理人:$otype = '3/asc/代理人';break;
			case 类型:$otype = '4/asc/类型';break;
			case 申请人:$otype = '5/asc/申请人';break;
			case 商标名称:$otype = '6/asc/商标名称';break;
			case 状态:$otype = '7/asc/状态';break;
			case 委托人:$otype = '1/asc/委托人';break;
			case 国籍:$otype = '2/asc/国籍';break;
			case 代理人:$otype = '3/asc/代理人';break;
			case 商标名:$otype = '4/asc/商标名';break;
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuSO'){//商标案件
			$sql = "update 表格顺序 set 商1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuST'){
			$sql = "update 表格顺序 set 商2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'SfWare'){//软件案件
		switch($order){
			case 案卷号【正】:$otype = '1/asc/案卷号【正】';break;
			case 案卷号【倒】:$otype = '1/desc/案卷号【倒】';break;
			case 软件名称:$otype = '2/asc/软件名称';break;
			case 申请人:$otype = '3/asc/申请人';break;
			case 案源人:$otype = '4/asc/案源人';break;
			case 代理人:$otype = '5/asc/代理人';break;
			case 申请号:$otype = '6/asc/申请号';break;
			case 申请日:$otype = '7/asc/申请日';break;
			case 当前程序:$otype = '8/asc/当前程序';break;
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuSW'){
			$sql = "update 表格顺序 set 软 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'PWork'){//著作案件
		switch($order){
			case 案卷号【正】:$otype = '1/asc/案卷号【正】';break;
			case 案卷号【倒】:$otype = '1/desc/案卷号【倒】';break;
			case 著作名称:$otype = '2/asc/著作名称';break;
			case 申请人:$otype = '3/asc/申请人';break;
			case 案源人:$otype = '4/asc/案源人';break;
			case 代理人:$otype = '5/asc/代理人';break;
			case 申请号:$otype = '6/asc/申请号';break;
			case 申请日:$otype = '7/asc/申请日';break;
			case 当前程序:$otype = '8/asc/当前程序';break;
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuPW'){
			$sql = "update 表格顺序 set 著 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'CUST'){//海关案件
		switch($order){
			case 案卷号【正】:$otype = '1/asc/案卷号【正】';break;
			case 案卷号【倒】:$otype = '1/desc/案卷号【倒】';break;
			case 案件名称:$otype = '2/asc/案件名称';break;
			case 申请人:$otype = '3/asc/申请人';break;
			case 申请号:$otype = '4/asc/申请号';break;
			case 备案监控:$otype = '5/asc/备案监控';break;
			case 备案时间【正】:$otype = '6/asc/备案时间【正】';break;
			case 备案时间【倒】:$otype = '6/desc/备案时间【倒】';break;
			case 当前程序:$otype = '7/asc/当前程序';break;
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuCM'){
			$sql = "update 表格顺序 set 海 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'OAFILE'){//文件收发
		if($falg == 'MenuO'){
			switch($order){
				case 案卷号:$otype = '1/asc/案卷号';break;
				case 专利名称:$otype = '2/asc/专利名称';break;
				case 类型:$otype = '3/asc/类型';break;
				case 案源人:$otype = '4/asc/案源人';break;
				case 代理人:$otype = '5/asc/代理人';break;
				case 文件名称:$otype = '6/asc/文件名称';break;
				case 上传时间【正】:$otype = '7/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '7/desc/上传时间【倒】';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){
			switch($order){
				case 案卷号:$otype = '0/asc/案卷号';break;
				case 专利名称:$otype = '1/asc/专利名称';break;
				case 类型:$otype = '2/asc/类型';break;
				case 案源人:$otype = '3/asc/案源人';break;
				case 代理人:$otype = '4/asc/代理人';break;
				case 文件名称:$otype = '5/asc/文件名称';break;
				case 上传时间【正】:$otype = '6/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '6/desc/上传时间【倒】';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuW'){
			switch($order){
				case 文件名前:$otype = '2/asc/文件名前';break;
				case 文件名后:$otype = '3/asc/文件名后';break;
				case 上传时间【正】:$otype = '4/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '4/desc/上传时间【倒】';break;
				case 上传人:$otype = '5/asc/文件名称';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件3 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuF'){
			switch($order){
				case 文件名前:$otype = '2/asc/文件名前';break;
				case 文件名后:$otype = '3/asc/文件名后';break;
				case 上传时间【正】:$otype = '4/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '4/desc/上传时间【倒】';break;
				case 发送人:$otype = '5/asc/发送人';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件4 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuFi'){
			switch($order){
				case 上传时间【正】:$otype = '3/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '3/desc/上传时间【倒】';break;
				case 上传人:$otype = '4/asc/上传人';break;
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件5 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuS'){
			switch($order){
				case 上传时间【正】:$otype = '3/asc/上传时间【正】';break;
				case 上传时间【倒】:$otype = '3/desc/上传时间【倒】';break;
				case 上传人:$otype = '4/asc/上传人';break;
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set OA文件6 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'OAEDM'){//快递收发
		switch($order){
			case 寄件人:$otype = '1/asc/寄件人';break;
			case 收件人:$otype = '2/asc/收件人';break;
			case 客户手机:$otype = '3/asc/客户手机';break;
			case 客户单位:$otype = '4/asc/客户单位';break;
			case 客户地址:$otype = '5/asc/客户地址';break;
			case 内品名称:$otype = '6/asc/内品名称';break;
			case 快递单号:$otype = '7/asc/快递单号';break;
			case 寄件时间【正】:$otype = '8/asc/寄件时间【正】';break;
			case 寄件时间【倒】:$otype = '8/desc/寄件时间【倒】';break;
			case 收件时间【正】:$otype = '8/asc/收件时间【正】';break;
			case 收件时间【倒】:$otype = '8/desc/收件时间【倒】';break;
			
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuO'){
			$sql = "update 表格顺序 set OA快递1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){
			$sql = "update 表格顺序 set OA快递2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'OACMARK'){//案件登记
		switch($order){
			case 接单日期【正】:$otype = '1/asc/接单日期【正】';break;
			case 接单日期【倒】:$otype = '1/desc/接单日期【倒】';break;
			case 案源人:$otype = '2/asc/案源人';break;
			case 客户姓名:$otype = '3/asc/客户姓名';break;
			case 接单内容:$otype = '4/asc/接单内容';break;
			case 代理人:$otype = '5/asc/代理人';break;
			case 处理情况:$otype = '6/asc/处理情况';break;
			case 收费情况:$otype = '7/asc/收费情况';break;
			case 预计完成日期【正】:$otype = '8/asc/预计完成日期【正】';break;
			case 预计完成日期【倒】:$otype = '8/desc/预计完成日期【倒】';break;
			
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuO'){
			$sql = "update 表格顺序 set OA案件1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){
			$sql = "update 表格顺序 set OA案件2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'ZLCost'){//专案其他费用
		switch($order){
			case 案卷号:$otype = '1/asc/案卷号';break;
			case 申请号【正】:$otype = '2/asc/申请号【正】';break;
			case 申请号【倒】:$otype = '2/desc/申请号【倒】';break;
			case 登记费:$otype = '4/asc/登记费';break;
			case 年费:$otype = '5/asc/年费';break;
			case 截止日期【正】:$otype = '6/asc/截止日期【正】';break;
			case 截止日期【倒】:$otype = '6/desc/截止日期【倒】';break;
			case 申请人:$otype = '7/asc/申请人';break;
			case 申请日【正】:$otype = '8/asc/申请日【正】';break;
			case 申请日【倒】:$otype = '8/desc/申请日【倒】';break;
			case 专利名称:$otype = '9/asc/专利名称';break;
			//缴费&&收据
			case 费用种类:$otype = '4/asc/费用种类';break;
			case 金额:$otype = '5/asc/金额';break;
			
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuO'){//待通知
			$sql = "update 表格顺序 set 费用1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){//已完成
			$sql = "update 表格顺序 set 费用4 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuW'){//待缴费
			$sql = "update 表格顺序 set 费用2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuF'){//待收据
			$sql = "update 表格顺序 set 费用3 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'YEARC'){//专案年费
		switch($order){
			case 案卷号:$otype = '1/asc/案卷号';break;
			case 专利名:$otype = '2/asc/专利名';break;
			case 申请人:$otype = '4/asc/申请人';break;
			case 申请号【正】:$otype = '5/asc/申请号【正】';break;
			case 申请号【倒】:$otype = '5/desc/申请号【倒】';break;
			case 申请日【正】:$otype = '6/asc/申请日【正】';break;
			case 申请日【倒】:$otype = '6/desc/申请日【倒】';break;
			case 年度		:$otype = '7/asc/年度';break;
			case 金额		:$otype = '8/asc/金额';break;
			case 截止日期【正】:$otype = '9/asc/截止日期【正】';break;
			case 截止日期【倒】:$otype = '9/desc/截止日期【倒】';break;
			case 剩余天数【正】:$otype = '10/asc/剩余天数【正】';break;
			case 剩余天数【倒】:$otype = '10/desc/剩余天数【倒】';break;
			case 通知时间【正】:$otype = '11/asc/通知时间【正】';break;
			case 通知时间【倒】:$otype = '11/desc/通知时间【倒】';break;
			case 缴费时间【正】:$otype = '12/asc/缴费时间【正】';break;
			case 缴费时间【倒】:$otype = '12/desc/缴费时间【倒】';break;
			case 收据时间【正】:$otype = '13/asc/收据时间【正】';break;
			case 收据时间【倒】:$otype = '13/desc/收据时间【倒】';break;
			
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuO'){	   //待通知
			$sql = "update 表格顺序 set 年费1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){//待缴费
			$sql = "update 表格顺序 set 年费2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuW'){//待收据
			$sql = "update 表格顺序 set 年费3 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuF'){//已完成
			switch($order){
				case 通知时间【正】:$otype = '9/asc/通知时间【正】';break;
				case 通知时间【倒】:$otype = '9/desc/通知时间【倒】';break;
				case 缴费时间【正】:$otype = '10/asc/缴费时间【正】';break;
				case 缴费时间【倒】:$otype = '10/desc/缴费时间【倒】';break;
				case 收据时间【正】:$otype = '11/asc/收据时间【正】';break;
				case 收据时间【倒】:$otype = '11/desc/收据时间【倒】';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set 年费4 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuZ'){//总查询
			$sql = "update 表格顺序 set 年费5 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}else if($page == 'FARECON'){//财务管理
		switch($order){
			case 客户名称:$otype = '0/asc/客户名称';break;
			case 总费用【正】:$otype = '1/asc/总费用【正】';break;
			case 总费用【倒】:$otype = '1/desc/总费用【倒】';break;
			case 规费【正】:$otype = '2/asc/规费【正】';break;
			case 规费【倒】:$otype = '2/desc/规费【倒】';break;
			case 管理费【正】:$otype = '3/asc/管理费【正】';break;
			case 管理费【倒】:$otype = '3/desc/管理费【倒】';break;
			case 税费【正】:$otype = '4/asc/税费【正】';break;
			case 税费【倒】:$otype = '4/desc/税费【倒】';break;
			case 收费方式:$otype = '5/asc/收费方式';break;
			case 收费日期【正】:$otype = '6/asc/收费日期【正】';break;
			case 收费日期【倒】:$otype = '6/desc/收费日期【倒】';break;
			case 案源人:$otype = '7/asc/案源人';break;
			
			default：exit('出现错误，请联系管理员');
		}
		if($falg == 'MenuO'){//收入记录
			$sql = "update 表格顺序 set 财务1 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuT'){//支出记录
			switch($order){
				case 支出项目:$otype = '0/asc/支出项目';break;
				case 金额【正】:$otype = '1/asc/金额【正】';break;
				case 金额【倒】:$otype = '1/desc/金额【倒】';break;
				case 支付方式:$otype = '2/asc/支付方式';break;
				case 支出日期【正】:$otype = '3/asc/支出日期【正】';break;
				case 支出日期【倒】:$otype = '3/desc/支出日期【倒】';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set 财务2 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else if($falg == 'MenuW'){//每月统计
			switch($order){
				case 年月:$otype = '0/asc/年月';break;
				case 总收费【正】:$otype = '1/asc/总收费【正】';break;
				case 总收费【倒】:$otype = '1/desc/总收费【倒】';break;
				case 规费【正】:$otype = '2/asc/规费【正】';break;
				case 规费【倒】:$otype = '2/desc/规费【倒】';break;
				case 管理费【正】:$otype = '3/asc/管理费【正】';break;
				case 管理费【倒】:$otype = '3/desc/管理费【倒】';break;
				case 税费【正】:$otype = '4/asc/税费【正】';break;
				case 税费【倒】:$otype = '4/desc/税费【倒】';break;
				case 支出金额【正】:$otype = '5/asc/支出金额【正】';break;
				case 支出金额【倒】:$otype = '5/desc/支出金额【倒】';break;
				case 本月利润【正】:$otype = '6/asc/本月利润【正】';break;
				case 本月利润【倒】:$otype = '6/desc/本月利润【倒】';break;
				case 期初结存【正】:$otype = '7/asc/期初结存【正】';break;
				case 期初结存【倒】:$otype = '7/desc/期初结存【倒】';break;
				case 本月结存【正】:$otype = '8/asc/本月结存【正】';break;
				case 本月结存【倒】:$otype = '8/desc/本月结存【倒】';break;
				
				default：exit('出现错误，请联系管理员');
			}
			$sql = "update 表格顺序 set 财务3 = '".$otype."' where 用户id = '".$czyid."' ";
			$result = $conn->query($sql);
		}else{
			exit('出现错误，请联系管理员');
		}
	}
	
	$conn->close();
?>