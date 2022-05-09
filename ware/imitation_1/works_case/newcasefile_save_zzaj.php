<?php
	    $ajh = $_POST['ajh'];//获取案卷号	
	    $time = date("Y-m-d");//获取当前时间
		require'../../../conn.php';
			$sql = "select id,登记人 from 著作_信息 where 案卷号='".$ajh."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$zzxx_id = $row['id'];
			$dlr = $row['登记人'];
		}
	}else{
		exit('<script type="text/javascript">alert("文件保存失败！");location.href="case_zz.php";</script>');
	}
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
		        $move_to_file=$_SERVER['DOCUMENT_ROOT']."/zlxt/img_receipt/".$ajh.substr($file_true_name,strrpos($file_true_name,"."));
		//        echo "$uploaded_file   $move_to_file";
		        $filename = $ajh.substr($file_true_name,strrpos($file_true_name,"."));
		        if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {
		        	$sql2 = "insert into 著作_文件(案卷号,状态,处理人,时间,路径) values('".$ajh."','未提交','".$dlr."','".$time."','".$move_to_file."')";
				      $result2 = $conn->query($sql2);
				      if($result2 == 1){
//							echo '保存成功';
						}else{
							echo '<br/>';
							echo '保存失败，，请联系管理员';
							echo '<br/>';
							echo $sql2;
			}
		          echo  '<script type="text/javascript">alert("操作成功 ！");javascript:history.go(-1);</script>';
		//	            echo $_FILES['myfile']['name']."上传成功";
		        } else {
		            echo "上传失败";
		        }
		    } else {
//		        echo "上传失败";
                 echo '<script type="text/javascript">alert("操作成功 ！无文件");javascript:history.go(-1);</script>';
		    }
		    
?>