<?php

include_once('config.php');
  
$result=array();

$sql= "SELECT * FROM onm_app_version WHERE deviceid='".$_REQUEST['deviceid']."' ";    

$rs_username  = mysql_query($sql);
$num_rows = mysql_num_rows($rs_username);

$logindetails = mysql_fetch_assoc($rs_username);
 
   //$staticversion='0.0.2'; $logindetails['old_version'];
   
  // $version= explode('.',$staticversion);

 $version= explode('.',$logindetails['old_version']);
  $version[0];  
  $version[1]; 
  $version[2];

    
$requestvesrion = explode('.',$_REQUEST['version']);
  $requestvesrion[0];  
 $requestvesrion[1]; 
 $requestvesrion[2];

  
if($requestvesrion[2]==$version[2]){

$resultdet='Already this Version';
echo json_encode(array('status'=>'1','message'=>$resultdet,'result'=>''));	   

}

else if($requestvesrion[2]< $version[2]){
$updatedURL='https://www.google.com';
$resultdet='Old Version';
echo json_encode(array('status'=>'2','message'=>$resultdet,'result'=>$updatedURL));	   

}

 
else{
 
//mysql_query("UPDATE ".$prefix."users set password = '$password',activation='' where id = '$userid' ")) 

 $resultdet='Updated Version Available';
$updatedURL='https://www.google.com';
     echo json_encode(array('status'=>'0','message'=>$resultdet,'result'=>$updatedURL));	

}   
 

?>
