<?php
/*
 * 用于申成年费的类
 * 1.费减比例的期限为：10年
 * 2.仅生成未过期的年费
 * */
class CreateAnnualFee{
	protected $database_conn;//数据库: $conn
	public $date_of_application; //案件的申请日
	public $first_year; //案件的首年度
	public $cost_reduction_ratio; //年费的费减比：70%，85%，100%
	public $patent_type; //专利类型：发明专利，实用新型，外观设计
	public $created_AnnualFee; //根据条件查询数据库获取的费用列表
	public $overdue_fine;//滞纳金列表
	protected $finished_data; //组合后的数据：年费记录+滞纳金
	protected $useful_yearnumber = 10;//费减比例有效年长
	
	/*
	 * @param Object $database_conn 数据库对象
	 * @param string $date_of_application 申请日
	 * @param string $first_year 首年度
	 * @param string $cost_reduction_ratio 年费费减比
	 * @param string $patent_type 案件类型
	 * */
	public function __construct($database_conn,$date_of_application,$first_year='1',$cost_reduction_ratio='85%',$patent_type='发明专利'){
		$this->database_conn = $database_conn;
		$this->date_of_application = $date_of_application;
		$this->first_year = $first_year;
		$this->cost_reduction_ratio = $cost_reduction_ratio;
		$this->patent_type = $patent_type;
	}
	
	/*改变申请日申成日期监控
	 * $y：变化的年数(-10,0,10,100.....)
	 * $m:	变化的月数（-12~12）
	 * $d：变化的天数（-15,15,20,30....)
	*/
	protected function Set_Date($y,$m,$d){
		$str = $y."years,".$m."months,".$d."days";
		return date("Y-m-d",strtotime($str,strtotime($this->date_of_application)));
	}
	
	/*
	 * 确保费减比例一定是：70%,85%,100%
	 * */
	protected function Confirm_cost_reduction_ratio(){
		$tmp_arr = array("70%","85%","100%");
		if(!in_array($this->cost_reduction_ratio, $tmp_arr)){
			$this->cost_reduction_ratio = "85%";
		}
	}
	
	/*
	 * 确保专利类型一定为：发明专利，实用新型，外观设计
	 * */
	protected function Confirm_patent_type(){
		$tmp_arr = array("发明专利","实用新型","外观设计");
		if(!in_array($this->patent_type, $tmp_arr)){
			$this->patent_type = "发明专利";
		}
	}
	
	/*
	 * 根据条件获取相应的年费列表
	 * */
	protected function Create_Annualfee_data(){
		switch($this->cost_reduction_ratio){
			case "100%":
				//费减比为100%，就是没有费减比，查询`年费设置`表获取数据
				$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$this->patent_type."' AND 年费费减比例='".$this->cost_reduction_ratio."' AND 年度>".$this->first_year." ORDER BY 年度";
				$result = $this->database_conn->query($sql);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()){
						$nowdate = date("Y-m-d");
						$end_date = $this->Set_Date($row['年度']-1,1,0);
						$remind_date = $this->Set_Date($row['年度']-1,-1,0);
						if($end_date > $nowdate){
							$this->created_AnnualFee[$row['年度']]['年度'] = $row['年度'];
							$this->created_AnnualFee[$row['年度']]['金额'] = $row['金额'];
							$this->created_AnnualFee[$row['年度']]['截止日期'] = $end_date;
							$this->created_AnnualFee[$row['年度']]['提醒日期'] = $remind_date;
						}
					}
				}
				
				break;
			default:
				//有费减比（70%，85%），目前是首年度及后10年均能使用费减比
				//先获取有费减比的年费记录
				$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$this->patent_type."' AND 年费费减比例='".$this->cost_reduction_ratio."' AND 年度>".$this->first_year." AND 年度<".($this->first_year+$this->useful_yearnumber)." ORDER BY 年度";
				$result = $this->database_conn->query($sql);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()){
						$nowdate = date("Y-m-d");
						$end_date = $this->Set_Date($row['年度']-1,1,0);
						$remind_date = $this->Set_Date($row['年度']-1,-1,0);
						if($end_date > $nowdate){
							$this->created_AnnualFee[$row['年度']]['年度'] = $row['年度'];
							$this->created_AnnualFee[$row['年度']]['金额'] = $row['金额'];
							$this->created_AnnualFee[$row['年度']]['截止日期'] = $end_date;
							$this->created_AnnualFee[$row['年度']]['提醒日期'] = $remind_date;
						}
					}
				}
				//再获取没有费减比的年费记录
				$sql2 = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$this->patent_type."' AND 年费费减比例='100%' AND 年度>=".($this->first_year+$this->useful_yearnumber)." ORDER BY 年度 ";
				$result2 = $this->database_conn->query($sql2);
				if($result2->num_rows>0){
					while($row2 = $result2->fetch_assoc()){
						$nowdate = date("Y-m-d");
						$end_date = $this->Set_Date($row2['年度']-1,1,0);
						$remind_date = $this->Set_Date($row2['年度']-1,-1,0);
						if($end_date > $nowdate){
							$this->created_AnnualFee[$row2['年度']]['年度'] = $row2['年度'];
							$this->created_AnnualFee[$row2['年度']]['金额'] = $row2['金额'];
							$this->created_AnnualFee[$row2['年度']]['截止日期'] = $end_date;
							$this->created_AnnualFee[$row2['年度']]['提醒日期'] = $remind_date;
						}
					}
				}
		}
	}
	
	/*
	 * 生成滞纳金列表
	 * */
	protected function Create_OverdueFine(){
		$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$this->patent_type."' AND 年费费减比例='100%' ORDER BY 年度";
		$result = $this->database_conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$this->overdue_fine[$row['年度']][0] = floatval($row['金额'])*0.05;
				$this->overdue_fine[$row['年度']][1] = floatval($row['金额'])*0.1;
				$this->overdue_fine[$row['年度']][2] = floatval($row['金额'])*0.15;
				$this->overdue_fine[$row['年度']][3] = floatval($row['金额'])*0.2;
				$this->overdue_fine[$row['年度']][4] = floatval($row['金额'])*0.25;
			}
		}
	}
	
	/*
	 * 合并年费记录+滞纳金
	 * */
	protected function MergeData(){
		foreach($this->created_AnnualFee as $ky => $infodata){
			$this->finished_data[$ky] = $infodata;
			$this->finished_data[$ky]["滞纳金"] = $this->overdue_fine[$ky];
		}
	}
	
	/*
	 * 返回数据
	 * 格式如下：
	 *     [5] => Array
        (
            [年度] => 5
            [金额] => 360
            [截止日期] => 2019-07-03
            [提醒日期] => 2019-05-03
            [滞纳金] => Array
                (
                    [0] => 60
                    [1] => 120
                    [2] => 180
                    [3] => 240
                    [4] => 300
                )

        )
	 * */
	public function GetAnnualFeeDate(){
		
		$this->Confirm_cost_reduction_ratio();//保证费减比例正确
		$this->Confirm_patent_type();//保证案件类型正确
		
		$this->Create_Annualfee_data();//获取年费
		$this->Create_OverdueFine();//获取滞纳金
		
		if(!empty($this->created_AnnualFee)){
			$this->MergeData();//合并年费+滞纳金
		}
		return $this->finished_data;
	}
}

//require_once "../conn.php";
//$annualfee = new CreateAnnualFee($conn,"2015-6-3","2","100%","实用新型");
//$redata = $annualfee->GetAnnualFeeDate();
//print_r($redata);



?>