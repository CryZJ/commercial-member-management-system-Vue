<?php
/*
 * 提醒界面的费用信息，少于10天的
 * 
 * */
 
class RemindFeeData {
	protected $database;//数据库句柄
	//案件信息的查询语句
	protected $sqlstatement_case = array(
		"SELECT CONCAT(案卷号,'zlxx') AS 案卷号,专利名称,类型,申请人,申请号,申请日,案源人,代理人 FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9' AND  NOT ISNULL(申请日);",
		"SELECT CONCAT(案卷号,'zanf') AS 案卷号,专利名称,类型,申请人,申请号,申请日,案源人,代理人 FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9' AND  NOT ISNULL(申请日);",
		"SELECT CONCAT(案卷号,'zafs') AS 案卷号,专利名称,类型,申请人,申请号,申请日,案源人,代理人 FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9' AND  NOT ISNULL(申请日);"
	);
	public $sqldata_case;//案件信息的数据
	
	public $sqldata_count = 0;//返回数据的键值
	public $sqldata_return;//组合的总数据
	
	public function __construct($db){
		$this->database = $db;
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
	 * 专案需交费用
	 * */
	protected function GetNeedFee(){
		$sql = "SELECT id,案卷号,费用名称,年度,金额,提醒时间,缴费期限 AS 截止时间,DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案需交费用 WHERE (状态='0' OR 状态='1' OR 状态='8') AND DATEDIFF(缴费期限,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='10' ORDER BY 案卷号;";
		$result = $this->database->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$tempdata = "";
				$new_ajh=substr($row["案卷号"],0,-4);
				if(isset($this->sqldata_case[$new_ajh])){
					$tempdata = array_merge($row,$this->sqldata_case[$new_ajh]);
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
		$sql = "SELECT id,CONCAT(案卷号,'zanf') AS 案卷号,'年费' AS 费用名称,年度,金额,提醒日期 AS 提醒时间,应缴日期 AS 截止时间,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算日期 FROM 专案_年费记录 WHERE DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))<='10' AND (状态='0' OR 状态='8') ORDER BY 案卷号;";
		$result = $this->database->query($sql);
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
//
//$getdata = new RemindFeeData($conn);
//$getdata->UsingClass();
//print_r($getdata->sqldata_return);

?>