<?php 
/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/Editcompany
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Vishal Kumar
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla view library
jimport('joomla.application.component.view');
jimport('joomla.application.component.model' );

class MembercheckinViewEditproperty extends JViewLegacy
{
	/**
	 * MembercheckinViewEventsprocess view display method for event start stop
	 * @return void
	 */
	public function display($tpl = null)
	{
		JFactory::getApplication()->set('jquery',true);
		
		$this->user = JFactory::getUser();	
		$this->app  = JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
	 
		$model 	             = $this->getModel();
                $postData   = JRequest::get('post');  
                $propertyID = JRequest::getVar('productID');
		    
		$optMode  = 'edit';
		if(empty($postData)){
	            
	                $this->propertyDetail =$model->getPropertyDetail($propertyID);
	                 
		}
		
		
		 
		
		if(!empty($postData))
		{
		    
		  
			$saveRespons 	  = $model->savePropertyData($postData);
 
		 	$propertyName      = (isset($postData['propertyName']) && $postData['propertyName'] != "")?$postData['propertyName']:'';
			$propertyAddress    = (isset($postData['propertyAddress']) && $postData['propertyAddress'] != "")?$postData['propertyAddress']:'';
			$propertyDesc= (isset($postData['propertyDesc']) && $postData['propertyDesc'] != "")?$postData['propertyDesc']:'';
	$propertyPrice= (isset($postData['propertyPrice']) && $postData['propertyPrice'] != "")?$postData['propertyPrice']:'';


$propertyLogo= (isset($postData['propertyLogo']) && $postData['propertyLogo'] != "")?$postData['propertyLogo']:''; 

$googlemapLogo= (isset($postData['googlemapLogo']) && $postData['googlemapLogo'] != "")?$postData['googlemapLogo']:''; 
		}
  

				
		parent::display($tpl);
	}
	
}
?>