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
 
class MembercheckinViewAddCategory extends JViewLegacy   
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
                 
		 if($postData['task']=='addcategory')
		 {  // echo "vishalcateg";
	            $saveRespons 	  = $model->saveCategoryData($postData);
                     $categoryName = (isset($postData['categoryName']) && $postData['categoryName'] != "")?$postData['categoryName']:'';
 
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
		
		$categoryName= $data['categoryName']; 
              
		$msg	 = array();
			 
		if(empty($categoryName)){
			$msg['categoryName']="category name is required field";
		}
                 
		   
		return $msg;
	}
	
	
	 
	
	 
	
} #End of class
?>