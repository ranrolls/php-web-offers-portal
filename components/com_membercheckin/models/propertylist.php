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

class MembercheckinModelPropertylist extends JModelLegacy
{
		
	/*
	 *
	 *  This function use to get Company detail listing
	 * 
	 * */
	public function getPropertyListd(){
		 
                  $db = JFactory::getDbo(); 
                  $data	= JRequest::get('post');

$query = $db->getQuery(true);

$query->select('*') 
->from($db->quoteName('onm_property')) 
->group($db->quoteName('propertyID'))
->order($db->quoteName('propertyName') . ' ASC');

$db->setQuery($query); 
$allproperty= $db->loadAssocList(); 

//print_r($allproperty);

return $allproperty;


}
	
	
	
	
}  # End of class