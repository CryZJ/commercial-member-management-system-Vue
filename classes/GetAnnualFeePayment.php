<?php
/*
 * 
 * 用于年费的缴费显示，专案_年费记录 与 滞纳金列表
 * */
 
class GetAnnualFeePayment{
	protected $database;//数据库句柄
	//案件信息的查询语句
	protected $sqlstatement_case = array(
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9'   AND  NOT ISNULL(申请日);",
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9'   AND  NOT ISNULL(申请日);",
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9'  AND  NOT ISNULL(申请日);"
	);
	protected $costid = "";//年费id
	public $sqldata_case;//案件信息的数据
	protected $sqlstatement_annualfee;//年费查询语句
	public $sqldata_annualfee = array();//年费信息+案件信息
	
	public function __construct($db,$sql_annualfee,$idstr){
		$this->database = $db;
		$this->sqlstatement_annualfee = $sql_annualfee;
		$this->costid = $idstr;
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
	 * 获取滞纳金信息
	 * */
	protected function GetZJHData($ajh,$yearnum){
		$nowdate = date("Y-m-d");
		$sql = "SELECT 滞纳金 FROM 滞纳金列表 WHERE 案卷号='".$ajh."' AND 年度='".$yearnum."' AND 开始时间<'".$nowdate."' AND 截止时间>'".$nowdate."' ";
		$result = $this->database->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				return $row[0];
			}
		}else{
			return 0;
		}
		
	}
	
	/*
	 * 获取“年费”的信息+“案件”的信息
	 * */
	protected function GetAnnualFeeData(){
		$result = $this->database->query($this->sqlstatement_annualfee);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$tempdata = "";
				if(isset($this->sqldata_case[$row["案卷号"]])){
					$tempdata = array_merge($row,$this->sqldata_case[$row["案卷号"]]);
					$this->sqldata_annualfee[$row["id"]] = $tempdata;
					if(!empty($row["滞纳金"])){//如果表【专案_年费记录】有滞纳金，就不必去表【滞纳金列表查询】
						$this->sqldata_annualfee[$row["id"]]["滞纳金"] = $row["滞纳金"];
					}else{
						$this->sqldata_annualfee[$row["id"]]["滞纳金"] = $this->GetZJHData($this->sqldata_annualfee[$row["id"]]["案卷号"], $this->sqldata_annualfee[$row["id"]]["年度"]);
					}
				}
			}
		}
	}
	
	/*
	 * 使用
	 * */
	public function UseClass(){
		$this->GetCaseData();
		$this->GetAnnualFeeData();
	}	
}

//require_once "../conn.php";	
//$costid = "23281,23290";
//$sql = "SELECT id,案卷号,年度,金额 FROM 专案_年费记录 WHERE FIND_IN_SET(id,'".$costid."') ORDER BY 案卷号;";
//$getannualfeedata = new GetAnnualFeePayment($conn,$sql,$costid);
//$getannualfeedata->UseClass();
//print_r($getannualfeedata->sqldata_annualfee);

//[23281] => Array
//      (
//          [id] => 23281
//          [案卷号] => 0410300300
//          [年度] => 2
//          [金额] => 90.00
//          [专利名称] => 吊灯（C-5126）
//          [申请人] => 白隽
//          [申请号] => 2017304603892
//          [申请日] => 2017-09-26
//          [申请人id] => 573
//          [滞纳金] => 94.500
//      )
?>