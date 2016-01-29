<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin/Companylikes
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class MembercheckinModelCompanylikes extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get Company listing with there likes
	 * 
	 * */
	public function companyLikesDetail(){
		$db		= &JFactory::getDBO();
		$data	= JRequest::get('post');
		$query  = "SELECT c.`companyID`, c.`companyName`, c.`companyLogo`, c.`userType`, c.`companyWebsite`, c.`companyDesc`, 
				count(cl.company_id) totalLike 
				FROM #__company c 
				LEFT JOIN #__companies_likes AS cl ON (cl.company_id = c.companyID) 
				WHERE 1 AND c.`userType` = 'Founder' 
				GROUP BY c.companyID 
				ORDER BY totalLike DESC , companyName ASC ";
				
		$db->setQuery($query);
		$this->companyDetail = $db->loadAssocList();
		return $this->companyDetail;
	}
	
	
	
	
}  # End of class
