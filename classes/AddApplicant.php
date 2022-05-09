<?php
/*
 * 
 * 查询是加入申请人的信息
 * */
 
class AddApplicant {
	protected $database;//数据库句柄
	protected $sqlstatement_applicant = "SELECT id,申请人,证件号 FROM 申请人 WHERE 删除状态='0'";//申请人的查询语句
	public $sqldata_applicant;//申请人的信息
	
	protected $sqlstatement_need;//需要拼入的查询语句
	public $sqldata_need;//有需要的数据
	
	public function __construct($db,$sql){
		$this->database = $db;
		$this->sqlstatement_need = $sql;
	}
	
	/*
	 * 获取“申请人”信息
	 * */
	protected function GetApplicantData(){
		$result = $this->database->query($this->sqlstatement_applicant);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$this->sqldata_applicant[$row["id"]] = $row;
			}
		}
	}
	
	/*
	 * 获取需要查询的表数据
	 * */
	protected function GetNeedData(){
		$result = $this->database->query($this->sqlstatement_need);
		if($result->num_rows>0){
			$i = 0;
			while($row = $result->fetch_assoc()){
				//根据id获取申请人名称
				$tempname = "";
				if(!empty($row["申请人id"])){
					$applicant_id_arr = explode(",", $row["申请人id"]);
					if(count($applicant_id_arr) > 1){
						foreach($applicant_id_arr as $ky => $datainfo){
							$tempname .= ",".$this->sqldata_applicant[$datainfo]["申请人"];
						}
						$tempname = substr($tempname, 1);
					}else{
						$tempname = $this->sqldata_applicant[$applicant_id_arr[0]]["申请人"];
					}
					
				}
				//拼入总的数据
				$this->sqldata_need[$i] = $row;
				$this->sqldata_need[$i]["申请人"] = $tempname;
				
				$i++;
			}
		}else{
			$this->sqldata_annualfee = "";
		}
	} 
	 
	/*
	 * 使用
	 * */
	public function UseClass(){
		$this->GetApplicantData();
		$this->GetNeedData();
	} 
} 
 
//require_once "../conn.php";
//$sql = "SELECT id,案卷号,创建人,申请人id,创建时间,文件路径 FROM  授权通知书信息 ORDER BY 创建时间";
//$getsqldata = new  AddApplicant($conn,$sql);
//$getsqldata->UseClass();
//print_r($getsqldata->sqldata_need);
 
?>