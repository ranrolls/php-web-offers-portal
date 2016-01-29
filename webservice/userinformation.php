<?php
 
include_once("config.php");
      
	        $action 		= $_REQUEST['action']; 
		$username 		= $_REQUEST['username']; 
                $useremail 		= $_REQUEST['email']; 
                $deviceid               = $_REQUEST['deviceid']; 
		$deviceversion	        = $_REQUEST['deviceversion'];
		$devicemodel	        = $_REQUEST['devicemodel'];
		$deviceplatform	        = $_REQUEST['deviceplatform']; 
                $latitude               = $_REQUEST['latitude']; 
                $longitude              = $_REQUEST['longitude']; 
           
                    
		
	           
if($action='userinformation'){ 
	 
 
 mysql_query("INSERT into onm_mobile_device_tokens(username,email,latitude,longitude,deviceid,token,deviceplatform,
             devicemodel,deviceversion,dateLogged,readstatus) 
             values ('".$username."','".$useremail."','".$latitude."','".$longitude."','".$deviceid."','','".$deviceplatform."',
             '".$devicemodel."','".$deviceversion."',now(),'0' ) ");



 mysql_query("INSERT into onm_app_version(package_name,deviceid,version,old_version,details) 
             values ('','".$deviceid."','".$deviceversion."','','') ");
 
			  
 $dat = array('status'=>'1','result'=>'User Information Registered.');
 echo json_encode($dat);
 
  	
		
}//close action

 
 
?>
