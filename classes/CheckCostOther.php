<?php
/*
 * 查询表“专案需交费”拼上“专利信息”+“专案_年费”+“专案_复审等”
 * */
 
class CheckCostOther {
	protected $database;//数据库句柄
	protected $query_sqlstatement;//执行的语句
	//案件信息的查询语句
	protected $sqlstatement_case = array(
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9';",
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9';",
		"SELECT 案卷号,专利名称,申请人,申请人id,申请号,申请日 FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9';"
	);
	public $sqldata_case;//案件信息的数据
	
	public $sqldata_count = 0;//返回数据的键值
	public $sqldata_return = array();//组合的总数据
	
	public function __construct($db,$sql){
		$this->database = $db;
		$this->query_sqlstatement = $sql;
	}
	
	/*
	 * 获取案件信息
	 * */
	protected function GetCaseData(){
		$len_arr = count($this->sqlstatement_case);
		for($i=0;$i<$len_arr;$i++){
			$result = $this->database->query($this->sqlstatement_case[$i]);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$this->sqldata_case[$row["案卷号"]] = $row;
				}
			}
		}
	}
	
	/*
	 * 获取“专利需交费用”的信息+“案件”的信息
	 * */
	protected function SettleAllData(){
		$result = $this->database->query($this->query_sqlstatement);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$tempdata = "";
				if(array_key_exists($row["案卷号"], $this->sqldata_case)){
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
		$this->SettleAllData();
	}
	
}

//require('../conn.php');
//
//$sql = "SELECT id,案卷号,费用名称,金额,提醒时间,缴费期限,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE 费用来源='1' AND 状态='1'";
//$getdata = new CheckCostOther($conn,$sql);
//$getdata->UsingClass();
//print_r($getdata->sqldata_return);

?>