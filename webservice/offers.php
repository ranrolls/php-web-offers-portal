<?php

include_once('config.php'); 
 

                                $action = $_REQUEST['action'];
                                $number = $_REQUEST['number'];
 
                                $retvalArray = array();
                                $finalArray=array();
 
                            if ($action=='offerlist'){  
                                if(!isset($number) || ($number == "" || $number == 0)){
                                $page = 1;
                                }else{
                                  $page = $number; 
                                  }

  $query= "SELECT * FROM ".$prefix."property where approval_status='1' ORDER BY  propertyID DESC"; 
 
 ######### FOr Android #################					
 $sql           = mysql_query($query);	
 $total_records = mysql_num_rows($sql);
 $num_pages     = ceil($total_records/4);
					 
    $start =  4* ($page-1);
    $end = 4;
    $query .= " limit $start,$end ";
    $rs     = mysql_query($query);
 
########################################################	
 if (mysql_num_rows($rs) > 0){ 
				
 while($data=mysql_fetch_assoc($rs)){
 
 
$tempArray = array();

 $serverrul= "http://".$_SERVER['HTTP_HOST'];
 		 
   
$tempArray['offerID']     	        = $data['propertyID'];	 
$tempArray['catid']     	        = $data['catid'];
$tempArray['subcatid']     	        = $data['subcatid'];
$tempArray['orgid']     	        = $data['organization_id'];
$tempArray['locatid']     	        = $data['location_id'];
$tempArray['agentName']     	        = $data['agentName']; 
$tempArray['offerName']                 = $data['propertyName'];
	
if($data['productLogo'] != ''){
    $tempArray['offerLogo']    	    = $serverrul.'/images/productLogo/'.$data['productLogo'];
}
else
{
   $tempArray['offerLogo']    	    ='';//$serverrul.'/images/5.jpg'
} 
    

if($data['offerLogoThumb'] != ''){
    $tempArray['offerLogoThumb']    	    = $serverrul.'/images/productLogo/'.$data['offerLogoThumb'];
}
else
{
   $tempArray['offerLogoThumb']    	    =''; //$serverrul.'/images/5.jpg'
} 


$tempArray['shortDesc']                 =  $data['propertyDesc'];

$tempArray['lTime']                     =  $data['lTime'];

$tempArray['whatsp']                    =  '';
$tempArray['disc']                      =   $data['ratingOffer'];
$tempArray['rating']                    =  $data['rating'];

$tempArray['fav']                     =  $data['fav'];

$tempArray['phone']                   =  $data['phone']; 
$tempArray['ratingOffer']             =  $data['ratingOffer']; 
 
$tempArray['offerAddress']              =  $data['propertyAddress'];  
$tempArray['offerDet']                 =  $data['propertyDesc'];
$tempArray['offerPrice']                = $data['propertyPrice'];
$tempArray['approval_status']           = $data['approval_status'];  
$tempArray['locationName']              = $data['locationName']; 
$tempArray['location_lat']              = $data['location_lat']; 
$tempArray['location_long']             = $data['location_long']; 
  
$created                                = date('d-m-Y', strtotime($data['creationDate']));
$tempArray['created']                   = date('d F Y', strtotime($created));
  
   	
  
$finalArray[] = $tempArray;  
  
}

$dat = array('status'=>'1','num_pages'=>$num_pages,'result'=>$finalArray);

  echo json_encode($dat);exit;   
  }                             
    
else {
	 $retvalArray['status'] = '0';  
         echo json_encode($retvalArray);exit; 
	}


}//action close   


 
 
?>
