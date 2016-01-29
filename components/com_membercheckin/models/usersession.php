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

class MembercheckinModelUsersession extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get Member list
	 * 
	 * */
	public function getMemberDetail(){
		$db		= &JFactory::getDBO();
		$this->memberDetail = array();
		$query  = "SELECT ul.userID, u.name, u.email, u.usertype, count(ul.userID) AS totalTime, 
				( select count(id) FROM #__content_statistics WHERE user_id = ul.userID ) AS webTotal ,  
			    ( select count(userID)  FROM #__user_visit_log WHERE userID = ul.userID AND useFrom='IOS') AS iosTotal , 
			    ( select count(userID)  FROM #__user_visit_log WHERE userID = ul.userID AND useFrom ='Android') AS androidTotal 
			    FROM #__user_visit_log AS ul
			    LEFT JOIN #__users AS u ON (u.id = ul.userID)
				WHERE 1 AND u.name IS NOT NULL GROUP BY ul.userID ORDER BY u.name ";
				
		$db->setQuery($query);
		$this->memberDetail = $db->loadAssocList();
		return $this->memberDetail;
	}
		
}  # End of class
