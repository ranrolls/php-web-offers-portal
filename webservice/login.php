<?php

 
 
define( '_JEXEC', 1 );
define( 'JPATH_BASE', str_replace('/webservice','',dirname(__FILE__)) ); 	# This is when we are in the root
define( 'DS', DIRECTORY_SEPARATOR );
require_once( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once( JPATH_BASE .DS.'includes'.DS.'framework.php' );
  
jimport('joomla.user.helper');


include_once("config.php");
      
	        $action 		= $_REQUEST['action']; 
		$username 		= $_REQUEST['username'];
		$userpassword 	= $_REQUEST['password'];
                $devicetoken	= $_REQUEST['devicetoken'];
		$deviceversion	= $_REQUEST['deviceversion'];
		$devicemodel	= $_REQUEST['devicemodel'];
		$deviceplatform	= $_REQUEST['deviceplatform']; 
		
	         //$finalArray_test=array('username'=>'vishal','password'=>'123456');
		 //$dats = array('result'=>$finalArray_test);
		   //$jsonenc= json_encode($dats);
		  //$data= json_decode($json_string);	
		   //print_r($data); 
		 //$username 		= $data['username'];
		 //$userpassword 	        = $data['password'];
        
		
if($action='login'){
	  
 $result=array(); 

 ############################ CHECKING USERNAME EXIST OR NOT ##################

		    $sql_username = "SELECT * from ".$prefix."users where username = '".$username."'  ";
								
			$rs_username  = mysql_query($sql_username);

			if($rows_username = mysql_fetch_assoc($rs_username)){
             		
			   $dbpassword = $rows_username['password']; 
				  
		if(JUserHelper::verifyPassword($userpassword, $rows_username['password'], $rows_username['id'])){
			
			$datelogged = date('Y-m-d H:i:s');
			//$sqlLog = "INSERT INTO ".$prefix."user_visit_log SET userID='".$rows_username['id']."', useFrom = 'Mobile', dateLogged='".$datelogged."'";
			//mysql_query($sqlLog);

			############# FOr getting Device Logged /visited with date ################

			/*if($devicetoken <> ""){

			$deviceplatform = strtolower($deviceplatform);
 
			$rs_user_device = mysql_query(" SELECT androidtoken,deviceplatform,devicemodel,deviceversion from ".$prefix."user_tokens where userid = ".$rows_username['id']." ");
			if(mysql_num_rows($rs_user_device) > 0 ){

			mysql_query("UPDATE ".$prefix."user_tokens set androidtoken = '".$devicetoken."',devicemodel='".$devicemodel."',
						deviceversion='".$deviceversion."' where userid = ".$rows_username['id']." ");
			}
			else{
			mysql_query("INSERT into  ".$prefix."user_tokens (userid,androidtoken,deviceplatform,devicemodel,deviceversion,dateLogged) values (".$rows_username['id'].",'".$devicetoken."','".$deviceplatform."','".$devicemodel."','".$deviceversion."',now() ) ");

			} 
 
			}*/

            
			################### End Here ###########################################
 
			$result['id']			=$rows_username['id'];
			$result['name']			=$rows_username['name'];
			$result['email']		=$rows_username['email'];
			$result['phoneno']		=$rows_username['phoneno'];
			$result['registerDate']	=$rows_username['registerDate'];
			$result['block']		=$rows_username['block'];
            
			$dat = array('status'=>'1','result'=>$result);
			echo json_encode($dat);
			  
			} }
			else{
			    	$dat = array('status'=>'0','result'=>'');
				   echo json_encode($dat);
			}	
		
		
}//close action

 
 
?>
