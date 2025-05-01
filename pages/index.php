<?php
/*
 * 函数：访客设备
 * 博客园：https://www.cnblogs.com/freephp/p/13979503.html
 * Github: https://github.com/serbanghita/Mobile-Detect
*/
function is_mobile(){
    require('./Mobile_Detect.php');
    $MobileDetect = new Mobile_Detect();
 
    if ($MobileDetect->isTablet()) {
        // 平板定义为PC类
        return false;
    } elseif ($MobileDetect->isMobile()) {
        return true;
    } else {
        return false;
    }
}
 
// 电脑与手机用不同的壁纸
if(is_mobile()){
   // 手机壁纸
   $filename = "img_mobile.txt";
}else{
   // 电脑壁纸
   $filename = "img.txt";
}
 
//存放api随机图链接的文件名img.txt
if(!file_exists($filename)){
    die('文件不存在');
}
 
//从文本获取链接
$pics = [];
$fs = fopen($filename, "r");
while(!feof($fs)){
    $line=trim(fgets($fs));
    if($line!='' && substr($line , 0 , 1) != '#'){
        array_push($pics, $line);
    }
}
 
// 从数组随机获取链接
// $pic = $pics[array_rand($pics)];
$pic = $pics[random_int(0, count($pics) - 1)]; # 真随机
 
//返回指定格式
// $type=$_GET['type'];
$type = isset($_GET['type']) ? strtolower($_GET['type']) : '';
switch($type){
 
//JSON返回
case 'json':
    header('Content-type:text/json');
    die(json_encode(['pic'=>$pic]));
 
default:
    die(header("Location: $pic"));
}
 
?>   