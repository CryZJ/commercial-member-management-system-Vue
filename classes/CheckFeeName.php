<?php
/*
 * 用于查询案件已经存在什么费用，防止再建一个相同的费用
 * */
 
class CheckFeename{
	protected $conn;
	protected $casedata = array(
		"案卷号"=>"",
		"类型编码"=>""//"1":发明，"2":新型，"3":外观
	);
	public $totalfeename = array();//全部费用名称
	public $existfeename = array();//存在的费用名称
	
	
	public function __construct($db,$ajh){
		$this->conn = $db;
		$this->casedata["案卷号"] = $ajh;
	}
	
	/*
	 * 获取案件的类型编码
	 * */
	protected function GetTypeCode(){
		$this->casedata["类型编码"] = substr($this->casedata["案卷号"], 7, 1);
	}
	
	/*
	 * 获取数据库设置好的费用名称
	 * */
	protected function GetSqlFeeName(){
		$sql = "SELECT id,专案类型,费用名 FROM 费用名参看 WHERE 专案类型='".$this->casedata["类型编码"]."' ORDER BY CONVERT(费用名 USING GBK) ASC";
		$result = $this->conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				$this->totalfeename[] = $row[2];
			}
		}
		$this->totalfeename = array_values($this->totalfeename);
	}
	
	/*
	 * 获取案件在“专案需交费用”与“专案_年费记录”中的费用信息
	 * */
	protected function GetExistFeeName(){
		$sql = "SELECT 案卷号,费用名称,年度 FROM 专案需交费用 WHERE 案卷号='".$this->casedata["案卷号"]."'";
		$result = $this->conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_row()){
				if($row[1] == "年费"){
					switch($this->casedata["类型编码"]){
						case "1" :
							$this->existfeename[] = "发明专利第".$row[2]."年年费";
							break;
						case "2" :
							$this->existfeename[] = "实用新型专利第".$row[2]."年年费";
							break;
						case "3" :
							$this->existfeename[] = "外观设计专利第".$row[2]."年年费";
							break;
						default :
							break;
					}
				}else{
					$this->existfeename[] = $row[1];
				}
			}
		}
	}
	
	/*
	 * 执行方法
	 * */
	public function UsingClass(){
		$this->GetTypeCode();
		$this->GetSqlFeeName();
	}
}

require_once "../conn.php";
$getdata = new CheckFeename($conn,"0404700200");
$getdata->UsingClass();


?>