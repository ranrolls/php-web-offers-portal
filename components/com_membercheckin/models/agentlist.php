<?php
/**
 * 
 * @package		Joomla	
 * @subpackage	com_membercheckin/Companylist
 * @Author		Onsumaye (Sudhish Kumar)
 * @copyright	Copyright (C) 2012 - 2013 OnSumaye Inc. All rights reserved.
 * @license		GNU General Public License version 1 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class MembercheckinModelAgentlist extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get Company detail listing
	 * 
	 * */
	public function getAgentList(){
		 
                  $db = JFactory::getDbo(); 
                  $data	= JRequest::get('post');

$query = $db->getQuery(true);

$query->select('*') 
->from($db->quoteName('h_users')) 
->order($db->quoteName('registerDate') . ' ASC');

$db->setQuery($query); 
$AgentDetail= $db->loadAssocList(); 

//print_r($allproperty);

return $AgentDetail;


}
	
	
	
	
}  # End of class