<?php
/*
 * 用于案件详情中的费用查看
 * */

class GetTotalCostData{
	protected $conn;
	protected $ajh;
	protected $query_sqlstatement = array();//执行的语句
	//案件信息的查询语句
	protected $sqlstatement_case = array(
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9';",
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9';",
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9';"
	);
	public $sqldata_case;//案件信息的数据
	
	public $sqldata_count = 0;//返回数据的键值
	public $sqldata_return;//组合的总数据
	
	
	public function __construct($db,$ajh,$sql_need,$sql_year){
		$this->conn = $db;
		$this->ajh = $ajh;
		$this->query_sqlstatement[0] = $sql_need;
		$this->query_sqlstatement[1] = $sql_year; 
	}
	
	/*
	 * 获取案件信息
	 * */
	protected function GetCaseData(){
		$len_arr = count($this->sqlstatement_case);
		for($i=0;$i<$len_arr;$i++){
			$result = $this->conn->query($this->sqlstatement_case[$i]);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$this->sqldata_case[$row["案卷号"]] = $row;
				}
			}
		}
	}
	
	/*
	 * 专案需交费用
	 * */
	protected function GetNeedFee(){
//		$sql = "SELECT id,案卷号,费用名称,年度,金额,提醒时间,缴费期限 AS 截止时间 FROM 专案需交费用 WHERE (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') AND 案卷号='".$this->ajh."'  ORDER BY 案卷号;";
		$result = $this->conn->query($this->query_sqlstatement[0]);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$tempdata = "";
				if(isset($this->sqldata_case[$row["案卷号"]])){
					$tempdata = array_merge($row,$this->sqldata_case[$row["案卷号"]]);
					$this->sqldata_return[$this->sqldata_count] = $tempdata;
					
					$this->sqldata_count++;
				}
			}
		}
	}
	
	/*
	 * 年费
	 * */
	protected function GetAnnualFee(){
//		$sql = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,提醒日期 AS 提醒时间,应缴日期 AS 截止时间 FROM 专案_年费记录 WHERE 案卷号='".$this->ajh."' AND (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') ORDER BY 案卷号;";
		$result = $this->conn->query($this->query_sqlstatement[1]);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$tempdata = "";
				if(isset($this->sqldata_case[$row["案卷号"]])){
					$tempdata = array_merge($row,$this->sqldata_case[$row["案卷号"]]);
					$this->sqldata_return[$this->sqldata_count] = $tempdata;
					
					$this->sqldata_count++;
				}
			}
		}
	}
	
		/*
	 * 使用
	 * */
	public function UsingClass(){
		$this->GetCaseData();
		$this->GetNeedFee();
		$this->GetAnnualFee();
	}
}

//require('../conn.php');
//$ajh = "0404700200";
//$sql_need = "SELECT id,案卷号,费用名称,年度,金额,提醒时间,缴费期限 AS 截止时间 FROM 专案需交费用 WHERE (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') AND 案卷号='".$ajh."'  ORDER BY 案卷号;";
//$sql_year = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,提醒日期 AS 提醒时间,应缴日期 AS 截止时间 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') ORDER BY 案卷号;";
//$getdata = new GetTotalCostData($conn,$ajh,$sql_need,$sql_year);
//$getdata->UsingClass();
//print_r($getdata->sqldata_return); 

?>