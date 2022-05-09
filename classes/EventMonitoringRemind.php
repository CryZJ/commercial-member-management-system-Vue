<?php
/*
 * 结合所有的事件监控，并标明来源，用于提醒界面的显示
 * */
 
class EventMonitoringRemind{
	protected $conn;
	
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	
	/*
	 * 申请案件（专利信息）和其他案件（专利_复审等）的"案件监控"
	 * */
	protected function GetData(){
		$sql = ""
	}
}
 
?>