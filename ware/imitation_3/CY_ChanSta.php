<?php
	$flag = $_GET['flag'];
	require'../../conn.php';
	require'../../AHeader.php'; 
	switch($flag){
		case 'MonToInfo'://监控中变待通知
			$IdStr = $_GET['id'];
			if(strstr($IdStr,'|')){
				$IdArr = explode('|',$IdStr);
				foreach($IdArr as $id){
					$sql = "update 专案_年费记录  set 状态=8 where id = '".$id."' ";
					$result = $conn->query($sql);
				}
				unset ($id);
			}else{
				$sql = "update 专案_年费记录  set 状态=8 where id = '".$IdStr."' ";
				$result = $conn->query($sql);
			}
			
			//如果操作成功
			if(isset($result)){
				echo '操作成功';
				return ;
			}
			//否则
			echo '操作失败';
			return ;
			break;
		default:echo '非法操作';break ;
	}
?>