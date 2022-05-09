<?php
require('../../conn.php');
$jiansuo = $_POST['jiansuo'];
//$jiansuo ='李';
$data="";
$sql = "SELECT `申请人`, `证件号`,`地址`,`邮政编码`,`费减备案`,`备注`,`记录所属`,`删除状态` FROM `申请人检索` WHERE `联系人姓名` LIKE'%%$jiansuo%%' OR `发明人姓名` LIKE'%%$jiansuo%%' OR `备注` LIKE'%%$jiansuo%%' OR `手机` LIKE'%%$jiansuo%%'";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);
while($row = $result->fetch_assoc()){
		$data = $data.'{"申请人":"'.$row['申请人'].'","证件号":"'.$row['证件号'].'","地址":"'.$row['地址'].'","邮政编码":"'.$row['邮政编码'].'","费减备案":"'.$row['费减备案'].'","备注":"'.$row['备注'].'","记录所属":"'.$row['记录所属'].'","删除状态":"'.$row['删除状态'].'"},';
		}
$jsonresult = 'success';
$otherdate = '{"result":"'.$jsonresult.'","count":"'.$count.'"}';
$yin = '['.$data.$otherdate.']';
$json=json_encode($yin);
echo $json;

?>