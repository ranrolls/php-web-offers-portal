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

class MembercheckinModelEditcheckinproperty extends JModelLegacy
{
		
	 
	public function getcheckinPropertyDetail($propertyID){
		 
		 

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
	public function savecheckinPropertyData($post){
                 
                      
		$db = JFactory::getDbo(); 
		$allawExtation  = array('jpg','jpeg','png','gif');									# These extantion allowed for upload logo file 		
		$file  		    = JRequest::getVar('productLogo', null, 'files', 'array');

		$filename		= JFile::makeSafe($file['name']);	
		$filextantion	= strtolower(JFile::getExt($filename) );
		$fileScr		= $file['tmp_name'];

		
		$error = $this->validate($post, $filename, $filextantion, $allawExtation, $fileScr);

		if(count($error)==0){
			// Logo update start there

			if($filename != ''){
				$tempFname	= time().'.'.$filextantion ;
				 $logoName	= str_replace(' ','',$post['propertyName']).'_'.$tempFname;				# File name to store into database
				$src  		= $fileScr;
				  $dest		= JPATH_BASE . DS . "images" . DS . "productLogo" . DS . $logoName;
				
				if ( JFile::upload($src, $dest) ) {
					  $conditional = $logoName;
				}
			}
			// Logo update end there
			


$query = $db->getQuery(true);
 
 

  $fields = array(
    $db->quoteName('propertyName') . ' = ' . $db->quote($post['propertyName']),
    $db->quoteName('propertyAddress') . ' = ' . $db->quote($post['propertyAddress']),
    $db->quoteName('productLogo') . ' = ' . $db->quote($conditional),
    $db->quoteName('propertyDesc') . ' = ' . $db->quote($post['propertyDesc']),
    $db->quoteName('propertyPrice') . ' = ' . $db->quote($post['propertyPrice']),
    
);     


$conditions = array( 
    $db->quoteName('propertyID') . ' = ' . $db->quote($_GET['propertyID'])
);


 
 $query->update($db->quoteName('onm_property'))->set($fields)->where($conditions);
 
$db->setQuery($query);
 
$result = $db->execute();

$db->query();
$app	= JFactory::getApplication();
$urlRed = "index.php/component/membercheckin/";  
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
			$errorMsg['propertyName'] = "Product name is a required field.";
		}
		
		if($filename != ''){
			if(!in_array($filextantion, $allawExtation)){
				$errorMsg['propertyLogoError'] = "Please upload product logo with ".implode(', ',$allawExtation)." extension"; 	# Error massage for productLogo name
			}
			
			//list($imgWidth, $imgHeight) = getimagesize($fileSource);
			//if($imgWidth > 150 || $imgHeight > 40){
				
				//$msg['propertyLogoSizeError'] = "Please upload logo with 150X40 or less";
				
			//}
			
		}
		return $errorMsg;
	}
	
	
}  # End of class
