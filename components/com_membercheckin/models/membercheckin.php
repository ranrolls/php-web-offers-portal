<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class MembercheckinModelMembercheckin extends JModelLegacy
{
	/*
	 * 
	 * This function use to save member checkin status
	 * 
	 * */
	
	
	public function saveCheckinStatusData(){
		$mainframe 		= JFactory::getApplication();
		$session 	 	= JFactory::getSession();		
		$db		 	  	= & JFactory::getDBO();
		$session->clear('msgsavepublish');
		$data  		 	= JRequest::get('post');
		
	}
	
	
	/*
	 * Requirement: This function is used to member list with checkin status
	 * Modified By: Vishal Singh
	 * Modified On: 21 March 2013
	 * */
	 public function getPropertyRequestListD(){
		 
	   
		//$this->memberDetail = array();
                
                $db = JFactory::getDbo(); 
               $query = $db->getQuery(true);

 $query->select('*') 
 ->from($db->quoteName('onm_property'));

  $db->setQuery($query); 
 $propertyDetail= $db->loadAssocList(); 

 //print_r($propertyDetail);

 return $propertyDetail;
		 
			 
		 
	}
	
	
	
	
}  # End of class
