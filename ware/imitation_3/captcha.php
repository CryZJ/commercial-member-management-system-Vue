<?php

$authcode = isset($_GET["authcode"])?$_GET["authcode"]:"1234";

//创建一个大小为 100*30 的验证码
$image = imagecreatetruecolor(100, 30);
$bgcolor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgcolor);


$authcode_arr = str_split($authcode);
$fontsize = 10;
for ($i = 0; $i < 4; $i++) {
    $fontsize = 10;
    $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
		
    $x = ($i * 100 / 4) + rand(5, 10);
    $y = rand(5, 10);
    imagestring($image, $fontsize, $x, $y, $authcode_arr[$i], $fontcolor);
}


//在图片上增加点干扰元素
for ($i = 0; $i < 200; $i++) {
    $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
    imagesetpixel($image, rand(1, 99), rand(1, 29), $pointcolor);
}
 
//在图片上增加线干扰元素
for ($i = 0; $i < 3; $i++) {
    $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
    imageline($image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor);
}
//设置头
header('content-type:image/png');
imagepng($image);
imagedestroy($image);

?>