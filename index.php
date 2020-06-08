<?php
if($_GET['lat'] &$_GET['long'])){
 $lat = $_GET['lat'];
 $long = $_GET['long'];
define('LINE_API',"https://notify-api.line.me/api/notify");
 
$token = "c8Pk0ZaizdVp2wHOTsl7NGfK8FHeaENPBqIklsoX5Ri"; //ใส่Token ที่copy เอาไว้
$str = " lat ".$lat."<br /> "."long ".$long; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
 
$res = notify_message($str,$token);
print_r($res);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}
}else{
 echo "ไม่มีข้อมูล";
}
?>

