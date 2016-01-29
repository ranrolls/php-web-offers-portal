<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin/Meetup
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 * 
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class MembercheckinModelMeetup extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get meetup detail
	 * 
	 * */
	public function meetupDetail($companyID){
		$db		= &JFactory::getDBO();
		$data	= JRequest::get('post');
		$query  = "SELECT m.id, m.companyid, m.userid, m.meetupRequestDate, m.status,cu.alias AS userLink, cu.avatar AS thumb, 
				u.name, u.usertype, ccv.value AS companyName, ccvJob.value AS jobTitle, cmt.timeslot  
			    FROM #__community_meetup_requests AS m 
			    LEFT JOIN #__community_meetup_timeslots AS cmt ON ( cmt.id = m.timeslotid )
			    LEFT JOIN #__community_users AS cu ON ( cu.userid = m.userid )
			    LEFT JOIN #__users AS u ON ( cu.userid=u.id )
			    LEFT JOIN #__community_fields_values AS ccv ON ( ccv.user_id = m.userid AND ccv.field_id = '1' )
			    LEFT JOIN #__community_fields_values AS ccvJob ON ( ccvJob.user_id = m.userid AND ccvJob.field_id = '4' )
				WHERE m.companyid = '".$companyID."' ORDER BY m.companyid  ";										 
				
		$db->setQuery($query);
		$this->meetupDetail = $db->loadAssocList();
		return $this->meetupDetail;
	}
	
	
	
	 
	
}  # End of class
