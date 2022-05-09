<?php
// $file = 'test.pdf';
if(!function_exists('test.pdf')) {
 	
    function read_pdf($file) {
 
        if(strtolower(substr(strrchr($file,'.'),1)) != 'pdf') {
 
            echo '文件格式不对.';
 
            return;
 
        }
 
        if(!file_exists($file)) {
 
            echo '文件不存在';
 
            return;
 
        }
 
        header('Content-type: application/pdf');
 
        header('filename='.$file);
 
        readfile($file);
 
    }
// 	read_pdf('test.pdf');
}
$file = "../images/404-error.png";
echo "<a href='".$file."' target='_blank'><img src=".$file." /></a>"; 
        
 
/*End of PHP*/
?>