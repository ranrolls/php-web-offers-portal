<?php

include_once('config.php');

   if($action='location'){
 
                                $finalArray		=array();
                                $action          = $_REQUEST['action'];
                                $catid           = $_REQUEST['catid'];
                                $subcatid        = $_REQUEST['subcatid']; 
                                $organization_id = $_REQUEST['organization_id'];

 $sql_org= "SELECT * FROM ".$prefix."offer_location WHERE catid='".$catid."' and subcatid='".$subcatid."' and org_id='".$organization_id."' ORDER BY  location_id DESC";

				$rs_org  = mysql_query($sql_org);

				if (mysql_num_rows($rs_org) > 0){ 

				while($data_det = mysql_fetch_assoc($rs_org)) {  
				$finalArray[] = $data_det;  
				}   
				   $dat = array('status'=>'1','result'=>$finalArray);
                                   echo json_encode($dat);exit;  
				} 

				else {
                                     $dat = array('status'=>'0','result'=>'');
				      echo json_encode($dat);exit;  
				}	

                        }

?>