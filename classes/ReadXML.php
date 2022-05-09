<?php
/*
 * 用于获取zip文件里面的list.xml及其他xml文件信息
 * */

class ReadXML {
	protected $File_path;//zip的文件路径
	protected $ListXml_arr;
	protected $ListXml_arr_2;//受理通知书会有两个list.xml文件
	protected $OtherXml_arr;
	protected $OtherXml_arr_2;//受理通知书会有两个其他xml文件
	protected $retlistdata;
	protected $retotherdata;
	protected $settledata;//返回整理好的数组数据
	
	public function __construct($path){
		$this->File_path = $path;
		
		//返回list信息的初始化
		$this->retlistdata["专利名称"] = "";
		$this->retlistdata["申请号"] = "";
		$this->retlistdata["发文日"] = "";
		$this->retlistdata["通知书名称"] = "";
		$this->retlistdata["通知书编码"] = "";
		$this->retlistdata["案卷号"] = "";
		$this->retlistdata["申请日"] = "";
		
		//返回其他xml信息的初始化
		$this->retotherdata["通知书名称"] = "";
		$this->retotherdata["发文日"] = "";
		$this->retotherdata["申请号"] = "";
		$this->retotherdata["专利名称"] = "";
		$this->retotherdata["缴费截止日期"] = "";
		$this->retotherdata["费用信息"] = "";
		$this->retotherdata["年费年度"] = "";
		$this->retotherdata["年费费减比例"] = "100%";
		$this->retotherdata["通知书编码"] = "";
	}
	
	/*
	 * 判断zip文件是否存在
	 * */
	protected function Is_Exists(){
		if(!file_exists($this->File_path)){
			$this->File_path = iconv("UTF-8", "GBK", $this->File_path);
			return file_exists($this->File_path);
		}else{
			return TRUE;
		}
	} 
	
	
	/*将对象转化为数组*/
	protected function ObjectToArray($e){
	    $e=(array)$e;
	    foreach($e as $k=>$v){
	        if( gettype($v)=='resource' ) return;
	        if( gettype($v)=='object' || gettype($v)=='array' )
	            $e[$k]=(array)$this->ObjectToArray($v);
	    }
	    return $e;
	}
	
