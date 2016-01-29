<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');
 
class MembercheckinModelAddProperty extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	 

	 	/*
	 *
	 *  This function use to save Company detail
	 * 
	 * */
	public function savePropertyData($post){
                 
                 
		$db = JFactory::getDbo(); 
		$allawExtation  = array('jpg','jpeg','png','gif'); # These extantion allowed for upload logo file 		
		$file  		     = JRequest::getVar('propertyLogo', null, 'files', 'array');

		 $filename		= JFile::makeSafe($file['name']);	
                $filextantion	        = strtolower(JFile::getExt($filename) );
                $fileScr		= $file['tmp_name'];

		
		$error = $this->validate($post, $filename, $filextantion, $allawExtation, $fileScr);

		if(count($error)==0){
			// Logo update start there

		 if($filename != ''){
		  $tempFname	= time().'.'.$filextantion ;
		 $logoName	= str_replace(' ','',$post['propertyName']).'_'.$tempFname; # File name to store into database
	           $src  		= $fileScr;
		   $dest		= JPATH_BASE ."/images/productLogo/". $logoName;
				
		if ( JFile::upload($src, $dest) ) {
		    $conditional = $logoName;
		 }
	    }
	 // Logo update end there

########################################### 
                	
		$file1  		     = JRequest::getVar('googlemapLogo', null, 'files', 'array');

		$filename1		= JFile::makeSafe($file1['name']);	
                $filextantion1	        = strtolower(JFile::getExt($filename1) );
                $fileScr1		= $file1['tmp_name'];
 
		 // Logo update start there

		 if($filename1 != ''){
		  $tempFname1	= uniqid().time().'.'.$filextantion1 ;
		  $logoName1	= str_replace(' ','',$post['propertyName']).'_'.$tempFname1; # File name to store into database
	           $src1  		= $fileScr1;
		   $dest1		= JPATH_BASE ."/images/productLogo/". $logoName1;
				
		if ( JFile::upload($src1, $dest1) ) {
		    $conditional1 = $logoName1;
		 }
	    }
	      // Logo update end there
       



######################################		
$creationDate=date('Y-m-d H:i:s');

$query = $db->getQuery(true);
 
 
 //[subcatid] => 1 [orgid] => 1 [locationid] => 4  
 
####################################
$query_select_orgcatname = $db->getQuery(true);

  $query_select_orgcatname
         ->select('organizationName') 
         ->from($db->quoteName('onm_offer_organisation'))
         ->where($db->quoteName('organization_id')." = ".$db->quote($post['orgid'])); 

$db->setQuery($query_select_orgcatname); 

$results_orgcatname =  $db->loadAssocList();  
foreach($results_orgcatname as $organization) {
 $organizationName = $organization["organizationName"];

}

#######################################

$query_select_locationname = $db->getQuery(true);

 $query_select_locationname
          ->select('*') 
         ->from($db->quoteName('onm_offer_location'))
         ->where($db->quoteName('location_id')." = ".$db->quote($post['locationid']));

$db->setQuery($query_select_locationname); 

$results_locationname =  $db->loadAssocList();  
foreach($results_locationname as $location) {

  $locationName   = $location["locationName"];
  $location_lat   = $location["location_lat"];
  $location_long  = $location["location_long"];
}


################################################  
 $columns = array('catid','subcatid','organization_id','organizationName','location_id','locationName','location_lat','location_long','agentName', 'propertyName','productLogo','offerLogoThumb','propertyAddress','propertyDesc','propertyPrice','creationDate');      

  $values = array($db->quote($post['category']),$db->quote($post['subcatid']),$db->quote($post['orgid']),$db->quote($organizationName),$db->quote($post['locationid']),$db->quote($locationName),$db->quote($location_lat),$db->quote($location_long),$db->quote($post['username']),$db->quote($post['propertyName']),$db->quote($conditional),$db->quote($conditional1),$db->quote($post['propertyAddress']),$db->quote($post['propertyDesc']),$db->quote($post['propertyPrice']),$db->quote($creationDate));

 

        $query
            ->insert($db->quoteName('onm_property'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
     
 
  $db->setQuery($query);
 
   $result = $db->execute();

echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Offer Added')
     window.location.href='index.php?option=com_membercheckin&view=addproperty';
    </SCRIPT>");
 
     }else{
			return $error;	
		}
	}
	
	
	/*
	 *
	 *  This function use to validate Company detail
	 * 
	 * */
	public function validate($post, $filename, $filextantion, $allawExtation, $fileSource)
	{
		$errorMsg = array();
		$db		  = JFactory::getDBO();
		 
		if(empty($post['propertyName'])){
			$errorMsg['propertyName'] = "Property name is a required field.";
		}
		
		if($filename != ''){
		 if(!in_array($filextantion, $allawExtation)){
	  $errorMsg['propertyLogoError'] = "Please upload property logo with ".implode(', ',$allawExtation)." extension"; 	
             # Error massage for propertyLogo name
		 }
			
			//list($imgWidth, $imgHeight) = getimagesize($fileSource);
			//if($imgWidth > 150 || $imgHeight > 40){
				
				//$msg['propertyLogoSizeError'] = "Please upload logo with 150X40 or less";
				
			//}
			
		}
		return $errorMsg;
	}
	
	 
 


	
}
