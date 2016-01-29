<?php

include_once('config.php'); 
 

                                $action          = $_REQUEST['action'];
                                $number          = $_REQUEST['number']; 
                                $subcatid        = $_REQUEST['subcatid']; 
                                $devicelat       = $_REQUEST['latitude'];
                                $devicelong      = $_REQUEST['longitude'];

                                $retvalArray = array();
                                $finalArray=array();
                                $finalDataArray =array();
                             
 if ($action=='offerlist'){  
                                if(!isset($number) || ($number == "" || $number == 0)){
                                $page = 1;
                                }else{
                                  $page = $number; 
                                  }


$radius = '10'; 
$range = '5';  //radius 
  
$lat_range = $radius/69.172;
  
$lon_range = abs($radius/(cos($devicelat) * 69.172));
  
$min_lat = number_format($devicelat - $lat_range, "4", ".", "");  
$max_lat = number_format($devicelat + $lat_range, "4", ".", "");  
$min_lon = number_format($devicelong - $lon_range, "4", ".", "");  
$max_lon = number_format($devicelong + $lon_range, "4", ".", "");

  $query= "SELECT * FROM ".$prefix."property
                       WHERE (location_lat BETWEEN '".$min_lat."' AND '".$max_lat."')  
                       AND (location_long BETWEEN '".$min_lon."' AND '".$max_lon."') 
                       AND subcatid='".$subcatid."' and approval_status='1' order by propertyID DESC
                       ";  
 

//$query= "SELECT * FROM ".$prefix."property as a left join onm_offer_location as b on a.location_id=b.location_id
				//left join onm_offer_location as c on c.subcatid=b.subcatid 
				//left join onm_offer_organisation as d on  d.subcatid=c.subcatid 
				//WHERE  and a.approval_status='1' GROUP BY a.propertyName ORDER BY  
                               //a.propertyID DESC"; 
 
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
	 
         $dat = array('status'=>'0','num_pages'=>'','result'=>''); 
         echo json_encode($dat);exit; 
	}


}//action close   


 
 
?>
