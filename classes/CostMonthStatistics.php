<?php
/*
 * 用于费用的月统计的
 * */
 
	class CostMonthStatistics{
		protected $conn;//数据库句柄
		protected $revenue_table;//收入记录表
		protected $expense_table;//支出记录表
		protected $arrearage_table;//欠费记录表
		protected $process_table;//财务统计表
		
		public $revenue = array();//收入
		public $expense = array();//支出
		public $arrearage = array();//欠费
		public $year_month = array();//年月信息
		public $process_data = array();//处理完毕的数据
		
		
		public function __construct($db,$sr_table,$zc_table,$qf_table){
			$this->conn = $db;
			$this->revenue_table = $sr_table;
			$this->expense_table = $zc_table;
			$this->arrearage_table = $qf_table;
//			$this->process_table = $tj_table;
		}
		
		
		/*
		 * 修正数据：“年月”有可能不正确
		 * */
		
		protected function AmendYearMonth(){
			$sql_arr = array();
			$sql_arr[0]["table"] = $this->revenue_table;
			$sql_arr[0]["sql"] = "SELECT id,收费日期,年月 FROM ".$this->revenue_table." WHERE (年月='无' OR 年月='' OR ISNULL(年月))";
			$sql_arr[1]["table"] = $this->expense_table;
			$sql_arr[1]["sql"] = "SELECT id,支出日期,年月 FROM ".$this->expense_table." WHERE (年月='无' OR 年月='' OR ISNULL(年月))";
			$sql_arr[2]["table"] = $this->arrearage_table;
			$sql_arr[2]["sql"] = "SELECT id,收费日期,年月 FROM ".$this->arrearage_table." WHERE (年月='无' OR 年月='' OR ISNULL(年月))";
			foreach($sql_arr as $index => $datainfo){
				$result = $this->conn->query($datainfo["sql"]);
				if($result->num_rows>0){
					while($row = $result->fetch_row()){
						$row[1] = empty($row[1]) ? date("Y-m-d") : $row[1];
						$y = date("Y",strtotime($row[1]));
						$m = date("m",strtotime($row[1]));
						$ym = $y.$m;
						$sql_u = "UPDATE ".$datainfo["table"]." SET 年月='".$ym."' WHERE id='".$row[0]."'";
						$this->conn->query($sql_u);
					}
				}
			}
		}
		
		/*
		 * 获取收入数据
		 * */
		protected function GetRevenueData(){
			$sql = "SELECT 年月,SUM(总收费) AS 月总收费,SUM(规费) AS 月规费,SUM(管理费) AS 月管理费,SUM(税费) AS 月税费 FROM ".$this->revenue_table." GROUP BY 年月 ORDER BY 年月;";
			$result = $this->conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$this->revenue[$row["年月"]] = $row;
				}
			}
		}
		
		/*
		 * 获取支出数据
		 * */
		protected function GetExpenseData(){
			$sql = "SELECT 年月,SUM(金额) AS 月支出金额 FROM ".$this->expense_table." GROUP BY 年月 ORDER BY 年月;";
			$result = $this->conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$this->expense[$row["年月"]] = $row;
				}
			}
		}
		
		/*
		 * 获取欠费数据
		 * */
		protected function GetArrearageData(){
			$sql = "SELECT 年月,(SUM(总收费)-SUM(规费)-SUM(管理费)-SUM(税费)) AS 月欠费 FROM ".$this->arrearage_table." GROUP BY 年月 ORDER BY 年月;";
			$result = $this->conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$this->arrearage[$row["年月"]] = $row;
				}
			}
		}
		
		/*
		 * 月份排序从小到大
		 * */
		protected function SortYm($arr){
			$len=count($arr);
			for($k=1;$k<$len;$k++){
			    for($j=0;$j<$len-$k;$j++){
			        if($arr[$j]>$arr[$j+1]){
			            $temp =$arr[$j+1];
			            $arr[$j+1] =$arr[$j] ;
			            $arr[$j] = $temp;
			        }
			    }
			}
			return $arr;
		}
		
		/*
		 * 统计数据
		 * */
		protected function HandleData(){
			$R_index = array_keys($this->revenue);
			$E_index = array_keys($this->expense);
			$A_index = array_keys($this->arrearage);
			$this->year_month = array_unique(array_merge_recursive($R_index,$E_index,$A_index));
			$this->year_month = array_values($this->year_month);
			$this->year_month = $this->SortYm($this->year_month);
			foreach($this->year_month as $index => $Ym){
				$this->process_data[$Ym] = array(
					"年月"=>$Ym,
					"总收费"=>0,
					"规费"=>0,
					"管理费"=>0,
					"税费"=>0,
					"支出金额"=>0,
					"本月利润"=>0,
					"期初结转"=>0,
					"本月结存"=>0,
					"本月欠费"=>0,
				);
				//收费记录
				if(array_key_exists($Ym, $this->revenue)){
					$this->process_data[$Ym]["总收费"] = $this->revenue[$Ym]["月总收费"];
					$this->process_data[$Ym]["规费"] = $this->revenue[$Ym]["月规费"];
					$this->process_data[$Ym]["管理费"] = $this->revenue[$Ym]["月管理费"];
					$this->process_data[$Ym]["税费"] = $this->revenue[$Ym]["月税费"];
				}
				//支出记录
				if(array_key_exists($Ym, $this->expense)){
					$this->process_data[$Ym]["支出金额"] = $this->expense[$Ym]["月支出金额"];
				}
				//欠费记录
				if(array_key_exists($Ym, $this->arrearage)){
					$this->process_data[$Ym]["本月欠费"] = $this->arrearage[$Ym]["月欠费"];
				}
				$this->process_data[$Ym]["本月利润"] = round(floatval($this->process_data[$Ym]["总收费"])-floatval($this->process_data[$Ym]["支出金额"]),2);
				if($index != 0){
					$this->process_data[$Ym]["期初结转"] = $this->process_data[$this->year_month[intval($index)-1]]["本月结存"];
				}
				$this->process_data[$Ym]["本月结存"] = round(floatval($this->process_data[$Ym]["本月利润"])+floatval($this->process_data[$Ym]["期初结转"]),2);
			}
		}
		
		/*
		 * 使用
		 * */
		public function UsingClass(){
			$this->AmendYearMonth();
			$this->GetRevenueData();
			$this->GetExpenseData();
			$this->GetArrearageData();
			$this->HandleData();
		}
		
	}

//	require_once "../conn.php";
//	$getdata = new CostMonthStatistics($conn,'收入记录_1','支出记录_1','欠费记录_1');
//	$getdata->UsingClass();
//	print_r($getdata->process_data);

?>