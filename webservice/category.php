<?php

		


				include_once('config.php');
                                $tempArray              =array();
				$finalArray		=array();

				$sql= "SELECT * FROM ".$prefix."product_category WHERE 1 ORDER BY  categoryName ASC";

				$rs_username  = mysql_query($sql);

				if (mysql_num_rows($rs_username) > 0){ 

				while($data = mysql_fetch_assoc($rs_username)) {
	 
				
                             $tempArray['catid']           =$data['catid']; 
                             $tempArray['categoryName']    =$data['categoryName']; 
                           if($data['categoryImage']!=''){
                             $tempArray['categoryImage']=   $upload_fullpath.'/images/productLogo/'.$data['categoryImage'];
                           } else {
                                    $tempArray['categoryImage']='';
                                  }
                             if($data['categoryImageA']!=''){
                             $tempArray['categoryImageA']=   $upload_fullpath.'/images/productLogo/'.$data['categoryImageA'];
                           } else {
                                    $tempArray['categoryImageA']='';
                                  }

                            
                                 $tempArray['creationDate']    =$data['creationDate'];
				$finalArray[] = $tempArray;  
				}   
				   $dat = array('status'=>'1','result'=>$finalArray);
                    echo json_encode($dat);exit;  
				} 

				else {
                      $dat = array('status'=>'0','result'=>'');
				      echo json_encode($dat);exit;  
				}	
			
		    
?>
