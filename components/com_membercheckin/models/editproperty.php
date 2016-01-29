<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin/Editcompany
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.filesystem.file');
jimport('joomla.application.component.controller');

class MembercheckinModelEditproperty extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get Company detail on company ID
	 * 
	 * */
	public function getPropertyDetail($propertyID){
		 
		 

    $db = JFactory::getDbo(); 
               

$query = $db->getQuery(true);

 $query->select('*') 
->from($db->quoteName('onm_property')) 
->where($db->quoteName('propertyID')." = ".$db->quote($propertyID));

$db->setQuery($query); 

$propertyDetail = $db->loadAssocList();
  
return $propertyDetail;

}
	
	/*
	 *
	 *  This function use to save Company detail
	 * 
	 * */
	public function savePropertyData($post){
                 
                      
		$db = JFactory::getDbo(); 
	       $allawExtation  = array('jpg','jpeg','png','gif');									
              #These extantion allowed for upload logo file 		
		$file  = JRequest::getVar('propertyLogo', null, 'files', 'array');

		$filename		= JFile::makeSafe($file['name']);	
		$filextantion	= strtolower(JFile::getExt($filename) );
		$fileScr		= $file['tmp_name'];

		
		$error = $this->validate($post, $filename, $filextantion, $allawExtation, $fileScr);

		if(count($error)==0){
			// Logo update start there

			if($filename != ''){
				$tempFname	= time().'.'.$filextantion ;
                                $logoName	= str_replace(' ','',$post['propertyName']).'_'.$tempFname; 
                                # File name to store into database
				 $src  		= $fileScr;
				 $dest		= JPATH_BASE ."/images/productLogo/". $logoName;
				if ( JFile::upload($src, $dest) ) {
					  $conditional = $logoName;
				 }
			 }
			// Logo update end there

##############################################
 
                $file1  		= JRequest::getVar('googlemapLogo', null, 'files', 'array');

		$filename1		= JFile::makeSafe($file1['name']);	
                $filextantion1	        = strtolower(JFile::getExt($filename1) );
                $fileScr1		= $file1['tmp_name'];
 
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
        
			  
#############################################

$query = $db->getQuery(true);
 
 

  $fields = array(
    $db->quoteName('propertyName') . ' = ' . $db->quote($post['propertyName']),
    $db->quoteName('propertyAddress') . ' = ' . $db->quote($post['propertyAddress']),
    $db->quoteName('productLogo') . ' = ' . $db->quote($conditional),
    $db->quoteName('offerLogoThumb') . ' = ' . $db->quote($conditional1),
    $db->quoteName('propertyDesc') . ' = ' . $db->quote($post['propertyDesc']),
    $db->quoteName('propertyPrice') . ' = ' . $db->quote($post['propertyPrice']),
    
    
);     


$conditions = array( 
    $db->quoteName('propertyID') . ' = ' . $db->quote($_GET['productID'])
);


 
 $query->update($db->quoteName('#__property'))->set($fields)->where($conditions);
 
$db->setQuery($query);
 
$result = $db->execute();

$db->query();
$app	= JFactory::getApplication();
$urlRed = "index.php?option=com_membercheckin&view=propertylist";
$app->redirect( $urlRed);
			
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
			$errorMsg['propertyName'] = "Offer name is a required field.";
		}
		
		if($filename != ''){
			if(!in_array($filextantion, $allawExtation)){
 $errorMsg['propertyLogoError'] = "Please upload product logo with ".implode(', ',$allawExtation)." extension"; 	
 # Error massage for propertyLogo name
			}
			
			//list($imgWidth, $imgHeight) = getimagesize($fileSource);
			//if($imgWidth > 150 || $imgHeight > 40){
				
				//$msg['propertyLogoSizeError'] = "Please upload logo with 150X40 or less";
				
			//}
			
		}
		return $errorMsg;
	}
	
	
}  # End of class
