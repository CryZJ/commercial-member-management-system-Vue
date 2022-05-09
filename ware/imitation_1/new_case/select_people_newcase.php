<?php
	$flag = $_POST['flag'];//获取什么信息的标志
	require("../../../conn.php");
	if($flag=="申请人"){
		$id = $_POST['id'];
		$sql = "select 申请人,证件号,地址,邮政编码,费减备案,备注 from 申请人 where id='$id'";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$data['sqr'] = $row['申请人'];
				$data['zjh'] = $row['证件号'];
				$data['dz'] = $row['备注'];
				$data['yb'] = $row['邮政编码'];
				$data['fj'] = $row['费减备案'];
				$data['bz'] = $row['备注'];
			}
			$json = json_encode($data);
			echo $json; 
		}else{
			echo "无数据！";
		}
	}
	if($flag == "ShowSQR"){
	    $id = $_POST['id'];
	    $idArr = explode('/',$id);
	    $num = 0;
	    for($i=0;$i<count($idArr);$i++){
	        $sql = "select * from 申请人 where id='".$idArr[$i]."'";
            $result = $conn->query($sql);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $data[$num]['id']  = $row['id'];
                    $data[$num]['sqr'] = $row['申请人'];
                    $data[$num]['zjh'] = $row['证件号'];
                    $data[$num]['dz']  = $row['地址'];
                    $data[$num]['yb']  = $row['邮政编码'];
                    $data[$num]['fj']  = $row['费减备案'];
                    $data[$num]['bz']  = $row['备注'];
                    $data[$num]['sqrlx'] = $row['申请人类型'];
                    $num++;
                }
                $data['result'] = 'success';
            }else{
                $data['result'] = 'fail';
            }
	    }
	    $data['num'] = $num;
	    $json_string = json_encode($data);
        echo $json_string;
	}
?>