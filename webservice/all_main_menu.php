<?php

include_once('config.php');

  
$result=array();
 

 $sql= "SELECT * FROM `onm_menu` WHERE menutype = 'mainmenu' and id NOT IN ('101','103') and published = '1' order by id";  

$rs_username  = mysql_query($sql);

while($logindetails = mysql_fetch_assoc($rs_username)) {
$finalArray=array();
$finalArray['id']     = $logindetails['id']; 
$finalArray['title']  = $logindetails['title']; 
$finalArray['alias']  = $logindetails['alias']; 
$finalArray['path']   = $logindetails['path'];   
  
$result[]=$finalArray;
}

 echo json_encode($result);	
   
 
?>