	/*获取文件后缀*/
	protected function Get_suffix($name){
		$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION ));
		return $ext;
	}
	
	/*将字符串xxxxxxx转化为日期xxxx-xx-xx*/
	protected function StoD($str){
		$da = date("Y-m-d",strtotime($str));
		return $da;
	}
	
	/*
	 * 获取“通知书编码”的前六位
	 * */
	protected function Get_before_six($str){
		return substr($str, 0,6);
	}	
	
	/*
	 * 获取年费的费减比例一定为：70%，85%，100%
	 * */
	protected function Get_Settle_cost_slow_flag($str){
		if(!empty($str)){
			$str = substr($str, 0,2);
			switch($str){
				case "70" :
					return "70%";
					break;
				case "85" :
					return "85%";
					break;
				default :
					if($str == "10"){
						return "100%";
					}else{
						return $str."%";
					}
			}
		}else{
			return "100%";
		}
		
	}
	
	/*
	 * 获取ListXml_arr、ListXml_arr_2、OtherXml_arr、OtherXml_arr_2
	 * */
	protected function GetXmlArray(){
		$resource = zip_open($this->File_path);//获取文件句柄
		$justone_list = TRUE;//其他的xml文件只读取一个
		$justone_other = TRUE;//其他的xml文件只读取一个
		while ($dir_resource = zip_read($resource)){
			if(zip_entry_open($resource,$dir_resource)){
				$file_name = zip_entry_name($dir_resource);//文件路径
				$basename = pathinfo($file_name,PATHINFO_BASENAME);//获取文件名称
				$ext = $this->Get_suffix($basename);//获取文件的后缀：xml
				
				//获取list.xml的信息转为数组
				if($ext=='xml' and $basename == 'list.xml'){
					if($justone_list){
						$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
						$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
						$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
						$this->ListXml_arr = $this->ObjectToArray($xml_obj);//将对象转化为数组
						$justone_list = FALSE;
					}else{
						$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
						$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
						$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
						$this->ListXml_arr_2 = $this->ObjectToArray($xml_obj);//将对象转化为数组
						$justone_list = TRUE;
					}
				}
				
				//获取其他的xml文件的信息
				if($ext=='xml' and $basename!='list.xml'){
					if($justone_other){
						$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
						$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
						$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
						$this->OtherXml_arr = $this->ObjectToArray($xml_obj);//将对象转化为数组
						$justone_other = FALSE;
					}else{
						$file_size = zip_entry_filesize($dir_resource);//获取xml文件的大小
						$file_put_contents = zip_entry_read($dir_resource,$file_size);//读取xml文件为字符串
						$xml_obj = simplexml_load_string($file_put_contents);//将读取的字符串转化为对象
						$this->OtherXml_arr_2 = $this->ObjectToArray($xml_obj);//将对象转化为数组
						$justone_other = TRUE;
					}
				}
			}
		}
	}
	
	
	
	/*
	 * 处理list的数据信息
	 * */
	protected function SettleListData(){
		if(isset($this->ListXml_arr)){
			if(isset($this->ListXml_arr["TONGZHISXJ"]["SHUXINGXX"])){
				$tmpdata = $this->ListXml_arr["TONGZHISXJ"]["SHUXINGXX"];
				
				$this->retlistdata["专利名称"] = isset($tmpdata["FAMINGMC"]) ? $tmpdata["FAMINGMC"] : "";
				$this->retlistdata["申请号"] = isset($tmpdata["SHENQINGH"]) ? $tmpdata["SHENQINGH"] : "";
				$this->retlistdata["发文日"] = isset($tmpdata["FAWENR"]) ? $this->StoD($tmpdata["FAWENR"]) : "";
				
				if(isset($this->ListXml_arr_2)){//受理通知书的特殊情况
					if(isset($this->ListXml_arr_2["TONGZHISXJ"]["SHUXINGXX"])){
						$tmpdata_2 = $this->ListXml_arr_2["TONGZHISXJ"]["SHUXINGXX"];
						if(isset($tmpdata_2["TONGZHISMC"]) && isset($tmpdata_2["TONGZHISBM"])){
							if($tmpdata_2["TONGZHISMC"] == "费用减缓审批通知书"){
								$this->retlistdata["通知书名称"] = isset($tmpdata["TONGZHISMC"]) ? $tmpdata["TONGZHISMC"].",".$tmpdata_2["TONGZHISMC"] : "";
								$this->retlistdata["通知书编码"] = isset($tmpdata["TONGZHISBM"]) ? $this->Get_before_six($tmpdata["TONGZHISBM"])."," .$this->Get_before_six($tmpdata_2["TONGZHISBM"]): "";
							}else{
								$this->retlistdata["通知书名称"] = isset($tmpdata["TONGZHISMC"]) ? $tmpdata_2["TONGZHISMC"].",".$tmpdata["TONGZHISMC"]: "";
								$this->retlistdata["通知书编码"] = isset($tmpdata["TONGZHISBM"]) ? $this->Get_before_six($tmpdata_2["TONGZHISBM"])."," .$this->Get_before_six($tmpdata["TONGZHISBM"]): "";
							}
						}
					}
				}else{
					$this->retlistdata["通知书名称"] = isset($tmpdata["TONGZHISMC"]) ? $tmpdata["TONGZHISMC"] : "";
					$this->retlistdata["通知书编码"] = isset($tmpdata["TONGZHISBM"]) ? $this->Get_before_six($tmpdata["TONGZHISBM"]) : "";
				}
				
				$this->retlistdata["案卷号"] = isset($tmpdata["NEIBUBH"]) ? $tmpdata["NEIBUBH"] : "";
				$this->retlistdata["申请日"] = isset($tmpdata["SHENQINGR"]) ? $this->StoD($tmpdata["SHENQINGR"]) : "";
			}
		}
	}
	
	/*
	 * 处理其他xml文件的信息
	 * */
	protected function SettleOtherData(){
		if(isset($this->OtherXml_arr)){
			$this->retotherdata["通知书名称"] = isset($this->OtherXml_arr["notice_name"]) ? $this->OtherXml_arr["notice_name"] : "";
			$this->retotherdata["发文日"] = isset($this->OtherXml_arr["notice_sent"]["notice_sent_date"]) ? $this->StoD($this->OtherXml_arr["notice_sent"]["notice_sent_date"]) : "";
			$this->retotherdata["申请号"] = isset($this->OtherXml_arr["application_number"]) ? $this->OtherXml_arr["application_number"] : "";
			$this->retotherdata["专利名称"] = isset($this->OtherXml_arr["invention_title"]) ? $this->OtherXml_arr["invention_title"] : "";
			$this->retotherdata["缴费截止日期"] = isset($this->OtherXml_arr["pay_deadline_date"]) ? $this->StoD($this->OtherXml_arr["pay_deadline_date"]) : "";
			$this->retotherdata["费用信息"] = isset($this->OtherXml_arr["fee_info_all"]["fee_info"]["fee"]) ? $this->OtherXml_arr["fee_info_all"]["fee_info"]["fee"] : "";
			$this->retotherdata["年费年度"] = isset($this->OtherXml_arr["fee_info_all"]["annual_year"]) ? $this->OtherXml_arr["fee_info_all"]["annual_year"] : "";
			$this->retotherdata["年费费减比例"] = isset($this->OtherXml_arr["fee_info_all"]["cost_slow_flag"]) ? $this->Get_Settle_cost_slow_flag($this->OtherXml_arr["fee_info_all"]["cost_slow_flag"]) : "100%";
			$this->retotherdata["通知书编码"] = isset($this->OtherXml_arr["notice_template_code"]) ? $this->Get_before_six($this->OtherXml_arr["notice_template_code"]) : "";
		}
	}
	
	/*
	 * 获取费用信息
	 * */
	protected function Getfeeinfo($feedata){
		//费用信息
		if(isset($feedata)){
			$this->settledata["费用信息"] = "";
			$totalfee = 0;
			$i = 0;
			foreach($feedata as $ky => $feeinfo){
				if($feeinfo["fee_amount"] != 0 && strtolower(gettype($feeinfo["fee_amount"])) != "array"){
					if(isset($feeinfo["fee_name"])){
						$this->settledata["费用信息"][$i]["费用名称"] = $feeinfo["fee_name"];
						$this->settledata["费用信息"][$i]["金额"] = $feeinfo["fee_amount"];
						$totalfee = $totalfee+$feeinfo["fee_amount"];
						$i++;
					}
				}
			}
			$this->settledata["总金额"] = $totalfee;
		}
	}
	
	/*
	 * 处理“费用减缓审批通知书”
	 * */
	protected function CostSlow(){
		$tmpdata = "";
		if(isset($this->OtherXml_arr["notice_name"])){
			if($this->OtherXml_arr["notice_name"] == "费用减缓审批通知书"){
				$tmpdata = $this->OtherXml_arr;
			}else{
				if(isset($this->OtherXml_arr_2["notice_name"])){
					if($this->OtherXml_arr_2["notice_name"] == "费用减缓审批通知书"){
						$tmpdata = $this->OtherXml_arr_2;
					}
				}
			}
		}
		if(!empty($tmpdata)){
			$this->settledata["缴费截止日期"] = isset($tmpdata["pay_deadline_date"]) ? $this->StoD($tmpdata["pay_deadline_date"]) : "";
			$this->settledata["年费费减比例"] = isset($tmpdata["cost_slow_rate_annul"]) ? $this->Get_Settle_cost_slow_flag($tmpdata["cost_slow_rate_annul"]) : "100%";
			$this->settledata["复审费减比例"] = isset($tmpdata["cost_slow_rate_review"]) ? $this->Get_Settle_cost_slow_flag($tmpdata["cost_slow_rate_review"]) : "100%";
			//获取费用信息
			if(isset($tmpdata["fee_info_all"]["fee_info"]["fee"])){
				$this->Getfeeinfo($tmpdata["fee_info_all"]["fee_info"]["fee"]);
			}
		}
		
	}
	
	/*
	 * 处理“办理登记手续通知书”的费用
	 * */
	protected function Authorization(){
		if(isset($this->OtherXml_arr)){
			$this->settledata["缴费截止日期"] = isset($this->OtherXml_arr["pay_deadline_date"]) ? $this->StoD($this->OtherXml_arr["pay_deadline_date"]) : "";
			$this->settledata["年费年度"] = isset($this->OtherXml_arr["fee_info_all"]["annual_year"]) ? $this->OtherXml_arr["fee_info_all"]["annual_year"] : "";
			$this->settledata["年费费减比例"] = isset($this->OtherXml_arr["fee_info_all"]["cost_slow_flag"]) ? $this->Get_Settle_cost_slow_flag($this->OtherXml_arr["fee_info_all"]["cost_slow_flag"]) : "100%";
			//获取费用信息
			if(isset($this->OtherXml_arr["fee_info_all"]["fee_info"]["fee"])){
				$this->Getfeeinfo($this->OtherXml_arr["fee_info_all"]["fee_info"]["fee"]);
			}
			
		}
	}
	
	/*
	 * 处理“缴费通知书”的滞纳金费用信息
	 * */
	protected function Overdue(){
		if(isset($this->OtherXml_arr)){
			$this->settledata["缴费截止日期"] = isset($this->OtherXml_arr["pay_deadline_date"]) ? $this->StoD($this->OtherXml_arr["pay_deadline_date"]) : "";
			$this->settledata["年费年度"] = isset($this->OtherXml_arr["annual_year"]) ? $this->OtherXml_arr["annual_year"] : "";
			
			$this->settledata["滞纳金信息"] = "";
			//滞纳金信息
			if(isset($this->OtherXml_arr["fee_info"]["fee"])){
				$i = 0;	
				foreach($this->OtherXml_arr["fee_info"]["fee"] as $ky =>$feeinfo){
					$this->settledata["滞纳金信息"][$ky]["开始时间"] = isset($feeinfo["pay_start_time"]) ? $this->StoD($feeinfo["pay_start_time"]) : "";
					$this->settledata["滞纳金信息"][$ky]["截止时间"] = isset($feeinfo["pay_end_time"]) ? $this->StoD($feeinfo["pay_end_time"]) : "";
					$this->settledata["滞纳金信息"][$ky]["年费"] = isset($feeinfo["annual_fee"]) ? $feeinfo["annual_fee"] : 0;
					$this->settledata["滞纳金信息"][$ky]["滞纳金金额"] = isset($feeinfo["late_fee"]) ? $feeinfo["late_fee"] : 0;
					$this->settledata["滞纳金信息"][$ky]["应缴金额"] = isset($feeinfo["totle_fee"]) ? $feeinfo["totle_fee"] : 0;
				}
			}
		}
	}
	
	/*
	 * 使用方法
	 * */
	public function GetXmlDataToArray(){
		if($this->Is_Exists()){
			$this->GetXmlArray();//获取ListXml_arr、ListXml_arr_2、OtherXml_arr、OtherXml_arr_2
			
			$this->SettleListData();//获取整理后的list.xml的信息 retlistdata
			if(isset($this->retlistdata)){
				print_r($this->retlistdata);
				//用通知书编码去判断返回其他xml数据的方法:【200101】(专利申请受理通知书)，【200101,200021】(专利申请受理通知书,费用减缓审批通知书)，【200602】(办理登记手续通知书)，【200701】(缴费通知书)，【200702】(专利权终止通知书)
				$this->settledata = $this->retlistdata;
				switch($this->retlistdata["通知书编码"]){
					case "200101":
//						$this->settledata = $this->retlistdata;
						break;
					case "200101,200021":
						$this->CostSlow();
						break;
					case "200602":
						$this->Authorization();
						break;
					case "200701":
						$this->Overdue();
						break;
					case "200702":
						
						break;
					default :
						
						break;
				}
				return $this->settledata;
			}
			
		}else{
			exit("文件不存在");
		}
	}
	
}
//$path = '05755aR1aR(通知书).zip';//受理通知书
//$path = '05770aV3bF（刘）.zip';//办理登记手续通知书
//$path = '801.zip';//缴费通知书
//$path = '801-termination.zip';//权利终止通知书
//$getxmldata = new ReadXML($path);
//$getdata = $getxmldata->GetXmlDataToArray();
//print_r($getdata);
?>