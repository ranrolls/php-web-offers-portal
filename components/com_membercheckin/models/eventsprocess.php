<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 * 
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class MembercheckinModelEventsprocess extends JModelLegacy
{
	
	/*
	 *
	 *  This function use to get Member list for checkin
	 * 
	 * */
	public function eventsDetail(){
		$db		= &JFactory::getDBO();
		$data	= JRequest::get('post');
		$query  = "SELECT CES.*, u.name, u.email, u.usertype, c.companyName, c.userType As companyUserType 
			    FROM #__community_events_start_stop AS CES 
			    LEFT JOIN #__users AS u ON ( u.id = CES.userID )
			    LEFT JOIN #__company AS c ON ( c.companyID = CES.companyID )
				WHERE 1 ORDER BY CES.start ASC";
		//  ORDER BY FIELD(CES.status, '3', '1', '2', '0'), CES.start ASC				
		$db->setQuery($query);
		$this->memberDetail = $db->loadAssocList();
		return $this->memberDetail;
	}
	
	/*
	 *
	 *  This function use to get Member list for checkin
	 * 
	 * */
	public function getCompanyList($comapanyID){
		$db		= &JFactory::getDBO();
		$data	= JRequest::get('post');
		$query  = "SELECT * FROM #__company WHERE 1 AND userType IN ('Founder','Staff') AND companyID NOT IN ( SELECT companyID FROM #__community_events_start_stop where status IN ('1','3') AND companyID !='".$comapanyID."' ) ORDER BY companyName ";
		$db->setQuery($query);
		$this->companyDetail = $db->loadAssocList();
		return $this->companyDetail;
	}
	
	
	
	
}  # End of class
