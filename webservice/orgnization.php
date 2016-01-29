<?php

include_once('config.php');

   if($action='organization_details'){
 
                                $finalArray		=array();
                                $action    = $_REQUEST['action'];
                                $catid     = $_REQUEST['catid'];
                                $subcatid  = $_REQUEST['subcatid']; 

 $sql_org= "SELECT * FROM ".$prefix."offer_organisation WHERE catid='".$catid."' and subcatid='".$subcatid."' ORDER BY  organization_id ASC";

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