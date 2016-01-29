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
 
class MembercheckinViewPropertylist extends JViewLegacy   
{
      
	

	public function display($tpl = null)
	{
		JFactory::getApplication()->set('jquery',true);
		$this->user = JFactory::getUser();	
		$this->app  = JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
				 
		$model 	    = $this->getModel();

		// Getting all Company detail
		 $this->allproperty=$model->getPropertyListd();
                
                 //print_r($this->allproperty);
		 parent::display($tpl);
	}
 

	 
	
} #End of class
?>