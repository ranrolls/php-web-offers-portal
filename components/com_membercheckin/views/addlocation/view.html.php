<?php
/**
* @version		$Id: default_viewfrontend.php 96 2011-08-11 06:59:32Z michel $
* @package		Attendeeregistration
* @subpackage 	Views
* @copyright	Copyright (C) 2013, . All rights reserved.
* @license #
* @Author 		Vishal Kumar
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
jimport('joomla.application.component.view');
jimport('joomla.application.component.model' );
 
class MembercheckinViewAddlocation extends JViewLegacy   
{
	public function display($tpl = null)
	{
                 JFactory::getApplication()->set('jquery',true);
		
		$this->user = JFactory::getUser();	
		$this->app  = JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
	 
		$model 	             = $this->getModel();
                $postData           = JRequest::get('post'); 
               

               if($postData['task']=='addlocation') 
	       {    
	        $saveSubRespons 	  = $model->saveLocationData($postData);
            $catid             = (isset($postData['catid']) && $postData['catid'] != "")?$postData['catid']:'';
            $subcatid           = (isset($postData['subcatid']) && $postData['subcatid'] != "")?$postData['subcatid']:'';
            $orgid           = (isset($postData['orgid']) && $postData['orgid'] != "")?$postData['orgid']:'';
            $locationName= (isset($postData['locationName']) && $postData['locationName'] != "")?$postData['locationName']:'';
$locationLat= (isset($postData['locationLat']) && $postData['locationLat'] != "")?$postData['locationLat']:'';
$locationLong= (isset($postData['locationLong']) && $postData['locationLong'] != "")?$postData['locationLong']:'';
        
 
		 }
                     
              
		//$this->assignRef('error',$error);
		parent::display($tpl);
	}
	
	/*
	 * This function use to validate the property add form data
	 * 
	 * */
	public function validate($data)
	{
		$db	= JFactory::getDBO();
		 
                $locationName= $data['locationName']; 
                $locationLat= $data['locationLat']; 
                $locationLong= $data['locationLong']; 
            
		$msg	 = array();
			 
                 if(empty($locationName)){
			$msg['locationName']="Location name is required field";
		}

               if(empty($locationLat)){
			$msg['locationLat']="Location Latitude is required field";
		}

               if(empty($locationLong)){
			$msg['locationLong']="Location Longitude is required field";
		}
		   
		return $msg;
	}
	
	
	 
	
	 
	
} #End of class
?>