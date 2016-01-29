<?php


$con = mysql_connect('localhost','sociacir_onm','S*_@h3H15VJp') or die("unable to connect database"); 
mysql_set_charset('utf8', $con);
$db  = mysql_select_db("sociacir_onm",$con) or die("unable to select db");
  
 $message = $_POST['message'];
 $mode    = $_REQUEST['mode'];

$deviceToken = array();

$message = array($mode => $message,title=>'Offer Near Me',message=>$message,msgcnt=>'1');


$result = mysql_query("select token FROM onm_other_mobile_device_tokens");
  
while ($row = mysql_fetch_assoc($result)) {
  $deviceToken[] = $row["token"];
}

 foreach($deviceToken as $token){  


  include_once './GCM.php';
  $gcm = new GCM();

   $registatoin_ids = array($token);
 
$result = $gcm->send_notification($registatoin_ids, $message);
$jsonresArr = json_decode($result,true);
print($jsonresArr);

}   

 

?>
