<?php
	$myfile = 	$_POST['myfile'];
	$date  	=  	date('Y-m-d');
	$datm  	=  	date('Ymd');
//	$fid 	=  	explode('/',$id);
//	$len  	=  	count($fid);
	
	require'../../conn.php';
    if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
        //把文件转存到你希望的目录（不要使用copy函数）
        $uploaded_file=$_FILES['myfile']['tmp_name'];
  	
        //我们给每个用户动态的创建一个文件夹
//      $user_path=$_SERVER['DOCUMENT_ROOT']."/studyphp/file/up/".$username;
        //判断该用户文件夹是否已经有这个文件夹
//      if(!file_exists($user_path)) {
//          mkdir($user_path);
//      }
  
        //$move_to_file=$user_path."/".$_FILES['myfile']['name'];
        $file_true_name=$_FILES['myfile']['name'];
        $move_to_file=$_SERVER['DOCUMENT_ROOT']."/zlxt/person_mes/".$myfile.$datm($file_true_name,strrpos($file_true_name,"."));
//        echo "$uploaded_file   $move_to_file";
        $filename = $myfile.substr($file_true_name,strrpos($file_true_name,"."));
        if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {
            echo "<script>alert(' 操作成功 ');self.close() ;</script>";
//	            echo $_FILES['myfile']['name']."上传成功";
        } else {
            echo "上传失败";
        }
    } else {
        echo "上传失败";
    }
    
	
//	for($i = 0;$i<$len;$i++){
//		//费用信息中的收据状态更新
//		$sql 	= "UPDATE `专案需交费用` SET 收据编号='".$sjbh."',收据确认人='".$cpeo."',收据上传日期='".$date."' where id='".$fid[$i]."'";
//		$result = $conn->query($sql);
//		
////		echo $fid[$i];
//	}
//	$sql2 = "insert into 案件收据信息(收据编号,上传时间,收据文件) values('".$sjbh."','".$date."','".$move_to_file."')";
//	$result2 = $conn->query($sql2);
//		
//	if($result2 == 1){
//		echo '保存成功';
//	}else{
//		echo '<br/>';
//		echo '保存失败，，请联系管理员';
//		echo '<br/>';
////		echo $sql2;
//	}
?>