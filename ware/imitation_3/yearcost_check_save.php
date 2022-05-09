<?php
	require'../../AHeader.php'; 
	require'../../conn.php';
	
	//验证身份是否是“流程操作员”
	if(!$lcczy == "1"){
		echo "您没有权限操作";
		exit();
	}
	
	$sjbh  	= 	$_POST['sjbh'];
	$id  	= 	$_POST['fid'];
	$cpeo  	= 	$_POST['cpeo'];	
	$date  	=  	date('Y-m-d');
	
	$fid 	=  	explode('/',$id);
	$len  	=  	count($fid);
	
	if(strlen($sjbh)>0){
		
		$move_to_file = '';
		if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
	    	if($_FILES['myfile']['name'] != null){
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
		        $move_to_file=$_SERVER['DOCUMENT_ROOT']."/zlxt/img_receipt/".$sjbh.substr($file_true_name,strrpos($file_true_name,"."));
		//        echo "$uploaded_file   $move_to_file";
		        $filename = $sjbh.substr($file_true_name,strrpos($file_true_name,"."));
		        if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {
		            echo "<script>alert(' 操作成功 ');self.close() ;</script>";
		//	            echo $_FILES['myfile']['name']."上传成功";
		        } else {
	//	            echo "上传失败";
		        }
			}else {
	//      	echo "上传失败";
	    	}
	    } else {
	//      echo "上传失败";
	    }
		
	//  if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
	//      //把文件转存到你希望的目录（不要使用copy函数）
	//      $uploaded_file=$_FILES['myfile']['tmp_name'];
	//
	//      //我们给每个用户动态的创建一个文件夹
	////      $user_path=$_SERVER['DOCUMENT_ROOT']."/studyphp/file/up/".$username;
	//      //判断该用户文件夹是否已经有这个文件夹
	////      if(!file_exists($user_path)) {
	////          mkdir($user_path);
	////      }
	//
	//      //$move_to_file=$user_path."/".$_FILES['myfile']['name'];
	//      $file_true_name=$_FILES['myfile']['name'];
	//      $move_to_file=$_SERVER['DOCUMENT_ROOT']."/zlxt/img_receipt/".$sjbh.substr($file_true_name,strrpos($file_true_name,"."));
	//      //echo "$uploaded_file   $move_to_file";
	//      $filename = $sjbh.substr($file_true_name,strrpos($file_true_name,"."));
	//      
	//      for($i = 0;$i<$len;$i++){
	//			//费用信息中的收据状态更新
	//			$sql 	= "UPDATE `专案_年费记录` SET 收据编号='".$sjbh."',收据处理人='".$cpeo."',收据上传日期='".$date."' where id='".$fid[$i]."'";
	//			$result = $conn->query($sql);
	//			
	//	//		echo $fid[$i];
	//		}
	//		$sql2 = "insert into 案件收据信息(收据编号,上传时间,收据文件) values('".$sjbh."','".$date."','".$filename."')";
	//		$result2 = $conn->query($sql2);
	//		
	//      
	//      if($result2 == 1 ||move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {
	//          echo "<script>alert(' 操作成功 ');self.close() ;</script>";
	////	            echo $_FILES['myfile']['name']."上传成功";
	//			
	//      } else {
	//          echo "上传失败";
	//      }
	//  } else {
	//      echo "上传失败";
	//  }
		
		for($i = 0;$i<$len;$i++){
				//费用信息中的收据状态更新
				$sql 	= "UPDATE `专案_年费记录` SET 收据编号='".$sjbh."',收据处理人='".$cpeo."',收据上传日期='".$date."',状态=3,文件名='".$filename."'  where id='".$fid[$i]."'";
				$result = $conn->query($sql);
		//		echo $fid[$i];
				
				//更新处理状态
				$sql_c = "SELECT 处理状态  FROM 专案_年费记录   WHERE id=".$fid[$i]."";
				$result_c = $conn->query($sql_c);
				if($result_c->num_rows){
					while($rowc = $result_c->fetch_assoc()){
						$ThisStatu = $rowc['处理状态'];
						$ThisStatu = $ThisStatu.'3';
						
						$sql2 = "UPDATE `专案_年费记录` SET 处理状态 = '".$ThisStatu."' WHERE id='".$fid[$i]."'";
						$result2 = $conn->query($sql2);
					}
				}
			}
			$sql2 = "insert into 案件收据信息(收据编号,上传时间,收据文件) values('".$sjbh."','".$date."','".$move_to_file."')";
			$result2 = $conn->query($sql2);
		if($result2 == 1){
			echo '保存成功';
		}else{
			echo '<br/>';
			echo '保存失败，，请联系管理员';
			echo '<br/>';
			echo $sql2;
		}
	}else{
		echo "<script language='javascript'>alert('请输入收据编号！');self.history.go(-1);</script>;";
	}
	
	

?>