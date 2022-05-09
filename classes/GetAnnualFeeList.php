<?php
/*
 * 
 * 快速获取年费记录的类
 * */

class GetAnnualFeeList{
	protected $database;//数据库句柄
	//案件信息的查询语句
	protected $sqlstatement_case = array(
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9'   AND  NOT ISNULL(申请日);",
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9'   AND  NOT ISNULL(申请日);",
		"SELECT 案卷号,专利名称,申请人,申请号,申请日,申请人id FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9'  AND  NOT ISNULL(申请日);"
	);
	public $sqldata_case;//案件信息的数据
	protected $sqlstatement_annualfee;//年费查询语句
	public $sqldata_annualfee = array();//年费信息+案件信息
	
	public function __construct($db,$sql_annualfee){
		$this->database = $db;
		$this->sqlstatement_annualfee = $sql_annualfee;
	}
	
	
	/*
	 * 获取“年费中”的案件信息
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
//$sql = "SELECT id,案卷号,年度,金额,应缴日期,DATEDIFF(应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 计算天数,通知书生成日期,缴费时间,收据上传日期 FROM 专案_年费记录 WHERE 状态<>'9' ORDER BY 案卷号;";
//$getannualfeedata = new GetAnnualFeeList($conn,$sql);
//$getannualfeedata->UseClass();
//print_r($getannualfeedata->sqldata_annualfee);

//  [22165] => Array
//      (
//          [id] => 22165
//          [案卷号] => 0179200100
//          [年度] => 2
//          [金额] => 135.00
//          [应缴日期] => 2017-03-29
//          [计算天数] => -527
//          [通知书生成日期] => 0
//          [缴费时间] => 
//          [收据上传日期] => 0
//          [专利名称] => 一种具有通信功能的灯具控制装置及其控制方法
//          [申请人] => 刘胜泉
//          [申请号] => 2016101110351
//          [申请日] => 2016-02-29
//          [申请人id] => 312
//      )


?>