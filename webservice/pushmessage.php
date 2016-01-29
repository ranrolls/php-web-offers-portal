<?php
  
include_once("config.php");

  
$action = $_REQUEST['action'];
  
if($action='save_device_token'){
	 
 $result=array(); 
  
############# FOr getting Device Logged /visited with date ################
  
$deviceplatform = strtolower($_REQUEST['deviceplatform']);
 
//if($deviceplatform == "android"){

 
$rs_user_device = mysql_query("SELECT * from ".$prefix."other_mobile_device_tokens  where deviceid= '".$_REQUEST['deviceid']."' ");

if(mysql_num_rows($rs_user_device) > 0 ){
#################################################
while($rows_get_token = mysql_fetch_assoc($rs_user_device)){
$androidtoken                           = $rows_get_token['token']; 
$comment 				= $rows_get_token['message']; 

}


 $dat_unread = array('message'=>'','status'=>'2');
 echo json_encode($dat_unread);


}

else{

 $devtok= strlen($_REQUEST['devicetoken']);
//var_dump(strlen($_REQUEST['devicetoken']));

if($devtok>5){

//echo 'hello'; die;

 

 mysql_query("INSERT into ".$prefix."other_mobile_device_tokens(deviceid,token,dateLogged,readstatus) 
             values ('".$_REQUEST['deviceid']."','".$_REQUEST['devicetoken']."',now(),'0' ) ");



$dat31 = array('message'=>'','status'=>'1'); // status 1 for if token inserted
echo json_encode($dat31);

}

else{
      $dat32 = array('message'=>'','status'=>'0'); // 0 for no device token
      echo json_encode($dat32);
}


}


//}  //android
 
#############################################
  

}//close action
 
 
 
 
?>
