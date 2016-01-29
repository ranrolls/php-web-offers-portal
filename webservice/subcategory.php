<?php
 

				include_once('config.php');
                              
                                 
                               
                                $retfinalArray        =array();
                                $finalArray =array();
                                $action               = $_REQUEST['action'];
                                $catid                = $_REQUEST['catid'];
                                 
                                
                               
               
 if($action='cat_by_id'){
  
  $mobile_location= "SELECT * from ".$prefix."product_subcategory  
                     WHERE catid='".$catid."' ";
$result=mysql_query($mobile_location); 

while($rowss = mysql_fetch_assoc($result)){

//print_r($rowss);

$retfinalArray['subcatid'] = $rowss['subcatid'];
$retfinalArray['catid'] = $rowss['catid'];
$retfinalArray['subcategoryName'] = $rowss['subcategoryName'];
$retfinalArray['creationDate'] = $rowss['creationDate'];
 
$finalArray[]=$retfinalArray;
}
    
  //$retvalArray['timeslots'] = $tsTempArray;
 //$retvalArray['memberdetail'] = $mrTempArray; 

 
 $dat = array('status'=>'1','result'=>$finalArray);
 echo json_encode($dat);exit;     


 

}
 
  
		    
?>
