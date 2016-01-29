<?php 
/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/Addevent
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla view library
jimport('joomla.application.component.view');
jimport('joomla.application.component.model' );
class MembercheckinViewAddevent extends JViewLegacy
{
	/**
	 * MembercheckinViewEventsprocess view display method for event start stop
	 * @return void
	 */
	public function display($tpl = null)
	{
		JFactory::getApplication()->set('jquery',true);
		$this->user = &JFactory::getUser();	
		$this->app  = &JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
		
		$db		    = &JFactory::getDBO();
		$model 	    = $this->getModel();
		
		$this->presenterDetail = array();
		$this->title 	 = '';
		$this->companyID = '0';
		$this->userID	 = '';
		$this->startTime = '';
		$this->stopTime	 = '';
		
		$this->postData = JRequest::get('post');
		$this->eventID  = JRequest::getVar('eventID');
		
		if($this->eventID != '' && $this->eventID > 0){
			$this->optMode  = 'edit';
			if(empty($this->postData)){
				$eventDetail 	   =  $model->getEventsDetail($this->eventID);			# Getting event detail to edit
				$this->title 	   =  $eventDetail['title'];			
				$this->companyID   =  $eventDetail['companyID'];			
				$this->userID 	   =  $eventDetail['userID'];
				$this->eventStatus =  $eventDetail['status'];
				// Start Time			
				$startTimeA 	   =  explode(' ',$eventDetail['start']);
				$startTimeHm	   =  explode(':',$startTimeA[0]);
				$this->startHour   =  $startTimeHm[0];
				$this->startMin    =  $startTimeHm[1];
				$this->startLfix   =  $startTimeA[1];
				// Stop Time
				$stopTimeA    	   =  explode(' ',$eventDetail['stop']);
				$stopTimeHm    	   =  explode(':',$stopTimeA[0]);
				$this->stopHour    =  $stopTimeHm[0];
				$this->stopMin     =  $stopTimeHm[1];
				$this->stopLfix    =  $stopTimeA[1];
				
				$this->presenterDetail = $model->getPresenterDetail($eventDetail['companyID']);		# Getting Presenter Detail			
			}
		}else{
			$this->optMode  = 'add';
		}
			
		
		if(!empty($this->postData))
		{
			$this->saveRespons = $model->saveEventData($this->postData);
			
			$this->title 		= (isset($this->postData['title']) && $this->postData['title'] != "")?$this->postData['title']:'';
			$this->companyID 	= (isset($this->postData['companyID']) && $this->postData['companyID'] != "")?$this->postData['companyID']:'0';
			$this->userID 		= (isset($this->postData['userID']) && $this->postData['userID'] != "")?$this->postData['userID']:'';
			$this->startHour 	= (isset($this->postData['startHour']) && $this->postData['startHour'] != "")?$this->postData['startHour']:'';
			$this->startMin 	= (isset($this->postData['startMin']) && $this->postData['startMin'] != "")?$this->postData['startMin']:'';
			$this->startLfix 	= (isset($this->postData['startLfix']) && $this->postData['startLfix'] != "")?$this->postData['startLfix']:'';
			$this->stopHour 	= (isset($this->postData['stopHour']) && $this->postData['stopHour'] != "")?$this->postData['stopHour']:'';
			$this->stopMin 		= (isset($this->postData['stopMin']) && $this->postData['stopMin'] != "")?$this->postData['stopMin']:'';
			$this->stopLfix 	= (isset($this->postData['stopLfix']) && $this->postData['stopLfix'] != "")?$this->postData['stopLfix']:'';
			$this->eventStatus 	= (isset($this->postData['eventStatus']) && $this->postData['eventStatus'] != "")?$this->postData['eventStatus']:'';

			$this->presenterDetail = $model->getPresenterDetail($this->postData['companyID']);		# Getting Presenter Detail
			
		
		}
		// Getting all company detail for start stop
		//$this->companyDetail = $model->getCompanyDetail($this->companyID);
		
		parent::display($tpl);
	}
	
}
?>
