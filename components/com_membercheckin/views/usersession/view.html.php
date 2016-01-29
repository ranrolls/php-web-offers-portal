<?php 
/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/Usersession
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
class MembercheckinViewUsersession extends JViewLegacy
{
	/**
	 * MembercheckinViewUsersession view display method
	 * @return void
	 */
	public function display($tpl = null)
	{
		JFactory::getApplication()->set('jquery',true);
		$this->user = &JFactory::getUser();	
		$this->app  = &JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
				 
		$model 	    = $this->getModel();
		// Getting all Company detail
		//$this->memberDetail = $model->getMemberDetail();
		parent::display($tpl);
	}
	
}
?>
