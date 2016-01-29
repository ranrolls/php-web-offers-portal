<?php

include_once('config.php'); 
  
$result=array();
$alias=$_REQUEST['alias'];

 $sql= "SELECT a.alias,a.title,a.path,a.id,b.title, b.introtext, b.fulltext, b.images, b.urls, b.catid
       FROM onm_content AS b LEFT JOIN onm_menu AS a ON a.alias= b.alias
       WHERE b.alias = '".$alias."'";  

  
$rs_username  = mysql_query($sql);

while($logindetails = mysql_fetch_assoc($rs_username)) {
 
$result['title'] = $logindetails['title'];  
// $result['introtext'] =  str_replace('&amp;','&', strip_tags(mb_convert_encoding($logindetails['introtext'],'utf-8')));
 $result['introtext'] =  $logindetails['introtext'];
//$result['fulltext'] =  str_replace('&amp;','&', strip_tags(mb_convert_encoding($logindetails['fulltext'],'utf-8'))); 
$result['fulltext'] =  $logindetails['fulltext']; 
 
$result['catid'] = $logindetails['catid'];
 
 
//$result['tm_img1']    = $upload_fullpath.'/modules/mod_lan_our_team/frontend/images/about_1.jpg';
  
 $result['images']    = "";
	 
 }

 echo json_encode($result);	 
   
 
?>
