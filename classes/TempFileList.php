<?php
/*
 * 用于临时文件与案件信息结合，其他文件
 * */
 
	class TempFileList{
		protected $conn;//数据库句柄
		//案件信息的查询语句
		protected $sqlstatement_case = array(
			"SELECT 案卷号,专利名称,案源人,代理人,申请人,申请号,申请日,申请人id,状态,冻结状态,'专利信息' AS 案件分类 FROM 专利信息 WHERE 冻结状态='0' AND 状态<>'9';",
			"SELECT 案卷号,专利名称,案源人,代理人,申请人,申请号,申请日,申请人id,状态,冻结状态,'专案_年费' AS 案件分类 FROM 专案_年费 WHERE 冻结状态='0' AND 状态<>'9';",
			"SELECT 案卷号,专利名称,案源人,代理人,申请人,申请号,申请日,申请人id,状态,冻结状态,'专案_复审等' AS 案件分类 FROM 专案_复审等 WHERE 冻结状态='0' AND 状态<>'9';"
		);
		public $sqldata_case;//案件信息的数据
		protected $check_sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码<>'200101,200021' AND 通知书编码<>'200101,200103' AND 通知书编码<>'200602' AND 通知书编码<>'200701' AND 通知书编码<>'200702'  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='200101,200021' OR 通知书编码='200101,200103' OR 通知书编码='200602' OR 通知书编码='200701' OR 通知书编码='200702') ORDER BY 上传时间 DESC)) AS c;";
		public $sqldata_tempfiles = array();//年费信息+案件信息
		
		public function __construct($db){
			$this->conn = $db;
		}
		
		/*
		 * 获取“年费中”的案件信息
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
		 * 获取“年费”的信息+“案件”的信息
		 * */
		protected function GetAnnualFeeData(){
			$result = $this->conn->query($this->check_sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$tempdata = "";
					if(isset($this->sqldata_case[$row["案卷号"]])){
						$tempdata = array_merge($row,$this->sqldata_case[$row["案卷号"]]);
						$this->sqldata_tempfiles[$row["id"]] = $tempdata;
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

//	require_once "../conn.php";	
//	$getannualfeedata = new TempFileList($conn);
//	$getannualfeedata->UseClass();
//	print_r($getannualfeedata->sqldata_tempfiles);
 
?>